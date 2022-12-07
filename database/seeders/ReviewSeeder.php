<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $reviews = Review::factory()->count(250)->create();

       foreach($reviews as $review){
        $review->addMedia(storage_path('Review/Review'.fake()->numberBetween(1,28).'.jpg'))->preservingOriginal()->toMediaCollection('Review');
       }
    }
}
