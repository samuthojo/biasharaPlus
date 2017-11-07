<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
  use SoftDeletes;

  protected $guarded = ['id', ];

  public function product() {
    return $this->belongsTo('App\Product');
  }

  public function priceList() {
    return $this->belongsTo('App\PriceList');
  }
}
