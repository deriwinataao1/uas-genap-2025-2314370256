<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Toko Kami</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles & Scripts (Vite) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-white text-gray-900 font-sans">

    <!-- Navbar -->
    <header class="w-full py-4 shadow-sm bg-white">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">TokoBarang</h1>

            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-blue-600">
                    Dashboard
                </a>
            @else
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="text-sm hover:text-blue-600">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm hover:text-blue-600">Register</a>
                    @endif
                </div>
            @endauth
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 grid grid-cols-1 md:grid-cols-2 items-center gap-12">
        <!-- Left Content -->
        <div>
            <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                Selamat Datang di <span class="text-blue-600">TokoBarang</span><br />
                Belanja Mudah & Aman
            </h2>
            <p class="text-lg text-gray-700 mb-6">
                Temukan berbagai produk pilihan dengan harga terbaik dan kualitas terpercaya. Mulai belanja sekarang!
            </p>
            <a href="#" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md shadow hover:bg-blue-700 transition">
                Lihat Produk
            </a>
        </div>

        <!-- Right Image -->
        <div class="flex justify-center">
            <img 
                src="{{ asset('images/produk-unggulan.png') }}" 
                alt="Produk Unggulan" 
                class="w-[400px] h-auto drop-shadow-xl rounded-lg"
            />
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-6 border-t text-sm text-gray-500">
        &copy; {{ date('Y') }} TokoBarang. Semua hak dilindungi.
    </footer>

</body>
</html>
