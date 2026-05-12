<?php

use App\Http\Controllers\Admin\AdminAboutUsController;
use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', [AdminController::class, 'homePage']);
Route::get('/about-us', function () {
    return view('Frontend.Pages.AboutUS');
});
Route::get('/products', function () {
    return view('Frontend.Pages.Product');
})->name('Frontend.Pages.Product'); // This name must match the Blade call

Route::get('/login', function () {
    return view('Admin.auth.Login');
});

// {{-- Admin CMS Routes --}}
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/home-cms', [AdminController::class, 'homeCms'])->name('home.cms');
    Route::get('/about-cms', [AdminAboutUsController::class, 'aboutCms'])->name('about.cms');
    Route::put('/admin/home/category/{category}', [AdminController::class, 'updateCategory'])
     ->name('admin.home.category.update');


    Route::post('/home-cms/hero', [AdminController::class, 'updateHero'])
        ->name('home.hero.update');

    Route::post('/home-cms/about', [AdminController::class, 'updateAbout'])
        ->name('home.about.update');
    Route::post('/home-cms/category', [AdminController::class, 'storeCategory'])
        ->name('home.category.store');
    Route::put('/home-cms/category/{category}', [AdminController::class, 'updateCategory'])
        ->name('home.category.update');
    Route::delete('/home-cms/category/{category}', [AdminController::class, 'destroyCategory'])
        ->name('home.category.destroy');
    Route::post('/home-cms/leadership', [AdminController::class, 'storeTeam'])
        ->name('leadership.store');
    Route::put('/home-cms/leadership/{team}', [AdminController::class, 'updateTeam'])
        ->name('leadership.update');
    Route::delete('/home-cms/leadership/{team}', [AdminController::class, 'destroyTeam'])
        ->name('leadership.destroy');
    Route::post('/home-cms/certificate', [AdminController::class, 'storeCertificate'])
        ->name('certificate.store');
    Route::put('/home-cms/certificate/{certificate}', [AdminController::class, 'updateCertificate'])
        ->name('certificate.update');
    Route::delete('/home-cms/certificate/{certificate}', [AdminController::class, 'destroyCertificate'])
        ->name('certificate.destroy');

        // about page 

    Route::post('/about_cms-cms/hero', [AdminAboutUsController::class, 'updateHero'])
        ->name('about.hero.update');    

        // product page
        
   

    // {{-- Product Management --}}
    Route::get('/product-categories', [AdminController::class, 'productCategories'])->name('product_categories.index');
    Route::get('/product-subcategories', [AdminController::class, 'productSubcategories'])->name('product_subcategories.index');
    Route::get('/products', [AdminController::class, 'products'])->name('products.index');
});
