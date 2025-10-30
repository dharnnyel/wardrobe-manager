@extends('layouts.guest')
@section('title', 'Pricing')
@push('styles')
  <style>
    .pricing-card {
      transition: all 0.3s ease;
    }

    .pricing-card:hover {
      transform: scale(1.05);
    }
  </style>
@endpush
@section('content')
  <!-- Hero Section -->
  <section class="gradient-bg py-16 text-white md:py-20">
    <div class="container mx-auto px-6 text-center">
      <h1 class="mb-4 text-4xl font-bold md:text-5xl">Simple, Transparent Pricing</h1>
      <p class="mx-auto mb-8 max-w-3xl text-xl">Choose the plan that works best for your wardrobe
        management needs. No hidden fees, no surprises.</p>
      <div class="flex justify-center">
        <div class="inline-flex rounded-lg bg-white/20 p-4 backdrop-blur-sm">
          <button class="text-primary mr-2 rounded-lg bg-white px-6 py-2 font-bold">Monthly</button>
          <button class="rounded-lg bg-transparent px-6 py-2 font-bold text-white">Yearly (Save
            20%)</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Pricing Plans -->
  <section class="bg-white py-16">
    <div class="container mx-auto px-6">
      <div class="mx-auto grid max-w-5xl grid-cols-1 gap-8 md:grid-cols-3">
        <!-- Free Plan -->
        <div class="bg-light pricing-card rounded-2xl border-2 border-gray-200 p-8 shadow-lg">
          <div class="mb-8 text-center">
            <h3 class="text-dark mb-2 text-2xl font-bold">Free</h3>
            <div class="mb-4 flex items-baseline justify-center">
              <span class="text-dark text-4xl font-bold">$0</span>
              <span class="ml-2 text-gray-600">/month</span>
            </div>
            <p class="text-gray-600">Perfect for getting started with basic wardrobe organization</p>
          </div>
          <ul class="mb-8 space-y-4">
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-3"></i>
              <span>Up to 50 clothing items</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-3"></i>
              <span>Basic outfit planning</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-3"></i>
              <span>Manual laundry tracking</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-3"></i>
              <span>Standard support</span>
            </li>
            <li class="flex items-center text-gray-400">
              <i class="fas fa-times mr-3"></i>
              <span>Advanced decluttering analytics</span>
            </li>
            <li class="flex items-center text-gray-400">
              <i class="fas fa-times mr-3"></i>
              <span>Shopping integration</span>
            </li>
            <li class="flex items-center text-gray-400">
              <i class="fas fa-times mr-3"></i>
              <span>Automated laundry tracking</span>
            </li>
          </ul>
          <button
            class="w-full rounded-lg bg-gray-300 py-3 font-bold text-gray-700 transition hover:bg-gray-400">Get
            Started</button>
        </div>

        <!-- Pro Plan -->
        <div
          class="from-primary to-secondary pricing-card relative scale-105 transform rounded-2xl bg-gradient-to-br p-8 shadow-2xl">
          <div class="absolute -top-4 left-1/2 -translate-x-1/2 transform">
            <span class="bg-accent rounded-full px-4 py-1 text-sm font-bold text-white">MOST
              POPULAR</span>
          </div>
          <div class="mb-8 text-center text-white">
            <h3 class="mb-2 text-2xl font-bold">Pro</h3>
            <div class="mb-4 flex items-baseline justify-center">
              <span class="text-4xl font-bold">$9.99</span>
              <span class="ml-2 opacity-90">/month</span>
            </div>
            <p class="opacity-90">Ideal for serious fashion enthusiasts</p>
          </div>
          <ul class="mb-8 space-y-4 text-white">
            <li class="flex items-center">
              <i class="fas fa-check mr-3"></i>
              <span>Unlimited clothing items</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check mr-3"></i>
              <span>Advanced outfit planning</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check mr-3"></i>
              <span>Automated laundry tracking</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check mr-3"></i>
              <span>Shopping integration</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check mr-3"></i>
              <span>Decluttering analytics</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check mr-3"></i>
              <span>Priority support</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check mr-3"></i>
              <span>Weather-based recommendations</span>
            </li>
          </ul>
          <button
            class="text-primary w-full rounded-lg bg-white py-3 font-bold transition hover:bg-gray-100">Start
            Free Trial</button>
        </div>

        <!-- Premium Plan -->
        <div class="bg-light pricing-card border-secondary rounded-2xl border-2 p-8 shadow-lg">
          <div class="mb-8 text-center">
            <h3 class="text-dark mb-2 text-2xl font-bold">Premium</h3>
            <div class="mb-4 flex items-baseline justify-center">
              <span class="text-dark text-4xl font-bold">$19.99</span>
              <span class="ml-2 text-gray-600">/month</span>
            </div>
            <p class="text-gray-600">For fashion professionals and serious collectors</p>
          </div>
          <ul class="mb-8 space-y-4">
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-3"></i>
              <span>Everything in Pro</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-3"></i>
              <span>AI-powered style recommendations</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-3"></i>
              <span>Personal style consultant sessions</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-3"></i>
              <span>Advanced analytics dashboard</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-3"></i>
              <span>Custom integration options</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-3"></i>
              <span>Dedicated account manager</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-check text-success mr-3"></i>
              <span>Early access to new features</span>
            </li>
          </ul>
          <button
            class="bg-secondary w-full rounded-lg py-3 font-bold text-white transition hover:bg-teal-500">Contact
            Sales</button>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ Section -->
  <section class="bg-light py-16">
    <div class="container mx-auto px-6">
      <h2 class="text-dark mb-4 text-center text-3xl font-bold">Frequently Asked Questions</h2>
      <p class="mx-auto mb-12 max-w-2xl text-center text-gray-600">Get answers to common questions
        about StyleHub pricing and features.</p>

      <div class="mx-auto max-w-3xl space-y-6">
        <div class="rounded-xl bg-white p-6 shadow-md">
          <h3 class="text-dark mb-2 text-xl font-bold">Can I change plans anytime?</h3>
          <p class="text-gray-600">Yes, you can upgrade or downgrade your plan at any time. Changes
            take effect immediately, and we'll prorate any differences.</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-md">
          <h3 class="text-dark mb-2 text-xl font-bold">Is there a free trial?</h3>
          <p class="text-gray-600">Yes! The Pro plan comes with a 14-day free trial. No credit card
            required to start.</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-md">
          <h3 class="text-dark mb-2 text-xl font-bold">What payment methods do you accept?</h3>
          <p class="text-gray-600">We accept all major credit cards, PayPal, and Apple Pay for your
            convenience.</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-md">
          <h3 class="text-dark mb-2 text-xl font-bold">Can I cancel my subscription?</h3>
          <p class="text-gray-600">Absolutely. You can cancel your subscription at any time, and
            you'll continue to have access until the end of your billing period.</p>
        </div>
      </div>
    </div>
  </section>

  @include('components.cta')
@endsection
