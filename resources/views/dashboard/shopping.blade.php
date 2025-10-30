@extends('layouts.dashboard')
@section('page_title', 'Shopping')
@section('title', 'Shopping')

@push('styles')
  <style>
    .product-card {
      transition: all 0.3s ease;
    }

    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .store-logo {
      transition: all 0.3s ease;
    }

    .store-logo:hover {
      transform: scale(1.05);
    }

    /* Improved responsive grid for products */
    .product-grid {
      display: grid;
      grid-template-columns: repeat(1, minmax(0, 1fr));
      gap: 1rem;
    }

    @media (min-width: 640px) {
      .product-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1.5rem;
      }
    }

    @media (min-width: 1024px) {
      .product-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
      }
    }

    /* Wishlist button animation */
    .wishlist-btn {
      transition: all 0.3s ease;
    }

    .wishlist-btn.active {
      color: #FC8181;
      transform: scale(1.1);
    }

    /* Store filter tabs */
    .store-tab {
      transition: all 0.3s ease;
    }

    .store-tab.active {
      background-color: #9F7AEA;
      color: white;
    }

    /* Extension badge */
    .extension-badge {
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.05);
      }

      100% {
        transform: scale(1);
      }
    }
  </style>
@endpush

@section('content')
  <!-- Shopping Content -->
  <div class="container mx-auto px-4 py-8 sm:px-6">

    <!-- Browser Extension Banner -->
    <div class="from-primary to-secondary responsive-card mb-8 rounded-2xl bg-gradient-to-r shadow-lg">
      <div class="flex flex-col items-center justify-between md:flex-row">
        <div class="mb-4 md:mb-0">
          <h2 class="mb-2 text-xl font-bold text-white">Add to Wishlist Anywhere!</h2>
          <p class="text-white text-opacity-90">
            Install our browser extension to save items from any website directly to your StyleHub
            wishlist.
          </p>
        </div>
        <button
          class="text-primary responsive-button extension-badge flex items-center justify-center rounded-lg bg-white font-bold transition hover:bg-gray-100">
          <i class="fas fa-puzzle-piece mr-2"></i>Install Extension
        </button>
      </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="responsive-card mb-8 rounded-2xl bg-white shadow-lg">
      <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div class="flex-1">
          <div class="relative">
            <input
              class="focus:ring-primary w-full rounded-xl border-0 bg-gray-100 px-4 py-3 pl-12 focus:outline-none focus:ring-2"
              placeholder="Search for clothing, accessories, brands..." type="text">
            <i
              class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 transform text-gray-400"></i>
          </div>
        </div>
        <div class="flex gap-3">
          <button
            class="bg-primary responsive-button flex items-center justify-center rounded-lg font-bold text-white transition hover:bg-purple-700">
            <i class="fas fa-filter mr-2"></i>Filter
          </button>
          <button
            class="bg-secondary responsive-button flex items-center justify-center rounded-lg font-bold text-white transition hover:bg-teal-500">
            <i class="fas fa-sync-alt mr-2"></i>Refresh
          </button>
        </div>
      </div>

      <!-- Store Filters -->
      <div class="mt-6">
        <h3 class="text-dark mb-3 font-bold">Browse by Store</h3>
        <div class="flex flex-wrap gap-2">
          <button class="store-tab active bg-primary rounded-full text-sm px-3 py-2 font-medium text-white">
            All Stores
          </button>
          <button
            class="store-tab bg-gray-100 rounded-full text-sm px-3 py-2 font-medium text-gray-700 hover:bg-gray-200">
            <i class="fab fa-amazon mr-2"></i>Amazon
          </button>
          <button
            class="store-tab bg-gray-100 rounded-full text-sm px-3 py-2 font-medium text-gray-700 hover:bg-gray-200">
            <i class="fas fa-shopping-bag mr-2"></i>Zara
          </button>
          <button
            class="store-tab bg-gray-100 rounded-full text-sm px-3 py-2 font-medium text-gray-700 hover:bg-gray-200">
            <i class="fas fa-tshirt mr-2"></i>H&M
          </button>
          <button
            class="store-tab bg-gray-100 rounded-full text-sm px-3 py-2 font-medium text-gray-700 hover:bg-gray-200">
            <i class="fas fa-store mr-2"></i>Nike
          </button>
          <button
            class="store-tab bg-gray-100 rounded-full text-sm px-3 py-2 font-medium text-gray-700 hover:bg-gray-200">
            <i class="fas fa-gem mr-2"></i>Nordstrom
          </button>
        </div>
      </div>
    </div>

    <!-- Personalized Recommendations -->
    <div class="responsive-card mb-8 rounded-2xl bg-white shadow-lg">
      <div class="mb-6 flex items-center justify-between">
        <h2 class="responsive-heading text-dark font-bold">
          Based on Your Interests
        </h2>
        <a class="text-primary flex items-center font-medium hover:text-purple-700" href="#">
          See All <i class="fas fa-chevron-right ml-1"></i>
        </a>
      </div>

      <div class="product-grid">
        <!-- Product 1 -->
        <div class="product-card overflow-hidden rounded-xl border border-gray-200 bg-white">
          <div class="relative">
            <img alt="Casual Shirt" class="h-48 w-full object-cover"
              src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
            <button class="wishlist-btn absolute right-3 top-3 rounded-full bg-white p-2 shadow-md">
              <i class="far fa-heart text-gray-400"></i>
            </button>
            <div
              class="bg-primary absolute left-3 top-3 rounded px-2 py-1 text-xs font-bold text-white">
              25% OFF
            </div>
          </div>
          <div class="p-4">
            <div class="mb-2 flex items-center">
              <div class="mr-2 flex h-6 w-6 items-center justify-center rounded-full bg-blue-100">
                <i class="fab fa-amazon text-xs text-blue-500"></i>
              </div>
              <span class="text-xs text-gray-500">Amazon</span>
            </div>
            <h3 class="text-dark mb-1 font-bold">Casual Striped Shirt</h3>
            <p class="mb-3 text-sm text-gray-600">Blue & white striped cotton shirt</p>
            <div class="flex items-center justify-between">
              <div>
                <span class="text-dark font-bold">$34.99</span>
                <span class="ml-2 text-sm text-gray-400 line-through">$45.99</span>
              </div>
              <button
                class="bg-primary rounded-lg px-3 py-1 text-sm text-white transition hover:bg-purple-700">
                Add to Cart
              </button>
            </div>
          </div>
        </div>

        <!-- Product 2 -->
        <div class="product-card overflow-hidden rounded-xl border border-gray-200 bg-white">
          <div class="relative">
            <img alt="Slim Jeans" class="h-48 w-full object-cover"
              src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
            <button class="wishlist-btn absolute right-3 top-3 rounded-full bg-white p-2 shadow-md">
              <i class="far fa-heart text-gray-400"></i>
            </button>
          </div>
          <div class="p-4">
            <div class="mb-2 flex items-center">
              <div class="mr-2 flex h-6 w-6 items-center justify-center rounded-full bg-red-100">
                <i class="fas fa-shopping-bag text-xs text-red-500"></i>
              </div>
              <span class="text-xs text-gray-500">Zara</span>
            </div>
            <h3 class="text-dark mb-1 font-bold">Slim Fit Jeans</h3>
            <p class="mb-3 text-sm text-gray-600">Dark wash denim with stretch</p>
            <div class="flex items-center justify-between">
              <div>
                <span class="text-dark font-bold">$49.99</span>
              </div>
              <button
                class="bg-primary rounded-lg px-3 py-1 text-sm text-white transition hover:bg-purple-700">
                Add to Cart
              </button>
            </div>
          </div>
        </div>

        <!-- Product 3 -->
        <div class="product-card overflow-hidden rounded-xl border border-gray-200 bg-white">
          <div class="relative">
            <img alt="Running Shoes" class="h-48 w-full object-cover"
              src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
            <button
              class="wishlist-btn active absolute right-3 top-3 rounded-full bg-white p-2 shadow-md">
              <i class="fas fa-heart text-accent"></i>
            </button>
            <div
              class="bg-success absolute left-3 top-3 rounded px-2 py-1 text-xs font-bold text-white">
              BEST SELLER
            </div>
          </div>
          <div class="p-4">
            <div class="mb-2 flex items-center">
              <div class="mr-2 flex h-6 w-6 items-center justify-center rounded-full bg-green-100">
                <i class="fas fa-store text-xs text-green-500"></i>
              </div>
              <span class="text-xs text-gray-500">Nike</span>
            </div>
            <h3 class="text-dark mb-1 font-bold">Running Shoes</h3>
            <p class="mb-3 text-sm text-gray-600">Lightweight with cushion technology</p>
            <div class="flex items-center justify-between">
              <div>
                <span class="text-dark font-bold">$89.99</span>
              </div>
              <button
                class="bg-primary rounded-lg px-3 py-1 text-sm text-white transition hover:bg-purple-700">
                Add to Cart
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Search Results -->
    <div class="responsive-card mb-8 rounded-2xl bg-white shadow-lg">
      <div class="mb-6 flex items-center justify-between">
        <h2 class="responsive-heading text-dark font-bold">
          Search Results for "Summer Dresses"
        </h2>
        <div class="flex items-center text-sm text-gray-500">
          <span>24 results</span>
        </div>
      </div>

      <div class="product-grid">
        <!-- Product 4 -->
        <div class="product-card overflow-hidden rounded-xl border border-gray-200 bg-white">
          <div class="relative">
            <img alt="Summer Dress" class="h-48 w-full object-cover"
              src="https://images.unsplash.com/photo-1595777457583-95e059d581b8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
            <button class="wishlist-btn absolute right-3 top-3 rounded-full bg-white p-2 shadow-md">
              <i class="far fa-heart text-gray-400"></i>
            </button>
          </div>
          <div class="p-4">
            <div class="mb-2 flex items-center">
              <div class="mr-2 flex h-6 w-6 items-center justify-center rounded-full bg-purple-100">
                <i class="fas fa-tshirt text-xs text-purple-500"></i>
              </div>
              <span class="text-xs text-gray-500">H&M</span>
            </div>
            <h3 class="text-dark mb-1 font-bold">Floral Summer Dress</h3>
            <p class="mb-3 text-sm text-gray-600">Lightweight with floral pattern</p>
            <div class="flex items-center justify-between">
              <div>
                <span class="text-dark font-bold">$29.99</span>
              </div>
              <button
                class="bg-primary rounded-lg px-3 py-1 text-sm text-white transition hover:bg-purple-700">
                Add to Cart
              </button>
            </div>
          </div>
        </div>

        <!-- Product 5 -->
        <div class="product-card overflow-hidden rounded-xl border border-gray-200 bg-white">
          <div class="relative">
            <img alt="Maxi Dress" class="h-48 w-full object-cover"
              src="https://images.unsplash.com/photo-1576566588028-4147f3842f27?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
            <button class="wishlist-btn absolute right-3 top-3 rounded-full bg-white p-2 shadow-md">
              <i class="far fa-heart text-gray-400"></i>
            </button>
            <div
              class="bg-primary absolute left-3 top-3 rounded px-2 py-1 text-xs font-bold text-white">
              NEW
            </div>
          </div>
          <div class="p-4">
            <div class="mb-2 flex items-center">
              <div class="mr-2 flex h-6 w-6 items-center justify-center rounded-full bg-yellow-100">
                <i class="fas fa-gem text-xs text-yellow-500"></i>
              </div>
              <span class="text-xs text-gray-500">Nordstrom</span>
            </div>
            <h3 class="text-dark mb-1 font-bold">Elegant Maxi Dress</h3>
            <p class="mb-3 text-sm text-gray-600">Flowy fabric for special occasions</p>
            <div class="flex items-center justify-between">
              <div>
                <span class="text-dark font-bold">$79.99</span>
              </div>
              <button
                class="bg-primary rounded-lg px-3 py-1 text-sm text-white transition hover:bg-purple-700">
                Add to Cart
              </button>
            </div>
          </div>
        </div>

        <!-- Product 6 -->
        <div class="product-card overflow-hidden rounded-xl border border-gray-200 bg-white">
          <div class="relative">
            <img alt="Casual Dress" class="h-48 w-full object-cover"
              src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
            <button class="wishlist-btn absolute right-3 top-3 rounded-full bg-white p-2 shadow-md">
              <i class="far fa-heart text-gray-400"></i>
            </button>
          </div>
          <div class="p-4">
            <div class="mb-2 flex items-center">
              <div class="mr-2 flex h-6 w-6 items-center justify-center rounded-full bg-blue-100">
                <i class="fab fa-amazon text-xs text-blue-500"></i>
              </div>
              <span class="text-xs text-gray-500">Amazon</span>
            </div>
            <h3 class="text-dark mb-1 font-bold">Casual Sundress</h3>
            <p class="mb-3 text-sm text-gray-600">Perfect for beach days</p>
            <div class="flex items-center justify-between">
              <div>
                <span class="text-dark font-bold">$24.99</span>
                <span class="ml-2 text-sm text-gray-400 line-through">$34.99</span>
              </div>
              <button
                class="bg-primary rounded-lg px-3 py-1 text-sm text-white transition hover:bg-purple-700">
                Add to Cart
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Store Highlights -->
    <div class="responsive-card rounded-2xl bg-white shadow-lg">
      <h2 class="responsive-heading text-dark mb-6 font-bold">
        Store Highlights
      </h2>

      <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
        <!-- Store 1 -->
        <div class="store-logo cursor-pointer rounded-xl bg-gray-100 p-4 text-center">
          <div
            class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
            <i class="fab fa-amazon text-2xl text-blue-500"></i>
          </div>
          <h3 class="text-dark font-bold">Amazon</h3>
          <p class="text-sm text-gray-600">Up to 50% off</p>
        </div>

        <!-- Store 2 -->
        <div class="store-logo cursor-pointer rounded-xl bg-gray-100 p-4 text-center">
          <div
            class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-red-100">
            <i class="fas fa-shopping-bag text-2xl text-red-500"></i>
          </div>
          <h3 class="text-dark font-bold">Zara</h3>
          <p class="text-sm text-gray-600">New collection</p>
        </div>

        <!-- Store 3 -->
        <div class="store-logo cursor-pointer rounded-xl bg-gray-100 p-4 text-center">
          <div
            class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-purple-100">
            <i class="fas fa-tshirt text-2xl text-purple-500"></i>
          </div>
          <h3 class="text-dark font-bold">H&M</h3>
          <p class="text-sm text-gray-600">Summer sale</p>
        </div>

        <!-- Store 4 -->
        <div class="store-logo cursor-pointer rounded-xl bg-gray-100 p-4 text-center">
          <div
            class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
            <i class="fas fa-store text-2xl text-green-500"></i>
          </div>
          <h3 class="text-dark font-bold">Nike</h3>
          <p class="text-sm text-gray-600">Athletic wear</p>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    // DOM Elements
    // Wishlist buttons
    const wishlistBtns = document.querySelectorAll('.wishlist-btn');

    // Store tabs
    const storeTabs = document.querySelectorAll('.store-tab');

    // Toggle wishlist status
    function toggleWishlist(event) {
      event.stopPropagation();
      const btn = event.currentTarget;
      const icon = btn.querySelector('i');

      if (icon.classList.contains('far')) {
        icon.classList.remove('far');
        icon.classList.add('fas', 'text-accent');
        btn.classList.add('active');
      } else {
        icon.classList.remove('fas', 'text-accent');
        icon.classList.add('far', 'text-gray-400');
        btn.classList.remove('active');
      }
    }

    // Activate store tab
    function activateStoreTab(event) {
      storeTabs.forEach(tab => tab.classList.remove('active', 'bg-primary', 'text-white'));
      event.currentTarget.classList.add('active', 'bg-primary', 'text-white');
    }

    // Wishlist buttons
    wishlistBtns.forEach(btn => {
      btn.addEventListener('click', toggleWishlist);
    });

    // Store tabs
    storeTabs.forEach(tab => {
      tab.addEventListener('click', activateStoreTab);
    });
  </script>
@endpush
