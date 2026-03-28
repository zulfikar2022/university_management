<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $fillable = [
        'name', 'faculty_id', 'credit_hours'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
