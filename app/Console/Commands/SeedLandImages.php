<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Land;
use App\Models\LandImage;

class SeedLandImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-land-images';

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
        $lands = \App\Models\Land::all();
        $lands->each(function ($land) {
            \App\Models\LandImage::factory(5)->create([
                'land_id' => $land->id
            ]);
        });
    }
}
