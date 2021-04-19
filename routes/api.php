<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAdmincontroller;
use App\Http\Controllers\roomcontroller;
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


Route::get('/admin/getusers',[ApiAdmincontroller::class,'GetAllUsers']);
Route::delete('/admin/deleteuser/{id}',[ApiAdmincontroller::class,'destroy']);
Route::patch('/admin/edituser/{id}',[ApiAdmincontroller::class,'update']);
Route::resource('/rooms',roomcontroller::class);
Route::get('/admin/getusers/{id}',[ApiAdmincontroller::class,'showuser']);
