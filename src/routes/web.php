<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;


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

    // 認証不要ルート
Route::get('/', [IndexController::class, 'index']);
Route::get('search', [IndexController::class, 'search']);
Route::get('/item/{item_id}', [ItemController::class, 'index'])->name('item.show');

    //ログイン・ユーザー登録
Route::middleware(['guest'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

    //ログアウト
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

    //認証必要ルート
Route::middleware('auth', 'verified')->group(function() {

    // マイページ関係
    Route::prefix('mypage')->group(function() {
        Route::get('/', [MypageController::class, 'index'])->name('mypage');
        Route::get('/profile', [MypageController::class, 'profile'])->name('profile.edit');
        Route::post('/profile/update', [MypageController::class, 'update'])->name('profile.update');
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
    Route::put('/sell/{item_id}', [SellController::class, 'edit']);

    // 購入関係
    Route::prefix('purchase')->group(function () {
        Route::get('/{item_id}', [PurchaseController::class, 'index']);
        Route::get('/address/{item_id}', [PurchaseController::class, 'address']);
        Route::post('/address/update/{item_id}', [PurchaseController::class, 'updateAddress']);
        Route::get('/payment/{item_id}', [PurchaseController::class, 'payment']);
        Route::post('/payment/payment/select/{item_id}', [PurchaseController::class, 'selectPayment'])->name('purchase.selectPayment');
        Route::post('/purchase/decide/{item_id}', [PurchaseController::class, 'decidePurchase'])->name('purchase.decide');
    });
});

    // メール認証関係ルート
Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');
