<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Ultra Luxury',
            'Entry Luxury',
            'Basic Luxury',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'category_name' => $category
            ]);
        }
    }
}
