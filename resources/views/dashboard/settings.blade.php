@extends('layouts.dashboard')
@section('page_title', 'Settings')
@section('title', 'Settings')
@push('styles')
  <style>
    /* Your existing CSS styles remain the same */
    .settings-section {
      transition: all 0.3s ease;
      display: none;
    }

    .settings-section.active {
      display: block;
    }

    .settings-section:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .setting-group {
      border-bottom: 1px solid #e5e7eb;
      padding-bottom: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .setting-group:last-child {
      border-bottom: none;
      margin-bottom: 0;
    }

    .tag {
      background-color: #9F7AEA;
      color: white;
      padding: 0.25rem 0.75rem;
      border-radius: 1rem;
      font-size: 0.65rem;
      display: flex;
      align-items: center;
    }

    .tag-remove {
      margin-left: 0.5rem;
      cursor: pointer;
    }

    .theme-option {
      border: 2px solid #e5e7eb;
      border-radius: 0.75rem;
      padding: .5rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .theme-option:hover {
      border-color: #9F7AEA;
    }

    .theme-option.active {
      border-color: #9F7AEA;
      background-color: rgba(159, 122, 234, 0.05);
    }

    .color-scheme-option {
      width: 3rem;
      height: 3rem;
      border-radius: 0.5rem;
      cursor: pointer;
      border: 3px solid transparent;
      transition: all 0.2s ease-in-out;
      position: relative;
    }

    .color-scheme-option:hover {
      transform: scale(1.1);
      border-color: #e5e7eb;
    }

    .color-scheme-option.active {
      border-color: #3b82f6;
      transform: scale(1.1);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .color-scheme-option.active::after {
      content: '✓';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      font-weight: bold;
      font-size: 1.125rem;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
    }

    /* Improved Toggle Switch with better responsiveness */
    .toggle-switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 24px;
      flex-shrink: 0;
      margin-left: 1rem;
    }

    .toggle-switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .toggle-slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: .4s;
      border-radius: 24px;
    }

    .toggle-slider:before {
      position: absolute;
      content: "";
      height: 16px;
      width: 16px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: .4s;
      border-radius: 50%;
    }

    input:checked+.toggle-slider {
      background-color: #9F7AEA;
    }

    input:checked+.toggle-slider:before {
      transform: translateX(26px);
    }

    /* Toggle container for better mobile layout */
    .toggle-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      gap: 1rem;
    }

    .toggle-content {
      flex: 1;
      min-width: 0;
      /* Prevents text overflow */
    }

    .toggle-content p:first-child {
      font-weight: 600;
      color: #2D3748;
      margin-bottom: 0.25rem;
    }

    .toggle-content p:last-child {
      font-size: 0.875rem;
      color: #6B7280;
      line-height: 1.4;
    }

    /* Your existing responsive styles remain the same */
    .settings-sidenav {
      backdrop-filter: blur(12px);
      background: rgba(255, 255, 255, 0.35);
      border: 1px solid rgba(255, 255, 255, 0.4);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 12px;
      padding: 1rem;
    }

    .settings-nav-btn {
      display: flex;
      align-items: center;
      gap: .5rem;
      font-size: 13px;
      font-weight: 600;
      padding: .625rem .75rem;
      border-radius: .75rem;
      cursor: pointer;
      transition: all .28s cubic-bezier(.2, .9, .2, 1);
      color: #2D3748;
      border: 1px solid transparent;
      background: transparent;
      position: relative;
      white-space: nowrap;
      width: 100%;
      justify-content: flex-start;
    }

    .settings-nav-btn i {
      min-width: 28px;
      text-align: center;
      font-size: .8rem;
    }

    .settings-nav-btn.active {
      background: rgba(159, 122, 234, 0.12);
      border-color: rgba(159, 122, 234, 0.18);
      color: #4C2683;
    }

    .settings-nav-btn.active:hover {
      background: rgba(159, 122, 234, 0.12);
    }

    .settings-nav-btn:hover {
      background: rgba(255, 255, 255, 0.6);
      border-color: rgba(159, 122, 234, 0.08);
    }

    /* Responsive styles with improved toggle behavior */
    @media (max-width: 639px) {
      .settings-sidenav {
        display: none;
      }

      .settings-section {
        display: block;
      }

      .section-header {
        display: flex;
        background: white;
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        align-items: center;
        gap: 0.75rem;
      }

      .section-header i {
        color: #9F7AEA;
        font-size: 1.2rem;
      }

      /* Mobile-specific toggle improvements */
      .toggle-container {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
      }

      .toggle-switch {
        margin-left: 0;
        align-self: flex-end;
      }

      .toggle-content {
        width: 100%;
      }

      .toggle-content p:first-child {
        font-size: 0.95rem;
      }

      .toggle-content p:last-child {
        font-size: 0.8rem;
      }

      /* Ensure proper spacing for toggle items */
      .space-y-4>.toggle-container {
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
      }

      .space-y-4>.toggle-container:last-child {
        border-bottom: none;
      }
    }

    @media (min-width: 640px) and (max-width: 1023px) {
      .settings-sidenav {
        width: 30px;
        padding: 1rem 0.5rem;
        margin-right: 1.5rem;
      }

      .settings-nav-btn {
        width: 70px;
        justify-content: center;
        padding: .75rem .5rem;
      }

      .settings-nav-btn .nav-label {
        opacity: 0;
        position: absolute;
        left: 80px;
        top: -10px;
        background: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        z-index: 10;
        white-space: nowrap;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        pointer-events: none;
      }

      .settings-nav-btn:hover .nav-label {
        opacity: 1;
        transform: translateY(0);
      }

      .settings-section {
        display: none;
      }

      .settings-section.active {
        display: block;
      }

      .section-header {
        display: none;
      }

      /* Tablet toggle improvements */
      .toggle-container {
        gap: 1.5rem;
      }

      .toggle-content p:first-child {
        font-size: 0.9rem;
      }

      .toggle-content p:last-child {
        font-size: 0.8rem;
      }
    }

    @media (min-width: 1024px) {
      .settings-sidenav {
        width: 220px;
        padding: 1rem .5rem;
        margin-right: 1rem;
      }

      .settings-nav-btn {
        width: 100%;
        justify-content: flex-start;
        padding: .75rem .2rem;
      }

      .settings-nav-btn .nav-label {
        opacity: 1;
        position: relative;
        transform: translateX(0);
        pointer-events: auto;
      }

      .settings-section {
        display: none;
      }

      .settings-section.active {
        display: block;
      }

      .section-header {
        display: none;
      }

      /* Desktop toggle improvements */
      .toggle-container {
        gap: 2rem;
      }
    }

    .section-header {
      display: none;
    }

    .settings-section {
      display: none;
    }

    .settings-section.active {
      display: block;
    }
  </style>
