<?php

namespace App\Http\Controllers;
use App\Question;
use App\QuestionsOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuestionsOptionsRequest;
use App\Http\Requests\Admin\UpdateQuestionsOptionsRequest;

class QuestionsOptionsController extends Controller
{
     /**
     * Display a listing of QuestionsOption.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $question = Question::all();
            $questions_options = QuestionsOption::all();
       
        return view('questions_options.index', compact('questions_options'));
    }

    /**
     * Show the form for creating new QuestionsOption.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $questions = Question::get()->pluck('question', ' question_id')->prepend('Please select', '');

        return view('questions_options.create', compact('questions'));
    }

    /**
     * Store a newly created QuestionsOption in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionsOptionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionsOptionsRequest $request)
    {
        
        $questions_option = QuestionsOption::create($request->all());
        return redirect()->route('questions_options.index');
    }


    /**
     * Show the form for editing QuestionsOption.
     *
     * @param  int  $ question_option_id
     * @return \Illuminate\Http\Response
     */
    public function edit($question_option_id)
    {
        $questions = Question::get()->pluck('question', ' question_option_id')->prepend('Please select', '');

        $questions_option = QuestionsOption::findOrFail($question_option_id);

        return view('questions_options.edit', compact('questions_option', 'questions'));
    }

    /**
     * Update QuestionsOption in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionsOptionsRequest  $request
     * @param  int  $ question_option_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionsOptionsRequest $request, $question_option_id)
    {
        $questions_option = QuestionsOption::findOrFail($question_option_id);
        $questions_option->update($request->all());



        return redirect()->route('questions_options.index');
    }


    /**
     * Display QuestionsOption.
     *
     * @param  int  $ question_option_id
     * @return \Illuminate\Http\Response
     */
    public function show($question_option_id)
    {
        $questions_option = QuestionsOption::findOrFail($question_option_id);

        return view('questions_options.show', compact('questions_option'));
    }


    /**
     * Remove QuestionsOption from storage.
     *
     * @param  int  $ question_option_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($question_option_id)
    {
        $questions_option = QuestionsOption::findOrFail($question_option_id);
        $questions_option->delete();

        return redirect()->route('questions_options.index');
    }

  
}
