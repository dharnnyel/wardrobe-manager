@extends('layouts.dashboard')
@section('page_title', 'My Orders')
@section('title', 'Orders')

@push('styles')
  <style>
    .order-card {
      transition: all 0.3s ease;
    }

    .order-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .tracking-bar {
      height: 6px;
      border-radius: 3px;
      background-color: #e5e7eb;
      position: relative;
    }

    .tracking-progress {
      height: 100%;
      border-radius: 3px;
      background-color: #4FD1C5;
      transition: width 0.5s ease;
    }

    .tracking-dot {
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background-color: #e5e7eb;
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
    }

    .tracking-dot.active {
      background-color: #4FD1C5;
    }

    .tracking-dot.completed {
      background-color: #68D391;
    }

    /* Improved responsive grid for orders */
    .order-grid {
      display: grid;
      grid-template-columns: repeat(1, minmax(0, 1fr));
      gap: 1rem;
    }

    @media (min-width: 1024px) {
      .order-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1.5rem;
      }
    }

    /* Order status badges */
    .status-badge {
      padding: 0.25rem 0.75rem;
      border-radius: 1rem;
      font-size: 0.75rem;
      font-weight: 600;
    }

    .status-delivered {
      background-color: #68D391;
      color: white;
    }

    .status-shipped {
      background-color: #4FD1C5;
      color: white;
    }

    .status-processing {
      background-color: #F6AD55;
      color: white;
    }

    .status-cancelled {
      background-color: #FC8181;
      color: white;
    }

    .status-returned {
      background-color: #A0AEC0;
      color: white;
    }

    /* Order filter tabs */
    .order-tab {
      transition: all 0.3s ease;
      font-size: 12px;
    }

    .order-tab.active {
      background-color: #9F7AEA;
      color: white;
    }
  </style>
@endpush

