<?php

use App\Http\Controllers\ProductsManagementController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function($route) {
    $route->get('/productsData', [ProductsManagementController::class, 'ProductsPage1'])->name('productsPage');
    $route->get('/promoProducts', [ProductsManagementController::class, 'getPromoProducts'])->name('promoProducts');
});