@extends('layouts.auth')

@section('title', 'Login')

@section('header')
  <p class="mt-2 text-white opacity-80">Verify your account</p>
@endsection

@section('content')
  <form action="{{ route('login') }}" method="post">
    @csrf
    <!-- Email Field -->
    <div class="mb-6 space-y-8">
      <div class="relative">
        <i
          class="fas fa-envelope absolute left-4 top-1/2 z-10 -translate-y-1/2 transform text-white text-opacity-70"></i>
        <input class="form-input w-full cursor-not-allowed rounded-xl py-4 pl-12 pr-4" disabled id="email"
          name="email" required type="email" value="{{ $email }}">
      </div>

      <div class="relative">
        <i
          class="fas fa-lock absolute left-4 top-1/2 z-10 -translate-y-1/2 transform text-white text-opacity-70"></i>
        <input class="form-input w-full rounded-xl py-4 pl-12 pr-4" placeholder="One Time Password"
          required type="password">
        <i
          class="fas fa-eye absolute right-4 top-1/2 z-10 -translate-y-1/2 transform text-white opacity-70"></i>
      </div>

      <!-- Submit Button -->
      <button
        class="w-full rounded-xl border-none bg-white/20 p-3.5 text-base  text-white font-semibold transition-all duration-75 ease-in cursor-not-allowed"
        type="submit" disabled>
        Verify
      </button>

      <!-- Login Link -->
      <div class="flex items-center justify-center gap-2 text-white">
        <i class="fas fa-arrow-left text-white opacity-70"></i>
        <a href="#">Go back</a>
      </div>
  </form>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const verify = document.getElementById('verify');
      const verifyNowLink = document.getElementById('verifyNowLink');
      const getOtpBtn = document.getElementById('getOtpBtn');
      const loginForm = document.getElementById('loginForm');
      const emailInput = document.getElementById('email');

      // Store the original form content
      const originalFormContent = loginForm.innerHTML;

      // Social sign in buttons
      document.querySelectorAll('.social-btn').forEach(button => {
        button.addEventListener('click', function() {
          const platform = this.textContent.trim();
          alert(`${platform} sign in would be implemented here.`);
        });
      });

      // Get OTP form submission
      loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Show the verify message
        verify.classList.remove('hidden');

        // Store the email for the OTP verification
        sessionStorage.setItem('userEmail', emailInput.value);
      });

      // Verify Now link click handler
      verifyNowLink.addEventListener('click', function(e) {
        e.preventDefault();
        switchToOtpForm();
      });

      function switchToOtpForm() {
        // Get the stored email
        const userEmail = sessionStorage.getItem('userEmail') || '';

        // Update the form to OTP verification
        loginForm.innerHTML = `
          <!-- OTP Field -->
          <div class="mb-6 space-y-4">
            <div class="relative">
              <i class="fas fa-envelope absolute left-4 top-1/2 z-10 -translate-y-1/2 transform text-white text-opacity-70"></i>
              <input type="email" class="form-input w-full rounded-xl py-4 pl-12 pr-12" disabled value="${userEmail}">
            </div>
            <div class="relative">
              <i class="fas fa-lock absolute left-4 top-1/2 z-10 -translate-y-1/2 transform text-white text-opacity-70"></i>
              <input type="password" class="form-input w-full rounded-xl py-4 pl-12 pr-12" placeholder="One Time Password" required id="otpInput">
              <button type="button" id="toggleOtp" class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 bg-transparent border-none text-white text-opacity-70 cursor-pointer">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>

          <!-- Verify Button -->
          <button type="submit"
            class="submit-btn mt-2 w-full cursor-pointer rounded-xl border-none bg-white bg-opacity-90 py-4 text-base font-medium text-purple-700 transition-all duration-300 ease-in-out hover:-translate-y-1 hover:bg-white hover:shadow-lg">
            Verify
          </button>

          <!-- Go Back Link -->
          <div class="mt-4 text-center">
            <a href="#" id="goBackLink" class="text-white font-medium no-underline hover:underline">Go back</a>
          </div>
        `;

<<<<<<< HEAD
        // Add event listener for the new OTP toggle button
        const toggleOtpBtn = document.getElementById('toggleOtp');
        const otpInput = document.getElementById('otpInput');

        toggleOtpBtn.addEventListener('click', function() {
          const type = otpInput.getAttribute('type') === 'password' ? 'text' : 'password';
          otpInput.setAttribute('type', type);
          this.querySelector('i').classList.toggle('fa-eye');
          this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        // Add event listener for the go back link
        const goBackLink = document.getElementById('goBackLink');
        goBackLink.addEventListener('click', function(e) {
          e.preventDefault();
          switchToEmailForm();
        });

        // Update form submission for OTP verification
        loginForm.addEventListener('submit', function(e) {
          e.preventDefault();
          // Handle OTP verification logic here
          const otp = otpInput.value;
          if (otp) {
            alert('OTP verification successful! Redirecting to dashboard...');
            window.location.href = "{{ url('dashboard') }}";
          } else {
            alert('Please enter the OTP.');
          }
        });
      }

      function switchToEmailForm() {
        // Restore the original form content
        loginForm.innerHTML = originalFormContent;

        // Re-initialize event listeners for the original form
        initializeEmailForm();
      }

      function initializeEmailForm() {
        // Re-get the elements since we recreated the form
        const verify = document.getElementById('verify');
        const verifyNowLink = document.getElementById('verifyNowLink');
        const emailInput = document.getElementById('email');

        // Re-attach event listeners
        loginForm.addEventListener('submit', function(e) {
          e.preventDefault();
          verify.classList.remove('hidden');
          sessionStorage.setItem('userEmail', emailInput.value);
        });

        verifyNowLink.addEventListener('click', function(e) {
          e.preventDefault();
          switchToOtpForm();
        });

        // Re-attach social button listeners
        document.querySelectorAll('.social-btn').forEach(button => {
          button.addEventListener('click', function() {
            const platform = this.textContent.trim();
            alert(`${platform} sign in would be implemented here.`);
          });
        });
      }
    });
  </script>
