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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::prefix('lecturer')->group(function () {
    Route::get('lecturer/register', 'Auth\RegisterController@showLecturerRegisterForm');
    Route::post('lecturer/register', 'Auth\RegisterController@createLecturer');
    Route::get('lecturer/login', 'Auth\LoginController@showLecturerLoginForm')->name('lecturer.login');
    Route::post('lecturer/login', 'Auth\LoginController@lecturerLogin')->name('lecturer.login.submit');
    // Route::get('/index', 'LoginController@lecturerLogin');

    Route::match(['get','post'], '/courses/addcourse', 'CourseController@addCourse');
    Route::get('/courses/viewcourse','CourseController@viewCourses');
// });

Route::view('/lecturer', 'lecturer');

