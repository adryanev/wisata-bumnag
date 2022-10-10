<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Souvenir>
 */
class SouvenirFactory extends Factory
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
            'price'=>fake()->numberBetween(5000,500000),
            'quantity'=>fake()->numberBetween(1,1000),
            'is_free'=>false,
            'descriptions'=>fake()->sentence(),
            'destination_id'=>fake()->numberBetween(1,count($destinations)),
        ];
    }
    public function isFree(){
        return $this->state(fn (array $attributes) => [
            'price'=>0,
            'is_free'=>true,
        ]);

    }
}
