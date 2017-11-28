<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Cms\UpdateBundle;

class Bundles extends Controller
{
    public function index()
    {
      $bundles = \App\Bundle::latest('created_at')->get();
      return view('bundles', compact('bundles'));
    }

    public function update(UpdateBundle $request, $id)
    {
      \App\Bundle::updateOrCreate(compact('id'), $request->all());
      $bundles = \App\Bundle::latest('created_at')->get();
      return view('tables.bundles_table', compact('bundles'));
    }
}
