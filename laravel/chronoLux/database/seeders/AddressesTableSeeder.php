<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
            [
                'address' => 'aa',
                'city' => 'aa',
                'postal_code' => 'aa',
                'country' => 'aa',
                'created_at' => '2025-04-19 13:42:40',
                'updated_at' => '2025-04-19 13:42:40',
            ],
            [
                'address' => 'Štefániková 268/23',
                'city' => 'Námestovo',
                'postal_code' => '02901',
                'country' => 'Slovensko',
                'created_at' => '2025-04-19 13:51:27',
                'updated_at' => '2025-04-19 13:51:27',
            ],
            [
                'address' => 'Štefániková 268/23',
                'city' => 'Bratislava',
                'postal_code' => '02901',
                'country' => 'Slovensko',
                'created_at' => '2025-04-19 14:01:33',
                'updated_at' => '2025-04-19 14:01:33',
            ],
            [
                'address' => 'Štefániková 268/23',
                'city' => 'N',
                'postal_code' => '02901',
                'country' => 'Slovensko',
                'created_at' => '2025-04-19 15:16:11',
                'updated_at' => '2025-04-19 15:16:11',
            ],
        ]);
    }
}
