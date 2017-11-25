<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Cms\AddCategory;
use App\Http\Requests\Cms\EditCategory;

class Categories extends Controller
{
    public function index()
    {
      return view('categories', [
        'categories' => \App\Category::latest('created_at')
                                     ->where('status', true)
                                     ->get(),
      ]);
    }

    public function store(AddCategory $request)
    {
      $category = \App\Category::create($request->all());
      session(['message' => 'Category created successfully',]);
      return $category;
    }

    public function update(EditCategory $request, $id)
    {
      return \App\Category::updateOrCreate(compact('id'), ['name' => $request->name,]);
    }

    public function destroy($id)
    {
     $category = \App\Category::updateOrCreate(compact('id'), ['status' => false,]);
     $categories = \App\Category::latest('created_at')
                                ->where('status', true)
                                ->get();
     return view('categories_table', compact('categories'));
    }

    public function products(\App\Category $category)
    {
      $products = $category->products()->get();
      $categories = \App\Category::where('status', true)
                                 ->get();
      return view('category_products', compact('products', 'categories',
                                        'category'));
    }

    public function productPrices($categoryId, $productId)
    {
      $product = \App\Product::find($productId);
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
