<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CmsPriceLists extends Controller
{
    public function index()
    {
      return view('priceLists', [
        'priceLists' => \App\PriceList::all(),
      ]);
    }
}
