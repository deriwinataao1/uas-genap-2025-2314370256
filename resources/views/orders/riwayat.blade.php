<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
               /* Custom fonts and styling for logo */
               @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap');

/* Reset some default button styles */
button {
    font-weight: 600;
    text-transform: uppercase;
    transition: background-color 0.3s ease;
}

/* Fade in left animation for headline */
@keyframes fadeInLeft {
    0% {
        opacity: 0;
        transform: translateX(-25px);
    }

    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(25px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeInLeft {
    animation-name: fadeInLeft;
    animation-duration: 0.9s;
    animation-fill-mode: forwards;
    opacity: 0;
}

.animate-fadeInUp {
    animation-name: fadeInUp;
    animation-duration: 1s;
    animation-fill-mode: forwards;
    opacity: 0;
}

/* Navbar dropdown arrow rotation */
[data-dropdown] {
    position: relative;
    cursor: pointer;
    user-select: none;
}

[data-dropdown]>svg {
    transition: transform 0.3s ease;
    margin-left: 4px;
    vertical-align: middle;
}

[data-dropdown][aria-expanded="true"]>svg {
    transform: rotate(180deg);
}

/* Dropdown menu panel */
nav .dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    box-shadow: 0 4px 10px rgb(0 0 0 / 0.1);
    padding: 0.5rem 0;
    margin-top: 0.25rem;
    border-radius: 0.25rem;
    min-width: 180px;
    z-index: 50;
}

nav .dropdown-menu a {
    display: block;
    padding: 0.5rem 1rem;
    font-weight: 500;
    color: #27272a;
    text-decoration: none;
    transition: background-color 0.2s ease;
}

nav .dropdown-menu a:hover,
nav .dropdown-menu a:focus {
    background-color: #e5e7eb;
    outline: none;
}

[data-dropdown][aria-expanded="true"]+.dropdown-menu {
    display: block;
}

/* Search icon rotate on focus */
.search-button:focus-visible {
    outline-offset: 2px;
    outline: 2px solid #3b82f6;
    border-radius: 0.375rem;
}

/* Cart, user icons hover */
.icon-btn:hover {
    color: #3b82f6;
}

/* Responsive adjustments on small devices */
@media (max-width: 768px) {
    nav ul {
        display: none;
    }

    nav .mobile-menu-button {
        display: block;
    }
}

/* Mobile menu */
nav.mobile-menu-open ul.mobile-menu {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    background: white;
    padding: 1rem;
    position: absolute;
    top: 64px;
    left: 0;
    right: 0;
    border-top: 1px solid #d1d5db;
    z-index: 60;
}

/* Chat bubble button bottom right */
.chat-btn {
    position: fixed;
    bottom: 1.5rem;
    right: 1.5rem;
    width: 48px;
    height: 48px;
    background: white;
    border-radius: 50%;
    box-shadow: 0 6px 12px rgb(0 0 0 / 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: box-shadow 0.3s ease;
    z-index: 100;
}

.chat-btn:hover {
    box-shadow: 0 8px 16px rgb(0 0 0 / 0.3);
}

/* Background image overlay */
.hero-bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(18, 18, 18, 0.6), rgba(245, 245, 245, 0.25));
    pointer-events: none;
    z-index: 0;
}
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #e5e7eb;
        }

        select {
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .text-center {
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body class="bg-gradient-to-b from-gray-100 to-white min-h-screen relative font-sans text-gray-900">
@include('layouts.navbar')
<div class="container mt-12">
    <h1>Riwayat Pesanan</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
        <thead class="bg-gray-100">
            <tr>
                <th>Order Code</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Total</th>
                @if ($user->role === 'admin')
                    <th>User</th>
                @endif
                <th>Status</th>
                @if ($user->role === 'admin')
                    <th>Ubah Status</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->order_code }}</td>
                    <td>{{ $order->product->nama ?? 'N/A' }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    @if ($user->role === 'admin')
                        <td>{{ $order->user->name ?? '-' }}</td>
                    @endif
                    <td>{{ ucfirst($order->status) }}</td>
                    @if ($user->role === 'admin')
                        <td>
                        <form action="{{ route('riwayat.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            @php
                            $statuses = ['proses', 'diterima', 'dikemas', 'diantar', 'selesai', 'ditolak'];
                        @endphp
                        <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1">
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>

                        </form>

                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada pesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<script>
        // Dropdown toggle functionality for desktop nav
        document.querySelectorAll('[data-dropdown]').forEach(button => {
            button.addEventListener('click', () => {
                const expanded = button.getAttribute('aria-expanded') === 'true';
                // Close all dropdowns first
                document.querySelectorAll('[data-dropdown]').forEach(btn => btn.setAttribute('aria-expanded', 'false'));
                // Toggle the clicked one
                button.setAttribute('aria-expanded', String(!expanded));
            });
        });

        // Close dropdown if clicked outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('[data-dropdown]')) {
                document.querySelectorAll('[data-dropdown]').forEach(btn => {
                    btn.setAttribute('aria-expanded', 'false');
                });
            }
        });

        // Mobile menu toggle
        const nav = document.querySelector('nav');
        const mobileButton = document.querySelector('.mobile-menu-button');

        if (mobileButton) {
            mobileButton.addEventListener('click', () => {
                nav.classList.toggle('mobile-menu-open');
            });
        }
        </script>
</body>
</html>
