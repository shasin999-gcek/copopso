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

class Person 
{
	
	function __construct($name, $age)
	{
		$this->name = $name;
		$this->age = $age;
	}
}


Route::get('/', function () {
    return view('form');
});

Route::get('/co-po-matrix', function () {
	return view('co_po_matrix');
});

Route::get('/test', function() {
   $random = str_random(6);
   dd($random);
  
});

