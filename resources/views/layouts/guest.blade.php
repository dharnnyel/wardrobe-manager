<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>StyleHub Wardrobe Manager - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
      rel="stylesheet">
    <!-- Favicon -->
    <link href="{{ asset('favicon/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
    <link href="{{ asset('favicon/favicon-32x32.png') }}" rel="icon" sizes="32x32"
      type="image/png">
    <link href="{{ asset('favicon/favicon-16x16.png') }}" rel="icon" sizes="16x16"
      type="image/png">
    <link href="{{ asset('favicon/site.webmanifest') }}" rel="manifest">
    <link href="{{ asset('favicon/favicon.ico') }}" rel="shortcut icon">

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
              success: '#68D391'
            },
            fontFamily: {
              'inter': ['Inter', 'sans-serif']
            }
          }
        }
      }
    </script>
    @stack('scripts')
    <style>
      body {
        font-family: 'Inter', sans-serif;
      }

      .gradient-bg {
        background: linear-gradient(135deg, #9F7AEA 0%, #4FD1C5 100%);
      }

      .feature-card:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
      }

      .nav-link {
        position: relative;
      }

      .nav-link:after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -5px;
        left: 0;
        background-color: #9F7AEA;
        transition: width 0.3s ease;
      }

      .nav-link:hover:after {
        width: 100%;
      }

      /* Glassmorphism styles */
      .glass {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      }

      /* Mobile menu styles */
      #mobile-menu {
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
        width: 320px;
        height: 100vh;
        top: 0;
        right: 0;
        left: auto;
        z-index: 100;
      }

      #mobile-menu.open {
        transform: translateX(0);
      }

      .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        z-index: 60;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
      }

      .overlay.active {
        opacity: 1;
        visibility: visible;
      }

      /* Glass button styles */
      .glass-button {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
      }

      .glass-button:hover {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
      }

      /* Hide scrollbars for all browsers */
      body {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
      }

      body::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari and Opera */
      }

      /* Hide scrollbars for all scrollable elements */
      * {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
      }

      *::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari and Opera */
      }

      /* Ensure scrolling still works */
      html {
        scroll-behavior: smooth;
      }
    </style>
    @stack('styles')
  </head>

  <body class="bg-light font-inter">
    <!-- Navigation -->
    <nav
      class="sticky top-0 z-50 flex items-center justify-between bg-white/30 px-6 py-4 shadow-md backdrop-blur-sm">
      <a class="flex items-center" href="{{ url('/') }}">
        <i class="fas fa-tshirt text-primary mr-2 text-2xl"></i>
        <span class="text-dark text-xl font-bold">StyleHub</span>
      </a>
      <div class="hidden space-x-8 md:flex">
        <a class="nav-link @if (request()->path() === '/') text-primary @else text-dark @endif font-medium"
          href="{{ url('/') }}">Home</a>
        <a class="nav-link @if (request()->path() === 'features') text-primary @else text-dark @endif font-medium"
          href="{{ url('features') }}">Features</a>
        <a class="nav-link @if (request()->path() === 'pricing') text-primary @else text-dark @endif font-medium"
          href="{{ url('pricing') }}">Pricing</a>
        <a class="nav-link @if (request()->path() === 'help') text-primary @else text-dark @endif font-medium"
          href="{{ url('help') }}">Help</a>
        <a class="nav-link @if (request()->path() === 'blog') text-primary @else text-dark @endif font-medium"
          href="{{ url('blog') }}">Blog</a>
      </div>
      <div class="flex items-center space-x-4">
        <a class="text-primary border-primary hover:bg-primary hidden rounded-lg border bg-white px-4 py-2 font-medium transition hover:text-white md:block"
          href="{{ url('login') }}">Login</a>
        <button class="text-dark md:hidden" id="mobile-menu-button">
          <i class="fas fa-bars text-xl"></i>
        </button>
      </div>
    </nav>
    <!-- Mobile Menu - True Glassmorphic Design -->
    <div class="fixed right-0 top-0 z-50 h-full w-80 md:hidden" id="mobile-menu">
      <div class="glass flex h-full flex-col">
        <div class="flex items-center justify-between border-b border-white/20 px-6 py-4">
          <div class="flex items-center">
            <i class="fas fa-tshirt text-primary mr-2 text-xl"></i>
            <span class="text-dark text-lg font-bold">StyleHub</span>
          </div>
          <button class="text-dark hover:text-primary transition" id="close-mobile-menu">
            <i class="fas fa-times text-xl"></i>
          </button>
        </div>

        <div class="flex-1 overflow-y-auto px-6 py-6">
          <div class="flex flex-col space-y-4">
            <a class="glass-button @if (request()->path() === '/') text-light bg-primary hover:bg-purple-700 @else text-dark @endif flex items-center rounded-lg px-4 py-3 font-medium transition"
              href="{{ url('/') }}">
              <i
                class="fas fa-home @if (request()->path() === '/') text-light @else text-primary @endif mr-4"></i>
              <span>Home</span>
            </a>
            <a class="glass-button text-dark @if (request()->path() === 'features') text-light bg-primary hover:bg-purple-700 @else text-dark @endif flex items-center rounded-lg px-4 py-3 font-medium transition"
              href="{{ url('features') }}">
              <i
                class="fas fa-star @if (request()->path() === 'features') text-light @else text-primary @endif mr-4"></i>
              <span>Features</span>
            </a>
            <a class="glass-button @if (request()->path() === 'pricing') text-light bg-primary hover:bg-purple-700 @else text-dark @endif flex items-center rounded-lg px-4 py-3 font-medium transition"
              href="{{ url('pricing') }}">
              <i
                class="fas fa-tag @if (request()->path() === 'pricing') text-light @else text-primary @endif mr-4"></i>
              <span>Pricing</span>
            </a>
            <a class="glass-button @if (request()->path() === 'help') text-light bg-primary hover:bg-purple-700 @else text-dark @endif flex items-center rounded-lg px-4 py-3 font-medium transition"
              href="{{ url('help') }}">
              <i
                class="fas fa-question-circle @if (request()->path() === 'help') text-light @else text-primary @endif mr-4"></i>
              <span>Help</span>
            </a>
            <a class="glass-button @if (request()->path() === 'blog') text-light bg-primary hover:bg-purple-700 @else text-dark @endif flex items-center rounded-lg px-4 py-3 font-medium transition"
              href="{{ url('blog') }}">
              <i
                class="fas fa-blog @if (request()->path() === 'blog') text-light @else text-primary @endif mr-4"></i>
              <span>Blog</span>
            </a>
          </div>

          <div class="mt-8 border-t border-white/20 pt-6">
            <h4 class="text-dark mb-4 text-lg font-bold">Account</h4>
            <div class="flex flex-col space-y-4">
              <a class="bg-primary flex items-center justify-center rounded-lg px-4 py-3 font-medium text-white transition hover:bg-purple-700"
                href="{{ url('login') }}">
                <i class="fas fa-sign-in-alt mr-3"></i> Login
              </a>
            </div>
          </div>
        </div>

        <div class="border-t border-white/20 px-6 py-2">
          <div class="flex justify-center space-x-6 text-gray-600">
            <a class="hover:text-primary transition" href="#">
              <i class="fab fa-twitter text-xl"></i>
            </a>
            <a class="hover:text-primary transition" href="#">
              <i class="fab fa-facebook text-xl"></i>
            </a>
            <a class="hover:text-primary transition" href="#">
              <i class="fab fa-instagram text-xl"></i>
            </a>
          </div>
          <p class="mt-2 text-center text-sm text-gray-600">&copy; 2023 StyleHub</p>
        </div>
      </div>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-800 py-8 text-white">
      <div class="container mx-auto px-6">
        <div class="flex flex-col justify-between md:flex-row">
          <div class="mb-6 md:mb-0">
            <div class="mb-4 flex items-center">
              <i class="fas fa-tshirt text-primary mr-2 text-2xl"></i>
              <span class="text-xl font-bold">StyleHub</span>
            </div>
            <p class="max-w-xs text-gray-400">Your personal wardrobe manager for organizing,
              planning, and creating amazing outfits.</p>
          </div>

          <div class="grid grid-cols-2 gap-8 md:grid-cols-3">
            <div>
              <h4 class="mb-4 font-bold">Product</h4>
              <ul class="space-y-2 text-gray-400">
                <li><a class="hover:text-white" href="{{ url('features') }}">Features</a></li>
                <li><a class="hover:text-white" href="{{ url('pricing') }}">Pricing</a></li>
                <li><a class="hover:text-white" href="{{ url('help') }}">FAQ</a></li>
              </ul>
            </div>

            <div>
              <h4 class="mb-4 font-bold">Company</h4>
              <ul class="space-y-2 text-gray-400">
                <li><a class="hover:text-white" href="{{ url('features') }}">Features</a></li>
                <li><a class="hover:text-white" href="{{ url('blog') }}">Blog</a></li>
              </ul>
            </div>

            <div>
              <h4 class="mb-4 font-bold">Connect</h4>
              <ul class="space-y-2 text-gray-400">
                <li><a class="hover:text-white" href="#">Contact</a></li>
                <li><a class="hover:text-white" href="#">Twitter</a></li>
                <li><a class="hover:text-white" href="#">Instagram</a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="mt-8 border-t border-gray-700 pt-6 text-center text-gray-400">
          <p>&copy; 2023 StyleHub. All rights reserved.</p>
        </div>
      </div>
    </footer>

    <script>
      // Mobile menu functionality
      const mobileMenuButton = document.getElementById('mobile-menu-button');
      const mobileMenu = document.getElementById('mobile-menu');
      const closeMobileMenu = document.getElementById('close-mobile-menu');
      const overlay = document.getElementById('overlay');

      function openMobileMenu() {
        mobileMenu.classList.add('open');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
      }

      function closeMobileMenuFunc() {
        mobileMenu.classList.remove('open');
        overlay.classList.remove('active');
        document.body.style.overflow = 'auto';
      }

      mobileMenuButton.addEventListener('click', openMobileMenu);
      closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
      overlay.addEventListener('click', closeMobileMenuFunc);

      // Close mobile menu when clicking outside
      document.addEventListener('click', (event) => {
        if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
          closeMobileMenuFunc();
        }
      });
    </script>
  </body>

</html>
