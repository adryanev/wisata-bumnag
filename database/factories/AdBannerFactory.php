<?php

namespace Database\Factories;

use App\Models\User;
use Auth;
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
        Auth::attempt(['email'=>env('SEEDER_EMAIL'),'password'=>env('SEEDER_PASS')]);
        return [
            'name'=>fake()->word(),
            'action'=>null,
            'target'=>null,
            'created_by'=>Auth::user()->id,
        ];
    }
    public function click(){
        Auth::attempt(['email'=>env('SEEDER_EMAIL'),'password'=>env('SEEDER_PASS')]);
        return $this->state(fn (array $attributes) => [
            'action'=>'click',
            'target'=>fake()->url(),
            'created_by'=>Auth::user()->id,
        ]);
    }
}
