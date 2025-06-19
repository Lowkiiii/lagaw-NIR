<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'entity_type', 'entity_id', 'rating', 'comment', 'review_date'
    ];


    protected $casts = [
        'review_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function touristSpot()
    {
        return $this->belongsTo(TouristSpot::class, 'entity_id')->where('entity_type', 'TouristSpot');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'entity_id')->where('entity_type', 'Hotel');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'entity_id')->where('entity_type', 'Restaurant');
    }
}
