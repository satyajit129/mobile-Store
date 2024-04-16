<?php

use App\Http\Controllers\Admin\Brand\BrandController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\login\AdminLoginController;
use App\Http\Controllers\Admin\OperatingSystem\OperatingSystemController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Admin\Subcategory\SubcategoryController;
use App\Http\Controllers\User\UserLoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/login-page', [AdminLoginController::class, 'adminLogin'])->name('adminLogin');
    Route::post('/login-request', [AdminLoginController::class, 'adminLoginRequest'])->name('adminLoginRequest');



});
Route::prefix('admin')->middleware('auth.admin')->group(function () {

    // admin DashBoard
    Route::get('/dashboard', [DashboardController::class, 'AdminDashboard'])->name('AdminDashboard');
    // settings
    Route::prefix('/setting')->group(function () {
        Route::get('/', [SettingsController::class, 'adminSettings'])->name('adminSettings');
        Route::post('/update/{id}', [SettingsController::class, 'updateSettings'])->name('updateSettings');
    });
    // profile
    Route::prefix('/profilee')->group(function () {
        Route::get('/', [ProfileController::class, 'adminProfile'])->name('adminProfile');
        Route::post('/update/{id}', [ProfileController::class, 'adminProfileUpdate'])->name('adminProfileUpdate');
    });
    // category
    Route::prefix('/categoryy')->group(function () {
        Route::get('/', [CategoryController::class, 'adminCategoryList'])->name('adminCategoryList');
        Route::post('/store', [CategoryController::class, 'adminCategoryStore'])->name('adminCategoryStore');
        Route::get('/content/{id}', [CategoryController::class, 'categoryContent'])->name('categoryContent');
        Route::post('update/{id}', [CategoryController::class, 'adminCategoryUpdate'])->name('adminCategoryUpdate');
        Route::get('/delete', [CategoryController::class, 'adminCategoryDelete'])->name('adminCategoryDelete');
    });
    // subcategory
    Route::prefix('/subcategory')->group(function () {
        Route::get('/', [SubcategoryController::class, 'adminSubcategoryList'])->name('adminSubcategoryList');
        Route::post('/store', [SubcategoryController::class, 'adminSubcategoryStore'])->name('adminSubcategoryStore');
        Route::get('/content/{id}', [SubcategoryController::class, 'subcategoryContent'])->name('subcategoryContent');
        Route::post('/update/{id}', [SubcategoryController::class, 'adminSubcategoryUpdate'])->name('adminSubcategoryUpdate');
        Route::get('/delete', [SubcategoryController::class, 'adminSubcategoryDelete'])->name('adminSubcategoryDelete');
    });
    // Brand
    Route::prefix('/brand')->group(function () {
        Route::get('/', [BrandController::class, 'adminBrandList'])->name('adminBrandList');
        Route::post('/store', [BrandController::class, 'adminBrandStore'])->name('adminBrandStore');
        Route::get('/content/{id}', [BrandController::class, 'brandContent'])->name('brandContent');
        Route::post('/update/{id}', [BrandController::class, 'brandUpdate'])->name('brandUpdate');
        Route::get('/delete', [BrandController::class, 'adminBrandDelete'])->name('adminBrandDelete');
    });
    Route::prefix('/product')->group(function () {
        Route::get('/', [ProductController::class, 'adminProductList'])->name('adminProductList');
        Route::get('/create', [ProductController::class, 'adminCreateproduct'])->name('adminCreateproduct');
    });
    Route::prefix('/operating-systems')->group(function () {
        Route::get('/', [OperatingSystemController::class, 'adminOperatingSystemList'])->name('adminOperatingSystemList');
        Route::post('/store',[OperatingSystemController::class,'adminOperatingSystemStore'])->name('adminOperatingSystemStore');
        Route::get('/Content/{id}',[OperatingSystemController::class,'operatingSystemContent'])->name('operatingSystemContent');
        Route::post('/update/{id}',[OperatingSystemController::class,'adminOperatingSystemUpdate'])->name('adminOperatingSystemUpdate');
        Route::get('/delete',[OperatingSystemController::class,'adminOperatingSystemDelete'])->name('adminOperatingSystemDelete');
    });
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
