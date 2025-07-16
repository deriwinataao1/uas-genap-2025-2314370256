<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Decibullz - Professional Music Filters</title>
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
    </style>
</head>

<body class="bg-gradient-to-b from-gray-100 to-white min-h-screen relative font-sans text-gray-900">

    <!-- Navigation -->
    @include('layouts.navbar')

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif
    <main class="max-w-5xl mx-auto px-4 py-10" 
    x-data="{ 
        open: false, 
        showEditModal: false, 
        editId: null, 
        editName: '', 
        openEditModal(id, name) { 
            this.showEditModal = true; 
            this.editId = id; 
            this.editName = name; 
        } 
    }">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Data Categories</h1>
            <!-- Button open modal -->
            <button @click="open = true"
                class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                + Tambah Category
            </button>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-md rounded overflow-x-auto">
            <table class="w-full table-auto text-sm text-left">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama Category</th>
                        <th class="px-6 py-3">Dibuat</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($categories as $category)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $category->name }}</td>
                        <td class="px-6 py-4">{{ $category->created_at->format('d-m-Y') }}</td>
                        <td class="px-6 py-4 text-right">
                        <button @click="openEditModal({{ $category->id }}, '{{ $category->name }}')" 
                            class="text-blue-600 hover:underline mr-3">
                            Edit
                        </button>
                        <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete({{ $category->id }})" class="text-red-600 hover:underline">
                                Hapus
                            </button>
                        </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada kategori</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Edit Modal -->
        <div x-show="showEditModal" 
            class="fixed inset-0 bg-black bg-opacity-50 z-40 flex items-center justify-center" 
            x-cloak>
            
            <!-- Modal Box -->
            <div 
                class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg animate-fadeInUp" 
                @click.outside="showEditModal = false">
                
                <h2 class="text-xl font-bold mb-4">Edit Category</h2>
                <form :action="'/categories/' + editId" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_name" class="block text-sm font-medium text-gray-700">Nama Category</label>
                        <input type="text" name="name" id="edit_name" x-model="editName"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-lg py-3 px-4 focus:ring focus:ring-blue-300"
                            required>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="showEditModal = false"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Modal Tambah Category -->
        <div x-show="open" class="fixed inset-0 z-40 bg-black bg-opacity-50 flex items-center justify-center"
            x-cloak>
            <div @click.away="open = false"
                class="bg-white p-6 rounded-lg shadow-md w-full max-w-md animate-fadeInUp">
                <h2 class="text-xl font-semibold mb-4">Tambah Category</h2>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Category</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-lg py-2 px-4 focus:ring focus:ring-blue-300"
                            required>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="open = false"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800">Batal</button>
                        <button type="submit"
                            class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

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
        
        function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data kategori yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>