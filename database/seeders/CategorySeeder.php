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
            'name'=>'Wisata',
        ]),
        new Category([
            'name'=>'Paket Wisata',
        ]),
        new Category([
            'name'=>'Event',
        ]),
        new Category([
            'name'=>'Kuliner',
        ]),
        new Category([
            'name'=>'Akomodasi',
        ]),
        new Category([
            'name'=>'Desa Wisata',
        ]),
        //Wisata Alam
        new Category([
            'name'=>'Wisata Alam',
            'parent_id'=>1,
        ]),
        new Category([
            'name'=>'Wisata Buatan',
            'parent_id'=>1,
        ]),
        new Category([
            'name'=>'Wisata Budaya dan Sejarah',
            'parent_id'=>1,
        ]),
        new Category([
            'name'=>'Wisata Minat Khusus',
            'parent_id'=>1,
        ]),
        new Category([
            'name'=>'Wisata Museum',
            'parent_id'=>1,
        ]),
        new Category([
            'name'=>'Wisata Pantai',
            'parent_id'=>1,
        ]),
        //Kuliner
        new Category([
            'name'=>'Rumah Makan',
            'parent_id'=>4,
        ]),
        new Category([
            'name'=>'Restoran',
            'parent_id'=>4,
        ]),
        //Akomodasi
        new Category([
            'name'=>'Hotel Non Bintang',
            'parent_id'=>5,
        ]),
        new Category([
            'name'=>'Hotel Bintang 1',
            'parent_id'=>5,
        ]),
        new Category([
            'name'=>'Hotel Bintang 2',
            'parent_id'=>5,
        ]),
        new Category([
            'name'=>'Hotel Bintang 3',
            'parent_id'=>5,
        ]),
        new Category([
            'name'=>'Hotel Bintang 4',
            'parent_id'=>5,
        ]),
        new Category([
            'name'=>'Hotel Bintang 5',
            'parent_id'=>5,
        ]),
        // Desa Wisata
        new Category([
            'name'=>'Desa Wisata',
            'parent_id'=>6,
        ]),
        new Category([
            'name'=>'Desa Wisata Alam',
            'parent_id'=>6,
        ]),
        new Category([
            'name'=>'Desa Wisata Kerajinan',
            'parent_id'=>6,
        ]),
       ];
       foreach($categories as $category){
        $category->save();
    }
    }
}
