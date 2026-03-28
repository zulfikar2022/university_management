<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = [
        'name',
        'purpose',
    ];

    public function hall()
    {
        return $this->hasOne(Hall::class);
    }

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }

}
