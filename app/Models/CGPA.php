<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CGPA extends Model
{
    protected $table = 'cgpas';
    protected $fillable = [
        'student_id',
        'gpa',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
