<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuestionsOption
 *
 * @package App
 * @property string $question
 * @property text $option_text
 * @property tinyInteger $correct
*/
class QuestionsOption extends Model
{
    use SoftDeletes;

    protected $table = 'questions_options';
    protected $primaryKey = 'question_option_id';
    protected $fillable = [
        'question_option_id','question_id','option_text','correct'
    ];
    
    public function question()
    {
        return $this->belongsTo('App\Question','question_id')->withTrashed();
    }
}