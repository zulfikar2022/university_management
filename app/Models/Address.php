<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'present_division',
        'present_district',
        'present_upazila',
        'present_area',
        'permanent_division',
        'permanent_district',
        'permanent_upazila',
        'permanent_area',
        'permanent_district_distance'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
