<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hallsuper extends Model
{
    protected $fillable = [
        'hall_id', 'teacher_id', 'hall_super_message'
    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
