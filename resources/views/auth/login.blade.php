@extends('layouts.auth')

@section('title', 'Login')

@section('header')
  <p class="mt-2 text-white opacity-80">Sign in to your StyleHub account</p>
@endsection

@section('content')
  <form action="{{ route('login') }}" id="loginForm" method="post">
    @csrf
    <!-- Email Field -->
    <div class="mb-6">
      <div class="relative">
        <i
          class="fas fa-envelope absolute left-4 top-1/2 z-10 -translate-y-1/2 transform text-white text-opacity-70"></i>
        <input class="form-input w-full rounded-xl py-4 pl-12 pr-4" id="email" name="email"
          placeholder="Email Address" required type="email">
        @error('email')
          <div class="mt-2 text-sm text-red-600">
            {{ $message }}
          </div>
        @enderror
      </div>
    </div>

    <!-- Submit Button -->
    <button
      class="submit-btn mt-2 w-full cursor-pointer rounded-xl border-none bg-white/70 py-4 text-base font-medium text-purple-700 transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-lg active:translate-y-0 disabled:transform-none disabled:cursor-not-allowed disabled:bg-white/40 disabled:opacity-50 disabled:hover:shadow-none"
      disabled id="getOtpBtn" type="submit">
      Get OTP
    </button>

    <!-- Divider -->
    <div class="my-6 flex items-center text-white text-opacity-70">
      <div class="flex-1 border-b border-white border-opacity-30"></div>
      <span class="px-4 text-sm font-normal">Or sign in with</span>
      <div class="flex-1 border-b border-white border-opacity-30"></div>
    </div>

    <!-- Social Sign In -->
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

    <!-- Register Link -->
    <div class="mt-6 text-center font-normal text-white text-opacity-80">
      Don't have an account? <a class="font-medium text-white no-underline hover:underline"
        href="{{ url('signup') }}">Create Account</a>
    </div>
  </form>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const getOtpBtn = document.getElementById('getOtpBtn');
      const loginForm = document.getElementById('loginForm');
      const emailInput = document.getElementById('email');

      const allowedDomains = [
        'gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com',
        'icloud.com', 'live.com', 'aol.com', 'protonmail.com', 'zoho.com', 'me.com'
      ];

      function isValidEmailFormat(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
      }

      function hasAllowedDomain(email) {
        const at = email.lastIndexOf('@');
        if (at === -1) return false;
        const domain = email.slice(at + 1).toLowerCase();
        return allowedDomains.some(d => domain === d || domain.endsWith('.' + d));
      }

      function updateGetOtpButton() {
        if (!getOtpBtn || !emailInput) return;
        const submitted = getOtpBtn.dataset.submitted === '1';
        const val = (emailInput.value || '').trim();
        const ok = isValidEmailFormat(val) && hasAllowedDomain(val);
        const shouldEnable = ok && !submitted;
        getOtpBtn.disabled = !shouldEnable;
        getOtpBtn.classList.toggle('opacity-50', !shouldEnable);
        getOtpBtn.classList.toggle('cursor-not-allowed', !shouldEnable);
      }

      function attachEmailValidation() {
        if (!emailInput || !getOtpBtn) return;
        getOtpBtn.disabled = true;
        getOtpBtn.dataset.submitted = getOtpBtn.dataset.submitted || '0';
        emailInput.addEventListener('input', updateGetOtpButton);
        updateGetOtpButton();
      }

      if (loginForm && getOtpBtn) {
        loginForm.addEventListener('submit', function (e) {
          if (getOtpBtn.dataset.submitted === '1') {
            e.preventDefault();
            return;
          }

          if (getOtpBtn.disabled) {
            e.preventDefault();
            return;
          }

          getOtpBtn.dataset.submitted = '1';
          getOtpBtn.disabled = true;
          getOtpBtn.setAttribute('aria-busy', 'true');

          getOtpBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';

          getOtpBtn.classList.add('opacity-50', 'cursor-not-allowed');
        });
      }

      attachEmailValidation();
    });
  </script>
@endpush
