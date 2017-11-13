<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PriceLists extends Controller
{

  public function priceList() {
    $price_list = \App\PriceList::all([
      'id', 'name', 'color', 'effective_date',
    ]);
    return response()->json(compact('price_list'), 200);
  }
}
