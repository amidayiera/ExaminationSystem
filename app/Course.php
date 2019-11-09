<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'course_name','course_code'
    ];
    protected $primaryKey = 'course_id';
    // protected $guarded = [];

    public function units(){
        return $this->hasMany('App\Unit','id');
        // return $this->hasMany(Unit::class);
    }
    // public function lecturers(){

    // }
}
