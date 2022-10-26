<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            if ($category->id < 25) continue;
            Package::factory()->count(25)->create()->each(function ($package) use ($category) {
                $package->categories()->attach($category->id);
                $package->addMedia(storage_path('Package/Package' . fake()->numberBetween(1, 18) . '.jpg'))->preservingOriginal()->toMediaCollection('Package');
            });
        }
    }
}
