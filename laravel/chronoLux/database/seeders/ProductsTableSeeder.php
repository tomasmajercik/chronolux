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
            'storage/product_images/breitling-sm.jpg',
            'storage/product_images/carrera-sm.jpg',
            'storage/product_images/festina-sm.jpg',
            'storage/product_images/fossil-sm.jpg',
            'storage/product_images/iwc-sm.jpg',
            'storage/product_images/mauron-sm.jpg',
            'storage/product_images/oozoo-sm.jpg',
            'storage/product_images/rolex-2-sm.jpg',
            'storage/product_images/rolex-sm.jpg',
            'storage/product_images/tissot-3-sm.jpg',
            'storage/product_images/tissot-4-sm.jpg',
            'storage/product_images/tissot-prx-sm.jpg',
            'storage/product_images/tissot-prx1-sm.jpg',
            'storage/product_images/tissot-prx2-sm.jpg',
            'storage/product_images/tudor-sm.jpg',
            'storage/product_images/watch-sm.jpg',
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