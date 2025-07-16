<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Decibullz Product Display</title>
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
    .star {
      color: #f97316; /* Tailwind orange-500 */
      width: 16px;
      height: 16px;
      display: inline-block;
      fill: currentColor;
      margin-right: 1px;
    }
    .star.empty {
      color: #d1d5db; /* Tailwind gray-300 */
    }
    .rating-section {
      display: flex;
      align-items: center;
      gap: 0.25rem;
      font-size: 0.875rem; /* text-sm */
      color: #374151; /* Tailwind gray-700 */
    }
    .reviews-count {
      color: #6b7280; /* Tailwind gray-500 */
      font-weight: 400;
    }
    .product-card {
      max-width: 280px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background-color: #fff;
      border-radius: 0.5rem;
      box-shadow: 0 1px 5px rgb(0 0 0 / 0.1);
      padding: 1.5rem 1rem 2rem 1rem;
      transition: box-shadow 0.3s ease;
      cursor: default;
    }
    .product-card:hover {
      box-shadow: 0 8px 20px rgb(0 0 0 / 0.15);
    }
    .btn-add {
      background-color: #000;
      color: #fff;
      border: none;
      padding: 0.6rem 1.25rem;
      font-weight: 600;
      font-size: 0.875rem;
      border-radius: 0.25rem;
      transition: background-color 0.3s ease;
      cursor: pointer;
      margin-top: 1rem;
      text-align: center;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      user-select: none;
    }
    .btn-add:hover {
      background-color: #1f2937; /* Tailwind slate-800 */
    }
    .product-title {
      font-size: 1.05rem;
      font-weight: 700;
      color: #111827; /* Tailwind gray-900 */
      margin-bottom: 0.4rem;
      min-height: 4.3em; /* roughly 3 lines */
      overflow: hidden;
      line-height: 1.3em;
    }
    .price {
      font-weight: 700;
      font-size: 1.125rem;
      color: #111827;
      margin-top: 0.3rem;
    }
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .products-container {
        gap: 1.25rem;
      }
      .product-card {
        max-width: 100%;
      }
    }
  </style>
</head>
<body class="bg-gradient-to-b from-gray-100 to-white min-h-screen relative font-sans text-gray-900">
    @include('layouts.navbar')
    <main class="relative max-w-7xl mx-auto px-8 py-20 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 min-h-[600px]">

    @foreach($products as $product)
    <article class="relative product-card cursor-pointer border rounded-lg p-4 hover:shadow-lg transition" 
         tabindex="0" 
         aria-labelledby="product{{ $loop->iteration }}-title" 
         role="group" 
         aria-describedby="product{{ $loop->iteration }}-desc">

    {{-- Link overlay agar seluruh card bisa diklik --}}
    <a href="{{ route('products.show', $product->id) }}" class="absolute inset-0 z-10" aria-hidden="true"></a>
      <div class="product-image w-full mb-4 text-center">
          @if ($product->image_url)
              <img 
                  src="{{ asset('storage/' . $product->image_url) }}" 
                  alt="{{ $product->name }}" 
                  class="mx-auto mb-2 w-60 h-60 object-cover rounded shadow"
                  onerror="this.onerror=null;this.src='https://placehold.co/280x240/png?text=Image+Unavailable';"
                  oncontextmenu="return false;"
              />
          @else
              <img 
                  src="https://placehold.co/240x240/png?text=No+Image" 
                  alt="No image" 
                  class="mx-auto w-60 h-60 object-cover rounded"
              />
          @endif
      </div>


      <h2 id="product{{ $loop->iteration }}-title" class="product-title">{{ $product->name }}</h2>
      <div id="product{{ $loop->iteration }}-desc" class="rating-section" aria-label="{{ $product->rating ?? 'No rating' }}">
        {{-- Tampilkan rating bintang (misal 4.3) --}}
        @php
      $fullStars = floor($product->rating ?? 0);
      $halfStar = ($product->rating ?? 0) - $fullStars >= 0.5;
      $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
    @endphp

    @for($i = 0; $i < $fullStars; $i++)
      <svg class="text-yellow-400 w-5 h-5 inline" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.462a1 1 0 00-.364 1.118l1.287 3.967c.3.921-.755 1.688-1.539 1.118l-3.388-2.462a1 1 0 00-1.176 0l-3.388 2.462c-.783.57-1.838-.197-1.539-1.118l1.287-3.967a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.967z" />
      </svg>
    @endfor

    @if($halfStar)
      <svg class="text-yellow-400 w-5 h-5 inline" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
        <defs>
          <linearGradient id="half">
            <stop offset="50%" stop-color="currentColor"/>
            <stop offset="50%" stop-color="transparent"/>
          </linearGradient>
        </defs>
        <path fill="url(#half)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967..." />
      </svg>
    @endif

    @for($i = 0; $i < $emptyStars; $i++)
      <svg class="text-gray-300 w-5 h-5 inline" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967..." />
      </svg>
    @endfor

    <span class="ml-2 text-sm text-gray-600">
      {{ number_format($product->rating ?? 0, 1) }} | {{ $product->reviews ?? 0 }} Reviews
    </span>

      </div>
      <button class="btn-add" aria-label="Add {{ $product->name }} to cart">Rp. {{ number_format($product->price, 2) }}</button>
    </article>

@endforeach
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
        
    document.querySelectorAll('.btn-add').forEach(button => {
        button.addEventListener('click', () => {
            const productTitle = button.closest('.product-card').querySelector('.product-title').textContent.trim();
            alert(productTitle + ' added to cart.');
        });
    });
</script>
</body>
</html>

