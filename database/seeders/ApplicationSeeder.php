<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->insert([
            'name' => 'Wisata Bumnag Dev',
            'token' => Str::random(64),
            'identifier' => 'dev.bumnag.wisata.dev',
            'signature' => '25:18:5C:49:BF:99:C4:8A:D4:4D:DA:D4:90:3E:ED:0A:60:80:3F:8B'


        ]);
        DB::table('applications')->insert([
            'name' => 'Wisata Bumnag Stg',
            'token' => Str::random(64),
            'identifier' => 'dev.bumnag.wisata.stg',
            'signature' => '25:18:5C:49:BF:99:C4:8A:D4:4D:DA:D4:90:3E:ED:0A:60:80:3F:8B'

        ]);
    }
}
