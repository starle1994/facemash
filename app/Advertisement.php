<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'advertisement';
    
    protected $fillable = ['image','link','name','page','position'];
    

    public static function boot()
    {
        parent::boot();

        Advertisement::observe(new UserActionsObserver);
    }
    
    
    
    
}