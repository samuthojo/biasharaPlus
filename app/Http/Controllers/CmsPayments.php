<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePayment;
use App\Http\Controllers\Users;
use App\Http\Requests\UpdateSubscription;

class CmsPayments extends Controller
{
    public function store(CreatePayment $request)
    {
      $payment = $this->savePayment($request);

      $user = $this->findUser($request->sender);

      if($user)
      {
        $request->email = $user->email;

        $usersController = new Users();

        $reqObj = new UpdateSubscription;

        foreach($request as $key => $value) {
          $reqObj->$key = $value;
        }

        $usersController->updateSubscription($reqObj, $user);
      }

      session(['message' => 'Payment saved successfully', ]);

      return redirect()->route('payments_page')
                       ->with('message', 'Payment saved successfully');
    }

    private function findUser($phone_number)
    {
      return \App\User::all()->first(function ($value, $key) use ($phone_number)
      {
          return strpos($value->phone_number, $phone_number) !== FALSE;
      });
    }

    public function savePayment($request)
    {
      $data = $request->except('date_payed');
      $date_payed = $request->input('date_payed');
      $date_payed = \Carbon\Carbon::parse($date_payed)->format('Y-m-d');
      $data = array_add($data, 'date_payed', $date_payed);
      return $payment = \App\Payment::create($data);
    }

    public function payments()
    {
      $payments =
      \App\Payment::latest('date_payed')
                  ->get()
                  ->map(function ($payment) {

                    $payment->redeemed = false;

                    if($payment->user_id != 0 && $payment->sender != "USER") {
                      $payment->redeemed = true;
                    }

                    return $payment;

                  });
      return view('all_payments', compact('payments'));
    }

    public function redeem(Request $request, $id) {

      $this->validate($request, [
        'operator_type' => 'required|string',
        'date_payed' => 'required|string',
        'sender' => 'required|string',
        'amount' => 'required|numeric',
      ]);

      \App\Payment::where(compact('id'))->update($request->all());

      $payment = \App\Payment::find($id);
      $payment->redeemed = true;

      return $payment;
    }
}
