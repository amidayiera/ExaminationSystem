<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    protected $table = "questions";

    protected $guarded = [];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setScoreAttribute($input)
    {
        $this->attributes['score'] = $input ? $input : null;
    }

    public function options()
    {
        return $this->hasMany('App\QuestionsOption','question_option_id');
    }

    public function units()
    {
        return $this->belongsTo('App\Unit', 'unit_id');
    }
    public function exams(){
        return $this->belongsTo('App\Exam','exam_id');
    }
}
