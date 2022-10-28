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
        $action =fake()->randomElement(['null','click']);
        return [
            'name'=>fake()->word(),
            'action'=>null,
            'target'=>null,
        ];
    }
    public function click(){
        return $this->state(fn (array $attributes) => [
            'action'=>'click',
            'target'=>fake()->url(),
        ]);
    }
}
