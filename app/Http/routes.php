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

Route::get('/noButton', function(){

});

Route::group(['prefix' => 'api/v1'], function(){

    Route::get('fact/{id}/tag', 'TagController@index');
    Route::resource('no','NoController');
    Route::resource('fact', 'FactController');
    Route::resource('tag', 'TagController');
    Route::resource('answer', 'QuestionAnswerController');
    Route::resource('question', 'QuestionController');
});

Route::get('/', function(){
   return view('app');
});



Route::get('/app', function(){
   return view('GladysApp');
});

Route::get('/test', function(){
    return view('test');
});



