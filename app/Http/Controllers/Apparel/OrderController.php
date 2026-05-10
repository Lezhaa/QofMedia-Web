<?php

namespace App\Http\Controllers\Apparel;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'product', 'variant']);
        
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $orders = $query->latest()->paginate(15);
        
        return view('apparel.orders.index', compact('orders'));
    }
    
    public function show(Order $order)
    {
        $order->load(['user', 'product', 'variant.model.edition']);
        return view('apparel.orders.show', compact('order'));
    }
    
    public function approve(Request $request, Order $order)
    {
        $validated = $request->validate([
            'catatan_admin' => 'nullable|string',
        ]);
        
        $order->update([
            'status' => 'disetujui',
            'catatan_admin' => $validated['catatan_admin'] ?? null,
        ]);
        
        // Update stock
        if ($order->product_type === 'kaos' && $order->variant_id) {
            $variant = $order->variant;
            $variant->decrement('stock', $order->qty);
        } else {
            $order->product->decrement('stock', $order->qty);
        }
        
        return redirect()->route('apparel.orders.show', $order)
            ->with('success', 'Pesanan telah disetujui');
    }
    
    public function reject(Request $request, Order $order)
    {
        $validated = $request->validate([
            'catatan_admin' => 'required|string',
        ]);
        
        $order->update([
            'status' => 'ditolak',
            'catatan_admin' => $validated['catatan_admin'],
        ]);
        
        return redirect()->route('apparel.orders.show', $order)
            ->with('success', 'Pesanan telah ditolak');
    }
}