<?php

use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\roomcontroller;
use App\Http\Controllers\Api\admincontroller;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource("/products", ProductController::class);

Route::get('/categories', [ProductController::class, 'getCategories']);

Route::post('/addCategory', [ProductController::class, 'addCategory']);
Route::get("{user_id}/orders/range", [OrderController::class,  "get_orders_within_date_range"])->name("orders.range");
Route::apiResource("{user_id}/orders", OrderController::class);
Route::get("/rooms", [HomeController::class, "get_rooms"])->name("get_rooms");
Route::get("/{user_id}", [HomeController::class, "index"])->name("index");
Route::get('/admin/getusers', [admincontroller::class, 'GetAllUsers']);

Route::delete('/admin/deleteuser/{id}', [admincontroller::class, 'destroy']);

Route::patch('/admin/edituser/{id}', [admincontroller::class, 'update']);

Route::get('/admin/getusers/{id}', [admincontroller::class, 'showuser']);
Route::post('/admin/create', [admincontroller::class, 'store']);

Route::resource('/rooms', roomcontroller::class);
