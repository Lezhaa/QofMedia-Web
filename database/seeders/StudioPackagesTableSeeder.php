<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudioPackage;


class StudioPackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudioPackage::create([
            'name' => 'Paket Foto Profesional',
            'type' => 'foto',
            'description' => 'Paket foto profesional dengan berbagai fasilitas.',
            'price' => 500000,
            'duration' => '2 jam',
            'facilities' => json_encode(['Backdrop', 'Lighting', 'Assistant']),
        ]);

        StudioPackage::create([
            'name' => 'Paket Video Shoots',
            'type' => 'video',
            'description' => 'Paket video dengan pengambilan gambar HD.',
            'price' => 1000000,
            'duration' => '3 jam',
            'facilities' => json_encode(['Camera', 'Lighting', 'Sound Equipment']),
        ]);
    }
}
