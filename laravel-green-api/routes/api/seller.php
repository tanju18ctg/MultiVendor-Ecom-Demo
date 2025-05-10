
<?php

use App\Http\Controllers\Api\Admin\BrandController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\ColorController;
use App\Http\Controllers\Api\Admin\SizeController;
use App\Http\Controllers\Api\Admin\SubcategoryController;
use App\Http\Controllers\Api\Seller\Auth\SellerAuthController;
use App\Http\Controllers\Api\Seller\ManageProductController;
use App\Http\Controllers\Api\Seller\SellerFileSystemController;
use App\Http\Controllers\Api\Seller\SellerHomeController;
use App\Http\Controllers\Api\Seller\SettingController;
use App\Http\Controllers\FileManagerFileController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/seller')->group(function () {
    Route::controller(SellerAuthController::class)->group(function () {
        Route::post('/login',  'sellerLogin')->name('seller.login');
    });

    Route::group(['middleware' => ['cors', 'auth:seller-api', 'scopes:seller']], function () {
        Route::controller(SellerHomeController::class)->group(function () {
            Route::get('/auth-user', 'seller')->name('seller.info');
            Route::post('/update-settings', 'settingUpdate');
            Route::post('/change-image', 'changeImage');
            Route::post('/change-password', 'changePassword');

            Route::post('/logout',  'logout')->name('seller.logout');
        });

        Route::get('category', [CategoryController::class, 'index']);
        Route::get('subcategory-by-id/{id}', [SubcategoryController::class, 'subCatAll']);

        Route::get('brand-all', [BrandController::class, 'brandAll']);
        Route::get('size', [SizeController::class, 'index']);
        Route::get('color', [ColorController::class, 'index']);

        Route::controller(SellerFileSystemController::class)->group(function () {
            Route::post('/photo-remove', 'photoRemove');
            Route::get('/files',  'files');
        });

        Route::apiResources([
            'product' => ManageProductController::class
        ]);

        Route::post('product-multiple-delete', [ManageProductController::class, 'multipleDelete']);
    });
});
