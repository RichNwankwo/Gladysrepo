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

Route::group(['prefix' => 'api/v1', 'middleware'=>'auth.basic'], function(){

    Route::get('fact/{id}/tag', 'TagController@index');
    Route::post('fact/{id}', 'FactController@update');
    Route::resource('no','NoController');
    Route::resource('fact', 'FactController');
    Route::resource('tag', 'TagController');
    Route::resource('answer', 'QuestionAnswerController');
    Route::resource('question', 'QuestionController');
    Route::get('user/{user_id}/fact',['middleware' => 'userResource', 'uses'=> 'FactController@index']);
    Route::post('user/{user_id}/fact',['middleware' => 'userResource', 'uses'=>  'FactController@store']);
    Route::resource('user', 'UserController');
    Route::post('user/{user_id}/fact/{fact_id}/tag',['middleware' => 'userResource', 'uses'=>  'TagFactController@store']);
    Route::delete('fact/{fact_id}/tag/{tag_id}',['middleware' => 'userResource', 'uses'=>  'TagFactController@destroy']);
    route::post('user/{user_id}/practice_session',['middleware' => 'userResource', 'uses'=>  'PracticeSessionController@store']);
    route::post('practice_material', 'PracticeMaterialController@store');
    Route::post('user/{user_id}/practice_session/{session_id}/material/{material_id}',
        ['middleware' => 'userResource', 'uses'=> 'PracticeMaterialController@store']);
    Route::get('user/{user_id}/practice_session/{session_id}/material/{material_id}',
        ['middleware' => 'userResource', 'uses'=> 'PracticeMaterialController@index']);


    
});

// userController

Route::get('/', function(){
   return view('app');
});

Route::get('login', function(){
    return view('login');
});


Route::group(['middleware'=>'auth.basic'], function(){

    Route::get('/gladys', function(){
        return view('gladys');
    });

    Route::get('gladys_learning', function(){
        return view('gladys_learning');
    });


});



Route::get('/test', function(){
    return view('test');
});




