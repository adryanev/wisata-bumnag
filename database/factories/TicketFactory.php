<?php

namespace Database\Factories;

use App\Models\Destination;
use App\Models\Package;
use App\Models\Event;
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
        $ticketable_type= fake()->randomElement([Event::class,Destination::class,Package::class]);
        $ticketable_id = $ticketable_type::all();
        return [
            'ticketable_type'=>strtolower(class_basename($ticketable_type)),
            'ticketable_id'=>fake()->numberBetween(1,count($ticketable_id)),
            'name'=>fake()->sentence(),
            'price'=>fake()->numberBetween(50000),
            'is_free'=>false,
            'is_quantity_limited'=>true,
            'quantity'=>fake()->numberBetween(100,10000),
            'description'=>fake()->paragraph(),
        ];
    }
}
