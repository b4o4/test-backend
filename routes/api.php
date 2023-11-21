<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('callback-gateway/one', [\App\Http\Controllers\PaymentController::class, 'gatewayOne'])
    ->middleware('throttle:'.config('services.merchant_one.count_request').',1440');

Route::post('callback-gateway/two', [\App\Http\Controllers\PaymentController::class, 'gatewayTwo'])
    ->middleware('throttle:'.config('services.merchant_two.count_request').',1440');
