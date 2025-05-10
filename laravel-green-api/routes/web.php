<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('admin.admin_master');
});

Route::get('/admin/{vue_capture?}',function () {
    return view('admin.admin_master');
})->where('vue_capture', '[\/\w\.-]*');


 //dynamic path will be go last section
 Route::get('/seller', function () {
    return view('seller.seller_master');
});

Route::get('/seller/{vue_capture?}',function () {
    return view('seller.seller_master');
})->where('vue_capture', '[\/\w\.-]*');



// Route::get('/seller/{path}', function () {
//     return view('seller.seller_master');
// });

// //for passing id with vuejs
// Route::get('/seller/{path}/{id}', function () {
//     return view('seller.seller_master');
// });

// Route::get('/admin/{path}', function () {
//     return view('admin.admin_master');
// });

// //for passing id with vuejs
// Route::get('/admin/{path}/{id}', function () {
//     return view('admin.admin_master');
// });


// Route::prefix('admin')->group(base_path('routes/admin.php'));
// Route::prefix('user')->group(base_path('routes/user.php'));

