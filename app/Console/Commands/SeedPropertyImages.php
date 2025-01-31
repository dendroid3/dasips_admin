<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Property;
use App\Models\PropertyImage;

class SeedPropertyImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-property-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $properties = \App\Models\Property::all();
        $properties->each(function ($property) {
            \App\Models\PropertyImage::factory(5)->create([
                'property_id' => $property->id
            ]);
        });
    }
}
