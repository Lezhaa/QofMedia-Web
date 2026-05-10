<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin QofMedia
        $adminQofmedia = User::firstOrCreate(
            ['email' => 'admin@qofmedia.com'],
            [
                'name' => 'Admin QofMedia',
                'password' => Hash::make('password123'),
                'phone' => '081234567890',
            ]
        );
        $adminQofmedia->assignRole('admin_qofmedia');

        // Admin Studio
        $adminStudio = User::firstOrCreate(
            ['email' => 'studio@qofmedia.com'],
            [
                'name' => 'Admin Studio',
                'password' => Hash::make('password123'),
                'phone' => '081234567891',
            ]
        );
        $adminStudio->assignRole('admin_studio');

        // Admin Apparel
        $adminApparel = User::firstOrCreate(
            ['email' => 'apparel@qofmedia.com'],
            [
                'name' => 'Admin Apparel',
                'password' => Hash::make('password123'),
                'phone' => '081234567892',
            ]
        );
        $adminApparel->assignRole('admin_apparel');

        // Regular User
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User Test',
                'password' => Hash::make('password123'),
                'phone' => '081234567893',
            ]
        );
        $user->assignRole('user');
    }
}