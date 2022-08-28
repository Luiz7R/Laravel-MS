<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
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

Route::get('/', [PageController::class, 'Homepage'])->name('msHome');
Route::get('/login', [PageController::class, 'Login'])->name('msPageLogin');
Route::get('/register', [PageController::class, 'Register'])->name('msPageReg');
Route::get('/statistics', [PageController::class, 'Statistics'])->name('msPageStatistics');

Route::post('/ms/register', [RegisterController::class, 'register'])->name('msRegister');
Route::post('/ms/auth/login', [LoginController::class, 'login'])->name('msLogin');
Route::post('/ms/logout', [LoginController::class, 'logout'])->name('msLogout');

route::get('/api/v1/product/sales', [PageController::class, 'getProductSales'])->name('getProductSales');

Route::get('/products', [ProductsController::class, 'ProductsPage'])->name('productsPage');
Route::get('/api/v1/product/{productId}', [ProductsController::class, 'getProduct'])->name('getProduct');
Route::get('/api/v1/products', [ProductsController::class, 'getProducts'])->name('getProducts');
Route::post('/api/v1/c/product', [ProductsController::class, 'postProduct'])->name('postProduct');
Route::put('/api/v1/u/product/{productId}', [ProductsController::class, 'updateProduct'])->name('updateProduct');
Route::delete('/api/v1/d/product/{productId}', [ProductsController::class, 'deleteProduct'])->name('deleteProduct');


Route::get('/categories', [CategoriesController::class, 'CategoriesPage'])->name('categoriesPage');
Route::get('/api/v1/category/{categoryId}', [CategoriesController::class, 'getCategory'])->name('getCategory');
Route::get('/api/v1/categories', [CategoriesController::class, 'getCategories'])->name('getCategories');
Route::post('/api/v1/c/category', [CategoriesController::class, 'postCategory'])->name('postCategory');
Route::put('/api/v1/u/category/{categoryId}', [CategoriesController::class, 'updateCategory'])->name('updateCategory');
Route::delete('/api/v1/d/category/{categoryId}', [CategoriesController::class, 'deleteCategory'])->name('deleteCategory');
