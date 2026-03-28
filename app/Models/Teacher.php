<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id', 'faculty_id', 'designation_id', 'department_id', 'career_obj'
    ];

    // relationship methods
    public function chairman()
    {
        return $this->hasOne(Chairman::class);
    }

    public function dean()
    {
        return $this->hasOne(Dean::class);
    }

    public function hallsuper()
    {
        return $this->hasOne(HallSuper::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
