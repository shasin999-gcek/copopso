<<<<<<< HEAD
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
Auth::routes();


Route::get('/', function () {
    return redirect('/login');
});


Route::get('/co', function () {
    return view('form');
})->middleware('auth');

Route::get('/copojust', function () {
    return view('co_po_matrix');
})->middleware('auth');

Route::post('/store', 'CoController@storecopo')->middleware('auth');

Route::post('/copojust', 'CoController@store')->middleware('auth');



Route::get('/test', function() {
   return view('test');
});

Route::get('/subjectform', function () {
	return view('subjectform');
});


