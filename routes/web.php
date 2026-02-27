<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminFeedbackController;
use App\Http\Controllers\FrontPageController;

////////////////////////////////////////////////////////////
// PUBLIC ROUTES (no login required)
////////////////////////////////////////////////////////////

Route::get('/', [FrontPageController::class, 'index'])->name('frontPage');

// Login & Logout
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Registration
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

// OTP Verification
Route::post('/verify-otp', [UserController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/resend-otp', [UserController::class, 'resendOtp'])->name('resend.otp');

////////////////////////////////////////////////////////////
// AUTHENTICATED USER ROUTES (must be logged in)
////////////////////////////////////////////////////////////

Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [UserController::class,'showProfile'])->name('profile');
    Route::post('/profile', [UserController::class,'updateProfile']);

    // User pages
    Route::get('/menu', function () {
        return view('userMenu');
    })->name('menu');

    Route::get('/contact', function () {
        return view('userContactUs');
    })->name('contact');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::get('/orderSuccess', function () {
        return view('userOrderSuccess');
    });

    // Menu categories
    Route::get('/menu/all', [MenuController::class, 'all'])->name('menu.all');
    Route::get('/menu/siopao', [MenuController::class, 'siopao'])->name('menu.siopao');
    Route::get('/menu/drinks', [MenuController::class, 'drinks'])->name('menu.drinks');
    Route::get('/menu/desserts', [MenuController::class, 'desserts'])->name('menu.desserts');

    // Cart actions
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/thank-you', [CartController::class, 'orderSuccess'])->name('checkout.orderSuccess');

    // Order history
    Route::get('/history', [UserHistoryController::class, 'orderHistory'])
        ->name('user.orderHistory');

    // Feedback submission
    Route::post('/feedback', [FeedbackController::class, 'store'])
        ->name('feedback.store');

});

////////////////////////////////////////////////////////////
// ADMIN ROUTES (must be logged in AND admin)
// Requires custom "admin" middleware
////////////////////////////////////////////////////////////

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/adminDashboard', [AdminDashboardController::class, 'index']);

    Route::get('/adminProduct', [AdminProductController::class, 'index'])
        ->name('adminProduct.index');

    // Inventory management
    Route::get('/adminInventory', [InventoryController::class, 'index'])
        ->name('inventory.index');

    Route::post('/adminInventory/product', [InventoryController::class, 'storeProduct'])
        ->name('inventory.storeProduct');

    Route::post('/adminInventory/stock', [InventoryController::class, 'storeStock'])
        ->name('inventory.storeStock');

    // Admin feedback view
    Route::get('/adminFeedback', [AdminFeedbackController::class, 'index'])
        ->name('adminFeedback.index');

});