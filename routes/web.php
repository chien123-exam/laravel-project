<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('app');
    // echo __FILE__;
});

// Route::get('user',function () {
//     return view('users.index');
// })->name('home');

// Route::get('product', function () {
//     return view('products.index');
// });

// Route::get('{slug}', function ($slug)  {
//     return $slug;
// });

// Route::get('{slug}/{id?}', function ($slug, $test = null) {
//     // echo 'ID: ' . $test;
//     echo 'ID: ';
//     return $slug;
// })->name('test.route');

//Router Name

// Route::get('product-list', [ProductController::class, 'index'])->name('product.index');

// Route::get('product-detail/{id}', function ($id) {
//     return 'Product Detail: ' . $id;
// })->name('product.show');

// Route::get('/student', [StudentController::class, 'index']);
// Route::get('/student/{id}', [StudentController::class, 'show']);

// Route::prefix('admin')->as('admin.')->group(function() {
//     Route::get('product', [ProductController::class, 'index'])
//         ->middleware(['verified.admin'])
//         ->name('product.index');
//     Route::get('category', [CategoryController::class, 'index'])->name('categori.index');
//     Route::get('user', [UserController::class, 'index'])->name('user.index');
//     Route::get('order', [OrderController::class, 'index'])->name('order.index');
//     Route::resource('customer', CustomerController::class)->except('index');
// });

// Route::get('login', function() {
//     return 'Login Page';
// })->name('login');


// Route::delete('delete-user', function() {
//     return 'Delete User Route';
// })->name('user.delete');

// Route::put('delete-user', function() {
//     return 'Delete User Route';
// })->name('user.update');

// Route::post('delete-user', function() {
//     return 'Delete User Route';
// })->name('user.store');

Route::prefix('admin')->as('admin.')->group(function() {
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('order', OrderController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('user', UserController::class);
    Route::resource('setting', SettingController::class);
});


