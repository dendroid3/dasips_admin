<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TraitUuid;

class PropertyImage extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyImageFactory> */
    use HasFactory, TraitUuid;

    protected $fillable = [
        'property_id',
        'image_url'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
