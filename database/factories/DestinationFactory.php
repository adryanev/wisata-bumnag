<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=> fake()->company(),
            'description'=> fake()->paragraph(),
            'address'=> fake()->address(),
            'phone_number'=> fake()->phoneNumber(),
            'email'=>fake()->email(),
            'latitude'=>fake()->latitude(),
            'longitude'=>fake()->longitude(),
            'instagram'=>fake()->userName(),
            'website'=>fake()->url(),
            'capasity'=>strval(fake()->numberBetween(100,10000)),
        ];
    }
    public function allAttributes(){
        return $this->state(fn (array $attributes) => [
            'name'=> fake()->company(),
            'description'=> fake()->paragraph(),
            'address'=> fake()->address(),
            'phone_number'=> fake()->phoneNumber(),
            'email'=>fake()->email(),
            'latitude'=>fake()->latitude(),
            'longitude'=>fake()->longitude(),
            'opening_hours'=>now()->format('H:i:s'),
            'closing_hours'=>now()->format('H:i:s'),
            'instagram'=>fake()->userName(),
            'website'=>fake()->url(),
            'capasity'=>strval(fake()->numberBetween(100,10000)),
        ]);
    }
}
