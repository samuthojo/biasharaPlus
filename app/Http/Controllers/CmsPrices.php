<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Cms\AddPrice;
use App\Http\Requests\Cms\UpdatePrice;

class CmsPrices extends Controller
{
    public function update(UpdatePrice $request, $id)
    {
      $price = \App\Price::updateOrCreate(compact('id'), $request->all());

      $product = $price->product()->first();

      $prices = $product->prices()
                        ->latest('created_at')
                        ->get()
                        ->map( function($price) {
                          $myPrice = $price;
                          $myPrice->pricelist_name =
                            $price->priceList()->first()->name;
                          return $myPrice;
                        });
      return view('tables.product_prices_table', compact('prices', 'product'));
    }

    public function store(AddPrice $request)
    {
      $price = \App\Price::create($request->all());
      $price->pricelist_name = $price->priceList()->first()->name;
      //session(['message' => 'Price Added Successfully',]);
      return $price;
    }
}
