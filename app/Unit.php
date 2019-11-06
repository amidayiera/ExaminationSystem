<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';
    // protected $fillable = [
    //     'course_id','unit_code','unit_name'
    // ];
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function course(){
        // return $this->belongsTo('App\Course','course_id');
        return $this->belongsTo(Course::class);

    }
    public function lecturer() {
        return $this->belongsTo(Lecturer::class);
        // return $this->belongsTo('App\Lecturer','id');
    }
    public function test() {
        return $this->hasOne('App\Test');
    }


}

