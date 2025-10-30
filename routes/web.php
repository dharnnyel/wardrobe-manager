<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index');
Route::view('features', 'features');
Route::view('pricing', 'pricing');
Route::view('help', 'help');
Route::view('blog', 'blog');

// Auth Pages
Route::view('signup', 'auth.signup');
Route::view('login', 'auth.login');

// Dashboard Pages
Route::view('dashboard', 'dashboard.home');
Route::view('dashboard/wardrobe', 'dashboard.wardrobe');
Route::view('dashboard/interests', 'dashboard.interests');
Route::view('dashboard/wishlist', 'dashboard.wishlist');
Route::view('dashboard/shopping', 'dashboard.shopping');
Route::view('dashboard/orders', 'dashboard.orders');

