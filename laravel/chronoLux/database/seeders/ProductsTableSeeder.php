<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['id' => 1, 'name' => 'Tissot'],
            ['id' => 2, 'name' => 'Breitling'],
            ['id' => 3, 'name' => 'Rolex'],
            ['id' => 4, 'name' => 'Fossil'],
            ['id' => 5, 'name' => 'Mauron Musy'],
            ['id' => 6, 'name' => 'Seiko'],
            ['id' => 7, 'name' => 'Casio'],
            ['id' => 8, 'name' => 'Omega'],
            ['id' => 9, 'name' => 'Citizen'],
            ['id' => 10, 'name' => 'Hamilton'],
        ];

        $imagePool = [
            'IMGs/breitling-sm.jpg',
            'IMGs/carrera-sm.jpg',
            'IMGs/festina-sm.jpg',
            'IMGs/fossil-sm.jpg',
            'IMGs/iwc-sm.jpg',
            'IMGs/mauron-sm.jpg',
            'IMGs/oozoo-sm.jpg',
            'IMGs/rolex-2-sm.jpg',
            'IMGs/rolex-sm.jpg',
            'IMGs/tissot-3-sm.jpg',
            'IMGs/tissot-4-sm.jpg',
            'IMGs/tissot-prx-sm.jpg',
            'IMGs/tissot-prx1-sm.jpg',
            'IMGs/tissot-prx2-sm.jpg',
            'IMGs/tudor-sm.jpg',
            'IMGs/watch-sm.jpg',
        ];
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 5000; $i++) {
            $brand = $brands[array_rand($brands)];
            $name = $brand['name'] . ' ' . strtoupper(Str::random(4)) . rand(100, 999);
            $description = $faker->sentence(12);
            $price = rand(100, 20000) / 1.0;
            $categoryId = rand(1, 3);

            $productId = DB::table('products')->insertGetId([
                'name' => $name,
                'description' => $description,
                'category_id' => $categoryId,
                'brand_id' => $brand['id'],
                'price' => $price,
                'created_at' => now(),
            ]);

            $imageCount = rand(1, 3);
            $usedImages = array_rand($imagePool, $imageCount);
            if (!is_array($usedImages)) $usedImages = [$usedImages];

            foreach ($usedImages as $j => $index) {
                DB::table('products_images')->insert([
                    'product_id' => $productId,
                    'image_path' => $imagePool[$index],
                    'is_cover' => $j === 0, // prvý obrázok je cover
                ]);
            }
        }
    }
}