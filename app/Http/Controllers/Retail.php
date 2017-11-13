<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Retail extends Controller
{
    const TANZANIA = 0;

    const KENYA = 1;

    const UGANDA = 2;

    public function retail($country) {
      $retail = $novus = null;

      $retailQuery =
          DB::table('price_lists')
            ->join('prices', 'price_lists.id', '=', 'prices.price_list_id')
            ->join('products', 'prices.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('price_lists.name', '=', 'retail')
            ->select('price_lists.id', 'products.name as product_name',
              'products.code', 'products.cc', 'products.image',
              'products.description', 'categories.name as cat_name');

      $novusQuery =
          DB::table('price_lists')
            ->join('prices', 'price_lists.id', '=', 'prices.price_list_id')
            ->join('products', 'prices.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('price_lists.name', '=', 'novus')
            ->select('price_lists.id',
              'products.name as product_name', 'products.code', 'products.cc',
              'products.image', 'products.description',
              'categories.name as cat_name');

      switch($country) {
        case self::TANZANIA: {
          $retail = $retailQuery->addSelect('prices.tanzania as price')->get();
          $novus = $novusQuery->addSelect('prices.tanzania as price')->get();
          break;
        }
        case self::KENYA: {
          $retail = $retailQuery->addSelect('prices.kenya as price')->get();
          $novus = $novusQuery->addSelect('prices.kenya as price')->get();
          break;
        }
        case self::UGANDA: {
          $retail = $retailQuery->addSelect('prices.uganda as price')->get();
          $novus = $novusQuery->addSelect('prices.uganda as price')->get();
          break;
        }
      }

      return response()->json(compact('retail', 'novus'), 200);
    }

}
