<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CmsUsers extends Controller
{
  public function index()
  {
    return view('users', [
      'users' => \App\User::all(),
    ]);
  }
}
