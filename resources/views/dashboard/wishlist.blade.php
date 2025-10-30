@extends('layouts.dashboard')
@section('page_title', 'My Wishlist')
@section('title', 'Wishlist')

@push('styles')
  <style>
    .wishlist-card {
      transition: all 0.3s ease;
    }

    .wishlist-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .item-image {
      transition: all 0.3s ease;
    }

    .item-image:hover {
      transform: scale(1.05);
    }

    /* Price tag styles */
    .price-tag {
      background: linear-gradient(135deg, #9f7aea 0%, #4fd1c5 100%);
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 25px;
      font-weight: 700;
      font-size: 0.875rem;
      box-shadow: 0 4px 12px rgba(159, 122, 234, 0.3);
    }

    /* Enhanced Status badges */
    .status-badge {
      padding: 0.5rem 1rem;
      border-radius: 25px;
      font-size: 0.75rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .status-badge:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .status-in-stock {
      background: linear-gradient(135deg, #68d391 0%, #48bb78 100%);
      color: white;
    }

    .status-low-stock {
      background: linear-gradient(135deg, #f6e05e 0%, #ecc94b 100%);
      color: #744210;
    }

    .status-out-of-stock {
      background: linear-gradient(135deg, #fc8181 0%, #f56565 100%);
      color: white;
    }

    .status-on-sale {
      background: linear-gradient(135deg, #9f7aea 0%, #805ad5 100%);
      color: white;
    }

    /* Enhanced Filter buttons */
    .filter-btn {
      padding: 0.5rem 0.75rem;
      border-radius: 25px;
      font-size: 0.75rem;
      font-weight: 400;
      transition: all 0.3s ease;
      cursor: pointer;
      border: 2px solid transparent;
      background: white;
      color: #6b7280;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      position: relative;
      overflow: hidden;
    }

    .filter-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.5s;
    }

    .filter-btn:hover::before {
      left: 100%;
    }

    .filter-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
      border-color: #9f7aea;
      color: #9f7aea;
    }

    .filter-btn.active {
      background: #9f7aea;
      color: white;
      border-color: transparent;
      box-shadow: 0 4px 15px rgba(159, 122, 234, 0.4);
    }

    /* Enhanced Sort Dropdown */
    .sort-dropdown {
      position: relative;
      display: inline-block;
    }

    .sort-dropdown-btn {
      padding: 0.5rem 0.75rem;
      border-radius: 25px;
      font-size: 0.75rem;
      font-weight: 500;
      transition: all 0.3s ease;
      cursor: pointer;
      border: 2px solid #e5e7eb;
      background: white;
      color: #374151;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      display: flex;
      align-items: center;
      gap: 0.75rem;
      min-width: 150px;
      justify-content: space-between;
    }

    .sort-dropdown-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
      border-color: #9f7aea;
    }

    .sort-dropdown-btn.active {
      border-color: #9f7aea;
      box-shadow: 0 4px 15px rgba(159, 122, 234, 0.2);
    }

    .sort-dropdown-content {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      width: 100%;
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      border: 1px solid #e5e7eb;
      z-index: 50;
      padding: 0.5rem;
      margin-top: 0.5rem;
      animation: dropdownFade 0.2s ease-out;
    }

    @keyframes dropdownFade {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .sort-dropdown-content.show {
      display: block;
    }

    .sort-dropdown-item {
      padding: 0.75rem 1rem;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      border-radius: 12px;
      font-size: 0.875rem;
      font-weight: 500;
      color: #374151;
    }

    .sort-dropdown-item:hover {
      background: linear-gradient(135deg, #9f7aea15 0%, #4fd1c515 100%);
      color: #9f7aea;
      transform: translateX(4px);
    }

    .sort-dropdown-item.active {
      background: linear-gradient(135deg, #9f7aea 0%, #4fd1c5 100%);
      color: white;
    }

    .sort-dropdown-item i {
      width: 16px;
      text-align: center;
    }

    /* Enhanced Stats Cards */
    .stat-card {
      background: white;
      border-radius: 20px;
      padding: 1.5rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      border: 1px solid #f1f5f9;
      position: relative;
      overflow: hidden;
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    /* Discount badge */
    .discount-badge {
      background: linear-gradient(135deg, #fc8181 0%, #f56565 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 700;
      box-shadow: 0 4px 12px rgba(252, 129, 129, 0.4);
      position: absolute;
      top: 12px;
      left: 12px;
      z-index: 10;
    }

    /* Action buttons in cards */
    .action-btn {
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .action-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Pagination Styles */
    .pagination-btn {
      transition: all 0.3s ease;
    }

    .pagination-btn:hover:not(:disabled) {
      background: #f9fafb;
      border-color: #9f7aea;
      color: #9f7aea;
    }

    .pagination-number {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      border: 1px solid #9f7aea;
      background: white;
      color: #6b7280;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      min-width: 40px;
    }

    .pagination-number:hover {
      background: #f9fafb;
      border-color: #9f7aea;
      color: #9f7aea;
    }

    .pagination-number.active {
      background: #9f7aea;
      border-color: #9f7aea;
      color: white;
    }
  </style>
@endpush

@section('content')
  <!-- Wishlist Content -->
  <div class="container mx-auto px-4 py-8 sm:px-6">
    <!-- Welcome Section -->
    <div class="mb-8">
      <h1 class="responsive-heading text-dark font-bold">
        My Wishlist
      </h1>
      <p class="responsive-text text-gray-600">
        Items you've saved for later purchase
      </p>
    </div>

    <!-- Filter and Sort Section -->
    <div class="responsive-card mb-8 rounded-2xl bg-white shadow-lg">
      <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div class="flex flex-wrap gap-3">
          <button class="filter-btn active" data-filter="all">
            <i class="fas fa-layer-group mr-2"></i>All Items
          </button>
          <button class="filter-btn" data-filter="in-stock">
            <i class="fas fa-check-circle mr-2"></i>In Stock
          </button>
          <button class="filter-btn" data-filter="low-stock">
            <i class="fas fa-exclamation-triangle mr-2"></i>Low Stock
          </button>
          <button class="filter-btn" data-filter="out-of-stock">
            <i class="fas fa-times-circle mr-2"></i>Out of Stock
          </button>
          <button class="filter-btn" data-filter="on-sale">
            <i class="fas fa-tag mr-2"></i>On Sale
          </button>
        </div>
        <div class="sort-dropdown">
          <button class="sort-dropdown-btn" id="sortDropdownBtn">
            <span class="flex items-center gap-2">
              <i class="fas fa-sort-amount-down"></i>
              <span id="sortSelected">Date Added</span>
            </span>
            <i class="fas fa-chevron-down text-xs transition-transform duration-200"
              id="sortDropdownIcon"></i>
          </button>
          <div class="sort-dropdown-content" id="sortDropdown">
            <div class="sort-dropdown-item active" data-sort="date">
              <i class="fas fa-calendar-plus"></i>
              Date Added
            </div>
            <div class="sort-dropdown-item" data-sort="price-low">
              <i class="fas fa-sort-amount-down-alt"></i>
              Price: Low to High
            </div>
            <div class="sort-dropdown-item" data-sort="price-high">
              <i class="fas fa-sort-amount-down"></i>
              Price: High to Low
            </div>
            <div class="sort-dropdown-item" data-sort="name">
              <i class="fas fa-sort-alpha-down"></i>
              Name: A to Z
            </div>
            <div class="sort-dropdown-item" data-sort="brand">
              <i class="fas fa-tag"></i>
              Brand
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Wishlist Grid -->
    <div class="responsive-card rounded-2xl bg-white shadow-lg">
      <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <h2 class="responsive-heading text-dark font-bold">
          Saved Items
        </h2>
        <div class="mt-2 text-sm text-gray-600 sm:mt-0">
          Showing <span id="showingStart">1</span>-<span id="showingEnd">6</span> of <span
            id="totalItemsCount">6</span> items
        </div>
      </div>

      <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3" id="wishlistGrid">
        <!-- Wishlist items are now static HTML -->
        <!-- Wishlist Item 1 -->
        <div
          class="wishlist-card overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-lg"
          data-status="in-stock">
          <div class="relative overflow-hidden">
            <img alt="Premium Denim Jacket" class="item-image h-48 w-full object-cover"
              src="https://images.unsplash.com/photo-1551028719-00167b16eac5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
            <div class="discount-badge">-25%</div>
            <button
              class="remove-wishlist absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white text-red-500 shadow-lg transition hover:bg-red-50"
              data-id="1">
              <i class="fas fa-heart"></i>
            </button>
          </div>
          <div class="p-4">
            <div class="mb-2 flex items-start justify-between">
              <h3 class="text-dark text-lg font-bold">Premium Denim Jacket</h3>
              <span class="status-badge status-in-stock"><i class="fas fa-check-circle"></i> In
                Stock</span>
            </div>
            <p class="mb-3 text-sm text-gray-600">Levi's</p>
            <div class="mb-4 flex items-center justify-between">
              <div class="flex items-center gap-2">
                <span class="text-dark text-lg font-bold">$89.99</span>
                <span class="text-sm text-gray-500 line-through">$119.99</span>
              </div>
              <span class="text-xs text-gray-500">Added: Oct 15</span>
            </div>
            <div class="flex justify-between">
              <button class="action-btn bg-primary text-white hover:bg-purple-700">
                <i class="fas fa-shopping-cart"></i> Add to Cart
              </button>
              <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                <i class="fas fa-ellipsis-h"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Wishlist Item 2 -->
        <div
          class="wishlist-card overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-lg"
          data-status="low-stock">
          <div class="relative overflow-hidden">
            <img alt="Classic White Sneakers" class="item-image h-48 w-full object-cover"
              src="https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
            <button
              class="remove-wishlist absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white text-red-500 shadow-lg transition hover:bg-red-50"
              data-id="2">
              <i class="fas fa-heart"></i>
            </button>
          </div>
          <div class="p-4">
            <div class="mb-2 flex items-start justify-between">
              <h3 class="text-dark text-lg font-bold">Classic White Sneakers</h3>
              <span class="status-badge status-low-stock"><i class="fas fa-exclamation-triangle"></i>
                Low Stock</span>
            </div>
            <p class="mb-3 text-sm text-gray-600">Adidas</p>
            <div class="mb-4 flex items-center justify-between">
              <span class="text-dark text-lg font-bold">$79.99</span>
              <span class="text-xs text-gray-500">Added: Oct 10</span>
            </div>
            <div class="flex justify-between">
              <button class="action-btn bg-primary text-white hover:bg-purple-700">
                <i class="fas fa-shopping-cart"></i> Add to Cart
              </button>
              <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                <i class="fas fa-ellipsis-h"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Wishlist Item 3 -->
        <div
          class="wishlist-card overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-lg"
          data-status="out-of-stock">
          <div class="relative overflow-hidden">
            <img alt="Wool Blend Coat" class="item-image h-48 w-full object-cover"
              src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
            <div class="discount-badge">-19%</div>
            <button
              class="remove-wishlist absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white text-red-500 shadow-lg transition hover:bg-red-50"
              data-id="3">
              <i class="fas fa-heart"></i>
            </button>
          </div>
          <div class="p-4">
            <div class="mb-2 flex items-start justify-between">
              <h3 class="text-dark text-lg font-bold">Wool Blend Coat</h3>
              <span class="status-badge status-out-of-stock"><i class="fas fa-times-circle"></i> Out
                of Stock</span>
            </div>
            <p class="mb-3 text-sm text-gray-600">Zara</p>
            <div class="mb-4 flex items-center justify-between">
              <div class="flex items-center gap-2">
                <span class="text-dark text-lg font-bold">$129.99</span>
                <span class="text-sm text-gray-500 line-through">$159.99</span>
              </div>
              <span class="text-xs text-gray-500">Added: Oct 5</span>
            </div>
            <div class="flex justify-between">
              <button class="action-btn cursor-not-allowed bg-gray-200 text-gray-500">
                <i class="fas fa-bell"></i> Notify Me
              </button>
              <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                <i class="fas fa-ellipsis-h"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Wishlist Item 4 -->
        <div
          class="wishlist-card overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-lg"
          data-status="on-sale">
          <div class="relative overflow-hidden">
            <img alt="Casual Summer Dress" class="item-image h-48 w-full object-cover"
              src="https://images.unsplash.com/photo-1595777457583-95e059d581b8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
            <div class="discount-badge">-20%</div>
            <button
              class="remove-wishlist absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white text-red-500 shadow-lg transition hover:bg-red-50"
              data-id="4">
              <i class="fas fa-heart"></i>
            </button>
          </div>
          <div class="p-4">
            <div class="mb-2 flex items-start justify-between">
              <h3 class="text-dark text-lg font-bold">Casual Summer Dress</h3>
              <span class="status-badge status-on-sale"><i class="fas fa-tag"></i> On Sale</span>
            </div>
            <p class="mb-3 text-sm text-gray-600">H&M</p>
            <div class="mb-4 flex items-center justify-between">
              <div class="flex items-center gap-2">
                <span class="text-dark text-lg font-bold">$39.99</span>
                <span class="text-sm text-gray-500 line-through">$49.99</span>
              </div>
              <span class="text-xs text-gray-500">Added: Sep 28</span>
            </div>
            <div class="flex justify-between">
              <button class="action-btn bg-primary text-white hover:bg-purple-700">
                <i class="fas fa-shopping-cart"></i> Add to Cart
              </button>
              <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                <i class="fas fa-ellipsis-h"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Wishlist Item 5 -->
        <div
          class="wishlist-card overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-lg"
          data-status="in-stock">
          <div class="relative overflow-hidden">
            <img alt="Leather Crossbody Bag" class="item-image h-48 w-full object-cover"
              src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
            <div class="discount-badge">-25%</div>
            <button
              class="remove-wishlist absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white text-red-500 shadow-lg transition hover:bg-red-50"
              data-id="5">
              <i class="fas fa-heart"></i>
            </button>
          </div>
          <div class="p-4">
            <div class="mb-2 flex items-start justify-between">
              <h3 class="text-dark text-lg font-bold">Leather Crossbody Bag</h3>
              <span class="status-badge status-in-stock"><i class="fas fa-check-circle"></i> In
                Stock</span>
            </div>
            <p class="mb-3 text-sm text-gray-600">Fossil</p>
            <div class="mb-4 flex items-center justify-between">
              <div class="flex items-center gap-2">
                <span class="text-dark text-lg font-bold">$149.99</span>
                <span class="text-sm text-gray-500 line-through">$199.99</span>
              </div>
              <span class="text-xs text-gray-500">Added: Sep 20</span>
            </div>
            <div class="flex justify-between">
              <button class="action-btn bg-primary text-white hover:bg-purple-700">
                <i class="fas fa-shopping-cart"></i> Add to Cart
              </button>
              <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                <i class="fas fa-ellipsis-h"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Wishlist Item 6 -->
        <div
          class="wishlist-card overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-lg"
          data-status="low-stock">
          <div class="relative overflow-hidden">
            <img alt="Slim Fit Chinos" class="item-image h-48 w-full object-cover"
              src="https://images.unsplash.com/photo-1542272604-787c3835535d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
            <div class="discount-badge">-25%</div>
            <button
              class="remove-wishlist absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white text-red-500 shadow-lg transition hover:bg-red-50"
              data-id="6">
              <i class="fas fa-heart"></i>
            </button>
          </div>
          <div class="p-4">
            <div class="mb-2 flex items-start justify-between">
              <h3 class="text-dark text-lg font-bold">Slim Fit Chinos</h3>
              <span class="status-badge status-low-stock"><i
                  class="fas fa-exclamation-triangle"></i> Low Stock</span>
            </div>
            <p class="mb-3 text-sm text-gray-600">Banana Republic</p>
            <div class="mb-4 flex items-center justify-between">
              <div class="flex items-center gap-2">
                <span class="text-dark text-lg font-bold">$59.99</span>
                <span class="text-sm text-gray-500 line-through">$79.99</span>
              </div>
              <span class="text-xs text-gray-500">Added: Sep 15</span>
            </div>
            <div class="flex justify-between">
              <button class="action-btn bg-primary text-white hover:bg-purple-700">
                <i class="fas fa-shopping-cart"></i> Add to Cart
              </button>
              <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                <i class="fas fa-ellipsis-h"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="mt-8 flex flex-col items-center justify-between gap-4 sm:flex-row">
        <div class="text-sm text-gray-600">
          Showing <span id="showingStart">1</span>-<span id="showingEnd">6</span> of <span
            id="totalItemsCount">6</span> items
        </div>
        <div class="flex items-center space-x-2">
          <button
            class="pagination-btn pagination-prev flex h-10 w-10 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-50">
            <i class="fas fa-chevron-left text-sm"></i>
          </button>

          <div class="flex space-x-1" id="paginationNumbers">
            <!-- Page numbers will be generated here -->
          </div>

          <button
            class="pagination-btn pagination-next flex h-10 w-10 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-50">
            <i class="fas fa-chevron-right text-sm"></i>
          </button>
        </div>

        <div class="flex items-center space-x-2">
          <span class="text-sm text-gray-600">Items per page:</span>
          <select
            class="focus:ring-primary rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-transparent focus:outline-none focus:ring-2"
            id="itemsPerPage">
            <option value="6">6</option>
            <option value="9">9</option>
            <option value="12">12</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Quick Stats -->
    <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-4">
      <div class="stat-card">
        <div class="flex items-center">
          <div class="from-primary to-secondary mr-4 rounded-lg bg-gradient-to-br px-3 py-2">
            <i class="fas fa-bookmark text-lg text-white"></i>
          </div>
          <div>
            <p class="text-dark text-2xl font-bold" id="totalItems">0</p>
            <p class="text-sm text-gray-600">Total Items</p>
          </div>
        </div>
      </div>
      <div class="stat-card">
        <div class="flex items-center">
          <div class="mr-4 rounded-lg bg-gradient-to-br from-green-400 to-green-600 px-3 py-2">
            <i class="fas fa-check-circle text-lg text-white"></i>
          </div>
          <div>
            <p class="text-dark text-2xl font-bold" id="inStockItems">0</p>
            <p class="text-sm text-gray-600">In Stock</p>
          </div>
        </div>
      </div>
      <div class="stat-card">
        <div class="flex items-center">
          <div class="mr-4 rounded-lg bg-gradient-to-br from-yellow-400 to-yellow-600 px-3 py-2">
            <i class="fas fa-exclamation-triangle text-lg text-white"></i>
          </div>
          <div>
            <p class="text-dark text-2xl font-bold" id="lowStockItems">0</p>
            <p class="text-sm text-gray-600">Low Stock</p>
          </div>
        </div>
      </div>
      <div class="stat-card">
        <div class="flex items-center">
          <div class="mr-4 rounded-lg bg-gradient-to-br from-red-400 to-red-600 px-3 py-2">
            <i class="fas fa-times-circle text-lg text-white"></i>
          </div>
          <div>
            <p class="text-dark text-2xl font-bold" id="outOfStockItems">0</p>
            <p class="text-sm text-gray-600">Out of Stock</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    // DOM Elements
    const wishlistGrid = document.getElementById('wishlistGrid');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const sortDropdownBtn = document.getElementById('sortDropdownBtn');
    const sortDropdown = document.getElementById('sortDropdown');
    const sortDropdownIcon = document.getElementById('sortDropdownIcon');
    const sortSelected = document.getElementById('sortSelected');
    const sortItems = document.querySelectorAll('.sort-dropdown-item');
    const totalItems = document.getElementById('totalItems');
    const inStockItems = document.getElementById('inStockItems');
    const lowStockItems = document.getElementById('lowStockItems');
    const outOfStockItems = document.getElementById('outOfStockItems');
    const removeButtons = document.querySelectorAll('.remove-wishlist');

    // State variables
    let currentFilter = 'all';
    let currentSort = 'date';
    // Pagination state
    let currentPage = 1;
    let itemsPerPage = 6;

    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
      // Update stats based on static HTML items
      updateStats();
      // Initialize pagination
      setupPagination();
    });

    // Pagination functionality
    function setupPagination() {
      const items = Array.from(wishlistGrid.querySelectorAll('.wishlist-card'));
      const totalItems = items.length;
      const totalPages = Math.ceil(totalItems / itemsPerPage);

      // Update showing text
      const start = ((currentPage - 1) * itemsPerPage) + 1;
      const end = Math.min(currentPage * itemsPerPage, totalItems);

      document.getElementById('showingStart').textContent = start;
      document.getElementById('showingEnd').textContent = end;
      document.getElementById('totalItemsCount').textContent = totalItems;

      // Show/hide items based on current page
      items.forEach((item, index) => {
        if (index >= start - 1 && index < end) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });

      // Generate pagination numbers
      generatePaginationNumbers(totalPages);

      // Update button states
      updatePaginationButtons(totalPages);
    }

    function generatePaginationNumbers(totalPages) {
      const paginationContainer = document.getElementById('paginationNumbers');
      paginationContainer.innerHTML = '';

      // Always show first page
      addPageNumber(1, totalPages);

      // Show ellipsis if needed
      if (currentPage > 3) {
        const ellipsis = document.createElement('span');
        ellipsis.className = 'pagination-number';
        ellipsis.textContent = '...';
        ellipsis.style.cursor = 'default';
        paginationContainer.appendChild(ellipsis);
      }

      // Show pages around current page
      for (let i = Math.max(2, currentPage - 1); i <= Math.min(totalPages - 1, currentPage +
        1); i++) {
        addPageNumber(i, totalPages);
      }

      // Show ellipsis if needed
      if (currentPage < totalPages - 2) {
        const ellipsis = document.createElement('span');
        ellipsis.className = 'pagination-number';
        ellipsis.textContent = '...';
        ellipsis.style.cursor = 'default';
        paginationContainer.appendChild(ellipsis);
      }

      // Always show last page if there's more than 1 page
      if (totalPages > 1) {
        addPageNumber(totalPages, totalPages);
      }
    }

    function addPageNumber(page, totalPages) {
      const paginationContainer = document.getElementById('paginationNumbers');
      const pageElement = document.createElement('button');
      pageElement.className = `pagination-number ${page === currentPage ? 'active' : ''}`;
      pageElement.textContent = page;
      pageElement.addEventListener('click', () => {
        currentPage = page;
        setupPagination();
      });
      paginationContainer.appendChild(pageElement);
    }

    function updatePaginationButtons(totalPages) {
      const prevBtn = document.querySelector('.pagination-prev');
      const nextBtn = document.querySelector('.pagination-next');

      prevBtn.disabled = currentPage === 1;
      nextBtn.disabled = currentPage === totalPages || totalPages === 0;

      // Add event listeners
      prevBtn.onclick = () => {
        if (currentPage > 1) {
          currentPage--;
          setupPagination();
        }
      };

      nextBtn.onclick = () => {
        if (currentPage < totalPages) {
          currentPage++;
          setupPagination();
        }
      };
    }

    function handleItemsPerPageChange() {
      itemsPerPage = parseInt(document.getElementById('itemsPerPage').value);
      currentPage = 1; // Reset to first page when changing items per page
      setupPagination();
    }

    // Items per page selector
    document.getElementById('itemsPerPage').addEventListener('change', handleItemsPerPageChange);

    function removeFromWishlist(itemId) {
      const itemToRemove = document.querySelector(`.remove-wishlist[data-id="${itemId}"]`).closest(
        '.wishlist-card');
      itemToRemove.style.opacity = '0';
      itemToRemove.style.transform = 'translateX(100%)';

      setTimeout(() => {
        itemToRemove.remove();
        updateStats();
        setupPagination(); // Refresh pagination after removal

        // Show notification
        showNotification('Item removed from wishlist', 'warning');
      }, 300);
    }

    function applyFiltersAndSort() {
      // Reset to first page when filtering
      currentPage = 1;
      setupPagination();
    }

    // Enhanced click outside handler
    function handleClickOutside(event) {

      // Close sort dropdown
      if (!sortDropdownBtn.contains(event.target) && !sortDropdown.contains(event.target)) {
        sortDropdown.classList.remove('show');
        sortDropdownIcon.classList.remove('rotate-180');
      }
    }

    // WISHLIST FUNCTIONALITY
    // Toggle sort dropdown
    function toggleSortDropdown() {
      sortDropdown.classList.toggle('show');
      sortDropdownIcon.classList.toggle('rotate-180');
    }

    // Set active filter
    function setActiveFilter(filter) {
      currentFilter = filter;

      // Update active state of filter buttons
      filterButtons.forEach(button => {
        if (button.getAttribute('data-filter') === filter) {
          button.classList.add('active');
        } else {
          button.classList.remove('active');
        }
      });

      // Apply filter and update display
      applyFiltersAndSort();
    }

    // Set active sort
    function setActiveSort(sort) {
      currentSort = sort;

      // Update selected sort text
      const selectedText = sortDropdown.querySelector(`[data-sort="${sort}"]`).textContent.trim();
      sortSelected.textContent = selectedText;

      // Update active state of sort items
      sortItems.forEach(item => {
        if (item.getAttribute('data-sort') === sort) {
          item.classList.add('active');
        } else {
          item.classList.remove('active');
        }
      });

      // Close dropdown
      sortDropdown.classList.remove('show');
      sortDropdownIcon.classList.remove('rotate-180');

      // Apply filter and sort
      applyFiltersAndSort();
    }

    // Apply filters and sorting
    function applyFiltersAndSort() {
      const items = Array.from(wishlistGrid.querySelectorAll('.wishlist-card'));

      // Apply filter
      if (currentFilter !== 'all') {
        items.forEach(item => {
          if (item.getAttribute('data-status') === currentFilter) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      } else {
        items.forEach(item => {
          item.style.display = 'block';
        });
      }

      // Apply sorting would require more complex logic with data attributes
      // For now, we'll just handle filtering
    }

    // Remove item from wishlist
    function removeFromWishlist(itemId) {
      const itemToRemove = document.querySelector(`.remove-wishlist[data-id="${itemId}"]`).closest(
        '.wishlist-card');
      itemToRemove.style.opacity = '0';
      itemToRemove.style.transform = 'translateX(100%)';

      setTimeout(() => {
        itemToRemove.remove();
        updateStats();

        // Show notification
        showNotification('Item removed from wishlist', 'warning');
      }, 300);
    }

    // Update statistics
    function updateStats() {
      const items = wishlistGrid.querySelectorAll('.wishlist-card');
      const total = items.length;
      const inStock = wishlistGrid.querySelectorAll('[data-status="in-stock"]').length;
      const lowStock = wishlistGrid.querySelectorAll('[data-status="low-stock"]').length;
      const outOfStock = wishlistGrid.querySelectorAll('[data-status="out-of-stock"]').length;

      totalItems.textContent = total;
      inStockItems.textContent = inStock;
      lowStockItems.textContent = lowStock;
      outOfStockItems.textContent = outOfStock;
    }

    function showNotification(message, type) {
      // Create notification element
      const notification = document.createElement('div');
      notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg text-white font-medium transform translate-x-full transition-transform duration-300 ${
                type === 'success' ? 'bg-success' : 
                type === 'warning' ? 'bg-warning' : 'bg-primary'
            }`;
      notification.innerHTML = `
                <div class="flex items-center space-x-2">
                    <i class="fas fa-${type === 'success' ? 'check' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
                    <span>${message}</span>
                </div>
            `;

      document.body.appendChild(notification);

      // Animate in
      setTimeout(() => {
        notification.style.transform = 'translateX(0)';
      }, 100);

      // Animate out and remove
      setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
          document.body.removeChild(notification);
        }, 300);
      }, 3000);
    }

    // GLOBAL EVENT LISTENERS
    // Enhanced click outside detection - listen for clicks anywhere in the document
    document.addEventListener('click', handleClickOutside);
  </script>
@endpush
