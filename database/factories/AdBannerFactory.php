<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdBanner>
 */
class AdBannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::all();
        $names = [];
        foreach ($users as $user){
            array_push($names,$user->name);
        }
        $name = fake()->randomElement($names);
        return [
            'name'=>fake()->word(),
            'action'=>fake()->word(),
            'target'=>$name,
        ];
    }
}
