@extends('layouts.dashboard')

@section('title', 'Plan Outfit')
@section('page_title', 'Plan Outfit')

@php
  // Current month and year from request or current date
  $currentMonth = $currentMonth ?? date('n');
  $currentYear = $currentYear ?? date('Y');

  // Get first day of month and number of days
  $firstDayOfMonth = mktime(0, 0, 0, $currentMonth, 1, $currentYear);
  $daysInMonth = date('t', $firstDayOfMonth);
  $firstDayOfWeek = date('w', $firstDayOfMonth);

  // Previous and next month/year
  $prevMonth = $currentMonth - 1;
  $prevYear = $currentYear;
  if ($prevMonth < 1) {
      $prevMonth = 12;
      $prevYear--;
  }

  $nextMonth = $currentMonth + 1;
  $nextYear = $currentYear;
  if ($nextMonth > 12) {
      $nextMonth = 1;
      $nextYear++;
  }

  // Static wardrobe items data
  $wardrobeItems = [
      // Tops
      [
          'id' => 1,
          'name' => 'Casual T-Shirt',
          'category' => 'Top',
          'color' => '#000000',
          'type' => 'casual'
      ],
      [
          'id' => 2,
          'name' => 'White Button-up',
          'category' => 'Top',
          'color' => '#FFFFFF',
          'type' => 'formal'
      ],
      [
          'id' => 3,
          'name' => 'Blue Sweater',
          'category' => 'Top',
          'color' => '#1E40AF',
          'type' => 'casual'
      ],
      [
          'id' => 4,
          'name' => 'Red Hoodie',
          'category' => 'Top',
          'color' => '#DC2626',
          'type' => 'casual'
      ],

      // Bottoms
      [
          'id' => 5,
          'name' => 'Denim Jeans',
          'category' => 'Bottom',
          'color' => '#1E3A8A',
          'type' => 'casual'
      ],
      [
          'id' => 6,
          'name' => 'Black Trousers',
          'category' => 'Bottom',
          'color' => '#171717',
          'type' => 'formal'
      ],
      [
          'id' => 7,
          'name' => 'Khaki Pants',
          'category' => 'Bottom',
          'color' => '#92400E',
          'type' => 'smart-casual'
      ],
      [
          'id' => 8,
          'name' => 'Leather Skirt',
          'category' => 'Bottom',
          'color' => '#78350F',
          'type' => 'formal'
      ],

      // Footwear
      [
          'id' => 9,
          'name' => 'White Sneakers',
          'category' => 'Footwear',
          'color' => '#F8FAFC',
          'type' => 'casual'
      ],
      [
          'id' => 10,
          'name' => 'Black Heels',
          'category' => 'Footwear',
          'color' => '#000000',
          'type' => 'formal'
      ],
      [
          'id' => 11,
          'name' => 'Brown Boots',
          'category' => 'Footwear',
          'color' => '#92400E',
          'type' => 'casual'
      ],
      [
          'id' => 12,
          'name' => 'Running Shoes',
          'category' => 'Footwear',
          'color' => '#7C3AED',
          'type' => 'sports'
      ],

      // Accessories
      [
          'id' => 13,
          'name' => 'Silver Necklace',
          'category' => 'Accessory',
          'color' => '#C0C0C0',
          'type' => 'accessory'
      ],
      [
          'id' => 14,
          'name' => 'Leather Belt',
          'category' => 'Accessory',
          'color' => '#78350F',
          'type' => 'accessory'
      ],
      [
          'id' => 15,
          'name' => 'Sunglasses',
          'category' => 'Accessory',
          'color' => '#000000',
          'type' => 'accessory'
      ],
      [
          'id' => 16,
          'name' => 'Watch',
          'category' => 'Accessory',
          'color' => '#F59E0B',
          'type' => 'accessory'
      ],

      // Outerwear
      [
          'id' => 17,
          'name' => 'Denim Jacket',
          'category' => 'Outerwear',
          'color' => '#1E40AF',
          'type' => 'casual'
      ],
      [
          'id' => 18,
          'name' => 'Black Blazer',
          'category' => 'Outerwear',
          'color' => '#000000',
          'type' => 'formal'
      ]
  ];

  // Static outfit plans for calendar (stored in JSON for JavaScript)
  $outfitPlans = [
      [
          'id' => 1,
          'date' => date('Y-m-d', strtotime('+2 days')),
          'name' => 'Casual Friday',
          'occasion' => 'Casual',
          'notes' => 'Perfect for casual office day',
          'items' => [1, 5, 9, 13]
      ],
      [
          'id' => 2,
          'date' => date('Y-m-d', strtotime('+5 days')),
          'name' => 'Business Meeting',
          'occasion' => 'Business',
          'notes' => 'Important client meeting',
          'items' => [2, 6, 10, 18]
      ],
      [
          'id' => 3,
          'date' => date('Y-m-15'),
          'name' => 'Date Night',
          'occasion' => 'Evening',
          'notes' => 'Dinner at the new Italian place',
          'items' => [3, 8, 10, 13]
      ],
      [
          'id' => 4,
          'date' => date('Y-m-24'),
          'name' => 'Christmas Party',
          'occasion' => 'Holiday Party',
          'notes' => 'Office Christmas party',
          'items' => [4, 5, 11, 14]
      ]
  ];
