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
// Route::get('/course', ['uses' => 'StudentCoursesController@show', 'as' => 'courses.show']);

Route::get('/course','StudentCoursesController@show');

Route::match(['get','post'], '/units/addunit', 'UnitsController@addUnit');
Route::match(['get','post'], '/units/editunit/{unit_id}', 'UnitsController@editUnit');
Route::match(['get','post'], '/units/deleteunit/{unit_id}', 'UnitsController@deleteUnit');

Route::get('/units/viewunit','UnitsController@viewUnits');
Route::get('/units/displayIndividual','UnitsController@displayIndividual');
Route::get('/units/{course_id}',['uses'=>'StudentUnitsController@show', 'as' => 'units.show']);
// Route::get('lesson/{course_id}/{slug}', ['uses' => 'LessonsController@show', 'as' => 'lessons.show']);


Route::match(['get','post'], '/exams/addexam', 'ExamsController@addExam');
Route::match(['get','post'], '/exams/editexam/{exam_id}', 'ExamsController@editExam');
Route::match(['get','post'], '/exams/deleteexam/{exam_id}', 'ExamsController@deleteExam');

Route::get('/exams/viewexam','ExamsController@viewExams');
Route::get('/exams/finallist','ExamsController@finalList');


Route::view('/admin', 'admin');
Route::view('/lecturer','lecturer');

Route::get('/home', 'HomeController@index')->name('home');

// Route::match(['get','post'], '/questions/create', 'QuestionsController@addQuestion');
// Route::match(['get','post'], '/questions/editquestion/{question_id}', 'QuestionsController@editQuestoin');
// Route::match(['get','post'], '/questions/deletequestion/{question_id}', 'QuestionsController@deleteQuestion');
// Route::get('/questions/viewquestion','QuestionsController@viewQuestions');

Route::resource('questions', 'QuestionsController');
Route::delete('questions_perma_del/{question_id}', ['uses' => 'QuestionsController@perma_del', 'as' => 'questions.perma_del']);



Route::resource('questions_options', 'QuestionsOptionsController');

Route::resource('tests', 'TestsController');