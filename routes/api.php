<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Shop\ShopController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/signup', [AuthController::class, 'userSignup']);
Route::post('user/signin', [AuthController::class, 'userSignIn']);
Route::post('user/signout', [AuthController::class, 'userLogout']);

Route::get('products', [ProductController::class, 'getProductList']);

Route::post('checkout', [ShopController::class, 'checkout']);
