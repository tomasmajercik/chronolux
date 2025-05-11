<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Pišta Paprikaš',
                'email' => 'aa@aa.com',
                'password' => '$2y$12$BxHvydqWMekb/oaoUTL4gu/r/wr1VWkLEvo8CEMAziu0P1XeLcbT6',
                'created_at' => '2025-02-19 13:42:35',
                'updated_at' => '2025-04-20 07:07:44',
                'phone_number' => '+421 123 321 123',
                'role' => 'customer',
                'default_address' => 2,
            ],
            [
                'name' => 'Fero Raz',
                'email' => 'bb@bb.com',
                'password' => '$2y$12$.77RenHGHzRtowsfJv9HiuXkCEx0JIVeMl83/nNf2yJRiRSofjVoe',
                'created_at' => '2025-04-19 15:51:07',
                'updated_at' => '2025-04-19 16:16:57',
                'phone_number' => null,
                'role' => 'customer',
                'default_address' => 2,
            ],
            [
                'name' => 'Ľuďo Kopačka',
                'email' => 'admin@admin.com',
                'password' => bcrypt('1234567890'),
                'created_at' => now(),
                'updated_at' => now(),
                'phone_number' => '+421 999 888 777',
                'role' => 'admin',
                'default_address' => null,
            ],
        ]);
    }
}