@endphp

  @push('styles')
    <style>
      .view-toggle.active {
        background-color: rgba(var(--primary-color-rgb), 0.1);
        color: var(--primary-color);
      }

      .calendar-day.has-outfit {
        background-color: rgba(var(--primary-color-rgb), 0.05);
        border-color: var(--primary-color);
      }

      .calendar-day.today {
        border-color: var(--primary-color);
        font-weight: bold;
      }

      .calendar-day:hover {
        background-color: rgba(var(--primary-color-rgb), 0.05);
        transform: translateY(-1px);
      }

      .category-filter.active {
        background-color: var(--primary-color) !important;
        color: white !important;
      }

      .wardrobe-select-item.selected {
        border-color: var(--primary-color);
        background-color: rgba(var(--primary-color-rgb), 0.05);
      }

      .selected-item-card {
        animation: slideIn 0.3s ease-out;
      }

      .item-selected .add-to-outfit-btn {
        background-color: var(--primary-color);
        color: white;
      }

      @keyframes slideIn {
        from {
          opacity: 0;
          transform: translateY(-10px);
        }

        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      /* Scrollbar styling for wardrobe modal */
      #wardrobeItemsGrid::-webkit-scrollbar {
        width: 6px;
      }

      #wardrobeItemsGrid::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
      }

      #wardrobeItemsGrid::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
      }

      #wardrobeItemsGrid::-webkit-scrollbar-thumb:hover {
        background: #555;
      }
    </style>
  @endpush

