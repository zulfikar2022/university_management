<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramLearningOutcome extends Model
{
    protected $fillable = [
        'programName', 'PLO_No', 'PLO_Description'
    ];

    public function courseLearningOutcome()
    {
        return $this->belongsToMany(CourseLearningOutcome::class);
    }
}
