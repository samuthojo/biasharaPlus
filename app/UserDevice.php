<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDevice extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', ];

    public function user() {
      return $this->belongsTo('App\User');
    }
}
