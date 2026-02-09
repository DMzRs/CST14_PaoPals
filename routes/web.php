<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MenuController;

// Public routes
Route::get('/', function () {
    $user = Auth::user();

    // Block admins from accessing the front page
    if ($user && $user->is_admin) {
        abort(403); // or redirect to adminDashboard
        // return redirect('/adminDashboard'); // optional: redirect instead of abort
    }

    return view('frontPage');
})->name('frontPage');

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
Route::get('/history', function () {
    $user = Auth::user();
    if (!$user || $user->is_admin) abort(403);
    return view('userHistory');
})->name('history');

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

// Admin-only routes
Route::get('/adminDashboard', [UserController::class, 'showAdminDashboard'])->name('adminDashboard');

Route::get('/adminProduct', function () {
    $user = Auth::user();
    if (!$user || !$user->is_admin) abort(403);
    return view('adminProductPage');
})->name('adminProduct');

Route::get('/adminFeedback', function () {
    $user = Auth::user();
    if (!$user || !$user->is_admin) abort(403);
    return view('adminFeedbackPage');
})->name('adminFeedback');


// Inventory routes
Route::get('/adminInventory', [InventoryController::class, 'index'])->name('inventory.index');

// Route to handle adding new product + stock
Route::post('/adminInventory', [InventoryController::class, 'store'])->name('inventory.store');
