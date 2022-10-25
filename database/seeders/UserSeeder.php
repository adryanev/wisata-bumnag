<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $users = User::factory()->count(150)->create();

       foreach ($users as $user){
        $user->addMedia(storage_path('User/Avatar.png'))->preservingOriginal()->toMediaCollection('Avatar');
       }
    }
}
