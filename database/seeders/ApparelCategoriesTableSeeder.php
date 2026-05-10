<?php

namespace Database\Seeders;

use App\Models\ApparelCategory;
use Illuminate\Database\Seeder;

class ApparelCategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Kaos', 'Kalender', 'Mug', 'Figura Masyayikh', 'Stiker', 'Totebag'];

        foreach ($categories as $category) {
            ApparelCategory::firstOrCreate(['name' => $category]);
        }
    }
}