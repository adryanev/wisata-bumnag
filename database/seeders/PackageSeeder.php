<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
       $packages = Package::factory()->hasPackageCategories(1)->count(100)->create();
       foreach ($packages as $package){
        $package->addMedia(storage_path('Package/Package'.fake()->numberBetween(1,18).'.jpg'))->preservingOriginal()->toMediaCollection('Package');
       }
    }
}
