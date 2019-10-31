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
Route::get('admin/register', 'Auth\RegisterController@showAdminRegisterForm');
Route::post('admin/register', 'Auth\RegisterController@createAdmin');
Route::get('admin/login', 'Auth\LoginController@showAdminLoginForm')->name('admin.login');
Route::post('admin/login', 'Auth\LoginController@adminLogin')->name('admin.login.submit');
// Route::get('/index', 'LoginController@adminLogin');

// Route::get('/courses/addcourse', function () {
    //     return 'Hello World';
    // });
Route::match(['get','post'], '/courses/addcourse', 'CoursesController@addCourse');
Route::match(['get','post'], '/courses/editcourse/{course_id}', 'CoursesController@editCourse');
Route::match(['get','post'], '/courses/deletecourse/{course_id}', 'CoursesController@deleteCourse');
Route::get('/courses/viewcourse','CoursesController@viewCourses');

Route::match(['get','post'], '/units/addunit', 'UnitsController@addUnit');
Route::match(['get','post'], '/units/editunit/{id}', 'UnitsController@editUnit');
Route::match(['get','post'], '/units/deleteunit/{id}', 'UnitsController@deleteUnit');
Route::get('/units/viewunit','UnitsController@viewUnits');

// Route::get('/units/viewunit','UnitsController@index');

Route::resource('units','UnitsController');
Route::view('/admin', 'admin');
