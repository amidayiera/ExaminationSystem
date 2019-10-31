<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Symfony\Component\Console\Input\Input;
use App\Course;

class UnitsController extends Controller
{
    public function addUnit(Request $request) {
        if($request->isMethod('post')) {
            // $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $unit  = new Unit;
            $unit->unit_name = request('unit_name');
            $unit->unit_code = request('unit_code');
            // $courseBelongs = Course::all();
            $unit->save();
            return redirect('/units/viewunit')->with('flash_message_success','Unit Added successfully!');
        }
        // $levels = Course::where(['parent_id'=>0])->get();
        return view('units.addUnit');
    }

    public function editUnit(Request $request, $id = null){
        if($request->isMethod('post')) {
            $data =$request->all();
            // echo "<pre> something something"; print_r($data);die;
            Unit::where(['id'=>$id])->update(['unit_name'=>$request['unit_name'], 'unit_code'=>$request['unit_code']]);
            return redirect('/units/viewunit')->with('flash_message_success','Unit Updated');
        }
        $unitDetails = Unit::where(['id'=>$id])->first();
        return view('units.editUnit')->with(compact('unitDetails'));
    }

    public function deleteUnit($id=null){
        if(!empty($id)){
            Unit::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Unit Deleted Successfully!');
        }
    }

    public function viewUnits(){
        $units = Unit::get();
        $units = json_decode(json_encode($units));
        return view('units.viewunit')->with(compact('units'));
    }
}
