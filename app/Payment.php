<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', ];

    public function getDatePayedAttribute($value)
    {
      return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }
}
