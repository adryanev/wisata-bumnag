<?php

namespace Database\Factories;

use App\Models\Destination;
use Auth;
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
        Auth::attempt(['email'=>env('SEEDER_EMAIL'),'password'=>env('SEEDER_PASS')]);
        return [
            'name'=>fake()->word(),
            'price'=>fake()->numberBetween(5000,500000),
            'quantity'=>fake()->numberBetween(1,1000),
            'is_free'=>false,
            'description'=>fake()->sentence(),
            'destination_id'=>fake()->numberBetween(1,count($destinations)),
            'created_by'=>Auth::user()->id,
        ];
    }
    public function isFree(){
        return $this->state(fn (array $attributes) => [
            'price'=>0,
            'is_free'=>true,
        ]);

    }
}
