@extends('layouts.dashboard')
@section('page_title', 'Dashboard')
@section('title', 'Dashboard')
@push('styles')
  <style>
    .outfit-card {
      transition: all 0.3s ease;
    }

    .outfit-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .calendar-day {
      transition: all 0.2s ease;
      aspect-ratio: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .calendar-day:hover {
      background-color: #9f7aea;
      color: white;
    }

    .calendar-day.has-outfit {
      background-color: #4fd1c5;
      color: white;
    }

    .item-image {
      transition: all 0.3s ease;
    }

    .item-image:hover {
      transform: scale(1.05);
    }

    /* Improved calendar responsiveness */
    .calendar-grid {
      display: grid;
      grid-template-columns: repeat(7, minmax(0, 1fr));
      gap: 0.25rem;
    }

    .calendar-header {
      font-size: 0.75rem;
      padding: 0.5rem 0.25rem;
    }

    @media (min-width: 640px) {
      .calendar-header {
        font-size: 0.875rem;
        padding: 0.75rem 0.5rem;
      }
    }

    /* Improved responsive grid for outfit items */
    .outfit-grid {
      display: grid;
      grid-template-columns: repeat(1, minmax(0, 1fr));
      gap: 1rem;
    }

    @media (min-width: 640px) {
      .outfit-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1.5rem;
      }
    }
  </style>
@endpush

