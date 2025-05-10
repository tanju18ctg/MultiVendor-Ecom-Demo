<?php

use App\Http\Controllers\Api\Admin\AdminFileSystemController;
use App\Http\Controllers\Api\Admin\Auth\AuthController;
use App\Http\Controllers\Api\Admin\BrandController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\ColorController;
use App\Http\Controllers\Api\Admin\CouponController;
use App\Http\Controllers\Api\Admin\DistrictController;
use App\Http\Controllers\Api\Admin\DivisionController;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\SubcategoryController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\SellerManagementController;
use App\Http\Controllers\Api\Admin\SizeController;
use App\Http\Controllers\Api\Admin\SliderController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/admin')->group(function () {
    // Route::post('/login',[AuthController::class, 'adminLogin'])->name('admin.login');

    Route::post('/login', [AuthController::class, 'adminLogin'])->name('admin.login');
    Route::group(['middleware' => ['cors', 'auth:admin-api', 'scopes:admin']], function () {

        Route::controller(AuthController::class)->group(function () {
            Route::get('/auth-user', 'user')->name('auth.user');
            Route::post('/logout',  'adminLogout')->name('admin.logout');
            Route::get('/seller-verify/{id}',  'sellerVerify')->name('seller.verify');
        });

        Route::apiResources([
            'category' => CategoryController::class,
            'subcategory' => SubcategoryController::class,
            'brand' => BrandController::class,
            'slider' => SliderController::class,
            'product' => ProductController::class,
            'size' => SizeController::class,
            'color' => ColorController::class,
            'seller' => SellerManagementController::class,
            'coupon' => CouponController::class,
            'division' => DivisionController::class,
            'district' => DistrictController::class,
            'order' => OrderController::class,
        ]);

        Route::get('/district-list/{id}', [DivisionController::class, 'districtListPaginate']);


        //category
        Route::controller(CategoryController::class)->group(function () {
            Route::get('category-data', 'categoryAll');
            Route::post('category-destroy-multiple', 'multipleDelete');
        });

        //subcategory
        Route::controller(SubcategoryController::class)->group(function () {
            Route::post('subcategory-destroy-multiple', 'multipleDelete');
            Route::get('subcategory-all/{id}', 'subCatAll');
        });

        //brand
        Route::controller(BrandController::class)->group(function () {
            Route::post('brand-destroy-multiple', 'multipleDelete');
            Route::get('brand-all', 'brandAll');
        });

        Route::controller(SizeController::class)->group(function () {
            Route::post('size-destroy-multiple', 'multipleDelete');
            Route::get('size-pagination', 'paginationData');
        });

        Route::controller(ColorController::class)->group(function () {
            Route::post('color-destroy-multiple', 'multipleDelete');
            Route::get('color-pagination', 'paginationData');
        });


        Route::post('slider-destroy-multiple', [SliderController::class, 'multipleDelete']);
        Route::post('product-destroy-multiple', [ProductController::class, 'multipleDelete']);
        Route::get('seller-products', [ProductController::class, 'sellerProducts']);
        //use for remove photo
        Route::controller(AdminFileSystemController::class)->group(function () {
            Route::post('/photo-remove', 'photoRemove');
            Route::get('/files',  'files');
        });
    });
});
