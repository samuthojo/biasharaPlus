<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WholeSale extends Controller
{
  const TANZANIA = 0;

  const KENYA = 1;

  const UGANDA = 2;

  public function __invoke($country) {

    $wholesale = null;

    $selectedNames = [
      'asst_spvsr', 'spvsr', 'asst_man', 'man'
    ];

    $wholesaleQuery =
      DB::table('categories')
        ->join('products', 'categories.id', '=', 'products.category_id')
        ->join('prices', 'products.id', '=', 'prices.product_id')
        ->join('price_lists', 'prices.price_list_id', '=', 'price_lists.id')
        ->whereIn('price_lists.name', $selectedNames)
        ->select('price_lists.name', 'prices.price', 'products.id',
          'products.name as product_name', 'products.code', 'products.cc',
          'products.image', 'products.description',
          'categories.name as cat_name');

    switch($country) {
      case self::TANZANIA: {
        $wholesale = $wholesaleQuery->addSelect('prices.tanzania as price')->get();
        break;
      }
      case self::KENYA: {
        $wholesale = $wholesaleQuery->addSelect('prices.kenya as price')->get();
        break;
      }
      case self::UGANDA: {
        $wholesale = $wholesaleQuery->addSelect('prices.uganda as price')->get();
        break;
      }
    }

    return response()->json(compact('wholesale'), 200);
  }

}
