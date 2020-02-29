<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
| Rute: Option
| Deskripsi: Opsional
*/

$GLOBALS['admin_middleware'] = ['memma.auth', 'memma.admin'];
$GLOBALS['client_middleware'] = ['memma.auth', 'memma.client'];


Route::options('/{any:.*}', ['middleware' => 'cors', ],  function(){
    return response([
        "status" => "success"
    ]);
});

/**
 * API MEMMA V1
 */
// route name of application
Route::group(['prefix' => 'memma'], function () {
    // route name of app version
    Route::group(['prefix' => 'v1',], function () {
        // route name of app route base
        Route::group(['prefix' => 'app'], function () {
            Route::post('/register', 'ClientApp\AuthController@register');
            Route::post('/check', 'ClientApp\AuthController@checkRegistry');
        });

        Route::group(['prefix' => 'client'], function () {
            Route::get('/auth', 'ClientApp\AppController@appValidator');
            Route::get('/credential/check', 'ClientApp\AppController@checkValidator');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/profile', 'User\UserController@profile');
            Route::post('/signin/google', 'User\AuthController@signInWithGoogle');
            Route::post('/signup/google', 'User\AuthController@signUpWithGoogle');
            Route::post('/signin', 'User\AuthController@signIn');
            Route::post('/signup', 'User\AuthController@signUp');
        });
    });
});