@section('content')
  <div class="bg-light min-h-screen p-6">
    <div class="mx-auto max-w-7xl">
      <!-- Header Section -->
      <div class="mb-8 flex flex-col justify-between sm:flex-row sm:items-center">
        <div>
          <h1 class="responsive-heading text-dark font-bold">Plan Your Outfits</h1>
          <p class="mt-2 text-gray-600">Schedule outfits for specific dates and organize your wardrobe
          </p>
        </div>

        <div class="mt-4 flex items-center space-x-4 sm:mt-0">
          <!-- View Toggle -->
          <div class="flex items-center rounded-lg border border-gray-200 bg-white p-1">
            <button class="view-toggle active rounded-md p-2 hover:bg-gray-50" data-view="calendar"
              id="calendarViewBtn">
              <i class="fas fa-calendar"></i>
            </button>
            <button class="view-toggle rounded-md p-2 hover:bg-gray-50" data-view="list"
              id="listViewBtn">
              <i class="fas fa-list"></i>
            </button>
          </div>

          <!-- Quick Stats -->
          <div class="hidden items-center space-x-4 sm:flex">
            <div class="flex items-center">
              <div class="bg-primary mr-2 h-2 w-2 rounded-full"></div>
              <span class="text-sm text-gray-600">Planned</span>
            </div>
            <div class="flex items-center">
              <div class="mr-2 h-2 w-2 rounded-full bg-gray-300"></div>
              <span class="text-sm text-gray-600">Available</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div>
        <!-- Calendar View (Default) -->
        <div id="calendarView">
          <div class="responsive-card rounded-2xl bg-white shadow-lg">
            <!-- Calendar Header -->
            <div class="mb-6 flex items-center justify-between border-b border-gray-200 pb-4">
              <div>
                <h2 class="text-dark text-xl font-bold">
                  {{ date('F Y', mktime(0, 0, 0, $currentMonth, 1, $currentYear)) }}
                </h2>
                <p class="text-sm text-gray-600">Click on a date to view or plan an outfit</p>
              </div>
              <div class="flex items-center space-x-2">
                <!-- Previous Month -->
                <a class="rounded-lg border border-gray-200 p-2 hover:bg-gray-50"
                  href="{{ route('outfits.plan', ['month' => $prevMonth, 'year' => $prevYear]) }}">
                  <i class="fas fa-chevron-left"></i>
                </a>

                <!-- Today Button -->
                <a class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200"
                  href="{{ route('outfits.plan') }}">
                  Today
                </a>

                <!-- Next Month -->
                <a class="rounded-lg border border-gray-200 p-2 hover:bg-gray-50"
                  href="{{ route('outfits.plan', ['month' => $nextMonth, 'year' => $nextYear]) }}">
                  <i class="fas fa-chevron-right"></i>
                </a>
              </div>
            </div>

            <!-- Calendar Grid -->
            <div class="overflow-x-auto">
              <div class="min-w-[500px]">
                <!-- Day Headers -->
                <div class="grid grid-cols-7 gap-1 border-b border-gray-200 pb-2">
                  <div class="text-center text-sm font-medium text-gray-500">Sun</div>
                  <div class="text-center text-sm font-medium text-gray-500">Mon</div>
                  <div class="text-center text-sm font-medium text-gray-500">Tue</div>
                  <div class="text-center text-sm font-medium text-gray-500">Wed</div>
                  <div class="text-center text-sm font-medium text-gray-500">Thu</div>
                  <div class="text-center text-sm font-medium text-gray-500">Fri</div>
                  <div class="text-center text-sm font-medium text-gray-500">Sat</div>
                </div>

                <!-- Calendar Days -->
                <div class="grid grid-cols-7 gap-1 pt-2">
                  <!-- Empty days for previous month -->
                  @for ($i = 0; $i < $firstDayOfWeek; $i++)
                    <div class="min-h-32 rounded-lg border border-gray-100 p-2 opacity-30">
                      <div class="text-right text-sm text-gray-400">
                        @php
                          $prevMonthDays = date('t', mktime(0, 0, 0, $prevMonth, 1, $prevYear));
                          echo $prevMonthDays - ($firstDayOfWeek - $i - 1);
                        @endphp
                      </div>
                    </div>
                  @endfor

                  <!-- Current Month Days -->
                  @for ($day = 1; $day <= $daysInMonth; $day++)
                    @php
                      $currentDate = sprintf('%04d-%02d-%02d', $currentYear, $currentMonth, $day);
                      $hasOutfit = false;
                      $outfitData = null;
                      $isPastDate = strtotime($currentDate) < strtotime(date('Y-m-d'));

                      foreach ($outfitPlans as $plan) {
                          if ($plan['date'] === $currentDate) {
                              $hasOutfit = true;
                              $outfitData = $plan;
                              break;
                          }
                      }

                      $isToday = $currentDate === date('Y-m-d');
                    @endphp

                    <div
                      class="calendar-day hover:border-primary {{ $hasOutfit ? 'has-outfit border-primary bg-primary/5' : '' }} {{ $isToday ? 'today border-2 border-primary' : '' }} min-h-32 cursor-pointer rounded-lg border border-gray-100 p-2 transition-all hover:shadow-md"
                      data-date="{{ $currentDate }}" data-day="{{ $day }}"
                      onclick="handleDateClick('{{ $currentDate }}', {{ $day }}, {{ $hasOutfit ? 'true' : 'false' }}, {{ $isPastDate ? 'true' : 'false' }})">
                      <div class="mb-2 flex items-center justify-between">
                        <span
                          class="{{ $isToday ? 'font-bold text-primary' : '' }} text-sm font-medium text-gray-900">{{ $day }}</span>
                        @if ($hasOutfit)
                          <span class="bg-primary rounded-full px-2 py-0.5 text-xs text-white">
                            <i class="fas fa-tshirt mr-1"></i>
                          </span>
                        @endif
                      </div>

                      <!-- Outfit Indicator -->
                      @if ($hasOutfit && $outfitData)
                        <div class="bg-primary/10 mb-1 rounded-lg p-2">
                          <div class="text-primary truncate text-xs font-medium">
                            {{ $outfitData['name'] }}</div>
                          <div class="mt-1 text-xs text-gray-600">{{ $outfitData['occasion'] }}</div>
                        </div>
                      @endif
                    </div>
                  @endfor

                  <!-- Empty days for next month -->
                  @php
                    $totalCells = ceil(($daysInMonth + $firstDayOfWeek) / 7) * 7;
                    $remainingCells = $totalCells - ($daysInMonth + $firstDayOfWeek);
                  @endphp

                  @for ($i = 1; $i <= $remainingCells; $i++)
                    <div class="min-h-32 rounded-lg border border-gray-100 p-2 opacity-30">
                      <div class="text-right text-sm text-gray-400">{{ $i }}</div>
                    </div>
                  @endfor
                </div>
              </div>
            </div>

            <!-- Calendar Legend -->
            <div class="mt-6 border-t border-gray-200 pt-4">
              <div class="flex flex-wrap items-center gap-4">
                <div class="flex items-center">
                  <div class="bg-primary mr-2 h-3 w-3 rounded-full"></div>
                  <span class="text-sm text-gray-600">Outfit planned</span>
                </div>
                <div class="flex items-center">
                  <div class="border-primary mr-2 h-3 w-3 rounded-full border-2 bg-white"></div>
                  <span class="text-sm text-gray-600">Today</span>
                </div>
                <div class="flex items-center">
                  <div class="mr-2 h-3 w-3 rounded-full bg-gray-200"></div>
                  <span class="text-sm text-gray-600">No outfit planned</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- List View (Hidden by default) -->
        <div class="hidden" id="listView">
          <div class="responsive-card rounded-2xl bg-white shadow-lg">
            <h2 class="text-dark mb-6 text-xl font-bold">Planned Outfits List</h2>

            <div class="overflow-hidden rounded-lg border border-gray-200">
              <table class="w-full">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">Date
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">Outfit
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">
                      Occasion</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">Items
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-600">
                      Actions</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  @foreach ($outfitPlans as $plan)
                    @php
                      $planDate = strtotime($plan['date']);
                      $isPastDate = $planDate < strtotime(date('Y-m-d'));
                    @endphp
                    <tr class="{{ $isPastDate ? 'opacity-60' : '' }} hover:bg-gray-50">
                      <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">
                          {{ \Carbon\Carbon::parse($plan['date'])->format('M d, Y') }}
                        </div>
                        <div class="text-xs text-gray-500">
                          {{ \Carbon\Carbon::parse($plan['date'])->format('l') }}
                        </div>
                        @if ($isPastDate)
                          <span
                            class="mt-1 inline-block rounded bg-gray-100 px-2 py-0.5 text-xs text-gray-500">Past
                            Date</span>
                        @endif
                      </td>
                      <td class="px-6 py-4">
                        <div class="flex items-center">
                          <div
                            class="mr-3 flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-gray-200 to-gray-300">
                            <i class="fas fa-tshirt text-gray-500"></i>
                          </div>
                          <span class="font-medium text-gray-900">{{ $plan['name'] }}</span>
                        </div>
                      </td>
                      <td class="px-6 py-4">
                        <span
                          class="bg-primary/10 text-primary inline-flex rounded-full px-3 py-1 text-xs font-medium">
                          {{ $plan['occasion'] }}
                        </span>
                      </td>
                      <td class="px-6 py-4">
                        <div class="flex -space-x-2">
                          @foreach (array_slice($plan['items'], 0, 3) as $itemId)
                            @php
                              $item = collect($wardrobeItems)->firstWhere('id', $itemId);
                            @endphp
                            @if ($item)
                              <div
                                class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white text-xs font-semibold"
                                style="background-color: {{ $item['color'] }}">
                                {{ strtoupper(substr($item['category'], 0, 1)) }}
                              </div>
                            @endif
                          @endforeach
                          @if (count($plan['items']) > 3)
                            <div
                              class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-gray-800 text-xs font-semibold text-white">
                              +{{ count($plan['items']) - 3 }}
                            </div>
                          @endif
                        </div>
                      </td>
                      <td class="px-6 py-4">
                        <div class="flex space-x-2">
                          <button class="text-primary hover:text-purple-700"
                            onclick="viewPlannedOutfit({{ $plan['id'] }})">
                            <i class="fas fa-eye"></i>
                          </button>
                          @if (!$isPastDate)
                            <button class="hover:text-primary text-gray-400"
                              onclick="editPlannedOutfit('{{ $plan['date'] }}', {{ $plan['id'] }})">
                              <i class="fas fa-edit"></i>
                            </button>
                          @endif
                          <button class="text-gray-400 hover:text-red-500"
                            onclick="deletePlannedOutfit('{{ $plan['date'] }}', {{ $plan['id'] }})">
                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  @endforeach

                  <!-- Empty state -->
                  @if (count($outfitPlans) === 0)
                    <tr>
                      <td class="px-6 py-12 text-center" colspan="5">
                        <i class="fas fa-calendar-times mb-4 text-4xl text-gray-300"></i>
                        <p class="text-gray-500">No outfits planned yet</p>
                        <p class="mt-1 text-sm text-gray-400">Click on a date in calendar view to
                          plan an outfit</p>
                      </td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- View/Edit Outfit Modal -->
  <div class="fixed inset-0 z-50 hidden overflow-y-auto" id="outfitModal">
    <div class="flex min-h-screen items-center justify-center p-4">
      <!-- Overlay -->
      <div class="fixed inset-0 bg-black opacity-50" onclick="closeOutfitModal()"></div>

      <!-- Modal Content -->
      <div class="relative z-10 w-full max-w-4xl rounded-xl bg-white shadow-2xl">
        <!-- Modal Header -->
        <div class="flex items-center justify-between border-b border-gray-200 p-6">
          <div>
            <h3 class="text-dark text-2xl font-bold" id="modalTitle"></h3>
            <p class="mt-1 text-gray-600" id="modalSubtitle"></p>
          </div>
          <button class="rounded-full p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600"
            onclick="closeOutfitModal()">
            <i class="fas fa-times text-xl"></i>
          </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6" id="modalBody">
          <!-- Content will be loaded here -->
        </div>

        <!-- Modal Footer -->
        <div class="flex items-center justify-between border-t border-gray-200 p-6"
          id="modalFooter">
          <!-- Footer will be loaded here -->
        </div>
      </div>
    </div>
  </div>

  <!-- Wardrobe Selection Modal -->
  <div class="fixed inset-0 z-[60] hidden overflow-y-auto" id="wardrobeModal">
    <div class="flex min-h-screen items-center justify-center p-4">
      <div class="fixed inset-0 bg-black opacity-50" onclick="closeWardrobeModal()"></div>
      <div class="relative z-10 w-full max-w-4xl rounded-xl bg-white shadow-2xl">
        <div class="p-6">
          <div class="mb-6 flex items-center justify-between">
            <h3 class="text-dark text-2xl font-bold">Select Items from Wardrobe</h3>
            <div class="flex items-center space-x-2">
              <div class="relative">
                <input
                  class="focus:border-primary focus:ring-primary/20 rounded-lg border border-gray-300 px-4 py-2 pl-10 text-sm focus:outline-none focus:ring-2"
                  id="wardrobeSearch" placeholder="Search items..." type="text">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
              </div>
              <button class="rounded-full p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600"
                onclick="closeWardrobeModal()">
                <i class="fas fa-times text-xl"></i>
              </button>
            </div>
          </div>

          <!-- Category Filter -->
          <div class="mb-4">
            <div class="flex flex-wrap gap-2">
              <button
                class="category-filter active bg-primary rounded-full px-4 py-1 text-sm text-white"
                data-category="all">All</button>
              <button
                class="category-filter rounded-full bg-gray-100 px-4 py-1 text-sm text-gray-700 hover:bg-gray-200"
                data-category="Top">Tops</button>
              <button
                class="category-filter rounded-full bg-gray-100 px-4 py-1 text-sm text-gray-700 hover:bg-gray-200"
                data-category="Bottom">Bottoms</button>
              <button
                class="category-filter rounded-full bg-gray-100 px-4 py-1 text-sm text-gray-700 hover:bg-gray-200"
                data-category="Footwear">Footwear</button>
              <button
                class="category-filter rounded-full bg-gray-100 px-4 py-1 text-sm text-gray-700 hover:bg-gray-200"
                data-category="Accessory">Accessories</button>
              <button
                class="category-filter rounded-full bg-gray-100 px-4 py-1 text-sm text-gray-700 hover:bg-gray-200"
                data-category="Outerwear">Outerwear</button>
            </div>
          </div>

          <!-- Wardrobe Items Grid -->
          <div class="mb-6 max-h-[400px] overflow-y-auto">
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4"
              id="wardrobeItemsGrid">
              @foreach ($wardrobeItems as $item)
                <div
                  class="wardrobe-select-item hover:border-primary relative overflow-hidden rounded-lg border border-gray-200 p-3 hover:shadow-md"
                  data-category="{{ $item['category'] }}" data-item-id="{{ $item['id'] }}"
                  data-name="{{ strtolower($item['name']) }}">
                  <div class="mb-2 flex justify-center">
                    <div class="h-20 w-full rounded"
                      style="background-color: {{ $item['color'] }}"></div>
                  </div>
                  <h4 class="mb-1 text-sm font-medium text-gray-900">{{ $item['name'] }}</h4>
                  <p class="text-xs text-gray-500">{{ $item['category'] }}</p>
                  <button
                    class="add-to-outfit-btn hover:bg-primary absolute right-2 top-2 rounded-full bg-white p-1.5 text-gray-400 hover:text-white"
                    data-item-id="{{ $item['id'] }}">
                    <i class="fas fa-plus text-xs"></i>
                  </button>
                </div>
              @endforeach
            </div>
          </div>

          <div class="flex justify-end space-x-3">
            <button
              class="rounded-lg border border-gray-200 px-6 py-2 font-medium text-gray-700 hover:bg-gray-50"
              onclick="closeWardrobeModal()">Done</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

  @push('scripts')
    <script>
      // Static data
      const wardrobeItemsData = @json($wardrobeItems);
      const outfitPlansData = @json($outfitPlans);

      // State
      let selectedDate = '';
      let selectedItems = [];
      let editingOutfitId = null;
      let currentMode = 'view'; // 'view', 'create', or 'edit'

      // Initialize when DOM is loaded
      document.addEventListener('DOMContentLoaded', function() {
        // View toggle functionality
        const calendarViewBtn = document.getElementById('calendarViewBtn');
        const listViewBtn = document.getElementById('listViewBtn');
        const calendarView = document.getElementById('calendarView');
        const listView = document.getElementById('listView');

        calendarViewBtn.addEventListener('click', function() {
          calendarView.classList.remove('hidden');
          listView.classList.add('hidden');
          calendarViewBtn.classList.add('active');
          listViewBtn.classList.remove('active');
        });

        listViewBtn.addEventListener('click', function() {
          listView.classList.remove('hidden');
          calendarView.classList.add('hidden');
          listViewBtn.classList.add('active');
          calendarViewBtn.classList.remove('active');
        });

        // Wardrobe modal search and filter
        const wardrobeSearch = document.getElementById('wardrobeSearch');
        if (wardrobeSearch) {
          wardrobeSearch.addEventListener('input', function() {
            filterWardrobeItems();
          });
        }

        // Category filter buttons
        document.querySelectorAll('.category-filter').forEach(btn => {
          btn.addEventListener('click', function() {
            document.querySelectorAll('.category-filter').forEach(b => b.classList.remove(
              'active'));
            this.classList.add('active');
            filterWardrobeItems();
          });
        });
      });

      function handleDateClick(date, day, hasOutfit, isPastDate) {
        selectedDate = date;

        if (hasOutfit) {
          // Find the outfit for this date
          const outfit = outfitPlansData.find(o => o.date === date);
          if (outfit) {
            if (isPastDate) {
              // Show view modal only (no edit for past dates)
              showViewOutfitModal(outfit.id);
            } else {
              // Show view modal with edit option
              showViewOutfitModal(outfit.id);
            }
          }
        } else {
          if (isPastDate) {
            showToast('Cannot plan outfits for past dates', 'error');
            return;
          }
          // Show create outfit modal
          showCreateOutfitModal(date, day);
        }
      }

      function showCreateOutfitModal(date, day) {
        currentMode = 'create';
        selectedItems = [];
        editingOutfitId = null;

        const dateObj = new Date(date);
        const options = {
          weekday: 'long',
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        };
        const formattedDate = dateObj.toLocaleDateString('en-US', options);

        document.getElementById('modalTitle').textContent = 'Plan New Outfit';
        document.getElementById('modalSubtitle').textContent = `For ${formattedDate}`;

        document.getElementById('modalBody').innerHTML = `
            <!-- Outfit Name -->
            <div class="mb-6">
                <label class="mb-2 block text-sm font-medium text-gray-700">Outfit Name *</label>
                <input type="text" id="outfitName" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" placeholder="e.g., Casual Friday Outfit" required>
            </div>
            
            <!-- Occasion -->
            <div class="mb-6">
                <label class="mb-2 block text-sm font-medium text-gray-700">Occasion *</label>
                <select id="outfitOccasion" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" required>
                    <option value="">Select an occasion</option>
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
            
            <!-- Notes -->
            <div class="mb-6">
                <label class="mb-2 block text-sm font-medium text-gray-700">Notes (Optional)</label>
                <textarea id="outfitNotes" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" rows="3" placeholder="Any special notes about this outfit..."></textarea>
            </div>
            
            <!-- Selected Items Section -->
            <div class="mb-6">
                <div class="mb-3 flex items-center justify-between">
                    <label class="block text-sm font-medium text-gray-700">Selected Items *</label>
                    <div class="flex items-center space-x-2">
                        <span id="selectedCount" class="text-sm text-gray-500">0 items</span>
                        <button type="button" onclick="openWardrobeModal()" class="rounded-lg bg-primary px-4 py-1.5 text-sm text-white hover:opacity-90">
                            <i class="fas fa-plus mr-1"></i> Add Items
                        </button>
                    </div>
                </div>
                
                <div id="modalSelectedItems" class="rounded-lg border border-gray-200 p-4">
                    <div class="text-center">
                        <i class="fas fa-tshirt text-3xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">No items selected yet</p>
                        <p class="mt-1 text-sm text-gray-400">Click "Add Items" to select from your wardrobe</p>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('modalFooter').innerHTML = `
            <button onclick="closeOutfitModal()" class="rounded-lg border border-gray-200 px-6 py-2 font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </button>
            <button onclick="saveOutfitPlan()" class="rounded-lg bg-primary px-6 py-2 font-medium text-white hover:opacity-90">
                Save Outfit Plan
            </button>
        `;

        updateSelectedItemsDisplay();
        document.getElementById('outfitModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      }

      function showViewOutfitModal(outfitId) {
        currentMode = 'view';
        const outfit = outfitPlansData.find(o => o.id === outfitId);
        if (!outfit) return;

        const dateObj = new Date(outfit.date);
        const formattedDate = dateObj.toLocaleDateString('en-US', {
          weekday: 'long',
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        });

        const isPastDate = dateObj < new Date();

        document.getElementById('modalTitle').textContent = outfit.name;
        document.getElementById('modalSubtitle').textContent = formattedDate;

        // Get selected items data
        const selectedItemsData = outfit.items.map(itemId =>
          wardrobeItemsData.find(item => item.id === itemId)
        ).filter(item => item);

        document.getElementById('modalBody').innerHTML = `
            <!-- Outfit Details -->
            <div class="mb-8">
                <div class="mb-6 flex flex-wrap items-center gap-4">
                    <div>
                        <span class="text-sm font-medium text-gray-600">Occasion:</span>
                        <span class="ml-2 rounded-full bg-primary/10 px-3 py-1 text-sm font-medium text-primary">
                            ${outfit.occasion}
                        </span>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600">Scheduled:</span>
                        <span class="ml-2 text-sm text-gray-900">${formattedDate}</span>
                    </div>
                    ${isPastDate ? `
                        <div>
                            <span class="text-sm font-medium text-gray-600">Status:</span>
                            <span class="ml-2 rounded-full bg-gray-100 px-3 py-1 text-sm text-gray-700">
                                Past Date
                            </span>
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
                <div class="mb-4 flex items-center justify-between">
                    <h4 class="text-lg font-semibold text-dark">Outfit Items</h4>
                    <span class="text-sm text-gray-600">${selectedItemsData.length} items</span>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    ${selectedItemsData.map(item => `
                            <div class="rounded-lg border border-gray-200 p-4">
                                <div class="mb-3 flex items-center">
                                    <div class="mr-3 h-10 w-10 rounded-lg" style="background-color: ${item.color}"></div>
                                    <div>
                                        <h5 class="font-medium text-dark">${item.name}</h5>
                                        <p class="text-sm text-gray-600">${item.category}</p>
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                </div>
            </div>
        `;

        let footerHtml = `
            <div class="flex space-x-3">
                <button onclick="markAsWorn(${outfit.id})" class="rounded-lg border border-gray-200 px-6 py-2 font-medium text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-check mr-2"></i> Mark as Worn
                </button>
        `;

        if (!isPastDate) {
          footerHtml += `
                <button onclick="editOutfitPlan('${outfit.date}', ${outfit.id})" class="rounded-lg border border-gray-200 px-6 py-2 font-medium text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-edit mr-2"></i> Edit
                </button>
            `;
        }

        footerHtml += `
            </div>
            <div class="flex space-x-3">
                <button onclick="deleteOutfitPlan('${outfit.date}', ${outfit.id})" class="rounded-lg border border-red-200 px-6 py-2 font-medium text-red-600 hover:bg-red-50">
                    <i class="fas fa-trash mr-2"></i> Remove
                </button>
            </div>
        `;

        document.getElementById('modalFooter').innerHTML = footerHtml;
        document.getElementById('outfitModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      }

      function editOutfitPlan(date, outfitId) {
        currentMode = 'edit';
        editingOutfitId = outfitId;

        const outfit = outfitPlansData.find(o => o.id === outfitId);
        if (!outfit) return;

        // Set selected items from existing outfit
        selectedItems = [...outfit.items];

        const dateObj = new Date(date);
        const options = {
          weekday: 'long',
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        };
        const formattedDate = dateObj.toLocaleDateString('en-US', options);
        const day = dateObj.getDate();

        document.getElementById('modalTitle').textContent = 'Edit Outfit';
        document.getElementById('modalSubtitle').textContent = `For ${formattedDate}`;

        document.getElementById('modalBody').innerHTML = `
            <!-- Outfit Name -->
            <div class="mb-6">
                <label class="mb-2 block text-sm font-medium text-gray-700">Outfit Name *</label>
                <input type="text" id="outfitName" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" 
                       value="${outfit.name}" required>
            </div>
            
            <!-- Occasion -->
            <div class="mb-6">
                <label class="mb-2 block text-sm font-medium text-gray-700">Occasion *</label>
                <select id="outfitOccasion" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" required>
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
            
            <!-- Notes -->
            <div class="mb-6">
                <label class="mb-2 block text-sm font-medium text-gray-700">Notes (Optional)</label>
                <textarea id="outfitNotes" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" 
                          rows="3" placeholder="Any special notes about this outfit...">${outfit.notes || ''}</textarea>
            </div>
            
            <!-- Selected Items Section -->
            <div class="mb-6">
                <div class="mb-3 flex items-center justify-between">
                    <label class="block text-sm font-medium text-gray-700">Selected Items *</label>
                    <div class="flex items-center space-x-2">
                        <span id="selectedCount" class="text-sm text-gray-500">${selectedItems.length} items</span>
                        <button type="button" onclick="openWardrobeModal()" class="rounded-lg bg-primary px-4 py-1.5 text-sm text-white hover:opacity-90">
                            <i class="fas fa-plus mr-1"></i> Add Items
                        </button>
                    </div>
                </div>
                
                <div id="modalSelectedItems" class="rounded-lg border border-gray-200 p-4">
                    <!-- Items will be loaded here -->
                </div>
            </div>
        `;

        document.getElementById('modalFooter').innerHTML = `
            <button onclick="closeOutfitModal()" class="rounded-lg border border-gray-200 px-6 py-2 font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </button>
            <button onclick="updateOutfitPlan()" class="rounded-lg bg-primary px-6 py-2 font-medium text-white hover:opacity-90">
                Update Outfit Plan
            </button>
        `;

        updateSelectedItemsDisplay();
        document.getElementById('outfitModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      }

      function closeOutfitModal() {
        document.getElementById('outfitModal').classList.add('hidden');
        document.body.style.overflow = '';
        selectedItems = [];
        editingOutfitId = null;
      }

      function openWardrobeModal() {
        // Highlight already selected items
        document.querySelectorAll('.wardrobe-select-item').forEach(item => {
          const itemId = parseInt(item.dataset.itemId);
          if (selectedItems.includes(itemId)) {
            item.classList.add('selected');
            const btn = item.querySelector('.add-to-outfit-btn');
            if (btn) {
              btn.innerHTML = '<i class="fas fa-check text-xs"></i>';
              btn.classList.add('item-selected');
            }
          }
        });

        document.getElementById('wardrobeModal').classList.remove('hidden');

        // Set up click handlers for wardrobe items
        document.querySelectorAll('.add-to-outfit-btn').forEach(btn => {
          btn.onclick = function() {
            const itemId = parseInt(this.dataset.itemId);
            const itemElement = this.closest('.wardrobe-select-item');

            if (selectedItems.includes(itemId)) {
              // Remove item
              selectedItems = selectedItems.filter(id => id !== itemId);
              this.innerHTML = '<i class="fas fa-plus text-xs"></i>';
              this.classList.remove('item-selected');
              itemElement.classList.remove('selected');
            } else {
              // Add item
              selectedItems.push(itemId);
              this.innerHTML = '<i class="fas fa-check text-xs"></i>';
              this.classList.add('item-selected');
              itemElement.classList.add('selected');
            }

            updateSelectedItemsDisplay();
          };
        });
      }

      function closeWardrobeModal() {
        document.getElementById('wardrobeModal').classList.add('hidden');
      }

      function filterWardrobeItems() {
        const searchTerm = document.getElementById('wardrobeSearch').value.toLowerCase();
        const activeCategory = document.querySelector('.category-filter.active').dataset.category;

        document.querySelectorAll('.wardrobe-select-item').forEach(item => {
          const category = item.dataset.category;
          const name = item.dataset.name;
          const matchesSearch = name.includes(searchTerm);
          const matchesCategory = activeCategory === 'all' || category === activeCategory;

          if (matchesSearch && matchesCategory) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      }

      function updateSelectedItemsDisplay() {
        const container = document.getElementById('modalSelectedItems');
        const countElement = document.getElementById('selectedCount');

        if (!container) return;

        if (selectedItems.length === 0) {
          container.innerHTML = `
                <div class="text-center">
                    <i class="fas fa-tshirt text-3xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">No items selected yet</p>
                    <p class="mt-1 text-sm text-gray-400">Click "Add Items" to select from your wardrobe</p>
                </div>
            `;
          if (countElement) countElement.textContent = '0 items';
          return;
        }

        // Get selected items data
        const selectedItemsData = selectedItems.map(itemId =>
          wardrobeItemsData.find(item => item.id === itemId)
        ).filter(item => item);

        let html = '<div class="grid grid-cols-2 gap-3">';

        selectedItemsData.forEach(item => {
          html += `
                <div class="selected-item-card relative overflow-hidden rounded-lg border border-gray-200 p-3">
                    <div class="mb-2 flex justify-center">
                        <div class="h-16 w-full rounded" style="background-color: ${item.color}"></div>
                    </div>
                    <h4 class="mb-1 truncate text-sm font-medium text-gray-900">${item.name}</h4>
                    <p class="text-xs text-gray-500">${item.category}</p>
                    <button onclick="removeItemFromSelection(${item.id})" 
                            class="absolute right-2 top-2 rounded-full bg-white p-1 text-gray-400 hover:bg-red-100 hover:text-red-600">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </div>
            `;
        });

        html += '</div>';
        container.innerHTML = html;

        if (countElement) {
          countElement.textContent =
            `${selectedItems.length} item${selectedItems.length !== 1 ? 's' : ''}`;
        }
      }

      function removeItemFromSelection(itemId) {
        selectedItems = selectedItems.filter(id => id !== itemId);

        // Update wardrobe modal if open
        const itemElement = document.querySelector(`.wardrobe-select-item[data-item-id="${itemId}"]`);
        if (itemElement) {
          itemElement.classList.remove('selected');
          const btn = itemElement.querySelector('.add-to-outfit-btn');
          if (btn) {
            btn.innerHTML = '<i class="fas fa-plus text-xs"></i>';
            btn.classList.remove('item-selected');
          }
        }

        updateSelectedItemsDisplay();
      }

      function saveOutfitPlan() {
        const outfitName = document.getElementById('outfitName').value.trim();
        const occasion = document.getElementById('outfitOccasion').value;
        const notes = document.getElementById('outfitNotes').value.trim();

        if (!outfitName) {
          showToast('Please enter an outfit name', 'error');
          return;
        }

        if (!occasion) {
          showToast('Please select an occasion', 'error');
          return;
        }

        if (selectedItems.length === 0) {
          showToast('Please add at least one item to the outfit', 'error');
          return;
        }

        // Generate a new outfit ID
        const outfitId = Date.now();

        // Save the outfit (in a real app, this would be saved to database)
        const outfitData = {
          id: outfitId,
          name: outfitName,
          occasion: occasion,
          notes: notes,
          date: selectedDate,
          items: selectedItems
        };

        // Add to outfit plans (in a real app, this would be saved to database)
        outfitPlansData.push(outfitData);

        // Show success message
        showToast(`Outfit "${outfitName}" planned for ${selectedDate}`, 'success');

        // Close modal
        closeOutfitModal();

        // Update UI
        updateCalendarWithOutfit(selectedDate, outfitData);
        updateListView();
      }

      function updateOutfitPlan() {
        const outfitName = document.getElementById('outfitName').value.trim();
        const occasion = document.getElementById('outfitOccasion').value;
        const notes = document.getElementById('outfitNotes').value.trim();

        if (!outfitName) {
          showToast('Please enter an outfit name', 'error');
          return;
        }

        if (!occasion) {
          showToast('Please select an occasion', 'error');
          return;
        }

        if (selectedItems.length === 0) {
          showToast('Please add at least one item to the outfit', 'error');
          return;
        }

        // Find and update outfit
        const outfitIndex = outfitPlansData.findIndex(o => o.id === editingOutfitId);
        if (outfitIndex !== -1) {
          outfitPlansData[outfitIndex] = {
            ...outfitPlansData[outfitIndex],
            name: outfitName,
            occasion: occasion,
            notes: notes,
            items: selectedItems
          };
        }

        showToast(`Outfit "${outfitName}" updated`, 'success');
        closeOutfitModal();

        // Update UI
        updateCalendarWithOutfit(selectedDate, outfitPlansData[outfitIndex]);
        updateListView();
      }

      function updateCalendarWithOutfit(date, outfit) {
        // In a real app, this would update the calendar display
        // For this demo, we'll just show a toast
        console.log('Calendar updated with outfit:', outfit);
      }

      function updateListView() {
        // In a real app, this would update the list view
        console.log('List view should be updated');
      }

      function markAsWorn(outfitId) {
        const today = new Date().toLocaleDateString('en-US', {
          month: 'short',
          day: 'numeric',
          year: 'numeric'
        });

        showToast(`Outfit marked as worn today! (${today})`, 'success');
        closeOutfitModal();
      }

      function deleteOutfitPlan(date, outfitId) {
        if (confirm('Are you sure you want to remove this outfit plan?')) {
          // Remove from outfit plans
          const outfitIndex = outfitPlansData.findIndex(o => o.id === outfitId);
          if (outfitIndex !== -1) {
            outfitPlansData.splice(outfitIndex, 1);
          }

          closeOutfitModal();
          showToast('Outfit plan removed', 'success');

          // Update UI
          updateListView();
        }
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

