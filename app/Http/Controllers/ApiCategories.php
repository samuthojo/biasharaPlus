<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiCategories extends Controller
{
    public function categories()
    {
      $categories = \App\Category::all(['id', 'name', ]);

      return compact('categories');
    }
}
