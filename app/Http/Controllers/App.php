<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class App extends Controller
{
    public function __invoke()
    {
      $bundles = \App\Bundle::all();
      $payBillNumbers = \App\PayBillNumber::all();
      $countries = \App\Country::all();
      $version = \App\Version::where('status', true)
                             ->first(['id', 'version_number', 'features']);

      return compact('bundles', 'payBillNumbers', 'countries', 'version');
    }
}
