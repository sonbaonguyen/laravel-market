<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
Route::get('/', function () {
    return view('pages.home');
});

//------------------------------------------------------------------------------------------------- Product

// Index
Route::get('/products', [ProductController::class, 'index']);

// create
Route::get('/products/upload', [ProductController::class, 'create'])->middleware('auth');
// store
Route::post('/products/upload', [ProductController::class, 'store'])->middleware('auth');
// edit
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->middleware('auth');
//update
Route::put('/products/{product}/update', [ProductController::class, 'update'])->middleware('auth');
//delete
Route::delete('/products/{product}/delete', [ProductController::class, 'destroy'])->middleware('auth');

// User's upload products page
Route::get('/products/uploaded', [ProductController::class, 'uploadedProducts'])->middleware('auth');

// User's favorites products page
Route::get('/products/favorites', [ProductController::class, 'favoriteProducts'])->middleware('auth');

// show
Route::get('/products/{product}', [ProductController::class, 'show']);

// Favorite/store
Route::post('/products/{product}/favorite', [ProductController::class, 'toggleFavorite'])->middleware('auth');

// Get total number of favorite products
Route::post('/favorites/count', [ProductController::class, 'countFavorite']);

//------------------------------------------------------------------------------------------------- User

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

Route::post('/login', [UserController::class, 'authenicate'])->middleware('guest');

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::get('/register', [UserController::class, 'register'])->middleware('guest');

Route::post('/register', [UserController::class, 'create'])->middleware('guest');
