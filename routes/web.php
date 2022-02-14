<?php

use App\Http\Controllers\ProductController;
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

//Main view
Route::get('/', [ProductController::class , 'viewProducts'])->name('home');

//To check Product existst
Route::get('/check-product/{value}', [ProductController::class , 'checkProduct']);

//To Save New Product
Route::post('/save-new-product', [ProductController::class , 'saveProduct']);

//To get Cart Count
Route::get('/get-cart-count' , [ProductController::class , 'getProductCount']);

//To Delete a Product
Route::get('/delete-product/{id}' , [ProductController::class , 'deleteProduct']);

//To Update a Product
Route::post('/update-new-product' , [ProductController::class , 'updateProduct']);

//To View Cart
Route::get('/view-cart' , [ProductController::class , 'viewCart']);

//Add to Cart
Route::get('/add-to-cart/{id}' , [ProductController::class , 'addToCart']);

//Delete Cart Item
Route::get('/delete-cart-item/{id}' , [ProductController::class , 'deleteCartItem']);

//Delete All Cart
Route::get('/delete-all-cart' , [ProductController::class , 'deleteCartAll']);


