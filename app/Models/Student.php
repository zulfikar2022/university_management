<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'SID', 'level', 'semester', 'session_year', 'residential_status', 'image', 'user_id', 'faculty_id', 'degree_id', 'hall_id'
    ];


    // relationship methods
    public function guardian()
    {
        return $this->hasOne(Guardian::class);
    }

    public function hallSeatApplications()
    {
        return $this->hasMany(HallSeatApplication::class);
    }

    public function seatAllocation()
    {
        return $this->hasOne(SeatAllocation::class);
    }

    public function cgpa()
    {
        return $this->hasOne(Cgpa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

}
