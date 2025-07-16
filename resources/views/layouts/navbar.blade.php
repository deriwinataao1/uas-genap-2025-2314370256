<style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      overflow-x: hidden;
    }
    /* Button to open cart */
    .btn-cart {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #000;
      color: white;
      border: none;
      padding: 12px 18px;
      font-weight: bold;
      cursor: pointer;
      border-radius: 4px;
      z-index: 1001;
      transition: background-color 0.3s;
    }
    .btn-cart:hover {
      background-color: #333;
    }
    /* Overlay behind cart */
    .overlay {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.4);
      z-index: 1000;
    }
    /* Cart side panel */
    .cart-menu {
      position: fixed;
      top: 0;
      right: -400px;
      width: 380px;
      height: 100vh;
      background-color: #fff;
      box-shadow: -5px 0 15px rgba(0,0,0,0.3);
      display: flex;
      flex-direction: column;
      overflow-y: auto;
      transition: right 0.4s ease;
      z-index: 1002;
    }
    .cart-menu.open {
      right: 0;
    }
    /* Header */
    .cart-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 24px;
      border-bottom: 1px solid #ddd;
      font-weight: bold;
      font-size: 1.25rem;
      background-color: #f9f9f9;
      position: sticky;
      top: 0;
      z-index: 10;
    }
    .close-btn {
      background: none;
      border: none;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
    }
    .close-btn:hover {
      color: #c00;
    }
    /* Cart item */
    .cart-item {
      display: flex;
      padding: 16px 24px;
      border-bottom: 1px solid #eee;
    }
    .cart-item img {
      width: 80px;
      height: 80px;
      object-fit: contain;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-right: 16px;
      flex-shrink: 0;
      background-color: #fff;
    }
    .item-details {
      flex-grow: 1;
      font-size: 14px;
      color: #222;
    }
    .item-details strong {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      font-size: 15px;
      color: #000;
      line-height: 1.2;
    }
    .item-details small {
      color: #666;
    }
    .item-details .price {
      margin-top: 6px;
      font-weight: 700;
      color: #111;
    }
    .remove-item-btn {
      cursor: pointer;
      color: #999;
      font-size: 18px;
      align-self: start;
      background: none;
      border: none;
      padding: 0;
      transition: color 0.3s;
    }
    .remove-item-btn:hover {
      color: #c00;
    }
    /* Cart footer with subtotal and buttons */
    .cart-footer {
      margin-top: auto;
      border-top: 1px solid #ddd;
      padding: 16px 24px;
      background: #fafafa;
    }
    .subtotal {
      display: flex;
      justify-content: space-between;
      font-weight: 700;
      font-size: 1.1rem;
      margin-bottom: 12px;
      color: #111;
    }
    .footer-buttons {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .footer-buttons button {
      padding: 12px;
      font-weight: 700;
      border: none;
      cursor: pointer;
      border-radius: 4px;
      transition: background-color 0.3s;
    }
    .btn-view-cart {
      background-color: #eee;
      color: #222;
    }
    .btn-view-cart:hover {
      background-color: #ddd;
    }
    .btn-checkout {
      background-color: #111;
      color: white;
    }
    .btn-checkout:hover {
      background-color: #333;
    }
    /* WhatsApp floating button */
    .whatsapp-btn {
      position: fixed;
      bottom: 25px;
      right: 25px;
      background-color: #25d366;
      width: 56px;
      height: 56px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(0,0,0,0.3);
      transition: background-color 0.3s;
      z-index: 1003;
      font-size: 28px;
      color: white;
    }
    .whatsapp-btn:hover {
      background-color: #1ebe57;
    }
  </style>

<nav class="flex items-center justify-between px-8 py-4 w-full sticky top-0 bg-white bg-opacity-90 backdrop-blur-sm shadow-sm z-50 select-none" aria-label="Primary Navigation">

<div class="flex items-center space-x-4">
  <!-- Logo - stylized Decibullz text with icon -->
  <a href="#" class="flex items-center space-x-2">
    <svg width="26" height="26" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg"
      aria-hidden="true" focusable="false" class="text-gray-900">
      <path fill="currentColor"
        d="M19.5 5L30.145 31L24.294 31L20.153 20.448L16.011 31L10.16 31L19.5 5Z" />
    </svg>
    <span class="text-2xl font-bold tracking-wide" aria-label="Decibullz logo text">BARANGKU</span>
  </a>
</div>

<!-- Desktop Menu -->
<ul class="hidden md:flex items-center space-x-8 font-semibold text-gray-700" role="menubar">
<li role="none">
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}" role="menuitem" tabindex="0" class="hover:text-gray-900 transition">
            Home
        </a>
    @else
        <a href="{{ route('dashboard') }}" role="menuitem" tabindex="0" class="hover:text-gray-900 transition">
            Home
        </a>
    @endif
</li>

@auth
    @if(auth()->user()->role === 'admin')
        <li role="none">
            <a href="{{ route('admin.categories') }}" role="menuitem" tabindex="0" class="hover:text-gray-900 transition">
                Daftar Kategori
            </a>
        </li>
        <li role="none">
          <a href="{{route('products.index')}}" role="menuitem" tabindex="0" class="hover:text-gray-900 transition">Daftar Produk</a>
        </li>
    @endif
