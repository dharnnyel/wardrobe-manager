@extends('layouts.dashboard')
@section('page_title', 'Settings')
@section('title', 'Settings')
@push('styles')
  <style>
    [data-theme="dark"] .settings-sidenav {
      background: rgba(45, 45, 45, 0.35);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Dark mode support for plan modal */
    [data-theme="dark"] #changePlanModal .bg-white {
      background-color: var(--bg-primary);
      color: var(--text-primary);
    }

    [data-theme="dark"] #changePlanModal .text-gray-900 {
      color: var(--text-primary);
    }

    [data-theme="dark"] #changePlanModal .text-gray-600 {
      color: var(--text-secondary);
    }

    [data-theme="dark"] #changePlanModal .border-gray-200 {
      border-color: var(--border-color);
    }

    [data-theme="dark"] #changePlanModal .bg-gray-50 {
      background-color: var(--bg-secondary);
    }

    [data-theme="dark"] #changePlanModal .bg-gray-100 {
      background-color: rgba(255, 255, 255, 0.1);
    }

    /* Toggle switch theming */
    .toggle-slider {
      background-color: var(--text-secondary);
    }

    input:checked+.toggle-slider {
      background-color: var(--primary-color);
    }

    /* Table theming */
    table {
      color: var(--text-primary);
    }

    thead {
      border-bottom-color: var(--border-color);
    }

    tbody tr {
      border-bottom-color: var(--border-color);
    }

    /* Modal theming */
    #emailModal .bg-white {
      background-color: var(--bg-primary);
      color: var(--text-primary);
    }

    #emailModal .border-gray-200 {
      border-color: var(--border-color);
    }

    #emailModal label,
    #emailModal p,
    #emailModal .text-gray-900 {
      color: var(--text-primary);
    }

    /* Your existing CSS styles remain the same */
    .settings-section {
      transition: all 0.3s ease;
      display: none;
      background-color: var(--bg-primary);
      color: var(--text-primary);
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
      background-color: rgba(var(--primary-color-rgb, 159, 122, 234), 0.12);
      +color: var(--primary-color);
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
      border: 2px solid var(--border-color);
      background-color: var(--bg-primary);
      border-radius: 0.75rem;
      color: var(--text-primary);
      padding: .5rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .theme-option:hover {
      border-color: var(--primary-color);
    }

    .theme-option.active {
      border-color: var(--primary-color) !important;
      background-color: rgba(var(--primary-color-rgb), 0.05);
    }

    /* Body shape options */
    .theme-option[data-shape].active {
      border-color: var(--primary-color) !important;
    }

    .color-scheme-option {
      width: 3rem;
      height: 3rem;
      border-radius: 0.5rem;
      cursor: pointer;
      border: 3px solid var(--border-color);
      transition: all 0.2s ease-in-out;
      position: relative;
    }

    .color-scheme-option:hover {
      transform: scale(1.1);
      border-color: #e5e7eb;
    }

    .color-scheme-option.active {
      border-color: var(--primary-color) !important;
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
    /* Toggle switches using CSS variables */
    /* Toggle switches using CSS variables - FIXED VERSION */
    .toggle-switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 24px;
      flex-shrink: 0;
      margin-left: 1rem;
      cursor: pointer;
    }

    .toggle-switch input {
      position: absolute;
      inset: 0;
      /* top:0; right:0; bottom:0; left:0; */
      margin: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      z-index: 2;
      cursor: pointer;
    }

    .toggle-slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: var(--text-secondary);
      /* Gray when inactive */
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
      background-color: var(--bg-primary);
      transition: .4s;
      border-radius: 50%;
      border: 1px solid var(--border-color);
    }

    /* Use class-based approach instead of inline styles */
    .toggle-slider.active {
      background-color: var(--primary-color);
      /* Primary color when active */
    }

    .toggle-slider.active:before {
      transform: translateX(26px);
    }

    /* Remove the old input:checked styles since we're using classes */

    input:checked+.toggle-slider {
      background-color: var(--primary-color);
      /* Primary color when active */
    }

    input:checked+.toggle-slider:before {
      transform: translateX(26px);
    }

    input:focus,
    textarea:focus,
    select:focus {
      border-color: var(--primary-color) !important;
      box-shadow: 0 0 0 4px rgba(var(--primary-color-rgb, 159, 122, 234), 0.08) !important;
      outline: none !important;
    }

    label,
    .mb-2.block.text-sm.font-medium.text-gray-700 {
      color: var(--text-secondary);
    }

    [data-theme="dark"] label,
    [data-high-contrast="true"] label {
      color: var(--text-primary);
      font-weight: 600;
    }

    /* Ensure toggle knob is visible in all themes */
    .toggle-slider:before {
      background-color: var(--bg-primary);
      border: 1px solid var(--border-color);
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
      background: rgba(255, 255, 255, 0.35);
      border: 1px solid rgba(255, 255, 255, 0.4);
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
      color: var(--text-primary);
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
      color: var(--primary-color);
    }

    .settings-nav-btn.active:hover {
      background: rgba(159, 122, 234, 0.12);
    }

    .settings-nav-btn:hover {
      background: rgba(255, 255, 255, 0.6);
      border-color: rgba(159, 122, 234, 0.08);
    }

    [data-theme="dark"] .settings-nav-btn:hover {
      background: rgba(255, 255, 255, 0.1);
    }

    /* Subscription status colors using CSS variables */
    .subscription-status[data-status="active"] {
      color: var(--success-color) !important;
    }

    .subscription-status[data-status="inactive"] {
      color: var(--text-secondary) !important;
    }

    /* Subscription button theming */
    .subscription-btn {
      background-color: var(--bg-primary) !important;
      color: var(--text-primary) !important;
      border: 1px solid var(--border-color) !important;
    }

    .subscription-btn:hover {
      background-color: var(--bg-secondary) !important;
      border-color: var(--primary-color) !important;
    }

    /* Dark mode specific subscription button styles */
    [data-theme="dark"] .subscription-btn {
      background-color: #2d3748 !important;
      color: #ffffff !important;
      border-color: #4a5568 !important;
    }

    [data-theme="dark"] .subscription-btn:hover {
      background-color: #4a5568 !important;
      border-color: var(--primary-color) !important;
    }

    /* High contrast subscription buttons */
    [data-high-contrast="true"] .subscription-btn {
      background-color: var(--bg-primary) !important;
      color: var(--text-primary) !important;
      border: 2px solid var(--border-color) !important;
      font-weight: 600;
    }

    [data-high-contrast="true"] .subscription-btn:hover {
      background-color: var(--bg-secondary) !important;
      border-color: var(--primary-color) !important;
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
            @foreach (array_slice($currentUser->style_tags ?? [], 0, 3) as $tag)
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
              <span class="subscription-status font-medium"
                data-status="{{ $currentUser->subscription ? 'active' : 'inactive' }}">
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

          <form action="{{ route('settings.profile.update') }}" class="space-y-6" id="profileForm"
            method="POST">
            @csrf
            @method('PATCH')

            <!-- Personal Information -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Personal Information</h3>
              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Full Name</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="fullName" name="name" placeholder="Enter your full name"
                    type="text" value="{{ old('name', $currentUser->name) }}">
                  @error('name')
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

            {{-- TODO: FIX USER PROFILE IMAGE UPDATE --}}
            <!-- Profile Avatar -->
            {{-- <div class="setting-group">
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
            </div> --}}

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
                    @foreach ($currentUser->style_tags ?? [] as $index => $styleTag)
                      <span class="tag" data-tag="{{ $styleTag }}">
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
                    <input id="styleTagsInput" name="style_tags" type="hidden"
                      value='{{ json_encode($currentUser->style_tags ?? []) }}'>
                    <x-button class="w-fit rounded-lg text-base" id="addStyleBtn" size='small'
                      type="button" variant='primary'>
                      Add
                    </x-button>
                  </div>
                </div>
                @error('style_tags')
                  <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                @error('style_tags.*')
                  <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <!-- Email Section -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Email Address</h3>
              <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div class="flex-1">
                  <p class="text-dark font-medium">{{ $currentUser->email }}</p>
                  <p class="text-sm text-gray-600">Your current email address</p>
                </div>
                <button
                  class="bg-primary hover:bg-primary-dark w-fit rounded-lg px-4 py-3 text-base text-white transition duration-200"
                  onclick="openEmailModal()" type="button">
                  Change Email
                </button>
              </div>
            </div>

            <div class="flex justify-end">
              <x-button class="rounded-lg text-base" id="saveProfileBtn" size='medium'
                type="submit" variant='primary'>
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

          <form action="{{ route('settings.wardrobe.update') }}" class="space-y-6"
            id="wardrobeForm" method="POST">
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
                  @error('laundry_duration')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                  @enderror
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
                  @error('laundry_reminder')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                  @enderror
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
              @error('auto_archive')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
              @enderror
              <div class="mt-4">
                <label class="mb-2 block text-sm font-medium text-gray-700">Archive after
                  (months)</label>
                <input {{ old('auto_archive', $currentUser->auto_archive) ? '' : 'disabled' }}
                  class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                  id="archiveAfter" max="24" min="1" name="archive_after"
                  type="number"
                  value="{{ old('archive_after', $currentUser->archive_after ?? 6) }}">
                @error('archive_after')
                  <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
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
                  <input id="categoryTagsInput" name="clothing_categories" type="hidden"
                    value="{{ json_encode($currentUser->clothing_categories ?? []) }}">
                  @error('clothing_categories')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                  @enderror
                  @error('clothing_categories.*')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                  @enderror
                  <x-button class="w-fit rounded-lg text-base" id="addCategoryBtn" size='small'
                    type="button" variant='primary'>
                    Add
                  </x-button>
                </div>

              </div>
            </div>
            <div class="flex justify-end">
              <x-button class="w-fit rounded-lg text-base" id="saveWardrobeBtn" size='medium'
                type="submit" variant='primary'>
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
                  @php
                    $isChecked = $currentUser->body_shape === $shape;
                  @endphp
                  <div class="theme-option {{ $isChecked ? 'active' : '' }} text-center"
                    data-shape="{{ $shape }}">
                    <div
                      class="bg-primary/20 mx-auto mb-2 flex h-16 w-16 items-center justify-center rounded-full">
                      <i class="fas fa-user text-primary"></i>
                    </div>
                    <p class="font-medium">{{ $label }}</p>
                    <input {{ $isChecked ? 'checked' : '' }} class="hidden" name="body_shape"
                      type="radio" value="{{ $shape }}">
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
            id="appPreferencesForm" method="POST">
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
                $currentTheme = old('theme', $currentUser->theme ?? 'light');
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
                      name="theme" type="radio" value="{{ $themeValue }}">
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
                    'primary' => ['color' => '#9F7AEA', 'name' => 'Purple'],
                    'secondary' => ['color' => '#4FD1C5', 'name' => 'Teal'],
                    'accent' => ['color' => '#FC8181', 'name' => 'Red'],
                    'success' => ['color' => '#68D391', 'name' => 'Green'],
                    'yellow-500' => ['color' => '#EAB308', 'name' => 'Yellow'],
                    'pink-500' => ['color' => '#EC4899', 'name' => 'Pink']
                ];
                $currentScheme = old('color_scheme', $currentUser->color_scheme ?? 'primary');
              @endphp

              <div class="flex flex-wrap gap-4">
                @foreach ($colorSchemes as $schemeValue => $schemeConfig)
                  <div class="flex flex-col items-center">
                    <div
                      class="color-scheme-option {{ $currentScheme == $schemeValue ? 'active' : '' }}"
                      data-scheme="{{ $schemeValue }}"
                      style="background-color: {{ $schemeConfig['color'] }}">
                      <input {{ $currentScheme == $schemeValue ? 'checked' : '' }} class="hidden"
                        name="color_scheme" type="radio" value="{{ $schemeValue }}">
                    </div>
                    <span class="mt-2 text-xs text-gray-600">{{ $schemeConfig['name'] }}</span>
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
            id="notificationsForm" method="POST">
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
                    <input name="push_notifications" type="hidden" value="0">
                    <input
                      {{ old('push_notifications', $currentUser->push_notifications ?? false) ? 'checked' : '' }}
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
                      {{ old('laundry_reminders', $currentUser->laundry_reminders ?? true) ? 'checked' : '' }}
                      name="laundry_reminders" type="checkbox" value="1">
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
                  <input {{ old('quiet_hours', $currentUser->quiet_hours) ? 'checked' : '' }}
                    name="quiet_hours" type="checkbox" value="1">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="mt-4 grid grid-cols-2 gap-4" id="quietHoursSettings"
                style="{{ old('quiet_hours', $currentUser->quiet_hours) ? '' : 'display: none;' }}">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Start Time</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="quietStart" name="quiet_start" type="time"
                    value="{{ old('quiet_start', $currentUser->quiet_start ? $currentUser->quiet_start : '22:00') }}">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">End Time</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="quietEnd" name="quiet_end" type="time"
                    value="{{ old('quiet_end', $currentUser->quiet_end ? $currentUser->quiet_end : '07:00') }}">
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
                      class="text-2xl font-bold">{{ $currentUser->currency_symbol }}{{ $currentUser->plan->price ?? '0.00' }}</span>
                    <span class="text-white/80">/month</span>
                  </div>
                </div>
                <div class="mt-4 flex flex-col items-center justify-between md:flex-row">
                  <div>
                    <p class="text-sm text-white/80">
                      @if ($currentUser?->auto_renewal ?? false)
                        Auto renewal enabled
                      @else
                        Auto renewal disabled
                      @endif
                    </p>

                    <p class="mt-1 text-sm text-white/80">
                      @php
                        $planName = strtolower($currentUser->plan->name ?? 'free');
                      @endphp

                      @if ($planName === 'free')
                        Expiry date: <span class="font-medium">Never</span>
                      @elseif ($currentUser->subscription && $currentUser->subscription->ends_at)
                        Expiry date: <span
                          class="font-medium">{{ $currentUser->subscription->ends_at->format('M d, Y') }}</span>
                      @endif
                    </p>
                  </div>
                  <!-- In the subscription-section, replace the buttons section -->
                  <div class="mt-2 md:mt-0">
                    <x-button class="subscription-btn mr-2 rounded-lg"
                      onclick="openChangePlanModal()" size='small' type="button">
                      Change Plan
                    </x-button>
                    @if ($currentUser->subscription)
                      <x-button class="subscription-btn rounded-lg" size='small' type="button">
                        Cancel Subscription
                      </x-button>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <!-- Billing History -->
            <div class="setting-group">
              <div
                class="mb-5 flex flex-col justify-between gap-4 min-[490px]:flex-row min-[490px]:items-center">
                <h3 class="text-dark text-lg font-semibold">Billing History</h3>
                <div>
                  <x-button class="subscription-btn mr-2 rounded-lg" size='small' variant='outline' type="button">
                    Download All Invoices
                  </x-button>
                </div>
              </div>
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
                        <td class="px-4 py-3 text-sm">{{ $payment->created_at->format('M d, Y') }}
                        </td>
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
              <form action="{{ route('settings.subscription.update-reminder') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="space-y-4">
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="text-dark font-medium">2 weeks reminder</p>
                      <p class="text-sm text-gray-600">Automatically remind me 2 weeks before
                        subscription expires</p>
                    </div>
                    <label class="toggle-switch">
                      <input
                        {{ old('auto_renewal', $currentUser->subsciption->days_reminder ?? true) ? 'checked' : '' }}
                        name="auto_renewal" type="checkbox" value="1">
                      <span class="toggle-slider"></span>
                    </label>
                  </div>
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="text-dark font-medium">2 days reminder</p>
                      <p class="text-sm text-gray-600">Remind me 2 days before subscription expires
                      </p>
                    </div>
                    <label class="toggle-switch">
                      <input
                        {{ old('email_receipts', $currentUser->subsciption->days_reminder ?? true) ? 'checked' : '' }}
                        name="email_receipts" type="checkbox" value="1">
                      <span class="toggle-slider"></span>
                    </label>
                  </div>
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
                    <x-button class="rounded-lg" size='small' type="submit" variant='primary'>
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
                    <x-button class="rounded-lg" size='small' type="submit" variant='primary'>
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
                    <x-button class="rounded-lg" size='small' type="submit" variant='primary'>
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
                    <x-button class="rounded-lg" size='small' type="submit" variant='danger'>
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
  <div class="fixed inset-0 z-[9999] hidden overflow-y-auto bg-black bg-opacity-50 backdrop-blur-sm"
        id="changePlanModal">
        <div
          class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <!-- Background overlay -->
          <div aria-hidden="true"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

          <!-- Modal panel -->
          <div
            class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
            <!-- Header -->
            <div class="border-b border-gray-200 bg-white px-6 py-4">
              <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-gray-900">Change Your Plan</h3>
                <button class="text-gray-400 hover:text-gray-600" onclick="closeChangePlanModal()"
                  type="button">
                  <i class="fas fa-times text-xl"></i>
                </button>
              </div>
              <p class="mt-1 text-sm text-gray-600">Choose the plan that works best for you</p>
            </div>

            <!-- Plans -->
            <div class="bg-white px-6 py-6">
              <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Free Plan -->
                <div
                  class="relative rounded-2xl border-2 border-gray-200 p-6 transition-all hover:border-purple-300 hover:shadow-lg">
                  <div class="flex items-center justify-between">
                    <h4 class="text-lg font-bold text-gray-900">Free Plan</h4>
                    <span
                      class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-800">Current</span>
                  </div>
                  <p class="mt-2 text-sm text-gray-600">Basic access to StyleHub features</p>
                  <div class="mt-4">
                    <span class="text-3xl font-bold text-gray-900">$0.00</span>
                    <span class="text-gray-600">/month</span>
                  </div>
                  <ul class="mt-6 space-y-3">
                    <li class="flex items-center text-sm text-gray-600">
                      <i class="fas fa-check mr-2 text-green-500"></i>
                      Basic wardrobe management
                    </li>
                    <li class="flex items-center text-sm text-gray-600">
                      <i class="fas fa-check mr-2 text-green-500"></i>
                      Up to 50 clothing items
                    </li>
                    <li class="flex items-center text-sm text-gray-600">
                      <i class="fas fa-check mr-2 text-green-500"></i>
                      Manual outfit creation
                    </li>
                    <li class="flex items-center text-sm text-gray-600">
                      <i class="fas fa-times mr-2 text-gray-400"></i>
                      AI outfit recommendations
                    </li>
                    <li class="flex items-center text-sm text-gray-600">
                      <i class="fas fa-times mr-2 text-gray-400"></i>
                      Advanced analytics
                    </li>
                  </ul>
                  <button
                    class="mt-6 w-full rounded-lg bg-gray-100 px-4 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-200"
                    onclick="selectPlan('free')" type="button">
                    {{ $currentUser->plan->name === 'Free' ? 'Current Plan' : 'Select Free Plan' }}
                  </button>
                </div>

                <!-- Premium Plan -->
                <div
                  class="relative rounded-2xl border-2 border-purple-500 p-6 transition-all hover:shadow-lg">
                  <div class="flex items-center justify-between">
                    <h4 class="text-lg font-bold text-gray-900">Premium Plan</h4>
                    <span
                      class="rounded-full bg-purple-100 px-3 py-1 text-xs font-medium text-purple-800">Popular</span>
                  </div>
                  <p class="mt-2 text-sm text-gray-600">Advanced features for fashion enthusiasts
                  </p>
                  <div class="mt-4">
                    <span class="text-3xl font-bold text-gray-900">$9.99</span>
                    <span class="text-gray-600">/month</span>
                  </div>
                  <ul class="mt-6 space-y-3">
                    <li class="flex items-center text-sm text-gray-600">
                      <i class="fas fa-check mr-2 text-green-500"></i>
                      Unlimited clothing items
                    </li>
                    <li class="flex items-center text-sm text-gray-600">
                      <i class="fas fa-check mr-2 text-green-500"></i>
                      AI outfit recommendations
                    </li>
                    <li class="flex items-center text-sm text-gray-600">
                      <i class="fas fa-check mr-2 text-green-500"></i>
                      Advanced style analytics
                    </li>
                    <li class="flex items-center text-sm text-gray-600">
                      <i class="fas fa-check mr-2 text-green-500"></i>
                      Weather-based suggestions
                    </li>
                    <li class="flex items-center text-sm text-gray-600">
                      <i class="fas fa-check mr-2 text-green-500"></i>
                      Priority support
                    </li>
                  </ul>
                  <button
                    class="mt-6 w-full rounded-lg bg-purple-600 px-4 py-3 text-sm font-medium text-white transition hover:bg-purple-700"
                    onclick="selectPlan('premium')" type="button">
                    {{ $currentUser->plan->name === 'Premium' ? 'Current Plan' : 'Upgrade to Premium' }}
                  </button>
                </div>
              </div>

              <!-- Additional Features Comparison -->
              <div class="mt-8 border-t border-gray-200 pt-6">
                <h5 class="text-sm font-semibold text-gray-900">All plans include:</h5>
                <div class="mt-3 grid grid-cols-2 gap-4 text-sm text-gray-600">
                  <div class="flex items-center">
                    <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                    Cross-platform sync
                  </div>
                  <div class="flex items-center">
                    <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                    Data backup
                  </div>
                  <div class="flex items-center">
                    <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                    Basic support
                  </div>
                  <div class="flex items-center">
                    <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                    Regular updates
                  </div>
                </div>
              </div>
            </div>

            
            <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">
              <div class="flex justify-end space-x-3">
                <button
                  class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                  onclick="closeChangePlanModal()" type="button">
                  Cancel
                </button>
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
    const quietHours = document.querySelector('input[name="quiet_hours"]');
    const quietHoursSettings = document.getElementById('quietHoursSettings');
    const avatarColorInput = document.getElementById('avatarColor');
    const changeEmailModal = document.getElementById('emailModal');
    const changePlanModal = document.getElementById('changePlanModal');

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
      const isQuietHoursEnabled = {{ $currentUser->quiet_hours ? 'true' : 'false' }};
      if (!isQuietHoursEnabled) {
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

    // Settings navigation - FIXED VERSION
    function initializeNavigation() {
      settingsNavBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          const targetSection = this.getAttribute('data-section');
          settingsNavBtns.forEach(b => {
            b.classList.remove('active');
          });
          this.classList.add('active');

          settingsSections.forEach(section => {
            section.classList.remove('active');
          });

          const targetElement = document.getElementById(`${targetSection}-section`);
          if (targetElement) {
            targetElement.classList.add('active');
          }
        });
      });
    }

    function createTagElement(value, container, updateFunction) {
      // Check if tag already exists
      const existingTag = container.querySelector(`[data-tag="${value}"]`);
      if (existingTag) return existingTag;

      const tag = document.createElement('span');
      tag.className = 'tag';
      tag.setAttribute('data-tag', value);
      tag.innerHTML =
        `${value.charAt(0).toUpperCase() + value.slice(1) } <span class="tag-remove" data-tag="${value}">&times;</span>`;

      const root = getComputedStyle(document.documentElement);
      const rgb = root.getPropertyValue('--primary-color-rgb').trim() || '159,122,234';
      const primary = root.getPropertyValue('--primary-color').trim() || '#9F7AEA';
      tag.style.backgroundColor = `rgba(${rgb}, 0.12)`;
      tag.style.color = primary;

      container.appendChild(tag);
      updateFunction();

      // Add remove functionality to new tag
      const removeBtn = tag.querySelector('.tag-remove');
      removeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        tag.remove();
        updateFunction();
      });

      return tag;
    }

    function initializeStyleTags() {
      if (!addStyleBtn || !styleInput || !styleTags) return;

      addStyleBtn.addEventListener('click', function() {
        const styleValue = styleInput.value.trim();
        if (styleValue && !styleTags.querySelector(`[data-tag="${styleValue}"]`)) {
          createTagElement(styleValue, styleTags, updateStyleTagsInput);
          styleInput.value = '';
        }
      });

      // Allow adding tags with Enter key
      styleInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          addStyleBtn.click();
        }
      });

      // Initialize existing tags removal
      initializeExistingTagRemoval();
    }

    function initializeCategoryTags() {
      if (!addCategoryBtn || !categoryInput || !categoryTags) return;

      addCategoryBtn.addEventListener('click', function() {
        const categoryValue = categoryInput.value.trim();
        if (categoryValue && !categoryTags.querySelector(`[data-tag="${categoryValue}"]`)) {
          createTagElement(categoryValue, categoryTags, updateCategoryTagsInput);
          categoryInput.value = '';
        }
      });

      // Allow adding tags with Enter key
      categoryInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          addCategoryBtn.click();
        }
      });
    }

    // Enhanced selection handlers with proper deselection
    function initializeSelectionHandlers() {
      // Theme selection
      document.querySelectorAll('.theme-option[data-theme]').forEach(option => {
        option.addEventListener('click', function() {
          const primaryColor = getComputedStyle(document.documentElement).getPropertyValue(
            '--primary-color').trim();
          const borderColor = getComputedStyle(document.documentElement).getPropertyValue(
            '--border-color').trim();

          // Remove active class and reset borders from all theme options
          document.querySelectorAll('.theme-option[data-theme]').forEach(o => {
            o.classList.remove('active');
            o.style.borderColor = borderColor; // Reset to default border color
          });

          // Add active class and set primary color border to clicked option
          this.classList.add('active');
          this.style.borderColor = primaryColor;

          const radio = this.querySelector('input[type="radio"]');
          if (radio) {
            radio.checked = true;
          }
        });
      });

      // Color scheme selection
      document.querySelectorAll('.color-scheme-option').forEach(option => {
        option.addEventListener('click', function() {
          const primaryColor = getComputedStyle(document.documentElement).getPropertyValue(
            '--primary-color').trim();
          const borderColor = getComputedStyle(document.documentElement).getPropertyValue(
            '--border-color').trim();

          // Remove active class and reset borders from all color scheme options
          document.querySelectorAll('.color-scheme-option').forEach(o => {
            o.classList.remove('active');
            o.style.borderColor = borderColor; // Reset to default border color
          });

          // Add active class and set primary color border to clicked option
          this.classList.add('active');
          this.style.borderColor = primaryColor;

          const radio = this.querySelector('input[type="radio"]');
          if (radio) {
            radio.checked = true;
          }
        });
      });

      // Body shape selection
      document.querySelectorAll('.theme-option[data-shape]').forEach(option => {
        option.addEventListener('click', function() {
          const primaryColor = getComputedStyle(document.documentElement).getPropertyValue(
            '--primary-color').trim();
          const borderColor = getComputedStyle(document.documentElement).getPropertyValue(
            '--border-color').trim();

          // Remove active class and reset borders from all body shape options
          document.querySelectorAll('.theme-option[data-shape]').forEach(o => {
            o.classList.remove('active');
            o.style.borderColor = borderColor; // Reset to default border color
          });

          // Add active class and set primary color border to clicked option
          this.classList.add('active');
          this.style.borderColor = primaryColor;

          const radio = this.querySelector('input[type="radio"]');
          if (radio) {
            radio.checked = true;
          }
        });
      });
    }

    // Function to initialize dynamic input colors
    function initializeDynamicInputColors() {
      const primaryColor = getComputedStyle(document.documentElement).getPropertyValue(
        '--primary-color').trim();
      const borderColor = getComputedStyle(document.documentElement).getPropertyValue(
        '--border-color').trim();

      // Add event listeners to all form inputs
      document.querySelectorAll('input, select, textarea').forEach(input => {
        // Remove any existing listeners to avoid duplicates
        input.removeEventListener('focus', handleInputFocus);
        input.removeEventListener('blur', handleInputBlur);
        input.removeEventListener('mouseenter', handleInputHover);
        input.removeEventListener('mouseleave', handleInputHoverEnd);

        // Add new listeners
        input.addEventListener('focus', handleInputFocus);
        input.addEventListener('blur', handleInputBlur);
        input.addEventListener('mouseenter', handleInputHover);
        input.addEventListener('mouseleave', handleInputHoverEnd);

        // Initialize current state - reset to default border
        if (input !== document.activeElement) {
          input.style.borderColor = borderColor;
          input.style.boxShadow = '';
        }
      });
    }

    function initializeExistingTagRemoval() {
      // Style tags removal
      document.querySelectorAll('#styleTags .tag-remove').forEach(removeBtn => {
        const clone = removeBtn.cloneNode(true);
        removeBtn.replaceWith(clone);
      });

      document.querySelectorAll('#styleTags .tag-remove').forEach(removeBtn => {
        removeBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          const tag = this.closest('.tag');
          if (tag) {
            tag.remove();
            updateStyleTagsInput();
          }
        });
      });

      // Category tags removal
      document.querySelectorAll('#categoryTags .tag-remove').forEach(removeBtn => {
        const clone = removeBtn.cloneNode(true);
        removeBtn.replaceWith(clone);
      });

      document.querySelectorAll('#categoryTags .tag-remove').forEach(removeBtn => {
        removeBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          const tag = this.closest('.tag');
          if (tag) {
            tag.remove();
            updateCategoryTagsInput();
          }
        });
      });
    }

    function handleInputFocus(event) {
      const input = event.target;
      const primaryColor = getComputedStyle(document.documentElement).getPropertyValue(
        '--primary-color').trim();
      input.style.borderColor = primaryColor;
      input.style.boxShadow = `0 0 0 2px rgba(var(--primary-color-rgb), 0.2)`;
    }

    function handleInputBlur(event) {
      const input = event.target;
      const borderColor = getComputedStyle(document.documentElement).getPropertyValue(
        '--border-color').trim();
      input.style.borderColor = borderColor;
      input.style.boxShadow = '';
    }

    function handleInputHover(event) {
      const input = event.target;
      if (input !== document.activeElement) {
        const primaryColor = getComputedStyle(document.documentElement).getPropertyValue(
          '--primary-color').trim();
        input.style.borderColor = primaryColor;
      }
    }

    function handleInputHoverEnd(event) {
      const input = event.target;
      if (input !== document.activeElement) {
        const borderColor = getComputedStyle(document.documentElement).getPropertyValue(
          '--border-color').trim();
        input.style.borderColor = borderColor;
      }
    }

    // ...existing code...
    function updateStyleTagsInput() {
      if (!styleTags) return;

      const form = styleTags.closest('form') || document.getElementById('profileForm') || document
        .body;

      let jsonInput = document.getElementById('styleTagsInput');
      if (!jsonInput) {
        jsonInput = document.createElement('input');
        jsonInput.type = 'hidden';
        jsonInput.name = 'style_tags';
        jsonInput.id = 'styleTagsInput';
        form.appendChild(jsonInput);
      }

      // Remove previously injected compatibility inputs so we can re-create them
      form.querySelectorAll('input.injected-style-tag').forEach(i => i.remove());
      // Also remove any server-rendered indexed inputs to avoid duplicates
      form.querySelectorAll('input[name^="style_tags["]').forEach(i => i.remove());

      // Collect current tags
      const tags = Array.from(styleTags.querySelectorAll('.tag'))
        .map(tag => {
          const raw = (tag.getAttribute('data-tag') || tag.textContent || '').replace('×', '')
            .trim();
          return raw ? (raw.charAt(0).toUpperCase() + raw.slice(1)) : '';
        })
        .filter(t => t.length > 0);

      // Always write canonical JSON (so you can also use it from JS)
      jsonInput.value = JSON.stringify(tags);

      // Inject backwards-compatible array inputs (style_tags[]) so Laravel gets an array
      if (tags.length > 0) {
        tags.forEach((t, i) => {
          const hi = document.createElement('input');
          hi.type = 'hidden';
          hi.name = 'style_tags[]';
          hi.value = t;
          hi.classList.add('injected-style-tag');
          form.appendChild(hi);
        });
      } else {
        // Ensure server still receives an array when there are no tags
        const empty = document.createElement('input');
        empty.type = 'hidden';
        empty.name = 'style_tags[]';
        empty.value = '';
        empty.classList.add('injected-style-tag');
        form.appendChild(empty);
      }
    }

    function updateCategoryTagsInput() {
      if (!categoryTags) return;

      const form = categoryTags.closest('form') || document.getElementById('wardrobeForm') || document
        .body;

      let jsonInput = document.getElementById('categoryTagsInput');
      if (!jsonInput) {
        jsonInput = document.createElement('input');
        jsonInput.type = 'hidden';
        jsonInput.name = 'clothing_categories';
        jsonInput.id = 'categoryTagsInput';
        form.appendChild(jsonInput);
      }

      // Remove previously injected compatibility inputs so we can re-create them
      form.querySelectorAll('input.injected-category-tag').forEach(i => i.remove());
      // Also remove any server-rendered indexed inputs to avoid duplicates
      form.querySelectorAll('input[name^="clothing_categories["]').forEach(i => i.remove());

      // Collect current tags
      const tags = Array.from(categoryTags.querySelectorAll('.tag'))
        .map(tag => {
          const raw = (tag.getAttribute('data-tag') || tag.textContent || '').replace('×', '')
            .trim();
          return raw ? (raw.charAt(0).toUpperCase() + raw.slice(1)) : '';
        })
        .filter(t => t.length > 0);

      // Always write canonical JSON (so you can also use it from JS)
      jsonInput.value = JSON.stringify(tags);

      // Inject backwards-compatible array inputs (style_tags[]) so Laravel gets an array
      if (tags.length > 0) {
        tags.forEach((t, i) => {
          const hi = document.createElement('input');
          hi.type = 'hidden';
          hi.name = 'clothing_categories[]';
          hi.value = t;
          hi.classList.add('injected-category-tag');
          form.appendChild(hi);
        });
      } else {
        // Ensure server still receives an array when there are no tags
        const empty = document.createElement('input');
        empty.type = 'hidden';
        empty.name = 'clothing_categories[]';
        empty.value = '';
        empty.classList.add('injected-category-tag');
        form.appendChild(empty);
      }
    }

    function updateProfileHeader() {
      const newName = document.getElementById('fullName').value;
      const profileHeaderName = document.getElementById('profileHeaderName');
      const profileHeaderAvatar = document.getElementById('profileHeaderAvatar');

      if (profileHeaderName) {
        profileHeaderName.textContent = newName;
      }
      if (profileHeaderAvatar) {
        profileHeaderAvatar.textContent = newName.charAt(0).toUpperCase();
      }

      // Update style tags in the profile header
      const styleTags = document.getElementById('styleTagsInput').value;
      if (styleTags) {
        const tagsArray = JSON.parse(styleTags);
        const tagsContainer = document.querySelector('.flex-wrap.gap-2'); // Adjust selector as needed

        if (tagsContainer) {
          // Clear existing tags
          tagsContainer.innerHTML = '';

          // Add new tags
          tagsArray.forEach(tag => {
            const tagElement = document.createElement('span');
            tagElement.className = 'bg-primary/20 text-primary rounded-full px-3 py-1 text-xs';
            tagElement.textContent = tag;
            tagsContainer.appendChild(tagElement);
          });
        }
      }
    }

    function updateToggleColors() {
      // Remove any inline styles and use CSS classes instead
      document.querySelectorAll('.toggle-slider').forEach(slider => {
        const input = slider.previousElementSibling;

        // Remove any existing inline styles
        slider.style.backgroundColor = '';

        // Use classes to control active state
        if (input.checked) {
          slider.classList.add('active');
        } else {
          slider.classList.remove('active');
        }
      });
    }

    // Email Modal Functions
    function openEmailModal() {
      document.getElementById("emailModal").classList.remove("hidden");
      document.getElementById("otpSection").classList.add("hidden");

      // Reset all states
      document.getElementById("emailError").classList.add("hidden");
      document.getElementById("otpError").classList.add("hidden");
      document.getElementById("modal_email").readOnly = false;

      // Reset buttons to initial state
      document.getElementById("requestOtpBtn").classList.remove("hidden");
      document.getElementById("verifyOtpBtn").classList.add("hidden");
      document.getElementById("requestOtpBtn").disabled = false;
      document.getElementById("requestOtpBtn").innerText = "Send Verification Code";

      // Clear form
      document.getElementById("emailChangeForm").reset();

      // Focus on email input
      setTimeout(() => {
        document.getElementById("modal_email").focus();
      }, 100);
    }

    function requestOtp() {
      let email = document.getElementById("modal_email").value.trim();
      let btn = document.getElementById("requestOtpBtn");
      let emailError = document.getElementById("emailError");

      // Basic client-side validation
      if (!email) {
        emailError.textContent = 'Please enter an email address';
        emailError.classList.remove("hidden");
        return;
      }

      if (!isValidEmail(email)) {
        emailError.textContent = 'Please enter a valid email address';
        emailError.classList.remove("hidden");
        return;
      }

      btn.disabled = true;
      btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';

      fetch("{{ route('settings.profile.update') }}", {
          method: "PATCH",
          headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json",
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            email: email
          })
        })
        .then(async response => {
          const data = await response.json();

          if (!response.ok) {
            // Handle validation errors
            if (data.errors?.email) {
              emailError.textContent = data.errors.email[0];
              emailError.classList.remove("hidden");
              showToast(data.errors.email[0], "error");
            } else {
              emailError.textContent = 'Failed to send verification code. Please try again.';
              emailError.classList.remove("hidden");
              showToast('Failed to send verification code. Please try again.', "error");
            }
            btn.disabled = false;
            btn.innerHTML = 'Send Verification Code';
            return;
          }

          // Success - show OTP section
          showToast(data.message || 'Verification code sent to your email.', 'success');
          emailError.classList.add("hidden");

          // Show OTP section and update UI
          document.getElementById("otpSection").classList.remove("hidden");
          document.getElementById("targetEmail").textContent = email;
          document.getElementById("modal_email").readOnly = true;

          // Switch buttons
          document.getElementById("requestOtpBtn").classList.add("hidden");
          document.getElementById("verifyOtpBtn").classList.remove("hidden");

          // Focus on OTP input
          setTimeout(() => {
            document.getElementById("modal_otp").focus();
          }, 100);
        })
        .catch(error => {
          console.error('Error:', error);
          emailError.textContent = 'Network error. Please check your connection and try again.';
          emailError.classList.remove("hidden");
          showToast('Network error. Please try again.', "error");
          btn.disabled = false;
          btn.innerHTML = 'Send Verification Code';
        });
    }

    function verifyOtp() {
      let email = document.getElementById("modal_email").value;
      let otp_code = document.getElementById("modal_otp").value.trim();
      let btn = document.getElementById("verifyOtpBtn");
      let otpError = document.getElementById("otpError");

      // Basic OTP validation
      if (!otp_code) {
        otpError.textContent = 'Please enter the verification code';
        otpError.classList.remove("hidden");
        return;
      }

      if (otp_code.length !== 6 || !/^\d+$/.test(otp_code)) {
        otpError.textContent = 'Please enter a valid 6-digit code';
        otpError.classList.remove("hidden");
        return;
      }

      btn.disabled = true;
      btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Verifying...';

      fetch("{{ route('settings.profile.update') }}", {
          method: "PATCH",
          headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json",
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            email: email,
            otp_code: otp_code
          })
        })
        .then(async response => {
          const data = await response.json();

          if (!response.ok) {
            // Handle OTP verification errors
            if (data.errors?.otp_code) {
              otpError.textContent = data.errors.otp_code[0];
              otpError.classList.remove("hidden");
              showToast(data.errors.otp_code[0], "error");
            } else {
              otpError.textContent = 'Verification failed. Please try again.';
              otpError.classList.remove("hidden");
              showToast('Verification failed. Please try again.', "error");
            }
            btn.disabled = false;
            btn.innerHTML = 'Verify';
            return;
          }

          // Success - email updated
          showToast(data.message || 'Email updated successfully!', 'success');

          // Close modal
          closeEmailModal();

          // Refresh the page to show updated email after a short delay
          setTimeout(() => {
            window.location.reload();
          }, 1500);
        })
        .catch(error => {
          console.error('Error:', error);
          otpError.textContent = 'Network error. Please check your connection and try again.';
          otpError.classList.remove("hidden");
          showToast('Network error. Please try again.', "error");
          btn.disabled = false;
          btn.innerHTML = 'Verify';
        });
    }

    function closeEmailModal() {
      document.getElementById("emailModal").classList.add("hidden");

      // Reset form and UI state
      document.getElementById("emailChangeForm").reset();
      document.getElementById("otpSection").classList.add("hidden");
      document.getElementById("emailError").classList.add("hidden");
      document.getElementById("otpError").classList.add("hidden");
      document.getElementById("modal_email").readOnly = false;

      // Reset buttons
      document.getElementById("requestOtpBtn").classList.remove("hidden");
      document.getElementById("verifyOtpBtn").classList.add("hidden");
      document.getElementById("requestOtpBtn").disabled = false;
      document.getElementById("requestOtpBtn").innerHTML = 'Send Verification Code';
      document.getElementById("verifyOtpBtn").disabled = false;
      document.getElementById("verifyOtpBtn").innerHTML = 'Verify';
    }

    // Utility function for email validation
    function isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }

    // Change Plan Modal Functions
    function openChangePlanModal() {
      document.getElementById('changePlanModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeChangePlanModal() {
      document.getElementById('changePlanModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }

    function selectPlan(plan) {
      const currentPlan = '{{ strtolower($currentUser->plan->name ?? 'free') }}';

      if (plan === currentPlan) {
        showToast('You are already on this plan!', 'info');
        return;
      }

      // Show loading state
      showToast(`Processing your ${plan} plan selection...`, 'info');

      // Here you would typically make an API call to handle the plan change
      // For now, we'll simulate the process
      simulatePlanChange(plan);
    }

    function simulatePlanChange(plan) {
      // Simulate API call delay
      setTimeout(() => {
        if (plan === 'premium') {
          // Redirect to payment page or show payment form
          showToast('Redirecting to secure payment...', 'success');
          // In a real implementation, you would redirect to Stripe or your payment processor
          // window.location.href = '/billing/upgrade';
        } else {
          // Downgrade to free plan
          showToast('Plan changed successfully!', 'success');
          closeChangePlanModal();
          // Refresh the page to show updated plan
          setTimeout(() => {
            window.location.reload();
          }, 1500);
        }
      }, 1000);
    }

    // Theme selection
    themeOptions.forEach(option => {
      option.addEventListener('click', function() {
        const theme = this.getAttribute('data-theme');

        // Update visual selection
        document.querySelectorAll('.theme-option[data-theme]').forEach(o => {
          o.classList.remove('active');
        });
        this.classList.add('active');

        // Update radio button
        const radio = this.querySelector('input[type="radio"]');
        if (radio) {
          radio.checked = true;
        }

        // Apply theme visually (preview)
        if (window.themeManager) {
          window.themeManager.setTheme(theme);
        }

        if (window.playThemeTransition) {
          window.playThemeTransition();
        }
      });
    });

    // Color scheme selection
    colorSchemeOptions.forEach(option => {
      option.addEventListener('click', function() {
        const scheme = this.getAttribute('data-scheme');

        // Update visual selection
        document.querySelectorAll('.color-scheme-option').forEach(o => {
          o.classList.remove('active');
        });
        this.classList.add('active');

        // Update radio button
        const radio = this.querySelector('input[type="radio"]');
        if (radio) {
          radio.checked = true;
        }

        // Apply color scheme visually (preview)
        if (window.themeManager) {
          window.themeManager.setColorScheme(scheme);
        }
      });
    });


    // Body shape selection - FIXED VERSION
    function initializeBodyShapeSelection() {
      const bodyShapeOptions = document.querySelectorAll('.theme-option[data-shape]');
      const primaryColor = getComputedStyle(document.documentElement).getPropertyValue(
        '--primary-color').trim();
      const borderColor = getComputedStyle(document.documentElement).getPropertyValue(
        '--border-color').trim();

      bodyShapeOptions.forEach(option => {
        const radio = option.querySelector('input[type="radio"]');
        if (!radio) return;

        if (radio.checked) {
          option.classList.add('active');
          option.style.borderColor = primaryColor;
        } else {
          option.classList.remove('active');
          option.style.borderColor = borderColor;
        }

        option.addEventListener('click', function() {
          // Remove active class and reset borders from all body shape options
          bodyShapeOptions.forEach(o => {
            o.classList.remove('active');
            o.style.borderColor = borderColor;
            o.querySelector('input[type="radio"]').checked = false;
          });

          // Add active class and set primary color border to clicked option
          this.classList.add('active');
          this.style.borderColor = primaryColor;
          this.querySelector('input[type="radio"]').checked = true;
        });
      });
    };

    const highContrastToggle = document.querySelector('input[name="high_contrast"]');
    if (highContrastToggle) {
      highContrastToggle.addEventListener('change', function() {
        const previewEnabled = this.checked;
        document.documentElement.setAttribute('data-high-contrast', previewEnabled);
        updateToggleColors();
      });
    }

    document.querySelectorAll('.toggle-switch input[type="checkbox"]').forEach(cb => {
      const slider = cb.nextElementSibling;
      // initialize
      cb.value = cb.checked ? '1' : '0';
      if (slider) slider.classList.toggle('active', cb.checked);

      cb.addEventListener('change', () => {
        cb.value = cb.checked ? '1' : '0';
        if (slider) slider.classList.toggle('active', cb.checked);
      });
    });

    // Auto-archive toggle functionality (UI only)
    function initializeAutoArchiveToggle() {
      const autoArchive = document.getElementById('autoArchive');
      const archiveAfter = document.getElementById('archiveAfter');

      if (autoArchive && archiveAfter) {
        autoArchive.addEventListener('change', function() {
          archiveAfter.disabled = !this.checked;
          if (!this.checked) {
            archiveAfter.value = '';
          }
        });

        // Initialize state on page load
        archiveAfter.disabled = !autoArchive.checked;
      }
    }

    function resetAllSelectionBorders() {
      const borderColor = getComputedStyle(document.documentElement).getPropertyValue(
        '--border-color').trim();

      // Reset all non-active selection options
      document.querySelectorAll('.theme-option:not(.active), .color-scheme-option:not(.active)')
        .forEach(element => {
          element.style.borderColor = borderColor;
        });

      // Update active selections with current primary color
      const primaryColor = getComputedStyle(document.documentElement).getPropertyValue(
        '--primary-color').trim();
      document.querySelectorAll('.theme-option.active, .color-scheme-option.active').forEach(
        element => {
          element.style.borderColor = primaryColor;
        });
    }

    /// Reset form to server state on page load - FIXED VERSION
    function resetFormToServerState() {
      // Only reset high contrast, not themes and color schemes
      const serverHighContrast = {{ $currentUser->high_contrast ? 'true' : 'false' }};

      // Reset high contrast toggle only
      const highContrastToggle = document.querySelector('input[name="high_contrast"]');
      if (highContrastToggle) {
        highContrastToggle.checked = serverHighContrast;
      }

      // Don't reset themes and color schemes - let ThemeManager handle them
      // They are auto-saved and should reflect the current state

      // Update high contrast visual state to match server
      if (window.themeManager) {
        window.themeManager.setHighContrast(serverHighContrast);
      }
    }

    // Handle form reset to sync with actual state
    // Handle app preferences form submission
    const appPreferencesForm = document.getElementById('appPreferencesForm');
    if (appPreferencesForm) {
      appPreferencesForm.addEventListener('submit', function(e) {
        // Form will submit normally, changes will be saved to database
        // The page will reload and show the updated state

        // Optional: Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
        }
      });
    }

    // Call this when color scheme changes
    document.addEventListener('colorSchemeChanged', updateToggleColors);
    document.addEventListener('themeChanged', updateToggleColors);

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

    // Synchronize theme with database on page load
    function synchronizeWithDatabase() {
      // Get database values from server
      const dbTheme = '{{ $currentUser->theme ?? 'light' }}';
      const dbColorScheme = '{{ $currentUser->color_scheme ?? 'primary' }}';
      const dbHighContrast = {{ $currentUser->high_contrast ? 'true' : 'false' }};
      // const dbBodyShape = '{{ $currentUser->body_shape ?? '' }}'

      // Update ThemeManager with database values
      if (window.themeManager) {
        window.themeManager.setTheme(dbTheme);
        window.themeManager.setColorScheme(dbColorScheme);
        window.themeManager.setHighContrast(dbHighContrast);
      }

      // Update form fields to match database values
      document.querySelectorAll('input[name="theme"]').forEach(radio => {
        radio.checked = (radio.value === dbTheme);
        const parentOption = radio.closest('.theme-option');
        if (parentOption) {
          if (radio.value === dbTheme) {
            parentOption.classList.add('active');
          } else {
            parentOption.classList.remove('active');
          }
        }
      });

      document.querySelectorAll('input[name="color_scheme"]').forEach(radio => {
        radio.checked = (radio.value === dbColorScheme);
        const parentOption = radio.closest('.color-scheme-option');
        if (parentOption) {
          if (radio.value === dbColorScheme) {
            parentOption.classList.add('active');
          } else {
            parentOption.classList.remove('active');
          }
        }
      });

      // const primaryColor = getComputedStyle(document.documentElement).getPropertyValue(
      //   '--primary-color').trim();
      // console.log(primaryColor);
      // const borderColor = getComputedStyle(document.documentElement).getPropertyValue(
      //   '--border-color').trim();

      // document.querySelectorAll('.theme-option[data-shape]').forEach(option => {
      //   const radio = option.querySelector('input[type="radio"]');
      //   if (!radio) return;

      //   radio.checked = (radio.value === dbBodyShape);
      //   // set checked based on DB value

      //   if (radio.checked) {
      //     option.classList.add('active');
      //     option.style.borderColor = primaryColor;
      //   } else {
      //     option.classList.remove('active');
      //     option.style.borderColor = borderColor;
      //   }
      // });

      const highContrastToggle = document.querySelector('input[name="high_contrast"]');
      if (highContrastToggle) {
        highContrastToggle.checked = dbHighContrast;
      }
    }

    // function enforceBodyShapeActive() {
    //   const primaryColor = getComputedStyle(document.documentElement).getPropertyValue(
    //     '--primary-color').trim();
    //   const borderColor = getComputedStyle(document.documentElement).getPropertyValue(
    //     '--border-color').trim();
    //   document.querySelectorAll('.theme-option[data-shape]').forEach(option => {
    //     const radio = option.querySelector('input[type="radio"]');
    //     if (!radio) return;
    //     if (radio.checked) {
    //       option.classList.add('active');
    //       option.style.borderColor = primaryColor;
    //     } else {
    //       option.classList.remove('active');
    //       option.style.borderColor = borderColor;
    //     }
    //   });
    // }

    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
      const forms = document.querySelectorAll('form');

      forms.forEach(form => {
        form.addEventListener('submit', function() {
          const submitBtn = this.querySelector('button[type="submit"]');
          if (submitBtn) {
            // Simple loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
          }
        });
      });
      // Initialize navigation first
      initializeNavigation();

      // Initialize other functionality
      initializeStyleTags();
      initializeCategoryTags();
      initializeExistingTagRemoval();
      initializeBodyShapeSelection();

      updateStyleTagsInput();
      updateCategoryTagsInput();

      setTimeout(updateToggleColors, 100);

      initializeSelectionHandlers();



      // Initialize dynamic input colors
      setTimeout(() => {
        initializeDynamicInputColors();
        resetAllSelectionBorders(); // Reset all borders on load

        // Set active element borders
        const primaryColor = getComputedStyle(document.documentElement)
          .getPropertyValue('--primary-color').trim();
        document.querySelectorAll('.theme-option.active, .color-scheme-option.active')
          .forEach(activeElement => {
            activeElement.style.borderColor = primaryColor;
          });
      }, 200);

      // Re-initialize when color scheme changes
      document.addEventListener('colorSchemeChanged', function() {
        setTimeout(() => {
          initializeDynamicInputColors();
          resetAllSelectionBorders();
        }, 100);
      });

      document.addEventListener('themeChanged', function() {
        setTimeout(() => {
          initializeDynamicInputColors();
          resetAllSelectionBorders();
        }, 100);
      });

      // setTimeout(() => {
      //   if (window.themeManager) {
      //     window.themeManager.syncHighContrastState();
      //   }
      // }, 200);

      // // Add beforeunload listener to handle page refresh
      // window.addEventListener('beforeunload', function() {
      //   if (window.themeManager) {
      //     window.themeManager.syncHighContrastState();
      //   }
      // });

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

      @if (session('success'))
        showToast("{{ session('success') }}", 'success');
      @endif

      // Check for general errors
      @if ($errors->any())
        // Show first error only to avoid spam
        showToast("{{ $errors->first() }}", 'error');
      @endif

      const emailInput = document.getElementById('modal_email');
      if (emailInput) {
        emailInput.addEventListener('keypress', function(e) {
          if (e.key === 'Enter') {
            e.preventDefault();
            requestOtp();
          }
        });
      }

      const otpInput = document.getElementById('modal_otp');
      if (otpInput) {
        otpInput.addEventListener('keypress', function(e) {
          if (e.key === 'Enter') {
            e.preventDefault();
            verifyOtp();
          }
        });

        // Auto-advance and format OTP input
        otpInput.addEventListener('input', function(e) {
          // Remove non-digits
          this.value = this.value.replace(/\D/g, '');

          // Auto-submit when 6 digits are entered
          if (this.value.length === 6) {
            verifyOtp();
          }
        });
      }

      // Close modal when clicking outside
      document.addEventListener('click', function(e) {
        // if (e.target === modal) {
        //   closeChangePlanModal();
        // }
        switch (e.target) {
          case changeEmailModal:
            closeEmailModal();
            break;
          case changePlanModal:
            closeChangePlanModal();
            break;
        }
      });
      // const emailModal = document.getElementById('emailModal');
      // if (emailModal) {
      //   emailModal.addEventListener('click', function(e) {
      //     if (e.target === this) {
      //       closeEmailModal();
      //     }
      //   });
      // }

      // Close modal with Escape key
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !changeEmailModal.classList.contains('hidden')) {
          closeEmailModal();
        }
        if (e.key === 'Escape' && !changePlanModal.classList.contains('hidden')) {
          closeChangePlanModal();
        }
      });

      // setTimeout(() => {
      //   synchronizeWithDatabase();

      //   setTimeout(enforceBodyShapeActive(), 120)
      // }, 100);
    });

    // Form submission handling (optional - for debugging)
    // document.querySelectorAll('form').forEach(form => {
    //   form.addEventListener('submit', function(e) {
    //   });
    // });
  </script>
@endpush
