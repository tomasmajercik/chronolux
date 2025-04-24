<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Tissot'],
            ['name' => 'Breitling'],
            ['name' => 'Rolex'],
            ['name' => 'Fossil'],
            ['name' => 'Mauron Musy'],
            ['name' => 'Seiko'],
            ['name' => 'Casio'],
            ['name' => 'Omega'],
            ['name' => 'Citizen'],
            ['name' => 'Hamilton'],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'brand_name' => $brand['name']
            ]);
        }
    }
}
