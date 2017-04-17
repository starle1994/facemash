<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class ImageGenre extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'imagegenre';
    
    protected $fillable = [
          'genre_id',
          'image',
          'rating',
          'name',
          'url'
    ];
    

    public static function boot()
    {
        parent::boot();

        ImageGenre::observe(new UserActionsObserver);
    }
    
    public function genre()
    {
        return $this->hasOne('App\Genre', 'id', 'genre_id');
    }


    
    
    
}