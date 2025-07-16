<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function form(Request $request)
{
    $product = Product::findOrFail($request->product);
    $quantity = $request->quantity ?? 1;

    return view('checkout.form', compact('product', 'quantity'));
}


    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        // field lainnya...
    ]);

    $product = Product::findOrFail($request->product_id);
    $totalHarga = $product->price * $request->quantity;


    $order = Order::create([
        'order_code' => 'ORD' . now()->format('YmdHis') . rand(100, 999),
        'user_id' => auth()->id(),
        'product_id' => $product->id,
        'quantity' => $request->quantity,
        'total_harga' => $totalHarga,
        'nama_penerima' => $request->nama_penerima,
        'negara' => $request->negara,
        'provinsi' => $request->provinsi,
        'kota' => $request->kota,
        'alamat_jalan' => $request->alamat_jalan,
        'kode_pos' => $request->kode_pos,
        'telepon' => $request->telepon,
        'email' => $request->email,
        'catatan' => $request->catatan,
        'pembayaran' => $request->pembayaran,
        'status' => 'proses',
    ]);

    return redirect()->route('riwayat.pesanan')->with('success', 'Pesanan berhasil dibuat.');
}

public function riwayatBaru()
{
    $user = auth()->user();

    $orders = $user->role === 'admin'
        ? \App\Models\Order::with('product', 'user')->latest()->get()
        : \App\Models\Order::with('product')->where('user_id', $user->id)->latest()->get();

    return view('orders.riwayat', compact('orders', 'user'));
}

public function updateStatus(Request $request, Order $order)
{
    $validated = $request->validate([
        'status' => 'required|string|in:proses,diproses,dikirim,selesai,dibatalkan'
    ]);

    $order->update([
        'status' => $validated['status']
    ]);

    return back()->with('success', 'Status diperbarui.');
}





}
