<?php

namespace Database\Seeders;

use App\Models\RentalTool;
use Illuminate\Database\Seeder;

class RentalToolsTableSeeder extends Seeder
{
    public function run(): void
    {
        $tools = [
            [
                'name' => 'Kamera DSLR Canon EOS 1500D',
                'category' => 'Kamera',
                'description' => 'Kamera DSLR dengan lensa kit 18-55mm, cocok untuk pemula.',
                'price_per_day' => 100000,
                'stock' => 5,
                'is_available' => true,
            ],
            [
                'name' => 'Kamera Mirrorless Sony A6000',
                'category' => 'Kamera',
                'description' => 'Kamera mirrorless dengan sensor APS-C, ringan dan mudah dibawa.',
                'price_per_day' => 120000,
                'stock' => 3,
                'is_available' => true,
            ],
            [
                'name' => 'Handycam Sony HDR-CX405',
                'category' => 'Video',
                'description' => 'Handycam Full HD dengan stabilizer, cocok untuk dokumentasi.',
                'price_per_day' => 60000,
                'stock' => 2,
                'is_available' => true,
            ],
            [
                'name' => 'Tripod Kamera',
                'category' => 'Aksesoris',
                'description' => 'Tripod aluminium ringan, tinggi maksimal 160cm.',
                'price_per_day' => 15000,
                'stock' => 8,
                'is_available' => true,
            ],
            [
                'name' => 'Lighting Set',
                'category' => 'Lighting',
                'description' => 'Set lighting studio 3 titik dengan softbox.',
                'price_per_day' => 75000,
                'stock' => 2,
                'is_available' => true,
            ],
        ];

        foreach ($tools as $tool) {
            RentalTool::create($tool);
        }
    }
}