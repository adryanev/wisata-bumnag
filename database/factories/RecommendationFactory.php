<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recommendation>
 */
class RecommendationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $destinations = Destination::all();
        return [
            'name'=>fake()->word(),
            'destination_id'=>fake()->numberBetween(1,count($destinations)),
            'rank'=>fake()->numberBetween(1,10),
        ];
    }
}
