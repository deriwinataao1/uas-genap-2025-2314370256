<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Decibullz - Professional Music Filters</title>
  <script src="https://cdn.tailwindcss.com"></script>
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

    [data-dropdown] > svg {
      transition: transform 0.3s ease;
      margin-left: 4px;
      vertical-align: middle;
    }

    [data-dropdown][aria-expanded="true"] > svg {
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

    [data-dropdown][aria-expanded="true"] + .dropdown-menu {
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

  <!-- Hero Section -->
  <main class="relative w-full px-4 md:px-8 py-20 flex flex-col md:flex-row items-center md:items-start min-h-[600px] overflow-hidden bg-white">


    <!-- Left Text -->
    <div class="md:w-1/2 z-10 space-y-6 max-w-lg">
      <p class="text-sm font-semibold text-blue-700 tracking-widest uppercase animate-fadeInLeft" style="animation-delay: 0.2s;">
        Belanja Produk Terbaik
      </p>
      <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 animate-fadeInLeft" style="animation-delay: 0.35s;">
        Temukan <br class="hidden md:block" /> Produk Favoritmu <br class="hidden md:block" /> Sekarang Juga!
      </h1>
      <p class="text-gray-700 text-lg leading-relaxed animate-fadeInUp" style="animation-delay: 0.55s;">
        Kami menyediakan berbagai produk berkualitas tinggi dengan harga terbaik. Mulai dari kebutuhan sehari-hari hingga perlengkapan spesial.
      </p>
      <a href="{{ route('products.daftar') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md shadow-md font-semibold hover:bg-blue-700 transition animate-fadeInUp" style="animation-delay: 0.7s;">
        Lihat Produk
      </a>
    </div>

    <!-- Right Product Image -->
<div class="md:w-1/2 relative z-0 mt-10 md:mt-0 flex justify-center md:justify-end">
  <img src="{{ asset('images/unggulan.jpeg') }}"
    alt="Produk unggulan toko"
    class="max-w-full w-[480px] h-auto drop-shadow-xl"
    onerror="this.style.display='none'" />
</div>
//tess

    <!-- Background Element -->
    <div class="hero-bg"></div>
  </main>

  <!-- Floating Chat or Help Button -->
  <button role="button" aria-label="Chat dengan admin" class="chat-btn" title="Chat dengan admin">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6M5 21h14a2 2 0 0 0 2-2v-5a9 9 0 1 0-18 0v5a2 2 0 0 0 2 2z" />
    </svg>
  </button>

  <!-- Scripts -->
  <script>
    // Toggle for dropdowns
    document.querySelectorAll('[data-dropdown]').forEach(button => {
      button.addEventListener('click', () => {
        const expanded = button.getAttribute('aria-expanded') === 'true';
        document.querySelectorAll('[data-dropdown]').forEach(btn => btn.setAttribute('aria-expanded', 'false'));
        button.setAttribute('aria-expanded', String(!expanded));
      });
    });

    document.addEventListener('click', (e) => {
      if (!e.target.closest('[data-dropdown]')) {
        document.querySelectorAll('[data-dropdown]').forEach(btn => {
          btn.setAttribute('aria-expanded', 'false');
        });
      }
    });

    // Mobile nav toggle
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

