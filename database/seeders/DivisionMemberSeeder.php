<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Member;
use Illuminate\Database\Seeder;

class DivisionMemberSeeder extends Seeder
{
    public function run(): void
    {
        // Create divisions
        $divisions = [
            ['name' => 'Broadcasting', 'description' => 'Tim produksi konten dan siaran multimedia', 'instagram' => '@qofmedia.broadcast', 'icon' => 'bi-broadcast', 'order' => 1],
            ['name' => 'Creative', 'description' => 'Tim desain grafis dan konten kreatif', 'instagram' => '@qofmedia.creative', 'icon' => 'bi-palette', 'order' => 2],
            ['name' => 'Wardrobe', 'description' => 'Tim tata busana dan styling', 'instagram' => '@qofmedia.wardrobe', 'icon' => 'bi-handbag', 'order' => 3],
            ['name' => 'Publikasi', 'description' => 'Tim media sosial dan hubungan masyarakat', 'instagram' => '@qofmedia', 'icon' => 'bi-megaphone', 'order' => 4],
        ];
        
        foreach ($divisions as $div) {
            Division::create($div);
        }
        
        // Create members for Broadcasting
        $broadcasting = Division::where('name', 'Broadcasting')->first();
        $members = [
            ['name' => 'Nur Izzah Habibah', 'nickname' => 'Habibah'],
            ['name' => 'Nimatul Khairiyyah', 'nickname' => 'Nimah'],
            ['name' => 'Nur Haliza K.N', 'nickname' => 'Liza'],
            ['name' => 'Titis Irodahtul', 'nickname' => 'Titis'],
            ['name' => 'Nora Atika', 'nickname' => 'Nora'],
            ['name' => 'Rifdah Nuur Fauziyah', 'nickname' => 'Rifdah'],
            ['name' => 'Dhilla', 'nickname' => 'Dhilla'],
            ['name' => 'Lativa', 'nickname' => 'Lativa'],
        ];
        
        foreach ($members as $i => $m) {
            Member::create([
                'division_id' => $broadcasting->id,
                'name' => $m['name'],
                'nickname' => $m['nickname'],
                'order' => $i + 1,
            ]);
        }
        
        // Tambahkan member untuk divisi lain...
    }
}