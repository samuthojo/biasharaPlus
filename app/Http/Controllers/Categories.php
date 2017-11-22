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
      \App\Category::create($request->all());
      session([
        'message' => 'Category created successfully',
      ]);
      return 1;
    }

    public function update(EditCategory $request, $id)
    {
      return \App\Category::updateOrCreate(['id' => $id,],
                              ['name' => $request->name,]);
    }

    public function destroy($id)
    {
      \App\Category::where('id', $id)
                   ->update([
                     'status' => false,
                   ]);
     session([
       'message' => 'Category deleted successfully',
     ]);
     return 1;
    }

    public function products(\App\Category $category)
    {
      $products = $category->products()->get();
      $categories = \App\Category::where('status', true)
                                 ->get();
      return view('category_products', compact('products', 'categories',
                                        'category'));
    }
}
