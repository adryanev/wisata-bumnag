<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Souvenir;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SouvenirCategory>
 */
class SouvenirCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $souvenirCategory = Category::where('parent_id',Category::where('name','souvenir')->get()->first()->id)->get();
        $souvenirCategorys = [];
        foreach ($souvenirCategory as $category){
            array_push($souvenirCategorys,$category->id);
        }
        $souvenirs = Souvenir::all();
        return [
            'souvenir_id'=>fake()->numberBetween(1,count($souvenirs)),
            'category_id'=>fake()->randomElement($souvenirCategorys,1),
        ];
    }
}
