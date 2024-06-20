<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Auth::routes();

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::patch('/products/{product}/add', [ProductController::class, 'addToBusket'])->name('product.add');

Route::patch('/products/{product}/remove', [ProductController::class, 'removeFromBusket'])->name('product.remove');

Route::patch('/products/{product}/change', [ProductController::class, 'changeProductCount'])->name('product.change');

Route::patch('/products/clear', [ProductController::class, 'clearBusket'])->name('product.clear');

Route::get('/busket', [ProductController::class, 'busketIndex'])->name('busket');



