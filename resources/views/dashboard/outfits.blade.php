@extends('layouts.dashboard')

@section('title', 'My Outfits')
@section('page_title', 'My Outfits')

@php
  // Static outfit data with planned dates
  $outfits = [
      [
          'id' => 1,
          'name' => 'Christmas Party Outfit',
          'description' => 'Perfect for holiday gatherings and family dinners',
          'occasion' => 'Holiday Party',
          'season' => 'Winter',
          'planned_date' => '2025-12-24',
          'last_worn' => '2024-12-24',
          'notes' =>
              'Pairs well with black heels and silver jewelry. Remember to add the red clutch!',
          'image_url' => null,
          'items' => [
              [
                  'id' => 1,
                  'name' => 'Red Velvet Dress',
                  'category' => 'Dress',
                  'color' => '#DC2626'
              ],
              [
                  'id' => 2,
                  'name' => 'Black Leather Belt',
                  'category' => 'Accessories',
                  'color' => '#171717'
              ],
              [
                  'id' => 3,
                  'name' => 'Silver Statement Necklace',
                  'category' => 'Jewelry',
                  'color' => '#94A3B8'
              ],
              ['id' => 4, 'name' => 'Black Heels', 'category' => 'Shoes', 'color' => '#171717'],
              ['id' => 5, 'name' => 'Black Clutch', 'category' => 'Bag', 'color' => '#171717']
          ]
      ],
      [
          'id' => 2,
          'name' => 'Business Meeting',
          'description' => 'Professional and polished look for important meetings',
          'occasion' => 'Business',
          'season' => 'All Seasons',
          'planned_date' => '2025-12-18',
          'last_worn' => '2024-12-10',
          'notes' => 'Keep accessories minimal and elegant. Iron the blazer before wearing.',
          'image_url' => null,
          'items' => [
              ['id' => 6, 'name' => 'Navy Blazer', 'category' => 'Jacket', 'color' => '#1E3A8A'],
              ['id' => 7, 'name' => 'White Button-up', 'category' => 'Top', 'color' => '#FFFFFF'],
              ['id' => 8, 'name' => 'Black Trousers', 'category' => 'Bottom', 'color' => '#171717'],
              ['id' => 9, 'name' => 'Black Loafers', 'category' => 'Shoes', 'color' => '#171717'],
              ['id' => 10, 'name' => 'Leather Briefcase', 'category' => 'Bag', 'color' => '#78350F']
          ]
      ],
      [
          'id' => 3,
          'name' => 'Casual Weekend',
          'description' => 'Comfortable yet stylish for weekend outings',
          'occasion' => 'Casual',
          'season' => 'All Seasons',
          'planned_date' => '2025-12-20',
          'last_worn' => '2024-11-30',
          'notes' => 'Great for coffee dates and shopping. Perfect with the brown leather watch.',
          'image_url' => null,
          'items' => [
              ['id' => 11, 'name' => 'White T-Shirt', 'category' => 'Top', 'color' => '#F0F9FF'],
              [
                  'id' => 12,
                  'name' => 'Blue Denim Jeans',
                  'category' => 'Bottom',
                  'color' => '#1E40AF'
              ],
              ['id' => 13, 'name' => 'White Sneakers', 'category' => 'Shoes', 'color' => '#F0F9FF'],
              [
                  'id' => 14,
                  'name' => 'Brown Leather Watch',
                  'category' => 'Accessories',
                  'color' => '#92400E'
              ]
          ]
      ],
      [
          'id' => 4,
          'name' => 'Date Night',
          'description' => 'Romantic evening look for special occasions',
          'occasion' => 'Evening',
          'season' => 'Fall',
          'planned_date' => '2025-12-31',
          'last_worn' => '2024-12-01',
          'notes' => 'Perfect for dinner dates. Don\'t forget the red lipstick!',
          'image_url' => null,
          'items' => [
              [
                  'id' => 15,
                  'name' => 'Little Black Dress',
                  'category' => 'Dress',
                  'color' => '#000000'
              ],
              ['id' => 16, 'name' => 'Red Lipstick', 'category' => 'Makeup', 'color' => '#DC2626'],
              [
                  'id' => 17,
                  'name' => 'Diamond Earrings',
                  'category' => 'Jewelry',
                  'color' => '#E5E7EB'
              ],
              ['id' => 18, 'name' => 'Black Heels', 'category' => 'Shoes', 'color' => '#171717'],
              ['id' => 19, 'name' => 'Clutch', 'category' => 'Bag', 'color' => '#7C3AED']
          ]
      ],
      [
          'id' => 5,
          'name' => 'Gym Session',
          'description' => 'Activewear for workout sessions',
          'occasion' => 'Sports',
          'season' => 'All Seasons',
          'planned_date' => null, // No planned date (outfit sample)
          'last_worn' => '2024-12-12',
          'notes' => 'Comfort is key for workouts. Bring the water bottle.',
          'image_url' => null,
          'items' => [
              ['id' => 20, 'name' => 'Sports Bra', 'category' => 'Top', 'color' => '#EC4899'],
              ['id' => 21, 'name' => 'Leggings', 'category' => 'Bottom', 'color' => '#4F46E5'],
              ['id' => 22, 'name' => 'Running Shoes', 'category' => 'Shoes', 'color' => '#000000'],
              [
                  'id' => 23,
                  'name' => 'Water Bottle',
                  'category' => 'Accessories',
                  'color' => '#0EA5E9'
              ]
          ]
      ],
      [
          'id' => 6,
          'name' => 'Beach Vacation',
          'description' => 'Light and breezy summer outfit',
          'occasion' => 'Vacation',
          'season' => 'Summer',
          'planned_date' => null, // No planned date (outfit sample)
          'last_worn' => '2024-07-15',
          'notes' => 'Don\'t forget sunscreen and sunglasses!',
          'image_url' => null,
          'items' => [
              ['id' => 24, 'name' => 'Flory Sundress', 'category' => 'Dress', 'color' => '#F472B6'],
              [
                  'id' => 25,
                  'name' => 'Straw Hat',
                  'category' => 'Accessories',
                  'color' => '#92400E'
              ],
              ['id' => 26, 'name' => 'Sandals', 'category' => 'Shoes', 'color' => '#D97706'],
              ['id' => 27, 'name' => 'Tote Bag', 'category' => 'Bag', 'color' => '#059669']
          ]
      ],
      [
          'id' => 7,
          'name' => 'Formal Event',
          'description' => 'Elegant attire for formal occasions',
          'occasion' => 'Formal Event',
          'season' => 'All Seasons',
          'planned_date' => '2026-01-15',
          'last_worn' => '2024-11-20',
          'notes' => 'Perfect for weddings and galas. Dry clean after use.',
          'image_url' => null,
          'items' => [
              ['id' => 28, 'name' => 'Evening Gown', 'category' => 'Dress', 'color' => '#7C3AED'],
              [
                  'id' => 29,
                  'name' => 'Pearl Necklace',
                  'category' => 'Jewelry',
                  'color' => '#F0F9FF'
              ],
              ['id' => 30, 'name' => 'Evening Bag', 'category' => 'Bag', 'color' => '#000000'],
              ['id' => 31, 'name' => 'High Heels', 'category' => 'Shoes', 'color' => '#DC2626']
          ]
      ],
      [
          'id' => 8,
          'name' => 'Winter Casual',
          'description' => 'Warm and cozy winter outfit',
          'occasion' => 'Casual',
          'season' => 'Winter',
          'planned_date' => '2025-12-28',
          'last_worn' => '2024-12-20',
          'notes' => 'Great for cold weather. Layer for extra warmth.',
          'image_url' => null,
          'items' => [
              ['id' => 32, 'name' => 'Wool Sweater', 'category' => 'Top', 'color' => '#78350F'],
              [
                  'id' => 33,
                  'name' => 'Corduroy Pants',
                  'category' => 'Bottom',
                  'color' => '#92400E'
              ],
              ['id' => 34, 'name' => 'Winter Boots', 'category' => 'Shoes', 'color' => '#000000'],
              ['id' => 35, 'name' => 'Scarf', 'category' => 'Accessories', 'color' => '#DC2626']
          ]
      ]
  ];

  // Filter outfits based on planned date
  $plannedOutfits = array_filter($outfits, function ($outfit) {
      return !empty($outfit['planned_date']);
  });

  $outfitSamples = array_filter($outfits, function ($outfit) {
      return empty($outfit['planned_date']);
  });
