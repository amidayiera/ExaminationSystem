<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Question;
use App\Unit;
use App\QuestionsOption;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuestionsRequest;
use App\Http\Requests\Admin\UpdateQuestionsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
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

        if (request('show_deleted') == 1) {
          
            $questions = Question::onlyTrashed()->get();
        } else {
            $questions = Question::all();
        }

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating new Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exams = Exam::all();
        $exams = Exam::get()->pluck('unit_name','question_id');
        // $tests = \App\Test::get()->pluck('title', 'question_id');
        return view('questions.create', compact('exams'));
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionsRequest $request)
    {
        $exams = Exam::all();
        $exams = Exam::get()->pluck('unit_name','question_id');
        
        $request = $this->saveFiles($request);
        $question = Question::create($request->all());
        $question->exams()->sync(array_filter((array)$request->input('exams')));

        for ($q=1; $q <= 4; $q++) {
            $option = $request->input('option_text_' . $q, '');
            if ($option != '') {
                QuestionsOption::create([
                    'question_id' => $question->question_id,
                    'option_text' => $option,
                    'correct' => $request->input('correct_' . $q)
                ]);
            }
        }

        // $question->save();
        return redirect()->route('questions.index');
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
        $exams = Exam::get()->pluck('unit_name','question_id');
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
    public function update(UpdateQuestionsRequest $request, $question_id)
    {
        $request = $this->saveFiles($request);
        $question = Question::findOrFail($question_id);
        $question->update($request->all());
        $question->exams()->sync(array_filter((array)$request->input('exams')));



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

        $question = Question::findOrFail($question_id);

        return view('questions.show', compact('question', 'questions_options', 'exams'));
    }


    /**
     * Remove Question from storage.
     *
     * @param  int  $question_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($question_id)
    {
        $question = Question::findOrFail($question_id);
        $question->delete();

        return redirect()->route('questions.index');
    }

    /**
     * Delete all selected Question at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Question::whereIn('question_id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    // /**
    //  * Restore Question from storage.
    //  *
    //  * @param  int  $question_id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function restore($question_id)
    // {
    //     $question = Question::onlyTrashed()->findOrFail($question_id);
    //     $question->restore();

    //     return redirect()->route('questions.index');
    // }

    // /**
    //  * Permanently delete Question from storage.
    //  *
    //  * @param  int  $question_id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function perma_del($question_id)
    // {
    //     $question = Question::onlyTrashed()->findOrFail($question_id);
    //     $question->forceDelete();

    //     return redirect()->route('questions.index');
    // }
}
