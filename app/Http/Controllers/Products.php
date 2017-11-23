<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Cms\AddProduct;
use App\Http\Requests\Cms\EditProduct;
use App\Utils\Utils;

class Products extends Controller
{
    private $images = 'uploads/products/';

    public function index()
    {
        $products = \App\Product::latest('created_at')
                                ->where('status', true)
                                ->get()
                                ->map( function($prod) {
                                  $myProd = $prod;
                                  $myProd->category_name =
                                            $prod->category()->first()->name;
                                  return $myProd;
                                });
        $categories = \App\Category::all();
      return view('products', compact('products', 'categories'));
    }

    public function productDetails(\App\Product $product)
    {
      $product->category_name = $product->category()->first()->name;

      return $product;
    }

    public function store(AddProduct $request)
    {
      $product = null;
      if($request->hasFile('image')) {
        $imageUrl = Utils::handleImage($request->file('image'), $this->images);
        $product = $this->saveProductWithImage($imageUrl, $request);
      } else {
        $product = \App\Product::create($request->all());
      }

      session(['message' => 'Product added successfully',]);

      $product->category_name = $product->category()->first()->name;

      return $product;
    }

    private function saveProductWithImage($imageUrl, $request)
    {
      $data = $request->except('image');
      $data = array_add($data, 'image', $imageUrl);
      $product =  \App\Product::create($data);

      $product->category_name = $product->category()->first()->name;

      return $product;
    }

    private function updateProductWithImage($imageUrl, $request, $id)
    {
      $data = $request->except('image');
      $data = array_add($data, 'image', $imageUrl);
      $product =  \App\Product::updateOrCreate(compact('id'), $data);

      $product->category_name = $product->category()->first()->name;

      return $product;
    }

    public function update(EditProduct $request, $id)
    {
      $product = null;
      if($request->hasFile('image')) {
        $imageUrl = Utils::handleImage($request->file('image'), $this->images);
        $product = $this->updateProductWithImage($imageUrl, $request, $id);
      } else {
        $product = \App\Product::updateOrCreate(compact('id'), $request->all());
      }

      session(['message' => 'Product updated successfully',]);

      $product->category_name = $product->category()->first()->name;

      return $product;
    }

    public function destroy($id)
    {
      $product = \App\Product::updateOrCreate(compact('id'), ['status' => false,]);
      session(['message' => 'Product deleted successfully',]);

      $product->category_name = $product->category()->first()->name;

      return $product;
    }

    public function prices(\App\Product $product)
    {
      $prices = $product->prices()->get()
                                  ->map( function($price) {
                                    $myPrice = $price;
                                    $myPrice->pricelist_name =
                                            $price->priceList()->first()->name;
                                    return $myPrice;
                                  });
      $pricelists = \App\PriceList::latest('created_at')
                                  ->where('status', true)
                                  ->get();
      return view('product_prices', compact('prices', 'pricelists', 'product'));
    }
}
