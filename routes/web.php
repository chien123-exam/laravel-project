<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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
    return view('welcome');
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

Route::get('product-list', [ProductController::class, 'index'])->name('product.index');

Route::get('product-detail/{id}', function ($id) {
    return 'Product Detail: ' . $id;
})->name('product.show');

Route::get('/student', [StudentController::class, 'index']);
Route::get('/student/{id}', [StudentController::class, 'show']);

