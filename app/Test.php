<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Test
 *
 * @package App
 * @property string $course
 * @property string $lesson
 * @property string $title
 * @property text $description
 * @property tinyInteger $published
*/
class Test extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'published', 'course_id', 'lesson_id'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCourseIdAttribute($input)
    {
        $this->attributes['course_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setLessonIdAttribute($input)
    {
        $this->attributes['lesson_id'] = $input ? $input : null;
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')->withTrashed();
    }
    
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id')->withTrashed();
    }
    
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_test')->withTrashed();
    }
    
}
