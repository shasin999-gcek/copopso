
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

Route::get('/subjectform', function () {
    return view('subjectform');
});

Route::get('/home', 'HomeController@index')->middleware('auth');

Route::get('/co/{id}', 'CoController@index')->middleware('auth');
Route::get('/co/create/{id}', 'CoController@create')->middleware('auth');
Route::post('/co/{id}', 'CoController@store')->middleware('auth');

Route::get('/co/popso/create/{id}', 'CoPoPsoController@create')->middleware('auth');
Route::post('/co/popso/{id}', 'CoPoPsoController@store')->middleware('auth');

Route::get('/co/po/{id}/{po_id}', 'JustificationsController@create')->middleware('auth');
Route::post('/co/storejust/{id}/{po_id}', 'JustificationsController@store')->middleware('auth');

Route::get('/co/{id}/weightage', 'WeightagesController@create')->middleware('auth');
Route::post('/co/{id}/weightage', 'WeightagesController@store')->middleware('auth');

Route::get ('upload', 'MarksController@showForm')->middleware('auth');
Route::post('upload', 'MarksController@store')->middleware('auth');

?>