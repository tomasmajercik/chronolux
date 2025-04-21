<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersAndOrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert orders
        DB::table('orders')->insert([
            [
                'address_id' => 1,
                'email' => 'aa@aa.com',
                'user_id' => 1,
                'total_price' => 1899.72,
                'delivery_price' => 3.5,
                'delivery_method' => 'dpd',
                'status' => 'Packing',
                'created_at' => '2024-12-21',
                'updated_at' => '2024-12-21',
            ],
            [
                'address_id' => 2,
                'email' => 'aa@aa.com',
                'user_id' => 1,
                'total_price' => 987.00,
                'delivery_price' => 3.5,
                'delivery_method' => 'sps',
                'status' => 'Delivered',
                'created_at' => '2024-07-12',
                'updated_at' => '2024-07-12',
            ],
            [
                'address_id' => 2,
                'email' => 'aa@aa.com',
                'user_id' => 1,
                'total_price' => 6989.16,
                'delivery_price' => 3.5,
                'delivery_method' => 'pošta',
                'status' => 'Delivered',
                'created_at' => '2024-11-22',
                'updated_at' => '2024-11-22',
            ],
        ]);

        // Insert order items
        DB::table('order_items')->insert([
            ['order_id' => 1, 'product_variant_id' => 1, 'quantity' => 2, 'created_at' => '2024-12-21', 'updated_at' => '2024-12-21'],
            ['order_id' => 1, 'product_variant_id' => 4, 'quantity' => 1, 'created_at' => '2024-12-21', 'updated_at' => '2024-12-21'],
            ['order_id' => 1, 'product_variant_id' => 9, 'quantity' => 3, 'created_at' => '2024-12-21', 'updated_at' => '2024-12-21'],
            ['order_id' => 2, 'product_variant_id' => 13, 'quantity' => 1, 'created_at' => '2024-07-12', 'updated_at' => '2024-07-12'],
            ['order_id' => 2, 'product_variant_id' => 17, 'quantity' => 1, 'created_at' => '2024-07-12', 'updated_at' => '2024-07-12'],
            ['order_id' => 3, 'product_variant_id' => 20, 'quantity' => 2, 'created_at' => '2024-11-22', 'updated_at' => '2024-11-22'],
        ]);
    }
}
