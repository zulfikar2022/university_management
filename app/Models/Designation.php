<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = [
        'name'
    ];

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
