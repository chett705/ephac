<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAboutUsController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\SettingController;

// ====================== ADMIN LOGIN (Public) ======================
Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect()->route('admin.home.cms');
    }
    return view('Admin.auth.Login');
})->name('admin.login');

// ====================== CLIENT / FRONTEND ROUTES ======================
Route::get('/', [AdminController::class, 'homePage'])->name('home');
Route::get('/about-us', [AdminAboutUsController::class, 'aboutPage'])->name('Frontend.Pages.AboutUs');
Route::get('/products', [AdminProductController::class, 'productPage'])->name('Frontend.Pages.Product');
Route::get('/activites', [ActivityController::class, 'frontendIndex'])->name('Frontend.Pages.Activities');
Route::get('/services' , function (){
    return view('Frontend.Pages.Services');
})->name('Frontend.Pages.Services');
Route::get('/insight' ,function (){
    return view('Frontend.Pages.Insights');
})->name('Frontend.Pages.Insights');


Route::get('/contact' ,function(){
    return view('Frontend.Pages.Contact');
})->name('Frontend.Pages.Contact');


// ====================== ADMIN CMS (Protected) ======================
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        Route::get('/home-cms', [AdminController::class, 'homeCms'])->name('home.cms');
        Route::get('/about-cms', [AdminAboutUsController::class, 'aboutCms'])->name('about.cms');
        Route::get('/products-cms', [AdminProductController::class, 'index'])->name('products.cms');
        Route::get('/activity', [ActivityController::class, 'index'])->name('activities');
        Route::get('/settin-cms', [SettingController::class, 'index'])->name('setting.cms');

        // Home CMS
        Route::post('/home-cms/hero', [AdminController::class, 'updateHero'])->name('home.hero.update');
        Route::post('/home-cms/about', [AdminController::class, 'updateAbout'])->name('home.about.update');

        Route::post('/home-cms/category', [AdminController::class, 'storeCategory'])->name('home.category.store');
        Route::put('/home-cms/category/{category}', [AdminController::class, 'updateCategory'])->name('home.category.update');
        Route::delete('/home-cms/category/{category}', [AdminController::class, 'destroyCategory'])->name('home.category.destroy');

        Route::post('/home-cms/leadership', [AdminController::class, 'storeTeam'])->name('leadership.store');
        Route::put('/home-cms/leadership/{team}', [AdminController::class, 'updateTeam'])->name('leadership.update');
        Route::delete('/home-cms/leadership/{team}', [AdminController::class, 'destroyTeam'])->name('leadership.destroy');

        Route::post('/home-cms/certificate', [AdminController::class, 'storeCertificate'])->name('certificate.store');
        Route::put('/home-cms/certificate/{certificate}', [AdminController::class, 'updateCertificate'])->name('certificate.update');
        Route::delete('/home-cms/certificate/{certificate}', [AdminController::class, 'destroyCertificate'])->name('certificate.destroy');

        // About CMS
        Route::post('/about_cms-cms/hero', [AdminAboutUsController::class, 'updateHero'])->name('about.hero.update');

        // Product CMS
        Route::post('/products-cms/hero/update', [AdminProductController::class, 'updateHero'])->name('products.hero.update');

        Route::post('/products-cms/category', [AdminProductController::class, 'storeCategory'])->name('product.category.store');
        Route::put('/products-cms/category/{id}', [AdminProductController::class, 'updateCategory'])->name('product.category.update');
        Route::delete('/products-cms/category/{id}', [AdminProductController::class, 'destroyCategory'])->name('product.category.destroy');

        Route::post('/products-cms/subcategory', [AdminProductController::class, 'storeSubcategory'])->name('product.subcategory.store');
        Route::put('/products-cms/subcategory/{id}', [AdminProductController::class, 'updateSubcategory'])->name('product.subcategory.update');
        Route::delete('/products-cms/subcategory/{id}', [AdminProductController::class, 'destroySubcategory'])->name('product.subcategory.destroy');

        Route::post('/products-cms/product', [AdminProductController::class, 'storeProduct'])->name('product.store');
        Route::put('/products-cms/product/{id}', [AdminProductController::class, 'updateProduct'])->name('product.update');
        Route::delete('/products-cms/product/{id}', [AdminProductController::class, 'destroyProduct'])->name('product.destroy');

        // Activity CMS
        Route::post('/activity/store-category', [ActivityController::class, 'storeCategory'])->name('activities.category.store');
        Route::put('/activity/update-category/{id}', [ActivityController::class, 'updateCategory'])->name('activities.category.update');
        Route::delete('/activity/delete-category/{id}', [ActivityController::class, 'destroyCategory'])->name('activities.destroy');

        Route::post('/activity/{categoryId}/store-item', [ActivityController::class, 'storeItem'])->name('activities.item.store');
        Route::put('/activity/item/{id}', [ActivityController::class, 'updateItem'])->name('activities.item.update');
        Route::delete('/activity/item/{id}', [ActivityController::class, 'destroyItem'])->name('activities.item.destroy');
    });


Auth::routes();