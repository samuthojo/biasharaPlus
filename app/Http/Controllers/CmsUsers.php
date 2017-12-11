<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CmsUsers extends Controller
{
  public function index()
  {
    $tzCondition1 = [
      ['is_admin', '=', false], ['country', '=', 'Tanzania']
    ];

    $tzCondition2 = [
      ['is_admin', '=', false], ['country', '=', '0']
    ];

    $freeTzCondition1 = [
      ['is_admin', '=', false], ['country', '=', 'Tanzania'],
      ['subscription', '=', 'free']
    ];

    $freeTzCondition2 = [
      ['is_admin', '=', false], ['country', '=', '0'],
      ['subscription', '=', 'free']
    ];

    $freeKenyaCondition1 = [
      ['is_admin', '=', false], ['country', '=', 'Kenya'],
      ['subscription', '=', 'free']
    ];

    $freeKenyaCondition2 = [
      ['is_admin', '=', false], ['country', '=', '1'],
      ['subscription', '=', 'free']
    ];

    $freeUgandaCondition1 = [
      ['is_admin', '=', false], ['country', '=', 'Uganda'],
      ['subscription', '=', 'free']
    ];

    $freeUgandaCondition2 = [
      ['is_admin', '=', false], ['country', '=', '2'],
      ['subscription', '=', 'free']
    ];

    $premiumTzCondition1 = [
      ['is_admin', '=', false], ['country', '=', 'Tanzania'],
      ['subscription', '=', 'premium']
    ];

    $premiumTzCondition2 = [
      ['is_admin', '=', false], ['country', '=', '0'],
      ['subscription', '=', 'premium']
    ];

    $premiumKenyaCondition1 = [
      ['is_admin', '=', false], ['country', '=', 'Kenya'],
      ['subscription', '=', 'premium']
    ];

    $premiumKenyaCondition2 = [
      ['is_admin', '=', false], ['country', '=', '1'],
      ['subscription', '=', 'premium']
    ];

    $premiumUgandaCondition1 = [
      ['is_admin', '=', false], ['country', '=', 'Uganda'],
      ['subscription', '=', 'premium']
    ];

    $premiumUgandaCondition2 = [
      ['is_admin', '=', false], ['country', '=', '2'],
      ['subscription', '=', 'premium']
    ];

    $kenyaCondition1 = [
      ['is_admin', '=', false], ['country', '=', 'Kenya']
    ];

    $kenyaCondition2 = [
      ['is_admin', '=', false], ['country', '=', '1']
    ];

    $ugandaCondition1 = [
      ['is_admin', '=', false], ['country', '=', 'Uganda']
    ];

    $ugandaCondition2 = [
      ['is_admin', '=', false], ['country', '=', '2']
    ];

    $total_accounts = \App\User::where('is_admin', false)
                               ->count();

    $tz_accounts = \App\User::where($tzCondition1)
                            ->orWhere($tzCondition2)
                            ->count();

    $kenya_accounts = \App\User::where($kenyaCondition1)
                               ->orWhere($kenyaCondition2)
                               ->count();

    $uganda_accounts = \App\User::where($ugandaCondition1)
                                ->orWhere($ugandaCondition2)
                                ->count();

    $free_accounts = \App\User::where('is_admin', false)
                              ->where('subscription', 'free')
                              ->count();

    $free_tz_accounts = \App\User::where($freeTzCondition1)
                                 ->orWhere($freeTzCondition2)
                                 ->count();

    $free_kenya_accounts = \App\User::where($freeKenyaCondition1)
                                    ->orWhere($freeKenyaCondition2)
                                    ->count();

    $free_uganda_accounts = \App\User::where($freeUgandaCondition1)
                                     ->orWhere($freeUgandaCondition2)
                                     ->count();

    $premium_accounts = \App\User::where('is_admin', false)
                                 ->where('subscription', 'premium')
                                 ->count();

    $premium_tz_accounts = \App\User::where($premiumTzCondition1)
                                    ->orWhere($premiumTzCondition2)
                                    ->count();

    $premium_kenya_accounts = \App\User::where($premiumKenyaCondition1)
                                       ->orWhere($premiumKenyaCondition2)
                                       ->count();

    $premium_uganda_accounts = \App\User::where($premiumUgandaCondition1)
                                        ->orWhere($premiumUgandaCondition2)
                                        ->count();

    $users = \App\User::where('is_admin', false)
                      ->latest('updated_at')
                      ->get();
                      
    return view('users', compact('users', 'total_accounts', 'tz_accounts',
                                  'kenya_accounts', 'uganda_accounts',
                                 'free_accounts', 'free_tz_accounts',
                                 'free_kenya_accounts', 'free_uganda_accounts',
                                 'premium_accounts', 'premium_tz_accounts',
                                 'premium_kenya_accounts', 'premium_uganda_accounts'
                               ));
  }

  public function userPayments(\App\User $user)
  {
    $payments = \App\Payment::where('user_id', $user->id)
                            ->latest('updated_at')
                            ->get();

    return view('user_payments', compact('user', 'payments'));
  }

  public function users()
  {
    return $users = \App\User::where('is_admin', false)
                             ->where('is_system', false)
                             ->get(['id', 'username', 'subscription',
                                    'is_admin']);
  }
}
