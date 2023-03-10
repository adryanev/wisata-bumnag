<?php

namespace Database\Seeders;

use App\Models\PackageAmenities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageAmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packageAmenities = PackageAmenities::factory(1000)->create();
    }
}
