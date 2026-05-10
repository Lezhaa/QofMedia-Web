<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['product.category', 'variant'])
            ->latest()
            ->paginate(10);
        
        return view('user.orders.index', compact('orders'));
    }
    
    public function show(Order $order)
    {
        // Pastikan user hanya bisa lihat ordernya sendiri
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
        
        // Load relasi yang diperlukan
        $order->load(['product.category', 'variant']);
        
        // Kirim variabel $order (bukan $orders)
        return view('user.orders.show', compact('order'));
    }
}