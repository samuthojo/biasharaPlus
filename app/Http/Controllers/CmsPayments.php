<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePayment;

class CmsPayments extends Controller
{
    public function store(CreatePayment $request)
    {
      $payment = $this->savePayment($request);

      session(['message' => 'Payment saved successfully', ]);

      return redirect()->route('payments_page')
                       ->with('message', 'Payment saved successfully');
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
