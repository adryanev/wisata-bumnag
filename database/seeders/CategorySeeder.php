<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            new Category([
                'name' => 'Wisata',
            ]), // 1
            new Category([
                'name' => 'Event',
            ]), // 2
            new Category([
                'name' => 'Kuliner',
            ]), // 3
            new Category([
                'name' => 'Akomodasi',
            ]), // 4
            new Category([
                'name' => 'Desa Wisata',
            ]), // 5
            //Wisata Alam
            new Category([
                'name' => 'Wisata Alam',
                'parent_id' => 1,
            ]), // 6
            new Category([
                'name' => 'Wisata Buatan',
                'parent_id' => 1,
            ]), // 7
            new Category([
                'name' => 'Wisata Budaya dan Sejarah',
                'parent_id' => 1,
            ]), // 8
            new Category([
                'name' => 'Wisata Minat Khusus',
                'parent_id' => 1,
            ]), // 9
            new Category([
                'name' => 'Wisata Museum',
                'parent_id' => 1,
            ]), // 10
            new Category([
                'name' => 'Wisata Pantai',
                'parent_id' => 1,
            ]), // 11
            //Kuliner
            new Category([
                'name' => 'Rumah Makan',
                'parent_id' => 3,
            ]), // 12
            new Category([
                'name' => 'Restoran',
                'parent_id' => 3,
            ]), // 13
            //Akomodasi
            new Category([
                'name' => 'Hotel Non Bintang',
                'parent_id' => 4,
            ]), // 14
            new Category([
                'name' => 'Hotel Bintang 1',
                'parent_id' => 4,
            ]), // 15
            new Category([
                'name' => 'Hotel Bintang 2',
                'parent_id' => 4,
            ]), // 16
            new Category([
                'name' => 'Hotel Bintang 3',
                'parent_id' => 4,
            ]), // 17
            new Category([
                'name' => 'Hotel Bintang 4',
                'parent_id' => 4,
            ]), // 18
            new Category([
                'name' => 'Hotel Bintang 5',
                'parent_id' => 4,
            ]), // 19
            // Desa Wisata
            new Category([
                'name' => 'Desa Wisata Alam',
                'parent_id' => 5,
            ]), // 20
            new Category([
                'name' => 'Desa Wisata Kerajinan',
                'parent_id' => 5,
            ]), // 21
            //souvenir
            new Category([
                'name' => 'Souvenir',
            ]), // 22
            new Category([
                'name' => 'Makanan dan Minuman',
                'parent_id' => 22,
            ]), // 23
            new Category([
                'name' => 'Kerajinan',
                'parent_id' => 22,
            ]), // 24
            //packages
            new Category([
                'name' => 'Package'
            ]), // 25
            new Category([
                'name' => 'Kapal 1',
                'parent_id' => 25
            ]), // 26
            new Category([
                'name' => 'Kapal 2',
                'parent_id' => 25
            ]), // 27
            new Category([
                'name' => 'Kapal 3',
                'parent_id' => 25
            ]), // 28
            new Category([
                'name' => 'Kapal 4',
                'parent_id' => 25
            ]), // 29
            new Category([
                'name' => 'Kapal 5',
                'parent_id' => 25
            ]), // 30
            new Category([
                'name' => 'Kapal 6',
                'parent_id' => 25
            ]), // 31
            new Category([
                'name' => 'Kapal 7',
                'parent_id' => 25
            ]), // 32
            new Category([
                'name' => 'Kapal 8',
                'parent_id' => 25
            ]), // 33
            new Category([
                'name' => 'Kapal 9',
                'parent_id' => 25
            ]), // 34
            new Category([
                'name' => 'Kapal 10',
                'parent_id' => 25
            ]), // 35

        ];
        foreach ($categories as $category) {
            $category->save();
        }
    }
}
