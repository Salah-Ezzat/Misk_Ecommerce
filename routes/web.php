<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\StockController;

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

Route::get('/seller', function () {
    return view('frontend.traders.seller');
});
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('users', UserController::class);
Route::get('/traders', [UserController::class,'traders'])->name('users.traders');
Route::get('/wholesalers', [UserController::class,'wholesalers'])->name('users.wholesalers');
Route::get('/confirm_add', [UserController::class, 'confirm_add'])->name('users.confirm_add');
Route::resource('provinces', ProvinceController::class);
Route::resource('cities', CityController::class);
Route::resource('stocks', StockController::class);
Route::get('/displayed', [StockController::class, 'displayed'])->name('stocks.displayed');
Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
Route::put('/banners/{id}/update-image', [BannerController::class, 'updateImage'])->name('banners.updateImage');
Route::resource('carts', CartController::class);
Route::resource('invoices', InvoiceController::class);








Route::get('/index', function () {
    return view('backend.index');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
