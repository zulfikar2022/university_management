<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'courseCode',
        'courseTitle',
        'department_id',
        'degree_id',
        'credit',
        'contactHourPerWeek',
        'level',
        'semester',
        'academicSession',
        'type',
        'type_T_S',
        'totalMarks',
        'instructor',
        'prerequisites',
        'summary'
    ];

    // Relationships methods
    public function courseContents()
    {
        return $this->hasMany(CourseContent::class);
    }

    public function referenceBooks()
    {
        return $this->hasMany(ReferenceBook::class);
    }

    public function courseLearningOutcome()
    {
        return $this->hasOne(CourseLearningOutcome::class);
    }

    public function weeklyLessonPlans()
    {
        return $this->hasMany(WeeklyLessonPlan::class);
    }

    public function courseObjective()
    {
        return $this->hasOne(CourseObjective::class);
    }


    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
}
