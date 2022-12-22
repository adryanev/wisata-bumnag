<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Recommendation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recommendation::create([
            'name'=>'',
            'rank'=>1,
            'destination_id'=>fake()->numberBetween(1,Destination::count())
        ]);
        Recommendation::create([
            'name'=>'',
            'rank'=>2,
            'destination_id'=>fake()->numberBetween(1,Destination::count())
        ]);
        Recommendation::create([
            'name'=>'',
            'rank'=>3,
            'destination_id'=>fake()->numberBetween(1,Destination::count())
        ]);
        Recommendation::create([
            'name'=>'',
            'rank'=>4,
            'destination_id'=>fake()->numberBetween(1,Destination::count())
        ]);
        Recommendation::create([
            'name'=>'',
            'rank'=>5,
            'destination_id'=>fake()->numberBetween(1,Destination::count())
        ]);
        Recommendation::create([
            'name'=>'',
            'rank'=>6,
            'destination_id'=>fake()->numberBetween(1,Destination::count())
        ]);
        Recommendation::create([
            'name'=>'',
            'rank'=>7,
            'destination_id'=>fake()->numberBetween(1,Destination::count())
        ]);
        Recommendation::create([
            'name'=>'',
            'rank'=>8,
            'destination_id'=>fake()->numberBetween(1,Destination::count())
        ]);
        Recommendation::create([
            'name'=>'',
            'rank'=>9,
            'destination_id'=>fake()->numberBetween(1,Destination::count())
        ]);
        Recommendation::create([
            'name'=>'',
            'rank'=>10,
            'destination_id'=>fake()->numberBetween(1,Destination::count())
        ]);
    }
}
