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

class Users extends Controller
{
    private $images = 'uploads/users/';

    //The success message to return on updateSubscription
    private $successMessage = 'subscription updated';

    private $package_1;
    private $package_2;
    private $package_3;

    //User packages(bundles)
    public function __construct() {
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

      try
      {
        $user = \App\User::where('email', $posted_email)
                         ->firstOrFail();

        $user_id = $user->id;
        $device_id = $posted_device_id;
        $device = \App\UserDevice::updateOrCreate(compact('user_id', 'device_id'));
      }
      catch(ModelNotFoundException $e) {
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
       if(Auth::attempt($request->all())) {
         $user = Auth::user();
         if($user->is_system) {
           $token = $user->createToken($request->username)->accessToken;
           return response()->json(compact('user', 'token'), 200);
         }
       }

       return response()->json([
         'message' => 'system does not exist',
       ], 404);

    }

    public function sendUserDetails(CreateUser $request) {

      $user = null;

      DB::beginTransaction();
      try {
        $user = \App\User::create($request->except('device_id'));

        $device = \App\UserDevice::create([
          'user_id' => $user->id,
          'device_id' => $request->device_id,
        ]);

        DB::commit();
      } catch(Throwable $e) {
        DB::rollBack();
        return response()->json([
         "message" => $e->getMessage(),
        ], 500);
      }

      $posted_email = $request->input('email');
      $token = $user->createToken($posted_email)->accessToken;

      return response()->json(compact('user', 'token'), 201);
    }

    public function accountDetail() {
      $user = Auth::user();
      $version = \App\Version::where('status', true)
                             ->first(['id', 'version_number', 'features']);
      return response(compact('user', 'version'), 200);
    }

    public function updateAccountDetail(Request $request) {
      $id = Auth::id();
      $user = \App\User::updateOrCreate(compact('id'), $request->all());
      return response(compact('user'), 200);
    }

    public function updateSubscription(UpdateSubscription $request, $user = null) {

      $conditions = [
        ['reference_no', '=', $request->input('reference_no')],
        ['user_id', '=', 0],
      ];

      try {
        $payment = \App\Payment::where($conditions)->firstOrFail();
        if(!$user) {
          $user = Auth::user();
        }
        $subscrEndDate = Utils::timestampConverter($user->subscription_end_date);
        $today = Utils::timestampConverter(date('d-m-Y'));
        if($today < $subscrEndDate) {
          //Subscription not expired
          return $this->subscriptionNotExpired($payment, $user);
        }
        else {
          return $this->subscriptionExpired($payment, $user);
        }

        $notification = new Notifications();
        $notification->paymentConfirmed($user);
      }
      catch(ModelNotFoundException $e) {

        $payment = \App\Payment::where($request->only('reference_no')->get();

        if($payment) {

          return response()->json([
            'message' => 'Reference_no already in use',
          ], 200);

        } else {

          $this->paymentMayNeedClarification($request, $user);

        }

      }
    }

    private function paymentMayNeedClarification($request, $user) {

      $payment = \App\Payment::create([
                    'user_id' => $user->id,
                    'sender' => 'USER',
                    'reference_no' => $request->input('reference_no'),
                    'total_to_date' => 0,
                  ]);

      //Notify bolt about $payment
      $notification = new Notifications();
      $notification->clarifyPayment($request->input('reference_no'),
                                    $user->email);

    }

    //Update on top of existing subscription
    private function subscriptionNotExpired($payment, $user) {
      $amount = $payment->amount;
      $email = $user->email;
      $subscrEndDate = Utils::timestampConverter($user->subscription_end_date);
      DB::beginTransaction();
      try {

          if($amount >= $this->package_1 && $amount < $this->package_2) {
            $longEndDate = $subscrEndDate + (30*24*60*60);
            $subscrEndDate = date("d-m-Y", $longEndDate);
            $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
          }
          else if($amount >= $this->package_2 && $amount < $this->package_3) {
            $longEndDate = $subscrEndDate + (180*24*60*60);
            $subscrEndDate = date("d-m-Y", $longEndDate);
            $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
          }
          else if($amount >= $this->package_3) {
            $longEndDate = $subscrEndDate + (360*24*60*60);
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

          return response()->json(compact('message', 'user'), 200);
      }

      catch(Throwable $e) {
        DB::rollBack();
        return response()->json([
          "message" => $e->getMessage(),
        ], 500);
      }

    }

    //Update with the previous subscription already expired
    private function subscriptionExpired($payment, $user) {
      $amount = $payment->amount;
      $email = $user->email;
      $subscrStartDate = $payment->date_payed;
      $longStartDate = Utils::timestampConverter($subscrStartDate);
      DB::beginTransaction();
      try {
          if($amount >= $this->package_1 && $amount < $this->package_2) {
            $longEndDate = $longStartDate + (30*24*60*60);
            $subscrEndDate = date("d-m-Y", $longEndDate);
            $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_start_date' => $subscrStartDate,
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
          }
          else if($amount >= $this->package_2 && $amount < $this->package_3) {
            $longEndDate = $longStartDate + (180*24*60*60);
            $subscrEndDate = date("d-m-Y", $longEndDate);
            $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_start_date' => $subscrStartDate,
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
          }
          else if($amount >= $this->package_3) {
            $longEndDate = $longStartDate + (360*24*60*60);
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

          return response()->json(compact('message', 'user'), 200);
      }

      catch(Throwable $e) {
        DB::rollBack();
        return response()->json([
          "message" => $e->getMessage(),
        ], 500);
      }

    }

}
