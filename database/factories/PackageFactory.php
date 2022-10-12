<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $price_include = fake()->word().','.fake()->word().','.fake()->word();
        $price_exclude =fake()->word().','.fake()->word().','.fake()->word().','.fake()->word().','.fake()->word();
        $activites = fake()->word().','.fake()->word().','.fake()->word().','.fake()->word().','.fake()->word();

        $destinations = Destination::all();
        $destinationName = [];
        foreach ($destinations as $destinasi){
            array_push($destinationName,$destinasi->name);
        }
        $destination = fake()->randomElement($destinationName).','.fake()->randomElement($destinationName).',';
        return [
            'name'=>fake()->sentence(4),
            'price_include'=>$price_include,
            'price_exclude'=>$price_exclude,
            'activities'=>$activites,
            'destination'=>$destination,
        ];
    }
}
