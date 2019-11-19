<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamsResultsAnswer extends Model
{

    protected $fillable = ['examss_result_id', 'question_id', 'option_id', 'correct'];

}
