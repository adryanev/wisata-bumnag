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
            'day_constraint'=>'',
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
        $days = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];
        $day1 = $days[fake()->numberBetween(0,count($days))-1];
        $day2 = $days[fake()->numberBetween(0,count($days))-1];
        while ($day1 == $day2){
            $day1 = $days[fake()->numberBetween(0,count($days)-1)];
            $day2 = $days[fake()->numberBetween(0,count($days)-1)];
        }
        return $this->state(fn (array $attributes) => [
            'is_per_day' =>  true,
            'day_constraint'=> $day1.'-'.$day2,
        ]);
    }
    public function perAge(){
        return $this->state(fn (array $attributes) => [
            'is_per_age' =>  true,
            'age_constraint'=> fake()->numberBetween(13,100),
        ]);
    }
}
