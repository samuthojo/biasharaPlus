<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiPayBillNumbers extends Controller
{
    public function payBillNumbers()
    {
      $payment = array();
      $payment["payBillNumbers"] = \App\PayBillNumber::all(['id', 'service_provider',
                                                 'phone_number', ]);

      $payment["bundles"] = $this->bundles();

      return compact('payment');
    }

    public function bundles()
    {
      return $bundles = \App\Bundle::all(['id', 'name', 'price', ]);
    }
}
