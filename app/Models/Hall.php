<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    protected $fillable = [
        'name', 'building_id',
    ];

    public function hallstaff()
    {
        return $this->hasMany(HallStaff::class);
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function hallSupers()
    {
        return $this->hasMany(HallSuper::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}
