<?php

namespace Database\Seeders;

use App\Models\AdBanner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adbanners = AdBanner::factory()->count(10)->create();

        foreach ($adbanners as $adbanner) {
            $adbanner->addMedia(storage_path('AdBanner/AdBanner.png'))->preservingOriginal()->toMediaCollection('Banner');
        }
        $adbanners = AdBanner::factory()->click()->count(20)->create();
         foreach ($adbanners as $adbanner) {
            $adbanner->addMedia(storage_path('AdBanner/AdBanner.png'))->preservingOriginal()->toMediaCollection('Banner');
        }
    }
}
