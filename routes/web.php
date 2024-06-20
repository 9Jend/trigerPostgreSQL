<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\BusketController;
use App\Http\Controllers\OrderController;

Auth::routes();

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::patch('/products/{product}/add', [ProductController::class, 'addToBusket'])->name('product.add');

Route::patch('/products/{product}/remove', [ProductController::class, 'removeFromBusket'])->name('product.remove');

Route::patch('/products/{product}/change', [BusketController::class, 'changeProductCount'])->name('product.change');

Route::get('/busket', [BusketController::class, 'index'])->name('busket');

Route::get('/statistic', [StatisticController::class, 'index'])->name('statistic');

Route::patch('/checkout', [OrderController::class, 'index'])->name('checkout');




