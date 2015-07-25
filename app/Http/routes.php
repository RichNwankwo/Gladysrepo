<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/noButton', function(){

});

Route::group(['prefix' => 'api/v1'], function(){

    Route::get('fact/{id}/tag', 'TagController@index');
    Route::resource('no','NoController');
    Route::resource('fact', 'FactController');
    Route::resource('tag', 'TagController');
});

route::get('/facts', function(){
   return view('practice.factHome');
});

route::get('/', function(){
//    return "Laravel 5";
   return view('home');
});

