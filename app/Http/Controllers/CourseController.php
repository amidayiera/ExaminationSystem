<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Symfony\Component\Console\Input\Input;
// use DataTables;

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
    public function index(Request $request) {
        if($request->ajax()) {
            $data = viewCourses_data::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data) {
                        $button = '<button type = "button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button = '&nbsp; &nbsp; &nbsp;<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-primary btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('courses.viewCourse');
    }
}
