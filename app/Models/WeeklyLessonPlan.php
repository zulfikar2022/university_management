<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyLessonPlan extends Model
{
    protected $fillable = [
        'course_id', 'weekNo', 'topics', 'specificOutcomes', 'teachingStrategy', 'teachingAid', 'assessmentStrategy', 'CLO_mapping'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
