<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class accommodation extends Model
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
        'type',
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
}
