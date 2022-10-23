<?php

namespace Database\Seeders;

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
        $souvenirs = Souvenir::factory()->hasSouvenirCategorys(1)->count(90)->create();
        $souvenirs1 = Souvenir::factory()->isFree()->hasSouvenirCategorys(1)->count(10)->create();
        foreach($souvenirs as $souvenir){
            $souvenir->addMedia(storage_path('Souvenir/Souvenir'.fake()->numberBetween(1,10).'.jpg'))->preservingOriginal()->toMediaCollection('Souvenir');
        }
        foreach($souvenirs1 as $souvenir){
            $souvenir->addMedia(storage_path('Souvenir/Souvenir'.fake()->numberBetween(1,10).'.jpg'))->preservingOriginal()->toMediaCollection('Souvenir');
        }
    }
}
