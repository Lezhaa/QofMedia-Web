<?php

namespace App\Http\Controllers;

use App\Models\PhotoPackage;
use App\Models\RentalTool;
use App\Models\Setting;
use App\Models\StudioPackage;
use Illuminate\Http\Request;

class StudioPublicController extends Controller
{
    public function index()
    {
        $tools = RentalTool::where('is_available', true)
            ->where('stock', '>', 0)
            ->get();
        
        $studioPackages = StudioPackage::all();
        $photoPackages = PhotoPackage::all();
        
        // Ambil nomor dari database
        $whatsappNumber = Setting::where('key', 'whatsapp_studio')->value('value');
        
        // Bersihkan format nomor
        $whatsappNumber = $this->formatWhatsAppNumber($whatsappNumber);
        
        return view('public.service.studio', compact('tools', 'studioPackages', 'photoPackages', 'whatsappNumber'));
    }
    
    /**
     * Format nomor WhatsApp ke format internasional
     */
    private function formatWhatsAppNumber($number)
    {
        // Hapus semua karakter kecuali angka
        $number = preg_replace('/[^0-9]/', '', $number);
        
        // Kalau awalan 0, ganti dengan 62
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }
        
        // Kalau awalan 62 tapi kepanjangan (misal 6208...), potong 0 setelah 62
        if (substr($number, 0, 3) === '620') {
            $number = '62' . substr($number, 3);
        }
        
        return $number;
    }
}