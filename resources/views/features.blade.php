@extends('layouts.guest')
@section('title', 'Features')
@push('styles')
  <style>
    .section-divider {
      height: 2px;
      background: linear-gradient(90deg, transparent, #9F7AEA, #4FD1C5, transparent);
      margin: 4rem 0;
    }
  </style>
@endpush
@section('content')
    <!-- Hero Section -->
  <section class="gradient-bg py-16 text-white md:py-20">
    <div class="container mx-auto px-6 text-center">
      <h1 class="mb-4 text-4xl font-bold md:text-5xl">Revolutionize Your Wardrobe Management</h1>
      <p class="mx-auto mb-8 max-w-3xl text-xl">StyleHub is the ultimate digital wardrobe solution
        that helps you organize, declutter, and discover your perfect style.</p>
      <div class="flex flex-col justify-center space-y-4 sm:flex-row sm:space-x-4 sm:space-y-0">
        <button
          class="text-primary rounded-lg bg-white px-6 py-3 font-bold transition hover:bg-gray-100">Get
          Started</button>
        <button
          class="hover:text-primary rounded-lg border-2 border-white bg-transparent px-6 py-3 font-bold text-white transition hover:bg-white">Watch
          Demo</button>
      </div>
    </div>
  </section>

  <div class="section-divider"></div>

  <!-- Detailed Features Section -->
  <section class="bg-light py-16">
    <div class="container mx-auto px-6">
      <h2 class="text-dark mb-4 text-center text-3xl font-bold">Comprehensive Features</h2>
      <p class="mx-auto mb-12 max-w-2xl text-center text-gray-600">Discover how StyleHub can
        transform your relationship with your wardrobe</p>

      <!-- Feature 1 - Wardrobe Management -->
      <div class="mb-20 flex flex-col items-center lg:flex-row">
        <div class="mb-8 lg:mb-0 lg:w-1/2 lg:pr-12">
          <div class="rounded-2xl bg-white p-8 shadow-lg">
            <div class="bg-primary mb-6 flex h-16 w-16 items-center justify-center rounded-lg">
              <i class="fas fa-archive text-2xl text-white"></i>
            </div>
            <h3 class="text-dark mb-4 text-2xl font-bold">Digital Wardrobe Management</h3>
            <p class="mb-4 text-gray-600">
              Create a complete digital catalog of your clothing items with detailed information,
              photos, and categorization. Never forget what you own again!
            </p>
            <ul class="space-y-3 text-gray-600">
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Upload items with photos and detailed descriptions</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Categorize by type, season, color, and occasion</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Track wear frequency and item condition</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Create custom collections and outfits</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="lg:w-1/2">
          <div class="from-primary to-secondary rounded-2xl bg-gradient-to-br p-1">
            <div class="h-full rounded-2xl bg-white p-6">
              <div class="mb-4 grid grid-cols-2 gap-4">
                <div class="flex h-32 items-center justify-center rounded-lg bg-gray-100">
                  <i class="fas fa-tshirt text-primary text-3xl"></i>
                </div>
                <div class="flex h-32 items-center justify-center rounded-lg bg-gray-100">
                  <i class="fas fa-vest text-secondary text-3xl"></i>
                </div>
                <div class="flex h-32 items-center justify-center rounded-lg bg-gray-100">
                  <i class="fas fa-shoe-prints text-accent text-3xl"></i>
                </div>
                <div class="flex h-32 items-center justify-center rounded-lg bg-gray-100">
                  <i class="fas fa-hat-cowboy text-primary text-3xl"></i>
                </div>
              </div>
              <div class="text-center">
                <h4 class="text-dark mb-2 font-bold">Your Digital Closet</h4>
                <p class="text-sm text-gray-600">All your items organized and easily accessible</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Feature 2 - Smart Decluttering -->
      <div class="mb-20 flex flex-col items-center lg:flex-row-reverse">
        <div class="mb-8 lg:mb-0 lg:w-1/2 lg:pl-12">
          <div class="rounded-2xl bg-white p-8 shadow-lg">
            <div class="bg-accent mb-6 flex h-16 w-16 items-center justify-center rounded-lg">
              <i class="fas fa-trash-alt text-2xl text-white"></i>
            </div>
            <h3 class="text-dark mb-4 text-2xl font-bold">Smart Decluttering System</h3>
            <p class="mb-4 text-gray-600">
              Our AI-powered system helps you identify items you no longer need and suggests
              the best way to declutter your wardrobe responsibly.
            </p>
            <ul class="space-y-3 text-gray-600">
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Usage analytics to identify rarely worn items</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Seasonal recommendations for storage or donation</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Integration with resale platforms and donation centers</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Environmental impact tracking for sustainable choices</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="lg:w-1/2">
          <div class="from-accent to-primary rounded-2xl bg-gradient-to-br p-1">
            <div class="h-full rounded-2xl bg-white p-6">
              <div class="mb-4 space-y-4">
                <div class="flex items-center justify-between rounded-lg bg-red-50 p-3">
                  <div class="flex items-center">
                    <div
                      class="mr-3 flex h-12 w-12 items-center justify-center rounded-lg bg-gray-200">
                      <i class="fas fa-tshirt text-gray-500"></i>
                    </div>
                    <div>
                      <h4 class="text-dark font-medium">Striped T-Shirt</h4>
                      <p class="text-xs text-gray-500">Not worn in 8 months</p>
                    </div>
                  </div>
                  <span class="text-accent font-bold">Discard</span>
                </div>

                <div class="flex items-center justify-between rounded-lg bg-yellow-50 p-3">
                  <div class="flex items-center">
                    <div
                      class="mr-3 flex h-12 w-12 items-center justify-center rounded-lg bg-gray-200">
                      <i class="fas fa-vest text-gray-500"></i>
                    </div>
                    <div>
                      <h4 class="text-dark font-medium">Winter Jacket</h4>
                      <p class="text-xs text-gray-500">Seasonal - store away</p>
                    </div>
                  </div>
                  <span class="font-bold text-yellow-500">Archive</span>
                </div>
              </div>
              <div class="text-center">
                <h4 class="text-dark mb-2 font-bold">Decluttering Assistant</h4>
                <p class="text-sm text-gray-600">Smart recommendations to optimize your wardrobe
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Feature 3 - Shopping Integration -->
      <div class="mb-20 flex flex-col items-center lg:flex-row">
        <div class="mb-8 lg:mb-0 lg:w-1/2 lg:pr-12">
          <div class="rounded-2xl bg-white p-8 shadow-lg">
            <div class="bg-secondary mb-6 flex h-16 w-16 items-center justify-center rounded-lg">
              <i class="fas fa-cart-plus text-2xl text-white"></i>
            </div>
            <h3 class="text-dark mb-4 text-2xl font-bold">Seamless Shopping Integration</h3>
            <p class="mb-4 text-gray-600">
              Import items from your favorite stores directly into your digital wardrobe
              and shop for new pieces without leaving the app.
            </p>
            <ul class="space-y-3 text-gray-600">
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Import items from Amazon, Zara, H&M, and more</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Virtual try-on with your existing wardrobe items</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Price tracking and sale alerts for wishlist items</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Style-based recommendations to fill wardrobe gaps</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="lg:w-1/2">
          <div class="from-secondary to-primary rounded-2xl bg-gradient-to-br p-1">
            <div class="h-full rounded-2xl bg-white p-6">
              <div class="mb-4 flex">
                <div
                  class="mr-4 flex h-40 flex-1 items-center justify-center rounded-lg bg-gray-100">
                  <i class="fas fa-tshirt text-primary text-4xl"></i>
                </div>
                <div class="flex-1">
                  <h4 class="text-dark mb-2 font-bold">Summer Floral Dress</h4>
                  <div class="mb-2 flex items-center justify-between">
                    <span class="text-primary font-bold">$49.99</span>
                    <span class="bg-success rounded px-2 py-1 text-xs text-white">In Stock</span>
                  </div>
                  <p class="mb-4 text-sm text-gray-600">Perfect for summer outings</p>
                  <div class="flex space-x-2">
                    <button class="bg-primary rounded px-3 py-1 text-xs font-medium text-white">Add
                      to Wardrobe</button>
                    <button
                      class="bg-secondary rounded px-3 py-1 text-xs font-medium text-white">Buy
                      Now</button>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h4 class="text-dark mb-2 font-bold">Integrated Shopping</h4>
                <p class="text-sm text-gray-600">Browse and shop from your favorite stores</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Feature 4 - Outfit Planning -->
      <div class="mb-20 flex flex-col items-center lg:flex-row-reverse">
        <div class="mb-8 lg:mb-0 lg:w-1/2 lg:pl-12">
          <div class="rounded-2xl bg-white p-8 shadow-lg">
            <div class="bg-primary mb-6 flex h-16 w-16 items-center justify-center rounded-lg">
              <i class="fas fa-calendar-alt text-2xl text-white"></i>
            </div>
            <h3 class="text-dark mb-4 text-2xl font-bold">Advanced Outfit Planning</h3>
            <p class="mb-4 text-gray-600">
              Plan your outfits for the week, special events, or trips with our intuitive
              outfit planner and style recommendations.
            </p>
            <ul class="space-y-3 text-gray-600">
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Create and save outfit combinations</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Weekly outfit planning calendar</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Weather-appropriate outfit suggestions</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Packing lists for trips and vacations</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="lg:w-1/2">
          <div class="from-primary to-accent rounded-2xl bg-gradient-to-br p-1">
            <div class="h-full rounded-2xl bg-white p-6">
              <div class="mb-4 grid grid-cols-7 gap-1">
                <div class="py-2 text-center text-xs font-medium text-gray-500">Mon</div>
                <div class="py-2 text-center text-xs font-medium text-gray-500">Tue</div>
                <div class="py-2 text-center text-xs font-medium text-gray-500">Wed</div>
                <div class="py-2 text-center text-xs font-medium text-gray-500">Thu</div>
                <div class="py-2 text-center text-xs font-medium text-gray-500">Fri</div>
                <div class="py-2 text-center text-xs font-medium text-gray-500">Sat</div>
                <div class="py-2 text-center text-xs font-medium text-gray-500">Sun</div>

                <div class="bg-primary/10 flex items-center justify-center rounded p-2">
                  <i class="fas fa-tshirt text-primary text-sm"></i>
                </div>
                <div class="bg-secondary/10 flex items-center justify-center rounded p-2">
                  <i class="fas fa-vest text-secondary text-sm"></i>
                </div>
                <div class="bg-accent/10 flex items-center justify-center rounded p-2">
                  <i class="fas fa-shoe-prints text-accent text-sm"></i>
                </div>
                <div class="bg-primary/10 flex items-center justify-center rounded p-2">
                  <i class="fas fa-tshirt text-primary text-sm"></i>
                </div>
                <div class="bg-secondary/10 flex items-center justify-center rounded p-2">
                  <i class="fas fa-vest text-secondary text-sm"></i>
                </div>
                <div class="bg-primary/20 flex items-center justify-center rounded p-2">
                  <i class="fas fa-star text-primary text-sm"></i>
                </div>
                <div class="flex items-center justify-center rounded bg-gray-100 p-2">
                  <i class="fas fa-plus text-sm text-gray-400"></i>
                </div>
              </div>
              <div class="text-center">
                <h4 class="text-dark mb-2 font-bold">Weekly Outfit Planner</h4>
                <p class="text-sm text-gray-600">Plan your outfits for the entire week</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Feature 5 - Laundry Tracking -->
      <div class="mb-10 flex flex-col items-center lg:flex-row">
        <div class="mb-8 lg:mb-0 lg:w-1/2 lg:pr-12">
          <div class="rounded-2xl bg-white p-8 shadow-lg">
            <div class="bg-secondary mb-6 flex h-16 w-16 items-center justify-center rounded-lg">
              <i class="fas fa-soap text-2xl text-white"></i>
            </div>
            <h3 class="text-dark mb-4 text-2xl font-bold">Smart Laundry Tracking</h3>
            <p class="mb-4 text-gray-600">
              Keep track of your laundry status, care instructions, and washing needs
              to ensure your clothes always look their best and last longer.
            </p>
            <ul class="space-y-3 text-gray-600">
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Track laundry status (clean, to wash, washing, etc.)</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Store detailed care instructions for each item</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Automatic wear tracking and washing reminders</span>
              </li>
              <li class="flex items-start">
                <i class="fas fa-check text-success mr-3 mt-1"></i>
                <span>Laundry sorting by color, fabric, and care needs</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="lg:w-1/2">
          <div class="from-secondary to-primary rounded-2xl bg-gradient-to-br p-1">
            <div class="h-full rounded-2xl bg-white p-6">
              <div class="mb-4 space-y-4">
                <div class="flex items-center justify-between rounded-lg bg-blue-50 p-3">
                  <div class="flex items-center">
                    <div
                      class="mr-3 flex h-12 w-12 items-center justify-center rounded-lg bg-gray-200">
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
                      class="mr-3 flex h-12 w-12 items-center justify-center rounded-lg bg-gray-200">
                      <i class="fas fa-vest text-gray-500"></i>
                    </div>
                    <div>
                      <h4 class="text-dark font-medium">Denim Jeans</h4>
                      <p class="text-xs text-gray-500">Machine wash cold</p>
                    </div>
                  </div>
                  <span class="text-sm font-medium text-purple-500">Washing</span>
                </div>

                <div class="flex items-center justify-between rounded-lg bg-green-50 p-3">
                  <div class="flex items-center">
                    <div
                      class="mr-3 flex h-12 w-12 items-center justify-center rounded-lg bg-gray-200">
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
              <div class="text-center">
                <h4 class="text-dark mb-2 font-bold">Laundry Management</h4>
                <p class="text-sm text-gray-600">Track washing status and care instructions</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="section-divider"></div>

  @include('components.cta')
@endsection
