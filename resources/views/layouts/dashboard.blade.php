<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>StyleHub Wardrobe Manager - @yield('page_title')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#9F7AEA',
            secondary: '#4FD1C5',
            accent: '#FC8181',
            light: '#F7FAFC',
            dark: '#2D3748',
            success: '#68D391',
          },
          fontFamily: {
            inter: ['Inter', 'sans-serif'],
          },
          screens: {
            md: '768px',
            lg: '1024px',
            xl: '1280px',
          },
        },
      },
    };
  </script>
  <style>
    *::-webkit-scrollbar {
      display: none;
    }

    body {
      font-family: 'Inter', sans-serif;
      font-family: 'Inter', sans-serif;
      transition: all 0.3s ease;
    }

    .gradient-bg {
      background: linear-gradient(135deg, #9f7aea 0%, #4fd1c5 100%);
    }

    .nav-link {
      position: relative;
      transition: all 0.3s ease;
      white-space: nowrap;
      overflow: hidden;
    }

    .nav-link:hover {
      background-color: rgba(159, 122, 234, 0.1);
    }

    .nav-link.active {
      background-color: rgba(159, 122, 234, 0.15);
      border-right: 3px solid #9f7aea;
    }

    /* Sidebar Styles */
    .sidebar {
      transition: all 0.3s ease;
      height: 100vh;
      overflow-y: auto;
      border-right: 1px solid #e5e7eb;
    }

    /* Mobile (default) - Hidden sidebar */
    .sidebar {
      transform: translateX(-100%);
      position: fixed;
      z-index: 50;
      width: 280px;
    }

    .sidebar.mobile-open {
      transform: translateX(0);
    }

    .sidebar-overlay.active {
      display: block;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 40;
    }

    .sidebar.collapsed-lg .toggle-btn {
      left: 80px;
    }

    .sidebar.mobile-open .toggle-btn {
      left: 280px;
    }

    .sidebar.collapsed-lg .profile-dropdown {
      left: 20px;
    }

    /* Scrollable sidebar navigation */
    .sidebar-nav {
      flex: 1;
      overflow-y: auto;
      max-height: calc(100vh - 200px);
    }

    /* Toggle Button - Moves with sidebar */
    .toggle-btn {
      transition: all 0.3s ease;
      border-radius: 50%;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      border: 1px solid #e5e7eb;
      position: fixed;
      left: 240px;
      top: 50%;
      transform: translateY(-50%);
      z-index: 80;
    }

    .toggle-btn:hover {
      background: #f9fafb;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      transform: translateY(-50%) scale(1.05);
    }

    /* User profile dropdown - Positioned closer to trigger */
    .profile-dropdown {
      display: none;
      position: fixed;
      width: 200px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      border: 1px solid #e5e7eb;
      z-index: 100;
      // padding: 8px 0;
      left: 20px;
      bottom: 60px;
    }

    /* Medium screens dropdown positioning */
    @media (min-width: 768px) and (max-width: 1023px) {
      .profile-dropdown {
        left: 20px;
        bottom: 60px;
      }
    }

    /* Large screens dropdown positioning */
    @media (min-width: 1024px) {
      .profile-dropdown {
        left: 20px;
        bottom: 50px;
      }

      .sidebar:not(.collapsed-lg) .profile-dropdown {
        left: 220px;
      }
    }

    .profile-dropdown.show {
      display: block;
    }

    /* Mobile styles */
    @media (max-width: 767px) {
      .profile-dropdown {
        position: fixed;
        left: 20px;
        bottom: 60px;
        transform: none;
        width: 200px;
        max-width: none;
      }

      .sidebar.mobile-open .profile-dropdown {
        left: 20px;
      }

      .toggle-btn {
        display: none;
      }
    }

    /* Medium devices (768px and up) - Fixed sidebar with icons only, not expandable */
    @media (min-width: 768px) {
      .sidebar {
        transform: translateX(0);
        width: 80px;
        border-right: 1px solid #e5e7eb;
      }

      .sidebar .nav-text {
        display: none;
      }

      .sidebar .logo-text {
        display: none;
      }

      .sidebar .user-name,
      .sidebar .user-status {
        display: none;
      }

      .main-content {
        margin-left: 80px;
      }

      /* Hide toggle button on medium screens */
      .toggle-btn {
        display: none;
      }

      /* Hide three dots menu on medium screens */
      #sidebarUserMenu {
        display: none;
      }
    }

    /* Large devices (1024px and up) - Expandable sidebar */
    @media (min-width: 1024px) {
      .sidebar {
        width: 280px;
        border-right: 1px solid #e5e7eb;
      }

      .sidebar .nav-text {
        display: inline;
      }

      .sidebar .logo-text {
        display: inline;
      }

      .sidebar .user-name,
      .sidebar .user-status {
        display: block;
      }

      .main-content {
        margin-left: 280px;
      }

      .sidebar.collapsed-lg {
        width: 80px;
        border-right: 1px solid #e5e7eb;
      }

      .sidebar.collapsed-lg .nav-text {
        display: none;
      }

      .sidebar.collapsed-lg .logo-text {
        display: none;
      }

      .sidebar.collapsed-lg .user-name,
      .sidebar.collapsed-lg .user-status {
        display: none;
      }

      .main-content.collapsed-lg {
        margin-left: 80px;
      }

      /* Show toggle button on large screens */
      .toggle-btn {
        display: flex;
      }

      /* Show three dots when sidebar is expanded, hide when collapsed */
      .sidebar:not(.collapsed-lg) #sidebarUserMenu {
        display: block;
      }

      .sidebar.collapsed-lg #sidebarUserMenu {
        display: none;
      }
    }

    .profile-item {
      padding: 14px 16px;
      display: flex;
      align-items: center;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .profile-item:hover {
      background: #f9fafb;
    }

    .profile-item.active {
      background: rgba(159, 122, 234, 0.1);
    }

    .profile-avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: white;
      margin-right: 12px;
      font-size: 14px;
    }

    /* Top bar user profile */
    .topbar-profile {
      position: relative;
    }

    .topbar-dropdown {
      display: none;
      position: absolute;
      top: 50px;
      right: 0;
      width: 200px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      border: 1px solid #e5e7eb;
      z-index: 60;
      // padding: 8px 0;
    }

    .topbar-dropdown.show {
      display: block;
    }

    /* Improved responsive text sizes */
    .responsive-text {
      font-size: 0.875rem;
    }

    @media (min-width: 640px) {
      .responsive-text {
        font-size: 1rem;
      }
    }

    .responsive-heading {
      font-size: 1.25rem;
    }

    @media (min-width: 640px) {
      .responsive-heading {
        font-size: 1.5rem;
      }
    }

    @media (min-width: 1024px) {
      .responsive-heading {
        font-size: 1.875rem;
      }
    }

    /* Improved button responsiveness */
    .responsive-button {
      padding: 0.75rem 1rem;
      font-size: 0.875rem;
    }

    @media (min-width: 640px) {
      .responsive-button {
        padding: 0.875rem 1.5rem;
        font-size: 1rem;
      }
    }

    /* Improved card responsiveness */
    .responsive-card {
      padding: 1rem;
    }

    @media (min-width: 640px) {
      .responsive-card {
        padding: 1.5rem;
      }
    }
  </style>
  @stack('styles')
