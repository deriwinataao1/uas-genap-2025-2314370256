<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        $categories = Category::all(); // Ambil semua kategori
        return view('products.index', compact('products', 'categories'));
    }
    public function daftar()
    {
        $products = Product::with('category')->latest()->get();
        $categories = Category::all(); // Ambil semua kategori
        return view('products.daftar', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'is_publish' => 'nullable|boolean',
        ]);

        if ($request->has('is_publish')) {
            $validated['published_at'] = Carbon::now();
            $validated['is_publish'] = true;
        } else {
            $validated['is_publish'] = false;
            $validated['published_at'] = null;
        }

         // Simpan gambar jika di-upload
    if ($request->hasFile('image_url')) {
        $imagePath = $request->file('image_url')->store('images/products', 'public');
        $validated['image_url'] = $imagePath;
    }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_publish' => 'nullable|boolean',
        ]);

        if ($request->has('is_publish')) {
            $validated['published_at'] = $product->published_at ?? Carbon::now();
            $validated['is_publish'] = true;
        } else {
            $validated['is_publish'] = false;
            $validated['published_at'] = null;
        }
        // Simpan gambar baru jika di-upload
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('images/products', 'public');
            $validated['image_url'] = $imagePath;
        }
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product berhasil dihapus.');
    }

    public function show(Product $product)
{
    return view('products.show', compact('product'));
}

}
