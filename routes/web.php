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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', 'UserController@getExcelContent');
Route::get('/test2', function() {
    //
    return view('pages.layout.nav-top-1');
});
Route::get('/test3', function() {
    //
    return view('pages.forms.general');
});



// Route controllers
Auth::routes();

Route::get('/home', 'HomeController@index');
