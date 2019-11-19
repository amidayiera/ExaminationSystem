<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Question;
use App\Unit;
use App\QuestionsOption;
use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreQuestionsRequest;
// use App\Http\Requests\UpdateQuestionsRequest;
// use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Http\Request;


class QuestionsController extends Controller
{
    // use FileUploadTrait;

    /**
     * Display a listing of Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating new Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $exams = Exam::all();
        $exams = Exam::get()->pluck('exam_title','exam_id');
        return view('questions.create', compact('exams'));
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            $question = Question::create($request->all());
            // $question->exams()->sync(array_filter((array)$request->input('exams')));

            for ($q=1; $q <= 4; $q++) {
                $option = $request->input('option_text_' . $q, '');
                if ($option != '') {
                    
                    QuestionsOption::create([
                        'question_id' => $question->question_id,
                        'option_text' => $option,
                        'correct' => $request->input('correct_' . $q)
                    ]);
                }
                // dd($option);
            }
            // dd($question);

            return redirect()->route('questions.index')->with('flash_message_success','Successfully Added');
        }
    }
    /**
     * Show the form for editing Question.
     *
     * @param  int  $question_id
     * @return \Illuminate\Http\Response
     */
    public function edit($question_id)
    {
        $question = Question::findOrFail($question_id);
        $exams = Exam::get()->pluck('exam_title','question_id');
        // $tests = \App\Test::get()->pluck('title', 'question_id');

        return view('questions.edit', compact('question', 'exams'));
    }

    /**
     * Update Question in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionsRequest  $request
     * @param  int  $question_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $question_id)
    {
        // $request = $this->saveFiles($request);
        $question = Question::findOrFail($question_id);
        $question->update($request->all());
        // $question->exams()->sync(array_filter((array)$request->input('exams')));
        return redirect()->route('questions.index');
    }


    /**
     * Display Question.
     *
     * @param  int  $question_id
     * @return \Illuminate\Http\Response
     */
    public function show($question_id)
    {
        $questions_options = QuestionsOption::where('question_id', $question_id)->get();
        $exams = Exam::whereHas('questions',
                    function ($query) use ($question_id) {
                        $query->where('question_id', $question_id);
                    })->get();
        $questions = Question::all();

        $question = Question::findOrFail($question_id);
        

        return view('questions.show', compact('question', 'questions_options', 'exams'));
    }

    public function perma_del($question_id)
    {
            $question = Question::onlyTrashed()->findOrFail($question_id);
        $question->forceDelete();

        return redirect()->route('questions.index');
    }
    public function destroy($question_id)
    {
        $question = Question::findOrFail($question_id);
        $question->delete();

        return redirect()->route('questions.index')->with('flash_message_success', 'Successfully Deleted!');
    }

}
