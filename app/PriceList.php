<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceList extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', ];

    public function prices() {
      return $this->hasMany('App\Price');
    }
}
