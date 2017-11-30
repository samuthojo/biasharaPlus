<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cms\AddPrice;
use App\Http\Requests\Cms\UpdatePrice;

class CmsPrices extends Controller
{
    public function update(UpdatePrice $request, $id)
    {
      $price = \App\Price::updateOrCreate(compact('id'), $request->all());

      $product = $price->product()->first();

      $prices = $product->prices()
                        ->latest('updated_at')
                        ->get()
                        ->map( function($price) {
                          $myPrice = $price;
                          $myPrice->pricelist_name =
                            $price->priceList()->first()->name;
                          return $myPrice;
                        });
      return view('tables.product_prices_table', compact('prices', 'product'));
    }

    public function prices()
    {
      $priceListNames = \App\PriceList::pluck('name');
      $prices = array();
      foreach ($priceListNames as $priceListName) {
        $prices[$priceListName] =
                  DB::table('prices')
                    ->join('price_lists', 'price_lists.id', '=', 'prices.price_list_id')
                    ->join('products', 'products.id', '=', 'prices.product_id')
                    ->where('price_lists.name', '=', $priceListName)
                    ->orderBy('id', 'asc')
                    ->select('prices.id', 'products.name as product_name')
                    ->get();
      }
      return compact('prices');
    }

    public function store(AddPrice $request)
    {
      $price = \App\Price::create($request->all());
      $price->pricelist_name = $price->priceList()->first()->name;
      //session(['message' => 'Price Added Successfully',]);
      return $price;
    }
}