@endpush
@section('content')
  <!-- Settings Content -->
  <div class="container mx-auto px-4 py-8 sm:px-6">
    <!-- Profile Header -->
    <div class="mb-8 space-y-4 rounded-2xl bg-white p-4 shadow-lg">
      <div class="flex flex-col items-center gap-6 md:flex-row md:items-center">
        <div class="relative">
          <div
            class="bg-{{ $currentUser->avatar_color ?? 'primary' }} flex h-20 w-20 items-center justify-center rounded-full text-2xl font-bold text-white"
            id="profileHeaderAvatar">
            {{ strtoupper($currentUser->name[0]) }}
          </div>
        </div>
        <div class="flex flex-1 flex-col gap-2 text-center md:text-left">
          <h2 class="text-dark text-2xl font-bold" id="profileHeaderName">
            {{ ucfirst($currentUser->name) }}
          </h2>
          <div class="flex flex-wrap justify-center gap-2 md:justify-start">
            @foreach ($currentUser->style_tags ?? [] as $tag)
              <span
                class="bg-primary/20 text-primary rounded-full px-3 py-1 text-xs">{{ $tag }}</span>
            @endforeach
          </div>
        </div>
      </div>
      <div class="grid max-w-2xl grid-cols-1 gap-4 text-sm sm:grid-cols-2">
        <div class="mx-auto w-full max-w-md rounded-xl bg-gray-50 p-4">
          <h4 class="text-dark mb-2 font-bold">Account Information</h4>
          <div class="space-y-2">
            <div class="flex justify-between">
              <span class="text-gray-600">Email:</span>
              <span class="font-medium">{{ $currentUser->email }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Phone:</span>
              <span class="font-medium">
                {{ $currentUser->phone ?: 'Not set' }}
              </span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Member Since:</span>
              <span class="font-medium">{{ $currentUser->created_at->format('M Y') }}</span>
            </div>
          </div>
        </div>
        <div class="mx-auto w-full max-w-md rounded-xl bg-gray-50 p-4">
          <h4 class="text-dark mb-2 font-bold">Subscription</h4>
          <div class="space-y-2">
            <div class="flex justify-between">
              <span class="text-gray-600">Plan:</span>
              <span class="font-medium">{{ $currentUser->plan->name ?? 'Free' }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Renewal:</span>
              <span class="font-medium">
                @if ($currentUser->subscription)
                  {{ $currentUser->subscription->ends_at?->format('M d, Y') ?? 'Auto-renewal' }}
                @else
                  No active subscription
                @endif
              </span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Status:</span>
              <span class="text-success font-medium">
                {{ $currentUser->subscription ? 'Active' : 'Inactive' }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-col gap-4 sm:flex-row">
      <!-- Left Column - Navigation -->
      <div class="sm:w-1/6 lg:w-4/12">
        <div class="settings-sidenav sticky top-24 mx-auto w-full max-w-fit lg:container">
          <h3 class="text-dark mb-4 hidden font-bold lg:block">Settings Categories</h3>
          <div class="w-full space-y-2">
            <button class="settings-nav-btn active" data-section="profile">
              <i class="fas fa-user"></i>
              <span class="nav-label">Edit Profile</span>
            </button>
            <button class="settings-nav-btn" data-section="wardrobe">
              <i class="fas fa-archive"></i>
              <span class="nav-label">Wardrobe Settings</span>
            </button>
            <button class="settings-nav-btn" data-section="body">
              <i class="fas fa-user"></i>
              <span class="nav-label">Body Customizations</span>
            </button>
            <button class="settings-nav-btn" data-section="app">
              <i class="fas fa-palette"></i>
              <span class="nav-label">App Preferences</span>
            </button>
            <button class="settings-nav-btn" data-section="notifications">
              <i class="fas fa-bell"></i>
              <span class="nav-label">Notifications</span>
            </button>
            <button class="settings-nav-btn" data-section="subscription">
              <i class="fas fa-credit-card"></i>
              <span class="nav-label">Subscription & Billing</span>
            </button>
            <button class="settings-nav-btn" data-section="privacy">
              <i class="fas fa-shield-alt"></i>
              <span class="nav-label">Privacy & Security</span>
            </button>
            <button class="settings-nav-btn" data-section="data">
              <i class="fas fa-database"></i>
              <span class="nav-label">Data Management</span>
            </button>
          </div>
        </div>
      </div>

      <!-- Right Column - Settings Content -->
      <div class="sm:w-5/6 lg:w-8/12">

        <!-- Profile Settings -->
        <div class="settings-section active mb-6 rounded-2xl bg-white p-6 shadow-lg"
          id="profile-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-user text-primary mr-3"></i> Edit Profile
          </h2>

          <form action="{{ route('settings.profile.update') }}" class="space-y-6" method="POST">
            @csrf
            @method('PATCH')

            <!-- Personal Information -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Personal Information</h3>
              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="col-span-1 md:col-span-2">
                  <label class="mb-2 block text-sm font-medium text-gray-700">Full Name</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="fullName" name="name" placeholder="Enter your full name" type="text"
                    value="{{ old('name', $currentUser->name) }}">
                  @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Email Address</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="email" name="email" placeholder="Enter email address" type="email"
                    value="{{ old('email', $currentUser->email) }}">
                  @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Phone Number</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="phone" name="phone" placeholder="Enter phone number" type="tel"
                    value="{{ old('phone', $currentUser->phone) }}">
                  @error('phone')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Profile Avatar -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Profile Avatar</h3>
              <div class="flex flex-col items-center gap-6 md:flex-row">
                <div class="relative">
                  <div
                    class="bg-{{ $currentUser->avatar_color ?? 'primary' }} flex h-16 w-16 items-center justify-center rounded-full text-xl font-bold text-white"
                    id="profileAvatarPreview">
                    {{ $currentUser->name[0] }}
                  </div>
                  <x-button
                    class="bg-secondary absolute -bottom-1 -right-1 h-8 w-8 rounded-full text-white"
                    id="changeAvatarBtn" size='none' variant='none'>
                    <i class="fas fa-camera text-sm"></i>
                  </x-button>
                </div>
                <div class="flex-1">
                  <p class="mb-4 text-sm text-gray-600">Upload a profile picture or choose an avatar
                    color</p>
                  <div class="flex space-x-2">
                    @foreach (['primary', 'secondary', 'accent', 'success', 'yellow-500'] as $color)
                      <div
                        class="bg-{{ $color }} profile-color {{ ($currentUser->avatar_color ?? 'primary') == $color ? 'active' : '' }} h-8 w-8 cursor-pointer rounded-full border-2 border-white shadow-md"
                        data-color="{{ $color }}">
                      </div>
                    @endforeach
                  </div>
                  <input id="avatarColor" name="avatar_color" type="hidden"
                    value="{{ $currentUser->avatar_color ?? 'primary' }}">
                </div>
              </div>
            </div>

            <!-- Bio & Interests -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Bio & Interests</h3>
              <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Bio</label>
                <textarea
                  class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                  id="bio" name="bio" placeholder="Tell us about yourself..." rows="3">{{ old('bio', $currentUser->bio) }}</textarea>
                @error('bio')
                  <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
              </div>
              <div class="mt-4">
                <label class="mb-2 block text-sm font-medium text-gray-700">Style Tags</label>
                <div class="mb-4 flex flex-col items-start">
                  <div class='mb-5 flex flex-wrap gap-2' id="styleTags">
                    @foreach ($currentUser->style_tags ?? [] as $styleTag)
                      <span class="tag">
                        {{ $styleTag }}
                        <span class="tag-remove" data-tag="{{ $styleTag }}">
                          &times;
                        </span>
                      </span>
                    @endforeach
                  </div>
                  <div class="flex w-full flex-col gap-4">
                    <input
                      class="focus:ring-primary grow rounded-lg border-0 bg-gray-100 px-4 py-2 focus:outline-none focus:ring-2"
                      id="styleInput" placeholder="Add a style tag..." type="text">
                    <x-button class="w-fit rounded-lg text-base" id="addStyleBtn" size='small'
                      type="button" variant='primary'>
                      Add
                    </x-button>
                  </div>
                  <input id="styleTagsInput" name="style_tags" type="hidden"
                    value="{{ json_encode($currentUser->style_tags ?? []) }}">
                </div>
              </div>
            </div>
            <div class="flex justify-end">
              <x-button class="rounded-lg text-base" size='medium' type="submit"
                variant='primary'>
                Save Changes
              </x-button>
            </div>
          </form>
        </div>

        <!-- Wardrobe Settings -->
        <div class="settings-section mb-6 rounded-2xl bg-white p-6 shadow-lg" id="wardrobe-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-archive text-primary mr-3"></i> Wardrobe Settings
          </h2>

          <form action="{{ route('settings.wardrobe.update') }}" class="space-y-6" method="POST">
            @csrf
            @method('PATCH')

            <!-- Laundry Settings -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Laundry Settings</h3>
              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Default Laundry
                    Duration</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="laundryDuration" name="laundry_duration">
                    <option
                      {{ old('laundry_duration', $currentUser->laundry_duration) == 1 ? 'selected' : '' }}
                      value="1">1 day (High urgency)</option>
                    <option
                      {{ old('laundry_duration', $currentUser->laundry_duration) == 2 ? 'selected' : '' }}
                      value="2">2 days (Medium urgency)</option>
                    <option
                      {{ old('laundry_duration', $currentUser->laundry_duration) == 3 ? 'selected' : '' }}
                      value="3">3 days (Low urgency)</option>
                    <option
                      {{ old('laundry_duration', $currentUser->laundry_duration) == 5 ? 'selected' : '' }}
                      value="5">5 days (Very low urgency)</option>
                  </select>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Laundry
                    Reminder</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="laundryReminder" name="laundry_reminder">
                    <option
                      {{ old('laundry_reminder', $currentUser->laundry_reminder) == 1 ? 'selected' : '' }}
                      value="1">1 day before due</option>
                    <option
                      {{ old('laundry_reminder', $currentUser->laundry_reminder) == 2 ? 'selected' : '' }}
                      value="2">2 days before due</option>
                    <option
                      {{ old('laundry_reminder', $currentUser->laundry_reminder) == 3 ? 'selected' : '' }}
                      value="3">3 days before due</option>
                    <option
                      {{ old('laundry_reminder', $currentUser->laundry_reminder) == 0 ? 'selected' : '' }}
                      value="0">No reminders</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Item Disposal Settings -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Item Disposal Settings</h3>
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-dark font-medium">Auto-archive unworn items</p>
                  <p class="text-sm text-gray-600">Automatically archive items not worn in the last 6
                    months</p>
                </div>
                <label class="toggle-switch">
                  <input {{ old('auto_archive', $currentUser->auto_archive) ? 'checked' : '' }}
                    id="autoArchive" name="auto_archive" type="checkbox" value="1">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="mt-4">
                <label class="mb-2 block text-sm font-medium text-gray-700">Archive after
                  (months)</label>
                <input {{ old('auto_archive', $currentUser->auto_archive) ? '' : 'disabled' }}
                  class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                  id="archiveAfter" max="24" min="1" name="archive_after"
                  type="number"
                  value="{{ old('archive_after', $currentUser->archive_after ?? 6) }}">
              </div>
            </div>

            <!-- Clothing Categories -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Clothing Categories</h3>
              <p class="mb-4 text-sm text-gray-600">Customize the categories used to organize your
                wardrobe</p>
              <div class="mb-4 flex flex-col items-start">
                <div class='mb-5 flex flex-wrap gap-2' id="categoryTags">
                  @foreach ($currentUser->clothing_categories ?? [] as $category)
                    <span class="tag">
                      {{ $category }}
                      <span class="tag-remove" data-tag="{{ $category }}">
                        &times;
                      </span>
                    </span>
                  @endforeach
                </div>
                <div class="flex w-full flex-col gap-4">
                  <input
                    class="focus:ring-primary grow rounded-lg border-0 bg-gray-100 px-4 py-2 focus:outline-none focus:ring-2"
                    id="categoryInput" placeholder="Add a category..." type="text">
                  <x-button class="w-fit rounded-lg text-base" id="addCategoryBtn" size='small'
                    type="button" variant='primary'>
                    Add
                  </x-button>
                </div>
                <input id="categoryTagsInput" name="clothing_categories" type="hidden"
                  value="{{ json_encode($currentUser->clothing_categories ?? []) }}">
              </div>
            </div>
            <div class="flex justify-end">
              <x-button class="w-fit rounded-lg text-base" size='medium' type="submit"
                variant='primary'>
                Save Changes
              </x-button>
            </div>
          </form>
        </div>

        <!-- Body Customizations -->
        <div class="settings-section mb-6 rounded-2xl bg-white p-6 shadow-lg" id="body-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-user text-primary mr-3"></i> Body Customizations
          </h2>

          <form action="{{ route('settings.body.update') }}" class="space-y-6" method="POST">
            @csrf
            @method('PATCH')

            <!-- Body Measurements -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Body Measurements</h3>
              <p class="mb-4 text-sm text-gray-600">These measurements help us recommend clothing
                that fits you perfectly</p>
              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Height (cm)</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="height" name="height" placeholder="Enter height" step="0.1"
                    type="number" value="{{ old('height', $currentUser->height) }}">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Weight (kg)</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="weight" name="weight" placeholder="Enter weight" step="0.1"
                    type="number" value="{{ old('weight', $currentUser->weight) }}">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Chest/Bust (cm)</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="chest" name="chest" placeholder="Enter chest measurement"
                    step="0.1" type="number" value="{{ old('chest', $currentUser->chest) }}">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Waist (cm)</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="waist" name="waist" placeholder="Enter waist measurement"
                    step="0.1" type="number" value="{{ old('waist', $currentUser->waist) }}">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Hips (cm)</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="hips" name="hips" placeholder="Enter hip measurement"
                    step="0.1" type="number" value="{{ old('hips', $currentUser->hips) }}">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Inseam (cm)</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="inseam" name="inseam" placeholder="Enter inseam measurement"
                    step="0.1" type="number"
                    value="{{ old('inseam', $currentUser->inseam) }}">
                </div>
              </div>
            </div>

            <!-- Fit Preferences -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Fit Preferences</h3>
              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Top Fit</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="topFit" name="top_fit">
                    <option {{ old('top_fit', $currentUser->top_fit) == 'slim' ? 'selected' : '' }}
                      value="slim">Slim Fit</option>
                    <option
                      {{ old('top_fit', $currentUser->top_fit) == 'regular' ? 'selected' : '' }}
                      value="regular">Regular Fit</option>
                    <option
                      {{ old('top_fit', $currentUser->top_fit) == 'relaxed' ? 'selected' : '' }}
                      value="relaxed">Relaxed Fit</option>
                    <option
                      {{ old('top_fit', $currentUser->top_fit) == 'oversized' ? 'selected' : '' }}
                      value="oversized">Oversized</option>
                  </select>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Bottom Fit</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="bottomFit" name="bottom_fit">
                    <option
                      {{ old('bottom_fit', $currentUser->bottom_fit) == 'skinny' ? 'selected' : '' }}
                      value="skinny">Skinny</option>
                    <option
                      {{ old('bottom_fit', $currentUser->bottom_fit) == 'slim' ? 'selected' : '' }}
                      value="slim">Slim</option>
                    <option
                      {{ old('bottom_fit', $currentUser->bottom_fit) == 'regular' ? 'selected' : '' }}
                      value="regular">Regular</option>
                    <option
                      {{ old('bottom_fit', $currentUser->bottom_fit) == 'relaxed' ? 'selected' : '' }}
                      value="relaxed">Relaxed</option>
                  </select>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Sleeve Length</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="sleeveLength" name="sleeve_length">
                    <option
                      {{ old('sleeve_length', $currentUser->sleeve_length) == 'short' ? 'selected' : '' }}
                      value="short">Short Sleeve</option>
                    <option
                      {{ old('sleeve_length', $currentUser->sleeve_length) == 'long' ? 'selected' : '' }}
                      value="long">Long Sleeve</option>
                    <option
                      {{ old('sleeve_length', $currentUser->sleeve_length) == 'any' ? 'selected' : '' }}
                      value="any">Any Length</option>
                  </select>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Pant Length</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="pantLength" name="pant_length">
                    <option
                      {{ old('pant_length', $currentUser->pant_length) == 'ankle' ? 'selected' : '' }}
                      value="ankle">Ankle Length</option>
                    <option
                      {{ old('pant_length', $currentUser->pant_length) == 'regular' ? 'selected' : '' }}
                      value="regular">Regular Length</option>
                    <option
                      {{ old('pant_length', $currentUser->pant_length) == 'long' ? 'selected' : '' }}
                      value="long">Long Length</option>
                    <option
                      {{ old('pant_length', $currentUser->pant_length) == 'any' ? 'selected' : '' }}
                      value="any">Any Length</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Body Shape -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Body Shape</h3>
              <p class="mb-4 text-sm text-gray-600">Select the body shape that most closely matches
                yours</p>

              <div class="grid grid-cols-2 gap-4 text-sm md:grid-cols-4">
                @foreach (['hourglass' => 'Hourglass', 'rectangle' => 'Rectangle', 'pear' => 'Pear', 'apple' => 'Apple'] as $shape => $label)
                  <div
                    class="theme-option {{ old('body_shape', $currentUser->body_shape) == $shape ? 'active' : '' }} text-center"
                    data-shape="{{ $shape }}">
                    <div
                      class="bg-primary/20 mx-auto mb-2 flex h-16 w-16 items-center justify-center rounded-full">
                      <i class="fas fa-user text-primary"></i>
                    </div>
                    <p class="font-medium">{{ $label }}</p>
                    <input
                      {{ old('body_shape', $currentUser->body_shape) == $shape ? 'checked' : '' }}
                      class="hidden" name="body_shape" type="radio"
                      value="{{ $shape }}">
                  </div>
                @endforeach
              </div>
              @error('body_shape')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="flex justify-end">
              <x-button class="rounded-lg text-base" size='medium' type="submit"
                variant='primary'>
                Save Changes
              </x-button>
            </div>
          </form>
        </div>

        <!-- App Preferences -->
        <div class="settings-section mb-6 rounded-2xl bg-white p-6 shadow-lg" id="app-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-palette text-primary mr-3"></i> App Preferences
          </h2>

          <form action="{{ route('settings.app-preferences.update') }}" class="space-y-6"
            method="POST">
            @csrf
            @method('PATCH')

            <!-- Theme Settings -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Theme Settings</h3>

              @php
                $themes = [
                    'light' => [
                        'icon' => 'fas fa-sun',
                        'color' => 'text-yellow-500',
                        'bg' => 'bg-gray-200'
                    ],
                    'dark' => [
                        'icon' => 'fas fa-moon',
                        'color' => 'text-white',
                        'bg' => 'bg-gray-800'
                    ],
                    'auto' => [
                        'icon' => 'fas fa-adjust',
                        'color' => 'text-gray-700',
                        'bg' => 'bg-gradient-to-r from-gray-200 to-gray-800'
                    ]
                ];
                $currentTheme = old('theme_preference', $currentUser->theme_preference ?? 'light');
                $highContrast = old('high_contrast', $currentUser->high_contrast ?? false);
              @endphp

              <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">
                @foreach ($themes as $themeValue => $themeConfig)
                  <div
                    class="theme-option {{ $currentTheme == $themeValue ? 'active' : '' }} text-center"
                    data-theme="{{ $themeValue }}">
                    <div
                      class="{{ $themeConfig['bg'] }} mx-auto mb-2 flex h-16 w-16 items-center justify-center rounded-lg">
                      <i class="{{ $themeConfig['icon'] }} {{ $themeConfig['color'] }}"></i>
                    </div>
                    <p class="font-medium">{{ ucfirst($themeValue) }}</p>
                    <input {{ $currentTheme == $themeValue ? 'checked' : '' }} class="hidden"
                      name="theme_preference" type="radio" value="{{ $themeValue }}">
                  </div>
                @endforeach
              </div>

              <div class="flex items-center justify-between">
                <div>
                  <p class="text-dark font-medium">High contrast mode</p>
                  <p class="text-sm text-gray-600">Increase contrast for better visibility</p>
                </div>
                <label class="toggle-switch">
                  <input {{ $highContrast ? 'checked' : '' }} name="high_contrast" type="checkbox"
                    value="1">
                  <span class="toggle-slider"></span>
                </label>
              </div>
            </div>

            <!-- Color Scheme -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Color Scheme</h3>
              <p class="mb-4 text-sm text-gray-600">Choose a color scheme for the app interface</p>

              @php
                $colorSchemes = [
                    'primary' => 'bg-primary',
                    'secondary' => 'bg-secondary',
                    'accent' => 'bg-accent',
                    'success' => 'bg-success',
                    'yellow-500' => 'bg-yellow-500',
                    'pink-500' => 'bg-pink-500'
                ];
                $currentScheme = old('color_scheme', $currentUser->color_scheme ?? 'primary');
              @endphp

              <div class="flex flex-wrap gap-4">
                @foreach ($colorSchemes as $schemeValue => $schemeClass)
                  <div
                    class="color-scheme-option {{ $schemeClass }} {{ $currentScheme == $schemeValue ? 'active' : '' }}"
                    data-scheme="{{ $schemeValue }}">
                    <input {{ $currentScheme == $schemeValue ? 'checked' : '' }} class="hidden"
                      name="color_scheme" type="radio" value="{{ $schemeValue }}">
                  </div>
                @endforeach
              </div>
              @error('color_scheme')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <!-- Language & Region -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Language & Region</h3>
              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Language</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="language" name="language">
                    <option
                      {{ old('language', $currentUser->language ?? 'en') == 'en' ? 'selected' : '' }}
                      value="en">English</option>
                    <option
                      {{ old('language', $currentUser->language ?? 'en') == 'es' ? 'selected' : '' }}
                      value="es">Spanish</option>
                    <option
                      {{ old('language', $currentUser->language ?? 'en') == 'fr' ? 'selected' : '' }}
                      value="fr">French</option>
                    <option
                      {{ old('language', $currentUser->language ?? 'en') == 'de' ? 'selected' : '' }}
                      value="de">German</option>
                    <option
                      {{ old('language', $currentUser->language ?? 'en') == 'it' ? 'selected' : '' }}
                      value="it">Italian</option>
                    <option
                      {{ old('language', $currentUser->language ?? 'en') == 'pt' ? 'selected' : '' }}
                      value="pt">Portuguese</option>
                  </select>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Region</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="region" name="region">
                    <option
                      {{ old('region', $currentUser->region ?? 'us') == 'us' ? 'selected' : '' }}
                      value="us">United States</option>
                    <option
                      {{ old('region', $currentUser->region ?? 'us') == 'uk' ? 'selected' : '' }}
                      value="uk">United Kingdom</option>
                    <option
                      {{ old('region', $currentUser->region ?? 'us') == 'eu' ? 'selected' : '' }}
                      value="eu">European Union</option>
                    <option
                      {{ old('region', $currentUser->region ?? 'us') == 'ca' ? 'selected' : '' }}
                      value="ca">Canada</option>
                    <option
                      {{ old('region', $currentUser->region ?? 'us') == 'au' ? 'selected' : '' }}
                      value="au">Australia</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Units -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Units</h3>
              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Temperature</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="temperatureUnit" name="temperature_unit">
                    <option
                      {{ old('temperature_unit', $currentUser->temperature_unit ?? 'fahrenheit') == 'celsius' ? 'selected' : '' }}
                      value="celsius">Celsius (°C)</option>
                    <option
                      {{ old('temperature_unit', $currentUser->temperature_unit ?? 'fahrenheit') == 'fahrenheit' ? 'selected' : '' }}
                      value="fahrenheit">Fahrenheit (°F)</option>
                  </select>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Measurement</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="measurementUnit" name="measurement_unit">
                    <option
                      {{ old('measurement_unit', $currentUser->measurement_unit ?? 'imperial') == 'metric' ? 'selected' : '' }}
                      value="metric">Metric (cm, kg)</option>
                    <option
                      {{ old('measurement_unit', $currentUser->measurement_unit ?? 'imperial') == 'imperial' ? 'selected' : '' }}
                      value="imperial">Imperial (inches, lbs)</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="flex justify-end">
              <x-button class="rounded-lg text-base" size='medium' type="submit"
                variant='primary'>
                Save Changes
              </x-button>
            </div>
          </form>
        </div>

        <!-- Notifications -->
        <div class="settings-section mb-6 rounded-2xl bg-white p-6 shadow-lg"
          id="notifications-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-bell text-primary mr-3"></i> Notifications
          </h2>

          <form action="{{ route('settings.notifications.update') }}" class="space-y-6"
            method="POST">
            @csrf
            @method('PATCH')

            <!-- Push Notifications -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Push Notifications</h3>
              <div class="space-y-4">
                <div class="toggle-container">
                  <div class="toggle-content">
                    <p class="text-dark font-medium">Enable push notifications</p>
                    <p class="text-sm text-gray-600">Receive notifications from the app</p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('push_notifications', $currentUser->push_notifications ?? true) ? 'checked' : '' }}
                      name="push_notifications" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="toggle-container">
                  <div class="toggle-content">
                    <p class="text-dark font-medium">Sound</p>
                    <p class="text-sm text-gray-600">Play sound with notifications</p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('notification_sound', $currentUser->notification_sound ?? true) ? 'checked' : '' }}
                      name="notification_sound" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="toggle-container">
                  <div class="toggle-content">
                    <p class="text-dark font-medium">Vibration</p>
                    <p class="text-sm text-gray-600">Vibrate with notifications</p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('notification_vibration', $currentUser->notification_vibration ?? true) ? 'checked' : '' }}
                      name="notification_vibration" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
            </div>

            <!-- Email Notifications -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Email Notifications</h3>
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Marketing emails</p>
                    <p class="text-sm text-gray-600">Receive emails about new features and promotions
                    </p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('marketing_emails', $currentUser->marketing_emails ?? true) ? 'checked' : '' }}
                      name="marketing_emails" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Weekly digest</p>
                    <p class="text-sm text-gray-600">Receive a weekly summary of your wardrobe
                      activity</p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('weekly_digest', $currentUser->weekly_digest ?? true) ? 'checked' : '' }}
                      name="weekly_digest" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Laundry reminders</p>
                    <p class="text-sm text-gray-600">Receive email reminders for laundry due dates
                    </p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('laundry_emails', $currentUser->laundry_emails ?? true) ? 'checked' : '' }}
                      name="laundry_emails" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
            </div>

            <!-- In-App Notifications -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">In-App Notifications</h3>
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">New items suggestions</p>
                    <p class="text-sm text-gray-600">Get notified about new items that match your
                      style</p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('item_suggestions', $currentUser->item_suggestions ?? true) ? 'checked' : '' }}
                      name="item_suggestions" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Outfit recommendations</p>
                    <p class="text-sm text-gray-600">Receive outfit recommendations based on your
                      wardrobe</p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('outfit_recommendations', $currentUser->outfit_recommendations ?? true) ? 'checked' : '' }}
                      name="outfit_recommendations" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Style tips</p>
                    <p class="text-sm text-gray-600">Get style tips and fashion advice</p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('style_tips', $currentUser->style_tips ?? true) ? 'checked' : '' }}
                      name="style_tips" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
            </div>

            <!-- Quiet Hours -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Quiet Hours</h3>
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-dark font-medium">Enable quiet hours</p>
                  <p class="text-sm text-gray-600">Silence notifications during specified hours</p>
                </div>
                <label class="toggle-switch">
                  <input
                    {{ old('quiet_hours_enabled', $currentUser->quiet_hours) ? 'checked' : '' }}
                    name="quiet_hours_enabled" type="checkbox" value="1">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="mt-4 grid grid-cols-2 gap-4" id="quietHoursSettings"
                style="{{ old('quiet_hours_enabled', $currentUser->quiet_hours) ? '' : 'display: none;' }}">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Start Time</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="quietStart" name="quiet_start" type="time"
                    value="{{ old('quiet_start', $currentUser->quiet_start ?? '22:00') }}">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">End Time</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="quietEnd" name="quiet_end" type="time"
                    value="{{ old('quiet_end', $currentUser->quiet_end ?? '07:00') }}">
                </div>
              </div>
            </div>
            <div class="flex justify-end">
              <x-button class="rounded-lg text-base" size='medium' type="submit"
                variant='primary'>
                Save Changes
              </x-button>
            </div>
          </form>
        </div>

        <!-- Subscription & Billing -->
        <div class="settings-section mb-6 rounded-2xl bg-white p-6 shadow-lg"
          id="subscription-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-credit-card text-primary mr-3"></i> Subscription & Billing
          </h2>

          <div class="space-y-6">
            <!-- Current Plan -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Current Plan</h3>
              <div class="from-primary to-secondary rounded-xl bg-gradient-to-r p-6 text-white">
                <div class="flex flex-col items-center justify-between md:flex-row">
                  <div>
                    <h4 class="mb-2 text-xl font-bold">{{ $currentUser->plan->name ?? 'Free' }}
                      Plan</h4>
                    <p class="text-white/80">
                      {{ $currentUser->plan->description ?? 'Basic access to StyleHub features' }}
                    </p>
                  </div>
                  <div class="mt-4 md:mt-0">
                    <span
                      class="text-2xl font-bold">${{ $currentUser->plan->price ?? '0.00' }}</span>
                    <span class="text-white/80">/month</span>
                  </div>
                </div>
                <div class="mt-4 flex flex-col items-center justify-between md:flex-row">
                  <div>
                    <p class="text-sm text-white/80">
                      @if ($currentUser->subscription)
                        Next billing date: <span class="font-medium">
                          {{ $currentUser->subscription->ends_at?->format('M d, Y') ?? 'Auto-renewal' }}
                        </span>
                      @else
                        No active subscription
                      @endif
                    </p>
                  </div>
                  <div class="mt-2 md:mt-0">
                    <x-button class="mr-2" size='small' type="button" variant='outline' class="rounded-lg">
                      Change Plan
                    </x-button>
                    @if ($currentUser->subscription)
                      <x-button size='small' type="button" variant='outline' class="rounded-lg">
                        Cancel Subscription
                      </x-button>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <!-- Billing Information -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Billing Information</h3>
              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Cardholder Name</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="cardholderName" placeholder="Enter cardholder name" type="text"
                    value="{{ $currentUser->billing_name ?? '' }}">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Card Number</label>
                  <div class="relative">
                    <input
                      class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                      id="cardNumber" placeholder="Enter card number" type="text"
                      value="{{ $currentUser->card_last_four ? '**** **** **** ' . $currentUser->card_last_four : '' }}">
                    <div class="absolute right-3 top-3">
                      <i class="fab fa-cc-visa text-gray-500"></i>
                    </div>
                  </div>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Expiration Date</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="expirationDate" placeholder="MM/YY" type="text"
                    value="{{ $currentUser->card_expiry ?? '' }}">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Security Code</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="securityCode" placeholder="CVV" type="text" value="***">
                </div>
              </div>
              <div class="mt-4">
                <x-button size='small' type="button" variant='primary' class="rounded-lg">
                  Update Payment Method
                </x-button>
              </div>
            </div>

            <!-- Billing History -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Billing History</h3>
              <div class="overflow-x-auto">
                <table class="w-full">
                  <thead>
                    <tr class="border-b border-gray-200">
                      <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Date</th>
                      <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Description
                      </th>
                      <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Amount</th>
                      <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                      <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Invoice</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($currentUser->payments ?? [] as $payment)
                      <tr class="border-b border-gray-100">
                        <td class="px-4 py-3 text-sm">{{ $payment->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3 text-sm">{{ $payment->description }}</td>
                        <td class="px-4 py-3 text-sm">
                          ${{ number_format($payment->amount / 100, 2) }}</td>
                        <td class="px-4 py-3 text-sm">
                          <span class="bg-success/20 text-success rounded-full px-2 py-1 text-xs">
                            {{ ucfirst($payment->status) }}
                          </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                          <a class="text-primary hover:underline"
                            href="{{ $payment->invoice_pdf }}" target="_blank">Download</a>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td class="px-4 py-3 text-center text-sm text-gray-500" colspan="5">
                          No billing history found
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Subscription Management -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Subscription Management</h3>
              <form action="{{ route('settings.subscription.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="space-y-4">
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="text-dark font-medium">Auto-renewal</p>
                      <p class="text-sm text-gray-600">Automatically renew your subscription each
                        month</p>
                    </div>
                    <label class="toggle-switch">
                      <input
                        {{ old('auto_renewal', $currentUser->auto_renewal ?? true) ? 'checked' : '' }}
                        name="auto_renewal" type="checkbox" value="1">
                      <span class="toggle-slider"></span>
                    </label>
                  </div>
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="text-dark font-medium">Email receipts</p>
                      <p class="text-sm text-gray-600">Receive email receipts for all payments</p>
                    </div>
                    <label class="toggle-switch">
                      <input
                        {{ old('email_receipts', $currentUser->email_receipts ?? true) ? 'checked' : '' }}
                        name="email_receipts" type="checkbox" value="1">
                      <span class="toggle-slider"></span>
                    </label>
                  </div>
                </div>
                <div class="mt-6">
                  <x-button class="mr-2" size='small' type="button" variant='outline' class="rounded-lg">
                    Download All Invoices
                  </x-button>
                  @if ($currentUser->subscription)
                    <x-button size='small' type="button" variant='secondary' class="rounded-lg">
                      Cancel Subscription
                    </x-button>
                  @endif
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Privacy & Security -->
        <div class="settings-section mb-6 rounded-2xl bg-white p-6 shadow-lg" id="privacy-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-shield-alt text-primary mr-3"></i> Privacy & Security
          </h2>

          <form action="{{ route('settings.privacy.update') }}" class="space-y-6" method="POST">
            @csrf
            @method('PATCH')

            <!-- Account Security -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Account Security</h3>
              <div class="space-y-4">

                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Login notifications</p>
                    <p class="text-sm text-gray-600">Get notified when someone logs into your account
                    </p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('login_notifications', $currentUser->login_notifications ?? true) ? 'checked' : '' }}
                      name="login_notifications" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
            </div>

            <!-- Privacy Settings -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Privacy Settings</h3>
              <div class="space-y-4">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Profile
                    Visibility</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="profileVisibility" name="profile_visibility">
                    <option
                      {{ old('profile_visibility', $currentUser->profile_visibility ?? 'friends') == 'public' ? 'selected' : '' }}
                      value="public">Public</option>
                    <option
                      {{ old('profile_visibility', $currentUser->profile_visibility ?? 'friends') == 'friends_only' ? 'selected' : '' }}
                      value="friends">Friends Only</option>
                    <option
                      {{ old('profile_visibility', $currentUser->profile_visibility ?? 'friends') == 'private' ? 'selected' : '' }}
                      value="private">Private</option>
                  </select>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Allow data sharing</p>
                    <p class="text-sm text-gray-600">Share anonymized data to improve our services
                    </p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('data_sharing', $currentUser->data_sharing ?? true) ? 'checked' : '' }}
                      name="data_sharing" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Personalized ads</p>
                    <p class="text-sm text-gray-600">Show personalized ads based on your interests
                    </p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('personalized_ads', $currentUser->personalized_ads ?? true) ? 'checked' : '' }}
                      name="personalized_ads" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
            </div>

            <!-- Data Permissions -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Data Permissions</h3>
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Camera access</p>
                    <p class="text-sm text-gray-600">Allow access to camera for adding clothing items
                    </p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('camera_access', $currentUser->camera_access ?? true) ? 'checked' : '' }}
                      name="camera_access" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Location access</p>
                    <p class="text-sm text-gray-600">Allow access to location for weather-based
                      recommendations</p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('location_access', $currentUser->location_access ?? true) ? 'checked' : '' }}
                      name="location_access" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Photo library access</p>
                    <p class="text-sm text-gray-600">Allow access to photo library for adding
                      clothing items</p>
                  </div>
                  <label class="toggle-switch">
                    <input
                      {{ old('photo_library_access', $currentUser->photo_library_access ?? true) ? 'checked' : '' }}
                      name="photo_library_access" type="checkbox" value="1">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="flex justify-end">
              <x-button class="rounded-lg text-base" size='medium' type="submit"
                variant='primary'>
                Save Changes
              </x-button>
            </div>
          </form>
        </div>

        <!-- Data Management -->
        <div class="settings-section mb-6 rounded-2xl bg-white p-6 shadow-lg" id="data-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-database text-primary mr-3"></i> Data Management
          </h2>

          <div class="space-y-6">
            <!-- Data Export -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Data Export</h3>
              <p class="mb-4 text-sm text-gray-600">Download a copy of your data for backup or
                transfer to another service</p>
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Export wardrobe data</p>
                    <p class="text-sm text-gray-600">Download all your clothing items and outfits</p>
                  </div>
                  <form action="{{ route('settings.export.wardrobe') }}" method="POST">
                    @csrf
                    <x-button size='small' type="submit" variant='primary' class="rounded-lg">
                      Export
                    </x-button>
                  </form>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Export style preferences</p>
                    <p class="text-sm text-gray-600">Download your style tags and preferences</p>
                  </div>
                  <form action="{{ route('settings.export.preferences') }}" method="POST">
                    @csrf
                    <x-button size='small' type="submit" variant='primary' class="rounded-lg">
                      Export
                    </x-button>
                  </form>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Export account data</p>
                    <p class="text-sm text-gray-600">Download all your account information</p>
                  </div>
                  <form action="{{ route('settings.export.account') }}" method="POST">
                    @csrf
                    <x-button size='small' type="submit" variant='primary' class="rounded-lg">
                      Export
                    </x-button>
                  </form>
                </div>
              </div>
            </div>

            <!-- Data Deletion -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Data Deletion</h3>
              <p class="mb-4 text-sm text-gray-600">Permanently delete your data from our servers</p>
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Delete wardrobe data</p>
                    <p class="text-sm text-gray-600">Permanently delete all your clothing items and
                      outfits</p>
                  </div>
                  <form action="{{ route('settings.delete.wardrobe') }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete all your wardrobe data? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <x-button size='small' type="submit" variant='danger' class="rounded-lg">
                      Delete
                    </x-button>
                  </form>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Delete style preferences</p>
                    <p class="text-sm text-gray-600">Permanently delete your style tags and
                      preferences</p>
                  </div>
                  <form action="{{ route('settings.delete.preferences') }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete your style preferences? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <x-button size='small' type="submit" variant='danger'>
                      Delete
                    </x-button>
                  </form>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Delete account</p>
                    <p class="text-sm text-gray-600">Permanently delete your account and all data</p>
                  </div>
                  <form action="{{ route('settings.delete.account') }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone and all your data will be permanently lost.')">
                    @csrf
                    @method('DELETE')
                    <x-button size='small' type="submit" variant='danger'>
                      Delete Account
                    </x-button>
                  </form>
                </div>
              </div>
            </div>

            <!-- Data Storage -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Data Storage</h3>
              <form action="{{ route('settings.data-storage.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="space-y-4">
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="text-dark font-medium">Cloud storage</p>
                      <p class="text-sm text-gray-600">Store your data securely in the cloud</p>
                    </div>
                    <label class="toggle-switch">
                      <input
                        {{ old('cloud_storage', $currentUser->cloud_storage ?? true) ? 'checked' : '' }}
                        name="cloud_storage" type="checkbox" value="1">
                      <span class="toggle-slider"></span>
                    </label>
                  </div>
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="text-dark font-medium">Local backup</p>
                      <p class="text-sm text-gray-600">Create local backups of your data</p>
                    </div>
                    <label class="toggle-switch">
                      <input {{ old('local_backup', $currentUser->local_backup) ? 'checked' : '' }}
                        name="local_backup" type="checkbox" value="1">
                      <span class="toggle-slider"></span>
                    </label>
                  </div>
                </div>
                <div class="mt-4">
                  <div class="rounded-lg bg-gray-100 p-4">
                    <div class="mb-2 flex items-center justify-between">
                      <span class="text-sm font-medium text-gray-700">Storage Usage</span>
                      <span class="text-sm text-gray-500">{{ $storageUsage ?? '1.2 GB' }} of
                        {{ $storageLimit ?? '5 GB' }} used</span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-gray-300">
                      <div class="bg-primary h-2 rounded-full"
                        style="width: {{ (($storageUsage ?? 1.2) / ($storageLimit ?? 5)) * 100 }}%">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-4 flex justify-end">
                  <x-button class="rounded-lg text-base" size='medium' type="submit"
                    variant='primary'>
                    Save Changes
                  </x-button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    // DOM Elements
    const settingsNavBtns = document.querySelectorAll('.settings-nav-btn');
    const settingsSections = document.querySelectorAll('.settings-section');
    const autoArchive = document.getElementById('autoArchive');
    const archiveAfter = document.getElementById('archiveAfter');
    const profileColors = document.querySelectorAll('.profile-color');
    const styleTags = document.getElementById('styleTags');
    const styleInput = document.getElementById('styleInput');
    const addStyleBtn = document.getElementById('addStyleBtn');
    const styleTagsInput = document.getElementById('styleTagsInput');
    const categoryTags = document.getElementById('categoryTags');
    const categoryInput = document.getElementById('categoryInput');
    const addCategoryBtn = document.getElementById('addCategoryBtn');
    const categoryTagsInput = document.getElementById('categoryTagsInput');
    const themeOptions = document.querySelectorAll('.theme-option[data-theme]');
    const colorSchemeOptions = document.querySelectorAll('.color-scheme-option');
    const bodyShapeOptions = document.querySelectorAll('.theme-option[data-shape]');
    const quietHours = document.querySelector('input[name="quiet_hours_enabled"]');
    const quietHoursSettings = document.getElementById('quietHoursSettings');
    const avatarColorInput = document.getElementById('avatarColor');

    // Settings navigation - FIXED VERSION
    function initializeNavigation() {
      settingsNavBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          const targetSection = this.getAttribute('data-section');

          console.log('Clicked nav button:', targetSection); // Debug log

          // Update active nav button
          settingsNavBtns.forEach(b => {
            b.classList.remove('active');
          });
          this.classList.add('active');

          // Show target section and hide others
          settingsSections.forEach(section => {
            section.classList.remove('active');
          });

          const targetElement = document.getElementById(`${targetSection}-section`);
          if (targetElement) {
            targetElement.classList.add('active');
            console.log('Activated section:', targetSection); // Debug log
          } else {
            console.error('Target section not found:', `${targetSection}-section`);
          }
        });
      });
    }

    // Auto-archive toggle
    if (autoArchive && archiveAfter) {
      autoArchive.addEventListener('change', function() {
        archiveAfter.disabled = !this.checked;
      });

      // Initialize state on page load
      archiveAfter.disabled = !autoArchive.checked;
    }

    // Quiet hours toggle
    if (quietHours && quietHoursSettings) {
      quietHours.addEventListener('change', function() {
        if (this.checked) {
          quietHoursSettings.style.display = 'grid';
        } else {
          quietHoursSettings.style.display = 'none';
        }
      });

      // Initialize state on page load
      if (!quietHours.checked) {
        quietHoursSettings.style.display = 'none';
      }
    }

    // Profile color selection
    profileColors.forEach(color => {
      color.addEventListener('click', function() {
        const selectedColor = this.getAttribute('data-color');

        // Update active color
        profileColors.forEach(c => c.classList.remove('active'));
        this.classList.add('active');

        // Update hidden input
        if (avatarColorInput) {
          avatarColorInput.value = selectedColor;
        }

        // Update avatar previews
        const avatarElements = [
          document.getElementById('profileHeaderAvatar'),
          document.getElementById('profileAvatarPreview')
        ];

        avatarElements.forEach(avatar => {
          if (avatar) {
            // Remove all color classes and add the new one
            avatar.className = avatar.className.replace(/bg-\w+(?:-\d+)?/g, '');
            avatar.classList.add(`bg-${selectedColor}`);
          }
        });
      });
    });

    // Style tags management
    function updateStyleTagsInput() {
      if (!styleTags || !styleTagsInput) return;

      const tags = Array.from(styleTags.querySelectorAll('.tag'))
        .map(tag => tag.textContent.trim().replace('×', '').trim());
      styleTagsInput.value = JSON.stringify(tags);
    }

    function initializeStyleTags() {
      if (!addStyleBtn || !styleInput || !styleTags) return;

      addStyleBtn.addEventListener('click', function() {
        const styleValue = styleInput.value.trim();
        if (styleValue && !styleTags.querySelector(`[data-tag="${styleValue}"]`)) {
          const tag = document.createElement('span');
          tag.className = 'tag';
          tag.setAttribute('data-tag', styleValue);
          tag.innerHTML =
            `${styleValue} <span class="tag-remove" data-tag="${styleValue}">&times;</span>`;
          styleTags.appendChild(tag);
          styleInput.value = '';
          updateStyleTagsInput();

          // Add remove functionality to new tag
          tag.querySelector('.tag-remove').addEventListener('click', function() {
            this.parentElement.remove();
            updateStyleTagsInput();
          });
        }
      });
    }

    // Category tags management
    function updateCategoryTagsInput() {
      if (!categoryTags || !categoryTagsInput) return;

      const tags = Array.from(categoryTags.querySelectorAll('.tag'))
        .map(tag => tag.textContent.trim().replace('×', '').trim());
      categoryTagsInput.value = JSON.stringify(tags);
    }

    function initializeCategoryTags() {
      if (!addCategoryBtn || !categoryInput || !categoryTags) return;

      addCategoryBtn.addEventListener('click', function() {
        const categoryValue = categoryInput.value.trim();
        if (categoryValue && !categoryTags.querySelector(`[data-tag="${categoryValue}"]`)) {
          const tag = document.createElement('span');
          tag.className = 'tag';
          tag.setAttribute('data-tag', categoryValue);
          tag.innerHTML =
            `${categoryValue} <span class="tag-remove" data-tag="${categoryValue}">&times;</span>`;
          categoryTags.appendChild(tag);
          categoryInput.value = '';
          updateCategoryTagsInput();

          // Add remove functionality to new tag
          tag.querySelector('.tag-remove').addEventListener('click', function() {
            this.parentElement.remove();
            updateCategoryTagsInput();
          });
        }
      });
    }

    // Theme selection
    themeOptions.forEach(option => {
      option.addEventListener('click', function() {
        themeOptions.forEach(o => o.classList.remove('active'));
        this.classList.add('active');
        const radio = this.querySelector('input[type="radio"]');
        if (radio) radio.checked = true;
      });
    });

    // Color scheme selection
    colorSchemeOptions.forEach(option => {
      option.addEventListener('click', function() {
        colorSchemeOptions.forEach(o => o.classList.remove('active'));
        this.classList.add('active');
        const radio = this.querySelector('input[type="radio"]');
        if (radio) radio.checked = true;
      });
    });

    // Body shape selection
    bodyShapeOptions.forEach(option => {
      option.addEventListener('click', function() {
        bodyShapeOptions.forEach(o => o.classList.remove('active'));
        this.classList.add('active');
        const radio = this.querySelector('input[type="radio"]');
        if (radio) radio.checked = true;
      });
    });

    // Initialize tag removal functionality for existing tags
    function initializeExistingTagRemoval() {
      document.querySelectorAll('.tag-remove').forEach(removeBtn => {
        removeBtn.addEventListener('click', function() {
          const parentTag = this.parentElement;
          parentTag.remove();

          // Update the appropriate hidden input
          if (parentTag.parentElement === styleTags) {
            updateStyleTagsInput();
          } else if (parentTag.parentElement === categoryTags) {
            updateCategoryTagsInput();
          }
        });
      });
    }

    // Handle responsive behavior
    function handleResize() {
      if (window.innerWidth < 640) {
        // On mobile, show all sections and hide navigation
        settingsSections.forEach(section => {
          section.classList.add('active');
        });
      } else {
        // On medium and large screens, only show the active section
        const activeNav = document.querySelector('.settings-nav-btn.active');
        if (activeNav) {
          const section = activeNav.getAttribute('data-section') || 'profile';
          settingsSections.forEach(s => s.classList.remove('active'));
          const targetSection = document.getElementById(`${section}-section`);
          if (targetSection) {
            targetSection.classList.add('active');
          }
        }
      }
    }

    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
      console.log('Initializing settings page...'); // Debug log

      // Initialize navigation first
      initializeNavigation();

      // Initialize other functionality
      initializeStyleTags();
      initializeCategoryTags();
      initializeExistingTagRemoval();

      // Set initial state for toggles
      if (autoArchive && archiveAfter) {
        archiveAfter.disabled = !autoArchive.checked;
      }

      if (quietHours && quietHoursSettings && !quietHours.checked) {
        quietHoursSettings.style.display = 'none';
      }

      // Handle responsive behavior
      handleResize();

      // Update on resize
      window.addEventListener('resize', handleResize);

      console.log('Settings page initialized successfully'); // Debug log
    });

    // Form submission handling (optional - for debugging)
    document.querySelectorAll('form').forEach(form => {
      form.addEventListener('submit', function(e) {
        console.log('Submitting form:', this.action);
        // You can add additional validation here if needed
      });
    });
  </script>
@endpush
