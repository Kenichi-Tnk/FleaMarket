<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MypageController;


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
    return view('welcome');
});

//認証必要ルート    
// // Route::middleware('auth')->group(function() {
//     Route::prefix('mypage')->group(function() {
        Route::get('/', [MypageController::class, 'index']);
        Route::get('/profile', [MypageController::class, 'profile']);
        Route::post('/profile/update', [MypageController::class, 'update']);
//     });
// });

// 認証不要ルート
Route::get('/', [IndexController::class, 'index']);
Route::get('search', [IndexController::class, 'search']);
Route::get('/item/{item_id}', [ItemController::class, 'index']);

