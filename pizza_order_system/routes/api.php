<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;


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

Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('orders/cart',[RouteController::class,'orderCart']);
//post
Route::post('category/create',[RouteController::class,'categorycreate']);
Route::post('create/contact',[RouteController::class,'createContact']);
Route::get('category/delete/{id}',[RouteController::class,'deleteCategory']);

Route::get('category/details/{id}',[RouteController::class,'categoryDetails']);
Route::post('category/update',[RouteController::class,'categoryUpdate']);
