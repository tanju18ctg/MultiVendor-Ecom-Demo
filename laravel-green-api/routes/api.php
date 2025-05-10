<?php

use App\Http\Controllers\Api\Admin\AdminFileSystemController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\Seller\SellerFileSystemController;
use App\Http\Controllers\Api\SellerController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\FileManagerFileController;
use App\Http\Controllers\SellerFormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/login', function () {
    return response()->json([
        'status' => false,
        'message' => 'Unauthenticate User'
    ], 401);
})->name('login');



Route::prefix('v1')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home-slider', 'slider')->name('home.slider');
        Route::get('/categories', 'categoryList')->name('category.all');
        Route::get('/sub-categories', 'subCatList')->name('sub.category.all');
        Route::get('/sale-products', 'saleProducts')->name('sale.product');
        Route::get('/product-condition/{condition}', 'conditionProduct')->name('conditions.product');
        Route::get('/product/{slug}', 'singleProduct')->name('single.product');
    });

    Route::controller(ShopController::class)->group(function () {
        Route::get('/products', 'products')->name('products');
        Route::get('/shop-sidebar-data', 'shopSidebar')->name('shop.sidebar');
        Route::post('/shop-filter', 'shopFilter')->name('shop.filter');
        Route::get('/categories-all', 'allCategories')->name('category.all.data');
        Route::get('/brands-all', 'allBrands')->name('brand.all');
    });

    Route::controller(CheckoutController::class)->group(function () {
        Route::post('/apply-coupon', 'applyCoupon');
    });


    //use for filemanager
    Route::controller(AdminFileSystemController::class)->group(function () {
        Route::post('/product-upload', 'product');
        Route::post('/category-upload',  'category');
        Route::post('/brand-upload',  'brand');
        Route::post('/slider-upload',  'slider');
    });

    Route::controller(SellerFileSystemController::class)->group(function () {
        Route::post('/product-upload-seller', 'upload');
    });

    // Route::post('seller-apply', [SellerFormController::class, 'store']);

    // Route::controller(SellerController::class)->group(function(){
    //     Route::get('/sellers','index');
    //     Route::get('/seller-apply','store');
    // });

    Route::apiResources([
        'sellers' => SellerController::class,
    ]);
});
