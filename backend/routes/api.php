<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController; 
use App\Http\Controllers\SaleController; 

Route::prefix('v1')->group(function () {
    Route::apiResource('sellers', SellerController::class)
        ->only(['index', 'store']);

    Route::apiResource('sales', SaleController::class)
        ->only(['index', 'store']);

    Route::get('sellers/{seller}/sales', [SaleController::class, 'salesBySeller'])
        ->name('sellers.sales');
});
