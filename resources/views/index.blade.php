@extends('layouts.guest')
@section('title', 'Your Ultimate Wardrobe Manager')
@push('styles')
  <style>
    .clothing-image {
      background-size: cover;
      background-position: center;
      transition: transform 0.3s ease;
    }

    .clothing-image:hover {
      transform: scale(1.05);
    }

    .text-shadow {
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .text-shadow-lg {
      text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
  </style>
@endpush
@section('content')
  <!-- Hero Section -->
  <section class="gradient-bg py-16 text-white md:py-24">
    <div class="container mx-auto flex flex-col items-center px-6 md:flex-row">
      <div class="mb-10 md:mb-0 md:w-1/2">
        <h1 class="mb-4 text-4xl font-bold md:text-5xl">Your Ultimate Digital Wardrobe</h1>
        <p class="mb-8 text-xl">Organize, shop, and declutter your wardrobe all in one place. Discover
          your perfect style with StyleHub.</p>
        <div
          class="mx-auto flex max-w-md flex-col space-y-4 sm:max-w-full sm:flex-row sm:space-x-4 sm:space-y-0">
          <button
            class="text-primary rounded-lg bg-white px-6 py-3 font-bold transition hover:bg-gray-100">Get
            Started</button>
          <button
            class="hover:text-primary rounded-lg border-2 border-white bg-transparent px-6 py-3 font-bold text-white transition hover:bg-white">Watch
            Demo</button>
        </div>
      </div>
      <div class="flex w-full justify-center md:w-1/2">
        <div class="relative w-full max-w-md">
          <div class="rotate-3 transform rounded-2xl bg-white p-6 shadow-2xl">
            <div class="mb-4 flex items-center justify-between">
              <h3 class="text-dark font-bold">Today's Outfit</h3>
              <span class="bg-secondary rounded-full px-2 py-1 text-xs text-white">Recommended</span>
            </div>
            <div class="mb-4 grid grid-cols-3 gap-2">
              <!-- Shirt image -->
              <div class="clothing-image h-24 overflow-hidden rounded-lg"
                style="background-image: url('https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80')">
              </div>
              <!-- Jacket image -->
              <div class="clothing-image h-24 overflow-hidden rounded-lg"
                style="background-image: url('https://images.unsplash.com/photo-1551028719-00167b16eac5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80')">
              </div>
              <!-- Shoes image -->
              <div class="clothing-image h-24 overflow-hidden rounded-lg"
                style="background-image: url('https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80')">
              </div>
            </div>
            <div class="flex justify-between text-sm text-gray-600">
              <span>Casual Look</span>
              <span>85% Match</span>
            </div>
          </div>
          <div
            class="absolute -bottom-4 -right-4 w-3/4 -rotate-3 transform rounded-2xl bg-white p-4 shadow-2xl">
            <div class="mb-2 flex items-center">
              <div class="bg-success mr-2 h-3 w-3 rounded-full"></div>
              <span class="text-dark text-sm font-medium">Weather Appropriate</span>
            </div>
            <p class="text-xs text-gray-600">This outfit matches today's weather forecast perfectly.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="bg-white py-16">
    <div class="container mx-auto px-6">
      <h2 class="text-dark mb-4 text-center text-3xl font-bold">Revolutionize Your Wardrobe Management
      </h2>
      <p class="mx-auto mb-12 max-w-2xl text-center text-gray-600">StyleHub offers a complete solution
        for organizing, decluttering, and expanding your wardrobe.</p>

      <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
        <!-- Feature 1 -->
        <div class="bg-light feature-card rounded-xl p-6 shadow-md">
          <div class="bg-primary mb-4 flex h-12 w-12 items-center justify-center rounded-lg">
            <i class="fas fa-archive text-xl text-white"></i>
          </div>
          <h3 class="text-dark mb-2 text-xl font-bold">Manage Your Wardrobe</h3>
          <p class="text-gray-600">Catalog all your clothing items with photos, categories, and tags
            for easy organization and retrieval.</p>
          <ul class="mt-4 space-y-2 text-sm text-gray-600">
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-2"></i>
              Digital catalog of all items
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-2"></i>
              Outfit creation & planning
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-2"></i>
              Style analytics & insights
            </li>
          </ul>
        </div>

        <!-- Feature 2 -->
        <div class="bg-light feature-card rounded-xl p-6 shadow-md">
          <div class="bg-accent mb-4 flex h-12 w-12 items-center justify-center rounded-lg">
            <i class="fas fa-trash-alt text-xl text-white"></i>
          </div>
          <h3 class="text-dark mb-2 text-xl font-bold">Declutter & Discard</h3>
          <p class="text-gray-600">Identify items you no longer need and make space for new additions
            to your wardrobe.</p>
          <ul class="mt-4 space-y-2 text-sm text-gray-600">
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-2"></i>
              Usage tracking & analytics
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-2"></i>
              Donation/selling suggestions
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-2"></i>
              Seasonal item management
            </li>
          </ul>
        </div>

        <!-- Feature 3 -->
        <div class="bg-light feature-card rounded-xl p-6 shadow-md">
          <div class="bg-secondary mb-4 flex h-12 w-12 items-center justify-center rounded-lg">
            <i class="fas fa-cart-plus text-xl text-white"></i>
          </div>
          <h3 class="text-dark mb-2 text-xl font-bold">Import from Stores</h3>
          <p class="text-gray-600">Add items from popular e-commerce stores directly to your digital
            wardrobe for planning.</p>
          <ul class="mt-4 space-y-2 text-sm text-gray-600">
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-2"></i>
              Import from Amazon, Zara, etc.
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-2"></i>
              Virtual try-on with your items
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-2"></i>
              Price tracking & alerts
            </li>
          </ul>
        </div>

        <!-- Feature 4 -->
        <div class="bg-light feature-card rounded-xl p-6 shadow-md">
          <div class="bg-primary mb-4 flex h-12 w-12 items-center justify-center rounded-lg">
            <i class="fas fa-shopping-bag text-xl text-white"></i>
          </div>
          <h3 class="text-dark mb-2 text-xl font-bold">In-App Shopping</h3>
          <p class="text-gray-600">Shop directly from your favorite stores without leaving the app to
            fill gaps in your wardrobe.</p>
          <ul class="mt-4 space-y-2 text-sm text-gray-600">
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-2"></i>
              Integrated store marketplace
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-2"></i>
              Personalized recommendations
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-2"></i>
              Style-based shopping lists
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section class="from-primary to-secondary bg-gradient-to-r py-16 text-white">
    <div class="container mx-auto px-6">
      <h2 class="mb-4 text-center text-3xl font-bold">How StyleHub Works</h2>
      <p class="mx-auto mb-12 max-w-2xl text-center">Transform your wardrobe management in just a few
        simple steps.</p>

      <div class="flex flex-col items-center justify-between md:flex-row">
        <div class="mb-10 text-center md:mb-0 md:w-1/4">
          <div
            class="text-primary mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-white text-2xl font-bold">
            1</div>
          <h3 class="mb-2 text-xl font-bold">Add Your Items</h3>
          <p>Upload your existing wardrobe or import items from your favorite stores.</p>
        </div>

        <div class="mb-10 text-center md:mb-0 md:w-1/4">
          <div
            class="text-primary mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-white text-2xl font-bold">
            2</div>
          <h3 class="mb-2 text-xl font-bold">Organize & Declutter</h3>
          <p>Categorize your items and identify what to keep, donate, or discard.</p>
        </div>

        <div class="mb-10 text-center md:mb-0 md:w-1/4">
          <div
            class="text-primary mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-white text-2xl font-bold">
            3</div>
          <h3 class="mb-2 text-xl font-bold">Create Outfits</h3>
          <p>Mix and match items to create perfect outfits for any occasion.</p>
        </div>

        <div class="text-center md:w-1/4">
          <div
            class="text-primary mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-white text-2xl font-bold">
            4</div>
          <h3 class="mb-2 text-xl font-bold">Shop Smart</h3>
          <p>Fill wardrobe gaps by shopping directly from integrated stores.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Shopping Integration Demo -->
  <section class="bg-white py-16">
    <div class="container mx-auto px-6">
      <h2 class="text-dark mb-4 text-center text-3xl font-bold">Seamless Shopping Integration</h2>
      <p class="mx-auto mb-12 max-w-2xl text-center text-gray-600">Browse and shop from your favorite
        stores without leaving the app.</p>

      <div class="bg-light rounded-2xl p-6 shadow-lg md:p-8">
        <div class="flex flex-col md:flex-row">
          <div class="mb-6 md:mb-0 md:w-1/2">
            <h3 class="text-dark mb-4 text-2xl font-bold">Popular Stores Integrated</h3>
            <div class="mb-6 grid grid-cols-2 gap-4 md:grid-cols-3">
              <!-- Amazon -->
              <div class="flex items-center justify-center rounded-lg bg-white p-4 shadow">
                <div class="text-center">
                  <div class="clothing-image mx-auto mb-2 h-16 w-16 overflow-hidden rounded-full"
                    style="background-image: url('https://images.unsplash.com/photo-1544441893-675973e31985?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80')">
                  </div>
                  <span class="text-sm font-bold text-gray-700">Amazon</span>
                </div>
              </div>

              <!-- Zara -->
              <div class="flex items-center justify-center rounded-lg bg-white p-4 shadow">
                <div class="text-center">
                  <div class="clothing-image mx-auto mb-2 h-16 w-16 overflow-hidden rounded-full"
                    style="background-image: url('https://images.unsplash.com/photo-1485231183945-fffde7cb39e9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80')">
                  </div>
                  <span class="text-sm font-bold text-gray-700">Zara</span>
                </div>
              </div>

              <!-- H&M -->
              <div class="flex items-center justify-center rounded-lg bg-white p-4 shadow">
                <div class="text-center">
                  <div class="clothing-image mx-auto mb-2 h-16 w-16 overflow-hidden rounded-full"
                    style="background-image: url('https://images.unsplash.com/photo-1582418702059-97ebafb35d09?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80')">
                  </div>
                  <span class="text-sm font-bold text-gray-700">H&M</span>
                </div>
              </div>

              <!-- Nike -->
              <div class="flex items-center justify-center rounded-lg bg-white p-4 shadow">
                <div class="text-center">
                  <div class="clothing-image mx-auto mb-2 h-16 w-16 overflow-hidden rounded-full"
                    style="background-image: url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80')">
                  </div>
                  <span class="text-sm font-bold text-gray-700">Nike</span>
                </div>
              </div>

              <!-- Adidas -->
              <div class="flex items-center justify-center rounded-lg bg-white p-4 shadow">
                <div class="text-center">
                  <div class="clothing-image mx-auto mb-2 h-16 w-16 overflow-hidden rounded-full"
                    style="background-image: url('https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80')">
                  </div>
                  <span class="text-sm font-bold text-gray-700">Adidas</span>
                </div>
              </div>

              <!-- Uniqlo -->
              <div class="flex items-center justify-center rounded-lg bg-white p-4 shadow">
                <div class="text-center">
                  <div class="clothing-image mx-auto mb-2 h-16 w-16 overflow-hidden rounded-full"
                    style="background-image: url('https://images.unsplash.com/photo-1594223274512-ad4803739b7c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80')">
                  </div>
                  <span class="text-sm font-bold text-gray-700">Uniqlo</span>
                </div>
              </div>
            </div>
            <p class="text-gray-600">Import items you like to your virtual wardrobe to see how they
              match with your existing clothes before purchasing.</p>
          </div>
          <div class="flex justify-center md:w-1/2">
            <div class="max-w-xs rounded-xl bg-white p-4 shadow-lg">
              <div class="clothing-image mb-4 h-40 overflow-hidden rounded-lg"
                style="background-image: url('https://images.unsplash.com/photo-1595777457583-95e059d581b8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80')">
              </div>
              <h4 class="text-dark mb-2 font-bold">Summer Floral Dress</h4>
              <div class="mb-2 flex items-center justify-between">
                <span class="text-primary font-bold">$49.99</span>
                <span class="bg-success rounded px-2 py-1 text-xs text-white">In Stock</span>
              </div>
              <p class="mb-4 text-sm text-gray-600">Perfect for summer outings and beach parties.</p>
              <div class="flex space-x-2">
                <button
                  class="bg-primary flex-1 rounded-lg px-4 py-2 text-sm font-medium text-white">Add
                  to Wardrobe</button>
                <button
                  class="bg-secondary flex-1 rounded-lg px-4 py-2 text-sm font-medium text-white">Buy
                  Now</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Decluttering Section -->
  <section class="bg-light py-16">
    <div class="container mx-auto px-6">
      <h2 class="text-dark mb-4 text-center text-3xl font-bold">Smart Decluttering</h2>
      <p class="mx-auto mb-12 max-w-2xl text-center text-gray-600">Let StyleHub help you identify
        items to discard and make room for new favorites.</p>

      <div class="flex flex-col items-center md:flex-row">
        <div class="mb-8 md:mb-0 md:w-1/2">
          <div class="mx-auto max-w-md rounded-2xl bg-white p-6 shadow-lg">
            <div class="mb-4 flex items-center justify-between">
              <h3 class="text-dark text-xl font-bold">Items to Review</h3>
              <span class="bg-accent rounded-full px-2 py-1 text-xs text-white">3 items</span>
            </div>
            <div class="space-y-4">
              <div class="flex items-center justify-between rounded-lg bg-red-50 p-3">
                <div class="flex items-center">
                  <div
                    class="mr-3 flex h-10 w-10 items-center justify-center rounded-lg bg-gray-300">
                    <i class="fas fa-tshirt text-gray-500"></i>
                  </div>
                  <div>
                    <h4 class="text-dark font-medium">Striped T-Shirt</h4>
                    <p class="text-xs text-gray-500">Not worn in 6 months</p>
                  </div>
                </div>
                <button class="text-accent hover:text-red-700">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>

              <div class="flex items-center justify-between rounded-lg bg-yellow-50 p-3">
                <div class="flex items-center">
                  <div
                    class="mr-3 flex h-10 w-10 items-center justify-center rounded-lg bg-gray-300">
                    <i class="fas fa-vest text-gray-500"></i>
                  </div>
                  <div>
                    <h4 class="text-dark font-medium">Winter Jacket</h4>
                    <p class="text-xs text-gray-500">Seasonal - store away</p>
                  </div>
                </div>
                <button class="hover:text-dark text-gray-500">
                  <i class="fas fa-archive"></i>
                </button>
              </div>

              <div class="flex items-center justify-between rounded-lg bg-green-50 p-3">
                <div class="flex items-center">
                  <div
                    class="mr-3 flex h-10 w-10 items-center justify-center rounded-lg bg-gray-300">
                    <i class="fas fa-shoe-prints text-gray-500"></i>
                  </div>
                  <div>
                    <h4 class="text-dark font-medium">Running Shoes</h4>
                    <p class="text-xs text-gray-500">Worn frequently - keep</p>
                  </div>
                </div>
                <button class="text-success hover:text-green-700">
                  <i class="fas fa-check-circle"></i>
                </button>
              </div>
            </div>
            <button
              class="bg-accent mt-6 w-full rounded-lg py-2 font-medium text-white transition hover:bg-red-500">Declutter
              Selected Items</button>
          </div>
        </div>
        <div class="md:w-1/2">
          <h3 class="text-dark mb-4 text-2xl font-bold">Why Declutter with StyleHub?</h3>
          <ul class="space-y-4">
            <li class="flex items-start">
              <i class="fas fa-chart-line text-secondary mr-3 mt-1"></i>
              <div>
                <h4 class="text-dark font-bold">Usage Analytics</h4>
                <p class="text-gray-600">See which items you wear most and which ones are collecting
                  dust.</p>
              </div>
            </li>
            <li class="flex items-start">
              <i class="fas fa-calendar-alt text-primary mr-3 mt-1"></i>
              <div>
                <h4 class="text-dark font-bold">Seasonal Reminders</h4>
                <p class="text-gray-600">Get notified when it's time to store seasonal items or bring
                  them back into rotation.</p>
              </div>
            </li>
            <li class="flex items-start">
              <i class="fas fa-hand-holding-usd text-success mr-3 mt-1"></i>
              <div>
                <h4 class="text-dark font-bold">Resell or Donate</h4>
                <p class="text-gray-600">Get suggestions for reselling valuable items or donating to
                  charity.</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Laundry Tracking Section -->
  <section class="bg-white py-16">
    <div class="container mx-auto px-6">
      <h2 class="text-dark mb-4 text-center text-3xl font-bold">Smart Laundry Tracking</h2>
      <p class="mx-auto mb-12 max-w-2xl text-center text-gray-600">Never lose track of your laundry
        again with our integrated laundry management system.</p>

      <div class="flex flex-col items-center md:flex-row">
        <div class="mb-8 md:mb-0 md:w-1/2">
          <div class="bg-light mx-auto max-w-md rounded-2xl p-6 shadow-lg">
            <div class="mb-4 flex items-center justify-between">
              <h3 class="text-dark text-xl font-bold">Laundry Status</h3>
              <span class="bg-primary rounded-full px-2 py-1 text-xs text-white">3 items to
                wash</span>
            </div>
            <div class="space-y-4">
              <div class="flex items-center justify-between rounded-lg bg-blue-50 p-3">
                <div class="flex items-center">
                  <div
                    class="mr-3 flex h-10 w-10 items-center justify-center rounded-lg bg-gray-300">
                    <i class="fas fa-tshirt text-gray-500"></i>
                  </div>
                  <div>
                    <h4 class="text-dark font-medium">White Cotton Shirt</h4>
                    <p class="text-xs text-gray-500">Last worn: 2 days ago</p>
                  </div>
                </div>
                <span class="text-sm font-medium text-blue-500">To Wash</span>
              </div>

              <div class="flex items-center justify-between rounded-lg bg-purple-50 p-3">
                <div class="flex items-center">
                  <div
                    class="mr-3 flex h-10 w-10 items-center justify-center rounded-lg bg-gray-300">
                    <i class="fas fa-vest text-gray-500"></i>
                  </div>
                  <div>
                    <h4 class="text-dark font-medium">Denim Jeans</h4>
                    <p class="text-xs text-gray-500">Last worn: 1 day ago</p>
                  </div>
                </div>
                <span class="text-sm font-medium text-purple-500">Washing</span>
              </div>

              <div class="flex items-center justify-between rounded-lg bg-green-50 p-3">
                <div class="flex items-center">
                  <div
                    class="mr-3 flex h-10 w-10 items-center justify-center rounded-lg bg-gray-300">
                    <i class="fas fa-shoe-prints text-gray-500"></i>
                  </div>
                  <div>
                    <h4 class="text-dark font-medium">Running Shoes</h4>
                    <p class="text-xs text-gray-500">Clean - ready to wear</p>
                  </div>
                </div>
                <span class="text-success text-sm font-medium">Clean</span>
              </div>
            </div>
            <button
              class="bg-primary mt-6 w-full rounded-lg py-2 font-medium text-white transition hover:bg-purple-700">Update
              Laundry Status</button>
          </div>
        </div>
        <div class="md:w-1/2">
          <h3 class="text-dark mb-4 text-2xl font-bold">Laundry Features</h3>
          <ul class="space-y-4">
            <li class="flex items-start">
              <i class="fas fa-tags text-primary mr-3 mt-1"></i>
              <div>
                <h4 class="text-dark font-bold">Care Instruction Tracking</h4>
                <p class="text-gray-600">Store washing instructions, fabric care, and special
                  handling requirements for each item.</p>
              </div>
            </li>
            <li class="flex items-start">
              <i class="fas fa-calendar-check text-secondary mr-3 mt-1"></i>
              <div>
                <h4 class="text-dark font-bold">Wear & Wash Tracking</h4>
                <p class="text-gray-600">Automatically track when items were last worn and when they
                  need washing based on usage.</p>
              </div>
            </li>
            <li class="flex items-start">
              <i class="fas fa-bell text-accent mr-3 mt-1"></i>
              <div>
                <h4 class="text-dark font-bold">Laundry Reminders</h4>
                <p class="text-gray-600">Get notifications when items need washing or when you have
                  enough for a full load.</p>
              </div>
            </li>
            <li class="flex items-start">
              <i class="fas fa-list-check text-success mr-3 mt-1"></i>
              <div>
                <h4 class="text-dark font-bold">Laundry Sorting</h4>
                <p class="text-gray-600">Automatically sort items by color, fabric type, and washing
                  requirements.</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  @include('components.cta')
@endsection
