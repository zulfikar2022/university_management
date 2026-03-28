<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatAllocation extends Model
{
    protected $fillable = [
        'room_id', 'student_id'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
