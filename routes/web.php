
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

// Auth routes

Auth::routes();


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/logout', function() {
  Auth::logout();
  return redirect('/');
});


//__________________________________________

// load initial app
Route::get('/app/dashboard', 'HomeController@index')->middleware('auth');

//Route::get('/co/{id}', 'CoController@index')->middleware('auth');
//Route::get('/co/{id}/show', 'CoController@show')->middleware('auth');

//Route::get('/co/{id}/create', 'CoController@create')->middleware('auth');
Route::post('/co/{id}', 'CoController@store')->middleware('auth');

//Route::get('/co/{id}/edit', 'CoController@edit')->middleware('auth');
//Route::put('/co/{id}', 'CoController@update')->middleware('auth');

//Route::get('/co/{id}/createmap', 'CoPoPsoController@create')->middleware('auth');
Route::post('/co/{id}/storemap', 'CoPoPsoController@store')->middleware('auth');
//Route::get('/co/{id}/editmap', 'CoPoPsoController@edit')->middleware('auth');

Route::put('/co/{id}/updatemap', 'CoPoPsoController@update')->middleware('auth');

//Route::get('/co/{id}/po/{po_id}', 'JustificationsController@create')->middleware('auth');
Route::post('/co/{id}/storejust/{po_id}', 'JustificationsController@store')->middleware('auth');

Route::get('/co/{id}/weightage', 'WeightagesController@create')->middleware('auth');
Route::post('/co/{id}/weightage', 'WeightagesController@store')->middleware('auth');

Route::post('/upload', 'ResultExtracter@store')->middleware('auth');
Route::get('/api/admin/results', 'ResultExtracter@show')->middleware('auth');


// REST APIs
Route::get('/api/user', 'UserApiController@get_auth_user')->middleware('auth');
Route::get('/api/user/pos', 'UserApiController@get_program_outcomes')->middleware('auth');
Route::get('/api/user/courses', 'UserApiController@get_courses')->middleware('auth');
Route::get('/api/user/courses/{id}', 'UserApiController@get_user_course_map')->middleware('auth');
Route::get('/api/user/courses/{id}/copopso-map', 'UserApiController@get_copopso_map')->middleware('auth');
Route::get('/api/user/courses/{id}/copo-map/{po_id}', 'UserApiController@get_copo_map')->middleware('auth');

// catching all routes
Route::get('{any?}', function ($any = null) {
  if(Auth::check()) {
    return view('layouts.app');
  }
  abort(404);
})->where('any', '.*');

?>
