<?php

namespace Database\Seeders;

use App\Models\Destination;
use Database\Factories\DestinationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Destination::factory()->hasDestinationCategory(1)->count(120)->create();
    }
}
