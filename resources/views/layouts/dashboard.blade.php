<!DOCTYPE html>
@php
  $colorSchemes = [
      'primary' => [
          '--primary-color' => '#9F7AEA',
          '--secondary-color' => '#4FD1C5',
          '--accent-color' => '#FC8181',
          '--success-color' => '#68D391'
      ],
      'secondary' => [
          '--primary-color' => '#4FD1C5',
          '--secondary-color' => '#9F7AEA',
          '--accent-color' => '#FC8181',
          '--success-color' => '#68D391'
      ],
      'accent' => [
          '--primary-color' => '#FC8181',
          '--secondary-color' => '#4FD1C5',
          '--accent-color' => '#9F7AEA',
          '--success-color' => '#68D391'
      ],
      'success' => [
          '--primary-color' => '#68D391',
          '--secondary-color' => '#4FD1C5',
          '--accent-color' => '#FC8181',
          '--success-color' => '#9F7AEA'
      ],
      'yellow-500' => [
          '--primary-color' => '#EAB308',
          '--secondary-color' => '#4FD1C5',
          '--accent-color' => '#FC8181',
          '--success-color' => '#68D391'
      ],
      'pink-500' => [
          '--primary-color' => '#EC4899',
          '--secondary-color' => '#4FD1C5',
          '--accent-color' => '#FC8181',
          '--success-color' => '#68D391'
      ]
  ];

  $userColorScheme = $currentUser->color_scheme ?? 'primary';
  $userTheme = $currentUser->theme ?? 'light';
  $userHighContrast = $currentUser->high_contrast ? 'true' : 'false';

  $currentColors = $colorSchemes[$userColorScheme] ?? $colorSchemes['primary'];

  // Calculate RGB for primary color
  $primaryColor = $currentColors['--primary-color'];
  $rgb = [];
  if (preg_match('/#([a-fA-F0-9]{6})/', $primaryColor, $matches)) {
      $hex = $matches[1];
      $rgb = [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];
  } else {
      $rgb = [159, 122, 234]; // default purple
  }
  $primaryColorRgb = implode(', ', $rgb);
