<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('/', [ProductsController::class,'index']);
Route::resource('products', ProductsController::class);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// API danh sách sản phẩm
Route::get('/api/v1/product/list', [ProductsController::class, 'productListApi']);

// API cập nhật sản phẩm
Route::put('/api/v1/product/{id}/update', [ProductsController::class, 'updateProductApi']);
// API xóa sản phẩm
Route::delete('/api/v1/product/{id}/delete', [ProductsController::class, 'deleteProductApi']);

