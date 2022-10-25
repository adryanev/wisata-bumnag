<?php

namespace Database\Seeders;

use App\Models\Destination;
use Database\Factories\DestinationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destinations = Destination::factory()->hasCategories(1)->hasCertifications(2)->count(120)->create();

        foreach ($destinations as $destination) {
            $destination->addMedia(storage_path('Destination/Destination' . fake()->numberBetween(1, 10) . '.jpg'))->preservingOriginal()->toMediaCollection('Destination');
        }
    }
}
