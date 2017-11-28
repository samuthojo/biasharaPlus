<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Cms\AttemptLogin;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function __invoke(AttemptLogin $request)
    {
      if(Auth::attempt($request->all())) {
        $request->session()->regenerate();
        return redirect()->route('home');
      }
    }
}
