<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePayment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Users;

class Payments extends Controller
{
    public function store(CreatePayment $request) {

      $user = Auth::user();

      if(strcasecmp($user->username, 'ipf_pay') == 0) {
        $payment = $this->savePayment($request);
        
        return response()->json(['message' => 'success',], 201);
      }
      else {
        $payment = $this->savePayment($request);

        $usersController = new Users();

        $request->email = $user->email;

        return $usersController->updateSubscription($request);
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
