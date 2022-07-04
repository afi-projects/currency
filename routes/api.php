<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Orders\OrderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	$currencies = Cache::remember('currencies', $seconds, function () {
    return DB::table('currencies')->get();
});
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('orders', OrderController::class);
});
