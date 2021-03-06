<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'staff';
    
    protected $fillable = [
          'name',
          'image',
          'rating',
          'url'
    ];
    

    public static function boot()
    {
        parent::boot();

        Staff::observe(new UserActionsObserver);
    }
    
    
    
    
}