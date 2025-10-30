@extends('layouts.guest')
@section('title', 'Blog')
@push('styles')

    <style>
        .blog-card {
            transition: all 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-5px);
        }

        /* Image overlay for better text readability */
        .image-overlay {
            background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7));
        }
        .featured-image {
            background-size: cover;
            background-position: center;
            transition: transform 0.3s ease;
        }
        .blog-card:hover .featured-image {
            transform: scale(1.05);
        }
    </style>
    @endpush
@section('content')

    <!-- Hero Section -->
    <section class="gradient-bg text-white py-16 md:py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">StyleHub Blog</h1>
            <p class="text-xl max-w-3xl mx-auto mb-8">Discover fashion tips, wardrobe organization hacks, and insights to transform your personal style.</p>
            <div class="max-w-2xl mx-auto">
                <div class="relative">
                    <input type="text" placeholder="Search blog posts..." class="w-full px-6 py-4 rounded-lg text-dark focus:outline-none focus:ring-2 focus:ring-primary">
                    <button class="absolute right-2 top-2 bg-primary text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Post -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-dark mb-12">Featured Post</h2>
            
            <div class="bg-light rounded-2xl shadow-lg overflow-hidden max-w-4xl mx-auto blog-card">
                <div class="md:flex">
                    <div class="md:w-1/2 h-96 md:h-auto relative overflow-hidden">
                        <div class="featured-image absolute inset-0 w-full h-full" style="background-image: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80')"></div>
                        <div class="absolute inset-0 image-overlay flex items-center justify-center">
                            <div class="text-white text-center p-8">
                                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 inline-block mb-4">
                                    <span class="font-bold">FEATURED</span>
                                </div>
                                <h3 class="text-2xl font-bold mb-4">The Complete Guide to Capsule Wardrobes</h3>
                                <p class="mb-4">Learn how to build a versatile wardrobe with fewer pieces that work together seamlessly.</p>
                                <div class="flex items-center justify-center space-x-4 text-sm">
                                    <span>By Sarah Johnson</span>
                                    <span>•</span>
                                    <span>October 15, 2023</span>
                                    <span>•</span>
                                    <span>8 min read</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-1/2 p-8">
                        <h4 class="text-xl font-bold text-dark mb-4">What You'll Learn:</h4>
                        <ul class="space-y-3 text-gray-600 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-success mt-1 mr-3"></i>
                                <span>How to select core pieces for your capsule wardrobe</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-success mt-1 mr-3"></i>
                                <span>Color coordination strategies that work</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-success mt-1 mr-3"></i>
                                <span>Seasonal rotation tips for year-round style</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-success mt-1 mr-3"></i>
                                <span>How to use StyleHub to plan and manage your capsule wardrobe</span>
                            </li>
                        </ul>
                        <button class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-purple-700 transition">Read Full Article</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Posts -->
    <section class="py-16 bg-light">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-dark mb-4">Latest Articles</h2>
            <p class="text-gray-600 text-center max-w-2xl mx-auto mb-12">Fresh insights and tips to help you master your wardrobe and personal style.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Post 1 -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden blog-card">
                    <div class="h-48 relative overflow-hidden">
                        <div class="featured-image absolute inset-0 w-full h-full" style="background-image: url('https://images.unsplash.com/photo-1584467735871-8db9ac8d55b4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80')"></div>
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1">
                            <span class="text-sm font-bold text-dark">Decluttering</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <span>By Michael Chen</span>
                            <span class="mx-2">•</span>
                            <span>October 10, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">5 Signs It's Time to Declutter Your Wardrobe</h3>
                        <p class="text-gray-600 mb-4">Discover the telltale signs that your wardrobe needs attention and learn effective decluttering strategies.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">6 min read</span>
                            <button class="text-primary font-bold hover:underline">Read More</button>
                        </div>
                    </div>
                </div>

                <!-- Post 2 -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden blog-card">
                    <div class="h-48 relative overflow-hidden">
                        <div class="featured-image absolute inset-0 w-full h-full" style="background-image: url('https://images.unsplash.com/photo-1441984904996-e0b597060c93?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80')"></div>
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1">
                            <span class="text-sm font-bold text-dark">Seasonal</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <span>By Emma Rodriguez</span>
                            <span class="mx-2">•</span>
                            <span>October 5, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">Seasonal Transition: Updating Your Wardrobe for Fall</h3>
                        <p class="text-gray-600 mb-4">Learn how to smoothly transition your wardrobe between seasons while maximizing your existing pieces.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">7 min read</span>
                            <button class="text-primary font-bold hover:underline">Read More</button>
                        </div>
                    </div>
                </div>

                <!-- Post 3 -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden blog-card">
                    <div class="h-48 relative overflow-hidden">
                        <div class="featured-image absolute inset-0 w-full h-full" style="background-image: url('https://images.unsplash.com/photo-1492707892479-7bc8d5a4ee93?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80')"></div>
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1">
                            <span class="text-sm font-bold text-dark">Psychology</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <span>By David Kim</span>
                            <span class="mx-2">•</span>
                            <span>September 28, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">The Psychology of Color in Fashion</h3>
                        <p class="text-gray-600 mb-4">Explore how color choices affect perception and mood, and how to use color psychology in your daily outfits.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">9 min read</span>
                            <button class="text-primary font-bold hover:underline">Read More</button>
                        </div>
                    </div>
                </div>

                <!-- Post 4 -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden blog-card">
                    <div class="h-48 relative overflow-hidden">
                        <div class="featured-image absolute inset-0 w-full h-full" style="background-image: url('https://images.unsplash.com/photo-1601924582970-9238bcb495d9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80')"></div>
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1">
                            <span class="text-sm font-bold text-dark">Shopping</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <span>By Jessica Williams</span>
                            <span class="mx-2">•</span>
                            <span>September 20, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">Smart Shopping: How to Avoid Impulse Buys</h3>
                        <p class="text-gray-600 mb-4">Develop mindful shopping habits and learn strategies to build a intentional wardrobe that truly serves you.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">5 min read</span>
                            <button class="text-primary font-bold hover:underline">Read More</button>
                        </div>
                    </div>
                </div>

                <!-- Post 5 -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden blog-card">
                    <div class="h-48 relative overflow-hidden">
                        <div class="featured-image absolute inset-0 w-full h-full" style="background-image: url('https://images.unsplash.com/photo-1586350977771-b3b0abd50c82?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80')"></div>
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1">
                            <span class="text-sm font-bold text-dark">Care</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <span>By Alex Thompson</span>
                            <span class="mx-2">•</span>
                            <span>September 15, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">Extend Your Clothing's Lifespan: Care & Maintenance Guide</h3>
                        <p class="text-gray-600 mb-4">Proper care techniques that will help your favorite pieces last longer and look better over time.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">8 min read</span>
                            <button class="text-primary font-bold hover:underline">Read More</button>
                        </div>
                    </div>
                </div>

                <!-- Post 6 -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden blog-card">
                    <div class="h-48 relative overflow-hidden">
                        <div class="featured-image absolute inset-0 w-full h-full" style="background-image: url('https://images.unsplash.com/photo-1604176354204-9268737828e4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80')"></div>
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1">
                            <span class="text-sm font-bold text-dark">Sustainable</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <span>By Maria Garcia</span>
                            <span class="mx-2">•</span>
                            <span>September 8, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">Sustainable Fashion: Building an Eco-Friendly Wardrobe</h3>
                        <p class="text-gray-600 mb-4">Practical steps to make your fashion choices more sustainable without sacrificing style or breaking the bank.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">10 min read</span>
                            <button class="text-primary font-bold hover:underline">Read More</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <button class="bg-primary text-white px-8 py-3 rounded-lg font-bold hover:bg-purple-700 transition">Load More Articles</button>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-2xl mx-auto bg-gradient-to-r from-primary to-secondary rounded-2xl p-8 text-center text-white">
                <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
                <p class="mb-6 max-w-md mx-auto">Subscribe to our newsletter for the latest style tips, wardrobe hacks, and StyleHub updates delivered to your inbox.</p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 rounded-lg text-dark focus:outline-none">
                    <button class="bg-white text-primary px-6 py-3 rounded-lg font-bold hover:bg-gray-100 transition">Subscribe</button>
                </div>
                <p class="text-sm mt-4 opacity-80">No spam, unsubscribe at any time</p>
            </div>
        </div>
    </section>
@endsection
