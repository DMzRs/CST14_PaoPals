<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::get('/', function () {
    return view('frontPage');
})->name('frontPage');

//For displaying login form
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');

//For processing login form
Route::post('/login', [UserController::class, 'login'])->name('login');

//For processing logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

//For processing admin logout
Route::post('/adminLogout', [UserController::class, 'adminLogout'])->name('adminLogout');

//For displaying registration form
Route::get('/register', [UserController::class, 'showRegistrationForm']);

//For processing registration form
Route::post('/register', [UserController::class, 'register'])->name('register');

//For displaying user profile page
Route::get('/profile', [UserController::class,'showProfile'])->middleware('auth')->name('profile');

//For processing user profile update
Route::post('/profile', [UserController::class,'updateProfile'])->middleware('auth');

//For displaying user profile page
Route::get('/history', function () {
    return view('userHistory');
})->name('history');

//For displaying menu page
Route::get('/menu', function () {
    return view('userMenu');
})->name('menu');

//For displaying contact us page
Route::get('/contact', function () {
    return view('userContactUs');
})->name('contact');

//For displaying cart page
Route::get('/cart', function () {
    return view('userCartPage');
})->name('cart');

//For displaying admin dashboard
Route::get('/adminDashboard', [UserController::class, 'showAdminDashboard'])->name('adminDashboard');

//For displaying admin product management page
Route::get('/adminProduct', function () {
    return view('adminProductPage');
})->name('adminProduct');

//For displaying admin inventory management page
Route::get('/adminInventory', function () {
    return view('adminInventoryPage');
})->name('adminInventory');

//For displaying admin order management page
Route::get('/adminFeedback', function () {
    return view('adminFeedbackPage');
})->name('adminFeedback');

//For displaying order success page
Route::get('/orderSuccess', function () {
    return view('userOrderSuccess');
});