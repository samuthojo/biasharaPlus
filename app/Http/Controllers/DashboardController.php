<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\PaymentRepository;
use League\Fractal\Resource\Collection;

class DashboardController extends Controller
{ 
  
  /**
   * The user repository instance.
   */
  protected $users;
  
  /**
   * The payment repository instance.
   */
  protected $payments;

  /**
   * Create a new controller instance.
   *
   * @param  UserRepository  $users
   * @param  PaymentRepository  $payments
   * @return void
   */
  public function __construct(UserRepository $users, 
                              PaymentRepository $payments)
  {
      $this->users = $users;
      $this->payments = $payments;
  }
  
  public function index()
  { 
    $users = $this->users->allUsers()->count();
    $android = $this->users->allUsers()->where('os_type', 0)->count();
    $ios = $this->users->allUsers()->where('os_type', 1)->count();
    return view('charts_dashboard', [
      'users' => $users,
      'android' => $android,
      'androidPercent' => (int)(round($android/$users * 100)),
      'ios' => $ios,
      'iosPercent' => (int)(round($ios/$users * 100)),
    ]);
  }
  
  public function accounts()
  {
    $free = $this->users->freeUsers()->count();
    $premium = $this->users->premiumUsers()->count();
    $total = $this->users->allUsers()->count();
    
    $accounts = [
      'free' => [
        'number' => $free, 
        'percent' => (int)(round($free/$total * 100))
      ],
      'premium' => [
        'number' => $premium, 
        'percent' => (int)(round($premium/$total * 100))
      ],
      'total' => $total,
    ];
    
    return compact('accounts');
  }
  
  public function users() 
  {
    $freeUsersByCountry = $this->users->freeUsersGroupedByCountry();
    $premiumUsersByCountry = $this->users->premiumUsersGroupedByCountry(); 
    
    $userAccounts = [
      'total' => $this->users->allUsers()->count(),
      'free' => $this->users->freeUsers()->count(),
      'premium' => $this->users->premiumUsers()->count(),
      'countries' => [
        'tanzania' => [
          'free' => $freeUsersByCountry->where('country', '0')->value('count'),
          'premium' => $premiumUsersByCountry->where('country', '0')->value('count'),
          'total' => $this->users->allUsers()->where('country', '0')->count(),
        ],
        'kenya' => [
          'free' => $freeUsersByCountry->where('country', '1')->value('count'),
          'premium' => $premiumUsersByCountry->where('country', '1')->value('count'),
          'total' => $this->users->allUsers()->where('country', '1')->count(),
        ],
        'uganda' => [
          'free' => $freeUsersByCountry->where('country', '2')->value('count'),
          'premium' => $premiumUsersByCountry->where('country', '2')->value('count'),
          'total' => $this->users->allUsers()->where('country', '2')->count(),
        ],
      ],
    ];
    
    return $userAccounts;
  }
  
  public function payments(Request $request)
  {
    if($request->has('days')) {
      return $this->payments->paymentsInTheDays($request->query('days'));
    }
    else if($request->has('month')) {
      return $this->payments->paymentsInTheMonth($request->query('month'));
    }
    //Default to return the payments for this week
    return $this->payments->paymentsInTheDays(7);
  }
  
}
