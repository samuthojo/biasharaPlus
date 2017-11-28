<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CmsUsers extends Controller
{
  public function index()
  {
    $total_accounts = \App\User::where('is_admin', false)
                               ->count();

    $free_accounts = \App\User::where('is_admin', false)
                              ->where('subscription', 'free')
                              ->count();
    $premium_accounts = \App\User::where('is_admin', false)
                                 ->where('subscription', 'premium')
                                 ->count();
    $users = \App\User::where('is_admin', false)->get();
    return view('users', compact('users', 'total_accounts',
                                 'free_accounts', 'premium_accounts'));
  }

  public function userPayments(\App\User $user)
  {
    $payments = \App\Payment::where('id', $user->id)->get();

    return view('user_payments', compact('user', 'payments'));
  }
}