</head>

<body class="bg-light font-inter">
  <!-- Sidebar Overlay for Mobile -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Side Navigation -->
  <div class="sidebar fixed left-0 top-0 z-50 bg-white shadow-lg" id="sidebar">
    <!-- Logo Section -->
    <div class="flex items-center justify-between border-b border-gray-200 p-6 py-5">
      <div class="flex items-center">
        <i class="fas fa-tshirt text-primary mr-3 text-2xl"></i>
        <span class="logo-text text-dark text-xl font-bold">StyleHub</span>
      </div>
      <button class="hover:text-primary text-gray-500 md:hidden" id="closeSidebar">
        <i class="fas fa-times text-xl"></i>
      </button>
    </div>

    <!-- Navigation Links - Scrollable -->
    <div class="sidebar-nav py-4">
      <a class="nav-link text-dark @if (request()->path() === 'dashboard') active @endif flex items-center px-6 py-3 font-medium"
        href="{{ url('dashboard') }}">
        <i class="fas fa-th-large text-primary mr-4 text-lg"></i>
        <span class="nav-text">Dashboard</span>
      </a>
      <a class="nav-link text-dark @if (request()->path() === 'dashboard/wardrobe') active @endif flex items-center px-6 py-3 font-medium"
        href="{{ url('dashboard/wardrobe') }}">
        <i class="fas fa-archive text-primary mr-4 text-lg"></i>
        <span class="nav-text">My Wardrobe</span>
      </a>
      <a class="nav-link text-dark @if (request()->path() === 'dashboard/interests') active @endif flex items-center px-6 py-3 font-medium"
        href="{{ url('dashboard/interests') }}">
        <i class="fas fa-heart text-primary mr-4 text-lg"></i>
        <span class="nav-text">Interests</span>
      </a>
      <a class="nav-link text-dark @if (request()->path() === 'dashboard/wishlist') active @endif flex items-center px-6 py-3 font-medium"
        href="{{ url('dashboard/wishlist') }}">
        <i class="fas fa-bookmark text-primary mr-4 text-lg"></i>
        <span class="nav-text">Wishlist</span>
      </a>
      <a class="nav-link text-dark @if (request()->path() === 'dashboard/shopping') active @endif flex items-center px-6 py-3 font-medium"
        href="{{ url('dashboard/shopping') }}">
        <i class="fas fa-shopping-cart text-primary mr-4 text-lg"></i>
        <span class="nav-text">Shopping</span>
      </a>
      <a class="nav-link text-dark @if (request()->path() === 'dashboard/orders') active @endif flex items-center px-6 py-3 font-medium"
        href="{{ url('dashboard/orders') }}">
        <i class="fas fa-shopping-bag text-primary mr-4 text-lg"></i>
        <span class="nav-text">Orders</span>
      </a>
    </div>

    <!-- User Section - Always visible at bottom -->
    <div class="absolute bottom-0 w-full border-t border-gray-200 bg-white p-4">
      <div class="flex items-center justify-between">
        <div class="flex cursor-pointer items-center" id="sidebarUser">
          <div
            class="bg-primary flex h-10 w-10 items-center justify-center rounded-full font-bold text-white">
            U
          </div>
          <div class="ml-3">
            <p class="user-name text-dark text-sm font-medium">
              User Name
            </p>
            <p class="user-status text-xs text-gray-500">
              Premium Member
            </p>
          </div>
        </div>
        <button class="hover:text-primary user-menu-toggle text-gray-500" id="sidebarUserMenu">
          <i class="fas fa-ellipsis-v"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Profile Dropdown - Positioned closer to trigger -->
  <div class="profile-dropdown" id="profileDropdown">
    <a class="border-gray-200" href="{{ url('dashboard/settings') }}">
      <div class="profile-item rounded-t-xl">
        <i class="fas fa-cog mr-3 text-gray-500"></i>
        <span class="text-sm">Settings</span>
      </div>
    </a>
    <div class="border-t border-gray-200">
      <div class="profile-item rounded-b-xl">
        <i class="fas fa-cog mr-3 text-gray-500"></i>
        <span class="text-sm">Log Out</span>
      </div>
    </div>
  </div>

  <!-- Toggle Button - Moves with sidebar -->
  <button class="toggle-btn hover:text-primary text-gray-500" id="toggleSidebar">
    <i class="fas fa-chevron-left text-sm"></i>
  </button>

  <!-- Main Content -->
  <div class="main-content min-h-screen" id="mainContent">
    <!-- Top Bar -->
    <div class="sticky top-0 z-40 flex items-center justify-between bg-white px-6 py-5 shadow-sm">
      <div class="flex items-center">
        <!-- Hamburger Menu for Mobile -->
        <button class="hover:text-primary mr-4 text-gray-500 md:hidden" id="openSidebar">
          <i class="fas fa-bars text-xl"></i>
        </button>
        <h1 class="text-dark text-xl font-bold">
          @yield('title')
        </h1>
      </div>
      <div class="flex items-center space-x-4">
        <div class="relative">
          <button class="text-primary border-primary hover:bg-primary rounded-full border bg-white px-2 py-1 font-medium transition hover:text-white"
            id="bellIcon">
            <i class="fas fa-bell"></i>
          </button>
          <span
            class="bg-accent absolute -right-0.5 -top-0.5 flex h-3 w-3 items-center justify-center rounded-full text-[10px] text-white">3</span>
        </div>

        <!-- Top Bar User Profile -->
        <div class="topbar-profile relative">
          <div class="flex cursor-pointer items-center space-x-2" id="topbarUser">
            <div
              class="bg-primary flex h-8 w-8 items-center justify-center rounded-full font-bold text-white">
              {{ strtoupper(auth()->user()->name[0]) }}
            </div>
          </div>

          <!-- Top Bar Dropdown -->
          <div class="topbar-dropdown" id="topbarDropdown">
            <div class="border-gray-200">
              <a class="profile-item rounded-t-xl" href="{{ url('dashboard/settings') }}">
                <i class="fas fa-cog mr-3 text-gray-500"></i>
                <span class="text-sm">Settings</span>
              </a>
            </div>
            <div class="border-t border-gray-200">
              <a href="javascript:void(0);" class="profile-item rounded-b-xl" onclick="document.getElementById('logoutform').submit()" >
                <i class="fas fa-sign-out-alt mr-3 text-gray-500"></i>
                <span class="text-sm">Log Out</span>
              </a>
              <form id="logoutform" method="POST" action="{{ route('logout') }}" style="display:none">
                @csrf
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    @yield('content')
    @include('components.notifications')
  </div>
  <script>
    // DOM Elements
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const toggleBtn = document.getElementById('toggleSidebar');
    const openSidebarBtn = document.getElementById('openSidebar');
    const closeSidebarBtn = document.getElementById('closeSidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const sidebarUser = document.getElementById('sidebarUser');
    const sidebarUserMenu = document.getElementById('sidebarUserMenu');
    const profileDropdown = document.getElementById('profileDropdown');
    const topbarUser = document.getElementById('topbarUser');
    const topbarDropdown = document.getElementById('topbarDropdown');

    // Sidebar state
    let isSidebarCollapsed = false;

    // Toggle sidebar on large screens
    function toggleSidebarLG() {
      isSidebarCollapsed = !isSidebarCollapsed;

      if (window.innerWidth >= 1024) {
        // Large devices
        if (isSidebarCollapsed) {
          sidebar.classList.add('collapsed-lg');
          mainContent.classList.add('collapsed-lg');
          toggleBtn.innerHTML = '<i class="fas fa-chevron-right text-sm"></i>';
          toggleBtn.style.left = '68px';
          profileDropdown.style.left = '80px';
        } else {
          sidebar.classList.remove('collapsed-lg');
          mainContent.classList.remove('collapsed-lg');
          toggleBtn.innerHTML = '<i class="fas fa-chevron-left text-sm"></i>';
          toggleBtn.style.left = '268px';
          profileDropdown.style.left = '280px';
        }
      }
    }

    // Update toggle button and dropdown positions based on sidebar state
    function updatePositions() {
      if (sidebar.classList.contains('collapsed-lg')) {
        toggleBtn.style.left = '68px';
        profileDropdown.style.left = '80px';
      } else {
        toggleBtn.style.left = '268px';
        profileDropdown.style.left = '50px';
      }
    }

    // Open sidebar on mobile
    function openSidebarMobile() {
      sidebar.classList.add('mobile-open');
      sidebarOverlay.classList.add('active');
      document.body.style.overflow = 'hidden';
      // Update toggle button position when mobile sidebar opens
      toggleBtn.style.left = '280px';
    }

    // Close sidebar on mobile
    function closeSidebarMobile() {
      sidebar.classList.remove('mobile-open');
      sidebarOverlay.classList.remove('active');
      document.body.style.overflow = '';
      // Reset toggle button position when mobile sidebar closes
      if (window.innerWidth >= 1024) {
        updatePositions();
      } else {
        toggleBtn.style.display = 'none';
      }
    }

    // Toggle profile dropdown based on screen size and sidebar state
    function toggleProfileDropdown(event) {
      event.stopPropagation();

      // Close topbar dropdown if open
      topbarDropdown.classList.remove('show');

      // Toggle profile dropdown
      profileDropdown.classList.toggle('show');
    }

    // Toggle topbar dropdown
    function toggleTopbarDropdown(event) {
      event.stopPropagation();

      // Close profile dropdown if open
      profileDropdown.classList.remove('show');

      // Toggle topbar dropdown
      topbarDropdown.classList.toggle('show');
    }

    // Close all dropdowns
    function closeAllDropdowns() {
      profileDropdown.classList.remove('show');
      topbarDropdown.classList.remove('show');
    }

    // Enhanced click outside handler
    function handleClickOutside(event) {
      const isProfileDropdownClick = profileDropdown.contains(event.target);
      const isTopbarDropdownClick = topbarDropdown.contains(event.target);
      const isSidebarUserClick = sidebarUser.contains(event.target);
      const isSidebarUserMenuClick = sidebarUserMenu.contains(event.target);
      const isTopbarUserClick = topbarUser.contains(event.target);

      // Close dropdowns if click is outside of all dropdown elements and their triggers
      if (!isProfileDropdownClick && !isSidebarUserClick && !isSidebarUserMenuClick) {
        profileDropdown.classList.remove('show');
      }

      if (!isTopbarDropdownClick && !isTopbarUserClick) {
        topbarDropdown.classList.remove('show');
      }
    }

    // Handle responsive behavior
    function handleResponsive() {
      if (window.innerWidth >= 768 && window.innerWidth < 1024) {
        // Medium screens - icon-only sidebar, not expandable
        closeSidebarMobile();
        sidebar.classList.remove('collapsed-lg', 'mobile-open');
        mainContent.classList.remove('collapsed-lg');

        // Hide toggle button on medium screens
        toggleBtn.style.display = 'none';

        // Ensure three dots are hidden on medium screens
        sidebarUserMenu.style.display = 'none';

      } else if (window.innerWidth >= 1024) {
        // Large screens - expandable sidebar
        closeSidebarMobile();
        toggleBtn.style.display = 'flex';

        // Initialize positions
        updatePositions();

        // Show/hide three dots based on sidebar state
        if (sidebar.classList.contains('collapsed-lg')) {
          sidebarUserMenu.style.display = 'none';
        } else {
          sidebarUserMenu.style.display = 'block';
        }
      } else {
        // Small screens
        sidebar.classList.remove('collapsed-lg');
        mainContent.classList.remove('collapsed-lg');
        closeSidebarMobile();

        // Hide toggle button on mobile
        toggleBtn.style.display = 'none';

        // Show three dots on mobile when sidebar is open
        sidebarUserMenu.style.display = 'block';
      }
    }

    // Set up event listeners based on screen size
    function setupEventListeners() {
      // Remove all existing event listeners first
      sidebarUser.removeEventListener('click', toggleProfileDropdown);
      sidebarUserMenu.removeEventListener('click', toggleProfileDropdown);

      if (window.innerWidth >= 768 && window.innerWidth < 1024) {
        // Medium screens: profile icon opens dropdown
        sidebarUser.addEventListener('click', toggleProfileDropdown);
      } else if (window.innerWidth >= 1024) {
        // Large screens: 
        if (sidebar.classList.contains('collapsed-lg')) {
          // When collapsed: profile icon opens dropdown
          sidebarUser.addEventListener('click', toggleProfileDropdown);
        } else {
          // When expanded: three dots opens dropdown
          sidebarUserMenu.addEventListener('click', toggleProfileDropdown);
        }
      } else {
        // Mobile screens: three dots opens dropdown when sidebar is open
        sidebarUserMenu.addEventListener('click', toggleProfileDropdown);
      }
    }

    // Event Listeners
    toggleBtn.addEventListener('click', toggleSidebarLG);
    openSidebarBtn.addEventListener('click', openSidebarMobile);
    closeSidebarBtn.addEventListener('click', closeSidebarMobile);
    sidebarOverlay.addEventListener('click', closeSidebarMobile);
    topbarUser.addEventListener('click', toggleTopbarDropdown);

    // Enhanced click outside detection - listen for clicks anywhere in the document
    document.addEventListener('click', handleClickOutside);

    // Handle window resize
    window.addEventListener('resize', () => {
      handleResponsive();
      setupEventListeners();
    });

    // Update event listeners when sidebar is toggled on large screens
    toggleBtn.addEventListener('click', () => {
      if (window.innerWidth >= 1024) {
        setTimeout(() => {
          handleResponsive();
          setupEventListeners();
        }, 300); // Wait for transition to complete
      }
    });

    // Initialize
    handleResponsive();
    setupEventListeners();

    // Close dropdowns on escape key
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        closeAllDropdowns();
      }
    });
  </script>
  @stack('scripts')
</body>

</html>

{{-- Babe can I ask?

Why do you go offline just immediately after you say goodnight and sleep well. You hardly wait for me to reply you and boom, you're offline already. You would now be receiving the messages in the morning while I sent it at night. --}}