<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HallStaff extends Model
{
    protected $fillable = [
        'user_id', 'hall_id', 'designation'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }
}
