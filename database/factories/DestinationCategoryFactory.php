<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DestinationCategory>
 */
class DestinationCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categories_count = Category::all();
        $destination_count = Destination::all();
        return [
            'category_id'=>fake()->numberBetween(1,count($categories_count)),
            'destination_id'=>fake()->numberBetween(1,count($destination_count)),
        ];
    }
}
