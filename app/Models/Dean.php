<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dean extends Model
{
    protected $fillable = [
        'faculty_id', 'teacher_id', 'dean_message'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
