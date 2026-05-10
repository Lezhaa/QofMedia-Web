<?php

namespace Database\Seeders;
;
use Illuminate\Database\Seeder;
use App\Models\ApparelProduct;
use App\Models\ApparelCategory;

class ApparelProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ApparelCategory::first(); // Mengambil kategori pertama sebagai contoh

        ApparelProduct::create([
            'category_id' => $category->id,
            'name' => 'Kaos QofMedia Edisi 2025',
            'description' => 'Kaos edisi spesial QofMedia 2025.',
            'price' => 150000,
            'stock' => 100,
            'image' => 'images/kaos-qofmedia.jpg',
            'type' => 'kaos',
        ]);
    }
}
