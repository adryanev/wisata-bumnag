<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>fake()->sentence(),
            'description'=>fake()->paragraph(),
            'address'=>fake()->address(),
            'phone_number'=>fake()->phoneNumber(),
            'email'=>fake()->companyEmail(),
            'longitude'=>fake()->longitude(),
            'latitude'=>fake()->latitude(),
            'start_date'=>now(),
            'end_date'=>now()->addDay(fake()->randomNumber(3,60)),
            'term_and_condition'=>fake()->text(),
        ];
    }
    public function AllAtt(){
        return $this->state(fn (array $attributes) => [
            'instagram'=>fake()->userName(),
            'website'=>fake()->url(),
        ]);
    }
}
