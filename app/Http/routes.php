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
    return view('welcome');
});
/* Datatable Routes */
Route::group(['prefix' => 'datatables'], function() {
    post('school', 'Admin\SchoolController@datatables');
    
});
/* Datatable Routes */
Route::resource('school', 'Admin\SchoolController');
Route::resource('course', 'Admin\CourseController');