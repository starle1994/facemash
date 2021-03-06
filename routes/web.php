<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', [
            'as' => 'index',
            'uses' => 'HomeController@toppages'
        ]);
Route::get('/genre/{id}', [
            'as' => 'genre.detail',
            'uses' => 'HomeController@index'
        ]);
Route::get('/get-random', [
            'as' => 'get.random',
            'uses' => 'HomeController@getRandom'
        ]);
Route::get('/get-time', [
            'as' => 'get.time',
            'uses' => 'HomeController@getTime'
        ]);
Route::get('/statistical', [
            'as' => 'statistical',
            'uses' => 'HomeController@statistical'
        ]);
Route::post('/test/add', [
            'as' => 'add',
            'uses' => 'HomeController@store'
        ]);
Route::get('/ajax', [
            'as' => 'ajax',
            'uses' => 'HomeController@ajax'
        ]);
Route::get('/genre', [
            'as' => 'genre',
            'uses' => 'HomeController@indexGenre'
        ]);
Route::get('/ranking', [
            'as' => 'ranking',
            'uses' => 'HomeController@ranking'
        ]);
Route::get('/ranking/detail/{id}', [
            'as' => 'ranking.detail',
            'uses' => 'HomeController@rankingDetail'
        ]);
Route::group([ 'middleware' => 'auth'], function () {
	Route::get(config('quickadmin.homeRoute'), 'QuickadminController@index');
    Route::group([ 'middleware' => 'role'], function () {
        
        // Menu routing
        Route::get(config('quickadmin.route') . '/menu', [
            'as' => 'menu',
            'uses' => 'QuickadminMenuController@index'
        ]);
        Route::post(config('quickadmin.route') . '/menu', [
            'as' => 'menu',
            'uses' => 'QuickadminMenuController@rearrange'
        ]);

        Route::get(config('quickadmin.route') . '/menu/edit/{id}', [
            'as' => 'menu.edit',
            'uses' => 'QuickadminMenuController@edit'
        ]);
        Route::post(config('quickadmin.route') . '/menu/edit/{id}', [
            'as' => 'menu.edit',
            'uses' => 'QuickadminMenuController@update'
        ]);

            Route::get(config('quickadmin.route') . '/menu/crud', [
                'as' => 'menu.crud',
                'uses' => 'QuickadminMenuController@createCrud'
            ]);
            Route::post(config('quickadmin.route') . '/menu/crud', [
                'as' => 'menu.crud.insert',
                'uses' => 'QuickadminMenuController@insertCrud'
            ]);

            Route::get(config('quickadmin.route') . '/menu/parent', [
                'as' => 'menu.parent',
                'uses' => 'QuickadminMenuController@createParent'
            ]);
            Route::post(config('quickadmin.route') . '/menu/parent', [
                'as' => 'menu.parent.insert',
                'uses' => 'QuickadminMenuController@insertParent'
            ]);

            Route::get(config('quickadmin.route') . '/menu/custom', [
                'as' => 'menu.custom',
                'uses' => 'QuickadminMenuController@createCustom'
            ]);
            Route::post(config('quickadmin.route') . '/menu/custom', [
                'as' => 'menu.custom.insert',
                'uses' => 'QuickadminMenuController@insertCustom'
            ]);

        Route::get(config('quickadmin.route') . '/actions', [
            'as' => 'actions',
            'uses' => 'UserActionsController@index'
        ]);
        Route::get(config('quickadmin.route') . '/actions/ajax', [
            'as' => 'actions.ajax',
            'uses' => 'UserActionsController@table'
        ]);
         Route::DELETE('delete/{id}', ['as' => 'admin.mesages.delete', 'uses' => 'Admin\MesagesController@destroy']);
         Route::get(config('quickadmin.route') . '/add/image/{id}', [
            'as' => 'admin.genre.add.image',
            'uses' => 'Admin\ImageGenreController@create'
        ]);
         Route::get(config('quickadmin.route') . '/imagegenre/{id}', [
            'as' => 'admin.imagegenre.image',
            'uses' => 'Admin\ImageGenreController@getImage'
        ]);
        Route::get(config('quickadmin.route') . '/statistical/{id}', [
            'as' => 'admin.statistical.getIndex',
            'uses' => 'Admin\StatisticalController@getIndex'
        ]);
        Route::get(config('quickadmin.route') . '/mesages/{id}', [
            'as' => 'admin.mesages.list',
            'uses' => 'Admin\MesagesController@getMessage'
        ]);
    });
});


// @todo move to default routes.php
Route::group([
    'middleware' => ['web']
], function () {
    // Point to App\Http\Controllers\UsersController as a resource
    Route::group([
        'middleware' => 'role'
    ], function () {
        Route::resource('users', 'UsersController');
        Route::resource('roles', 'RolesController');
    });
    Route::auth();
});


use Illuminate\Support\Facades\View;
use Laraveldaily\Quickadmin\Models\Menu;

if (Schema::hasTable('menus')) {
    $menus = Menu::with('children')->where('menu_type', '!=', 0)->orderBy('position')->get();
    View::share('menus', $menus);
    if (! empty($menus)) {
        Route::group([
            'middleware' => ['web', 'auth', 'role'],
            'prefix'     => config('quickadmin.route'),
            'as'         => config('quickadmin.route') . '.',
        ], function () use ($menus) {
            foreach ($menus as $menu) {
                switch ($menu->menu_type) {
                    case 1:
                        Route::post(strtolower($menu->name) . '/massDelete', [
                            'as'   => strtolower($menu->name) . '.massDelete',
                            'uses' => 'Admin\\' . ucfirst(camel_case($menu->name)) . 'Controller@massDelete'
                        ]);
                        Route::resource(strtolower($menu->name),
                            'Admin\\' . ucfirst(camel_case($menu->name)) . 'Controller', ['except' => 'show']);
                        break;
                    case 3:
                        Route::get(strtolower($menu->name), [
                            'as'   => strtolower($menu->name) . '.index',
                            'uses' => 'Admin\\' . ucfirst(camel_case($menu->name)) . 'Controller@index',
                        ]);
                        break;
                }
            }

        });
    }
}
Route::post('/login', ['as'=>'post.login','uses'=>'Auth\LoginController@login']);
//Route::get('imagestaff', ['as'=>'group-top','uses'=>'HomeController@index']);
