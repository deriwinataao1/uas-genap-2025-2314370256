<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $cartItem = Cart::firstOrNew([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        $cartItem->quantity += $request->input('quantity', 1);
        $cartItem->save();

        return response()->json(['success' => true]);
    }

   public function data()
{
    $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

    $items = $cartItems->map(function ($item) {
        return [
            'product' => [
                'name' => $item->product->name,
                'price' => $item->product->price,
                'image_url' => $item->product->image_url 
                    ? asset('storage/' . $item->product->image_url)
                    : 'https://placehold.co/300x300/png?text=No+Image',
            ],
            'quantity' => $item->quantity,
        ];
    });

    $subtotal = $cartItems->sum(fn ($item) => $item->product->price * $item->quantity);

    return response()->json([
        'items' => $items,
        'subtotal' => $subtotal,
    ]);
}


    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);

        // Pastikan item milik user yang sedang login
        if ($cartItem->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
    
}
