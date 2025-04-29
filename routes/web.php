<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProvinceController;

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
Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::put('carts', [CartController::class, 'bulkUpdate'])->name('carts.update.bulk');
Route::get('carts/{id}/delete', [CartController::class, 'destroy'])->name('carts.delete');
Route::resource('carts', CartController::class);
Route::get('invoices/{id}/prepare', [InvoiceController::class, 'prepare'])->name('invoices.prepare');
Route::get('invoices/done', [InvoiceController::class, 'doneInvoices'])->name('invoices.doneInvoices');
Route::get('invoices/cancelled', [InvoiceController::class, 'cancelledInvoices'])->name('invoices.cancelledInvoices');
Route::get('invoices/prepared', [InvoiceController::class, 'preparedInvoices'])->name('invoices.preparedInvoices');
Route::get('invoices/new', [InvoiceController::class, 'newInvoices'])->name('invoices.newInvoices');
Route::resource('invoices', InvoiceController::class);
Route::post('/order/add', [OrderController::class, 'add'])->name('order.add');
Route::get('orders/{id}/show', [OrderController::class, 'show'])->name('orders.show');
Route::get('orders/{invoice_id}/editform', [OrderController::class, 'editform'])->name('orders.editform');
Route::resource('orders', OrderController::class);








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
