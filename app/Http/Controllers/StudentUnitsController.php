<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Question;
use App\QuestionsOption;
use App\ExamsResult;
use Illuminate\Http\Request;

class StudentUnitsController extends Controller
{

    public function show($course_id=null)
    {
        $unit = Unit::where('course_id', $course_id)->firstOrFail();

        // if (\Auth::check())
        // {
        //     if ($unit->students()->where('id', \Auth::id())->count() == 0) {
        //         $unit->students()->attach(\Auth::id());
        //     }
        // }

        $exam_result = NULL;
        if ($unit->exam) {
            $exam_result = ExamsResult::where('exam_id', $unit->exam->exam_id)
                ->where('user_id', \Auth::id())
                ->first();
        }

        $exam_exists = FALSE;
        if ($unit->exam && $unit->exam->questions->count() > 0) {
            $exam_exists = TRUE;
        }

        return view('unit', compact('unit','exam_result', 'exam_exists'));
    }

    public function exam(Request $request)
    {
        $unit = Unit::all();
        $answers = [];
        $exam_score = 0;
        foreach ($request->get('questions') as $question_id => $answer_id) {
            $question = Question::find($question_id);
            $correct = QuestionsOption::where('question_id', $question_id)
                ->where('id', $answer_id)
                ->where('correct', 1)->count() > 0;
            $answers[] = [
                'question_id' => $question_id,
                'option_id' => $answer_id,
                'correct' => $correct
            ];
            if ($correct) {
                $exam_score += $question->score;
            }
            /*
             * Save the answer
             * Check if it is correct and then add points
             * Save all exam result and show the points
             */
        }
        $exam_result = ExamsResult::create([
            'exam_id' => $unit->exam->id,
            'user_id' => \Auth::id(),
            'exam_result' => $exam_score
        ]);
        $exam_result->answers()->createMany($answers);

        return redirect()->route('units.show', [$unit->course_id])->with('message', 'exam score: ' . $exam_score);
    }

}
