<?php

namespace App\Repositories;
use App\Payment;
use Illuminate\Support\Facades\DB;

class PaymentRepository {
  
  /**
   * Returns Payments made in the past specified
   * number of days starting from today
   *
   * @param int $days
   * @return \Illuminate\Database\Eloquent\Collection 
   */
  public function paymentsInTheDays($days) {
    $today = Date('Y-m-d');
    $date_array = explode('-', $today);
    $today_secs = mktime(0, 0, 0, $date_array[1], $date_array[2], $date_array[0]);
    //Subtract six days or 29 days
    $secs = ($days == 7) ? $today_secs - (24*60*60*6) : $today_secs - (24*60*60*29);
    $end_date = Date("Y-m-d", $secs);
    $conditions = [
      ['date_payed', '<=', $today],
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
  
  /**
   * Returns Payments made in the specified month
   *
   * @param int $month
   * @return \Illuminate\Database\Eloquent\Collection 
   */
  private function paymentsInTheMonth($month) {
    $query = 'date_payed, sum(amount) as total, count(date_payed) as count';
    $payments = Payment::whereMonth('date_payed', (string)$month)
                       ->whereYear('date_payed', Date("Y"))
                       ->where('amount', '>', 0)
                       ->select(DB::raw($query))
                       ->groupBy('date_payed')
                       ->oldest('date_payed')->get();
    return $payments;
  }
}