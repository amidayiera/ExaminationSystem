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

// Route::prefix('admin')->group(function () {
    Route::get('admin/register', 'Auth\RegisterController@showAdminRegisterForm');
    Route::post('admin/register', 'Auth\RegisterController@createAdmin');
    Route::get('admin/login', 'Auth\LoginController@showAdminLoginForm')->name('admin.login');
    Route::post('admin/login', 'Auth\LoginController@adminLogin')->name('admin.login.submit');
    // Route::get('/index', 'LoginController@adminLogin');

    Route::match(['get','post'], '/courses/addcourse', 'CourseController@addCourse');
    Route::get('/courses/viewcourse','CourseController@viewCourses');
// });

Route::view('/admin', 'admin');

Route::resource('viewCourses', 'CourseController');

