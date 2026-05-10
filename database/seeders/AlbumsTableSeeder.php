<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AlbumsTableSeeder extends Seeder
{
    public function run(): void
    {
        $albums = [
            [
                'name' => 'Wisuda Tahfidz 2025',
                'year' => 2025,
                'description' => 'Dokumentasi acara wisuda tahfidz Al-Qur\'an tahun 2025',
            ],
            [
                'name' => 'Peringatan 17 Agustus 2024',
                'year' => 2024,
                'description' => 'Kegiatan peringatan HUT RI ke-79 di Pondok Pesantren',
            ],
            [
                'name' => 'Haul Masyayikh 2024',
                'year' => 2024,
                'description' => 'Peringatan haul para masyayikh Pondok Pesantren',
            ],
            [
                'name' => 'Kegiatan Ramadhan 2025',
                'year' => 2025,
                'description' => 'Rangkaian kegiatan selama bulan Ramadhan 1446 H',
            ],
        ];

        foreach ($albums as $album) {
            Album::firstOrCreate(
                ['slug' => Str::slug($album['name'] . '-' . $album['year'])],
                array_merge($album, ['slug' => Str::slug($album['name'] . '-' . $album['year'])])
            );
        }
    }
}