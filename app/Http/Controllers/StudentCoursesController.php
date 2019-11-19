<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class StudentCoursesController extends Controller
{

    public function show($course_id=null)
    {
        $courses = Course::all();
        $courses = Course::where('course_id', $course_id)->firstOrFail();

        return view('course', compact('courses'));
    }
}