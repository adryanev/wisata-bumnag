<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $categories = Category::all();
        foreach ($categories as $category) {
            if ($category->id < 5) continue;
            if ($category->id >= 23) continue;
            Destination::factory()->hasCertifications(2)->count(25)->create()->each(function ($destination) use ($category) {
                $destination->categories()->attach($category->id);
                $destination->addMedia(storage_path('Destination/Destination' . fake()->numberBetween(1, 10) . '.jpg'))->preservingOriginal()->toMediaCollection('Destination');
            });
        }
    }
}
