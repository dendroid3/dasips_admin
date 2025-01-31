<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandImage extends Model
{
    /** @use HasFactory<\Database\Factories\LandImageFactory> */
    use HasFactory;
    
    protected $fillable = [
        'land_id',
        'image_url'
    ];

    public function land()
    {
        return $this->belongsTo(Land::class);
    }
}
