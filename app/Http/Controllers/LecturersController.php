<?php

namespace App\Http\Controllers;
use App\Unit;
use Illuminate\Http\Request;

class LecturersController extends Controller
{
    public function addLecturer(Request $request) {
        $units = Unit::all();
        
        if($request->isMethod('post')) {
            // $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $lecturer  = new Lecturer;
            $lecturer->unit_name = request('unit_name');
            $lecturer->unit_code = request('unit_code');
            // $courseBelongs = Course::all();
            $lecturer->save();
            return redirect('/lecturers/viewlecturer')->with('flash_message_success','Unit Added successfully!');
        }
        // $levels = Course::where(['parent_id'=>0])->get();
        return view('lecturers.addLEcturer')->with(compact('courses'));
    }

    public function editLecturer(Request $request, $id = null){
        
        $units = Unit::all();
        if($request->isMethod('post')) {
            $data =$request->all();
            // echo "<pre> something something"; print_r($data);die;
            Lecturer::where(['id'=>$id])->update(['course_id'=>$request['course_id'],'unit_name'=>$request['unit_name'], 'unit_code'=>$request['unit_code']]);
            return redirect('/lecturers/viewlecturer')->with('flash_message_success','Unit Updated');
        }
        $lecturerDetails = Lecturer::where(['id'=>$id])->first();
        return view('lecturers.editLecturer')->with(compact('lecturerDetails','units'));
    }

    public function deleteLecturer($id=null){
        if(!empty($id)){
            Lectuer::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Unit Deleted Successfully!');
        }
    }

    public function viewLecturers(){
        $units = Unit::get();
        $units = json_decode(json_encode($units));

        $lecturers = Lecturer::get();
        $lecturers = json_decode(json_encode($lecturers));

        return view('lecturers.viewlecturer')->with(compact('lecturers', 'units'));
    }
}