@endpush
=======
      // Add event listener for the new OTP toggle button
      const toggleOtpBtn = document.getElementById('toggleOtp');
      const otpInput = document.getElementById('otpInput');

      toggleOtpBtn.addEventListener('click', function() {
        const type = otpInput.getAttribute('type') === 'password' ? 'text' : 'password';
        otpInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
      });

      // Add event listener for the go back link
      const goBackLink = document.getElementById('goBackLink');
      goBackLink.addEventListener('click', function(e) {
        e.preventDefault();
        switchToEmailForm();
      });

      // Update form submission for OTP verification
      loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Handle OTP verification logic here
        const otp = otpInput.value;
        if (otp) {
          alert('OTP verification successful! Redirecting to dashboard...');
          window.location.href = "{{ url('dashboard') }}";
        } else {
          alert('Please enter the OTP.');
        }
      });
    }

    function switchToEmailForm() {
      // Restore the original form content
      loginForm.innerHTML = originalFormContent;

      // Re-initialize event listeners for the original form
      initializeEmailForm();
    }

    function initializeEmailForm() {
      // Re-get the elements since we recreated the form
      const verify = document.getElementById('verify');
      const verifyNowLink = document.getElementById('verifyNowLink');
      const emailInput = document.getElementById('email');

      // Re-attach event listeners
      loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        verify.classList.remove('hidden');
        sessionStorage.setItem('userEmail', emailInput.value);
      });

      verifyNowLink.addEventListener('click', function(e) {
        e.preventDefault();
        switchToOtpForm();
      });

      // Re-attach social button listeners
      document.querySelectorAll('.social-btn').forEach(button => {
        button.addEventListener('click', function() {
          const platform = this.textContent.trim();
          alert(`${platform} sign in would be implemented here.`);
        });
      });
    }
  });
</script>
@endpush
>>>>>>> 3e7605c621a37e31cf6148a739848ff812763e50
