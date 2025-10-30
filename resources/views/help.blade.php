@extends('layouts.guest')
@section('title', 'Help')
@push('styles')
  <style>
    .faq-item {
      transition: all 0.3s ease;
    }
  </style>
@endpush
@section('content')

  <!-- Hero Section -->
  <section class="gradient-bg py-16 text-white md:py-20">
    <div class="container mx-auto px-6 text-center">
      <h1 class="mb-4 text-4xl font-bold md:text-5xl">How Can We Help You?</h1>
      <p class="mx-auto mb-8 max-w-3xl text-xl">Get support, find answers, and connect with our team.
        We're here to help you make the most of StyleHub.</p>
      <div class="mx-auto max-w-2xl">
        <div class="relative">
          <input
            class="text-dark focus:ring-primary w-full rounded-lg px-6 py-4 focus:outline-none focus:ring-2"
            placeholder="Search for help articles..." type="text">
          <button
            class="bg-primary absolute right-2 top-2 rounded-lg px-6 py-2 text-white transition hover:bg-purple-700">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Options -->
  <section class="bg-white py-16">
    <div class="container mx-auto px-6">
      <h2 class="text-dark mb-4 text-center text-3xl font-bold">Get in Touch</h2>
      <p class="mx-auto mb-12 max-w-2xl text-center text-gray-600">Choose your preferred way to
        contact our support team.</p>

      <div class="mx-auto grid max-w-5xl grid-cols-1 gap-8 md:grid-cols-3">
        <!-- Email Support -->
        <div class="bg-light feature-card rounded-2xl p-8 text-center shadow-md">
          <div
            class="bg-primary mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full">
            <i class="fas fa-envelope text-2xl text-white"></i>
          </div>
          <h3 class="text-dark mb-4 text-xl font-bold">Email Support</h3>
          <p class="mb-6 text-gray-600">Send us a detailed message and we'll get back to you within 24
            hours.</p>
          <a class="text-primary font-bold hover:underline"
            href="mailto:support@stylehub.com">support@stylehub.com</a>
        </div>

        <!-- Live Chat -->
        <div class="bg-light feature-card rounded-2xl p-8 text-center shadow-md">
          <div
            class="bg-secondary mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full">
            <i class="fas fa-comments text-2xl text-white"></i>
          </div>
          <h3 class="text-dark mb-4 text-xl font-bold">Live Chat</h3>
          <p class="mb-6 text-gray-600">Chat with our support team in real-time during business hours.
          </p>
          <button
            class="bg-secondary rounded-lg px-6 py-2 font-bold text-white transition hover:bg-teal-500">Start
            Chat</button>
        </div>

        <!-- Community -->
        <div class="bg-light feature-card rounded-2xl p-8 text-center shadow-md">
          <div class="bg-accent mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full">
            <i class="fas fa-users text-2xl text-white"></i>
          </div>
          <h3 class="text-dark mb-4 text-xl font-bold">Community Forum</h3>
          <p class="mb-6 text-gray-600">Connect with other StyleHub users and share tips and
            solutions.</p>
          <button
            class="bg-accent rounded-lg px-6 py-2 font-bold text-white transition hover:bg-red-500">Join
            Community</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Form -->
  <section class="bg-light py-16">
    <div class="container mx-auto px-6">
      <div class="mx-auto max-w-3xl rounded-2xl bg-white p-8 shadow-lg">
        <h2 class="text-dark mb-2 text-center text-3xl font-bold">Send us a Message</h2>
        <p class="mb-8 text-center text-gray-600">Fill out the form below and we'll get back to you as
          soon as possible.</p>

        <form class="space-y-6">
          <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
              <label class="text-dark mb-2 block font-medium" for="name">Full Name</label>
              <input
                class="focus:ring-primary w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2"
                id="name" placeholder="Enter your name" type="text">
            </div>
            <div>
              <label class="text-dark mb-2 block font-medium" for="email">Email Address</label>
              <input
                class="focus:ring-primary w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2"
                id="email" placeholder="Enter your email" type="email">
            </div>
          </div>

          <div>
            <label class="text-dark mb-2 block font-medium" for="subject">Subject</label>
            <input
              class="focus:ring-primary w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2"
              id="subject" placeholder="What is this regarding?" type="text">
          </div>

          <div>
            <label class="text-dark mb-2 block font-medium" for="message">Message</label>
            <textarea
              class="focus:ring-primary w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2"
              id="message" placeholder="Please describe your issue or question in detail..." rows="6"></textarea>
          </div>

          <button
            class="bg-primary w-full rounded-lg py-3 font-bold text-white transition hover:bg-purple-700"
            type="submit">Send Message</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Social Media -->
  <section class="bg-white py-16">
    <div class="container mx-auto px-6 text-center">
      <h2 class="text-dark mb-4 text-3xl font-bold">Connect With Us</h2>
      <p class="mx-auto mb-8 max-w-2xl text-gray-600">Follow us on social media for updates, tips, and
        community highlights.</p>

      <div class="flex justify-center space-x-6">
        <a class="bg-primary flex h-12 w-12 items-center justify-center rounded-full text-white transition hover:bg-purple-700"
          href="#">
          <i class="fab fa-twitter text-xl"></i>
        </a>
        <a class="bg-primary flex h-12 w-12 items-center justify-center rounded-full text-white transition hover:bg-purple-700"
          href="#">
          <i class="fab fa-facebook-f text-xl"></i>
        </a>
        <a class="bg-primary flex h-12 w-12 items-center justify-center rounded-full text-white transition hover:bg-purple-700"
          href="#">
          <i class="fab fa-instagram text-xl"></i>
        </a>
        <a class="bg-primary flex h-12 w-12 items-center justify-center rounded-full text-white transition hover:bg-purple-700"
          href="#">
          <i class="fab fa-linkedin-in text-xl"></i>
        </a>
        <a class="bg-primary flex h-12 w-12 items-center justify-center rounded-full text-white transition hover:bg-purple-700"
          href="#">
          <i class="fab fa-youtube text-xl"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- FAQ Section -->
  <section class="bg-light py-16">
    <div class="container mx-auto px-6">
      <h2 class="text-dark mb-4 text-center text-3xl font-bold">Frequently Asked Questions</h2>
      <p class="mx-auto mb-12 max-w-2xl text-center text-gray-600">Quick answers to common questions
        about StyleHub.</p>

      <div class="mx-auto max-w-4xl space-y-4">
        <div class="faq-item rounded-xl bg-white p-6 shadow-md hover:shadow-lg">
          <h3 class="text-dark mb-2 text-xl font-bold">How do I add items to my digital wardrobe?</h3>
          <p class="text-gray-600">You can add items by taking photos with your phone's camera,
            uploading existing photos, or importing items directly from supported online stores. Each
            item can be categorized by type, color, season, and occasion.</p>
        </div>

        <div class="faq-item rounded-xl bg-white p-6 shadow-md hover:shadow-lg">
          <h3 class="text-dark mb-2 text-xl font-bold">Can I use StyleHub on multiple devices?</h3>
          <p class="text-gray-600">Yes! StyleHub syncs across all your devices. Your wardrobe data is
            stored securely in the cloud and automatically updates across your phone, tablet, and
            computer.</p>
        </div>

        <div class="faq-item rounded-xl bg-white p-6 shadow-md hover:shadow-lg">
          <h3 class="text-dark mb-2 text-xl font-bold">How does the laundry tracking feature work?
          </h3>
          <p class="text-gray-600">The laundry tracking feature lets you mark items as clean, dirty,
            or washing. You can also set up automatic reminders based on wear frequency and store care
            instructions for each garment.</p>
        </div>

        <div class="faq-item rounded-xl bg-white p-6 shadow-md hover:shadow-lg">
          <h3 class="text-dark mb-2 text-xl font-bold">What stores are integrated with StyleHub?</h3>
          <p class="text-gray-600">We currently integrate with Amazon, Zara, H&M, Nike, and several
            other major retailers. We're constantly adding new store integrations based on user
            requests.</p>
        </div>

        <div class="faq-item rounded-xl bg-white p-6 shadow-md hover:shadow-lg">
          <h3 class="text-dark mb-2 text-xl font-bold">Is my data secure with StyleHub?</h3>
          <p class="text-gray-600">Absolutely. We use enterprise-grade security measures including
            encryption, secure servers, and regular security audits. Your data is never shared with
            third parties without your explicit consent.</p>
        </div>

        <div class="faq-item rounded-xl bg-white p-6 shadow-md hover:shadow-lg">
          <h3 class="text-dark mb-2 text-xl font-bold">Can I export my wardrobe data?</h3>
          <p class="text-gray-600">Yes, all paid plans include the ability to export your wardrobe
            data in CSV or PDF format. This includes your item catalog, outfit combinations, and style
            analytics.</p>
        </div>
      </div>
    </div>
  </section>
@endsection