@endauth

  <li class="relative" role="none">
    <button aria-haspopup="true" aria-expanded="false" data-dropdown="shop" class="flex items-center gap-1"
    role="menuitem" tabindex="0">Produk <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
    stroke-width="2.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true" focusable="false">
    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
  </svg></button>
  <div class="dropdown-menu" role="menu" aria-label="Shop submenu">
    <a href="{{route('products.daftar')}}" role="menuitem" tabindex="-1">Semua Produk</a>
    <!-- <a href="#" role="menuitem" tabindex="-1">Hearing Protection</a>
    <a href="#" role="menuitem" tabindex="-1">Replacement Parts</a> -->
  </div>
</li>

<li role="none">
  <a href="{{route('riwayat.pesanan')}}" role="menuitem" tabindex="0" class="hover:text-gray-900 transition">Riwayat Pesanan</a>
</li>
</ul>

<!-- Right side icons -->
<div class="flex items-center space-x-6 text-gray-700">
  <!-- Search icon -->
  <button aria-label="Search" class="search-button focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
    title="Search Decibullz">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
      stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M21 21l-4.35-4.35M11 18a7 7 0 1 0 0-14 7 7 0 0 0 0 14z" />
    </svg>
  </button>

  <!-- User icon -->
  <a href="{{ route('profile.edit') }}" aria-label="Account"
   class="icon-btn focus:outline-none hover:text-blue-500 transition" title="Account">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M5.121 17.804A9 9 0 1 1 18.879 6.196M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
    </svg>
</a>


  <!-- Shopping Cart icon -->
  <button id="openCartBtn" aria-label="Cart" class="icon-btn focus:outline-none hover:text-blue-500 transition" title="Cart">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
      stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M3 3h2l.857 6m9.143-6H21l-1.333 6.667M7 21a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
    </svg>
  </button>
  <div class="overlay" id="overlay"></div>

  <aside class="cart-menu" id="cartMenu" aria-label="Shopping cart menu" role="dialog" aria-modal="true" aria-hidden="true">
  <header class="cart-header">
    <div>Shopping cart</div>
    <button aria-label="Close shopping cart menu" class="close-btn" id="closeCartBtn">&times; Close</button>
  </header>

 @php
  $subtotal = 0;
@endphp

@forelse ($cartItems as $item)
  @php
    $product = $item->product;
    $totalPrice = $product->price * $item->quantity;
    $subtotal += $totalPrice;
  @endphp
  <div class="cart-item" tabindex="0">
   <img src="{{ $product->image_url }}" 
     alt="GAMBAR {{ $product->name }}" 
     width="100" height="100" style="border: 1px solid red;"
     onerror="this.onerror=null;this.src='{{ asset('fallback-image.png') }}';" />

    <div class="item-details">
      <strong>{{ strtoupper($product->name) }} - {{ $item->size ?? '-' }}</strong>
      <small>{{ $item->quantity }} × Rp{{ number_format($product->price, 0, ',', '.') }}</small>
      <div class="price"><strong>Rp{{ number_format($totalPrice, 0, ',', '.') }}</strong></div>
    </div>
    <form method="POST" action="{{ route('cart.remove', $item->id) }}">
    @csrf
    @method('DELETE')
    <button class="remove-item-btn" data-id="{{ $item->id }}" aria-label="Remove {{ $product->name }}" title="Remove item">&times;</button>
    </form>

  </div>
@empty
  <div class="text-center text-gray-500 p-4">
    Your cart is empty.
  </div>
@endforelse

  <div class="cart-footer">
  <div class="subtotal">
  <span>Subtotal:</span><span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
</div>
    <div class="footer-buttons">
      <!-- <button class="btn-view-cart" type="button">VIEW CART</button> -->
      <button class="btn-checkout" type="button">CHECKOUT</button>
    </div>
  </div>
</aside>

</div>

<!-- Mobile Menu Button -->
<button aria-label="Open menu" class="mobile-menu-button hidden md:hidden focus:outline-none" tabindex="0" title="Open menu">
  <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"
    stroke-width="2.5">
    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
  </svg>
</button>

</nav>
<script>
  const openBtn = document.getElementById('openCartBtn');
  const closeBtn = document.getElementById('closeCartBtn');
  const cartMenu = document.getElementById('cartMenu');
  const overlay = document.getElementById('overlay');
  const removeBtns = cartMenu.querySelectorAll('.remove-item-btn');
  function openCart() {
    cartMenu.classList.add('open');
    cartMenu.setAttribute('aria-hidden', 'false');
    overlay.style.display = 'block';
    document.body.style.overflow = 'hidden';
  }
  function closeCart() {
    cartMenu.classList.remove('open');
    cartMenu.setAttribute('aria-hidden', 'true');
    overlay.style.display = 'none';
    document.body.style.overflow = '';
  }
  openBtn.addEventListener('click', openCart);
  closeBtn.addEventListener('click', closeCart);
  overlay.addEventListener('click', closeCart);
 
  // Keyboard accessibility: close cart on Escape key
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && cartMenu.classList.contains('open')) {
      closeCart();
    }
  });
document.querySelectorAll('.remove-item-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    const itemId = this.getAttribute('data-id');
    const itemElement = this.closest('.cart-item');

    fetch(`/cart/${itemId}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      }
    })
    .then(response => {
      if (response.ok) {
        itemElement.remove();
        // Optional: update subtotal or show empty cart
      } else {
        alert('Gagal menghapus item.');
      }
    });
  });
});

  
</script>