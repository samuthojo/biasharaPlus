<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePayment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Users;
use App\Http\Requests\UpdateSubscription;

class Payments extends Controller
{
    public function store(CreatePayment $request) {

      $user = Auth::user();

      if($user->is_system) {
        //From ipf_pay or any other authorized system
        $payment = $this->savePayment($request);

        return response()->json(['message' => 'success',
                                 'payment' => $payment, ], 201);
      }
      else {
        $payment = $this->savePayment($request);

        $usersController = new Users();

        $request->email = $user->email;

        $reqObj = new UpdateSubscription;

        foreach($request as $key => $value) {
          $reqObj->$key = $value;
        }

        return $usersController->updateSubscription($reqObj, $user);
      }

    }

    public function savePayment($request)
    {
      $data = $request->except('date_payed');
      $date_payed = $request->input('date_payed');
      $date_payed = \Carbon\Carbon::parse($date_payed)->format('Y-m-d');
      $data = array_add($data, 'date_payed', $date_payed);
      return $payment = \App\Payment::create($data);
    }
}
