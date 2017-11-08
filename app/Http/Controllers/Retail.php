<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Retail extends Controller
{  

    public function retail() {
      $retail =
          DB::table('price_lists')
            ->join('prices', 'price_lists.id', '=', 'prices.price_list_id')
            ->join('products', 'prices.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('price_lists.id', 'prices.price',
              'products.name as product_name', 'products.code', 'products.cc', 'products.image',
              'products.description', 'categories.name as cat_name')
            ->where('price_lists.name', '=', 'retail')
            ->get();

      $novus =
          DB::table('price_lists')
            ->join('prices', 'price_lists.id', '=', 'prices.price_list_id')
            ->join('products', 'prices.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('price_lists.id', 'prices.price',
              'products.name as product_name', 'products.code', 'products.cc', 'products.image',
              'products.description', 'categories.name as cat_name')
            ->where('price_lists.name', '=', 'novus')
            ->get();

      return response()->json(compact('retail', 'novus'), 200);
    }

}
