<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            AlbumsTableSeeder::class,
            GalleryItemsTableSeeder::class,
            ArticlesTableSeeder::class,
            RentalToolsTableSeeder::class,
            StudioPackagesTableSeeder::class,
            PhotoPackagesTableSeeder::class,
            ApparelCategoriesTableSeeder::class,
            ApparelProductsTableSeeder::class,
            OrdersTableSeeder::class,
        ]);
    }
}