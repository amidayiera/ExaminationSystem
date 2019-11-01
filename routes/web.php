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
Route::view('/','welcome');
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/register', 'Auth\RegisterController@showAdminRegisterForm');
Route::post('admin/register', 'Auth\RegisterController@createAdmin');
Route::get('admin/login', 'Auth\LoginController@showAdminLoginForm')->name('admin.login');
Route::post('admin/login', 'Auth\LoginController@adminLogin')->name('admin.login.submit');


Route::get('lecturer/register', 'Auth\RegisterController@showLecturerRegisterForm');
Route::post('lecturer/register', 'Auth\RegisterController@createLecturer');
Route::get('lecturer/login', 'Auth\LoginController@showLecturerLoginForm')->name('lecturer.login');
Route::post('lecturer/login', 'Auth\LoginController@lecturerLogin')->name('lecturer.login.submit');
// Route::get('/index', 'LoginController@adminLogin');

// Route::get('/courses/addcourse', function () {
    //     return 'Hello World';
    // });
Route::match(['get','post'], '/courses/addcourse', 'CoursesController@addCourse');
Route::match(['get','post'], '/courses/editcourse/{course_id}', 'CoursesController@editCourse');
Route::match(['get','post'], '/courses/deletecourse/{course_id}', 'CoursesController@deleteCourse');
Route::get('/courses/viewcourse','CoursesController@viewCourses');

Route::match(['get','post'], '/units/addunit', 'UnitsController@addUnit');
Route::match(['get','post'], '/units/assignlecturer', 'UnitsController@assignLecturer');
Route::match(['get','post'], '/units/editunit/{id}', 'UnitsController@editUnit');
Route::match(['get','post'], '/units/editlecturer/{id}', 'UnitsController@editLecturer');
Route::match(['get','post'], '/units/deleteunit/{id}', 'UnitsController@deleteUnit');
Route::match(['get','post'], '/units/deletelecturer/{id}', 'UnitsController@deleteLecturer');

Route::get('/units/viewlecturer','UnitsController@viewLecturers');
Route::get('/units/viewunit','UnitsController@viewUnits');

Route::view('/admin', 'admin');
Route::view('/lecturer','lecturer');

Route::get('/home', 'HomeController@index')->name('home');
