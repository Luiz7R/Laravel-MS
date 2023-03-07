<?php

use App\Http\Controllers\CategoriesManagementController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsManagementController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['accesspanel'])->group(function($route) {
    Route::get('/painel', [PageController::class, 'HomepageA'])->name('msHomeAdm');
});

Route::get('/login', [PageController::class, 'Login'])->name('msPageLogin');
Route::get('/register', [PageController::class, 'Register'])->name('msPageReg');

Route::post('/ms/register', [RegisterController::class, 'register'])->name('msRegister');
Route::post('/ms/auth/login', [LoginController::class, 'login'])->name('msLogin');
Route::post('/ms/logout', [LoginController::class, 'logout'])->name('msLogout');
Route::get('', [PageController::class, 'Homepage'])->name('msHome');

# Product Routes
Route::get('/product/{productId}', [ProductsController::class, 'getProduct'])->name('getProductWE');
Route::get('/products', [ProductsController::class, 'getProducts'])->name('getProductsWE');

# Categories Route
Route::get('/categories', [CategoriesController::class, 'getCategories'])->name('getCategoriesWE');

Route::group(['middleware' => 'admin'], function($route) {
    $route->get('/products', [ProductsManagementController::class, 'ProductsPage'])->name('productsPage');
    $route->get('/categories', [CategoriesManagementController::class, 'CategoriesPage'])->name('categoriesPage');
    $route->get('/statistics', [PageController::class, 'Statistics'])->name('msPageStatistics');

    Route::group(['prefix' => '/api/v1'], function($route) {
        $route->get('/product/sales', [PageController::class, 'getProductSales'])->name('getProductSales');
        $route->get('/product/{productId}', [ProductsManagementController::class, 'getProduct'])->name('getProduct');
        $route->get('/products', [ProductsManagementController::class, 'getProducts'])->name('getProducts');
        $route->post('/c/product', [ProductsManagementController::class, 'postProduct'])->name('postProduct');
        $route->put('/u/product/{productId}', [ProductsManagementController::class, 'updateProduct'])->name('updateProduct');
        $route->delete('/d/product/{productId}', [ProductsManagementController::class, 'deleteProduct'])->name('deleteProduct');

        $route->group(['prefix' => 'promo'], function($route) {
            $route->post('/c/product', [ProductsManagementController::class, 'postPromoProduct'])->name('postPromoProduct');
        });

        $route->get('/category/{categoryId}', [CategoriesManagementController::class, 'getCategory'])->name('getCategory');
        $route->get('/categories', [CategoriesManagementController::class, 'getCategories'])->name('getCategories');
        $route->post('/c/category', [CategoriesManagementController::class, 'postCategory'])->name('postCategory');
        $route->put('/u/category/{categoryId}', [CategoriesManagementController::class, 'updateCategory'])->name('updateCategory');
        $route->delete('/d/category/{categoryId}', [CategoriesManagementController::class, 'deleteCategory'])->name('deleteCategory');   
    });
});