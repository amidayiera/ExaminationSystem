<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Unit;
use Symfony\Component\Console\Input\Input;
// use DataTables;

class CoursesController extends Controller
{
    public function addCourse(Request $request) {
        // echo "add course function";
        // $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        // return view('courses.addCourse');
        if($request->isMethod('post')) {
            $course  = new Course;
            $course->course_name = request('course_name');
            $course->course_code = request('course_code');
            $course->save();
            return redirect('/courses/viewcourse')->with('flash_message_success','Course Added successfully!');
        }
        // $levels = Course::where(['parent_id'=>0])->get();

        return view('courses.addCourse');
    }

    public function editCourse(Request $request, $course_id = null){
        if($request->isMethod('post')) {
            $data =$request->all();
            // echo "<pre> something something"; print_r($data);die;
            Course::where(['course_id'=>$course_id])->update(['course_name'=>$request['course_name'], 'course_code'=>$request['course_code']]);
            return redirect('/courses/viewcourse')->with('flash_message_success','Course Updated');
        }
        $courseDetails = Course::where(['course_id'=>$course_id])->first();
        return view('courses.editCourse')->with(compact('courseDetails'));
    }

    public function deleteCourse($course_id=null){
        if(!empty($course_id)){
            Course::where(['course_id'=>$course_id])->delete();
            return redirect()->back()->with('flash_message_success', 'Course Deleted Successfully!');
        }
    }
    public function viewCourses(){
        $courses = Course::get();
        $courses = json_decode(json_encode($courses));
        return view('courses.viewCourse')->with(compact('courses'));
    }
    public function display($course_id=null)
    {
        $courses = Course::all();
        $courses = Course::where('course_id', $course_id)->firstOrFail();

        return view('course', compact('courses'));
    }
}
