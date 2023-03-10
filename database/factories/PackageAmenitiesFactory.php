<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PackageAmenities>
 */
class PackageAmenitiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>fake()->word(2),
            'price'=>fake()->numberBetween(2000,20000),
            'description'=>fake()->sentence(),
            'quantity'=>fake()->numberBetween(1,1000),
            'package_id'=>fake()->numberBetween(1,Package::count())
        ];
    }
}
