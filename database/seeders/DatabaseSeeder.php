<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Recommendation;
use App\Models\Souvenir;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RolesAndPermissionsSeeder::class,
            SuperAdminSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            DestinationSeeder::class,
            TicketSeeder::class,
            SouvenirSeeder::class,
            ApplicationSeeder::class,
            AdBannerSeeder::class,
            PackageSeeder::class,
            RecommendationSeeder::class,

        ]);
    }
}
