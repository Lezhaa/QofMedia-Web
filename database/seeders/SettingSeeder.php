<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'whatsapp_studio', 'value' => '6281234567890'],
            ['key' => 'whatsapp_apparel', 'value' => '6281234567891'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/qofmedia'],
            ['key' => 'instagram', 'value' => 'https://www.instagram.com/qofmedia.nuha'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/qofmedia'],
            ['key' => 'tiktok', 'value' => 'https://tiktok.com/@qofmedia'],
            ['key' => 'youtube', 'value' => 'https://youtube.com/@qofmedia'],
            ['key' => 'google_maps', 'value' => '<iframe src="https://www.google.com/maps/dir//PPTQ+NURUL+HUDA+JOYO+SUKO+METRO,+Jl.+Joyo+Suko+Metro+III+No.34,+Merjosari,+Kec.+Lowokwaru,+Kota+Malang,+Jawa+Timur+65144/@-7.9527936,112.6006784,14z/data=!4m8!4m7!1m0!1m5!1m1!1s0x2e788381fdd355b1:0xe5110f1330eb3de!2m2!1d112.6027682!2d-7.9488687?entry=ttu&g_ep=EgoyMDI2MDQwOC4wIKXMDSoASAFQAw%3D%3D" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'],
            ['key' => 'hero_title', 'value' => 'Selamat Datang di QofMedia'],
            ['key' => 'hero_subtitle', 'value' => 'Tim Multimedia Pondok Pesantren Tahfidzul Qur\'an Nurul Huda'],
            ['key' => 'hero_cta_text', 'value' => 'Lihat Layanan Kami'],
            ['key' => 'hero_cta_url', 'value' => '/layanan/studio'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}