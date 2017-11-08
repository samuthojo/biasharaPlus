<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WholeSale extends Controller
{

  public function wholesale() {

    $selectedNames = [
      'asst_spvsr', 'spvsr', 'asst_man', 'man'
    ];

    $wholesale =
      DB::table('categories')
        ->join('products', 'categories.id', '=', 'products.category_id')
        ->join('prices', 'products.id', '=', 'prices.product_id')
        ->join('price_lists', 'prices.price_list_id', '=', 'price_lists.id')
        ->select('price_lists.name', 'prices.price', 'products.id',
          'products.name as product_name', 'products.code', 'products.cc', 'products.image',
          'products.description', 'categories.name as cat_name')
        ->whereIn('price_lists.name', $selectedNames)
        ->get();

    return response()->json(compact('wholesale'), 200);
  }

}
