<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLearningOutcome extends Model
{
    protected $fillable = [
        'course_id', 'CLO_ID', 'CLO_Description'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function programLearningOutcomes()
    {
        return $this->belongsToMany(ProgramLearningOutcome::class);
    }
}