@section('content')
  <!-- Orders Content -->
  <div class="container mx-auto px-4 py-8 sm:px-6">
    <!-- Orders Summary -->
    <div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
      <div class="responsive-card rounded-2xl bg-white text-center shadow-lg">
        <div
          class="bg-primary/20 mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full">
          <i class="fas fa-shopping-bag text-primary text-xl"></i>
        </div>
        <h3 class="text-dark mb-1 text-2xl font-bold">12</h3>
        <p class="text-gray-600">Total Orders</p>
      </div>
      <div class="responsive-card rounded-2xl bg-white text-center shadow-lg">
        <div
          class="bg-secondary/20 mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full">
          <i class="fas fa-shipping-fast text-secondary text-xl"></i>
        </div>
        <h3 class="text-dark mb-1 text-2xl font-bold">3</h3>
        <p class="text-gray-600">In Transit</p>
      </div>
      <div class="responsive-card rounded-2xl bg-white text-center shadow-lg">
        <div
          class="bg-success/20 mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full">
          <i class="fas fa-check-circle text-success text-xl"></i>
        </div>
        <h3 class="text-dark mb-1 text-2xl font-bold">8</h3>
        <p class="text-gray-600">Delivered</p>
      </div>
      <div class="responsive-card rounded-2xl bg-white text-center shadow-lg">
        <div
          class="bg-accent/20 mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full">
          <i class="fas fa-undo-alt text-accent text-xl"></i>
        </div>
        <h3 class="text-dark mb-1 text-2xl font-bold">1</h3>
        <p class="text-gray-600">Returns</p>
      </div>
    </div>

    <!-- Order Filters -->
    <div class="responsive-card mb-8 rounded-2xl bg-white shadow-lg">
      <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h2 class="responsive-heading text-dark font-bold">
          Your Orders
        </h2>
        <div class="flex flex-wrap gap-2">
          <button class="order-tab active bg-primary rounded-full px-3 py-2 font-medium text-white">
            All Orders
          </button>
          <button
            class="order-tab rounded-full bg-gray-100 px-3 py-2 font-medium text-gray-700 hover:bg-gray-200">
            Processing
          </button>
          <button
            class="order-tab rounded-full bg-gray-100 px-3 py-2 font-medium text-gray-700 hover:bg-gray-200">
            Shipped
          </button>
          <button
            class="order-tab rounded-full bg-gray-100 px-3 py-2 font-medium text-gray-700 hover:bg-gray-200">
            Delivered
          </button>
          <button
            class="order-tab rounded-full bg-gray-100 px-3 py-2 font-medium text-gray-700 hover:bg-gray-200">
            Returns
          </button>
        </div>
      </div>
    </div>

    <!-- Active Orders -->
    <div class="responsive-card mb-8 rounded-2xl bg-white shadow-lg">
      <h2 class="responsive-heading text-dark mb-6 font-bold">
        Active Orders
      </h2>

      <div class="order-grid">
        <!-- Order 1 -->
        <div class="order-card overflow-hidden rounded-xl border border-gray-200 bg-white">
          <div class="border-b border-gray-200 p-4">
            <div class="mb-3 flex items-start justify-between">
              <div>
                <h3 class="text-dark font-bold">Order #SH-7832</h3>
                <p class="text-sm text-gray-600">Placed on Oct 12, 2023</p>
              </div>
              <span class="status-badge status-shipped">Shipped</span>
            </div>
            <div class="flex items-center text-sm text-gray-600">
              <i class="fas fa-store mr-2"></i>
              <span>Zara</span>
              <span class="mx-2">•</span>
              <span>2 items</span>
              <span class="mx-2">•</span>
              <span class="text-dark font-bold">$89.98</span>
            </div>
          </div>
          <div class="p-4">
            <!-- Tracking Progress -->
            <div class="mb-4">
              <div class="mb-1 flex justify-between text-xs text-gray-600">
                <span>Ordered</span>
                <span>Shipped</span>
                <span>Out for Delivery</span>
                <span>Delivered</span>
              </div>
              <div class="tracking-bar">
                <div class="tracking-progress" style="width: 50%"></div>
                <div class="tracking-dot completed" style="left: 0%"></div>
                <div class="tracking-dot completed" style="left: 33%"></div>
                <div class="tracking-dot active" style="left: 66%"></div>
                <div class="tracking-dot" style="left: 100%"></div>
              </div>
            </div>

            <!-- Order Items -->
            <div class="mb-4 flex space-x-3">
              <div
                class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-lg bg-gray-100">
                <img alt="Casual Shirt" class="h-full w-full object-cover"
                  src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
              </div>
              <div
                class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-lg bg-gray-100">
                <img alt="Slim Jeans" class="h-full w-full object-cover"
                  src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-2">
              <button
                class="bg-primary flex items-center rounded-lg px-3 py-2 text-sm text-white transition hover:bg-purple-700">
                <i class="fas fa-map-marker-alt mr-1"></i> Track Order
              </button>
              <button
                class="flex items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-50">
                <i class="fas fa-undo-alt mr-1"></i> Return
              </button>
              <button
                class="flex items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-50">
                <i class="fas fa-question-circle mr-1"></i> Help
              </button>
            </div>
          </div>
        </div>

        <!-- Order 2 -->
        <div class="order-card overflow-hidden rounded-xl border border-gray-200 bg-white">
          <div class="border-b border-gray-200 p-4">
            <div class="mb-3 flex items-start justify-between">
              <div>
                <h3 class="text-dark font-bold">Order #SH-7921</h3>
                <p class="text-sm text-gray-600">Placed on Oct 10, 2023</p>
              </div>
              <span class="status-badge status-processing">Processing</span>
            </div>
            <div class="flex items-center text-sm text-gray-600">
              <i class="fab fa-amazon mr-2"></i>
              <span>Amazon</span>
              <span class="mx-2">•</span>
              <span>1 item</span>
              <span class="mx-2">•</span>
              <span class="text-dark font-bold">$45.99</span>
            </div>
          </div>
          <div class="p-4">
            <!-- Tracking Progress -->
            <div class="mb-4">
              <div class="mb-1 flex justify-between text-xs text-gray-600">
                <span>Ordered</span>
                <span>Shipped</span>
                <span>Out for Delivery</span>
                <span>Delivered</span>
              </div>
              <div class="tracking-bar">
                <div class="tracking-progress" style="width: 25%"></div>
                <div class="tracking-dot completed" style="left: 0%"></div>
                <div class="tracking-dot" style="left: 33%"></div>
                <div class="tracking-dot" style="left: 66%"></div>
                <div class="tracking-dot" style="left: 100%"></div>
              </div>
            </div>

            <!-- Order Items -->
            <div class="mb-4 flex space-x-3">
              <div
                class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-lg bg-gray-100">
                <img alt="Running Shoes" class="h-full w-full object-cover"
                  src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-2">
              <button
                class="bg-primary flex items-center rounded-lg px-3 py-2 text-sm text-white transition hover:bg-purple-700">
                <i class="fas fa-map-marker-alt mr-1"></i> Track Order
              </button>
              <button
                class="flex items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-50">
                <i class="fas fa-times-circle mr-1"></i> Cancel
              </button>
              <button
                class="flex items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-50">
                <i class="fas fa-question-circle mr-1"></i> Help
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Order History -->
    <div class="responsive-card mb-8 rounded-2xl bg-white shadow-lg">
      <h2 class="responsive-heading text-dark mb-6 font-bold">
        Order History
      </h2>

      <div class="order-grid">
        <!-- Order 3 -->
        <div class="order-card overflow-hidden rounded-xl border border-gray-200 bg-white">
          <div class="border-b border-gray-200 p-4">
            <div class="mb-3 flex items-start justify-between">
              <div>
                <h3 class="text-dark font-bold">Order #SH-7815</h3>
                <p class="text-sm text-gray-600">Placed on Oct 5, 2023</p>
              </div>
              <span class="status-badge status-delivered">Delivered</span>
            </div>
            <div class="flex items-center text-sm text-gray-600">
              <i class="fas fa-tshirt mr-2"></i>
              <span>H&M</span>
              <span class="mx-2">•</span>
              <span>3 items</span>
              <span class="mx-2">•</span>
              <span class="text-dark font-bold">$67.47</span>
            </div>
          </div>
          <div class="p-4">
            <!-- Order Items -->
            <div class="mb-4 flex space-x-3">
              <div
                class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-lg bg-gray-100">
                <img alt="Summer Dress" class="h-full w-full object-cover"
                  src="https://images.unsplash.com/photo-1595777457583-95e059d581b8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
              </div>
              <div
                class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-lg bg-gray-100">
                <img alt="Maxi Dress" class="h-full w-full object-cover"
                  src="https://images.unsplash.com/photo-1576566588028-4147f3842f27?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
              </div>
              <div
                class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-lg bg-gray-100">
                <img alt="Casual Dress" class="h-full w-full object-cover"
                  src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-2">
              <button
                class="flex items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-50">
                <i class="fas fa-undo-alt mr-1"></i> Return Items
              </button>
              <button
                class="flex items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-50">
                <i class="fas fa-star mr-1"></i> Rate & Review
              </button>
              <button
                class="flex items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-50">
                <i class="fas fa-redo-alt mr-1"></i> Buy Again
              </button>
            </div>
          </div>
        </div>

        <!-- Order 4 -->
        <div class="order-card overflow-hidden rounded-xl border border-gray-200 bg-white">
          <div class="border-b border-gray-200 p-4">
            <div class="mb-3 flex items-start justify-between">
              <div>
                <h3 class="text-dark font-bold">Order #SH-7792</h3>
                <p class="text-sm text-gray-600">Placed on Sep 28, 2023</p>
              </div>
              <span class="status-badge status-returned">Returned</span>
            </div>
            <div class="flex items-center text-sm text-gray-600">
              <i class="fas fa-store mr-2"></i>
              <span>Nike</span>
              <span class="mx-2">•</span>
              <span>1 item</span>
              <span class="mx-2">•</span>
              <span class="text-dark font-bold">$89.99</span>
            </div>
          </div>
          <div class="p-4">
            <!-- Order Items -->
            <div class="mb-4 flex space-x-3">
              <div
                class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-lg bg-gray-100">
                <img alt="Running Shoes" class="h-full w-full object-cover"
                  src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
              </div>
            </div>

            <!-- Return Status -->
            <div class="mb-4 rounded-lg bg-gray-50 p-3">
              <div class="mb-1 flex items-center text-sm text-gray-600">
                <i class="fas fa-undo-alt text-accent mr-2"></i>
                <span class="font-medium">Return Completed</span>
              </div>
              <p class="text-xs text-gray-500">Refund processed on Oct 5, 2023</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-2">
              <button
                class="flex items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-50">
                <i class="fas fa-redo-alt mr-1"></i> Buy Again
              </button>
              <button
                class="flex items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-50">
                <i class="fas fa-question-circle mr-1"></i> Help
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Return & Exchange Info -->
    <div class="responsive-card rounded-2xl bg-white shadow-lg">
      <h2 class="responsive-heading text-dark mb-6 font-bold">
        Return & Exchange Information
      </h2>

      <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        <div class="rounded-xl bg-gray-50 p-4">
          <div class="bg-primary/20 mb-3 flex h-10 w-10 items-center justify-center rounded-full">
            <i class="fas fa-undo-alt text-primary"></i>
          </div>
          <h3 class="text-dark mb-2 font-bold">Easy Returns</h3>
          <p class="text-sm text-gray-600">Most items can be returned within 30 days of delivery for
            a full refund.</p>
        </div>
        <div class="rounded-xl bg-gray-50 p-4">
          <div class="bg-secondary/20 mb-3 flex h-10 w-10 items-center justify-center rounded-full">
            <i class="fas fa-sync-alt text-secondary"></i>
          </div>
          <h3 class="text-dark mb-2 font-bold">Quick Exchanges</h3>
          <p class="text-sm text-gray-600">Need a different size or color? We make exchanges simple
            and fast.</p>
        </div>
        <div class="rounded-xl bg-gray-50 p-4">
          <div class="bg-success/20 mb-3 flex h-10 w-10 items-center justify-center rounded-full">
            <i class="fas fa-shipping-fast text-success"></i>
          </div>
          <h3 class="text-dark mb-2 font-bold">Free Return Shipping</h3>
          <p class="text-sm text-gray-600">We provide free return shipping labels for most returns.
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    // Order tabs
    const orderTabs = document.querySelectorAll('.order-tab');

    // Activate order tab
    function activateOrderTab(event) {
      orderTabs.forEach(tab => tab.classList.remove('active', 'bg-primary', 'text-white'));
      event.currentTarget.classList.add('active', 'bg-primary', 'text-white');
    }

    // Order tabs
    orderTabs.forEach(tab => {
      tab.addEventListener('click', activateOrderTab);
    });
  </script>
@endpush
