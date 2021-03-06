<?php

use App\Http\Controllers\api\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\SocialLoginController;

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

// Route::get('/welcome', function () {
//     return view('welcome');
// });
// Socail auth routes
Route::get('oauth/{driver}', [SocialLoginController::class, 'redirectToProvider'])
    ->name('social.oauth');

Route::get('oauth/{driver}/callback', [SocialLoginController::class, 'handleProviderCallback'])
    ->name('social.callback');

Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('aboutus');

// main app vue routes
Route::get('{any}', function () {
    return view('app');
})->where('any', '.*')
    ->middleware(['auth', 'verified']);
