@extends('layouts.dashboard')
@section('page_title', 'Settings')
@section('title', 'Settings')
@push('styles')
  <style>
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

    /* Settings specific styles */
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
      width: 2rem;
      height: 2rem;
      border-radius: 50%;
      cursor: pointer;
      border: 2px solid transparent;
      transition: all 0.3s ease;
    }

    .color-scheme-option.active {
      border-color: #2D3748;
      transform: scale(1.1);
    }

    .toggle-switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 24px;
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

    /* NEW STYLES FOR RESPONSIVE SETTINGS LAYOUT */
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

    /* Responsive behavior for settings navigation */

    /* Below 640px: No sidebar, all content visible with section headers */
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
    }

    /* 640px - 1023px: Sidebar with icons only, hover expands above content */
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

      /* Hover expansion for single item */
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
    }

    /* Large devices (>=1024px) full sidebar with reduced padding */
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
    }

    /* Section headers for mobile */
    .section-header {
      display: none;
    }

    /* Settings sections */
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
      <div class="flex flex-col items-center gap-6 md:flex-row md:items-start">
        <div class="relative">
          <div
            class="bg-primary flex h-24 w-24 items-center justify-center rounded-full text-2xl font-bold text-white"
            id="profileHeaderAvatar">
            U
          </div>
          <button class="bg-secondary absolute bottom-0 right-0 h-8 w-8 rounded-full text-white"
            id="changeAvatarBtn">
            <i class="fas fa-camera text-sm"></i>
          </button>
        </div>
        <div class="flex-1 text-center md:text-left">
          <h2 class="text-dark mb-2 text-2xl font-bold" id="profileHeaderName">User Name</h2>
          <div class="flex flex-wrap justify-center gap-2 md:justify-start">
            <span class="bg-primary/20 text-primary rounded-full px-3 py-1 text-xs">Fashion
              Enthusiast</span>
            <span
              class="bg-secondary/20 text-secondary rounded-full px-3 py-1 text-xs">Minimalist</span>
            <span class="bg-accent/20 text-accent rounded-full px-3 py-1 text-xs">Active Wear</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 gap-4 text-sm sm:grid-cols-2 max-w-2xl">
        <div class="mx-auto w-full max-w-md rounded-xl bg-gray-50 p-4">
          <h4 class="text-dark mb-2 font-bold">Account Information</h4>
          <div class="space-y-2">
            <div class="flex justify-between">
              <span class="text-gray-600">Email:</span>
              <span class="font-medium">user@example.com</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Phone:</span>
              <span class="font-medium">+1 (555) 123-4567</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Member Since:</span>
              <span class="font-medium">Jan 2022</span>
            </div>
          </div>
        </div>
        <div class="mx-auto w-full max-w-md rounded-xl bg-gray-50 p-4">
          <h4 class="text-dark mb-2 font-bold">Subscription</h4>
          <div class="space-y-2">
            <div class="flex justify-between">
              <span class="text-gray-600">Plan:</span>
              <span class="font-medium">Premium</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Renewal:</span>
              <span class="font-medium">Dec 15, 2023</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Status:</span>
              <span class="text-success font-medium">Active</span>
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
        <!-- Section headers for mobile -->
        <div class="section-header" id="profile-header">
          <i class="fas fa-user"></i>
          <h2 class="text-xl font-bold">Edit Profile</h2>
        </div>

        <!-- Profile Settings -->
        <div class="settings-section active mb-6 rounded-2xl bg-white p-6 shadow-lg"
          id="profile-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-user text-primary mr-3"></i> Edit Profile
          </h2>

          <div class="space-y-6">
            <!-- Personal Information -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Personal Information</h3>
              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Full Name</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="fullName" placeholder="Enter your full name" type="text"
                    value="User Name">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Display Name</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="displayName" placeholder="Enter display name" type="text"
                    value="User Name">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Email Address</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="email" placeholder="Enter email address" type="email"
                    value="user@example.com">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Phone Number</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="phone" placeholder="Enter phone number" type="tel"
                    value="+1 (555) 123-4567">
                </div>
              </div>
            </div>

            <!-- Profile Avatar -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Profile Avatar</h3>
              <div class="flex flex-col items-center gap-6 md:flex-row">
                <div class="relative">
                  <div
                    class="bg-primary flex h-20 w-20 items-center justify-center rounded-full text-xl font-bold text-white"
                    id="profileAvatarPreview">
                    U
                  </div>
                  <button class="bg-secondary absolute bottom-0 right-0 rounded-full p-1 text-white"
                    id="changeAvatarBtn2">
                    <i class="fas fa-camera text-xs"></i>
                  </button>
                </div>
                <div class="flex-1">
                  <p class="mb-4 text-sm text-gray-600">Upload a profile picture or choose an avatar
                    color</p>
                  <div class="flex space-x-2">
                    <div
                      class="bg-primary profile-color active h-8 w-8 cursor-pointer rounded-full border-2 border-white shadow-md"
                      data-color="primary"></div>
                    <div
                      class="bg-secondary profile-color h-8 w-8 cursor-pointer rounded-full border-2 border-white shadow-md"
                      data-color="secondary"></div>
                    <div
                      class="bg-accent profile-color h-8 w-8 cursor-pointer rounded-full border-2 border-white shadow-md"
                      data-color="accent"></div>
                    <div
                      class="bg-success profile-color h-8 w-8 cursor-pointer rounded-full border-2 border-white shadow-md"
                      data-color="success"></div>
                    <div
                      class="profile-color h-8 w-8 cursor-pointer rounded-full border-2 border-white bg-yellow-500 shadow-md"
                      data-color="yellow-500"></div>
                  </div>
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
                  id="bio" placeholder="Tell us about yourself..." rows="3">Fashion enthusiast with a minimalist approach to style. Love experimenting with different looks while keeping things simple and elegant.</textarea>
              </div>
              <div class="mt-4">
                <label class="mb-2 block text-sm font-medium text-gray-700">Style Tags</label>
                <div class="mb-4 flex flex-col items-start">
                  <div class='mb-5 flex flex-wrap gap-2' id="styleTags">
                    <span class="tag">Minimalist <span class="tag-remove"
                        data-tag="Minimalist">&times;</span></span>
                    <span class="tag">Casual <span class="tag-remove"
                        data-tag="Casual">&times;</span></span>
                    <span class="tag">Active Wear <span class="tag-remove"
                        data-tag="Active Wear">&times;</span></span>
                    <span class="tag">Formal <span class="tag-remove"
                        data-tag="Formal">&times;</span></span>
                  </div>
                  <div class="flex w-full flex-col gap-4">
                    <input
                      class="focus:ring-primary flex-grow rounded-lg border-0 bg-gray-100 px-4 py-2 focus:outline-none focus:ring-2"
                      id="styleInput" placeholder="Add a style tag..." type="text">
                    <button
                      class="bg-primary w-fit rounded-lg px-4 py-2 font-medium text-white transition hover:bg-purple-700"
                      id="addStyleBtn">Add</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex justify-end">
              <button
                class="bg-primary rounded-lg px-6 py-3 font-medium text-white transition hover:bg-purple-700"
                id="saveProfileBtn">
                Save Changes
              </button>
            </div>
          </div>
        </div>

        <!-- Section headers for mobile -->
        <div class="section-header" id="wardrobe-header">
          <i class="fas fa-archive"></i>
          <h2 class="text-xl font-bold">Wardrobe Settings</h2>
        </div>

        <!-- Wardrobe Settings -->
        <div class="settings-section mb-6 rounded-2xl bg-white p-6 shadow-lg" id="wardrobe-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-archive text-primary mr-3"></i> Wardrobe Settings
          </h2>

          <div class="space-y-6">
            <!-- Laundry Settings -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Laundry Settings</h3>
              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Default Laundry
                    Duration</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="laundryDuration">
                    <option value="1">1 day (High urgency)</option>
                    <option selected value="2">2 days (Medium urgency)</option>
                    <option value="3">3 days (Low urgency)</option>
                    <option value="5">5 days (Very low urgency)</option>
                  </select>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Laundry
                    Reminder</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="laundryReminder">
                    <option value="1">1 day before due</option>
                    <option selected value="2">2 days before due</option>
                    <option value="3">3 days before due</option>
                    <option value="0">No reminders</option>
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
                  <input id="autoArchive" type="checkbox">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="mt-4">
                <label class="mb-2 block text-sm font-medium text-gray-700">Archive after
                  (months)</label>
                <input
                  class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                  disabled id="archiveAfter" max="24" min="1" type="number"
                  value="6">
              </div>
            </div>

            <!-- Clothing Categories -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Clothing Categories</h3>
              <p class="mb-4 text-sm text-gray-600">Customize the categories used to organize your
                wardrobe</p>
              <div class="mb-4 flex flex-col items-start">
                <div class='mb-5 flex flex-wrap gap-2' id="categoryTags">
                  <span class="tag">Tops <span class="tag-remove"
                      data-tag="Tops">&times;</span></span>
                  <span class="tag">Bottoms <span class="tag-remove"
                      data-tag="Bottoms">&times;</span></span>
                  <span class="tag">Dresses <span class="tag-remove"
                      data-tag="Dresses">&times;</span></span>
                  <span class="tag">Outerwear <span class="tag-remove"
                      data-tag="Outerwear">&times;</span></span>
                  <span class="tag">Shoes <span class="tag-remove"
                      data-tag="Shoes">&times;</span></span>
                  <span class="tag">Accessories <span class="tag-remove"
                      data-tag="Accessories">&times;</span></span>
                </div>
                <div class="flex w-full flex-col gap-4">
                  <input
                    class="focus:ring-primary flex-grow rounded-lg border-0 bg-gray-100 px-4 py-2 focus:outline-none focus:ring-2"
                    id="categoryInput" placeholder="Add a category..." type="text">
                  <button
                    class="bg-primary w-fit rounded-lg px-4 py-2 font-medium text-white transition hover:bg-purple-700"
                    id="addCategoryBtn">Add</button>
                </div>
              </div>
            </div>
            <div class="flex justify-end">
              <button
                class="bg-primary rounded-lg px-6 py-3 font-medium text-white transition hover:bg-purple-700"
                id="saveWardrobeBtn">
                Save Changes
              </button>
            </div>
          </div>
        </div>

        <!-- Section headers for mobile -->
        <div class="section-header" id="body-header">
          <i class="fas fa-user"></i>
          <h2 class="text-xl font-bold">Body Customizations</h2>
        </div>

        <!-- Body Customizations -->
        <div class="settings-section mb-6 rounded-2xl bg-white p-6 shadow-lg" id="body-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-user text-primary mr-3"></i> Body Customizations
          </h2>

          <div class="space-y-6">
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
                    id="height" placeholder="Enter height" type="number" value="170">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Weight (kg)</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="weight" placeholder="Enter weight" type="number" value="65">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Chest/Bust (cm)</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="chest" placeholder="Enter chest measurement" type="number"
                    value="90">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Waist (cm)</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="waist" placeholder="Enter waist measurement" type="number"
                    value="75">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Hips (cm)</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="hips" placeholder="Enter hip measurement" type="number"
                    value="95">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Inseam (cm)</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="inseam" placeholder="Enter inseam measurement" type="number"
                    value="78">
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
                    id="topFit">
                    <option value="slim">Slim Fit</option>
                    <option selected value="regular">Regular Fit</option>
                    <option value="relaxed">Relaxed Fit</option>
                    <option value="oversized">Oversized</option>
                  </select>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Bottom Fit</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="bottomFit">
                    <option value="skinny">Skinny</option>
                    <option value="slim">Slim</option>
                    <option selected value="regular">Regular</option>
                    <option value="relaxed">Relaxed</option>
                  </select>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Sleeve Length</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="sleeveLength">
                    <option value="short">Short Sleeve</option>
                    <option selected value="long">Long Sleeve</option>
                    <option value="any">Any Length</option>
                  </select>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Pant Length</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="pantLength">
                    <option value="ankle">Ankle Length</option>
                    <option selected value="regular">Regular Length</option>
                    <option value="long">Long Length</option>
                    <option value="any">Any Length</option>
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
                <div class="theme-option active text-center" data-shape="hourglass">
                  <div
                    class="bg-primary/20 mx-auto mb-2 flex h-16 w-16 items-center justify-center rounded-full">
                    <i class="fas fa-user text-primary"></i>
                  </div>
                  <p class="font-medium">Hourglass</p>
                </div>
                <div class="theme-option text-center" data-shape="rectangle">
                  <div
                    class="bg-primary/20 mx-auto mb-2 flex h-16 w-16 items-center justify-center rounded-full">
                    <i class="fas fa-user text-primary"></i>
                  </div>
                  <p class="font-medium">Rectangle</p>
                </div>
                <div class="theme-option text-center" data-shape="pear">
                  <div
                    class="bg-primary/20 mx-auto mb-2 flex h-16 w-16 items-center justify-center rounded-full">
                    <i class="fas fa-user text-primary"></i>
                  </div>
                  <p class="font-medium">Pear</p>
                </div>
                <div class="theme-option text-center" data-shape="apple">
                  <div
                    class="bg-primary/20 mx-auto mb-2 flex h-16 w-16 items-center justify-center rounded-full">
                    <i class="fas fa-user text-primary"></i>
                  </div>
                  <p class="font-medium">Apple</p>
                </div>
              </div>
            </div>
            <div class="flex justify-end">
              <button
                class="bg-primary rounded-lg px-6 py-3 font-medium text-white transition hover:bg-purple-700"
                id="saveBodyBtn">
                Save Changes
              </button>
            </div>
          </div>
        </div>

        <!-- Section headers for mobile -->
        <div class="section-header" id="app-header">
          <i class="fas fa-palette"></i>
          <h2 class="text-xl font-bold">App Preferences</h2>
        </div>

        <!-- App Preferences -->
        <div class="settings-section mb-6 rounded-2xl bg-white p-6 shadow-lg" id="app-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-palette text-primary mr-3"></i> App Preferences
          </h2>

          <div class="space-y-6">
            <!-- Theme Settings -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Theme Settings</h3>
              <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="theme-option active text-center" data-theme="light">
                  <div
                    class="mx-auto mb-2 flex h-16 w-16 items-center justify-center rounded-lg bg-gray-200">
                    <i class="fas fa-sun text-yellow-500"></i>
                  </div>
                  <p class="font-medium">Light</p>
                </div>
                <div class="theme-option text-center" data-theme="dark">
                  <div
                    class="mx-auto mb-2 flex h-16 w-16 items-center justify-center rounded-lg bg-gray-800">
                    <i class="fas fa-moon text-white"></i>
                  </div>
                  <p class="font-medium">Dark</p>
                </div>
                <div class="theme-option text-center" data-theme="auto">
                  <div
                    class="mx-auto mb-2 flex h-16 w-16 items-center justify-center rounded-lg bg-gradient-to-r from-gray-200 to-gray-800">
                    <i class="fas fa-adjust text-gray-700"></i>
                  </div>
                  <p class="font-medium">Auto</p>
                </div>
              </div>

              <div class="flex items-center justify-between">
                <div>
                  <p class="text-dark font-medium">High contrast mode</p>
                  <p class="text-sm text-gray-600">Increase contrast for better visibility</p>
                </div>
                <label class="toggle-switch">
                  <input id="highContrast" type="checkbox">
                  <span class="toggle-slider"></span>
                </label>
              </div>
            </div>

            <!-- Color Scheme -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Color Scheme</h3>
              <p class="mb-4 text-sm text-gray-600">Choose a color scheme for the app interface</p>
              <div class="flex space-x-4">
                <div class="color-scheme-option bg-primary active" data-scheme="primary"></div>
                <div class="color-scheme-option bg-secondary" data-scheme="secondary"></div>
                <div class="color-scheme-option bg-accent" data-scheme="accent"></div>
                <div class="color-scheme-option bg-success" data-scheme="success"></div>
                <div class="color-scheme-option bg-yellow-500" data-scheme="yellow-500"></div>
                <div class="color-scheme-option bg-pink-500" data-scheme="pink-500"></div>
              </div>
            </div>

            <!-- Language & Region -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Language & Region</h3>
              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Language</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="language">
                    <option selected value="en">English</option>
                    <option value="es">Spanish</option>
                    <option value="fr">French</option>
                    <option value="de">German</option>
                    <option value="it">Italian</option>
                    <option value="pt">Portuguese</option>
                  </select>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Region</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="region">
                    <option selected value="us">United States</option>
                    <option value="uk">United Kingdom</option>
                    <option value="eu">European Union</option>
                    <option value="ca">Canada</option>
                    <option value="au">Australia</option>
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
                    id="temperatureUnit">
                    <option value="celsius">Celsius (°C)</option>
                    <option selected value="fahrenheit">Fahrenheit (°F)</option>
                  </select>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Measurement</label>
                  <select
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="measurementUnit">
                    <option value="metric">Metric (cm, kg)</option>
                    <option selected value="imperial">Imperial (inches, lbs)</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="flex justify-end">
              <button
                class="bg-primary rounded-lg px-6 py-3 font-medium text-white transition hover:bg-purple-700"
                id="saveAppBtn">
                Save Changes
              </button>
            </div>
          </div>
        </div>

        <!-- Section headers for mobile -->
        <div class="section-header" id="notifications-header">
          <i class="fas fa-bell"></i>
          <h2 class="text-xl font-bold">Notifications</h2>
        </div>

        <!-- Notifications -->
        <div class="settings-section mb-6 rounded-2xl bg-white p-6 shadow-lg"
          id="notifications-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-bell text-primary mr-3"></i> Notifications
          </h2>

          <div class="space-y-6">
            <!-- Push Notifications -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Push Notifications</h3>
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Enable push notifications</p>
                    <p class="text-sm text-gray-600">Receive notifications from the app</p>
                  </div>
                  <label class="toggle-switch">
                    <input checked id="pushNotifications" type="checkbox">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Sound</p>
                    <p class="text-sm text-gray-600">Play sound with notifications</p>
                  </div>
                  <label class="toggle-switch">
                    <input checked id="notificationSound" type="checkbox">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Vibration</p>
                    <p class="text-sm text-gray-600">Vibrate with notifications</p>
                  </div>
                  <label class="toggle-switch">
                    <input checked id="notificationVibration" type="checkbox">
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
                    <input checked id="marketingEmails" type="checkbox">
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
                    <input checked id="weeklyDigest" type="checkbox">
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
                    <input checked id="laundryEmails" type="checkbox">
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
                    <input checked id="itemSuggestions" type="checkbox">
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
                    <input checked id="outfitRecommendations" type="checkbox">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Style tips</p>
                    <p class="text-sm text-gray-600">Get style tips and fashion advice</p>
                  </div>
                  <label class="toggle-switch">
                    <input checked id="styleTips" type="checkbox">
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
                  <input id="quietHours" type="checkbox">
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="mt-4 grid grid-cols-2 gap-4" id="quietHoursSettings">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Start Time</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="quietStart" type="time" value="22:00">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">End Time</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="quietEnd" type="time" value="07:00">
                </div>
              </div>
            </div>
            <div class="flex justify-end">
              <button
                class="bg-primary rounded-lg px-6 py-3 font-medium text-white transition hover:bg-purple-700"
                id="saveNotificationsBtn">
                Save Changes
              </button>
            </div>
          </div>
        </div>

        <!-- Section headers for mobile -->
        <div class="section-header" id="subscription-header">
          <i class="fas fa-credit-card"></i>
          <h2 class="text-xl font-bold">Subscription & Billing</h2>
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
                    <h4 class="mb-2 text-xl font-bold">Premium Plan</h4>
                    <p class="text-white/80">Full access to all StyleHub features</p>
                  </div>
                  <div class="mt-4 md:mt-0">
                    <span class="text-2xl font-bold">$9.99</span>
                    <span class="text-white/80">/month</span>
                  </div>
                </div>
                <div class="mt-4 flex flex-col items-center justify-between md:flex-row">
                  <div>
                    <p class="text-sm text-white/80">Next billing date: <span
                        class="font-medium">Nov 15, 2023</span></p>
                  </div>
                  <div class="mt-2 md:mt-0">
                    <button
                      class="text-primary mr-2 rounded-lg bg-white px-4 py-2 font-bold transition hover:bg-gray-100">
                      Change Plan
                    </button>
                    <button
                      class="rounded-lg border border-white bg-transparent px-4 py-2 font-bold text-white transition hover:bg-white/10">
                      Cancel Subscription
                    </button>
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
                    value="User Name">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Card Number</label>
                  <div class="relative">
                    <input
                      class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                      id="cardNumber" placeholder="Enter card number" type="text"
                      value="**** **** **** 4242">
                    <div class="absolute right-3 top-3">
                      <i class="fab fa-cc-visa text-gray-500"></i>
                    </div>
                  </div>
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Expiration Date</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="expirationDate" placeholder="MM/YY" type="text" value="12/25">
                </div>
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-700">Security Code</label>
                  <input
                    class="focus:ring-primary w-full rounded-lg border-0 bg-gray-100 px-4 py-3 focus:outline-none focus:ring-2"
                    id="securityCode" placeholder="CVV" type="text" value="***">
                </div>
              </div>
              <div class="mt-4">
                <button
                  class="bg-primary rounded-lg px-4 py-2 font-bold text-white transition hover:bg-purple-700">
                  Update Payment Method
                </button>
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
                    <tr class="border-b border-gray-100">
                      <td class="px-4 py-3 text-sm">Oct 15, 2023</td>
                      <td class="px-4 py-3 text-sm">Premium Plan - Monthly</td>
                      <td class="px-4 py-3 text-sm">$9.99</td>
                      <td class="px-4 py-3 text-sm">
                        <span
                          class="bg-success/20 text-success rounded-full px-2 py-1 text-xs">Paid</span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        <a class="text-primary hover:underline" href="#">Download</a>
                      </td>
                    </tr>
                    <tr class="border-b border-gray-100">
                      <td class="px-4 py-3 text-sm">Sep 15, 2023</td>
                      <td class="px-4 py-3 text-sm">Premium Plan - Monthly</td>
                      <td class="px-4 py-3 text-sm">$9.99</td>
                      <td class="px-4 py-3 text-sm">
                        <span
                          class="bg-success/20 text-success rounded-full px-2 py-1 text-xs">Paid</span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        <a class="text-primary hover:underline" href="#">Download</a>
                      </td>
                    </tr>
                    <tr class="border-b border-gray-100">
                      <td class="px-4 py-3 text-sm">Aug 15, 2023</td>
                      <td class="px-4 py-3 text-sm">Premium Plan - Monthly</td>
                      <td class="px-4 py-3 text-sm">$9.99</td>
                      <td class="px-4 py-3 text-sm">
                        <span
                          class="bg-success/20 text-success rounded-full px-2 py-1 text-xs">Paid</span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        <a class="text-primary hover:underline" href="#">Download</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Subscription Management -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Subscription Management</h3>
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Auto-renewal</p>
                    <p class="text-sm text-gray-600">Automatically renew your subscription each month
                    </p>
                  </div>
                  <label class="toggle-switch">
                    <input checked id="autoRenewal" type="checkbox">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Email receipts</p>
                    <p class="text-sm text-gray-600">Receive email receipts for all payments</p>
                  </div>
                  <label class="toggle-switch">
                    <input checked id="emailReceipts" type="checkbox">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
              <div class="mt-6">
                <button
                  class="mr-2 rounded-lg border border-gray-300 bg-white px-4 py-2 font-bold text-gray-700 transition hover:bg-gray-50">
                  Download All Invoices
                </button>
                <button
                  class="bg-accent rounded-lg px-4 py-2 font-bold text-white transition hover:bg-red-500">
                  Cancel Subscription
                </button>
              </div>
            </div>
            <div class="flex justify-end">
              <button
                class="bg-primary rounded-lg px-6 py-3 font-medium text-white transition hover:bg-purple-700"
                id="saveSubscriptionBtn">
                Save Changes
              </button>
            </div>
          </div>
        </div>

        <!-- Section headers for mobile -->
        <div class="section-header" id="privacy-header">
          <i class="fas fa-shield-alt"></i>
          <h2 class="text-xl font-bold">Privacy & Security</h2>
        </div>

        <!-- Privacy & Security -->
        <div class="settings-section mb-6 rounded-2xl bg-white p-6 shadow-lg" id="privacy-section">
          <h2 class="text-dark mb-6 hidden text-2xl font-bold md:block">
            <i class="fas fa-shield-alt text-primary mr-3"></i> Privacy & Security
          </h2>

          <div class="space-y-6">
            <!-- Account Security -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Account Security</h3>
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Two-factor authentication</p>
                    <p class="text-sm text-gray-600">Add an extra layer of security to your account
                    </p>
                  </div>
                  <label class="toggle-switch">
                    <input id="twoFactorAuth" type="checkbox">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Login notifications</p>
                    <p class="text-sm text-gray-600">Get notified when someone logs into your account
                    </p>
                  </div>
                  <label class="toggle-switch">
                    <input checked id="loginNotifications" type="checkbox">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
              <div class="mt-4">
                <button
                  class="bg-primary rounded-lg px-4 py-2 font-bold text-white transition hover:bg-purple-700">
                  Change Password
                </button>
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
                    id="profileVisibility">
                    <option value="public">Public</option>
                    <option selected value="friends">Friends Only</option>
                    <option value="private">Private</option>
                  </select>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Allow data sharing</p>
                    <p class="text-sm text-gray-600">Share anonymized data to improve our services
                    </p>
                  </div>
                  <label class="toggle-switch">
                    <input checked id="dataSharing" type="checkbox">
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
                    <input checked id="personalizedAds" type="checkbox">
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
                    <input checked id="cameraAccess" type="checkbox">
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
                    <input checked id="locationAccess" type="checkbox">
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
                    <input checked id="photoLibraryAccess" type="checkbox">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="flex justify-end">
              <button
                class="bg-primary rounded-lg px-6 py-3 font-medium text-white transition hover:bg-purple-700"
                id="savePrivacyBtn">
                Save Changes
              </button>
            </div>
          </div>
        </div>

        <!-- Section headers for mobile -->
        <div class="section-header" id="data-header">
          <i class="fas fa-database"></i>
          <h2 class="text-xl font-bold">Data Management</h2>
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
                  <button
                    class="bg-primary rounded-lg px-4 py-2 font-bold text-white transition hover:bg-purple-700">
                    Export
                  </button>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Export style preferences</p>
                    <p class="text-sm text-gray-600">Download your style tags and preferences</p>
                  </div>
                  <button
                    class="bg-primary rounded-lg px-4 py-2 font-bold text-white transition hover:bg-purple-700">
                    Export
                  </button>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Export account data</p>
                    <p class="text-sm text-gray-600">Download all your account information</p>
                  </div>
                  <button
                    class="bg-primary rounded-lg px-4 py-2 font-bold text-white transition hover:bg-purple-700">
                    Export
                  </button>
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
                  <button
                    class="bg-accent rounded-lg px-4 py-2 font-bold text-white transition hover:bg-red-500">
                    Delete
                  </button>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Delete style preferences</p>
                    <p class="text-sm text-gray-600">Permanently delete your style tags and
                      preferences</p>
                  </div>
                  <button
                    class="bg-accent rounded-lg px-4 py-2 font-bold text-white transition hover:bg-red-500">
                    Delete
                  </button>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Delete account</p>
                    <p class="text-sm text-gray-600">Permanently delete your account and all data</p>
                  </div>
                  <button
                    class="bg-accent rounded-lg px-4 py-2 font-bold text-white transition hover:bg-red-500">
                    Delete Account
                  </button>
                </div>
              </div>
            </div>

            <!-- Data Storage -->
            <div class="setting-group">
              <h3 class="text-dark mb-3 text-lg font-semibold">Data Storage</h3>
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Cloud storage</p>
                    <p class="text-sm text-gray-600">Store your data securely in the cloud</p>
                  </div>
                  <label class="toggle-switch">
                    <input checked id="cloudStorage" type="checkbox">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-dark font-medium">Local backup</p>
                    <p class="text-sm text-gray-600">Create local backups of your data</p>
                  </div>
                  <label class="toggle-switch">
                    <input id="localBackup" type="checkbox">
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
              <div class="mt-4">
                <div class="rounded-lg bg-gray-100 p-4">
                  <div class="mb-2 flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700">Storage Usage</span>
                    <span class="text-sm text-gray-500">1.2 GB of 5 GB used</span>
                  </div>
                  <div class="h-2 w-full rounded-full bg-gray-300">
                    <div class="bg-primary h-2 rounded-full" style="width: 24%"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex justify-end">
              <button
                class="bg-primary rounded-lg px-6 py-3 font-medium text-white transition hover:bg-purple-700"
                id="saveDataBtn">
                Save Changes
              </button>
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
    const categoryTags = document.getElementById('categoryTags');
    const categoryInput = document.getElementById('categoryInput');
    const addCategoryBtn = document.getElementById('addCategoryBtn');
    const themeOptions = document.querySelectorAll('.theme-option[data-theme]');
    const colorSchemeOptions = document.querySelectorAll('.color-scheme-option');
    const bodyShapeOptions = document.querySelectorAll('.theme-option[data-shape]');
    const quietHours = document.getElementById('quietHours');
    const quietHoursSettings = document.getElementById('quietHoursSettings');

    // Settings navigation
    settingsNavBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const targetSection = btn.getAttribute('data-section');

        // Update active nav button
        settingsNavBtns.forEach(b => {
          b.classList.remove('active');
        });
        btn.classList.add('active');

        // Show target section
        settingsSections.forEach(section => {
          section.classList.remove('active');
        });
        document.getElementById(`${targetSection}-section`).classList.add('active');
      });
    });

    // Auto-archive toggle
    autoArchive.addEventListener('change', () => {
      archiveAfter.disabled = !autoArchive.checked;
    });

    // Quiet hours toggle
    quietHours.addEventListener('change', () => {
      if (quietHours.checked) {
        quietHoursSettings.style.display = 'grid';
      } else {
        quietHoursSettings.style.display = 'none';
      }
    });

    // Profile color selection
    profileColors.forEach(color => {
      color.addEventListener('click', () => {
        const selectedColor = color.getAttribute('data-color');

        // Update active color
        profileColors.forEach(c => c.classList.remove('active'));
        color.classList.add('active');

        // Update avatar previews
        const avatarElements = [
          document.getElementById('profileHeaderAvatar'),
          document.getElementById('profileAvatarPreview'),
          document.getElementById('currentUserAvatar'),
          document.getElementById('topbarUserAvatar')
        ];

        avatarElements.forEach(avatar => {
          avatar.className = avatar.className.replace(/bg-\w+/g, '');
          avatar.classList.add(`bg-${selectedColor}`);
        });
      });
    });

    // Add style tag
    addStyleBtn.addEventListener('click', () => {
      const styleValue = styleInput.value.trim();
      if (styleValue && !styleTags.querySelector(`[data-tag="${styleValue}"]`)) {
        const tag = document.createElement('span');
        tag.className = 'tag';
        tag.innerHTML =
          `${styleValue} <span class="tag-remove" data-tag="${styleValue}">&times;</span>`;
        styleTags.appendChild(tag);
        styleInput.value = '';

        // Add remove functionality
        tag.querySelector('.tag-remove').addEventListener('click', function() {
          this.parentElement.remove();
        });
      }
    });

    // Add category tag
    addCategoryBtn.addEventListener('click', () => {
      const categoryValue = categoryInput.value.trim();
      if (categoryValue && !categoryTags.querySelector(`[data-tag="${categoryValue}"]`)) {
        const tag = document.createElement('span');
        tag.className = 'tag';
        tag.innerHTML =
          `${categoryValue} <span class="tag-remove" data-tag="${categoryValue}">&times;</span>`;
        categoryTags.appendChild(tag);
        categoryInput.value = '';

        // Add remove functionality
        tag.querySelector('.tag-remove').addEventListener('click', function() {
          this.parentElement.remove();
        });
      }
    });

    // Theme selection
    themeOptions.forEach(option => {
      option.addEventListener('click', () => {
        themeOptions.forEach(o => o.classList.remove('active'));
        option.classList.add('active');
      });
    });

    // Color scheme selection
    colorSchemeOptions.forEach(option => {
      option.addEventListener('click', () => {
        colorSchemeOptions.forEach(o => o.classList.remove('active'));
        option.classList.add('active');
      });
    });

    // Body shape selection
    bodyShapeOptions.forEach(option => {
      option.addEventListener('click', () => {
        bodyShapeOptions.forEach(o => o.classList.remove('active'));
        option.classList.add('active');
      });
    });

    // Initialize tag removal functionality
    document.querySelectorAll('.tag-remove').forEach(removeBtn => {
      removeBtn.addEventListener('click', function() {
        this.parentElement.remove();
      });
    });

    // Initialize theme options
    document.querySelectorAll('.theme-option').forEach(option => {
      option.addEventListener('click', function() {
        this.parentElement.querySelectorAll('.theme-option').forEach(o => {
          o.classList.remove('active');
        });
        this.classList.add('active');
      });
    });

    // Save buttons functionality
    document.querySelectorAll('button[id^="save"]').forEach(btn => {
      btn.addEventListener('click', function() {
        // Show success message
        alert('Your settings have been saved successfully!');
      });
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', () => {
      // Set initial state for toggles
      archiveAfter.disabled = !autoArchive.checked;

      // Handle responsive behavior
      function handleResize() {
        if (window.innerWidth < 640) {
          // On mobile, show all sections
          settingsSections.forEach(section => {
            section.classList.add('active');
          });
        } else {
          // On medium and large screens, only show the active section
          const activeNav = document.querySelector('.settings-nav-btn.active');
          if (activeNav) {
            const section = activeNav.dataset.section || 'profile';
            settingsSections.forEach(s => s.classList.remove('active'));
            document.getElementById(`${section}-section`).classList.add('active');
          }
        }
      }

      // Initial call
      handleResize();

      // Update on resize
      window.addEventListener('resize', handleResize);
    });
  </script>
@endpush
