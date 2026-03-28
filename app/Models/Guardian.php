<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = [
        'student_id', 'father_name', 'father_phone', 'mother_name', 'mother_phone', 'father_nid', 'mother_nid', 'guardian_occupation', 'income_per_year'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
