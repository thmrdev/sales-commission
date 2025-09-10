<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController; 

Route::apiResource('sellers', SellerController::class)
    ->only(['index', 'store']);
