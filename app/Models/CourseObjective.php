<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseObjective extends Model
{
    protected $fillable = [
        'course_id', 'CO_ID', 'CO_Description'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
