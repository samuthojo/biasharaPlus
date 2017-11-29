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
      $this->package_1 = \App\Bundle::where('name', 'package_1')
                               ->pluck('price')->first();

      $this->package_2 = \App\Bundle::where('name', 'package_2')
                               ->pluck('price')->first();

      $this->package_3 = \App\Bundle::where('name', 'package_3')
                               ->pluck('price')->first();
    }

    public function checkUserExistence(CheckUserExistence $request)
    {
      extract($request->all(), EXTR_PREFIX_ALL, 'posted');

      try
      {
        $user = \App\User::where('email', $posted_email)
                         ->firstOrFail();
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

      if($request->has('image_url') && $request->hasFile('image_url')) {
        $imageUrl = Utils::handleImage($request->file('image_url'), $this->images);
        $user = $this->saveUserWithImage($imageUrl, $request);
      } else {
        $user = \App\User::create($request->all());
      }

      $posted_email = $request->input('email');
      $token = $user->createToken($posted_email)->accessToken;

      return response()->json(compact('user', 'token'), 201);
    }

    private function saveUserWithImage($imageUrl, $request) {
      $data = $request->except('image_url');
      $data = array_add($data, 'image_url', $imageUrl);
      return \App\User::create($data);
    }

    public function accountDetail() {
      $user = Auth::user();
      $version = \App\Version::where('status', true)
                             ->first(['id', 'version_number', 'features']);
      return response(compact('user', 'version'), 200);
    }

    public function updateSubscription(UpdateSubscription $request) {
      $conditions = [
        ['reference_no', '=', $request->input('reference_no')],
        ['user_id', '=', 0],
      ];
      try {
        $payment = \App\Payment::where($conditions)->firstOrFail();
        $user = \App\User::where($request->only('email'))->first();
        $subscrEndDate = Utils::timestampConverter($user->subscription_end_date);
        $today = Utils::timestampConverter(date('Y-m-d'));
        if($today < $subscrEndDate) {
          //Subscription not expired
          return $this->subscriptionNotExpired($payment, $user);
        }
        else {
          return $this->subscriptionExpired($payment, $user);
        }
      }
      catch(ModelNotFoundException $e) {
        return response()->json([
          'message' => 'Reference_no already in use',
        ], 200);
      }
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
            $subscrEndDate = date("Y-m-d", $longEndDate);
            $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
          }
          else if($amount >= $this->package_2 && $amount < $this->package_3) {
            $longEndDate = $subscrEndDate + (180*24*60*60);
            $subscrEndDate = date("Y-m-d", $longEndDate);
            $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
          }
          else if($amount >= $this->package_3) {
            $longEndDate = $subscrEndDate + (360*24*60*60);
            $subscrEndDate = date("Y-m-d", $longEndDate);
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
            $subscrEndDate = date("Y-m-d", $longEndDate);
            $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_start_date' => $subscrStartDate,
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
          }
          else if($amount >= $this->package_2 && $amount < $this->package_3) {
            $longEndDate = $longStartDate + (180*24*60*60);
            $subscrEndDate = date("Y-m-d", $longEndDate);
            $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_start_date' => $subscrStartDate,
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
          }
          else if($amount >= $this->package_3) {
            $longEndDate = $longStartDate + (360*24*60*60);
            $subscrEndDate = date("Y-m-d", $longEndDate);
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
