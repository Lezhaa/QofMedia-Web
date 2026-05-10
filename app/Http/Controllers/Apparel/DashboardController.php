<?php

namespace App\Http\Controllers\Apparel;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'orders_today' => Order::whereDate('created_at', today())->count(),
            'orders_waiting' => Order::where('status', 'menunggu')->count(),
            'orders_approved' => Order::where('status', 'disetujui')
                ->whereDate('updated_at', today())->count(),
            'orders_rejected' => Order::where('status', 'ditolak')
                ->whereDate('updated_at', today())->count(),
        ];
        
        $recentOrders = Order::with(['user', 'product'])
            ->latest()
            ->take(10)
            ->get();
        
        return view('apparel.dashboard', compact('stats', 'recentOrders'));
    }
}