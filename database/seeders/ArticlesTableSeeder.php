<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticlesTableSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Penerimaan Santri Baru 2025/2026',
                'category' => 'Pengumuman',
                'excerpt' => 'Pondok Pesantren Tahfidzul Qur\'an Nurul Huda membuka pendaftaran santri baru tahun ajaran 2025/2026.',
                'content' => '<p>Pondok Pesantren Tahfidzul Qur\'an Nurul Huda membuka pendaftaran santri baru untuk tahun ajaran 2025/2026. Pendaftaran dibuka mulai 1 Mei 2025 hingga 30 Juni 2025.</p><p>Syarat pendaftaran:</p><ul><li>Usia minimal 12 tahun</li><li>Mampu membaca Al-Qur\'an</li><li>Mengisi formulir pendaftaran</li><li>Melampirkan fotokopi KK dan Akta Kelahiran</li></ul>',
                'published_at' => now(),
            ],
            [
                'title' => 'Tips Meningkatkan Kualitas Foto Produk',
                'category' => 'Tips & Trik',
                'excerpt' => 'Pelajari cara mengambil foto produk yang menarik untuk meningkatkan penjualan online Anda.',
                'content' => '<p>Foto produk yang berkualitas sangat penting untuk menarik minat pembeli. Berikut beberapa tips untuk meningkatkan kualitas foto produk Anda:</p><ol><li>Gunakan pencahayaan yang cukup</li><li>Pilih background yang netral</li><li>Ambil foto dari berbagai sudut</li><li>Gunakan tripod untuk hasil yang stabil</li><li>Edit foto secukupnya</li></ol>',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Jadwal Kegiatan Bulan Ini',
                'category' => 'Agenda',
                'excerpt' => 'Berikut jadwal kegiatan di Pondok Pesantren untuk bulan ini.',
                'content' => '<p>Berikut jadwal kegiatan untuk bulan ini:</p><ul><li>1-5: Ujian Tengah Semester</li><li>10: Peringatan Hari Santri</li><li>15-20: Lomba Tahfidz</li><li>25: Pengajian Umum</li></ul>',
                'published_at' => now()->subDays(2),
            ],
        ];

        foreach ($articles as $article) {
            Article::firstOrCreate(
                ['slug' => Str::slug($article['title'])],
                array_merge($article, ['slug' => Str::slug($article['title'])])
            );
        }
    }
}