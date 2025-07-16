<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Custom Molded Earplugs 31dB NRR</title>
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
      font-family: 'Inter', sans-serif;
      background-color: #fff;
      color: #111;
      margin: 0;
      padding: 0;
    }
    .color-circle {
      width: 2rem;
      height: 2rem;
      border-radius: 9999px;
      cursor: pointer;
      border: 2px solid transparent;
      transition: border-color 0.3s ease;
    }
    .color-circle.selected {
      border-color: #111;
    }
    button:focus {
      outline: 2px solid #3b82f6;
      outline-offset: 2px;
    }
  </style>
</head>
<body class="bg-white min-h-screen relative font-sans text-gray-900">
@include('layouts.navbar')

  <main class="flex flex-col md:flex-row gap-10 md:gap-20 max-w-6xl mx-auto py-10 px-4">
  <!-- Image Section -->
  <section class="flex-shrink-0 w-72">
  <div class="bg-gray-100 rounded-lg shadow-lg p-4">
    @if ($product->image_url)
      <img 
        src="{{ asset('storage/' . $product->image_url) }}" 
        alt="{{ $product->name }}" 
        class="w-72 h-72 object-cover rounded-md mx-auto" />
    @else
      <img 
        src="https://placehold.co/400x400/png?text=No+Image" 
        alt="No Image" 
        class="w-72 h-72 object-cover rounded-md mx-auto" />
    @endif
  </div>
</section>


  <!-- Details Section -->
  <section class="flex-grow">
    <h1 class="text-2xl md:text-3xl font-extrabold mb-2 leading-tight">{{ $product->name }}</h1>
    
    <!-- Rating and reviews -->
    @if($product->rating)
  <div class="flex items-center space-x-2 mb-4">
    <div class="flex items-center text-yellow-500 font-bold select-none">
      @php
        $stars = floor($product->rating);
        $half = ($product->rating - $stars) >= 0.5;
      @endphp

      {{-- Full stars --}}
      @for ($i = 0; $i < $stars; $i++)
        <svg aria-hidden="true" class="w-5 h-5 inline-block fill-current" viewBox="0 0 20 20">
          <path d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.561-.955L10 0l2.949 5.955 6.561.955-4.755 4.635 1.123 6.545z"/>
        </svg>
      @endfor

      {{-- Half star (optional) --}}
      @if($half)
        <svg aria-hidden="true" class="w-5 h-5 inline-block fill-current text-yellow-300" viewBox="0 0 20 20">
          <defs>
            <linearGradient id="halfGrad">
              <stop offset="50%" stop-color="currentColor"/>
              <stop offset="50%" stop-color="#e5e7eb"/>
            </linearGradient>
          </defs>
          <path fill="url(#halfGrad)" d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.561-.955L10 0l2.949 5.955 6.561.955-4.755 4.635 1.123 6.545z"/>
        </svg>
      @endif

      {{-- Empty stars (if needed to complete to 5) --}}
      @for ($i = $stars + ($half ? 1 : 0); $i < 5; $i++)
        <svg aria-hidden="true" class="w-5 h-5 inline-block fill-current text-gray-300" viewBox="0 0 20 20">
          <path d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.561-.955L10 0l2.949 5.955 6.561.955-4.755 4.635 1.123 6.545z"/>
        </svg>
      @endfor

      {{-- Angka rating --}}
      <span class="ml-2 text-gray-800 text-sm font-semibold">
        {{ number_format($product->rating, 1) }}
      </span>
    </div>

    {{-- Jumlah review --}}
    <span class="text-gray-500 text-sm">| {{ $product->reviews ?? 0 }} Reviews</span>
  </div>
@endif


    <!-- Deskripsi Produk -->
    <p class="text-gray-700 mb-6">{{ $product->description }}</p>

    <!-- Price -->
    <p class="text-xl font-bold text-green-600 mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

   <!-- Quantity -->
