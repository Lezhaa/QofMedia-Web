<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ApparelProduct;
use App\Models\TshirtVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:apparel_products,id',
            'variant_id' => 'nullable|exists:tshirt_variants,id',
            'qty' => 'required|integer|min:1',
            'pemesan_name' => 'required|string|max:255',
            'pemesan_phone' => 'required|string|max:20',
            'alamat' => 'required|string',
            'catatan_user' => 'nullable|string',
        ]);
        
        $product = ApparelProduct::findOrFail($validated['product_id']);
        
        // Check stock
        if ($product->type === 'kaos' && isset($validated['variant_id'])) {
            $variant = TshirtVariant::findOrFail($validated['variant_id']);
            if ($variant->stock < $validated['qty']) {
                return back()->with('error', 'Stok tidak mencukupi');
            }
        } else {
            if ($product->stock < $validated['qty']) {
                return back()->with('error', 'Stok tidak mencukupi');
            }
        }
        
        $validated['user_id'] = Auth::id();
        $validated['product_type'] = $product->type;
        $validated['status'] = 'menunggu';
        
        // Set variant_id to null if not provided
        if (!isset($validated['variant_id']) || empty($validated['variant_id'])) {
            $validated['variant_id'] = null;
        }
        
        Order::create($validated);
        
        return redirect()->route('user.orders')
            ->with('success', 'Pesanan berhasil dibuat. Silakan tunggu konfirmasi dari admin.');
    }
}