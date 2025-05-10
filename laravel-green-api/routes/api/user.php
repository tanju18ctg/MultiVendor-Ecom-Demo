
<?php

use App\Http\Controllers\Api\Admin\DivisionController;
use App\Http\Controllers\Api\User\Auth\AuthController;
use App\Http\Controllers\Api\User\OrderController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\WishlistController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/user')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login',  'userLogin')->name('user.login');
        //twilio sms verification
        Route::post('/phone-verify', 'sendOtp')->name('user.phone.verify');
        Route::post('/phone-verify-code',  'verifyOtp')->name('user.phone.verify.code');
        Route::post('/register',  'userRegister')->name('user.register');
    });

    Route::group(['middleware' => ['cors', 'auth:user-api', 'scopes:user']], function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/home',  'home')->name('user.home');
            Route::post('/logout',  'userLogout')->name('user.logout');
            Route::post('/update-profile-img',  'profileImgChange')->name('user.change.profile');
            Route::post('/update-profile',  'updateProfile')->name('user.profile');
        });

        Route::apiResources([
            'wishlist' => WishlistController::class,
        ]);

        Route::get('divisions', [DivisionController::class, 'divisonAll']);
        Route::get('district/{id}', [DivisionController::class, 'districtList']);


        Route::controller(UserController::class)->group(function () {
            Route::post('/store-delivery', 'storeDelivery');
            Route::get('/my-address', 'myDeliveryAddress');
            Route::get('/delivery-charge', 'deliveryCharge');
        });

        // Route::post('/place-order', [OrderController::class, 'placeOrder']);
        // Route::get('/orders', [OrderController::class, 'index']);

        Route::controller(OrderController::class)->group(function () {
            Route::post('/place-order',  'placeOrder');
            Route::get('/orders',  'index');
            Route::get('/order-view',  'view');
        });


    });
});
