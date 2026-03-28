<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'name', 'short_name',
    ];

    // relationship methods

    public function degrees()
    {
        return $this->hasMany(Degree::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function deans()
    {
        return $this->hasMany(Dean::class);
    }
}
