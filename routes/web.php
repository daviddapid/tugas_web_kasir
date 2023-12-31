<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
   Route::resource('/category', CategoryController::class);
   Route::resource('/item', ItemController::class);
   Route::resource('/transaction', TransactionController::class);
   Route::get('/transaction/{item}/add-to-cart', [TransactionController::class, 'addToCart'])->name('transaction.addToCart');
   Route::post('/transaction/{item}/update-cart', [TransactionController::class, 'updateCart'])->name('transaction.updateCart');
   Route::post('/transaction/{item}/delete', [TransactionController::class, 'deleteItem'])->name('transaction.delete');
   Route::get('/reset', [TransactionController::class, 'reset']);
});
