<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantsTableSeeder extends Seeder
{
    public function run(): void
    {
        $sizes = ['42mm', '43mm', '44mm', '45mm', '46mm'];
        $productIds = DB::table('products')->pluck('id');

        foreach ($productIds as $productId) {
            $randomSizes = collect($sizes)->shuffle()->slice(0, rand(1, count($sizes)));

            foreach ($randomSizes as $size) {
                DB::table('product_variants')->insert([
                    'product_id' => $productId,
                    'size' => $size
                ]);
            }
        }
    }
}
