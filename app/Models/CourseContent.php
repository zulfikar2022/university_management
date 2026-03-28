<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    protected $fillable = [
        'course_id', 'content', 'teaching_strategy', 'assessment_strategy', 'CLO_mapping'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
