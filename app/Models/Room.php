<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number','floor_id', 'room_type', 'room_size', 'available_seats'
    ];

    public function seatAllocations()
    {
        return $this->hasMany(SeatAllocation::class);
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }
}
