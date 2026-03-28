<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceBook extends Model
{
    protected $fillable = [
        'course_id', 'SI_No', 'BookName', 'Author', 'File'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
