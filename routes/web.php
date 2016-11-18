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

Route::get('/','UserController@redirectAfterLogin');

Route::get('/test', 'UserController@getExcelContent');
Route::get('/test2', function() {
    //
    return view('pages.layout.nav-top-1');
});
Route::get('/test3', function() {
    //
    return view('giangvien');
});



// Route controllers
Auth::routes();

Route::get('/index', function(){
	return view('index');
});
Route::post('/uploadGV', 'Nhan_vien_khoaController@uploadGV');
Route::get('/getListGV','Nhan_vien_khoaController@getListGV');
Route::get('/getListBomon','Nhan_vien_khoaController@getListBomon');
Route::get('/addGV/{ma_giang_vien}/{ten_giang_vien}/{email}/{bomon}','Nhan_vien_khoaController@addGV');