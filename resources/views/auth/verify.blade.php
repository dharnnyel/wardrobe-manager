@extends('layouts.auth')

@section('title', 'Login')

@section('header')
  <p class="mt-2 text-white opacity-80">Verify your account</p>
  <p class="mt-2 text-white opacity-80">We have sent a one time password to your email. </p>
@endsection

@section('content')
  <form action="{{ route('verification') }}" method="post">
    @csrf
    <!-- Email Field -->
    <div class="mb-6 space-y-8">
      <div class="relative">
        <i
          class="fas fa-envelope absolute left-4 top-1/2 z-10 -translate-y-1/2 transform text-white text-opacity-70"></i>
        <input class="form-input w-full cursor-not-allowed rounded-xl py-4 pl-12 pr-4" readonly id="email"
          name="email" required type="email" value="{{ $email }}">
      </div>

      <div class="relative">
        <i
          class="fas fa-lock absolute left-4 top-1/2 z-10 -translate-y-1/2 transform text-white text-opacity-70"></i>
        <input class="form-input w-full rounded-xl py-4 pl-12 pr-4" placeholder="Enter One Time Password"
          required type="text" name="otp">
          @error('otp')
            <div class="mt-2 text-sm text-red-600">
              {{ $message }}
          </div>
          @enderror
        
      </div>

      <!-- Submit Button -->
      <button type="submit" class="w-full rounded-xl border-none bg-white/20 p-3.5 text-base  text-white font-semibold transition-all duration-75 ease-in">
        Verify
      </button>

      <!-- Login Link -->
      <div class="flex items-center justify-center gap-2 text-white">
        <i class="fas fa-arrow-left text-white opacity-70"></i>
        <a href="{{route('login')}}">Go back</a>
      </div>
  </form>
@endsection

@push('scripts')

@endpush
      