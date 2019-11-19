<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;


class Exam extends Model
{
    // use SoftDeletes;

    protected $table = 'exams';
    protected $primaryKey = 'exam_id';

    protected $fillable = [ 'exam_id','exam_title','unit_id'];
    // protected $guarded = [];

    public function questions(){
        return $this->hasMany('App\Question','question_id');
    }

    public function unit(){
        return $this->belongsTo('App\Unit','unit_id');
        // return $this->belongsTo(Unit::class);

    }
}
