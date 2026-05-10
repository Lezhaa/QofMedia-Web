<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $orders = Order::where('user_id', $user->id)
            ->with(['product', 'variant'])
            ->latest()
            ->take(5)
            ->get();
        
        $orderStats = [
            'total' => Order::where('user_id', $user->id)->count(),
            'menunggu' => Order::where('user_id', $user->id)->where('status', 'menunggu')->count(),
            'disetujui' => Order::where('user_id', $user->id)->where('status', 'disetujui')->count(),
            'ditolak' => Order::where('user_id', $user->id)->where('status', 'ditolak')->count(),
        ];
        
        return view('user.dashboard', compact('user', 'orders', 'orderStats'));
    }
}