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

Route::resource('school', 'Admin\SchoolController');
Route::resource('course', 'Admin\CourseController');

/* Internal APIs - Select2 and Other Routes */
Route::group(['prefix' => 'api/v1'], function() {
    post('course', 'Admin\CourseController@index');
});
/* Internal APIs - Select2 and Other Routes */