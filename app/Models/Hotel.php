<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'location',
        'img_url',
        'stars',
        'price_range',
        'contact_info',
        'amenities',
        'is_featured'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amenities' => 'array',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the reviews for the hotel.
     */

    public function reviews()
    {
        return $this->hasMany(Review::class, 'entity_id')
                    ->where('entity_type', 'Hotel');
    }
}