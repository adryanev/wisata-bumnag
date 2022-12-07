<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DestinationCertification>
 */
class DestinationCertificationFactory extends Factory
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
            'destination_id'=>fake()->numberBetween(1,count($destinations)),
            'certification_name'=>fake()->word(),
            'certification_badge'=>'https://source.unsplash.com/random',
            'acquired_date'=>now(),
            'expiration_date'=>now()->addMonth(5),
            'grade'=>fake()->word(),

        ];
    }
}
