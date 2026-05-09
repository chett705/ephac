<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Frontend.Pages.Home');
});
Route::get('/about-us', function () {
    return view('Frontend.Pages.AboutUS');
});
Route::get('/products', function () {
    return view('Frontend.Pages.Product');
});
