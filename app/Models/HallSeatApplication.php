<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HallSeatApplication extends Model
{
    protected $fillable = [
        'student_id', 'application_date', 'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
