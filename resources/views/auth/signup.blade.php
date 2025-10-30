@extends('layouts.auth')

@section('title', 'Register')

@section('header')
  <h1 class="text-xl font-medium text-white">Create Your Account</h1>
  <p class="mt-2 font-normal text-white text-opacity-80">Join StyleHub to manage your wardrobe</p>
@endsection

@section('content')
  <form id="registrationForm">
    <!-- Name Fields -->
    <div class="mb-6 flex gap-4">
      <div class="relative flex-1">
        <i
          class="fas fa-user absolute left-4 top-1/2 z-10 -translate-y-1/2 transform text-white text-opacity-70"></i>
        <input class="form-input w-full rounded-xl py-4 pl-12 pr-4" placeholder="First Name" required
          type="text">
      </div>
      <div class="relative flex-1">
        <input class="form-input w-full rounded-xl px-4 py-4" placeholder="Last Name" required
          type="text">
      </div>
    </div>

    <!-- Email Field -->
    <div class="relative mb-6">
      <i
        class="fas fa-envelope absolute left-4 top-1/2 z-10 -translate-y-1/2 transform text-white text-opacity-70"></i>
      <input class="form-input w-full rounded-xl py-4 pl-12 pr-4" placeholder="Email Address" required
        type="email">
    </div>

    <!-- Password Field -->
    <div class="relative mb-2">
      <i
        class="fas fa-lock absolute left-4 top-1/2 z-10 -translate-y-1/2 transform text-white text-opacity-70"></i>
      <input class="form-input w-full rounded-xl py-4 pl-12 pr-12" id="password"
        placeholder="Password" required type="password">
      <button
        class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 transform cursor-pointer border-none bg-transparent text-white text-opacity-70"
        id="togglePassword" type="button">
        <i class="fas fa-eye"></i>
      </button>
    </div>
    <p class="mb-6 ml-12 text-xs font-normal text-white text-opacity-70">Use 8+ characters with a mix
      of letters, numbers & symbols</p>

    <!-- Confirm Password Field -->
    <div class="relative mb-6">
      <i
        class="fas fa-lock absolute left-4 top-1/2 z-10 -translate-y-1/2 transform text-white text-opacity-70"></i>
      <input class="form-input w-full rounded-xl py-4 pl-12 pr-12" id="confirmPassword"
        placeholder="Confirm Password" required type="password">
      <button
        class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 transform cursor-pointer border-none bg-transparent text-white text-opacity-70"
        id="toggleConfirmPassword" type="button">
        <i class="fas fa-eye"></i>
      </button>
    </div>

    <!-- Terms and Conditions -->
    <div class="mb-6 flex items-start font-normal text-white text-opacity-80">
      <input class="mr-3 mt-1" id="terms" required type="checkbox">
      <label for="terms">
        I agree to the <a class="font-medium text-white no-underline hover:underline"
          href="#">Terms of Service</a> and <a
          class="font-medium text-white no-underline hover:underline" href="#">Privacy
          Policy</a>
      </label>
    </div>

    <!-- Submit Button -->
    <button
      class="submit-btn mt-2 w-full cursor-pointer rounded-xl border-none bg-white bg-opacity-90 py-4 text-base font-medium text-purple-700 transition-all duration-300 ease-in-out hover:-translate-y-1 hover:bg-white hover:shadow-lg"
      type="submit">
      Create Account
    </button>

    <!-- Divider -->
    <div class="my-6 flex items-center text-white text-opacity-70">
      <div class="flex-1 border-b border-white border-opacity-30"></div>
      <span class="px-4 text-sm font-normal">Or sign up with</span>
      <div class="flex-1 border-b border-white border-opacity-30"></div>
    </div>

    <!-- Social Sign Up -->
    <div class="mb-6 flex gap-4">
      <button
        class="social-btn flex flex-1 cursor-pointer items-center justify-center rounded-xl py-3 font-normal text-white transition-all duration-300 ease-in-out hover:-translate-y-1"
        type="button">
        <i class="fab fa-google mr-2 text-red-500"></i>
        Google
      </button>
      <button
        class="social-btn flex flex-1 cursor-pointer items-center justify-center rounded-xl py-3 font-normal text-white transition-all duration-300 ease-in-out hover:-translate-y-1"
        type="button">
        <i class="fab fa-facebook-f mr-2 text-blue-500"></i>
        Facebook
      </button>
    </div>

    <!-- Login Link -->
    <div class="mt-6 text-center font-normal text-white text-opacity-80">
      Already have an account? <a class="font-medium text-white no-underline hover:underline"
        href="{{ url('login') }}">Sign In</a>
    </div>
  </form>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const passwordInput = document.getElementById('password');
      const confirmPasswordInput = document.getElementById('confirmPassword');
      const togglePasswordBtn = document.getElementById('togglePassword');
      const toggleConfirmPasswordBtn = document.getElementById('toggleConfirmPassword');

      // Toggle password visibility
      togglePasswordBtn.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
      });

      // Toggle confirm password visibility
      toggleConfirmPasswordBtn.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' :
          'password';
        confirmPasswordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
      });

      // Social sign up buttons
      document.querySelectorAll('.social-btn').forEach(button => {
        button.addEventListener('click', function() {
          const platform = this.textContent.trim();
          alert(`${platform} sign up would be implemented here.`);
        });
      });

      // Form submission
      document.getElementById('registrationForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Password validation
        if (passwordInput.value !== confirmPasswordInput.value) {
          alert('Passwords do not match. Please try again.');
          return;
        }

        // Check if terms are accepted
        if (!document.getElementById('terms').checked) {
          alert('Please accept the Terms of Service and Privacy Policy.');
          return;
        }

        // In a real application, you would handle registration logic here
        // alert('Registration successful! You can now sign in to your account.');

        console.log('Redirecting to dashboard...'); // Debug line
        console.log('Dashboard URL:', "{{ url('dashboard') }}"); // Debug line

        // Redirect to dashboard page after successful registration
        window.location.href = "{{ url('dashboard') }}";
      });
    });
  </script>
@endpush
