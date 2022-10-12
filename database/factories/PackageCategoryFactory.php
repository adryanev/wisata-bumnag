<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PackageCategory>
 */
class PackageCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $packageCategories = Category::where('parent_id',Category::where('name','Package')->first()->id)->get();
        $packageCategoriesId = [];
        foreach ($packageCategories as $category){
            array_push($packageCategoriesId,$category->id);
        }

        $packages = Package::all();
        return [
            'package_id'=>fake()->numberBetween(1,count($packages)),
            'category_id'=>fake()->randomElement($packageCategoriesId),
        ];
    }
}