@endphp

@push('styles')
  <style>
    .view-toggle.active {
      background-color: rgba(var(--primary-color-rgb), 0.1);
      color: var(--primary-color);
    }

    #gridViewBtn:hover {
      background-color: rgba(var(--primary-color-rgb), 0.1);
    }

    #listViewBtn:hover {
      background-color: rgba(var(--primary-color-rgb), 0.1);
    }

    .outfit-tab.active {
      color: var(--primary-color);
      border-color: var(--primary-color);
    }

    .outfit-tab-content {
      display: block;
    }

    .outfit-tab-content.hidden {
      display: none;
    }

    .outfit-card {
      transition: all 0.3s ease;
    }

    .outfit-card:hover {
      transform: translateY(-2px);
    }

    #outfitModal,
    #editOutfitModal,
    #scheduleOutfitModal {
      animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
@endpush

@section('content')
  <div class="bg-light min-h-screen p-6">
    <div class="mx-auto max-w-7xl">
      <!-- Header Section -->
      <div class="mb-8 flex flex-col justify-between sm:flex-row sm:items-center">
        <div>
          <h1 class="responsive-heading text-dark font-bold">My Outfits</h1>
          <p class="mt-2 text-gray-600">Manage and organize your outfit combinations</p>
        </div>

        <div class="mt-4 flex items-center space-x-4 sm:mt-0">
          <!-- View Toggle -->
          <div class="flex items-center space-x-1 rounded-lg border border-gray-200 bg-white p-1">
            <button class="view-toggle active rounded-md p-2" data-view="grid" id="gridViewBtn">
              <i class="fas fa-th-large"></i>
            </button>
            <button class="view-toggle rounded-md p-2" data-view="list" id="listViewBtn">
              <i class="fas fa-list"></i>
            </button>
          </div>

          <!-- Plan New Outfit Button -->
          <x-button class="flex items-center justify-center" size='sm' variant='primary'>
            <a href="{{ route('outfits.plan') }}">
              <i class="fas fa-calendar-plus mr-2"></i> Plan Outfit
            </a>
          </x-button>
        </div>
      </div>

      <!-- Stats Overview -->
      <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="rounded-lg bg-white p-4 shadow-sm">
          <div class="flex items-center">
            <div class="bg-primary/10 mr-3 flex h-10 w-10 items-center justify-center rounded-full">
              <i class="fas fa-calendar-check text-primary"></i>
            </div>
            <div>
              <p class="text-sm text-gray-600">Planned Outfits</p>
              <p class="text-dark text-xl font-bold">{{ count($plannedOutfits) }}</p>
            </div>
          </div>
        </div>
        <div class="rounded-lg bg-white p-4 shadow-sm">
          <div class="flex items-center">
            <div class="bg-secondary/10 mr-3 flex h-10 w-10 items-center justify-center rounded-full">
              <i class="fas fa-tshirt text-secondary"></i>
            </div>
            <div>
              <p class="text-sm text-gray-600">Outfit Samples</p>
              <p class="text-dark text-xl font-bold">{{ count($outfitSamples) }}</p>
            </div>
          </div>
        </div>
        <div class="rounded-lg bg-white p-4 shadow-sm">
          <div class="flex items-center">
            <div class="bg-accent/10 mr-3 flex h-10 w-10 items-center justify-center rounded-full">
              <i class="fas fa-star text-accent"></i>
            </div>
            <div>
              <p class="text-sm text-gray-600">Total Items</p>
              <p class="text-dark text-xl font-bold">
                {{ array_sum(array_map(function ($outfit) {return count($outfit['items']);}, $outfits)) }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Tabs for Planned Outfits vs Outfit Samples -->
      <div class="mb-6 border-b border-gray-200">
        <nav class="-mb-px flex space-x-8">
          <x-button
            class="outfit-tab active border-primary text-primary border-b-2 px-1 py-3 text-sm font-medium hover:bg-transparent"
            data-tab="planned" size='none' variant='ghost'>
            <i class="fas fa-calendar-alt mr-2"></i>Planned Outfits
            <span
              class="bg-primary/20 ml-2 rounded-full px-2 py-0.5 text-xs">{{ count($plannedOutfits) }}</span>
          </x-button>
          <x-button
              class="outfit-tab border-primary text-primary border-none hover:border-b-2 px-1 py-3 text-sm font-medium hover:bg-transparent"
              data-tab="samples" size='none' variant='ghost'>
              <i class="fas fa-star mr-2"></i>Outfit Samples
              <span
                class="ml-2 rounded-full bg-gray-200 px-2 py-0.5 text-xs">{{ count($outfitSamples) }}</span>
          </x-button>
        </nav>
      </div>

      <!-- Planned Outfits Grid View (Default) -->
      <div class="outfit-tab-content" id="plannedOutfitsGrid">
        <div class="mb-8">
          <h2 class="text-dark mb-4 text-lg font-semibold">Upcoming Outfits</h2>

          <!-- Grid View -->
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
            id="gridView">
            @foreach ($plannedOutfits as $outfit)
              <div
                class="outfit-card group relative overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-lg">
                <!-- Planned Date Badge -->
                @if ($outfit['planned_date'])
                  <div
                    class="bg-primary/90 absolute left-3 top-3 rounded-full px-3 py-1 text-xs font-medium text-white">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    {{ \Carbon\Carbon::parse($outfit['planned_date'])->format('M d') }}
                  </div>
                @endif

                <!-- View Details Button -->
                <button
                  class="view-outfit-btn absolute right-3 top-3 z-10 rounded-full bg-white/80 p-2 backdrop-blur-sm transition-all hover:bg-white"
                  data-outfit-id="{{ $outfit['id'] }}">
                  <i class="fas fa-eye hover:text-primary text-gray-400"></i>
                </button>

                <!-- Outfit Preview -->
                <div
                  class="relative h-48 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                  <div class="flex h-full items-center justify-center">
                    <div class="grid grid-cols-2 gap-2 p-4">
                      @foreach (array_slice($outfit['items'], 0, 4) as $item)
                        <div class="aspect-square rounded-lg"
                          style="background-color: {{ $item['color'] }}"></div>
                      @endforeach
                    </div>
                  </div>

                  <!-- Occasion Badge -->
                  @if ($outfit['occasion'])
                    <span
                      class="absolute bottom-3 left-3 rounded-full bg-white/90 px-3 py-1 text-xs font-medium text-gray-700">
                      {{ $outfit['occasion'] }}
                    </span>
                  @endif
                </div>

                <!-- Outfit Details -->
                <div class="p-4">
                  <div class="mb-3">
                    <h3 class="text-dark mb-1 font-semibold">{{ $outfit['name'] }}</h3>
                    <p class="text-sm text-gray-600">{{ $outfit['description'] }}</p>
                  </div>

                  <!-- Outfit Items Preview -->
                  <div class="mb-4 flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                      <span class="text-xs text-gray-500">{{ count($outfit['items']) }} items</span>
                      <div class="flex -space-x-2">
                        @foreach (array_slice($outfit['items'], 0, 3) as $item)
                          <div
                            class="flex h-6 w-6 items-center justify-center rounded-full border-2 border-white text-xs font-semibold"
                            style="background-color: {{ $item['color'] }}">
                            {{ strtoupper(substr($item['category'], 0, 1)) }}
                          </div>
                        @endforeach
                        @if (count($outfit['items']) > 3)
                          <div
                            class="flex h-6 w-6 items-center justify-center rounded-full border-2 border-white bg-gray-800 text-xs font-semibold text-white">
                            +{{ count($outfit['items']) - 3 }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <!-- Planned Date -->
                  @if ($outfit['planned_date'])
                    <div class="flex items-center text-xs text-gray-600">
                      <i class="fas fa-calendar-day text-primary mr-2"></i>
                      <span>Planned for
                        {{ \Carbon\Carbon::parse($outfit['planned_date'])->format('F j, Y') }}</span>
                    </div>
                  @endif
                </div>
              </div>
            @endforeach
          </div>

          <!-- List View (Hidden by default) -->
          <div class="hidden" id="listView">
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
              <table class="w-full">
                <thead class="border-b border-gray-200 bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">Outfit
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">
                      Planned Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">
                      Occasion</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">Items
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">
                      Actions</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  @foreach ($plannedOutfits as $outfit)
                    <tr class="hover:bg-gray-50">
                      <td class="px-6 py-4">
                        <div class="flex items-center">
                          <div
                            class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-gray-200 to-gray-300">
                            <div class="grid grid-cols-2 gap-1 p-1">
                              @foreach (array_slice($outfit['items'], 0, 4) as $item)
                                <div class="h-2 w-2 rounded-full"
                                  style="background-color: {{ $item['color'] }}"></div>
                              @endforeach
                            </div>
                          </div>
                          <div class="ml-4">
                            <div class="text-dark font-medium">{{ $outfit['name'] }}</div>
                            <div class="text-sm text-gray-500">{{ $outfit['description'] }}</div>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-4">
                        @if ($outfit['planned_date'])
                          <div class="flex items-center">
                            <i class="fas fa-calendar-alt text-primary mr-2"></i>
                            <div>
                              <div class="font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($outfit['planned_date'])->format('M d, Y') }}
                              </div>
                              <div class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($outfit['planned_date'])->format('l') }}
                              </div>
                            </div>
                          </div>
                        @else
                          <span class="text-sm text-gray-500">Not scheduled</span>
                        @endif
                      </td>
                      <td class="px-6 py-4">
                        @if ($outfit['occasion'])
                          <span
                            class="bg-primary/10 text-primary inline-flex rounded-full px-3 py-1 text-xs font-medium">
                            {{ $outfit['occasion'] }}
                          </span>
                        @else
                          <span class="text-sm text-gray-500">-</span>
                        @endif
                      </td>
                      <td class="px-6 py-4">
                        <div class="flex -space-x-2">
                          @foreach (array_slice($outfit['items'], 0, 4) as $item)
                            <div
                              class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white text-xs font-semibold"
                              style="background-color: {{ $item['color'] }}">
                              {{ strtoupper(substr($item['category'], 0, 1)) }}
                            </div>
                          @endforeach
                          @if (count($outfit['items']) > 4)
                            <div
                              class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-gray-800 text-xs font-semibold text-white">
                              +{{ count($outfit['items']) - 4 }}
                            </div>
                          @endif
                        </div>
                      </td>
                      <td class="px-6 py-4">
                        <div class="flex space-x-2">
                          <button class="view-outfit-btn text-primary hover:text-purple-700"
                            data-outfit-id="{{ $outfit['id'] }}">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button class="hover:text-primary edit-outfit-btn text-gray-400"
                            data-outfit-id="{{ $outfit['id'] }}">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button class="remove-outfit-btn text-gray-400 hover:text-yellow-600"
                            data-outfit-id="{{ $outfit['id'] }}">
                            <i class="fas fa-calendar-minus"></i>
                          </button>
                          <button class="delete-outfit-btn text-gray-400 hover:text-red-500"
                            data-outfit-id="{{ $outfit['id'] }}">
                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Outfit Samples Grid View (Hidden by default) -->
      <div class="outfit-tab-content hidden" id="outfitSamplesGrid">
        <div class="mb-8">
          <h2 class="text-dark mb-4 text-lg font-semibold">Outfit Samples</h2>

          <!-- Grid View -->
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
            id="samplesGridView">
            @foreach ($outfitSamples as $outfit)
              <div
                class="outfit-card group relative overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-lg">
                <!-- Sample Badge -->
                <div
                  class="bg-secondary/90 absolute left-3 top-3 rounded-full px-3 py-1 text-xs font-medium text-white">
                  <i class="fas fa-star mr-1"></i>Sample
                </div>

                <!-- View Details Button -->
                <button
                  class="view-outfit-btn absolute right-3 top-3 z-10 rounded-full bg-white/80 p-2 backdrop-blur-sm transition-all hover:bg-white"
                  data-outfit-id="{{ $outfit['id'] }}">
                  <i class="fas fa-eye hover:text-primary text-gray-400"></i>
                </button>

                <!-- Outfit Preview -->
                <div
                  class="relative h-48 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                  <div class="flex h-full items-center justify-center">
                    <div class="grid grid-cols-2 gap-2 p-4">
                      @foreach (array_slice($outfit['items'], 0, 4) as $item)
                        <div class="aspect-square rounded-lg"
                          style="background-color: {{ $item['color'] }}"></div>
                      @endforeach
                    </div>
                  </div>

                  <!-- Occasion Badge -->
                  @if ($outfit['occasion'])
                    <span
                      class="absolute bottom-3 left-3 rounded-full bg-white/90 px-3 py-1 text-xs font-medium text-gray-700">
                      {{ $outfit['occasion'] }}
                    </span>
                  @endif
                </div>

                <!-- Outfit Details -->
                <div class="p-4">
                  <div class="mb-3">
                    <h3 class="text-dark mb-1 font-semibold">{{ $outfit['name'] }}</h3>
                    <p class="text-sm text-gray-600">{{ $outfit['description'] }}</p>
                  </div>

                  <!-- Outfit Items Preview -->
                  <div class="mb-4 flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                      <span class="text-xs text-gray-500">{{ count($outfit['items']) }} items</span>
                      <div class="flex -space-x-2">
                        @foreach (array_slice($outfit['items'], 0, 3) as $item)
                          <div
                            class="flex h-6 w-6 items-center justify-center rounded-full border-2 border-white text-xs font-semibold"
                            style="background-color: {{ $item['color'] }}">
                            {{ strtoupper(substr($item['category'], 0, 1)) }}
                          </div>
                        @endforeach
                        @if (count($outfit['items']) > 3)
                          <div
                            class="flex h-6 w-6 items-center justify-center rounded-full border-2 border-white bg-gray-800 text-xs font-semibold text-white">
                            +{{ count($outfit['items']) - 3 }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <!-- Last Worn -->
                  @if ($outfit['last_worn'])
                    <div class="flex items-center text-xs text-gray-600">
                      <i class="fas fa-clock text-secondary mr-2"></i>
                      <span>Last worn
                        {{ \Carbon\Carbon::parse($outfit['last_worn'])->format('M j, Y') }}</span>
                    </div>
                  @endif
                </div>
              </div>
            @endforeach
          </div>

          <!-- List View for Samples (Hidden by default) -->
          <div class="hidden" id="samplesListView">
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
              <table class="w-full">
                <thead class="border-b border-gray-200 bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">
                      Outfit</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">
                      Occasion</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">Last
                      Worn</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">Items
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">
                      Actions</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  @foreach ($outfitSamples as $outfit)
                    <tr class="hover:bg-gray-50">
                      <td class="px-6 py-4">
                        <div class="flex items-center">
                          <div
                            class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-gray-200 to-gray-300">
                            <div class="grid grid-cols-2 gap-1 p-1">
                              @foreach (array_slice($outfit['items'], 0, 4) as $item)
                                <div class="h-2 w-2 rounded-full"
                                  style="background-color: {{ $item['color'] }}"></div>
                              @endforeach
                            </div>
                          </div>
                          <div class="ml-4">
                            <div class="text-dark font-medium">{{ $outfit['name'] }}</div>
                            <div class="text-sm text-gray-500">{{ $outfit['description'] }}</div>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-4">
                        @if ($outfit['occasion'])
                          <span
                            class="bg-secondary/10 text-secondary inline-flex rounded-full px-3 py-1 text-xs font-medium">
                            {{ $outfit['occasion'] }}
                          </span>
                        @else
                          <span class="text-sm text-gray-500">-</span>
                        @endif
                      </td>
                      <td class="px-6 py-4">
                        @if ($outfit['last_worn'])
                          <span class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($outfit['last_worn'])->format('M d, Y') }}
                          </span>
                        @else
                          <span class="text-sm text-gray-500">Never</span>
                        @endif
                      </td>
                      <td class="px-6 py-4">
                        <div class="flex -space-x-2">
                          @foreach (array_slice($outfit['items'], 0, 4) as $item)
                            <div
                              class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white text-xs font-semibold"
                              style="background-color: {{ $item['color'] }}">
                              {{ strtoupper(substr($item['category'], 0, 1)) }}
                            </div>
                          @endforeach
                          @if (count($outfit['items']) > 4)
                            <div
                              class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-gray-800 text-xs font-semibold text-white">
                              +{{ count($outfit['items']) - 4 }}
                            </div>
                          @endif
                        </div>
                      </td>
                      <td class="px-6 py-4">
                        <div class="flex space-x-2">
                          <button class="view-outfit-btn text-primary hover:text-purple-700"
                            data-outfit-id="{{ $outfit['id'] }}">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button class="hover:text-primary edit-outfit-btn text-gray-400"
                            data-outfit-id="{{ $outfit['id'] }}">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button class="schedule-outfit-btn text-gray-400 hover:text-green-600"
                            data-outfit-id="{{ $outfit['id'] }}">
                            <i class="fas fa-calendar-plus"></i>
                          </button>
                          <button class="delete-outfit-btn text-gray-400 hover:text-red-500"
                            data-outfit-id="{{ $outfit['id'] }}">
                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Outfit Details Modal -->
  <div class="fixed inset-0 z-50 hidden overflow-y-auto" id="outfitModal">
    <div class="flex min-h-screen items-center justify-center p-4">
      <!-- Overlay -->
      <div class="fixed inset-0 bg-black opacity-50" onclick="closeOutfitModal()"></div>

      <!-- Modal Content -->
      <div class="relative z-10 w-full max-w-4xl rounded-xl bg-white shadow-2xl">
        <!-- Modal content will be loaded dynamically -->
      </div>
    </div>
  </div>

  <!-- Edit Outfit Modal -->
  <div class="fixed inset-0 z-50 hidden overflow-y-auto" id="editOutfitModal">
    <div class="flex min-h-screen items-center justify-center p-4">
      <!-- Overlay -->
      <div class="fixed inset-0 bg-black opacity-50" onclick="closeEditOutfitModal()"></div>

      <!-- Modal Content -->
      <div class="relative z-10 w-full max-w-4xl rounded-xl bg-white shadow-2xl">
        <!-- Edit modal content will be loaded dynamically -->
      </div>
    </div>
  </div>

  <!-- Schedule Outfit Modal -->
  <div class="fixed inset-0 z-50 hidden overflow-y-auto" id="scheduleOutfitModal">
    <div class="flex min-h-screen items-center justify-center p-4">
      <!-- Overlay -->
      <div class="fixed inset-0 bg-black opacity-50" onclick="closeScheduleModal()"></div>

      <div class="relative z-10 w-full max-w-md rounded-xl bg-white shadow-2xl">
        <div class="p-6">
          <h3 class="text-dark mb-6 text-xl font-bold">Schedule Outfit</h3>

          <div class="mb-6">
            <label class="mb-2 block text-sm font-medium text-gray-700">Select Date</label>
            <input
              class="focus:border-primary focus:ring-primary/20 w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2"
              id="scheduleDate" min="{{ date('Y-m-d') }}" type="date">
          </div>

          <div class="mb-6">
            <label class="mb-2 block text-sm font-medium text-gray-700">Occasion</label>
            <select
              class="focus:border-primary focus:ring-primary/20 w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2"
              id="scheduleOccasion">
              <option value="">Select occasion</option>
              <option value="Casual">Casual</option>
              <option value="Business">Business</option>
              <option value="Evening">Evening</option>
              <option value="Holiday Party">Holiday Party</option>
              <option value="Sports">Sports</option>
              <option value="Vacation">Vacation</option>
              <option value="Date Night">Date Night</option>
              <option value="Formal Event">Formal Event</option>
            </select>
          </div>

          <div class="flex justify-end space-x-3">
            <button
              class="rounded-lg border border-gray-200 px-6 py-2 font-medium text-gray-700 hover:bg-gray-50"
              onclick="closeScheduleModal()">Cancel</button>
            <button class="bg-primary rounded-lg px-6 py-2 font-medium text-white hover:opacity-90"
              onclick="scheduleOutfit()">Schedule</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    // Static outfit data (same as PHP array)
    const outfitsData = @json($outfits);

    // State
    let selectedOutfitId = null;
    let schedulingOutfitId = null;
    let currentView = 'grid';
    let currentTab = 'planned';

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
      // View toggle functionality
      const gridViewBtn = document.getElementById('gridViewBtn');
      const listViewBtn = document.getElementById('listViewBtn');

      gridViewBtn.addEventListener('click', function() {
        currentView = 'grid';
        showGridView();
      });

      listViewBtn.addEventListener('click', function() {
        currentView = 'list';
        showListView();
      });

      // Tab functionality
      document.querySelectorAll('.outfit-tab').forEach(tab => {
        tab.addEventListener('click', function() {
          const tabName = this.dataset.tab;
          switchTab(tabName);
        });
      });

      // View outfit buttons
      document.querySelectorAll('.view-outfit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const outfitId = parseInt(this.dataset.outfitId);
          showOutfitModal(outfitId);
        });
      });

      // Edit outfit buttons
      document.querySelectorAll('.edit-outfit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const outfitId = parseInt(this.dataset.outfitId);
          showEditOutfitModal(outfitId);
        });
      });

      // Remove outfit buttons (remove from planned date)
      document.querySelectorAll('.remove-outfit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const outfitId = parseInt(this.dataset.outfitId);
          removeFromPlannedDate(outfitId);
        });
      });

      // Delete outfit buttons (delete entirely)
      document.querySelectorAll('.delete-outfit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const outfitId = parseInt(this.dataset.outfitId);
          deleteOutfit(outfitId);
        });
      });

      // Schedule outfit buttons (for samples)
      document.querySelectorAll('.schedule-outfit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const outfitId = parseInt(this.dataset.outfitId);
          showScheduleModal(outfitId);
        });
      });
    });

    function showGridView() {
      document.getElementById('gridViewBtn').classList.add('active');
      document.getElementById('listViewBtn').classList.remove('active');

      // Show grid view for current tab
      if (currentTab === 'planned') {
        document.getElementById('gridView').classList.remove('hidden');
        document.getElementById('listView').classList.add('hidden');
      } else {
        document.getElementById('samplesGridView').classList.remove('hidden');
        document.getElementById('samplesListView').classList.add('hidden');
      }
    }

    function showListView() {
      document.getElementById('listViewBtn').classList.add('active');
      document.getElementById('gridViewBtn').classList.remove('active');

      // Show list view for current tab
      if (currentTab === 'planned') {
        document.getElementById('listView').classList.remove('hidden');
        document.getElementById('gridView').classList.add('hidden');
      } else {
        document.getElementById('samplesListView').classList.remove('hidden');
        document.getElementById('samplesGridView').classList.add('hidden');
      }
    }

    function switchTab(tabName) {
      currentTab = tabName;

      // Update active tab
      document.querySelectorAll('.outfit-tab').forEach(tab => {
        if (tab.dataset.tab === tabName) {
          tab.classList.add('active');
          tab.classList.remove('border-transparent', 'text-gray-500');
          tab.classList.add('border-[var(--primary-color)]', 'text-[var(--primary-color)]');
        } else {
          tab.classList.remove('active');
          tab.classList.add('border-transparent', 'hover:border-[var(--primary-color)]', 'hover:text-[var(--primary-color)]');
          tab.classList.remove('border-[var(--primary-color)]', 'text-[var(--primary-color)]');
        }
      });

      // Show/hide content
      if (tabName === 'planned') {
        document.getElementById('plannedOutfitsGrid').classList.remove('hidden');
        document.getElementById('outfitSamplesGrid').classList.add('hidden');
      } else {
        document.getElementById('plannedOutfitsGrid').classList.add('hidden');
        document.getElementById('outfitSamplesGrid').classList.remove('hidden');
      }

      // Reset view to grid when switching tabs
      currentView = 'grid';
      showGridView();
    }

    function showOutfitModal(outfitId) {
      selectedOutfitId = outfitId;
      const outfit = outfitsData.find(o => o.id === outfitId);
      if (!outfit) return;

      const dateObj = outfit.planned_date ? new Date(outfit.planned_date) : null;
      const formattedDate = dateObj ? dateObj.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      }) : null;

      const lastWornDate = outfit.last_worn ? new Date(outfit.last_worn) : null;
      const formattedLastWorn = lastWornDate ? lastWornDate.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      }) : null;

      const modalContent = document.querySelector('#outfitModal .relative');
      modalContent.innerHTML = `
            <!-- Modal Header -->
            <div class="flex items-center justify-between border-b border-gray-200 p-6">
                <div>
                    <h3 class="text-2xl font-bold text-dark">${outfit.name}</h3>
                    <p class="mt-1 text-gray-600">${outfit.description}</p>
                </div>
                <button onclick="closeOutfitModal()" class="rounded-full p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <!-- Outfit Details -->
                <div class="mb-8">
                    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <span class="text-sm font-medium text-gray-600">Occasion:</span>
                            <span class="ml-2 rounded-full bg-primary/10 px-3 py-1 text-sm font-medium text-primary">
                                ${outfit.occasion}
                            </span>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Season:</span>
                            <span class="ml-2 text-sm text-gray-900">${outfit.season}</span>
                        </div>
                        ${outfit.planned_date ? `
                                            <div>
                                                <span class="text-sm font-medium text-gray-600">Planned Date:</span>
                                                <span class="ml-2 text-sm text-gray-900">${formattedDate}</span>
                                            </div>
                                            ` : ''}
                        ${formattedLastWorn ? `
                                            <div>
                                                <span class="text-sm font-medium text-gray-600">Last Worn:</span>
                                                <span class="ml-2 text-sm text-gray-900">${formattedLastWorn}</span>
                                            </div>
                                            ` : ''}
                    </div>

                    ${outfit.notes ? `
                                        <div class="rounded-lg bg-gray-50 p-4">
                                            <h4 class="mb-2 font-medium text-gray-900">Notes</h4>
                                            <p class="text-gray-600">${outfit.notes}</p>
                                        </div>
                                        ` : ''}
                </div>

                <!-- Outfit Items -->
                <div>
                    <h4 class="mb-4 text-lg font-semibold text-dark">Outfit Items</h4>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        ${outfit.items.map(item => `
                                                <div class="rounded-lg border border-gray-200 p-4">
                                                    <div class="mb-3 flex items-center">
                                                        <div class="mr-3 h-10 w-10 rounded-lg" style="background-color: ${item.color}"></div>
                                                        <div>
                                                            <h5 class="font-medium text-dark">${item.name}</h5>
                                                            <p class="text-sm text-gray-600">${item.category}</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex space-x-2">
                                                        <button class="flex-1 rounded-lg border border-gray-200 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                            View Details
                                                        </button>
                                                    </div>
                                                </div>
                                            `).join('')}
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex items-center justify-between border-t border-gray-200 p-6">
                <div class="flex space-x-3">
                    <button onclick="showEditOutfitModal(${outfit.id})" class="rounded-lg border border-gray-200 px-6 py-2 font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </button>
                    ${outfit.planned_date ? `
                                        <button onclick="removeFromPlannedDate(${outfit.id})" class="rounded-lg border border-yellow-200 px-6 py-2 font-medium text-yellow-600 hover:bg-yellow-50">
                                            <i class="fas fa-calendar-minus mr-2"></i> Remove from Date
                                        </button>
                                        ` : `
                                        <button onclick="showScheduleModal(${outfit.id})" class="rounded-lg border border-green-200 px-6 py-2 font-medium text-green-600 hover:bg-green-50">
                                            <i class="fas fa-calendar-plus mr-2"></i> Schedule
                                        </button>
                                        `}
                </div>
                <div class="flex space-x-3">
                    <button onclick="deleteOutfit(${outfit.id})" class="rounded-lg border border-red-200 px-6 py-2 font-medium text-red-600 hover:bg-red-50">
                        <i class="fas fa-trash mr-2"></i> Delete
                    </button>
                </div>
            </div>
        `;

      document.getElementById('outfitModal').classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeOutfitModal() {
      document.getElementById('outfitModal').classList.add('hidden');
      document.body.style.overflow = '';
      selectedOutfitId = null;
    }

    function showEditOutfitModal(outfitId) {
      selectedOutfitId = outfitId;
      const outfit = outfitsData.find(o => o.id === outfitId);
      if (!outfit) return;

      const modalContent = document.querySelector('#editOutfitModal .relative');
      modalContent.innerHTML = `
        <!-- Modal Header -->
        <div class="flex items-center justify-between border-b border-gray-200 p-6">
          <div>
            <h3 class="text-2xl font-bold text-dark">Edit Outfit</h3>
            <p class="mt-1 text-gray-600">Update outfit details</p>
          </div>
          <button onclick="closeEditOutfitModal()" class="rounded-full p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600">
            <i class="fas fa-times text-xl"></i>
          </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
          <!-- Outfit Name -->
          <div class="mb-6">
            <label class="mb-2 block text-sm font-medium text-gray-700">Outfit Name *</label>
            <input type="text" id="editOutfitName" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" 
              value="${outfit.name}" required>
            </div>

          <!-- Description -->
          <div class="mb-6">
          <label class="mb-2 block text-sm font-medium text-gray-700">Description</label>
          <textarea id="editOutfitDescription" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" 
            rows="3">${outfit.description}</textarea>
          </div>

          <!-- Occasion -->
          <div class="mb-6">
            <label class="mb-2 block text-sm font-medium text-gray-700">Occasion *</label>
            <select id="editOutfitOccasion" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" required>
              <option value="">Select an occasion</option>
              <option value="Casual" ${outfit.occasion === 'Casual' ? 'selected' : ''}>Casual</option>
              <option value="Business" ${outfit.occasion === 'Business' ? 'selected' : ''}>Business</option>
              <option value="Evening" ${outfit.occasion === 'Evening' ? 'selected' : ''}>Evening</option>
              <option value="Holiday Party" ${outfit.occasion === 'Holiday Party' ? 'selected' : ''}>Holiday Party</option>
              <option value="Sports" ${outfit.occasion === 'Sports' ? 'selected' : ''}>Sports</option>
              <option value="Vacation" ${outfit.occasion === 'Vacation' ? 'selected' : ''}>Vacation</option>
              <option value="Date Night" ${outfit.occasion === 'Date Night' ? 'selected' : ''}>Date Night</option>
              <option value="Formal Event" ${outfit.occasion === 'Formal Event' ? 'selected' : ''}>Formal Event</option>
            </select>
          </div>

            <!-- Season -->
            <div class="mb-6">
              <label class="mb-2 block text-sm font-medium text-gray-700">Season</label>
              <select id="editOutfitSeason" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="">Select season</option>
                <option value="Spring" ${outfit.season === 'Spring' ? 'selected' : ''}>Spring</option>
                <option value="Summer" ${outfit.season === 'Summer' ? 'selected' : ''}>Summer</option>
                <option value="Fall" ${outfit.season === 'Fall' ? 'selected' : ''}>Fall</option>
                <option value="Winter" ${outfit.season === 'Winter' ? 'selected' : ''}>Winter</option>
                <option value="All Seasons" ${outfit.season === 'All Seasons' ? 'selected' : ''}>All Seasons</option>
              </select>
            </div>

            <!-- Notes -->
            <div class="mb-6">
              <label class="mb-2 block text-sm font-medium text-gray-700">Notes</label>
              <textarea id="editOutfitNotes" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" 
              rows="3">${outfit.notes || ''}</textarea>
            </div>

            <!-- Items Preview (Read-only for now) -->
            <div class="mb-6">
              <label class="mb-2 block text-sm font-medium text-gray-700">Items (${outfit.items.length} items)</label>
              <div class="rounded-lg border border-gray-200 p-4">
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                  ${outfit.items.map(item => `
                    <div class="flex items-center space-x-3 rounded-lg border border-gray-100 p-3">
                      <div class="h-8 w-8 rounded" style="background-color: ${item.color}"></div>
                      <div>
                        <p class="text-sm font-medium text-gray-900">${item.name}</p>
                        <p class="text-xs text-gray-500">${item.category}</p>
                      </div>
                    </div>
                  `).join('')}
                </div>
                <p class="mt-3 text-sm text-gray-500">Note: Editing items is not available in this demo version.</p>
              </div>
            </div>
          </div>

          <!-- Modal Footer -->
          <div class="flex items-center justify-between border-t border-gray-200 p-6">
            <button onclick="closeEditOutfitModal()" class="rounded-lg border border-gray-200 px-6 py-2 font-medium text-gray-700 hover:bg-gray-50">
              Cancel
            </button>
            <div class="flex space-x-3">
              <button onclick="saveOutfitEdits()" class="rounded-lg bg-primary px-6 py-2 font-medium text-white hover:opacity-90">
                Save Changes
              </button>
            </div>
          </div>
        `;

      document.getElementById('editOutfitModal').classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeEditOutfitModal() {
      document.getElementById('editOutfitModal').classList.add('hidden');
      document.body.style.overflow = '';
      selectedOutfitId = null;
    }

    function saveOutfitEdits() {
      const outfitId = selectedOutfitId;
      const outfitIndex = outfitsData.findIndex(o => o.id === outfitId);

      if (outfitIndex === -1) {
        showToast('Outfit not found', 'error');
        return;
      }

      const name = document.getElementById('editOutfitName').value.trim();
      const description = document.getElementById('editOutfitDescription').value.trim();
      const occasion = document.getElementById('editOutfitOccasion').value;
      const season = document.getElementById('editOutfitSeason').value;
      const notes = document.getElementById('editOutfitNotes').value.trim();

      if (!name) {
        showToast('Please enter an outfit name', 'error');
        return;
      }

      if (!occasion) {
        showToast('Please select an occasion', 'error');
        return;
      }

      // Update outfit data
      outfitsData[outfitIndex] = {
        ...outfitsData[outfitIndex],
        name: name,
        description: description,
        occasion: occasion,
        season: season,
        notes: notes
      };

      showToast('Outfit updated successfully', 'success');
      closeEditOutfitModal();
      closeOutfitModal();

      // Refresh the page to show updated data (in real app, would update via AJAX)
      setTimeout(() => {
        location.reload();
      }, 1000);
    }

    function removeFromPlannedDate(outfitId) {
      if (!confirm('Remove this outfit from its planned date? It will become an outfit sample.')) {
        return;
      }

      const outfitIndex = outfitsData.findIndex(o => o.id === outfitId);

      if (outfitIndex === -1) {
        showToast('Outfit not found', 'error');
        return;
      }

      // Remove planned date but keep outfit
      outfitsData[outfitIndex].planned_date = null;

      showToast('Outfit removed from planned date', 'success');
      closeOutfitModal();

      // Refresh the page to show updated data
      setTimeout(() => {
        location.reload();
      }, 1000);
    }

    function deleteOutfit(outfitId) {
      if (!confirm(
          'Are you sure you want to delete this outfit permanently? This action cannot be undone.')) {
        return;
      }

      const outfitIndex = outfitsData.findIndex(o => o.id === outfitId);

      if (outfitIndex === -1) {
        showToast('Outfit not found', 'error');
        return;
      }

      // Remove outfit from array
      outfitsData.splice(outfitIndex, 1);

      showToast('Outfit deleted permanently', 'success');
      closeOutfitModal();

      // Refresh the page to show updated data
      setTimeout(() => {
        location.reload();
      }, 1000);
    }

    function showScheduleModal(outfitId) {
      schedulingOutfitId = outfitId;

      // Set minimum date to today
      const today = new Date().toISOString().split('T')[0];
      document.getElementById('scheduleDate').min = today;
      document.getElementById('scheduleDate').value = today;

      document.getElementById('scheduleOutfitModal').classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeScheduleModal() {
      document.getElementById('scheduleOutfitModal').classList.add('hidden');
      document.body.style.overflow = '';
      schedulingOutfitId = null;
    }

    function scheduleOutfit() {
      const date = document.getElementById('scheduleDate').value;
      const occasion = document.getElementById('scheduleOccasion').value;

      if (!date) {
        showToast('Please select a date', 'error');
        return;
      }

      if (!occasion) {
        showToast('Please select an occasion', 'error');
        return;
      }

      const outfitIndex = outfitsData.findIndex(o => o.id === schedulingOutfitId);

      if (outfitIndex === -1) {
        showToast('Outfit not found', 'error');
        return;
      }

      // Update outfit with planned date and occasion
      outfitsData[outfitIndex].planned_date = date;
      outfitsData[outfitIndex].occasion = occasion;

      showToast('Outfit scheduled successfully', 'success');
      closeScheduleModal();

      // Refresh the page to show updated data
      setTimeout(() => {
        location.reload();
      }, 1000);
    }

    function showToast(message, type = 'success') {
      if (typeof window.showToast === 'function') {
        window.showToast(message, type);
      } else {
        console.log(`${type}: ${message}`);
        alert(`${type.toUpperCase()}: ${message}`);
      }
    }
  </script>
@endpush
