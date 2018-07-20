<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Payment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index()
  {
    return view('charts_dashboard');
  }
  
  public function accounts()
  {
    $free = User::freeUsers()->count();
    $premium = User::premiumUsers()->count();
    $total = User::allUsers()->count();
    
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
  
  public function payments(Request $request)
  {
    if($request->has('days')) {
      $days = $request->query('days');
      //Return the payments for this week or for this month
      return $this->paymentsForThisDays($days);
    }
    else if($request->has('month')) {
      $month = $request->query('month');
      //Return the payments for the specified month
      return $this->paymentsForTheMonth($month);
    }
    //Default to return the payments for this week
    return $this->paymentsForThisDays(7);
  }
  
  private function paymentsForThisDays($days) {
    //Start at today's date
    $start_date = Date('Y-m-d');
    $date_array = explode('-', $start_date);
    $today_secs = mktime(0, 0, 0, $date_array[1], $date_array[2], $date_array[0]);
    //Subtract six days or 30 days
    $secs = ($days == 7) ? $today_secs - (24*60*60*6) : $today_secs - (24*60*60*30);
    $end_date = Date("Y-m-d", $secs);
    $conditions = [
      ['date_payed', '<=', $start_date],
      ['date_payed', '>=', $end_date],
      ['amount', '>', 0],
    ];
    $query = 'date_payed, sum(amount) as total, count(date_payed) as count';
    $payments = Payment::where($conditions)
                       ->select(DB::raw($query))
                       ->groupBy('date_payed')
                       ->oldest('date_payed')->get();
    return $payments;
  }
  
  private function paymentsForTheMonth($month) {
    $query = 'date_payed, sum(amount) as total, count(date_payed) as count';
    $payments = Payment::whereMonth('date_payed', (string)$month)
                       ->whereYear('date_payed', Date("Y"))
                       ->where('amount', '>', 0)
                       ->select(DB::raw($query))
                       ->groupBy('date_payed')->get();
    return $payments;
  }
}
