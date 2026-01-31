<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::get('/', function () {
    return view('frontPage');
});

//For displaying login form
Route::get('/login', [UserController::class, 'showLoginForm']);


//For processing login form
Route::post('/login', [UserController::class, 'login']);

//For displaying registration form
Route::get('/register', [UserController::class, 'showRegistrationForm']);

//For processing registration form
Route::post('/register', [UserController::class, 'register']);

//For displaying user profile page
Route::get('/profile', function () {
    return view('userProfilePage');
});

//For displaying user profile page
Route::get('/history', function () {
    return view('userHistory');
});

//For displaying menu page
Route::get('/menu', function () {
    return view('userMenu');
});

//For displaying contact us page
Route::get('/contact', function () {
    return view('userContactUs');
});

//For displaying cart page
Route::get('/cart', function () {
    return view('userCartPage');
});

//For displaying admin dashboard
Route::get('/adminDashboard', function () {
    return view('adminDashboard');
});

//For displaying admin product management page
Route::get('/adminProduct', function () {
    return view('adminProductPage');
});

//For displaying admin inventory management page
Route::get('/adminInventory', function () {
    return view('adminInventoryPage');
});

//For displaying admin order management page
Route::get('/adminFeedback', function () {
    return view('adminFeedbackPage');
});

//For displaying order success page
Route::get('/orderSuccess', function () {
    return view('userOrderSuccess');
});