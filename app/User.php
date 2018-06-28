<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id',];
     
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * The conditions for retrieving a normal user.
     *
     * @var array
     */
     protected static $conditions = [
       ['is_admin', '=', false], ['is_system', '=', false],
     ];
     
    public function devices() {
      return $this->hasMany('App\UserDevice');
    }
    
    public static function allUsers() {
      return User::where(User::$conditions);
    }
        
    public static function freeUsers() {
      return User::where(User::$conditions)
                 ->where('subscription', 'free');
    }
    
    public static function premiumUsers() {
      return User::where(User::$conditions)
                 ->where('subscription', 'premium');
    }

    // public function feedbacks() {
    //   return $this->hasMany('App\Feedback');
    // }
}
