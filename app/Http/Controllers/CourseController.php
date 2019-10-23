<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Symfony\Component\Console\Input\Input;
class CourseController extends Controller
{
    public function addCourse(Request $request) {
        if($request->isMethod('post')) {
            // $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $course  = new Course;
            $course->course_name = request('course_name');
            $course->save();
            return redirect('/courses/viewcourse')->with('flash_message_success','Course added successfully!');
        }
        return view('courses.addCourse');
    }
    public function viewCourses(){
        $course = Course::get();

        return view('courses.viewCourse')->with(compact('course'));
    }
}
