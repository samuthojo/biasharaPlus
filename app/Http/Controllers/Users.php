<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Utils\Utils;
use App\Http\Requests\CreateUser;
use App\Http\Requests\CheckUserExistence;
use App\Http\Requests\CheckSystemExistence;
use App\Http\Requests\UpdateSubscription;
use App\Http\Controllers\Notifications;
use Illuminate\Validation\Rule;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Users extends Controller
{
    private $images = 'uploads/users/';

    //The success message to return on updateSubscription
    private $successMessage = 'subscription updated';

    private $package_1;
    private $package_2;
    private $package_3;

    //User packages(bundles)
    public function __construct()
    {
        $this->package_1 = \App\Bundle::where('name', 'Package_1')
                               ->pluck('price')->first();

        $this->package_2 = \App\Bundle::where('name', 'Package_2')
                               ->pluck('price')->first();

        $this->package_3 = \App\Bundle::where('name', 'Package_3')
                               ->pluck('price')->first();
    }

    public function checkUserExistence(CheckUserExistence $request)
    {
        extract($request->all(), EXTR_PREFIX_ALL, 'posted');
        
        try {
            $user = \App\User::where('email', $posted_email)
                         ->firstOrFail();
                  
            $user_id = $user->id;
            
            if($request->has(['os_type', 'version'])) {
              $user = \App\User::updateOrCreate(['id' => $user_id], [
                'os_type' => $posted_os_type,
                'version' => $posted_version
              ]);
            }
            
            $device_id = $posted_device_id;
            $device = \App\UserDevice::updateOrCreate(compact('user_id', 'device_id'));
        } catch (ModelNotFoundException $e) {
            return response()->json([
          'message' => 'user does not exist',
        ], 404);
        }
        
        $token = $user->createToken($posted_email)->accessToken;
        
        return response()->json(compact('user', 'token'), 200);
    }

    public function checkSystemExistence(CheckSystemExistence $request)
    {
        $user = null;
        $token = null;
        if (Auth::attempt($request->all())) {
            $user = Auth::user();
            if ($user->is_system) {
                $token = $user->createToken($request->username)->accessToken;
                return response()->json(compact('user', 'token'), 200);
            }
        }
       
        return response()->json([
         'message' => 'system does not exist',
       ], 404);
    }

    public function sendUserDetails(CreateUser $request)
    {
        $client = new Client();
        $client->post(
          'http://46.101.93.56/api/v2/send_user_details',
          [
              'json' => [
                $request->all()
            ]
          ]
        );
        
        $user = null;
        
        DB::beginTransaction();
        
        try {
            $user = \App\User::create($request->except('device_id'));
        
            $device = \App\UserDevice::create([
              'user_id' => $user->id,
              'device_id' => $request->device_id,
            ]);
        
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
             "message" => $e->getMessage(),
            ], 500);
        }
        
        $posted_email = $request->input('email');
        $token = $user->createToken($posted_email)->accessToken;
        
        return response()->json(compact('user', 'token'), 201);
    }

    public function accountDetail()
    {
      $user = Auth::user();
      $versions = \App\Version::where('status', true)->get();
      return response(compact('user', 'versions'), 200);
    }

    public function updateAccountDetail(Request $request)
    {
      $id = Auth::id();
      $this->validate($request, [
        'email' => ['nullable', 'email', Rule::unique('users')->ignore($id)],
        'phone_number' => 'nullable|min:8',
        'total_cc' => 'nullable|numeric',
        'business_id' => ['nullable', Rule::unique('users')->ignore($id)],
      ]);
      $user = \App\User::updateOrCreate(compact('id'), $request->all());
      return response(compact('user'), 200);
    }

    public function updateSubscription(UpdateSubscription $request, $user = null)
    {        
      $conditions = [
        ['reference_no', '=', $request->reference_no],
        ['user_id', '=', 0]
      ];
      
      try {
          $payment = null;
      
          if (!$user) {
              $user = \App\User::where('email', $request->email)->first();
              $payment = \App\Payment::where($conditions)->firstOrFail();
          } else {
              $conditions = [
                ['reference_no', '=', $request->reference_no],
                ['user_id', '=', $user->id]
              ];
              $payment = \App\Payment::where($conditions)->firstOrFail();
          }
      
          $subscrEndDate = Utils::timestampConverter($user->subscription_end_date);
          $today = Utils::timestampConverter(date('d-m-Y'));
          if ($today < $subscrEndDate) {
              //Subscription not expired
              return $this->subscriptionNotExpired($payment, $user);
          } else {
              return $this->subscriptionExpired($payment, $user);
          }
      } catch (ModelNotFoundException $e) {
          $payment = \App\Payment::where('reference_no', $request->reference_no)->first();
      
          if ($payment) {
              return response()->json([
                'message' => 'Reference_no already in use',
              ], 200);
          } else {
              return $this->paymentMayNeedClarification($request, $user);
          }
      }
    }

    private function paymentMayNeedClarification($request, $user)
    {
        $payment = \App\Payment::create([
                    'user_id' => $user->id,
                    'sender' => $user->phone_number,
                    'reference_no' => $request->reference_no,
                    'total_to_date' => 0,
                    'date_payed' => \Carbon\Carbon::now()->format('Y-m-d'),
                  ]);

        //Notify bolt about $payment
        try {
            $notification = new Notifications();
            $notification->clarifyPayment($request->reference_no, $user->email);
        } catch (\Throwable $e) {
        }

        return response()->json([
        'message' => 'Payment needs clarification, Admin App notified!',
      ], 200);
    }

    //Update on top of existing subscription
    private function subscriptionNotExpired($payment, $user)
    {
        $amount = $payment->amount;
        $email = $user->email;
        $subscrEndDate = Utils::timestampConverter($user->subscription_end_date);
        DB::beginTransaction();
        try {
            if ($amount >= $this->package_1 && $amount < $this->package_2) {
                $longEndDate = $subscrEndDate + (30*24*60*60);
                $subscrEndDate = date("d-m-Y", $longEndDate);
                $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
            } elseif ($amount >= $this->package_2 && $amount < $this->package_3) {
                $longEndDate = $subscrEndDate + (182*24*60*60);
                $subscrEndDate = date("d-m-Y", $longEndDate);
                $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
            } elseif ($amount >= $this->package_3) {
                $longEndDate = $subscrEndDate + (365*24*60*60);
                $subscrEndDate = date("d-m-Y", $longEndDate);
                $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
            }

            $payment->user_id = $user->id;
            $payment->save();

            DB::commit();

            $message = $this->successMessage;

            $this->sendPushNotification($user);
            
            $this->sendMessage($user->phone_number, $user->business_id,
                               $user->subscription_end_date);

            return response()->json(compact('message', 'user'), 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
          "message" => $e->getMessage(),
        ], 500);
        }
    }

    //Update with the previous subscription already expired
    private function subscriptionExpired($payment, $user)
    {
        $amount = $payment->amount;
        $email = $user->email;
        $subscrStartDate = $payment->date_payed;
        $longStartDate = Utils::timestampConverter($subscrStartDate);
        DB::beginTransaction();
        try {
            if ($amount >= $this->package_1 && $amount < $this->package_2) {
                $longEndDate = $longStartDate + (30*24*60*60);
                $subscrEndDate = date("d-m-Y", $longEndDate);
                $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_start_date' => $subscrStartDate,
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
            } elseif ($amount >= $this->package_2 && $amount < $this->package_3) {
                $longEndDate = $longStartDate + (182*24*60*60);
                $subscrEndDate = date("d-m-Y", $longEndDate);
                $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_start_date' => $subscrStartDate,
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
            } elseif ($amount >= $this->package_3) {
                $longEndDate = $longStartDate + (365*24*60*60);
                $subscrEndDate = date("d-m-Y", $longEndDate);
                $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_start_date' => $subscrStartDate,
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
            }

            $payment->user_id = $user->id;
            $payment->save();

            DB::commit();

            $message = $this->successMessage;

            $this->sendPushNotification($user);
            
            $this->sendMessage($user->phone_number, $user->business_id,
                               $user->subscription_end_date);

            return response()->json(compact('message', 'user'), 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
          "message" => $e->getMessage(),
        ], 500);
        }
    }

    private function sendPushNotification($user)
    {
        $notification = new Notifications();
        $notification->paymentConfirmed($user);
    }
    
    public function sendMessage($phone_number, $business_id, $end_date)
    {
      // $phone_number = $request->phone_number;
      // $business_id = $request->business_id;
      // $end_date = $request->end_date;
      
      $client = new Client(); //GuzzleHttp\Client
      
      $url = 'https://ipfsms-notification.herokuapp.com/api/v1/dispatcher';
      
      $phoneNumber = $this->getPhoneNumber($phone_number, $business_id);
      
      $result = $client->post($url, [
        'json' => [
            [
              'channel' => 'sms',
              'send_to' => $phoneNumber,
              'payload' => [
                'text' => 'Asante kwa malipo, akaunti yako ya Biashara Plus' .
                          ' ipo premium hadi tarehe ' . $end_date . "\n" .
                          'Kwa swali au maoni wasiliana nasi kwa:' . "\n" .
                          'Email:support@biasharaplus.com' . "\n" .
                          'WhatsApp: +255712288231' . "\n" .
                          'Enjoy using Biashara Plus App.',
              ],
            ],
          ],
      ]);
      
      return $result;
    } 
    
    private function getPhoneNumber($phone_number, $business_id) {
      $length = strlen($phone_number);
      if(substr($phone_number, 0, 1) === '0') {
        return substr($business_id, 0, 3) . substr($phone_number, 1, $length - 1);
      }
      return $phone_number;
    }
}
