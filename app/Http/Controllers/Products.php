<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Products extends Controller
{
    public function index()
    {
        $products = \App\Product::all()
                                  ->map( function($data) {
                                    $myProd = $data;
                                    $myProd->category =
                                              $data->category()->first()->name;
                                    return $myProd;
                                  });
        $categories = \App\Category::all();
      return view('products', compact('products', 'categories'));
    }
}
