<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\Lecturer;
use Session;
use Symfony\Component\Console\Input\Input;
use App\Course;
use Illuminate\Support\Facades\Validator;

class UnitsController extends Controller
{
    public function addUnit(Request $request) {
        $courses = Course::all();
        $lecturers = Lecturer::all();

        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            // dd($data);
            // $validator = Validator::make($data, [
            //     'course_id'=>'required',
            //     'unit_name'=>'required',
            //     'unit_code'=>'required',
            //     'lecturer_id'=>'required'
            // ]);

            // if ($validator->fails()) {
            // Session::flash('error', $validator->messages()->first());
            // return redirect()->back()->withInput();
            // }
        //    dd($data);
    // Retrieve the validated input data...
        // $validated = $request->validated();
            $unit  = new Unit;
            $unit->course_id = request('course_id');
            $unit->unit_name = request('unit_name');
            $unit->unit_code = request('unit_code');
            $unit->lecturer_id = request('lecturer_id');
            $unit->save();
            
            return redirect('/units/viewunit')->with('flash_message_success','Successfully Added');
        }
        // $levels = Course::where(['parent_id'=>0])->get();
        return view('units.addUnit')->with(compact('courses','lecturers'));
    }

    public function editUnit(Request $request, $id = null){
        $lecturers = Lecturer::all();
        $courses = Course::all();
        if($request->isMethod('post')) {
            $data =$request->all();
            // echo "<pre> something something"; print_r($data);die;
            Unit::where(['id'=>$id])->update(['course_id'=>$request['course_id'],'unit_name'=>$request['unit_name'], 'unit_code'=>$request['unit_code'],'lecturer_id'=>$request['lecturer_id']]);
            return redirect('/units/viewunit')->with('flash_message_success','Unit Updated');
        }
        $unitDetails = Unit::where(['id'=>$id])->first();
        return view('units.editUnit')->with(compact('unitDetails','courses','lecturers'));
    }

    public function deleteUnit($id=null){
        if(!empty($id)){
            Unit::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Unit Deleted Successfully!');
        }
    }

    public function viewUnits(){
        $courses = Course::get();
        $courses = json_decode(json_encode($courses));

        $lecturers = Lecturer::get();
        $lecturers = json_decode(json_encode($lecturers));

        $units = Unit::get();
        $units = json_decode(json_encode($units));

        return view('units.viewUnit')->with(compact('units', 'courses','lecturers'));
    }
}
