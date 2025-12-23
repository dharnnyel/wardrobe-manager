@extends('layouts.dashboard')
@section('page_title', 'Wardrobe')
@section('title', 'Wardrobe')

@push('styles')
  <style>
    /* Wardrobe table styles */
    .wardrobe-table-container {
      overflow: auto;
      border-radius: 12px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      font-size: 14px;
      position: relative;
    }

    .wardrobe-table {
      width: 100%;
      border-collapse: collapse;
      min-width: 800px;
    }

    .wardrobe-table thead th {
      background-color: var(--bg-secondary) !important;
      color: var(--text-primary) !important;
      border-bottom: 1px solid var(--border-color) !important;
      position: sticky;
      top: 0;
      z-index: 20;
      padding: 14px 16px;
      text-align: left;
      font-weight: 600;
      font-size: 15px;
    }

    .wardrobe-table td {
      padding: 14px 16px;
      border-bottom: 1px solid var(--border-color);
      font-size: 14px;
      font-weight: 400;
      background-color: transparent;
    }

    .wardrobe-table tr:last-child td {
      border-bottom: none;
    }

    .wardrobe-table tr:hover {
      background-color: rgba(var(--primary-color-rgb), 0.08) !important;
      color: var(--text-primary) !important;
    }

    /* Hide scrollbars */
    .no-scrollbar::-webkit-scrollbar {
      display: none;
    }

    .no-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    /* Filter buttons */
    .filter-btn {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 500;
      transition: all 0.2s ease;
      cursor: pointer;
      border: 1px solid rgba(var(--primary-color-rgb), 1);
      background-color: var(--bg-primary);
      color: var(--text-primary);
    }

    .filter-btn:hover {
      background-color: rgba(var(--primary-color-rgb), 0.06);
      border-color: rgba(var(--primary-color-rgb), 0.18);
      color: var(--text-primary);
      transform: translateY(-1px);
    }

    .filter-btn.active {
      background-color: var(--primary-color);
      color: #fff;
      border-color: var(--primary-color);
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.06);
    }

    .filter-dropdown {
      position: relative;
      display: inline-block;
    }

    .filter-dropdown-content {
      display: none;
      position: absolute;
      background-color: var(--bg-primary);
      min-width: 160px;
      box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.1);
      z-index: 100;
      border-radius: 8px;
      border: 1px solid #e2e8f0;
      padding: 8px 0;
      top: 100%;
      right: 0;
      margin-top: 4px;
    }

    .filter-dropdown-content.show {
      display: block;
    }

    .filter-dropdown-item {
      padding: 8px 16px;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      font-size: 0.875rem;
      /* background-color: var(--bg-primary); */
      color: var(--text-primary);
    }

    .filter-dropdown-item:hover,
    .filter-dropdown-item.active {
      background-color: rgba(var(--primary-color-rgb), 0.1);
      border-left: 3px solid rgba(var(--primary-color-rgb), 0.16);
      color: var(--text-primary);
    }

    .filter-dropdown-item i {
      margin-right: 8px;
      width: 16px;
      text-align: center;
    }

    .status-badge {
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 0.75rem;
      font-weight: 500;
    }

    .status-available {
      background-color: rgba(104, 211, 145, 0.1);
      color: #68d391;
    }

    .status-laundry {
      background-color: rgba(246, 224, 94, 0.1);
      color: #f6e05e;
    }

    .status-handedout {
      background-color: rgba(159, 122, 234, 0.1);
      color: #9f7aea;
    }

    .status-discarded {
      background-color: rgba(252, 129, 129, 0.1);
      color: #fc8181;
    }

    /* Action buttons */
    .action-btn {
      padding: 8px 10px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .action-btn:hover {
      transform: translateY(-1px);
    }

    /* Compact guide styles */
    .compact-guide {
      font-size: 0.75rem;
    }

    .compact-guide .guide-item {
      display: flex;
      align-items: center;
      margin-bottom: 8px;
    }

    .compact-guide .guide-icon {
      width: 20px;
      height: 20px;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 8px;
      font-size: 10px;
    }

    /* Pagination styles */
    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 1rem;
      gap: 0.5rem;
      background: transparent;
    }

    .pagination-btn {
      padding: 0.5rem 0.75rem;
      border-radius: 50%;
      width: 40px;
      font-size: 0.875rem;
      font-weight: 500;
      transition: all 0.4s ease;
      cursor: pointer;
      border: 1px solid var(--primary-color);
      background-color: var(--bg-primary);
      color: var(--text-primary);
    }

    .pagination-btn:hover {
      background-color: rgba(var(--primary-color-rgb), 0.06);
      border-color: rgba(var(--primary-color-rgb), 0.18);
      color: var(--primary-color);
    }

    .pagination-btn.active {
      background-color: rgba(var(--primary-color-rgb), 0.12);
      color: var(--primary-color);
      border-color: var(--primary-color);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.06);
    }

    .pagination-btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      z-index: 1000;
      align-items: center;
      justify-content: center;
    }

    .modal.show {
      display: flex;
    }

    .modal-content {
      background-color: var(--bg-primary);
      color: var(--text-primary);
      border-radius: 16px;
      width: 90%;
      max-width: 640px;
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .modal-header {
      padding: 20px 24px;
      border-bottom: 1px solid #e5e7eb;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-body {
      padding: 24px;
    }

    .modal-close {
      background: none;
      border: none;
      font-size: 1.25rem;
      color: #6b7280;
      cursor: pointer;
      transition: color 0.2s ease;
    }

    .modal-close:hover {
      color: #374151;
    }

    .item-details-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .detail-item {
      margin-bottom: 16px;
    }

    .detail-label {
      font-weight: 500;
      color: #6b7280;
      font-size: 0.875rem;
      margin-bottom: 4px;
    }

    .detail-value {
      font-weight: 400;
      color: var(--text-primary);
      font-size: 1rem;
    }

    .item-image-large {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 12px;
      margin-bottom: 20px;
    }

    /* Item image in table */
    .item-image-small {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 8px;
    }

    .form-group {
      margin-bottom: 16px;
    }

    .form-label {
      display: block;
      font-weight: 500;
      margin-bottom: 6px;
      color: #374151;
      font-size: 14px;
    }

    .form-input {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.2s ease;
      background-color: white;
    }

    .form-input:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(var(--primary-color-rgb), 0.1);
    }

    .form-input-error {
      border-color: #fc8181;
    }

    .error-message {
      color: #fc8181;
      font-size: 12px;
      margin-top: 4px;
      display: block;
    }

    .grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .grid-3 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
    }

    .image-preview {
      width: 150px;
      height: 150px;
      border: 2px dashed #d1d5db;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      margin-top: 8px;
    }

    .image-preview img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .upload-area {
      border: 2px dashed #d1d5db;
      border-radius: 8px;
      padding: 30px 20px;
      text-align: center;
      cursor: pointer;
      transition: border-color 0.2s ease;
      /* background-color: #f9fafb; */
    }

    .upload-area:hover {
      border-color: var(--primary-color);
    }
    .upload-area:hover .upload-icon {
      color: var(--primary-color);
    }

    .upload-area.dragover {
      border-color: var(--primary-color);
      background-color: rgba(var(--primary-color-rgb), 0.05);
    }

    .upload-icon {
      font-size: 36px;
      
      margin-bottom: 8px;
    }

    .button-group {
      display: flex;
      gap: 12px;
      justify-content: flex-end;
      margin-top: 15px;
      padding-top: 20px;
      /* border-top: 1px solid #e5e7eb; */
    }

    /* .btn-primary {
      background-color: var(--primary-color);
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      border: none;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.2s ease;
      font-size: 14px;
    }

    .btn-primary:hover {
      background-color: rgba(var(--primary-color-rgb), 0.9);
    }

    .btn-secondary {
      background-color: #f3f4f6;
      color: #374151;
      padding: 10px 20px;
      border-radius: 8px;
      border: 1px solid #d1d5db;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.2s ease;
      font-size: 14px;
    }

    .btn-secondary:hover {
      background-color: #e5e7eb;
    } */

    .status-select {
      padding: 10px 12px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 14px;
      width: 100%;
      background-color: white;
    }

    .status-select:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(var(--primary-color-rgb), 0.1);
    }

    .form-section {
      margin-bottom: 24px;
      padding-bottom: 16px;
      border-bottom: 1px solid #e5e7eb;
    }

    .form-section-title {
      font-size: 16px;
      font-weight: 600;
      color: var(--text-primary);
      margin-bottom: 12px;
    }

    textarea.form-input {
      min-height: 80px;
      resize: vertical;
    }

    .required::after {
      content: " *";
      color: #fc8181;
    }

    @media (max-width: 768px) {

      .grid-2,
      .grid-3 {
        grid-template-columns: 1fr;
      }

      .modal-content {
        width: 95%;
        padding: 10px;
      }

      .modal-body {
        padding: 16px;
      }
    }
  </style>
