<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Wishlist\WishlistController;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Product\RecommendationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//authenication
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


//product management
Route::resource('products', ProductController::class);
Route::get('products/category/{category}', [ProductController::class, 'getProductsByCategory']);
Route::post('products/by-names', [ProductController::class, 'getProductsByNames']);


//authenticated routes
Route::middleware(['jwt.auth'])->group(function () {
    //wishlist management
    Route::resource('wishlists', WishlistController::class)->only([
        'index', 'store', 'destroy'
    ]);
    //cart management
    Route::resource('carts', CartController::class);
    Route::post('carts/checkout', [CartController::class, 'checkout'])->name('carts.checkout');
    Route::get('/recommendations/{productName}', [RecommendationController::class, 'recommendProducts']);
    Route::post('/predict-category', [RecommendationController::class, 'predictCategory']); 
});
