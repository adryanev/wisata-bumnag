<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Souvenir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SouvenirSeeder extends Seeder
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
            if ($category->id < 23) continue;
            if ($category->id >= 26) continue;
            Souvenir::factory()->count(25)->create()->each(function ($souvenir) use ($category) {
                $souvenir->categories()->attach($category->id);
                $souvenir->addMedia(storage_path('Souvenir/Souvenir' . fake()->numberBetween(1, 10) . '.jpg'))->preservingOriginal()->toMediaCollection('Souvenir');
            });
        }

        foreach ($categories as $category) {
            if ($category->id < 23) continue;
            if ($category->id >= 26) continue;
            Souvenir::factory()->isFree()->count(25)->create()->each(function ($souvenir) use ($category) {
                $souvenir->categories()->attach($category->id);
                $souvenir->addMedia(storage_path('Souvenir/Souvenir' . fake()->numberBetween(1, 10) . '.jpg'))->preservingOriginal()->toMediaCollection('Souvenir');
            });
        }
    }
}
