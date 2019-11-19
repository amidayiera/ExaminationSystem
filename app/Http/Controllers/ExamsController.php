<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\Exam;
use App\Question;
use Session;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Validator;

class ExamsController extends Controller
{
    public function addExam(Request $request) {
        $units = Unit::all();
        if($request->isMethod('post')) {
            $info = $request->all();
            // echo "<pre>"; print_r($data); die;
            // dd($info);  
            $exam  = new Exam;
            $exam->unit_id = $request->unit_id;
            $exam->exam_title = $request->exam_title;
            $exam->save();
            
            return redirect('/exams/viewexam')->with('flash_message_success','Successfully Added');
        }
        return view('exams.addExam')->with(['units'=>$units]);
    }

    public function editExam(Request $request, $exam_id = null){
      $unit = Unit::all();
        if($request->isMethod('post')) {
            $data =$request->all();
            // echo "<pre> something something"; print_r($data);die;
            Exam::where(['exam_id'=>$exam_id])->update(['unit_id'=>$request['unit_id'],'exam_title'=>$request['exam_title']]);
            return redirect('/exams/viewexam')->with('flash_message_success','Exam Updated');
        }
        $examDetails = Exam::where(['exam_id'=>$exam_id])->first();
        return view('exams.editExam')->with(compact('examDetails','unit'));
    }

    public function deleteExam($exam_id=null){
        if(!empty($exam_id)){
            Exam::where(['exam_id'=>$exam_id])->delete();
            return redirect()->back()->with('flash_message_success', 'Exam Deleted Successfully!');
        }
    }

    public function viewExams(){
        $unit = Unit::all();
        $exams = Exam::all();
        $exams = Exam::with('unit')->get();
        
        // dd($exams);
        $exams = json_decode(json_encode($exams));

        return view('exams.viewExam')->with(compact('exams'));
    }

    public function finalList(){
        $unit = Unit::all();
        $questions = Question::all();
        $exams = Exam::all();
        $exams = Exam::with('unit','questions')->get();
        
        // dd($exams);
        $exams = json_decode(json_encode($exams));

        return view('exams.finalList')->with(compact('exams'));
    }
}
