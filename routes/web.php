<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('Frontend.Pages.Home');
});
Route::get('/about-us', function () {
    return view('Frontend.Pages.AboutUS');
});
Route::get('/products', function () {
    return view('Frontend.Pages.Product');
});


Route::get('/login', function () {
    return view('Admin.auth.Login');
});

// {{-- Admin CMS Routes --}}
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/home-cms', [AdminController::class, 'homeCms'])->name('home.cms');
    Route::get('/about-cms', [AdminController::class, 'aboutCms'])->name('about.cms');
    Route::put('/admin/home/category/{category}', [AdminController::class, 'updateCategory'])
     ->name('admin.home.category.update');


    Route::post('/home-cms/hero', [AdminController::class, 'updateHero'])
        ->name('home.hero.update');

    Route::post('/home-cms/about', [AdminController::class, 'updateAbout'])
        ->name('home.about.update');
    Route::put('/home-cms/category/{category}', [AdminController::class, 'updateCategory'])
    ->name('home.category.update');

    // {{-- Product Management --}}
    Route::get('/product-categories', [AdminController::class, 'productCategories'])->name('product_categories.index');
    Route::get('/product-subcategories', [AdminController::class, 'productSubcategories'])->name('product_subcategories.index');
    Route::get('/products', [AdminController::class, 'products'])->name('products.index');
});
