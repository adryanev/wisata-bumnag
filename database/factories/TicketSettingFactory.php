<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketSetting>
 */
class TicketSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $tickets = Ticket::all();
        return [
            'is_per_pax'=>false,
            'pax_constraint'=>0,
            'is_per_day'=>false,
            'day_constraint'=>0,
            'is_per_age'=>false,
            'age_constraint'=>0,
        ];
    }
    public function perPax(){
        return $this->state(fn (array $attributes) => [
            'is_per_pax' =>  true,
            'pax_constraint'=> fake()->numberBetween(1,10),
        ]);
    }
    public function perDay(){
        return $this->state(fn (array $attributes) => [
            'is_per_day' =>  true,
            'day_constraint'=> fake()->numberBetween(1,7),
        ]);
    }
    public function perAge(){
        return $this->state(fn (array $attributes) => [
            'is_per_age' =>  true,
            'age_constraint'=> fake()->numberBetween(13,100),
        ]);
    }
}
