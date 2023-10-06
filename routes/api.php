<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CheckoutController;

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


Route::resource('baskets', BasketController::class);
Route::post("baskets/add/{bookId}", [BasketController::class, "addBook"]);
Route::post("baskets/remove/{bookId}", [BasketController::class, "removeBook"]);
Route::resource('books', BookController::class);
Route::resource("checkouts", CheckoutController::class);
Route::post("baskets/deletebasket", [BasketController::class, "deleteBasket"]);