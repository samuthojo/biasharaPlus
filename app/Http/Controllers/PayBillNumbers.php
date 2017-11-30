<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Cms\AddPayBillNumber;
use App\Http\Requests\Cms\UpdatePayBillNumber;

class PayBillNumbers extends Controller
{
    public function index()
    {
      $numbers = \App\PayBillNumber::latest('updated_at')
                                   ->get();
      return view('pay_bill_numbers', compact('numbers'));
    }

    public function store(AddPayBillNumber $request)
    {
      $number = \App\PayBillNumber::create($request->all());
      $numbers = \App\PayBillNumber::latest('updated_at')
                                   ->get();
      return view('tables.pay_bill_numbers_table', compact('numbers'));
    }

    public function update(UpdatePayBillNumber $request, $id)
    {
      $number = \App\PayBillNumber::updateOrCreate(compact('id'), $request->all());
      $numbers = \App\PayBillNumber::latest('updated_at')
                                   ->get();
      return view('tables.pay_bill_numbers_table', compact('numbers'));
    }

    public function destroy($id)
    {
      \App\PayBillNumber::where('id', $id)->delete();
      $numbers = \App\PayBillNumber::latest('updated_at')
                                   ->get();
      return view('tables.pay_bill_numbers_table', compact('numbers'));
    }

}
