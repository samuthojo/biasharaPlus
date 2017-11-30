<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Cms\AddCategory;
use App\Http\Requests\Cms\EditCategory;
use App\Http\Controllers\Products;
use App\Http\Requests\Cms\AddCategoryProduct;
use App\Http\Requests\Cms\UpdateCategoryProduct;
use App\Events\CategoryDeleted;
use App\Events\ProductDeleted;

class Categories extends Controller
{
    public function index()
    {
      return view('categories', [
        'categories' => \App\Category::latest('updated_at')
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
      $category = \App\Category::find($id);
      $category->delete();

     //Dispatch event to softly delete all of this category's products
     event(new CategoryDeleted($category));

     $categories = \App\Category::latest('updated_at')
                                ->get();
     return view('tables.categories_table', compact('categories'));
    }

    public function products(\App\Category $category)
    {
      $products = $category->products()->latest('updated_at')->get();
      $categories = \App\Category::all();
      return view('category_products', compact('products', 'categories',
                                        'category'));
    }

    public function productPrices($categoryId, $productId)
    {
      $product = \App\Product::find($productId);
      $productsController = new Products();

      return view('product_prices', $productsController->pricesData($product));
    }

    public function addProduct(AddCategoryProduct $request, $categoryId) {

      $request->category_id = $categoryId;

      $productsController = new Products();
      $product = $productsController->saveProduct($request);

      $category = \App\Category::find($categoryId);
      $products = $category->products()->latest('updated_at')->get();

     return view('tables.category_products_table', compact('products', 'category'));
    }

    public function updateProduct(UpdateCategoryProduct $request,
                                    $categoryId, $productId)
    {
      $request->category_id = $categoryId;

      $productsController = new Products();
      $product = $productsController->updateProduct($request, $productId);

      $category = \App\Category::find($categoryId);
      $products = $category->products()->latest('updated_at')->get();

      return view('tables.category_products_table', compact('products', 'category'));
    }

    public function deleteProduct($categoryId, $productId)
    {
      $product = \App\Product::find($productId);
      $productsController = new Products();
      $productsController->deleteProduct($productId);

      //Dispatch event to softly delete all this product's prices
      event(new ProductDeleted($product));

      $category = \App\Category::find($categoryId);
      $products = $category->products()->latest('updated_at')->get();

      return view('tables.category_products_table', compact('products', 'category'));
    }
}
