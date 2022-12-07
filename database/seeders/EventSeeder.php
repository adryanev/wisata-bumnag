<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events =Event::factory()->count(50)->create();
        $events1 = Event::factory()->allAtt()->count(70)->create();

        foreach($events as $event){
            $event->addMedia(storage_path('Event/Event'.fake()->numberBetween(1,8).'.jpg'))->preservingOriginal()->toMediaCollection('Event');
        }
        foreach($events1 as $event){
            $event->addMedia(storage_path('Event/Event'.fake()->numberBetween(1,8).'.jpg'))->preservingOriginal()->toMediaCollection('Event');
        }
    }
}
