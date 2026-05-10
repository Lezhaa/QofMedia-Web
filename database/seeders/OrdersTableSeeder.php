<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'user_id' => 1,
            'product_type' => 'kaos',
            'product_id' => 1,
            'variant_id' => null,
            'qty' => 1,
            'pemesan_name' => 'John Doe',
            'pemesan_phone' => '08123456789',
            'alamat' => 'Jl. Raya No. 1',
            'catatan_user' => 'Segera kirim',
            'status' => 'menunggu',
        ]);
    }
}
