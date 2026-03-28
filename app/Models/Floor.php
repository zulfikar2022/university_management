<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $fillable = [
        'floor_number', 'building_id', 'total_rooms', 'usage'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}
