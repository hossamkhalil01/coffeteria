<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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


Route::get('/admin/getusers',[admincontroller::class,'GetAllUsers']);

Route::delete('/admin/deleteuser/{id}',[admincontroller::class,'destroy']);

Route::patch('/admin/edituser/{id}',[admincontroller::class,'update']);

Route::get('/admin/getusers/{id}',[admincontroller::class,'showuser']);

Route::resource('/rooms',roomcontroller::class);

