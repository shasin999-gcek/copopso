<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('form');
});

Route::post('/store', 'CoController@storecopo');

Route::post('/copojust', 'CoController@store');

Route::get('/copojust', function () {
    return view('co_po_matrix');
});

Route::get('/test', function() {
   return view('test');
});