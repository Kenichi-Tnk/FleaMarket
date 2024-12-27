<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;


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
Route::middleware('auth', 'verified')->group(function() {
    Route::prefix('mypage')->group(function() {
        Route::get('/', [MypageController::class, 'index']);
        Route::get('/profile', [MypageController::class, 'profile']);
        Route::post('/profile/update', [MypageController::class, 'update']);
    });


    // 商品関係
    Route::prefix('item')->group(function() {
        Route::get('/comment/{item_id}', [ItemController::class, 'comment']);
        Route::post('/comment/store/{item_id}', [ItemController::class, 'store']);
        Route::post('/favorite/{item_id}', [ItemController::class, 'favorite']);
        Route::delete('/unfavorite/{item_id}', [ItemController::class, 'unfavorite']);
    });

    // 出品関係
    Route::get('/sell', [SellController::class, 'index']);
    Route::get('sell/{item_id}', [SellController::class, 'index']);
    Route::post('/sell', [SellController::class, 'create']);
    Route::post('/sell/{item_id}', [SellController::class, 'edit']);

    // 購入関係
    Route::prefix('purchase')->group(function() {
        Route::get('/{item_id}', [PurchaseController::class, 'index']);
        Route::get('/address/{item_id}', [PurchaseController::class, 'address']);
        Route::post('/address/update/{item_id}', [PurchaseController::class, 'updateAddress']);
        Route::get('/payment/{item_id}', [PurchaseController::class, 'payment']);
        Route::post('/payment/select/{item_id}', [PurchaseController::class, 'selectPayment']);
        Route::post('/decide/{item_id}', [PurchaseController::class, 'decidePurchase']);
    });
});

    // 認証不要ルート
Route::get('/', [IndexController::class, 'index']);
Route::get('search', [IndexController::class, 'search']);
Route::get('/item/{item_id}', [ItemController::class, 'index']);

