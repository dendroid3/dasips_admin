<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'property_type',
        'location',
        'price',
        'bedrooms',
        'bathrooms',
        'description',
        'is_active',
        'image_url'
    ];
}
