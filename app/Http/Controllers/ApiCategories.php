<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiCategories extends Controller
{
    public function categories()
    {
      return \App\Category::all(['id', 'name']);
    }
}