@endpush

@section('content')
  <!-- Wardrobe Content -->
  <div class="container mx-auto px-4 py-8 sm:px-6">
    <!-- Welcome Section -->
    <div class='mb-8 flex flex-col items-center justify-between sm:flex-row'>
      <div class="">
        <h1 class="responsive-heading text-dark font-medium">
          My Wardrobe
        </h1>
        <p class="responsive-text text-gray-600">
          Manage and organize your clothing items
        </p>
      </div>
      <div class="responsive-card">
        <div class="flex items-center gap-4 md:flex-row md:justify-between">
          <div class="relative">
            <input class="w-full rounded-lg py-2 pl-10 pr-4 md:w-64" placeholder="Search items..."
              type="text">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>

          </div>
          <x-button class="flex h-8 w-8 items-center justify-center rounded-full" id="addItemBtn"
            size='sm' type="button" variant='primary'>
            <i class="fas fa-plus"></i>
          </x-button>

        </div>
      </div>
    </div>


    <!-- Compact Guides -->
    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2">
      <!-- Status Guide -->
      <div class="compact-guide rounded-2xl bg-white p-4 shadow-lg">
        <h2 class="text-dark mb-3 text-sm font-medium">Status Guide</h2>
        <div class="grid grid-cols-2 gap-2">
          <div class="guide-item">
            <div class="mr-2 h-3 w-3 rounded-full bg-green-500"></div>
            <span class="text-xs text-gray-700">Available</span>
          </div>
          <div class="guide-item">
            <div class="mr-2 h-3 w-3 rounded-full bg-yellow-500"></div>
            <span class="text-xs text-gray-700">In Laundry</span>
          </div>
          <div class="guide-item">
            <div class="mr-2 h-3 w-3 rounded-full bg-purple-500"></div>
            <span class="text-xs text-gray-700">Handed Out</span>
          </div>
          <div class="guide-item">
            <div class="mr-2 h-3 w-3 rounded-full bg-red-500"></div>
            <span class="text-xs text-gray-700">Discarded</span>
          </div>
        </div>
      </div>

      <!-- Action Icons Guide -->
      <div class="compact-guide rounded-2xl bg-white p-4 shadow-lg">
        <h2 class="text-dark mb-3 text-sm font-medium">Action Icons Guide</h2>
        <div class="grid grid-cols-2 gap-2">
          <div class="guide-item">
            <div class="guide-icon bg-gray-100 text-gray-700">
              <i class="fas fa-eye text-xs"></i>
            </div>
            <span class="text-xs text-gray-700">View Details</span>
          </div>
          <div class="guide-item">
            <div class="guide-icon bg-gray-100 text-gray-700">
              <i class="fas fa-soap text-xs"></i>
            </div>
            <span class="text-xs text-gray-700">Send to Laundry</span>
          </div>
          <div class="guide-item">
            <div class="guide-icon bg-gray-100 text-gray-700">
              <i class="fas fa-hand-holding text-xs"></i>
            </div>
            <span class="text-xs text-gray-700">Hand Out</span>
          </div>
          <div class="guide-item">
            <div class="guide-icon bg-gray-100 text-gray-700">
              <i class="fas fa-calendar-plus text-xs"></i>
            </div>
            <span class="text-xs text-gray-700">Add to Schedule</span>
          </div>
          <div class="guide-item">
            <div class="guide-icon bg-secondary/20 text-secondary">
              <i class="fas fa-tshirt text-xs"></i>
            </div>
            <span class="text-xs text-gray-700">Retrieve to Wardrobe</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Filter Section -->
    <div class="responsive-card mb-6 rounded-2xl bg-white shadow-lg lg:mb-8">
      <div class='mb-4 flex flex-col justify-between gap-2 md:flex-row md:items-center'>
        <h2 class="responsive-heading text-dark font-medium">
          Clothing Items
        </h2>
        <div class="flex flex-wrap items-center gap-2">
          <div class="filter-dropdown">
            <button class="filter-btn flex items-center gap-1" id="filterDropdownBtn">
              <i class="fas fa-filter"></i>
              More Filters
              <i class="fas fa-chevron-down text-xs"></i>
            </button>
            <div class="filter-dropdown-content" id="filterDropdown">
              <div class="filter-dropdown-item active" data-filter="all">
                <i class="fas fa-list"></i>
                All Items
              </div>
              <div class="filter-dropdown-item" data-filter="category">
                <i class="fas fa-tag"></i>
                By Category
              </div>
              <div class="filter-dropdown-item" data-filter="brand">
                <i class="fas fa-copyright"></i>
                By Brand
              </div>
              <div class="filter-dropdown-item" data-filter="color">
                <i class="fas fa-palette"></i>
                By Color
              </div>
              <div class="filter-dropdown-item" data-filter="size">
                <i class="fas fa-expand"></i>
                By Size
              </div>
            </div>
          </div>
          <button class="filter-btn active" data-status="all">
            All Items
          </button>
          <button class="filter-btn" data-status="available">
            Available
          </button>
          <button class="filter-btn" data-status="laundry">
            In Laundry
          </button>
          <button class="filter-btn" data-status="handedout">
            Handed Out
          </button>
          <button class="filter-btn" data-status="discarded">
            Discarded
          </button>
        </div>

      </div>

      <div class="wardrobe-table-container no-scrollbar" style="max-height: 400px;">
        <table class="wardrobe-table">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Category</th>
              <th>Last Worn</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Static HTML Table Rows -->
            <tr>
              <td>
                <img alt="Classic White T-Shirt" class="item-image-small"
                  src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
              </td>
              <td class="font-medium">Classic White T-Shirt</td>
              <td>Tops</td>
              <td>2023-05-15</td>
              <td><span class="status-badge status-available">Available</span></td>
              <td>
                <div class="flex space-x-2">
                  <button
                    class="action-btn bg-primary/20 text-primary hover:bg-primary/30 view-item-btn"
                    data-id="1">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-soap"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-hand-holding"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-calendar-plus"></i>
                  </button>
                  <button class="action-btn bg-secondary/20 text-secondary hover:bg-secondary/30">
                    <i class="fas fa-tshirt"></i>
                  </button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img alt="Blue Denim Jeans" class="item-image-small"
                  src="https://images.unsplash.com/photo-1542272604-787c3835535d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
              </td>
              <td class="font-medium">Blue Denim Jeans</td>
              <td>Bottoms</td>
              <td>2023-05-18</td>
              <td><span class="status-badge status-available">Available</span></td>
              <td>
                <div class="flex space-x-2">
                  <button
                    class="action-btn bg-primary/20 text-primary hover:bg-primary/30 view-item-btn"
                    data-id="2">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-soap"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-hand-holding"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-calendar-plus"></i>
                  </button>
                  <button class="action-btn bg-secondary/20 text-secondary hover:bg-secondary/30">
                    <i class="fas fa-tshirt"></i>
                  </button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img alt="Black Blazer" class="item-image-small"
                  src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
              </td>
              <td class="font-medium">Black Blazer</td>
              <td>Outerwear</td>
              <td>2023-04-22</td>
              <td><span class="status-badge status-handedout">Handed Out</span></td>
              <td>
                <div class="flex space-x-2">
                  <button
                    class="action-btn bg-primary/20 text-primary hover:bg-primary/30 view-item-btn"
                    data-id="3">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-soap"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-hand-holding"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-calendar-plus"></i>
                  </button>
                  <button class="action-btn bg-secondary/20 text-secondary hover:bg-secondary/30">
                    <i class="fas fa-tshirt"></i>
                  </button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img alt="Striped Sweater" class="item-image-small"
                  src="https://images.unsplash.com/photo-1434389677669-e08b4cac3105?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
              </td>
              <td class="font-medium">Striped Sweater</td>
              <td>Tops</td>
              <td>2023-03-10</td>
              <td><span class="status-badge status-laundry">In Laundry</span></td>
              <td>
                <div class="flex space-x-2">
                  <button
                    class="action-btn bg-primary/20 text-primary hover:bg-primary/30 view-item-btn"
                    data-id="4">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-soap"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-hand-holding"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-calendar-plus"></i>
                  </button>
                  <button class="action-btn bg-secondary/20 text-secondary hover:bg-secondary/30">
                    <i class="fas fa-tshirt"></i>
                  </button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img alt="Running Shoes" class="item-image-small"
                  src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
              </td>
              <td class="font-medium">Running Shoes</td>
              <td>Footwear</td>
              <td>2023-05-20</td>
              <td><span class="status-badge status-available">Available</span></td>
              <td>
                <div class="flex space-x-2">
                  <button
                    class="action-btn bg-primary/20 text-primary hover:bg-primary/30 view-item-btn"
                    data-id="5">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-soap"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-hand-holding"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-calendar-plus"></i>
                  </button>
                  <button class="action-btn bg-secondary/20 text-secondary hover:bg-secondary/30">
                    <i class="fas fa-tshirt"></i>
                  </button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img alt="Polo Shirt" class="item-image-small"
                  src="https://images.unsplash.com/photo-1586790170083-2f9ceadc732d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
              </td>
              <td class="font-medium">Polo Shirt</td>
              <td>Tops</td>
              <td>2023-05-12</td>
              <td><span class="status-badge status-available">Available</span></td>
              <td>
                <div class="flex space-x-2">
                  <button
                    class="action-btn bg-primary/20 text-primary hover:bg-primary/30 view-item-btn"
                    data-id="6">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-soap"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-hand-holding"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-calendar-plus"></i>
                  </button>
                  <button class="action-btn bg-secondary/20 text-secondary hover:bg-secondary/30">
                    <i class="fas fa-tshirt"></i>
                  </button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img alt="Cargo Shorts" class="item-image-small"
                  src="https://images.unsplash.com/photo-1591369822096-ffd140ec948f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
              </td>
              <td class="font-medium">Cargo Shorts</td>
              <td>Bottoms</td>
              <td>2023-04-30</td>
              <td><span class="status-badge status-discarded">Discarded</span></td>
              <td>
                <div class="flex space-x-2">
                  <button
                    class="action-btn bg-primary/20 text-primary hover:bg-primary/30 view-item-btn"
                    data-id="7">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-soap"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-hand-holding"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-calendar-plus"></i>
                  </button>
                  <button class="action-btn bg-secondary/20 text-secondary hover:bg-secondary/30">
                    <i class="fas fa-tshirt"></i>
                  </button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <img alt="Leather Jacket" class="item-image-small"
                  src="https://images.unsplash.com/photo-1551028719-00167b16eac5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
              </td>
              <td class="font-medium">Leather Jacket</td>
              <td>Outerwear</td>
              <td>2023-02-15</td>
              <td><span class="status-badge status-available">Available</span></td>
              <td>
                <div class="flex space-x-2">
                  <button
                    class="action-btn bg-primary/20 text-primary hover:bg-primary/30 view-item-btn"
                    data-id="8">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-soap"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-hand-holding"></i>
                  </button>
                  <button class="action-btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-calendar-plus"></i>
                  </button>
                  <button class="action-btn bg-secondary/20 text-secondary hover:bg-secondary/30">
                    <i class="fas fa-tshirt"></i>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="pagination">
        <button class="pagination-btn" disabled>
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="pagination-btn active">1</button>
        <button class="pagination-btn">2</button>
        <button class="pagination-btn">3</button>
        <button class="pagination-btn">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
      <div class="responsive-card rounded-2xl bg-white shadow-lg">
        <div class="flex items-center">
          <div class="mr-4 rounded-lg bg-green-100 p-3 text-green-600">
            <i class="fas fa-tshirt text-lg"></i>
          </div>
          <div>
            <p class="text-dark text-2xl font-medium">86</p>
            <p class="text-sm text-gray-600">Available Items</p>
          </div>
        </div>
      </div>
      <div class="responsive-card rounded-2xl bg-white shadow-lg">
        <div class="flex items-center">
          <div class="mr-4 rounded-lg bg-yellow-100 p-3 text-yellow-600">
            <i class="fas fa-soap text-lg"></i>
          </div>
          <div>
            <p class="text-dark text-2xl font-medium">12</p>
            <p class="text-sm text-gray-600">In Laundry</p>
          </div>
        </div>
      </div>
      <div class="responsive-card rounded-2xl bg-white shadow-lg">
        <div class="flex items-center">
          <div class="mr-4 rounded-lg bg-purple-100 p-3 text-purple-600">
            <i class="fas fa-hand-holding text-lg"></i>
          </div>
          <div>
            <p class="text-dark text-2xl font-medium">5</p>
            <p class="text-sm text-gray-600">Handed Out</p>
          </div>
        </div>
      </div>
      <div class="responsive-card rounded-2xl bg-white shadow-lg">
        <div class="flex items-center">
          <div class="mr-4 rounded-lg bg-red-100 p-3 text-red-600">
            <i class="fas fa-trash text-lg"></i>
          </div>
          <div>
            <p class="text-dark text-2xl font-medium">3</p>
            <p class="text-sm text-gray-600">Discarded</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Clothing Item Modal -->
  <div class="modal" id="addClothingModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="text-dark text-xl font-medium">Add New Clothing Item</h2>
        <button class="modal-close" id="closeAddModal">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" id="clothingForm" method="POST">
          {{-- action="{{ route('wardrobe.store') }}" --}}
          @csrf

          <!-- Basic Information -->
          <div class="form-section">
            <h3 class="form-section-title">Basic Information</h3>

            <div class="grid-2">
              <div class="form-group">
                <label class="form-label required" for="name">Item Name</label>
                <input class="form-input @error('name') form-input-error @enderror" id="name"
                  name="name" placeholder="e.g., Classic White T-Shirt" required type="text"
                  value="{{ old('name') }}">
                @error('name')
                  <span class="error-message">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label class="form-label" for="brand">Brand</label>
                <input class="form-input @error('brand') form-input-error @enderror" id="brand"
                  name="brand" placeholder="e.g., Uniqlo" type="text"
                  value="{{ old('brand') }}">
                @error('brand')
                  <span class="error-message">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="grid-3">
              <div class="form-group">
                <label class="form-label" for="color">Color</label>
                <input class="form-input @error('color') form-input-error @enderror" id="color"
                  name="color" placeholder="e.g., White" type="text"
                  value="{{ old('color') }}">
                @error('color')
                  <span class="error-message">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label class="form-label" for="size">Size</label>
                <input class="form-input @error('size') form-input-error @enderror" id="size"
                  name="size" placeholder="e.g., M, L, XL" type="text"
                  value="{{ old('size') }}">
                @error('size')
                  <span class="error-message">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label class="form-label" for="material">Material</label>
                <input class="form-input @error('material') form-input-error @enderror"
                  id="material" name="material" placeholder="e.g., 100% Cotton" type="text"
                  value="{{ old('material') }}">
                @error('material')
                  <span class="error-message">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>

          <!-- Purchase Information -->
          <div class="form-section">
            <h3 class="form-section-title">Purchase Information</h3>

            <div class="grid-2">
              <div class="form-group">
                <label class="form-label" for="price">Price ($)</label>
                <input class="form-input @error('price') form-input-error @enderror" id="price"
                  name="price" placeholder="e.g., 29.99" step="0.01" type="number"
                  value="{{ old('price') }}">
                @error('price')
                  <span class="error-message">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label class="form-label" for="purchase_date">Purchase Date</label>
                <input class="form-input @error('purchase_date') form-input-error @enderror"
                  id="purchase_date" name="purchase_date" type="date"
                  value="{{ old('purchase_date') }}">
                @error('purchase_date')
                  <span class="error-message">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>

          <!-- Care Instructions -->
          <div class="form-section">
            <h3 class="form-section-title">Care Instructions</h3>

            <div class="form-group">
              <label class="form-label" for="care_instructions">Care Instructions</label>
              <textarea class="form-input @error('care_instructions') form-input-error @enderror"
                id="care_instructions" name="care_instructions"
                placeholder="e.g., Machine wash cold, tumble dry low" rows="3">{{ old('care_instructions') }}</textarea>
              @error('care_instructions')
                <span class="error-message">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <!-- Image Upload -->
          <div class="form-section">
            <h3 class="form-section-title">Item Image</h3>

            <div class="form-group">
              <div class="upload-area" id="uploadArea">
                <div class="upload-icon">
                  <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <p class="mb-2 text-gray-600">Click to upload or drag and drop</p>
                <p class="text-sm text-gray-500">PNG, JPG up to 5MB</p>
                <input accept="image/*" class="hidden" id="image" name="image"
                  type="file">
              </div>

              <div class="image-preview hidden" id="imagePreview">
                <img alt="Preview" id="previewImage" src="">
              </div>

              @error('image')
                <span class="error-message">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <!-- Notes and Status -->
          <div class="form-section">
            <h3 class="form-section-title">Additional Information</h3>

            <div class="grid-1">
              <div class="form-group">
                <label class="form-label" for="notes">Notes</label>
                <textarea class="form-input @error('notes') form-input-error @enderror" id="notes"
                  name="notes" placeholder="Any additional notes about this item" rows="3">{{ old('notes') }}</textarea>
                @error('notes')
                  <span class="error-message">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label class="form-label required" for="status">Status</label>
                <select class="status-select @error('status') form-input-error @enderror"
                  id="status" name="status" required>
                  <option value="">Select Status</option>
                  <option {{ old('status') == 'available' ? 'selected' : '' }} value="available">
                    Available</option>
                  <option {{ old('status') == 'laundry' ? 'selected' : '' }} value="laundry">In
                    Laundry</option>
                  <option {{ old('status') == 'handedout' ? 'selected' : '' }} value="handedout">
                    Handed Out</option>
                  <option {{ old('status') == 'discarded' ? 'selected' : '' }} value="discarded">
                    Discarded</option>
                </select>
                @error('status')
                  <span class="error-message">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>

          <!-- Submit Buttons -->
          <div class="button-group">
            <x-button class="btn-secondary" size='md' variant='outline' id="cancelAddModal" type="button">
              Cancel
            </x-button>
            <x-button class="btn-primary" size='md' variant='primary' type="submit">
              <i class="fas fa-plus mr-2"></i>
              Add Item
            </x-button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- View Clothing Modal -->
  <div class="modal" id="viewClothingModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="text-dark text-xl font-medium" id="modalTitle">Item Details</h2>
        <button class="modal-close" id="closeModal">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <img alt="Clothing Item" class="item-image-large" id="modalImage"
          src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
        <div class="item-details-grid">
          <div class="detail-item">
            <div class="detail-label">Brand</div>
            <div class="detail-value" id="modalBrand">Uniqlo</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Color</div>
            <div class="detail-value" id="modalColor">White</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Size</div>
            <div class="detail-value" id="modalSize">M</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Length</div>
            <div class="detail-value" id="modalLength">Regular</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Material</div>
            <div class="detail-value" id="modalMaterial">100% Cotton</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Care Instructions</div>
            <div class="detail-value" id="modalCare">Machine wash cold</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Purchase Date</div>
            <div class="detail-value" id="modalPurchaseDate">2023-01-15</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Price</div>
            <div class="detail-value" id="modalPrice">$19.99</div>
          </div>
        </div>
        <div class="detail-item mt-4">
          <div class="detail-label">Notes</div>
          <div class="detail-value" id="modalNotes">Perfect for everyday wear</div>
        </div>
      </div>
    </div>
  </div>