@section('content')
  <!-- Dashboard Content -->
  <div class="container mx-auto px-4 py-8 sm:px-6">
    <!-- Welcome Section -->
    <div class="mb-8">
      <h1 class="responsive-heading text-dark font-bold">
        Welcome back, {{ucfirst(auth()->user()->name)}}
      </h1>
      <p class="responsive-text text-gray-600">
        Here are your style suggestions for today
      </p>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 lg:gap-8">
      <!-- Main Content - Outfit Suggestions -->
      <div class="lg:col-span-2">
        <!-- Today's Outfit -->
        <div class="responsive-card mb-6 rounded-2xl bg-white shadow-lg lg:mb-8">
          <h2 class="responsive-heading text-dark mb-4 font-bold sm:mb-6">
            Today's Outfit
          </h2>

          <!-- Outfit Display -->
          <div
            class="outfit-card from-primary/10 to-secondary/10 responsive-card mb-4 rounded-2xl bg-gradient-to-br sm:mb-6">
            <div class="outfit-grid mb-4 sm:mb-6">
              <!-- Top Item -->
              <div class="rounded-xl bg-white p-3 text-center sm:p-4">
                <div
                  class="mb-2 flex h-32 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:mb-3 sm:h-40">
                  <img alt="Casual Shirt" class="item-image h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
                <h3 class="text-dark responsive-text font-bold">
                  Casual Shirt
                </h3>
                <p class="text-xs text-gray-600 sm:text-sm">
                  Blue & White Striped
                </p>
                <div class="mt-1 flex justify-center sm:mt-2">
                  <span class="bg-primary/20 text-primary rounded px-2 py-1 text-xs">Top</span>
                </div>
              </div>

              <!-- Bottom Item -->
              <div class="rounded-xl bg-white p-3 text-center sm:p-4">
                <div
                  class="mb-2 flex h-32 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:mb-3 sm:h-40">
                  <img alt="Denim Jeans" class="item-image h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1542272604-787c3835535d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
                <h3 class="text-dark responsive-text font-bold">
                  Denim Jeans
                </h3>
                <p class="text-xs text-gray-600 sm:text-sm">
                  Light Wash
                </p>
                <div class="mt-1 flex justify-center sm:mt-2">
                  <span class="bg-secondary/20 text-secondary rounded px-2 py-1 text-xs">Bottom</span>
                </div>
              </div>

              <!-- Footwear -->
              <div class="rounded-xl bg-white p-3 text-center sm:p-4">
                <div
                  class="mb-2 flex h-32 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:mb-3 sm:h-40">
                  <img alt="Sneakers" class="item-image h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
                <h3 class="text-dark responsive-text font-bold">
                  Sneakers
                </h3>
                <p class="text-xs text-gray-600 sm:text-sm">
                  White & Gray
                </p>
                <div class="mt-1 flex justify-center sm:mt-2">
                  <span class="bg-accent/20 text-accent rounded px-2 py-1 text-xs">Footwear</span>
                </div>
              </div>
            </div>

            <!-- Outfit Details -->
            <div class="rounded-xl bg-white p-3 sm:p-4">
              <div
                class="mb-3 flex flex-col gap-2 sm:mb-4 sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-dark responsive-text font-bold">
                  Casual Day Out
                </h3>
                <div class="flex items-center">
                  <i class="fas fa-cloud-sun text-secondary mr-1 text-sm sm:mr-2"></i>
                  <span class="text-xs text-gray-600 sm:text-sm">Perfect for today's weather</span>
                </div>
              </div>
              <p class="mb-3 text-xs text-gray-600 sm:mb-4 sm:text-sm">
                This combination works well for casual
                outings, brunch dates, or a day at the
                office with a relaxed dress code.
              </p>
              <div class="flex flex-col gap-2 sm:flex-row sm:justify-between">
                <div class="flex items-center">
                  <i class="fas fa-heart text-accent mr-1 text-sm sm:mr-2"></i>
                  <span class="text-xs text-gray-600 sm:text-sm">85% match with your style</span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-calendar-alt text-primary mr-1 text-sm sm:mr-2"></i>
                  <span class="text-xs text-gray-600 sm:text-sm">Last worn: 2 weeks ago</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-col gap-3 sm:flex-row">
            <button
              class="bg-success responsive-button flex items-center justify-center rounded-lg font-bold text-white transition hover:bg-green-500">
              <i class="fas fa-check mr-2"></i>Accept Outfit
            </button>
            <button
              class="bg-primary responsive-button flex items-center justify-center rounded-lg font-bold text-white transition hover:bg-purple-700">
              <i class="fas fa-calendar-plus mr-2"></i>Schedule
            </button>
            <button
              class="bg-secondary responsive-button flex items-center justify-center rounded-lg font-bold text-white transition hover:bg-teal-500">
              <i class="fas fa-bookmark mr-2"></i>Save
            </button>
          </div>
        </div>

        <!-- Yesterday's Outfit -->
        <div class="responsive-card mb-6 rounded-2xl bg-white shadow-lg lg:mb-8">
          <h2 class="responsive-heading text-dark mb-4 font-bold sm:mb-6">
            Yesterday's Outfit
          </h2>

          <!-- Outfit Display -->
          <div
            class="outfit-card responsive-card mb-4 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 sm:mb-6">
            <div class="outfit-grid mb-4 sm:mb-6">
              <!-- Top Item -->
              <div class="rounded-xl bg-white p-3 text-center sm:p-4">
                <div
                  class="mb-2 flex h-32 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:mb-3 sm:h-40">
                  <img alt="T-Shirt" class="item-image h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1596755094514-f87e34085b2c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
                <h3 class="text-dark responsive-text font-bold">
                  Graphic T-Shirt
                </h3>
                <p class="text-xs text-gray-600 sm:text-sm">
                  Black with Print
                </p>
                <div class="mt-1 flex justify-center sm:mt-2">
                  <span class="bg-primary/20 text-primary rounded px-2 py-1 text-xs">Top</span>
                </div>
              </div>

              <!-- Bottom Item -->
              <div class="rounded-xl bg-white p-3 text-center sm:p-4">
                <div
                  class="mb-2 flex h-32 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:mb-3 sm:h-40">
                  <img alt="Jeans" class="item-image h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
                <h3 class="text-dark responsive-text font-bold">
                  Slim Jeans
                </h3>
                <p class="text-xs text-gray-600 sm:text-sm">
                  Dark Wash
                </p>
                <div class="mt-1 flex justify-center sm:mt-2">
                  <span class="bg-secondary/20 text-secondary rounded px-2 py-1 text-xs">Bottom</span>
                </div>
              </div>

              <!-- Footwear -->
              <div class="rounded-xl bg-white p-3 text-center sm:p-4">
                <div
                  class="mb-2 flex h-32 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:mb-3 sm:h-40">
                  <img alt="Sneakers" class="item-image h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
                <h3 class="text-dark responsive-text font-bold">
                  Running Shoes
                </h3>
                <p class="text-xs text-gray-600 sm:text-sm">
                  Black & Red
                </p>
                <div class="mt-1 flex justify-center sm:mt-2">
                  <span class="bg-accent/20 text-accent rounded px-2 py-1 text-xs">Footwear</span>
                </div>
              </div>
            </div>

            <!-- Outfit Details -->
            <div class="rounded-xl bg-white p-3 sm:p-4">
              <div
                class="mb-3 flex flex-col gap-2 sm:mb-4 sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-dark responsive-text font-bold">
                  Casual Comfort
                </h3>
                <div class="flex items-center">
                  <i class="fas fa-sun mr-1 text-sm text-yellow-500 sm:mr-2"></i>
                  <span class="text-xs text-gray-600 sm:text-sm">Perfect for sunny day</span>
                </div>
              </div>
              <p class="mb-3 text-xs text-gray-600 sm:mb-4 sm:text-sm">
                Comfortable outfit perfect for running
                errands or casual hangouts with friends.
              </p>
              <div class="flex flex-col gap-2 sm:flex-row sm:justify-between">
                <div class="flex items-center">
                  <i class="fas fa-heart text-accent mr-1 text-sm sm:mr-2"></i>
                  <span class="text-xs text-gray-600 sm:text-sm">92% match with your style</span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-calendar-alt text-primary mr-1 text-sm sm:mr-2"></i>
                  <span class="text-xs text-gray-600 sm:text-sm">Worn yesterday</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Recommendations to Buy -->
        <div class="responsive-card mb-6 rounded-2xl bg-white shadow-lg lg:mb-8">
          <h2 class="responsive-heading text-dark mb-4 font-bold sm:mb-6">
            Recommendations to Buy
          </h2>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6">
            <!-- Recommendation 1 -->
            <div class="outfit-card rounded-xl border border-gray-200 bg-white p-3 sm:p-4">
              <div class="mb-3 flex space-x-2 sm:mb-4 sm:space-x-3">
                <div
                  class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:h-16 sm:w-16">
                  <img alt="Dress Pants" class="h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
                <div
                  class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:h-16 sm:w-16">
                  <img alt="Dress Shoes" class="h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1611312449408-fcece27cdbb7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
              </div>
              <h3 class="text-dark responsive-text mb-1 font-bold sm:mb-2">
                Formal Attire
              </h3>
              <p class="mb-3 text-xs text-gray-600 sm:mb-4 sm:text-sm">
                Complete your professional wardrobe
              </p>
              <div class="flex items-center justify-between">
                <span class="bg-primary/20 text-primary rounded px-2 py-1 text-xs">$129.99</span>
                <div class="flex space-x-2">
                  <button class="text-primary text-sm hover:text-purple-700">
                    <i class="fas fa-shopping-cart"></i>
                  </button>
                  <button class="text-secondary text-sm hover:text-teal-600">
                    <i class="fas fa-bookmark"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Recommendation 2 -->
            <div class="outfit-card rounded-xl border border-gray-200 bg-white p-3 sm:p-4">
              <div class="mb-3 flex space-x-2 sm:mb-4 sm:space-x-3">
                <div
                  class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:h-16 sm:w-16">
                  <img alt="Summer Shirt" class="h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
                <div
                  class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:h-16 sm:w-16">
                  <img alt="Shorts" class="h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1576566588028-4147f3842f27?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
              </div>
              <h3 class="text-dark responsive-text mb-1 font-bold sm:mb-2">
                Summer Collection
              </h3>
              <p class="mb-3 text-xs text-gray-600 sm:mb-4 sm:text-sm">
                Lightweight options for warm weather
              </p>
              <div class="flex items-center justify-between">
                <span class="bg-primary/20 text-primary rounded px-2 py-1 text-xs">$89.99</span>
                <div class="flex space-x-2">
                  <button class="text-primary text-sm hover:text-purple-700">
                    <i class="fas fa-shopping-cart"></i>
                  </button>
                  <button class="text-secondary text-sm hover:text-teal-600">
                    <i class="fas fa-bookmark"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Combinations to Tag/Save -->
        <div class="responsive-card mb-6 rounded-2xl bg-white shadow-lg lg:mb-8">
          <h2 class="responsive-heading text-dark mb-4 font-bold sm:mb-6">
            Combinations to Tag/Save
          </h2>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6">
            <!-- Combination 1 -->
            <div class="outfit-card rounded-xl border border-gray-200 bg-white p-3 sm:p-4">
              <div class="mb-3 flex space-x-2 sm:mb-4 sm:space-x-3">
                <div
                  class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:h-16 sm:w-16">
                  <img alt="Sweater" class="h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1586790170083-2f9ceadc732d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
                <div
                  class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:h-16 sm:w-16">
                  <img alt="Skirt" class="h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1556821840-3a63f95609a7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
              </div>
              <h3 class="text-dark responsive-text mb-1 font-bold sm:mb-2">
                Autumn Casual
              </h3>
              <p class="mb-3 text-xs text-gray-600 sm:mb-4 sm:text-sm">
                Perfect for fall weather
              </p>
              <div class="flex items-center justify-between">
                <span class="bg-success/20 text-success rounded px-2 py-1 text-xs">Ready to
                  wear</span>
                <div class="flex space-x-2">
                  <button class="text-primary text-sm hover:text-purple-700">
                    <i class="fas fa-tag"></i>
                  </button>
                  <button class="text-secondary text-sm hover:text-teal-600">
                    <i class="fas fa-bookmark"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Combination 2 -->
            <div class="outfit-card rounded-xl border border-gray-200 bg-white p-3 sm:p-4">
              <div class="mb-3 flex space-x-2 sm:mb-4 sm:space-x-3">
                <div
                  class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:h-16 sm:w-16">
                  <img alt="Blazer" class="h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
                <div
                  class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:h-16 sm:w-16">
                  <img alt="Dress Pants" class="h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1595777457583-95e059d581b8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
              </div>
              <h3 class="text-dark responsive-text mb-1 font-bold sm:mb-2">
                Business Meeting
              </h3>
              <p class="mb-3 text-xs text-gray-600 sm:mb-4 sm:text-sm">
                Professional and polished
              </p>
              <div class="flex items-center justify-between">
                <span class="bg-success/20 text-success rounded px-2 py-1 text-xs">Ready to
                  wear</span>
                <div class="flex space-x-2">
                  <button class="text-primary text-sm hover:text-purple-700">
                    <i class="fas fa-tag"></i>
                  </button>
                  <button class="text-secondary text-sm hover:text-teal-600">
                    <i class="fas fa-bookmark"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Add this section after the "Combinations to Tag/Save" section and before the sidebar content -->
        <!-- AI Outfit Suggestions Section -->
        <div class="responsive-card mb-6 rounded-2xl bg-white shadow-lg lg:mb-8">
          <div class="mb-4 flex flex-col sm:mb-6 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="responsive-heading text-dark font-bold">
              AI Style Assistant
            </h2>
            <div class="mt-2 flex items-center sm:mt-0">
              <span class="mr-2 text-xs text-gray-500">Powered by StyleAI</span>
              <i class="fas fa-robot text-primary"></i>
            </div>
          </div>

          <!-- AI Recommendation Display -->
          <div
            class="outfit-card responsive-card mb-4 rounded-2xl bg-gradient-to-br from-purple-50 to-indigo-50 sm:mb-6">
            <div class="mb-4 flex items-center justify-between">
              <h3 class="text-dark responsive-text font-bold">
                AI Recommended Outfit
              </h3>
              <div class="flex items-center rounded-full bg-white px-3 py-1 shadow-sm">
                <i class="fas fa-star mr-1 text-yellow-500"></i>
                <span class="text-xs font-medium">92% Match</span>
              </div>
            </div>

            <!-- AI Outfit Display -->
            <div class="outfit-grid mb-4 sm:mb-6" id="aiOutfitDisplay">
              <!-- Top Item -->
              <div class="rounded-xl bg-white p-3 text-center sm:p-4">
                <div
                  class="mb-2 flex h-32 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:mb-3 sm:h-40">
                  <img alt="AI Recommended Top" class="item-image h-full w-full object-cover"
                    id="aiTopImage"
                    src="https://images.unsplash.com/photo-1596755094514-f87e34085b2c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
                <h3 class="text-dark responsive-text font-bold" id="aiTopTitle">
                  Casual T-Shirt
                </h3>
                <p class="text-xs text-gray-600 sm:text-sm" id="aiTopDescription">
                  Black with Minimalist Print
                </p>
                <div class="mt-1 flex justify-center sm:mt-2">
                  <span class="bg-primary/20 text-primary rounded px-2 py-1 text-xs">Top</span>
                </div>
              </div>

              <!-- Bottom Item -->
              <div class="rounded-xl bg-white p-3 text-center sm:p-4">
                <div
                  class="mb-2 flex h-32 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:mb-3 sm:h-40">
                  <img alt="AI Recommended Bottom" class="item-image h-full w-full object-cover"
                    id="aiBottomImage"
                    src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
                <h3 class="text-dark responsive-text font-bold" id="aiBottomTitle">
                  Slim Fit Jeans
                </h3>
                <p class="text-xs text-gray-600 sm:text-sm" id="aiBottomDescription">
                  Dark Wash
                </p>
                <div class="mt-1 flex justify-center sm:mt-2">
                  <span
                    class="bg-secondary/20 text-secondary rounded px-2 py-1 text-xs">Bottom</span>
                </div>
              </div>

              <!-- Footwear -->
              <div class="rounded-xl bg-white p-3 text-center sm:p-4">
                <div
                  class="mb-2 flex h-32 items-center justify-center overflow-hidden rounded-lg bg-gray-100 sm:mb-3 sm:h-40">
                  <img alt="AI Recommended Footwear" class="item-image h-full w-full object-cover"
                    id="aiFootwearImage"
                    src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" />
                </div>
                <h3 class="text-dark responsive-text font-bold" id="aiFootwearTitle">
                  Running Shoes
                </h3>
                <p class="text-xs text-gray-600 sm:text-sm" id="aiFootwearDescription">
                  Black & Red
                </p>
                <div class="mt-1 flex justify-center sm:mt-2">
                  <span class="bg-accent/20 text-accent rounded px-2 py-1 text-xs">Footwear</span>
                </div>
              </div>
            </div>

            <!-- AI Outfit Details -->
            <div class="rounded-xl bg-white p-3 sm:p-4">
              <div
                class="mb-3 flex flex-col gap-2 sm:mb-4 sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-dark responsive-text font-bold" id="aiOutfitName">
                  Urban Street Style
                </h3>
                <div class="flex items-center">
                  <i class="fas fa-cloud mr-1 text-sm text-gray-400 sm:mr-2"></i>
                  <span class="text-xs text-gray-600 sm:text-sm" id="aiWeatherRecommendation">Good
                    for mild weather</span>
                </div>
              </div>
              <p class="mb-3 text-xs text-gray-600 sm:mb-4 sm:text-sm" id="aiOutfitDescription">
                This AI-generated outfit combines comfort with street style aesthetics. Perfect for
                casual outings, running errands, or meeting friends.
              </p>
              <div class="flex flex-col gap-2 sm:flex-row sm:justify-between">
                <div class="flex items-center">
                  <i class="fas fa-heart text-accent mr-1 text-sm sm:mr-2"></i>
                  <span class="text-xs text-gray-600 sm:text-sm" id="aiStyleMatch">92% match with
                    your style</span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-clock text-primary mr-1 text-sm sm:mr-2"></i>
                  <span class="text-xs text-gray-600 sm:text-sm">Generated just now</span>
                </div>
              </div>
            </div>
          </div>

          <!-- AI Controls -->
          <div class="flex flex-col gap-3 sm:flex-row">
            <button
              class="bg-primary responsive-button flex items-center justify-center rounded-lg font-bold text-white transition hover:bg-purple-700"
              id="generateAiOutfit">
              <i class="fas fa-robot mr-2"></i>Generate New Outfit
            </button>
            <button
              class="bg-secondary responsive-button flex items-center justify-center rounded-lg font-bold text-white transition hover:bg-teal-500"
              id="randomizeAiOutfit">
              <i class="fas fa-random mr-2"></i>Randomize
            </button>
            <button
              class="bg-success responsive-button flex items-center justify-center rounded-lg font-bold text-white transition hover:bg-green-500"
              id="saveAiOutfit">
              <i class="fas fa-bookmark mr-2"></i>Save Outfit
            </button>
          </div>

          <!-- AI Feedback Section -->
          <div class="mt-4 border-t border-gray-200 pt-4 sm:mt-6">
            <h4 class="text-dark mb-2 font-bold">Help AI Improve</h4>
            <p class="mb-3 text-xs text-gray-600 sm:text-sm">
              Rate this outfit to help our AI learn your preferences better.
            </p>
            <div class="flex items-center space-x-2">
              <button class="text-gray-400 transition hover:text-yellow-500" id="rate1">
                <i class="far fa-star text-lg"></i>
              </button>
              <button class="text-gray-400 transition hover:text-yellow-500" id="rate2">
                <i class="far fa-star text-lg"></i>
              </button>
              <button class="text-gray-400 transition hover:text-yellow-500" id="rate3">
                <i class="far fa-star text-lg"></i>
              </button>
              <button class="text-gray-400 transition hover:text-yellow-500" id="rate4">
                <i class="far fa-star text-lg"></i>
              </button>
              <button class="text-gray-400 transition hover:text-yellow-500" id="rate5">
                <i class="far fa-star text-lg"></i>
              </button>
              <span class="ml-2 text-xs text-gray-500" id="ratingText">Not rated</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar Content -->
      <div class="space-y-6 lg:space-y-8">
        <!-- Calendar Widget -->
        <div class="responsive-card rounded-2xl bg-white shadow-lg">
          <h2 class="text-dark mb-4 text-xl font-bold sm:mb-6">
            Style Calendar
          </h2>
          <div class="calendar rounded-xl bg-gray-50 p-3 sm:p-4">
            <div class="mb-3 flex items-center justify-between sm:mb-4">
              <button class="hover:text-primary text-gray-500">
                <i class="fas fa-chevron-left"></i>
              </button>
              <h3 class="text-dark responsive-text font-bold">
                October 2023
              </h3>
              <button class="hover:text-primary text-gray-500">
                <i class="fas fa-chevron-right"></i>
              </button>
            </div>
            <div class="calendar-grid text-center">
              <div class="calendar-header font-medium text-gray-500">S</div>
              <div class="calendar-header font-medium text-gray-500">M</div>
              <div class="calendar-header font-medium text-gray-500">T</div>
              <div class="calendar-header font-medium text-gray-500">W</div>
              <div class="calendar-header font-medium text-gray-500">T</div>
              <div class="calendar-header font-medium text-gray-500">F</div>
              <div class="calendar-header font-medium text-gray-500">S</div>

              <!-- Calendar days -->
              <div class="calendar-day rounded text-xs">1</div>
              <div class="calendar-day rounded text-xs">2</div>
              <div class="calendar-day rounded text-xs">3</div>
              <div class="calendar-day rounded text-xs">4</div>
              <div class="calendar-day rounded text-xs">5</div>
              <div class="calendar-day rounded text-xs">6</div>
              <div class="calendar-day rounded text-xs">7</div>
              <div class="calendar-day rounded text-xs">8</div>
              <div class="calendar-day rounded text-xs">9</div>
              <div class="calendar-day rounded text-xs">10</div>
              <div class="calendar-day rounded text-xs">11</div>
              <div class="calendar-day rounded text-xs">12</div>
              <div class="calendar-day has-outfit rounded text-xs font-bold">13</div>
              <div class="calendar-day rounded text-xs">14</div>
              <div class="calendar-day rounded text-xs">15</div>
              <div class="calendar-day rounded text-xs">16</div>
              <div class="calendar-day rounded text-xs">17</div>
              <div class="calendar-day has-outfit rounded text-xs font-bold">18</div>
              <div class="calendar-day rounded text-xs">19</div>
              <div class="calendar-day rounded text-xs">20</div>
              <div class="calendar-day rounded text-xs">21</div>
              <div class="calendar-day rounded text-xs">22</div>
              <div class="calendar-day rounded text-xs">23</div>
              <div class="calendar-day has-outfit rounded text-xs font-bold">24</div>
              <div class="calendar-day rounded text-xs">25</div>
              <div class="calendar-day rounded text-xs">26</div>
              <div class="calendar-day rounded text-xs">27</div>
              <div class="calendar-day rounded text-xs">28</div>
              <div class="calendar-day rounded text-xs">29</div>
              <div class="calendar-day rounded text-xs">30</div>
              <div class="calendar-day rounded text-xs">31</div>
            </div>
          </div>
          <div class="mt-3 sm:mt-4">
            <div class="mb-2 flex items-center">
              <div class="bg-secondary mr-2 h-3 w-3 rounded-full"></div>
              <span class="text-xs text-gray-600">Outfit planned</span>
            </div>
            <button
              class="bg-primary responsive-text w-full rounded-lg px-4 py-2 font-bold text-white transition hover:bg-purple-700">
              <i class="fas fa-calendar-plus mr-2"></i>Plan New Outfit
            </button>
          </div>
        </div>

        <!-- Quick Stats -->
        <div class="responsive-card rounded-2xl bg-white shadow-lg">
          <h2 class="text-dark mb-4 text-xl font-bold sm:mb-6">
            Wardrobe Stats
          </h2>
          <div class="space-y-3 sm:space-y-4">
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <div
                  class="bg-primary/20 mr-2 flex h-8 w-8 items-center justify-center rounded-lg sm:mr-3">
                  <i class="fas fa-tshirt text-primary text-xs"></i>
                </div>
                <span class="text-sm text-gray-600">Total Items</span>
              </div>
              <span class="text-dark font-bold">142</span>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <div
                  class="bg-secondary/20 mr-2 flex h-8 w-8 items-center justify-center rounded-lg sm:mr-3">
                  <i class="fas fa-heart text-secondary text-xs"></i>
                </div>
                <span class="text-sm text-gray-600">Favorite Outfits</span>
              </div>
              <span class="text-dark font-bold">24</span>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <div
                  class="bg-accent/20 mr-2 flex h-8 w-8 items-center justify-center rounded-lg sm:mr-3">
                  <i class="fas fa-calendar text-accent text-xs"></i>
                </div>
                <span class="text-sm text-gray-600">Outfits This Month</span>
              </div>
              <span class="text-dark font-bold">18</span>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <div
                  class="bg-success/20 mr-2 flex h-8 w-8 items-center justify-center rounded-lg sm:mr-3">
                  <i class="fas fa-sync text-success text-xs"></i>
                </div>
                <span class="text-sm text-gray-600">Items Not Worn</span>
              </div>
              <span class="text-dark font-bold">7</span>
            </div>
          </div>
        </div>

        <!-- Recent Activity -->
        <div class="responsive-card rounded-2xl bg-white shadow-lg">
          <h2 class="text-dark mb-4 text-xl font-bold sm:mb-6">
            Recent Activity
          </h2>
          <div class="space-y-3 sm:space-y-4">
            <div class="flex items-start">
              <div
                class="bg-primary/20 mr-2 mt-1 flex h-8 w-8 items-center justify-center rounded-full sm:mr-3">
                <i class="fas fa-plus text-primary text-xs"></i>
              </div>
              <div>
                <p class="text-dark text-sm font-medium">
                  Added new item
                </p>
                <p class="text-xs text-gray-500">
                  Blue Denim Jacket
                </p>
                <p class="text-xs text-gray-400">
                  2 hours ago
                </p>
              </div>
            </div>
            <div class="flex items-start">
              <div
                class="bg-secondary/20 mr-2 mt-1 flex h-8 w-8 items-center justify-center rounded-full sm:mr-3">
                <i class="fas fa-bookmark text-secondary text-xs"></i>
              </div>
              <div>
                <p class="text-dark text-sm font-medium">
                  Saved outfit
                </p>
                <p class="text-xs text-gray-500">
                  "Weekend Casual"
                </p>
                <p class="text-xs text-gray-400">
                  Yesterday
                </p>
              </div>
            </div>
            <div class="flex items-start">
              <div
                class="bg-accent/20 mr-2 mt-1 flex h-8 w-8 items-center justify-center rounded-full sm:mr-3">
                <i class="fas fa-shopping-cart text-accent text-xs"></i>
              </div>
              <div>
                <p class="text-dark text-sm font-medium">
                  Purchased item
                </p>
                <p class="text-xs text-gray-500">
                  White Sneakers
                </p>
                <p class="text-xs text-gray-400">
                  3 days ago
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    // AI Outfit Suggestion Data
    const aiOutfitData = {
      tops: [{
          title: "Casual T-Shirt",
          description: "Black with Minimalist Print",
          image: "https://images.unsplash.com/photo-1596755094514-f87e34085b2c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80",
          type: "casual"
        },
        {
          title: "Button-Down Shirt",
          description: "Light Blue Oxford",
          image: "https://images.unsplash.com/photo-1621072156002-e2fccdc0b176?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80",
          type: "smart-casual"
        },
        {
          title: "Polo Shirt",
          description: "Navy Blue with Logo",
          image: "https://images.unsplash.com/photo-1586790170083-2f9ceadc732d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80",
          type: "casual"
        },
        {
          title: "Sweater",
          description: "Cream Cable Knit",
          image: "https://images.unsplash.com/photo-1434389677669-e08b4cac3105?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80",
          type: "winter"
        }
      ],
      bottoms: [{
          title: "Slim Fit Jeans",
          description: "Dark Wash",
          image: "https://images.unsplash.com/photo-1541099649105-f69ad21f3246?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80",
          type: "casual"
        },
        {
          title: "Chino Pants",
          description: "Beige Twill",
          image: "https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80",
          type: "smart-casual"
        },
        {
          title: "Cargo Pants",
          description: "Olive Green",
          image: "https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80",
          type: "casual"
        },
        {
          title: "Dress Pants",
          description: "Black Wool Blend",
          image: "https://images.unsplash.com/photo-1595777457583-95e059d581b8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80",
          type: "formal"
        }
      ],
      footwear: [{
          title: "Running Shoes",
          description: "Black & Red",
          image: "https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80",
          type: "casual"
        },
        {
          title: "Sneakers",
          description: "White Leather",
          image: "https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80",
          type: "casual"
        },
        {
          title: "Dress Shoes",
          description: "Brown Leather",
          image: "https://images.unsplash.com/photo-1611312449408-fcece27cdbb7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80",
          type: "formal"
        },
        {
          title: "Boots",
          description: "Tan Suede",
          image: "https://images.unsplash.com/photo-1605812860427-4024433a70fd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80",
          type: "winter"
        }
      ],
      outfits: [{
          name: "Urban Street Style",
          description: "This AI-generated outfit combines comfort with street style aesthetics. Perfect for casual outings, running errands, or meeting friends.",
          weather: "Good for mild weather",
          match: "92% match with your style"
        },
        {
          name: "Smart Casual Look",
          description: "A polished yet comfortable outfit suitable for casual Fridays at work or dinner dates.",
          weather: "Ideal for indoor settings",
          match: "88% match with your style"
        },
        {
          name: "Weekend Comfort",
          description: "Relaxed and comfortable outfit perfect for lazy weekends or cozy days at home.",
          weather: "Comfortable in any weather",
          match: "95% match with your style"
        },
        {
          name: "Business Casual",
          description: "Professional yet approachable outfit suitable for meetings or office environments.",
          weather: "Perfect for climate-controlled spaces",
          match: "85% match with your style"
        }
      ]
    };

    // AI Outfit Suggestion Functionality
    function generateAiOutfit() {
      // Get random items for each category
      const randomTop = aiOutfitData.tops[Math.floor(Math.random() * aiOutfitData.tops.length)];
      const randomBottom = aiOutfitData.bottoms[Math.floor(Math.random() * aiOutfitData.bottoms
        .length)];
      const randomFootwear = aiOutfitData.footwear[Math.floor(Math.random() * aiOutfitData.footwear
        .length)];
      const randomOutfit = aiOutfitData.outfits[Math.floor(Math.random() * aiOutfitData.outfits
        .length)];

      // Calculate a random match percentage between 80-98%
      const matchPercentage = Math.floor(Math.random() * 19) + 80;

      // Update the UI with the new outfit
      document.getElementById('aiTopImage').src = randomTop.image;
      document.getElementById('aiTopTitle').textContent = randomTop.title;
      document.getElementById('aiTopDescription').textContent = randomTop.description;

      document.getElementById('aiBottomImage').src = randomBottom.image;
      document.getElementById('aiBottomTitle').textContent = randomBottom.title;
      document.getElementById('aiBottomDescription').textContent = randomBottom.description;

      document.getElementById('aiFootwearImage').src = randomFootwear.image;
      document.getElementById('aiFootwearTitle').textContent = randomFootwear.title;
      document.getElementById('aiFootwearDescription').textContent = randomFootwear.description;

      document.getElementById('aiOutfitName').textContent = randomOutfit.name;
      document.getElementById('aiOutfitDescription').textContent = randomOutfit.description;
      document.getElementById('aiWeatherRecommendation').textContent = randomOutfit.weather;
      document.getElementById('aiStyleMatch').textContent =
        `${matchPercentage}% match with your style`;

      // Update the match badge
      document.querySelector('.flex.items-center.bg-white.rounded-full.px-3.py-1.shadow-sm span')
        .textContent = `${matchPercentage}% Match`;

      // Reset rating
      resetRating();

      // Add a subtle animation to indicate change
      const outfitDisplay = document.getElementById('aiOutfitDisplay');
      outfitDisplay.style.opacity = '0.7';
      setTimeout(() => {
        outfitDisplay.style.opacity = '1';
      }, 300);
    }

    function randomizeAiOutfit() {
      // Show loading state
      const buttons = document.querySelectorAll(
        '#generateAiOutfit, #randomizeAiOutfit, #saveAiOutfit');
      buttons.forEach(button => {
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
      });

      // Simulate AI processing time
      setTimeout(() => {
        generateAiOutfit();

        // Restore buttons
        buttons.forEach(button => {
          button.disabled = false;
          if (button.id === 'generateAiOutfit') {
            button.innerHTML = '<i class="fas fa-robot mr-2"></i>Generate New Outfit';
          } else if (button.id === 'randomizeAiOutfit') {
            button.innerHTML = '<i class="fas fa-random mr-2"></i>Randomize';
          } else if (button.id === 'saveAiOutfit') {
            button.innerHTML = '<i class="fas fa-bookmark mr-2"></i>Save Outfit';
          }
        });

        // Show success message
        showNotification('New AI outfit generated successfully!', 'success');
      }, 1500);
    }

    function saveAiOutfit() {
      // Show saving state
      const saveButton = document.getElementById('saveAiOutfit');
      const originalText = saveButton.innerHTML;
      saveButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';

      // Simulate save process
      setTimeout(() => {
        saveButton.innerHTML = '<i class="fas fa-check mr-2"></i>Saved!';

        // Show success message
        showNotification('Outfit saved to your favorites!', 'success');

        // Reset button after delay
        setTimeout(() => {
          saveButton.innerHTML = originalText;
        }, 2000);
      }, 1000);
    }

    function setupRating() {
      const stars = document.querySelectorAll('#rate1, #rate2, #rate3, #rate4, #rate5');
      const ratingText = document.getElementById('ratingText');

      stars.forEach((star, index) => {
        star.addEventListener('click', () => {
          // Update star icons
          stars.forEach((s, i) => {
            if (i <= index) {
              s.innerHTML = '<i class="fas fa-star text-lg text-yellow-500"></i>';
            } else {
              s.innerHTML = '<i class="far fa-star text-lg"></i>';
            }
          });

          // Update rating text
          const ratings = ['Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];
          ratingText.textContent = ratings[index];

          // Show thank you message
          showNotification('Thanks for your feedback! This helps AI improve.', 'info');
        });
      });
    }

    function resetRating() {
      const stars = document.querySelectorAll('#rate1, #rate2, #rate3, #rate4, #rate5');
      const ratingText = document.getElementById('ratingText');

      stars.forEach(star => {
        star.innerHTML = '<i class="far fa-star text-lg"></i>';
      });

      ratingText.textContent = 'Not rated';
    }

    function showNotification(message, type) {
      // Create notification element
      const notification = document.createElement('div');
      notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
        type === 'success' ? 'bg-success text-white' : 'bg-primary text-white'
    }`;
      notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;

      // Add to page
      document.body.appendChild(notification);

      // Animate in
      setTimeout(() => {
        notification.classList.remove('translate-x-full');
      }, 10);

      // Remove after delay
      setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
          document.body.removeChild(notification);
        }, 300);
      }, 3000);
    }

    // Initialize AI Outfit Suggestion functionality when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
      // Set up event listeners for AI controls
      document.getElementById('generateAiOutfit').addEventListener('click', generateAiOutfit);
      document.getElementById('randomizeAiOutfit').addEventListener('click', randomizeAiOutfit);
      document.getElementById('saveAiOutfit').addEventListener('click', saveAiOutfit);

      // Set up rating system
      setupRating();

      // Generate initial AI outfit
      generateAiOutfit();
    });
  </script>
@endpush
