<?php

namespace Database\Factories;

use App\Models\Destination;
use App\Models\Package;
use App\Models\Souvenir;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   $reviewable_type = fake()->randomElement([Souvenir::class,Ticket::class,Package::class,Destination::class]);
        $reviewable_id  = $reviewable_type::all();
        $users = User::all();
        return [
            'reviewable_type'=>$reviewable_type,
            'reviewable_id'=>fake()->numberBetween(1,count($reviewable_id)),
            'title'=>fake()->sentence(),
            'description'=>fake()->text(),
            'rating'=>fake()->numberBetween(1,5),
            'user_id'=>fake()->numberBetween(1,count($users)),
        ];
    }
}
