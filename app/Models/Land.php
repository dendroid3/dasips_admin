<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TraitUuid;

class Land extends Model
{
    /** @use HasFactory<\Database\Factories\LandFactory> */
    use HasFactory, TraitUuid;

    protected $fillable = [
        'title',
        'location',
        'price',
        'description',
        'is_active',
        'image_url'
    ];

    public function landImages()
    {
        return $this->hasMany(LandImage::class)->select('image_url');
    }
}
