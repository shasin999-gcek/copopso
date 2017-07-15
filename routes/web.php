
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

// load initial app
Route::get('/home', 'HomeController@index')->middleware('auth');

Route::get('/co/{id}', 'CoController@index')->middleware('auth');
Route::get('/co/create/{id}', 'CoController@create')->middleware('auth');
Route::post('/co/{id}', 'CoController@store')->middleware('auth');

Route::get('/co/popso/create/{id}', 'CoController@createpopso')->middleware('auth');
Route::post('/co/popso/{id}', 'CoController@storepopso')->middleware('auth');

Route::get('/co/po/{id}/{po_id}', 'CoController@view')->middleware('auth');
Route::post('/co/storejust/{id}/{po_id}', 'CoController@storejust')->middleware('auth');

Route::get('/co/{id}/weightage', 'CoController@createweightage')->middleware('auth');
Route::post('/co/{id}/weightage', 'CoController@storeweightage')->middleware('auth');

Route::get ('upload', 'MarksController@showForm')->middleware('auth');
Route::post('upload', 'MarksController@store')->middleware('auth');


// REST APIs
Route::get('/users/api/getUserData', 'HomeController@get_auth_user')->middleware('auth');
Route::get('/users/api/getUserCourseData', 'HomeController@get_user_course_list')->middleware('auth');


?>
