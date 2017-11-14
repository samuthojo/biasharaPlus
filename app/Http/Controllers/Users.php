<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Utils\Utils;
use App\Http\Requests\CreateUser;
use App\Http\Requests\CheckUserExistence;
use App\Http\Requests\UpdateSubscription;

class Users extends Controller
{
    private $images = 'uploads/users/';

    //User packages
    const PACKAGE_1 = 1000;

    const PACKAGE_2 = 5000;

    const PACKAGE_3 = 10000;

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

    public function sendUserDetails(CreateUser $request) {

      $user = null;

      if($request->hasFile('image_url')) {
        $imageUrl = $this->handleImage($request->file('image_url'));
        $user = $this->saveUserWithImage($imageUrl, $request);
      } else {
        $user = \App\User::create($request->all());
      }

      $posted_email = $request->input('email');
      $token = $user->createToken($posted_email)->accessToken;

      return response()->json(compact('user', 'token'), 201);
    }

    private function handleImage($image) {
      $imageName = $image->getClientOriginalName();
      $image->move($this->images, $imageName);
      return $this->images . $imageName;
    }

    private function saveUserWithImage($imageUrl, $request) {
      $data = $request->except('image_url');
      $data = array_add($data, 'image_url', $imageUrl);
      return \App\User::create($data);
    }

    public function accountDetail() {
      $user = Auth::user();
      $version = \App\Version::where('status', true)
                             ->get(['id', 'version_number', 'features']);
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

          if($amount >= self::PACKAGE_1 && $amount < self::PACKAGE_2) {
            $longEndDate = $subscrEndDate + (30*24*60*60);
            $subscrEndDate = date("Y-m-d", $longEndDate);
            $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
          }
          else if($amount >= self::PACKAGE_2 && $amount < self::PACKAGE_3) {
            $longEndDate = $subscrEndDate + (180*24*60*60);
            $subscrEndDate = date("Y-m-d", $longEndDate);
            $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
          }
          else if($amount >= self::PACKAGE_3) {
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

          return response()->json(compact('user'), 200);
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
          if($amount >= self::PACKAGE_1 && $amount < self::PACKAGE_2) {
            $longEndDate = $longStartDate + (30*24*60*60);
            $subscrEndDate = date("Y-m-d", $longEndDate);
            $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_start_date' => $subscrStartDate,
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
          }
          else if($amount >= self::PACKAGE_2 && $amount < self::PACKAGE_3) {
            $longEndDate = $longStartDate + (180*24*60*60);
            $subscrEndDate = date("Y-m-d", $longEndDate);
            $user = \App\User::updateOrCreate(compact('email'), [
              'subscription_start_date' => $subscrStartDate,
              'subscription_end_date' => $subscrEndDate,
              'subscription' => 'premium',
            ]);
          }
          else if($amount >= self::PACKAGE_3) {
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

          return response()->json(compact('user'), 200);
      }

      catch(Throwable $e) {
        DB::rollBack();
        return response()->json([
          "message" => $e->getMessage(),
        ], 500);
      }

    }

}
