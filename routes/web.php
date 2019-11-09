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
Route::match(['get','post'], '/units/editunit/{id}', 'UnitsController@editUnit');
Route::match(['get','post'], '/units/deleteunit/{id}', 'UnitsController@deleteUnit');

Route::get('/units/viewunit','UnitsController@viewUnits');
Route::get('/units/displayIndividual','UnitsController@displayIndividual');

Route::view('/admin', 'admin');
Route::view('/lecturer','lecturer');

Route::get('/home', 'HomeController@index')->name('home');
// Route::view('/questions','questions.create');
// Route::resource('questions','QuestionsController');
Route::match(['get','post'], '/questions/create', 'QuestionsController@create');

Route::resource('questions', 'QuestionsController');
Route::post('questions_mass_destroy', ['uses' => 'QuestionsController@massDestroy', 'as' => 'questions.mass_destroy']);
Route::post('questions_restore/{id}', ['uses' => 'QuestionsController@restore', 'as' => 'questions.restore']);
Route::delete('questions_perma_del/{id}', ['uses' => 'QuestionsController@perma_del', 'as' => 'questions.perma_del']);


Route::resource('questions_options', 'QuestionsOptionsController');
Route::post('questions_options_mass_destroy', ['uses' => 'QuestionsOptionsController@massDestroy', 'as' => 'questions_options.mass_destroy']);
Route::post('questions_options_restore/{id}', ['uses' => 'QuestionsOptionsController@restore', 'as' => 'questions_options.restore']);
Route::delete('questions_options_perma_del/{id}', ['uses' => 'QuestionsOptionsController@perma_del', 'as' => 'questions_options.perma_del']);

Route::resource('tests', 'TestsController');
Route::post('tests_mass_destroy', ['uses' => 'TestsController@massDestroy', 'as' => 'tests.mass_destroy']);
Route::post('tests_restore/{id}', ['uses' => 'TestsController@restore', 'as' => 'tests.restore']);
Route::delete('tests_perma_del/{id}', ['uses' => 'TestsController@perma_del', 'as' => 'tests.perma_del']);
Route::post('/spatie/media/upload', 'SpatieMediaController@create')->name('media.upload');
Route::post('/spatie/media/remove', 'SpatieMediaController@destroy')->name('media.remove');