@endphp
<html data-color-scheme="{{ $userColorScheme }}" data-high-contrast="{{ $userHighContrast }}"
  data-theme="{{ $userTheme }}" lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <meta content="{{ $currentUser->theme ?? 'light' }}" name="user-theme">
    <meta content="{{ $currentUser->color_scheme ?? 'primary' }}" name="user-color-scheme">
    <meta content="{{ $currentUser->high_contrast ? 'true' : 'false' }}" name="user-high-contrast">
    <title>StyleHub Wardrobe Manager - @yield('page_title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
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
      :root {
        --primary-color: {{ $currentColors['--primary-color'] }};
        --secondary-color: {{ $currentColors['--secondary-color'] }};
        --accent-color: {{ $currentColors['--accent-color'] }};
        --success-color: {{ $currentColors['--success-color'] }};
        --bg-primary: #ffffff;
        --bg-secondary: #F7FAFC;
        --text-primary: #2D3748;
        --text-secondary: #6B7280;
        --border-color: #E5E7EB;
        --primary-color-rgb: {{ $primaryColorRgb }};
      }

      [data-theme="light"] {
        --bg-primary: #ffffff;
        --bg-secondary: #F7FAFC;
        --text-primary: #2D3748;
        --text-secondary: #6B7280;
        --border-color: #E5E7EB;
      }

      /* Dark Theme */
      [data-theme="dark"] {
        --bg-primary: #1a1a1a;
        --bg-secondary: #2d2d2d;
        --text-primary: #ffffff;
        --text-secondary: #b0b0b0;
        --border-color: #404040;
      }

      [data-theme="auto"] {
        --bg-primary: #ffffff;
        --bg-secondary: #F7FAFC;
        --text-primary: #2D3748;
        --text-secondary: #6B7280;
        --border-color: #E5E7EB;
      }

      [data-high-contrast="true"] {
        --bg-primary: #000000;
        --bg-secondary: #111111;
        --text-primary: #ffffff;
        --text-secondary: #ffffff;
        --border-color: #ffffff;
        --primary-color: #ffff00;
        --secondary-color: #00ffff;
        --accent-color: #ff00ff;
        --success-color: #00ff00;
      }

      /* Dark mode support for dropdowns */
      [data-theme="dark"] .profile-dropdown,
      [data-theme="dark"] .topbar-dropdown,
      [data-theme="auto"] .profile-dropdown,
      [data-theme="auto"] .topbar-dropdown {
        background-color: var(--bg-primary);
        border-color: var(--border-color);
        color: var(--text-primary);
      }

      [data-theme="dark"] .profile-item,
      [data-theme="auto"] .profile-item {
        color: var(--text-primary);
      }

      [data-theme="dark"] .profile-item:hover,
      [data-theme="auto"] .profile-item:hover {
        background-color: rgba(var(--primary-color-rgb), 0.08);
      }

      [data-theme="dark"] .profile-item i {
        color: var(--text-secondary);
      }

      [data-theme="dark"] .profile-item:hover i {
        color: rgba(var(--primary-color-rgb), 0.08);
      }

      /* High contrast mode for dropdowns */
      [data-high-contrast="true"] .profile-dropdown,
      [data-high-contrast="true"] .topbar-dropdown {
        background-color: var(--bg-primary);
        border: 2px solid var(--border-color);
        color: var(--text-primary);
      }

      [data-high-contrast="true"] .profile-item {
        color: var(--text-primary);
        font-weight: 600;
      }

      [data-high-contrast="true"] .profile-item:hover {
        background-color: rgba(var(--primary-color-rgb), 0.08);
      }

      [data-high-contrast="true"] .profile-item i {
        color: var(--text-primary);
      }

      @media (prefers-color-scheme: dark) {
        [data-theme="auto"] {
          --bg-primary: #1a1a1a;
          --bg-secondary: #2d2d2d;
          --text-primary: #ffffff;
          --text-secondary: #b0b0b0;
          --border-color: #404040;
        }

        [data-theme="auto"] body {
          background-color: var(--bg-primary);
          color: var(--text-primary);
        }
      }

      /* Global dark mode text visibility */
      [data-theme="dark"] .text-dark,
      [data-theme="dark"] .text-gray-900,
      [data-theme="dark"] .text-gray-800,
      [data-theme="dark"] .text-gray-700 {
        color: var(--text-primary) !important;
      }

      [data-theme="dark"] .text-gray-600,
      [data-theme="dark"] .text-gray-500,
      [data-theme="dark"] .text-gray-400 {
        color: var(--text-secondary) !important;
      }

      /* High contrast text visibility */
      [data-high-contrast="true"] .text-dark,
      [data-high-contrast="true"] .text-gray-900,
      [data-high-contrast="true"] .text-gray-800,
      [data-high-contrast="true"] .text-gray-700,
      [data-high-contrast="true"] .text-gray-600,
      [data-high-contrast="true"] .text-gray-500 {
        color: var(--text-primary) !important;
        font-weight: 600;
      }

      /* Ensure form labels and descriptions are visible */
      [data-theme="dark"] label,
      [data-theme="dark"] .text-sm.text-gray-600,
      [data-theme="dark"] .text-sm.text-gray-500 {
        color: var(--text-secondary) !important;
      }

      [data-high-contrast="true"] label,
      [data-high-contrast="true"] .text-sm.text-gray-600,
      [data-high-contrast="true"] .text-sm.text-gray-500 {
        color: var(--text-primary) !important;
        font-weight: 600;
      }

      /* Table text visibility */
      [data-theme="dark"] table,
      [data-theme="dark"] thead th,
      [data-theme="dark"] tbody td {
        color: var(--text-primary) !important;
      }

      [data-high-contrast="true"] table,
      [data-high-contrast="true"] thead th,
      [data-high-contrast="true"] tbody td {
        color: var(--text-primary) !important;
        border-color: var(--border-color) !important;
      }

      /* Input placeholder visibility */
      [data-theme="dark"] ::placeholder {
        color: var(--text-secondary) !important;
        opacity: 0.8;
      }

      [data-high-contrast="true"] ::placeholder {
        color: var(--text-primary) !important;
        opacity: 0.7;
        font-weight: 500;
      }

      [data-theme="dark"] input,
      [data-theme="dark"] select,
      [data-theme="dark"] textarea {
        color: var(--text-primary) !important;
      }

      [data-high-contrast="true"] input,
      [data-high-contrast="true"] select,
      [data-high-contrast="true"] textarea {
        color: var(--text-primary) !important;
        border: 2px solid var(--border-color) !important;
        font-weight: 500;
      }

      /* Card and section text visibility */
      [data-theme="dark"] .bg-white {
        color: var(--text-primary) !important;
      }

      [data-theme="dark"] .bg-gray-50,
      [data-theme="dark"] .bg-gray-100 {
        color: var(--text-primary) !important;
      }

      *::-webkit-scrollbar {
        display: none;
      }

      body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-primary);
        color: var(--text-primary);
        transition: background-color 0.3s ease, color 0.3s ease;
      }

      input,
      textarea,
      select {
        background-color: var(--bg-primary) !important;
        color: var(--text-primary) !important;
        border: 1px solid transparent;
        transition: border-color 0.4s ease, box-shadow 0.3s ease;
      }

      input:focus,
      textarea:focus,
      select:focus {
        border: 1px solid var(--primary-color) !important;
        box-shadow: 0 0 0 2px rgba(var(--primary-color-rgb, 159, 122, 234), 0.08) !important;
        outline: none !important;
      }

      /* Stronger visibility for keyboard users */
      /* :focus-visible {
        box-shadow: 0 0 0 6px rgba(var(--primary-color-rgb, 159, 122, 234), 0.12) !important;
      } */

      /* select {
        padding-right: 2.5rem !important;
      }  */


      /* Update existing classes to use CSS variables */
      .bg-light {
        background-color: var(--bg-secondary) !important;
      }

      .bg-white {
        background-color: var(--bg-primary) !important;
      }

      .text-dark {
        color: var(--text-primary) !important;
      }

      .text-gray-500,
      .text-gray-600 {
        color: var(--text-secondary);
      }

      .border-gray-200 {
        border-color: var(--border-color) !important;
      }

      .bg-gray-50,
      .bg-gray-100 {
        background-color: var(--bg-secondary) !important;
      }

      /* Card and form elements */
      .responsive-card {
        /* background-color: var(--bg-primary); */
        color: var(--text-primary);
        border-color: var(--border-color);
      }

      .responsive-card input[type="text"],
      .responsive-card select,
      .responsive-card textarea {
        background-color: var(--bg-primary) !important;
        color: var(--text-primary) !important;
      }

      .bg-primary {
        background-color: var(--primary-color) !important;
      }

      .text-primary {
        color: var(--primary-color) !important;
      }

      .border-primary {
        border-color: var(--primary-color) !important;
      }

      .bg-secondary {
        background-color: var(--secondary-color) !important;
      }

      .text-secondary {
        color: var(--secondary-color) !important;
      }

      .bg-accent {
        background-color: var(--accent-color) !important;
      }

      .text-accent {
        color: var(--accent-color) !important;
      }

      .bg-success {
        background-color: var(--success-color) !important;
      }

      .text-success {
        color: var(--success-color) !important;
      }

      /* Button styles using CSS variables */
      .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
      }

      .btn-primary:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        opacity: 0.9;
      }

      .sidebar {
        background-color: var(--bg-primary);
        border-right-color: var(--border-color);
      }

      .nav-link {
        color: var(--text-primary);
      }

      .nav-link:hover {
        background-color: rgba(159, 122, 234, 0.1);
      }

      .nav-link.active {
        background-color: rgba(159, 122, 234, 0.15);
        border-right-color: var(--primary-color);
      }

      /* Profile dropdown theming */
      .profile-dropdown,
      .topbar-dropdown {
        background-color: var(--bg-primary);
        border-color: var(--border-color);
        color: var(--text-primary);
      }

      /* Shadow adjustments for dark mode */
      [data-theme="dark"] .shadow-lg,
      [data-theme="dark"] .shadow-sm {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2) !important;
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
        background-color: rgba(var(--primary-color-rgb), 0.08);
      }

      .nav-link.active {
        background-color: rgba(var(--primary-color-rgb), 0.08);
        border-right: 3px solid rgba(var(--primary-color-rgb), 0.08);
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
        max-height: calc(100vh - 150px);
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
        background: var(--bg-primary) !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--border-color) !important;
        position: fixed;
        left: 240px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 80;
        color: var(--text-secondary) !important;
        /* Default icon color */
      }

      .toggle-btn:hover {
        background: var(--bg-secondary) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-50%) scale(1.05);
        color: var(--primary-color) !important;
        /* Primary color on hover */
      }

      /* Ensure toggle button icon color behavior */
      .toggle-btn i,
      .toggle-btn svg {
        transition: color 0.3s ease;
        color: inherit;
        /* Inherit from parent */
      }

      .toggle-btn:hover i,
      .toggle-btn:hover svg {
        color: inherit;
        /* Ensure hover color is applied */
      }

      /* Override any potential conflicting styles */
      #toggleSidebar,
      #toggleSidebar i {
        color: var(--text-secondary) !important;
      }

      #toggleSidebar:hover,
      #toggleSidebar:hover i {
        color: var(--primary-color) !important;
      }

      /* High Contrast Mode - Ensure toggle remains visible */
      [data-high-contrast="true"] .toggle-btn {
        background: var(--bg-primary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-primary) !important;
      }

      [data-high-contrast="true"] .toggle-btn:hover {
        background: var(--bg-secondary) !important;
        color: var(--primary-color) !important;
      }

      /* Toggle switches using CSS variables */
      .toggle-slider {
        background-color: var(--text-secondary);
      }

      input:checked+.toggle-slider {
        background-color: var(--primary-color);
      }

      .toggle-slider:before {
        background-color: var(--bg-primary);
      }

      /* Ensure toggle remains visible in all themes */
      .toggle-btn {
        background: var(--bg-primary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-primary) !important;
      }

      .toggle-btn:hover {
        background: var(--bg-secondary) !important;
        color: var(--primary-color) !important;
      }

      /* Toggle switches using CSS variables - FIXED VERSION */
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

      /* Theme transition overlay - Minimal version */
      .theme-transition-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--primary-color);
        z-index: 9999;
        clip-path: circle(0% at top right);
        animation: themeTransition 0.6s ease-in-out forwards;
        pointer-events: none;
      }

      @keyframes themeTransition {
        0% {
          clip-path: circle(0% at top right);
          opacity: 0.8;
        }

        50% {
          clip-path: circle(150% at top right);
          opacity: 0.4;
        }

        100% {
          clip-path: circle(200% at top right);
          opacity: 0;
        }
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
        background-color: rgba(var(--primary-color-rgb), 0.08);
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
        /* background: white; */
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
    {{-- @vite('resources/js/app.js') --}}
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
        <a class="nav-link text-dark @if (request()->path() === 'wardrobe') active @endif flex items-center px-6 py-3 font-medium"
          href="{{ url('wardrobe') }}">
          <i class="fas fa-archive text-primary mr-4 text-lg"></i>
          <span class="nav-text">My Wardrobe</span>
        </a>
        <a class="nav-link text-dark @if (request()->path() === 'outfits') active @endif flex items-center px-6 py-3 font-medium"
          href="{{ url('outfits') }}">
          <i class="fas fa-archive text-primary mr-4 text-lg"></i>
          <span class="nav-text">My Outfits</span>
        </a>
        <a class="nav-link text-dark @if (request()->path() === 'interests') active @endif flex items-center px-6 py-3 font-medium"
          href="{{ url('interests') }}">
          <i class="fas fa-heart text-primary mr-4 text-lg"></i>
          <span class="nav-text">Interests</span>
        </a>
        <a class="nav-link text-dark @if (request()->path() === 'wishlist') active @endif flex items-center px-6 py-3 font-medium"
          href="{{ url('wishlist') }}">
          <i class="fas fa-bookmark text-primary mr-4 text-lg"></i>
          <span class="nav-text">Wishlist</span>
        </a>
        <a class="nav-link text-dark @if (request()->path() === 'shopping') active @endif flex items-center px-6 py-3 font-medium"
          href="{{ url('shopping') }}">
          <i class="fas fa-shopping-cart text-primary mr-4 text-lg"></i>
          <span class="nav-text">Shopping</span>
        </a>
        <a class="nav-link text-dark @if (request()->path() === 'orders') active @endif flex items-center px-6 py-3 font-medium"
          href="{{ url('orders') }}">
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
              {{ ucfirst($currentUser->name[0]) }}
            </div>
            <div class="ml-3">
              <p class="user-name text-dark text-sm font-semibold">
                {{ ucfirst($currentUser->name) }}
              </p>
              <p class="user-status text-xs text-gray-500">
                {{ $currentUser->plan->name }} Member
              </p>
            </div>
          </div>
          <button class="w-3 hover:text-[var(--primary-color)]" id="sidebarUserMenu">
            <i class="fas fa-ellipsis-v"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Profile Dropdown - Positioned closer to trigger -->
    <div class="profile-dropdown" id="profileDropdown">
      <a class="border-gray-200" href="{{ route('settings.index') }}">
        <div class="profile-item rounded-t-xl">
          <i class="fas fa-cog mr-3 text-gray-500"></i>
          <span class="text-sm">Settings</span>
        </div>
      </a>

      <div class="border-t border-gray-200">
        <a class="profile-item rounded-b-xl" href="javascript:void(0);"
          onclick="document.getElementById('logoutform').submit()">
          <i class="fas fa-sign-out-alt mr-3 text-gray-500"></i>
          <span class="text-sm">Log Out</span>
        </a>
        <form action="{{ route('logout') }}" id="logoutform" method="POST"
          style="display:none">
          @csrf
        </form>
      </div>
    </div>

    <!-- Toggle Button - Moves with sidebar -->
    <button class="toggle-btn hover:text-primary text-gray-500" id="toggleSidebar">
      <i class="fas fa-chevron-left text-sm"></i>
    </button>

    <!-- Main Content -->
    <div class="main-content min-h-screen" id="mainContent">
      <!-- Top Bar -->
      <div
        class="sticky top-0 z-40 flex items-center justify-between bg-white px-6 py-5 shadow-sm">
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
          <div class="relative flex">
            <button
              class="text-primary border-primary relative rounded-full border px-2 py-1 font-medium transition hover:bg-[rgba(var(--primary-color-rgb),0.3)]"
              id="bellIcon">
              <i class="fas fa-bell"></i>
            </button>
            {{-- TODO: Check if there are new notifications. Then display this if there are notifications --}}
            <span class="absolute -right-0.5 top-0.5 flex size-3">
              <span
                class="bg-primary absolute inline-flex h-full w-full animate-ping rounded-full opacity-75"></span>
              <span class="bg-primary relative inline-flex size-3 rounded-full"></span>
            </span>
          </div>

          <!-- Top Bar User Profile -->
          <div class="topbar-profile relative">
            <div class="flex cursor-pointer items-center space-x-2" id="topbarUser">
              <div
                class="bg-primary flex h-8 w-8 items-center justify-center rounded-full font-bold text-white">
                {{ strtoupper($currentUser->name[0]) }}
              </div>
            </div>

            <!-- Top Bar Dropdown -->
            <div class="topbar-dropdown" id="topbarDropdown">
              <div class="border-gray-200">
                <a class="profile-item rounded-t-xl" href="{{ route('settings.index') }}">
                  <i class="fas fa-cog mr-3 text-gray-500"></i>
                  <span class="text-sm">Settings</span>
                </a>
              </div>
              <div class="border-t border-gray-200">
                <a class="profile-item rounded-b-xl" href="javascript:void(0);"
                  onclick="document.getElementById('logoutform').submit()">
                  <i class="fas fa-sign-out-alt mr-3 text-gray-500"></i>
                  <span class="text-sm">Log Out</span>
                </a>
                <form action="{{ route('logout') }}" id="logoutform" method="POST"
                  style="display:none">
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

    <div class="fixed right-4 top-4 z-[9999] space-y-2" id="toast-container"></div>
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

      function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');

        toast.className =
          "px-4 py-3 rounded-lg shadow-lg text-white animate-fade mb-2 " +
          (type === "error" ? "bg-red-600" : "bg-green-600");

        toast.innerText = message;

        container.appendChild(toast);

        setTimeout(() => {
          toast.style.opacity = "0";
          setTimeout(() => toast.remove(), 500);
        }, 3000);
      }

      class ThemeManager {
        constructor() {
          this.initThemeListeners();
          this.loadServerPreferences(); // Use server values as source of truth
          this.initializeHighContrast();

          // Listen for custom events from settings page
          document.addEventListener('themeChanged', (e) => {
            this.setTheme(e.detail.theme);
          });

          document.addEventListener('colorSchemeChanged', (e) => {
            this.setColorScheme(e.detail.scheme);
          });

          document.addEventListener('highContrastChanged', (e) => {
            this.setHighContrast(e.detail.enabled);
          });
        }

        initThemeListeners() {
          // Listen for changes on theme radio buttons
          document.addEventListener('change', (e) => {
            if (e.target.name === 'theme') {
              this.setTheme(e.target.value);
              this.saveToServer('theme', e.target.value);
            }

            if (e.target.name === 'color_scheme') {
              this.setColorScheme(e.target.value);
              this.saveToServer('color_scheme', e.target.value);
            }

            if (e.target.name === 'high_contrast') {
              this.setHighContrast(e.target.checked);
            }
          });
        }

        loadServerPreferences() {
          // Use ONLY server values as source of truth
          const serverTheme = '{{ $currentUser->theme ?? 'light' }}';
          const serverColorScheme = '{{ $currentUser->color_scheme ?? 'primary' }}';
          const serverHighContrast = {{ $currentUser->high_contrast ? 'true' : 'false' }};

          console.log('Loading server preferences:', {
            theme: serverTheme,
            colorScheme: serverColorScheme,
            highContrast: serverHighContrast
          });

          // Apply server values directly to the UI
          this.applyThemeToUI(serverTheme);
          this.applyColorSchemeToUI(serverColorScheme);
          this.applyHighContrastToUI(serverHighContrast);

          // Sync localStorage with server values
          localStorage.setItem('theme', serverTheme);
          localStorage.setItem('color_scheme', serverColorScheme);
          localStorage.setItem('high_contrast', serverHighContrast ? '1' : '0');
        }

        applyThemeToUI(theme) {
          document.documentElement.setAttribute('data-theme', theme);
          this.updateThemeColor(theme);

          // Update theme selection inputs
          document.querySelectorAll('input[name="theme"][value="' + theme + '"]').forEach(input => {
            input.checked = true;
            const parentOption = input.closest('.theme-option');
            if (parentOption) {
              document.querySelectorAll('.theme-option').forEach(opt => opt.classList.remove(
                'active'));
              parentOption.classList.add('active');
            }
          });
        }

        applyColorSchemeToUI(scheme) {
          document.documentElement.setAttribute('data-color-scheme', scheme);
          this.updateColorVariables(scheme);

          // Update color scheme selection inputs
          document.querySelectorAll('input[name="color_scheme"][value="' + scheme + '"]').forEach(
            input => {
              input.checked = true;
              const parentOption = input.closest('.color-scheme-option');
              if (parentOption) {
                document.querySelectorAll('.color-scheme-option').forEach(opt => opt.classList
                  .remove('active'));
                parentOption.classList.add('active');
              }
            });
        }

        applyHighContrastToUI(enabled) {
          document.documentElement.setAttribute('data-high-contrast', enabled);

          // Update high contrast toggle
          document.querySelectorAll('input[name="high_contrast"]').forEach(input => {
            input.checked = enabled;
            const slider = input.nextElementSibling;
            if (slider && slider.classList.contains('toggle-slider')) {
              if (enabled) {
                slider.classList.add('active');
              } else {
                slider.classList.remove('active');
              }
            }
          });
        }

        setTheme(theme) {
          playThemeTransition();

          setTimeout(() => {
            this.applyThemeToUI(theme);
            this.updateColorSchemeDependentElements();
            updateToggleColors();
          }, 50);
        }

        setColorScheme(scheme) {
          playThemeTransition();

          setTimeout(() => {
            this.applyColorSchemeToUI(scheme);
            this.updateColorSchemeDependentElements();
            updateToggleColors();
          }, 50);
        }

        setHighContrast(enabled) {
          playThemeTransition();

          setTimeout(() => {
            this.applyHighContrastToUI(enabled);
            this.updateColorSchemeDependentElements();
            updateToggleColors();
          }, 50);
        }

        initializeHighContrast() {}

        setPrimaryColorRGB(color) {
          let r, g, b;

          if (color.startsWith('#')) {
            if (color.length === 4) {
              r = parseInt(color[1] + color[1], 16);
              g = parseInt(color[2] + color[2], 16);
              b = parseInt(color[3] + color[3], 16);
            } else {
              r = parseInt(color.substr(1, 2), 16);
              g = parseInt(color.substr(3, 2), 16);
              b = parseInt(color.substr(5, 2), 16);
            }
          } else {
            const match = color.match(/rgb\((\d+),\s*(\d+),\s*(\d+)\)/);
            if (match) {
              r = parseInt(match[1]);
              g = parseInt(match[2]);
              b = parseInt(match[3]);
            } else {
              r = 159;
              g = 122;
              b = 234;
            }
          }

          document.documentElement.style.setProperty('--primary-color-rgb', `${r}, ${g}, ${b}`);
        }

        async saveToServer(key, value) {
          try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute(
              'content');
            if (!csrfToken) {
              console.warn('CSRF token not found');
              return;
            }

            console.log('Saving to server:', key, value);

            const response = await fetch("{{ route('settings.app-preferences.update') }}", {
              method: 'PATCH',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
              },
              body: JSON.stringify({
                [key]: value
              })
            });

            if (response.ok) {
              const result = await response.json();
              console.log('Successfully saved to server:', result);

              // Update localStorage after successful server save
              localStorage.setItem(key, value);

              // Show success message
              if (result.message) {
                showToast(result.message, 'success');
              }
            } else {
              const error = await response.json();
              console.error('Server error:', error);
              showToast(error.message || 'Failed to save preferences', 'error');
            }
          } catch (error) {
            console.error('Network error:', error);
            showToast('Network error: Could not save preferences', 'error');
          }
        }

        updateThemeColor(theme) {
          const themeColors = {
            light: '#ffffff',
            dark: '#1a1a1a',
            auto: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#1a1a1a' : '#ffffff'
          };

          const metaThemeColor = document.querySelector('meta[name="theme-color"]');
          if (metaThemeColor) {
            metaThemeColor.setAttribute('content', themeColors[theme] || '#ffffff');
          }
        }

        updateColorVariables(scheme) {
          const colorSchemes = {
            primary: {
              '--primary-color': '#9F7AEA',
              '--secondary-color': '#4FD1C5',
              '--accent-color': '#FC8181',
              '--success-color': '#68D391'
            },
            secondary: {
              '--primary-color': '#4FD1C5',
              '--secondary-color': '#9F7AEA',
              '--accent-color': '#FC8181',
              '--success-color': '#68D391'
            },
            accent: {
              '--primary-color': '#FC8181',
              '--secondary-color': '#4FD1C5',
              '--accent-color': '#9F7AEA',
              '--success-color': '#68D391'
            },
            success: {
              '--primary-color': '#68D391',
              '--secondary-color': '#4FD1C5',
              '--accent-color': '#FC8181',
              '--success-color': '#9F7AEA'
            },
            'yellow-500': {
              '--primary-color': '#EAB308',
              '--secondary-color': '#4FD1C5',
              '--accent-color': '#FC8181',
              '--success-color': '#68D391'
            },
            'pink-500': {
              '--primary-color': '#EC4899',
              '--secondary-color': '#4FD1C5',
              '--accent-color': '#FC8181',
              '--success-color': '#68D391'
            }
          };

          const colors = colorSchemes[scheme] || colorSchemes.primary;
          const root = document.documentElement;

          Object.entries(colors).forEach(([property, value]) => {
            root.style.setProperty(property, value);
          });

          this.updateColorSchemeDependentElements();
          updateToggleColors();
        }

        updateColorSchemeDependentElements() {
          const primaryColor = getComputedStyle(document.documentElement).getPropertyValue(
            '--primary-color').trim();
          const borderColor = getComputedStyle(document.documentElement).getPropertyValue(
            '--border-color').trim();

          this.setPrimaryColorRGB(primaryColor);

          // Update active nav links
          document.querySelectorAll('.nav-link.active').forEach(link => {
            link.style.borderRightColor = primaryColor;
          });

          // Update theme and color scheme option borders
          document.querySelectorAll('.theme-option.active, .color-scheme-option.active').forEach(
            element => {
              element.style.borderColor = primaryColor;
            });

          document.querySelectorAll('.theme-option:not(.active), .color-scheme-option:not(.active)')
            .forEach(element => {
              element.style.borderColor = borderColor;
            });

          // Update tags and badges
          document.querySelectorAll('.tag').forEach(tag => {
            tag.style.backgroundColor = primaryColor + '20';
            tag.style.color = primaryColor;
          });
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

      function playThemeTransition() {
        // Remove any existing overlay
        const existingOverlay = document.querySelector('.theme-transition-overlay');
        if (existingOverlay) {
          existingOverlay.remove();
        }

        // Create new overlay
        const overlay = document.createElement('div');
        overlay.className = 'theme-transition-overlay';

        // Use current primary color
        const primaryColor = getComputedStyle(document.documentElement).getPropertyValue(
          '--primary-color').trim();
        overlay.style.background = primaryColor;

        // Add to body
        document.body.appendChild(overlay);

        // Remove after animation
        setTimeout(() => {
          if (overlay.parentNode) {
            overlay.parentNode.removeChild(overlay);
          }
        }, 700);
      }

      // Call this when color scheme changes
      document.addEventListener('colorSchemeChanged', updateToggleColors);
      document.addEventListener('themeChanged', updateToggleColors);

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

      // Initialize theme manager immediately
      // document.addEventListener('DOMContentLoaded', function() {
      //   window.themeManager = new ThemeManager();
      //   // Initialize toggle colors
      //   updateToggleColors();

      //   // Update colors when toggles are changed - use event delegation
      //   document.addEventListener('change', function(e) {
      //     if (e.target.type === 'checkbox' && e.target.closest('.toggle-switch')) {
      //       setTimeout(updateToggleColors, 10);
      //     }
      //   });

      //   // Initialize subscription status color
      //   const subscriptionStatus = document.querySelector('.subscription-status');
      //   if (subscriptionStatus) {
      //     const status = subscriptionStatus.getAttribute('data-status');
      //     if (status === 'active') {
      //       subscriptionStatus.style.color = getComputedStyle(document.documentElement)
      //         .getPropertyValue('--success-color').trim();
      //     } else {
      //       subscriptionStatus.style.color = getComputedStyle(document.documentElement)
      //         .getPropertyValue('--text-secondary').trim();
      //     }
      //   }
      // });

      document.addEventListener('DOMContentLoaded', function() {
        window.themeManager = new ThemeManager();
        updateToggleColors();
      });

      // Close dropdowns on escape key
      document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
          closeAllDropdowns();
        }
      });
      window.playThemeTransition = playThemeTransition;
    </script>
    @stack('scripts')
  </body>

</html>
