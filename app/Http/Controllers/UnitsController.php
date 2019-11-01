<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Symfony\Component\Console\Input\Input;
use App\Course;

class UnitsController extends Controller
{
    public function addUnit(Request $request) {
        $courses = Course::all();
        
        if($request->isMethod('post')) {
            // $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $unit  = new Unit;
            $unit->course_id = request('course_id');
            $unit->unit_name = request('unit_name');
            $unit->unit_code = request('unit_code');
            // $courseBelongs = Course::all();
            $unit->save();
            return redirect('/units/viewunit')->with('flash_message_success','Unit Added successfully!');
        }
        // $levels = Course::where(['parent_id'=>0])->get();
        return view('units.addUnit')->with(compact('courses'));
    }

    public function editUnit(Request $request, $id = null){
        
        $courses = Course::all();
        if($request->isMethod('post')) {
            $data =$request->all();
            // echo "<pre> something something"; print_r($data);die;
            Unit::where(['id'=>$id])->update(['course_id'=>$request['course_id'],'unit_name'=>$request['unit_name'], 'unit_code'=>$request['unit_code']]);
            return redirect('/units/viewunit')->with('flash_message_success','Unit Updated');
        }
        $unitDetails = Unit::where(['id'=>$id])->first();
        return view('units.editUnit')->with(compact('unitDetails','courses'));
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

        $units = Unit::get();
        $units = json_decode(json_encode($units));

        return view('units.viewunit')->with(compact('units', 'courses'));
    }
}
