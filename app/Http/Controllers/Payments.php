<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePayment;

class Payments extends Controller
{
    public function __invoke(CreatePayment $request) {
      $data = $request->except('date_payed');
      $date_payed = $request->input('date_payed');
      $date_payed = \Carbon\Carbon::parse($date_payed)->format('Y-m-d');
      $data = array_add($data, 'date_payed', $date_payed);
      \App\Payment::create($data);
      return response()->json([
        'message' => 'success',
      ], 201);
    }
}
