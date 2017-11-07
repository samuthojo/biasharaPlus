<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', ];

    public function category() {
      return $this->belongsTo('App\Category');
    }

    public function prices() {
      return $this->hasMany('App\Price');
    }
}
