<?php

namespace Database\Seeders;

use App\Models\Souvenir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SouvenirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Souvenir::factory()->hasSouvenirCategorys(1)->count(90)->create();
        Souvenir::factory()->isFree()->hasSouvenirCategorys(1)->count(10)->create();
    }
}