<div class="mb-6">
  <label for="quantityDisplay" class="font-semibold block mb-2">Quantity:</label>
  <div class="inline-flex border border-gray-300 rounded-md overflow-hidden">
    <button type="button" aria-label="Decrease quantity" id="decreaseQty" class="px-3 py-1 text-lg bg-gray-100 hover:bg-gray-200 transition">−</button>
    <input id="quantityDisplay" type="text" inputmode="numeric" pattern="[0-9]*" value="1" readonly class="w-12 text-center text-lg font-medium" aria-live="polite" aria-label="Quantity input" />
    <button type="button" aria-label="Increase quantity" id="increaseQty" class="px-3 py-1 text-lg bg-gray-100 hover:bg-gray-200 transition">+</button>
  </div>
</div>

<!-- Input tersembunyi yang digunakan oleh kedua aksi -->
    <input type="hidden" id="quantityHidden" name="quantity" value="1">
    <input type="hidden" id="productId" value="{{ $product->id }}">

    <div class="flex flex-col sm:flex-row gap-4 mb-6">

    <button id="addToCart" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-black text-white font-semibold py-3 px-4 rounded-md hover:bg-gray-900 transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.3 5.2A1 1 0 007 20h10a1 1 0 001-1.3L17 13M9 21h.01M15 21h.01"/>
    </svg>
    <span>Keranjang</span>
    </button>

    <form action="{{ route('checkout.form', ['product' => $product->id]) }}" method="GET">
    <input type="hidden" name="quantity" id="checkoutQuantity" value="1">
    <button type="submit" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-blue-600 text-white font-semibold py-3 px-4 rounded-md hover:bg-blue-700 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span>Beli Sekarang</span>
    </button>
  </form>


</form>






    </div>
  </section>
