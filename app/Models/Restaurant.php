<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
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
        'cuisine_type',
        'price_range',
        'contact_info',
        'opening_hours',
        'is_featured'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'opening_hours' => 'array',
        'is_featured' => 'boolean',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'entity_id')
                    ->where('entity_type', 'Restaurant');
    }
}
