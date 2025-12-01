@extends('layouts.auth')

@section('title', 'Login')

@section('header')
  <p class="mt-2 text-white opacity-80">Verify your account</p>
  <p class="mt-2 text-white opacity-80">We have sent a one time password to your email. </p>
@endsection

@section('content')
  <form action="{{ route('verification') }}" id='verifyForm' method="post">
    @csrf
    <!-- Email Field -->
    <div class="mb-6 space-y-8">
      <div class="relative">
        <i
          class="fas fa-envelope absolute left-4 top-1/2 z-10 -translate-y-1/2 transform text-white text-opacity-70"></i>
        <input class="form-input w-full cursor-not-allowed rounded-xl py-4 pl-12 pr-4" id="email"
          name="email" readonly required type="email" value="{{ $email }}">
      </div>

      <div class="relative">
        <i
          class="fas fa-lock absolute left-4 top-1/2 z-10 -translate-y-1/2 transform text-white text-opacity-70"></i>
        <input autocomplete="one-time-code" class="form-input w-full rounded-xl py-4 pl-12 pr-4"
          id="otpInput" inputmode="numeric" maxlength="6" name="otp" pattern="\d{6}"
          placeholder="Enter One Time Password" required type="text">
      </div>
      @error('otp')
        <p class="mt-0.5 text-sm text-red-700">
          {{ $message }}
        </p>
      @enderror

      <!-- Submit Button -->
      <button
        class="mt-2 w-full cursor-pointer rounded-xl border-none bg-white/70 py-4 text-base font-medium text-purple-700 transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-lg active:translate-y-0 disabled:transform-none disabled:cursor-not-allowed disabled:bg-white/40 disabled:opacity-50 disabled:hover:shadow-none"
        disabled id="verifyBtn" type="submit">
        Verify
      </button>

      <!-- Login Link -->
      <div class="flex items-center justify-center gap-2 text-white">
        <i class="fas fa-arrow-left text-white opacity-70"></i>
        <a href="{{ route('login') }}">Go back</a>
      </div>
  </form>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const otpInput = document.getElementById('otpInput');
      const verifyBtn = document.getElementById('verifyBtn');
      const verifyForm = document.getElementById('verifyForm');

      if (!otpInput || !verifyBtn) return;

      function sanitizeAndTrim(value) {
        return (value || '').replace(/\D/g, '').slice(0, 6);
      }

      otpInput.value = sanitizeAndTrim(otpInput.value);
      verifyBtn.disabled = otpInput.value.length !== 6;

      otpInput.addEventListener('input', () => {
        otpInput.value = sanitizeAndTrim(otpInput.value);
        const enabled = otpInput.value.length === 6;
        const submitted = verifyBtn.dataset.submitted === '1';
        verifyBtn.disabled = !(enabled && !submitted);
      });

      // handle paste to ensure only digits are accepted
      otpInput.addEventListener('paste', (e) => {
        e.preventDefault();
        const paste = (e.clipboardData || window.clipboardData).getData('text') || '';
        otpInput.value = sanitizeAndTrim(paste);
        otpInput.dispatchEvent(new Event('input'));
      });

      if (verifyForm && verifyBtn) {
        verifyForm.addEventListener('submit', function(e) {
          if (verifyBtn.dataset.submitted === '1') {
            e.preventDefault();
            return;
          }

          if (verifyBtn.disabled) {
            e.preventDefault();
            return;
          }

          verifyBtn.dataset.submitted = '1';
          verifyBtn.disabled = true;
          verifyBtn.setAttribute('aria-busy', 'true');
          verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Verifying...';
          verifyBtn.classList.add('opacity-50', 'cursor-not-allowed');
        });
      }
    });
  </script>
@endpush
