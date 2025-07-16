<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout Pesanan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Checkout Pesanan</h1>

        <form action="{{ route('orders.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <!-- Kiri: Formulir -->
            <div>
                <h2 class="text-lg font-semibold mb-4">RINCIAN PENAGIHAN</h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium">Nama Penerima <span class="text-red-500">*</span></label>
                        <input name="nama_penerima" required class="w-full border border-gray-300 rounded p-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Negara <span class="text-red-500">*</span></label>
                        <input name="negara" value="Indonesia" required class="w-full border border-gray-300 rounded p-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Provinsi <span class="text-red-500">*</span></label>
                        <input name="provinsi" required class="w-full border border-gray-300 rounded p-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Kota <span class="text-red-500">*</span></label>
                        <input name="kota" required class="w-full border border-gray-300 rounded p-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Alamat Jalan <span class="text-red-500">*</span></label>
                        <input name="alamat_jalan" required class="w-full border border-gray-300 rounded p-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Kode Pos <span class="text-red-500">*</span></label>
                        <input name="kode_pos" required class="w-full border border-gray-300 rounded p-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium">No Telepon <span class="text-red-500">*</span></label>
                        <input name="telepon" required class="w-full border border-gray-300 rounded p-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" required class="w-full border border-gray-300 rounded p-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Catatan</label>
                        <textarea name="catatan" rows="3" class="w-full border border-gray-300 rounded p-2"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Metode Pembayaran <span class="text-red-500">*</span></label>
                        <select name="pembayaran" required class="w-full border border-gray-300 rounded p-2">
                            <option value="cod">COD (Bayar di tempat)</option>
                            <option value="dana">DANA</option>
                            <option value="ovo">OVO</option>
                            <option value="bank">Transfer Bank</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Kanan: Ringkasan Pesanan -->
            <div>
                <h2 class="text-lg font-semibold mb-4">PESANAN ANDA</h2>

                <div class="border border-gray-200 rounded p-4 bg-gray-50 shadow-sm">
                    <div class="flex justify-between font-medium mb-2">
                        <span>PRODUK</span>
                        <span>SUBTOTAL</span>
                    </div>

                                        <div class="flex justify-between border-b py-2 text-sm">
                        <span>{{ $product->name }} × {{ $quantity }}</span>
                        <span>Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between mt-4 font-semibold text-lg">
                        <span>Total</span>
                        <span class="text-red-600">Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}</span>
                    </div>

                </div>

                <!-- Hidden Input -->
                <input type="hidden" name="quantity" value="{{ request('quantity', 1) }}">
                <input type="hidden" name="total_harga" value="{{ $product->price * request('quantity', 1) }}">

                <!-- Tombol Submit -->
                <button type="submit" class="mt-6 w-full bg-black text-white py-3 rounded hover:bg-gray-800 transition">
                    TEMPAT PESANAN
                </button>
            </div>
        </form>
    </div>

</body>
</html>
