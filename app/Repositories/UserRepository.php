<?php

namespace App\Repositories;
use App\User;
use Illuminate\Support\Facades\DB;

class UserRepository {
  
  /**
   * The conditions for retrieving a biasharaPlus 
   * subscriber.
   *
   * @var array
   */
   protected $conditions = [
     ['is_admin', '=', false], ['is_system', '=', false],
   ];
  
  /**
   * Queries for all biasharaPlus subscribers
   *
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function allUsers() {
    return User::where($this->conditions);
  }
  
  /**
   * Queries for all biasharaPlus free subscribers
   *
   * @return \Illuminate\Database\Eloquent\Builder
   */    
  public function freeUsers() {
    return User::where($this->conditions)
               ->where('subscription', 'free');
  }
  
  /**
   * Queries for all biasharaPlus premium subscribers
   *
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function premiumUsers() {
    return User::where($this->conditions)
               ->where('subscription', 'premium');
  }
  
  /**
   * Queries for all biasharaPlus free subscribers
   * and categorizes them by country
   *
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function freeUsersGroupedByCountry() {
    return $this->freeUsers()
                ->select(DB::raw('country, count(*) as count'))
                ->groupBy('country');
  }
  
  /**
   * Queries for all biasharaPlus premium subscribers
   * and categorizes them by country
   *
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function premiumUsersGroupedByCountry() {
    return $this->premiumUsers()
                ->select(DB::raw('country, count(*) as count'))
                ->groupBy('country');
  }
}