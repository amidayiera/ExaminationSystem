<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'course_id','unit_name','unit_code'
    ];

    public function course(){
        return $this->belongsTo('App\Course','course_id');
    }
}

