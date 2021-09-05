<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return redirect()->route('customer.index');
})->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resources([
        'customer' => CustomerController::class,
        'supplier' => SupplierController::class,
        'measurement' => MeasurementController::class,
        'product' => ProductController::class
    ]);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/cart/increment/{cart}', [CartController::class, 'increment'])->name('cart.increment');
    Route::get('/cart/decrement/{cart}', [CartController::class, 'decrement'])->name('cart.decrement');

    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/transaction/report', [TransactionController::class, 'report'])->name('transaction.report');
    Route::post('/transaction/report', [TransactionController::class, 'createReport'])->name('transaction.createReport');
});

require __DIR__.'/auth.php';
