<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TraitUuid;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory, TraitUuid;

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

    public function propertyImages()
    {
        return $this->hasMany(PropertyImage::class)->select('image_url');
    }
}
