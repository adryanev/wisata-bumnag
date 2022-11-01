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
            'ticketable_type'=>$ticketable_type,
            'ticketable_id'=>fake()->numberBetween(1,count($ticketable_id)),
            'name'=>fake()->sentence(),
            'price'=>fake()->numberBetween(1000,500000),
            'is_free'=>false,
            'is_quantity_limited'=>true,
            'quantity'=>fake()->numberBetween(100,10000),
            'description'=>fake()->paragraph(),
        ];
    }
    public function is_free(){
        return $this->state(fn (array $attributes) => [
            'price' => 0,
            'is_free'=>true,
        ]);
    }
    public function destinationTicket(){
        $destination = Destination::all();
        return $this->state(fn (array $attributes) => [
            'ticketable_type'=>Destination::class,
            'ticketable_id'=>fake()->numberBetween(1,count($destination)),
            'name'=>fake()->sentence(),
            'price'=>fake()->numberBetween(1000,500000),
            'is_free'=>false,
            'is_quantity_limited'=>true,
            'quantity'=>fake()->numberBetween(100,10000),
            'description'=>fake()->paragraph(),
        ]);
    }
}
