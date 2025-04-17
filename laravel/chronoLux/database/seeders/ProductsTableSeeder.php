<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Tissot Tradition Silver',
                'description' => 'Elegantné hodinky Tissot Tradition s klasickým vzhľadom.',
                'category_id' => 1,
                'brand_id' => 1,
                'images' => [
                    ['path' => 'IMGs/tissot-sm.jpg', 'is_cover' => true],
                ]
            ],
            [
                'name' => 'Tissot PRX',
                'description' => 'Moderný dizajn a vysoká presnosť, ideálne pre každodenné nosenie.',
                'category_id' => 1,
                'brand_id' => 1,
                'images' => [
                    ['path' => 'IMGs/tissot-prx-sm.jpg', 'is_cover' => true],
                ]
            ],
            [
                'name' => 'Tissot PRX Powermatic 80',
                'description' => 'Automatické hodinky s výdržou až 80 hodín.',
                'category_id' => 1,
                'brand_id' => 1,
                'images' => [
                    ['path' => 'IMGs/tissot-3-sm.jpg', 'is_cover' => true],
                ]
            ],
            [
                'name' => 'Breitling Navitimer Automatic 41',
                'description' => 'Luxusné pilotné hodinky s ikonickým dizajnom.',
                'category_id' => 1,
                'brand_id' => 2,
                'images' => [
                    ['path' => 'IMGs/breitling-sm.jpg', 'is_cover' => true],
                ]
            ],
            [
                'name' => 'Rolex Submariner',
                'description' => 'Ikona medzi potápačskými hodinkami.',
                'category_id' => 1,
                'brand_id' => 3,
                'images' => [
                    ['path' => 'IMGs/rolex-2-sm.jpg', 'is_cover' => true],
                ]
            ],
            [
                'name' => 'Fossil CH2882',
                'description' => 'Štýlové a dostupné hodinky s chronografom.',
                'category_id' => 1,
                'brand_id' => 4,
                'images' => [
                    ['path' => 'IMGs/fossil-sm.jpg', 'is_cover' => true],
                ]
            ],
            [
                'name' => 'Mauron Musy MU03 Armor',
                'description' => 'Exkluzívny švajčiarsky model s patentovaným tesniacim systémom.',
                'category_id' => 1,
                'brand_id' => 5,
                'images' => [
                    ['path' => 'IMGs/mauron-sm.jpg', 'is_cover' => true],
                ]
            ],
        ];

        foreach ($products as $product) {
            $productId = DB::table('products')->insertGetId([
                'name' => $product['name'],
                'description' => $product['description'],
                'category_id' => $product['category_id'],
                'brand_id' => $product['brand_id'],
                'created_at' => now(),
            ]);

            foreach ($product['images'] as $image) {
                DB::table('products_images')->insert([
                    'product_id' => $productId,
                    'image_path' => $image['path'],
                    'is_cover' => $image['is_cover'],
                ]);
            }
        }
    }
}
