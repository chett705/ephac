<?php

use App\Http\Controllers\Admin\AdminAboutUsController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProductController;

Route::get('/', [AdminController::class, 'homePage']);
Route::get('/about-us', function () {
    return view('Frontend.Pages.AboutUS');
});
Route::get('/products', [AdminProductController::class, 'productPage'])
    ->name('Frontend.Pages.Product');

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
    // Route::post('/home-cms/hero', [AdminProductController::class, 'updateHero'])
    //     ->name('about.hero.update');      
        
   

    // {{-- Product Management CMS --}}
    Route::get('/products-cms', [AdminProductController::class, 'index'])->name('products.cms');
    // Hero Section Management
    Route::post('/products-cms/hero/update', [AdminProductController::class, 'updateHero'])
    ->name('products.hero.update');
    // ----------------------------
    Route::post('/products-cms/category', [AdminProductController::class, 'storeCategory'])->name('product.category.store');
    Route::put('/products-cms/category/{id}', [AdminProductController::class, 'updateCategory'])->name('product.category.update');
    Route::delete('/products-cms/category/{id}', [AdminProductController::class, 'destroyCategory'])->name('product.category.destroy');

    Route::post('/products-cms/subcategory', [AdminProductController::class, 'storeSubcategory'])->name('product.subcategory.store');
    Route::put('/products-cms/subcategory/{id}', [AdminProductController::class, 'updateSubcategory'])->name('product.subcategory.update');
    Route::delete('/products-cms/subcategory/{id}', [AdminProductController::class, 'destroySubcategory'])->name('product.subcategory.destroy');

    Route::post('/products-cms/product', [AdminProductController::class, 'storeProduct'])->name('product.store');
    Route::put('/products-cms/product/{id}', [AdminProductController::class, 'updateProduct'])->name('product.update');
    Route::delete('/products-cms/product/{id}', [AdminProductController::class, 'destroyProduct'])->name('product.destroy');
});