@endsection

{{-- @push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Modal elements
      const viewClothingModal = document.getElementById('viewClothingModal');
      const closeModalBtn = document.getElementById('closeModal');

      // Open modal
      function openItemModal() {
        // Just show the modal with the static content
        viewClothingModal.classList.add('show');
        document.body.style.overflow = 'hidden';
      }

      // Close modal
      function closeModal() {
        viewClothingModal.classList.remove('show');
        document.body.style.overflow = '';
      }

      // Add event listeners to all "View Details" buttons
      document.querySelectorAll('.view-item-btn').forEach(button => {
        button.addEventListener('click', openItemModal);
      });

      // Close modal when clicking close button
      closeModalBtn.addEventListener('click', closeModal);

      // Close modal when clicking outside the modal content
      viewClothingModal.addEventListener('click', function(event) {
        if (event.target === viewClothingModal) {
          closeModal();
        }
      });

      // Close modal with Escape key
      document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && viewClothingModal.classList.contains('show')) {
          closeModal();
        }
      });

      // Filter functionality (existing code)
      const filterDropdownBtn = document.getElementById('filterDropdownBtn');
      const filterDropdown = document.getElementById('filterDropdown');
      const filterBtns = document.querySelectorAll('.filter-btn[data-status]');

      // Toggle filter dropdown
      if (filterDropdownBtn) {
        filterDropdownBtn.addEventListener('click', function(e) {
          e.stopPropagation();
          filterDropdown.classList.toggle('show');
        });
      }

      // Close dropdown when clicking outside
      document.addEventListener('click', function() {
        if (filterDropdown) {
          filterDropdown.classList.remove('show');
        }
      });

      // Filter button functionality
      filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          const status = this.getAttribute('data-status');

          // Update active state
          filterBtns.forEach(b => b.classList.remove('active'));
          this.classList.add('active');

          // Filter logic would go here
          console.log('Filter by:', status);
        });
      });

      // Filter dropdown items
      const filterDropdownItems = document.querySelectorAll('.filter-dropdown-item');
      filterDropdownItems.forEach(item => {
        item.addEventListener('click', function() {
          const filterType = this.getAttribute('data-filter');

          // Update active state
          filterDropdownItems.forEach(i => i.classList.remove('active'));
          this.classList.add('active');

          // Filter logic would go here
          console.log('Advanced filter by:', filterType);

          // Close dropdown
          filterDropdown.classList.remove('show');
        });
      });
    });
  </script>
