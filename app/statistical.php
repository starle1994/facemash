<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    protected $dates = ['deleted_at'];

    protected $table    = 'statistical';

    public $timestamps = false;

    protected $fillable = [
          'day',
          'month',
          'year',
          'numberleft',
          'numberright',
          'views',
          'timespent',
          'genre_id',
    ];
}
