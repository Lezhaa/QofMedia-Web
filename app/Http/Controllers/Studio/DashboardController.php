<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Models\PhotoPackage;
use App\Models\RentalTool;
use App\Models\StudioPackage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_tools' => RentalTool::count(),
            'available_tools' => RentalTool::where('is_available', true)->where('stock', '>', 0)->count(),
            'total_studio_packages' => StudioPackage::count(),
            'total_photo_packages' => PhotoPackage::count(),
        ];
        
        // Pastikan ini mengarah ke 'studio.dashboard' bukan 'admin.studio.dashboard'
        return view('studio.dashboard', compact('stats'));
    }
}