@endpush --}}

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add Clothing Modal elements
      const addClothingModal = document.getElementById('addClothingModal');
      const addItemBtn = document.getElementById('addItemBtn');
      const uploadItemBtn = document.getElementById('uploadItemBtn');
      const closeAddModalBtn = document.getElementById('closeAddModal');
      const cancelAddModalBtn = document.getElementById('cancelAddModal');

      // View Clothing Modal elements
      const viewClothingModal = document.getElementById('viewClothingModal');
      const closeModalBtn = document.getElementById('closeModal');

      // Open add clothing modal
      function openAddItemModal() {
        addClothingModal.classList.add('show');
        document.body.style.overflow = 'hidden';
      }

      // Close add clothing modal
      function closeAddModal() {
        addClothingModal.classList.remove('show');
        document.body.style.overflow = '';
        resetForm();
      }

      // Reset form when closing modal
      function resetForm() {
        document.getElementById('clothingForm').reset();
        const imagePreview = document.getElementById('imagePreview');
        const uploadArea = document.getElementById('uploadArea');
        imagePreview.classList.add('hidden');
        uploadArea.classList.remove('hidden');
      }

      // Open view clothing modal
      function openItemModal() {
        viewClothingModal.classList.add('show');
        document.body.style.overflow = 'hidden';
      }

      // Close view clothing modal
      function closeModal() {
        viewClothingModal.classList.remove('show');
        document.body.style.overflow = '';
      }

      // Add event listeners for add clothing modal
      if (addItemBtn) {
        addItemBtn.addEventListener('click', openAddItemModal);
      }

      if (uploadItemBtn) {
        uploadItemBtn.addEventListener('click', openAddItemModal);
      }

      if (closeAddModalBtn) {
        closeAddModalBtn.addEventListener('click', closeAddModal);
      }

      if (cancelAddModalBtn) {
        cancelAddModalBtn.addEventListener('click', closeAddModal);
      }

      // Add event listeners to all "View Details" buttons
      document.querySelectorAll('.view-item-btn').forEach(button => {
        button.addEventListener('click', openItemModal);
      });

      // Close modals when clicking close buttons
      closeModalBtn.addEventListener('click', closeModal);

      // Close modals when clicking outside the modal content
      [addClothingModal, viewClothingModal].forEach(modal => {
        modal.addEventListener('click', function(event) {
          if (event.target === modal) {
            if (modal.id === 'addClothingModal') {
              closeAddModal();
            } else {
              closeModal();
            }
          }
        });
      });

      // Close modals with Escape key
      document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
          if (addClothingModal.classList.contains('show')) {
            closeAddModal();
          }
          if (viewClothingModal.classList.contains('show')) {
            closeModal();
          }
        }
      });

      // Image upload preview for add clothing modal
      const uploadArea = document.getElementById('uploadArea');
      const fileInput = document.getElementById('image');
      const imagePreview = document.getElementById('imagePreview');
      const previewImage = document.getElementById('previewImage');

      if (uploadArea && fileInput) {
        uploadArea.addEventListener('click', function() {
          fileInput.click();
        });

        fileInput.addEventListener('change', function(e) {
          const file = e.target.files[0];
          if (file) {
            // Check file size (5MB limit)
            if (file.size > 5 * 1024 * 1024) {
              alert('File size must be less than 5MB');
              return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
              previewImage.src = e.target.result;
              imagePreview.classList.remove('hidden');
              uploadArea.classList.add('hidden');
            }

            reader.readAsDataURL(file);
          }
        });

        // Drag and drop functionality
        uploadArea.addEventListener('dragover', function(e) {
          e.preventDefault();
          uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', function(e) {
          e.preventDefault();
          uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', function(e) {
          e.preventDefault();
          uploadArea.classList.remove('dragover');

          const file = e.dataTransfer.files[0];
          if (file && file.type.startsWith('image/')) {
            // Check file size (5MB limit)
            if (file.size > 5 * 1024 * 1024) {
              alert('File size must be less than 5MB');
              return;
            }

            fileInput.files = e.dataTransfer.files;

            const reader = new FileReader();
            reader.onload = function(e) {
              previewImage.src = e.target.result;
              imagePreview.classList.remove('hidden');
              uploadArea.classList.add('hidden');
            }
            reader.readAsDataURL(file);
          }
        });

        // Remove image and show upload area again
        imagePreview.addEventListener('click', function() {
          fileInput.value = '';
          imagePreview.classList.add('hidden');
          uploadArea.classList.remove('hidden');
        });
      }

      // Form validation
      const form = document.getElementById('clothingForm');
      if (form) {
        form.addEventListener('submit', function(e) {
          const name = document.getElementById('name').value.trim();
          const status = document.getElementById('status').value;

          if (!name) {
            e.preventDefault();
            alert('Item name is required');
            document.getElementById('name').focus();
            return false;
          }

          if (!status) {
            e.preventDefault();
            alert('Please select a status');
            document.getElementById('status').focus();
            return false;
          }

          return true;
        });
      }

      // Set max date for purchase date to today
      const purchaseDateInput = document.getElementById('purchase_date');
      if (purchaseDateInput) {
        const today = new Date().toISOString().split('T')[0];
        purchaseDateInput.max = today;
      }

      // Filter functionality (existing code)
      const filterDropdownBtn = document.getElementById('filterDropdownBtn');
      const filterDropdown = document.getElementById('filterDropdown');
      const filterBtns = document.querySelectorAll('.filter-btn[data-status]');

      // Toggle filter dropdown
      if (filterDropdownBtn) {
        filterDropdownBtn.addEventListener('click', function(e) {
          e.stopPropagation();
          filterDropdown.classList.toggle('show');
        });
      }

      // Close dropdown when clicking outside
      document.addEventListener('click', function() {
        if (filterDropdown) {
          filterDropdown.classList.remove('show');
        }
      });

      // Filter button functionality
      filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          const status = this.getAttribute('data-status');

          // Update active state
          filterBtns.forEach(b => b.classList.remove('active'));
          this.classList.add('active');

          // Filter logic would go here
          console.log('Filter by:', status);
        });
      });

      // Filter dropdown items
      const filterDropdownItems = document.querySelectorAll('.filter-dropdown-item');
      filterDropdownItems.forEach(item => {
        item.addEventListener('click', function() {
          const filterType = this.getAttribute('data-filter');

          // Update active state
          filterDropdownItems.forEach(i => i.classList.remove('active'));
          this.classList.add('active');

          // Filter logic would go here
          console.log('Advanced filter by:', filterType);

          // Close dropdown
          filterDropdown.classList.remove('show');
        });
      });

      // Auto-open modal if there are validation errors
      @if ($errors->any())
        openAddItemModal();
      @endif
    });
  </script>
@endpush
