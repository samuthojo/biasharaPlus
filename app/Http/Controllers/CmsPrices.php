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
      $price->pricelist_name = $price->priceList()->first()->name;
      return $price;
    }

    public function store(AddPrice $request)
    {
      $price = \App\Price::create($request->all());
      $price->pricelist_name = $price->priceList()->first()->name;
      session(['message' => 'Price Added Successfully',]);
      return $price;
    }
}
