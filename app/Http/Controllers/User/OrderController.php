<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RentalBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['product.category', 'variant'])
            ->latest()
            ->paginate(10);

        $rentals = RentalBooking::where('user_id', Auth::id())
            ->with('tool')
            ->latest()
            ->paginate(10, ['*'], 'rental_page');

        return view('user.orders.index', compact('orders', 'rentals'));
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


    public function showRental(RentalBooking $rentalBooking)
    {
        // Pastikan rental milik user yang sedang login
        if ($rentalBooking->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke data penyewaan ini.');
        }

        $rentalBooking->load('tool');

        return view('user.orders.rental-show', compact('rentalBooking'));
    }

    /**
     * User konfirmasi pesanan sudah diterima
     */
    public function pesananDiterima(Order $order)
    {
        // Pastikan milik user ini
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Hanya bisa dikonfirmasi jika status dikirim
        if ($order->status !== 'dikirim') {
            return redirect()->route('user.orders.show', $order)
                ->with('error', 'Pesanan belum dalam status dikirim.');
        }

        $order->update([
            'status'      => 'diterima',
            'received_at' => now(),
        ]);

        Log::info("User #{$order->user_id} konfirmasi terima Order #{$order->id}");

        return redirect()->route('user.orders.show', $order)
            ->with('success', 'Terima kasih! Pesanan Anda sudah dikonfirmasi diterima.');
    }
}