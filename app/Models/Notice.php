<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
        'hall_id', 'title', 'description', 'start_date', 'end_date', 'role', 'category'
    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }
}
