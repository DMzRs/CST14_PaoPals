<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontPage');
});

Route::get('/login', function () {
    return view('userLogin');
});

Route::get('/register', function () {
    return view('userRegister');
});

Route::get('/profile', function () {
    return view('userProfilePage');
});

Route::get('/history', function () {
    return view('userHistory');
});

Route::get('/menu', function () {
    return view('userMenu');
});

Route::get('/contact', function () {
    return view('userContactUs');
});

Route::get('/cart', function () {
    return view('userCartPage');
});

Route::get('/adminDashboard', function () {
    return view('adminDashboard');
});

Route::get('/adminProduct', function () {
    return view('adminProductPage');
});

Route::get('/adminInventory', function () {
    return view('adminInventoryPage');
});

Route::get('/adminFeedback', function () {
    return view('adminFeedbackPage');
});

Route::get('/orderSuccess', function () {
    return view('userOrderSuccess');
});