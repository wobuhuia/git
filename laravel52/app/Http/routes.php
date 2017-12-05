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

Route::get('/', function () {
    return view('students.login');
});
Route::post('add','StudentsController@add');
Route::post('login','StudentsController@login');
Route::post('save_act','StudentsController@save_act');
Route::get('del/{id}','StudentsController@del');
Route::get('show','StudentsController@show');
Route::get('save/{id}','StudentsController@save');

Route::get('Redis/index',function(){
	return view('redis.login');
});
Route::get('Redis/add',function(){
	return view('redis.add');
});
Route::post('Redis/add','RedisController@add');
Route::post('Redis/login','RedisController@login');

/*Route::get('about','PagesController@home');
Route::get('/','PagesController@about');*/
/*Route::post()     //  对应http的post
Route::put()      //  对应http的putRoute::patch()   //   ttp的patchRoute::delete()  //   对应http的delete*/