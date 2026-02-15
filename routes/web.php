<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminFeedbackController;
use App\Http\Controllers\FrontPageController;

// Public routes
Route::get('/', [FrontPageController::class, 'index'])->name('frontPage');

// Login & logout
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Registration
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

// User-only routes
Route::get('/profile', [UserController::class,'showProfile'])->name('profile');
Route::post('/profile', [UserController::class,'updateProfile']);

Route::get('/menu', function () {
    $user = Auth::user();
    if (!$user || $user->is_admin) abort(403);
    return view('userMenu');
})->name('menu');

Route::get('/contact', function () {
    $user = Auth::user();
    if (!$user || $user->is_admin) abort(403);
    return view('userContactUs');
})->name('contact');

Route::get('/cart', function () {
    $user = Auth::user();
    if (!$user || $user->is_admin) abort(403);
    return view('userCartPage');
})->name('cart');

Route::get('/orderSuccess', function () {
    $user = Auth::user();
    if (!$user || $user->is_admin) abort(403);
    return view('userOrderSuccess');
});

// Menu route for users (already used in user view)
Route::get('/menu/all', [MenuController::class, 'all'])->name('menu.all');
Route::get('/menu/siopao', [MenuController::class, 'siopao'])->name('menu.siopao');
Route::get('/menu/drinks', [MenuController::class, 'drinks'])->name('menu.drinks');
Route::get('/menu/desserts', [MenuController::class, 'desserts'])->name('menu.desserts');

// Cart routes for users
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::post('/cart/remove/{id}',   [CartController::class, 'remove'])->name('cart.remove');

// Checkout route for users
Route::post('/checkout', [CartController::class, 'processCheckout'])
    ->name('checkout.process');

Route::get('/thank-you', [CartController::class, 'orderSuccess'])
    ->name('checkout.orderSuccess');

// History route for users
Route::get('/history', [UserHistoryController::class, 'orderHistory'])
    ->middleware('auth')   // Make sure only logged-in users can see it
    ->name('user.orderHistory');

// Contact Us route for users
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// Admin-only routes
Route::get('/adminDashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth']);

Route::get('/adminProduct', [AdminProductController::class, 'index'])
     ->name('adminProduct.index')
     ->middleware('auth'); // ensure only logged-in admins

// Inventory routes
Route::get('/adminInventory', [InventoryController::class, 'index'])->name('inventory.index');

// Add product
Route::post('/adminInventory/product', [InventoryController::class, 'storeProduct'])->name('inventory.storeProduct');

// Add stock
Route::post('/adminInventory/stock', [InventoryController::class, 'storeStock'])->name('inventory.storeStock');

// Admin Feedback route
Route::get('/adminFeedback', [AdminFeedbackController::class, 'index'])
     ->name('adminFeedback.index')
     ->middleware('auth'); // only accessible to logged-in admins

