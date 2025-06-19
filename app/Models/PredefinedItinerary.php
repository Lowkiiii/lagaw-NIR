<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PredefinedItinerary extends Model
{
    protected $fillable = [
        'tourist_spot_id',
        'title',
        'description',
        'visit_date',
        'visit_time',
        'budget_limit',
    ];

    protected $casts = [
        'visit_date' => 'datetime',
        'visit_time' => 'datetime',
    ];

        public function touristSpot()
    {
        return $this->belongsTo(TouristSpot::class);
    }
}
