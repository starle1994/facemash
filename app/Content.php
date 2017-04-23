<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'content';
    
    protected $fillable = ['name','image','url'];
    

    public static function boot()
    {
        parent::boot();

        Content::observe(new UserActionsObserver);
    }
    
    
    
    
}