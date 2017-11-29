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

    $wholesale = array();

    //Price_list_names
    $leaveOut = ['retail', 'novus'];
    $priceListNames = \App\PriceList::whereNotIn('name', $leaveOut)
                                     ->pluck('name');

    switch($country) {
      case self::TANZANIA: {
        foreach ($priceListNames as $priceListName) {
          $wholesale[$priceListName] =
            DB::table('categories')
              ->join('products', 'categories.id', '=', 'products.category_id')
              ->join('prices', 'products.id', '=', 'prices.product_id')
              ->join('price_lists', 'prices.price_list_id', '=', 'price_lists.id')
              ->where('price_lists.name', $priceListName)
              ->select('products.id', 'prices.tanzania as price',
                'products.name as product_name', 'products.code', 'products.cc',
                'products.image', 'products.description',
                'categories.name as cat_name')
              ->get();
        }

        break;
      }
      case self::KENYA: {
        foreach ($priceListNames as $priceListName) {
          $wholesale[$priceListName] =
            DB::table('categories')
              ->join('products', 'categories.id', '=', 'products.category_id')
              ->join('prices', 'products.id', '=', 'prices.product_id')
              ->join('price_lists', 'prices.price_list_id', '=', 'price_lists.id')
              ->where('price_lists.name', $priceListName)
              ->select('products.id', 'prices.kenya as price',
                'products.name as product_name', 'products.code', 'products.cc',
                'products.image', 'products.description',
                'categories.name as cat_name')
              ->get();
        }
        break;
      }
      case self::UGANDA: {
        foreach ($priceListNames as $priceListName) {
          $wholesale[$priceListName] =
            DB::table('categories')
              ->join('products', 'categories.id', '=', 'products.category_id')
              ->join('prices', 'products.id', '=', 'prices.product_id')
              ->join('price_lists', 'prices.price_list_id', '=', 'price_lists.id')
              ->where('price_lists.name', $priceListName)
              ->select('products.id', 'prices.uganda as price',
                'products.name as product_name', 'products.code', 'products.cc',
                'products.image', 'products.description',
                'categories.name as cat_name')
              ->get();
        }
        break;
      }
    }

    return response()->json(compact('wholesale'), 200);
  }

}
