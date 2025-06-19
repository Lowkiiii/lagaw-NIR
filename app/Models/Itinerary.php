<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tourist_spot_id',
        'title',
        'visit_date',
        'visit_time',
        'budget_limit',
        'notes',
    ];

    protected $casts = [
        'visit_date' => 'datetime',
        'visit_time' => 'string',
        'budget_limit' => 'decimal:2',
    ];

    public function touristSpot()
    {
        return $this->belongsTo(TouristSpot::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(ItineraryDetail::class);
    }
}
