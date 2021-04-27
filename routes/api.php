<?php

use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\roomcontroller;
use App\Http\Controllers\Api\admincontroller;
use App\Http\Controllers\imagecontroller;
use App\Http\Middleware\CheckAdmin;

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

Route::middleware(['auth'])->group(function () {

    Route::apiResource("/products", ProductController::class)->middleware([CheckAdmin::class]);

    Route::get('/categories', [ProductController::class, 'getCategories'])->middleware([CheckAdmin::class]);

    Route::post('/addCategory', [ProductController::class, 'addCategory'])->middleware([CheckAdmin::class]);

    // orders routes
    Route::get("{user_id}/orders/range", [OrderController::class,  "get_orders_within_date_range"])->name("orders.range");
    Route::apiResource("{user_id}/orders", OrderController::class);
    // home routes
    Route::get("/admin/index", [HomeController::class, "admin_index"])->name("admin_index")->middleware([CheckAdmin::class]);
    Route::get("/rooms", [HomeController::class, "get_rooms"])->name("get_rooms");
    // checks
    Route::get("/orders", [OrderController::class, "get_orders"]);
    Route::get("/orders/{id}", [OrderController::class, "get_order"]);
    Route::apiResource("/users", UserController::class);

    Route::get("/{user_id}", [HomeController::class, "index"])->name("index");
    Route::get('/admin/getusers', [admincontroller::class, 'GetAllUsers'])->middleware([CheckAdmin::class]);

    Route::delete('/admin/deleteuser/{id}', [admincontroller::class, 'destroy'])->middleware([CheckAdmin::class]);

    Route::patch('/admin/edituser/{id}', [admincontroller::class, 'update'])->middleware([CheckAdmin::class]);

    Route::get("/admin/getorders", [OrderController::class, "get_processing_orders"])->middleware([CheckAdmin::class]);

    Route::patch("/order/deliver/{id}", [OrderController::class, "deliver_order"])->middleware([CheckAdmin::class]);

    Route::get('/admin/getusers/{id}', [admincontroller::class, 'showuser'])->middleware([CheckAdmin::class]);
    Route::post('/admin/create', [admincontroller::class, 'store'])->middleware([CheckAdmin::class]);
    Route::post('upload', [imagecontroller::class, 'upload']);
    Route::resource('/rooms', roomcontroller::class);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});