<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'dept_code', 'faculty_id'
    ];

    // Relationships methods

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function chairmen()
    {
        return $this->hasMany(Chairman::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }


}
