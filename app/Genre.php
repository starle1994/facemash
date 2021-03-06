<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'genre';
    
    protected $fillable = ['name','image','url','ranking_img','talk_img'];
    

    public static function boot()
    {
        parent::boot();

        Genre::observe(new UserActionsObserver);
    }
    
    
    
    
}