</main>

  </main>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const colorButtons = document.querySelectorAll('button.color-circle');
    const quantityInput = document.getElementById('quantity');
    const quantityDisplay = document.getElementById('quantityDisplay') || quantityInput;
    const quantityHidden = document.getElementById('quantityHidden');
    const checkoutQuantity = document.getElementById('checkoutQuantity');
    const increaseBtn = document.getElementById('increaseQty');
    const decreaseBtn = document.getElementById('decreaseQty');
    const addToCartBtn = document.getElementById('addToCart');
    const shopPayBtn = document.getElementById('buyWithShopPay');
    const openCartBtn = document.getElementById('openCartBtn');

    let selectedColorBtn = document.querySelector('button.color-circle.selected');

    // ======= Color Selection =======
    colorButtons.forEach(button => {
      button.addEventListener('click', () => selectColor(button));
      button.addEventListener('keydown', (e) => {
        if (['ArrowRight', 'ArrowDown'].includes(e.key)) {
          e.preventDefault();
          focusNextColor(button);
        } else if (['ArrowLeft', 'ArrowUp'].includes(e.key)) {
          e.preventDefault();
          focusPrevColor(button);
        } else if (['Enter', ' '].includes(e.key)) {
          e.preventDefault();
          selectColor(button);
        }
      });
    });

    function selectColor(button) {
      if (selectedColorBtn) {
        selectedColorBtn.classList.remove('selected');
        selectedColorBtn.setAttribute('aria-checked', 'false');
        selectedColorBtn.tabIndex = -1;
      }
      button.classList.add('selected');
      button.setAttribute('aria-checked', 'true');
      button.tabIndex = 0;
      button.focus();
      selectedColorBtn = button;
    }

    function focusNextColor(current) {
      const idx = [...colorButtons].indexOf(current);
      const next = colorButtons[(idx + 1) % colorButtons.length];
      next.focus();
    }

    function focusPrevColor(current) {
      const idx = [...colorButtons].indexOf(current);
      const prev = colorButtons[(idx - 1 + colorButtons.length) % colorButtons.length];
      prev.focus();
    }

    // ======= Quantity Handling =======
    function updateQuantityDisplay(value) {
      if (quantityInput) quantityInput.value = value;
      if (quantityDisplay) quantityDisplay.value = value;
      if (quantityHidden) quantityHidden.value = value;
      if (checkoutQuantity) checkoutQuantity.value = value;
    }

    if (increaseBtn) {
      increaseBtn.addEventListener('click', () => {
        let currentVal = parseInt(quantityDisplay.value || '1', 10);
        if (currentVal < 999) {
          updateQuantityDisplay(currentVal + 1);
        }
      });
    }

    if (decreaseBtn) {
      decreaseBtn.addEventListener('click', () => {
        let currentVal = parseInt(quantityDisplay.value || '1', 10);
        if (currentVal > 1) {
          updateQuantityDisplay(currentVal - 1);
        }
      });
    }

    // ======= Add to Cart =======
    if (addToCartBtn) {
    addToCartBtn.addEventListener('click', function () {
      const productId = document.getElementById('productId')?.value;
      const quantity = parseInt(quantityInput.value, 10) || 1;
      const selectedColor = selectedColorBtn?.dataset.color || 'default';

      alert(`Added ${quantity} item(s) of color ${selectedColor} to cart.`);

      fetch('{{ route('cart.add') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          product_id: productId,
          quantity: quantity,
          color: selectedColor
        }),
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Produk ditambahkan ke keranjang!');
          loadCartData();
        } else {
          alert('Gagal menambahkan ke keranjang.');
        }
      })
      .catch(err => {
        console.error(err);
        alert('Terjadi kesalahan saat menambahkan ke keranjang.');
      });
    });
  }

    // ======= Shop Pay Button =======
    if (shopPayBtn) {
      shopPayBtn.addEventListener('click', () => {
        const qty = quantityInput.value || 1;
        const selectedColor = selectedColorBtn?.dataset.color || 'default';
        alert(`Redirecting to Shop Pay checkout for ${qty} item(s) of color ${selectedColor}.`);
      });
    }

    // ======= Load Cart Data =======
    function loadCartData() {
      fetch('/cart/data')
        .then(response => response.json())
        .then(data => {
          const cartList = document.querySelector('#cartMenu .cart-item-list');
          if (!cartList) {
            setTimeout(loadCartData, 300); // Retry
            return;
          }

          cartList.innerHTML = '';

          data.items.forEach(item => {
            const product = item.product;
            const quantity = item.quantity;

            const itemHTML = `
              <div class="cart-item">
                <img src="${product.image_url}" width="50" />
                <span>${product.name}</span>
                <span>${quantity} x Rp${parseFloat(product.price).toLocaleString()}</span>
              </div>
            `;
            cartList.innerHTML += itemHTML;
          });

          const subtotalEl = document.querySelector('#cartMenu .subtotal span:last-child');
          if (subtotalEl) {
            subtotalEl.textContent = `Rp${parseFloat(data.subtotal).toLocaleString()}`;
          }
        });
    }

    // ======= Open Cart =======
    if (openCartBtn) {
      openCartBtn.addEventListener('click', function () {
        document.getElementById('cartMenu')?.setAttribute('aria-hidden', 'false');
        loadCartData();
      });
    }

    // ======= Dropdown Menu Desktop =======
    document.querySelectorAll('[data-dropdown]').forEach(button => {
      button.addEventListener('click', () => {
        const expanded = button.getAttribute('aria-expanded') === 'true';
        document.querySelectorAll('[data-dropdown]').forEach(btn => btn.setAttribute('aria-expanded', 'false'));
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

    // ======= Mobile Menu Toggle =======
    const nav = document.querySelector('nav');
    const mobileButton = document.querySelector('.mobile-menu-button');

    if (mobileButton) {
      mobileButton.addEventListener('click', () => {
        nav?.classList.toggle('mobile-menu-open');
      });
    }
  });
</script>
<script src="/js/cart.js"></script>
</body>
</html>

