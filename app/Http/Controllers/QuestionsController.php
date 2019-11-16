<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Question;
use App\Unit;
use App\QuestionsOption;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionsRequest;
use App\Http\Requests\UpdateQuestionsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class QuestionsController extends Controller
{
    public function addQuestion(Request $request) {
 
        $exams = Exam::get()->pluck('exam_title','exam_id');
        if($request->isMethod('post')) {
            $info = $request->all();
            // dd($info);
        $question = Question::create($request->all());

            for ($q=1; $q <= 4; $q++) {
                $option = $request->input('option_text_' . $q, '');
                if ($option != '') {
                    QuestionsOption::create([
                        'exam_id'=>$question->exam_id,
                        'question_id' => $question->question_id,
                        'option_text' => $option,
                        'correct' => $request->input('correct_' . $q)
                    ]);
                }
            }
            return redirect()->route('questions.viewQuestion')->with('flash_message_success','Successfully Created');
        }            
        return view('questions.create')->with(['exams'=>$exams]);
    }

    // public function editExam(Request $request, $exam_id = null){
    //   $unit = Unit::all();
    //     if($request->isMethod('post')) {
    //         $data =$request->all();
    //         // echo "<pre> something something"; print_r($data);die;
    //         Exam::where(['exam_id'=>$exam_id])->update(['unit_id'=>$request['unit_id'],'exam_title'=>$request['exam_title']]);
    //         return redirect('/exams/viewexam')->with('flash_message_success','Exam Updated');
    //     }
    //     $examDetails = Exam::where(['exam_id'=>$exam_id])->first();
    //     return view('exams.editExam')->with(compact('examDetails','unit'));
    // }

    // public function deleteExam($exam_id=null){
    //     if(!empty($exam_id)){
    //         Exam::where(['exam_id'=>$exam_id])->delete();
    //         return redirect()->back()->with('flash_message_success', 'Exam Deleted Successfully!');
    //     }
    // }

    public function viewQuestions(){
        $units = Unit::all();
        $exams = Exam::all();

        $questions = Question::all();
        $questions = Question::with('unit','exam')->get();
        
        // dd($exams);
        $questions = json_decode(json_encode($questions));

        return view('questions.viewQuestion')->with(compact('exams','units'));
    }

    // use FileUploadTrait;

    /**
     * Display a listing of Question.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {

    //     $questions = Question::all();
    //     return view('questions.index', compact('questions'));
    // }

    // /**
    //  * Show the form for creating new Question.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     $exams = Exam::all();
    //     $exams = Exam::get()->pluck('exam_title','exam_id');
    //     // $tests = \App\Test::get()->pluck('title', 'question_id');
    //     return view('questions.create', compact('exams'));
    // }

    // /**
    //  * Store a newly created Question in storage.
    //  *
    //  * @param  \App\Http\Requests\StoreQuestionsRequest  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(StoreQuestionsRequest $request)
    // {
            
    //         $question = Question::create($request->all());
    //         // $question->tests()->sync(array_filter((array)$request->input('tests')));

    //         for ($q=1; $q <= 4; $q++) {
    //             $option = $request->input('option_text_' . $q, '');
    //             if ($option != '') {
    //                 QuestionsOption::create([
    //                     'question_id' => $question->id,
    //                     'option_text' => $option,
    //                     'correct' => $request->input('correct_' . $q)
    //                 ]);
    //             }
    //         }
    //         // $question->save();
    //         return redirect()->route('questions.index');
        
    // }

    // /**
    //  * Show the form for editing Question.
    //  *
    //  * @param  int  $question_id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($question_id)
    // {
    //     $question = Question::findOrFail($question_id);
    //     $exams = Exam::get()->pluck('exam_title','exam_id');
    //     // $tests = \App\Test::get()->pluck('title', 'question_id');

    //     return view('questions.edit', compact('question', 'exams'));
    // }

    // /**
    //  * Update Question in storage.
    //  *
    //  * @param  \App\Http\Requests\UpdateQuestionsRequest  $request
    //  * @param  int  $question_id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(UpdateQuestionsRequest $request, $question_id)
    // {
    //     $request = $this->saveFiles($request);
    //     $question = Question::findOrFail($question_id);
    //     $question->update($request->all());
    //     $question->exams()->sync(array_filter((array)$request->input('exams')));
    //     return redirect()->route('questions.index');
    // }


    // /**
    //  * Display Question.
    //  *
    //  * @param  int  $question_id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($question_id)
    // {

    //     $questions_options = QuestionsOption::where('question_id', $question_id)->get();
    //     $exams = Exam::whereHas('questions',
    //                 function ($query) use ($question_id) {
    //                     $query->where('question_id', $question_id);
    //                 })->get();

    //     $question = Question::findOrFail($question_id);

    //     return view('questions.show', compact('question', 'questions_options', 'exams'));
    // }


    // /**
    //  * Remove Question from storage.
    //  *
    //  * @param  int  $question_id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($question_id)
    // {
    //     $question = Question::findOrFail($question_id);
    //     $question->delete();

    //     return redirect()->route('questions.index');
    // }

    // /**
    //  * Delete all selected Question at once.
    //  *
    //  * @param Request $request
    //  */
    // public function massDestroy(Request $request)
    // {
    //     if ($request->input('ids')) {
    //         $entries = Question::whereIn('question_id', $request->input('ids'))->get();

    //         foreach ($entries as $entry) {
    //             $entry->delete();
    //         }
    //     }
    // }
}
