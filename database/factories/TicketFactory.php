<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
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
            'name'=>fake()->sentence(),
            'price'=>fake()->numberBetween(50000),
            'is_free'=>false,
            'is_quantity_limited'=>true,
            'quantity'=>fake()->numberBetween(100,10000),
        ];
    }
}
