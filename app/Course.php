<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_name','course_code'
    ];
    public function units(){
        return $this->hasMany('App\unit','id');

    }
}
