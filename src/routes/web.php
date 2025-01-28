<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Mail\TestMail;


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

    //認証関係
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

    //認証必要ルート
Route::middleware('auth', 'verified')->group(function() {
    Route::prefix('mypage')->group(function() {
        Route::get('/', [MypageController::class, 'index'])->name('mypage');
        Route::get('/profile', [MypageController::class, 'profile']);
        Route::post('/profile/update', [MypageController::class, 'update'])->name('profile.update');
    });


    // 商品関係
        Route::get('/item/{item_id}', [ItemController::class, 'index'])->name('item.show');
        Route::post('/item/{item_id}/comment', [CommentController::class, 'store'])->name('comments.store');
        Route::post('/item/{item_id}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
        Route::delete('/item/{item_id}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');


    // 出品関係
    Route::get('/sell', [SellController::class, 'index']);
    Route::get('sell/{item_id}', [SellController::class, 'index']);
    Route::post('/sell', [SellController::class, 'create']);
    Route::post('/sell/{item_id}', [SellController::class, 'edit']);
    Route::resource('items', ItemController::class);

    // 購入関係
    Route::prefix('purchase')->group(function() {
        Route::get('/{item_id}', [PurchaseController::class, 'index']);
        Route::get('/address/{item_id}', [PurchaseController::class, 'address']);
        Route::post('/address/update/{item_id}', [PurchaseController::class, 'updateAddress']);
        Route::get('/payment/{item_id}', [PurchaseController::class, 'payment']);
        Route::post('/payment/select/{item_id}', [PurchaseController::class, 'selectPayment']);
        Route::post('/decide/{item_id}', [PurchaseController::class, 'decidePurchase']);
    });

    // メール認証関係ルート
    Route::get('/email/verify', EmailVerificationPromptController::class)
        ->middleware('auth')
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['auth', 'signed'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');
});

    // 認証不要ルート
Route::get('/', [IndexController::class, 'index']);
Route::get('search', [IndexController::class, 'search']);
Route::get('/item/{item_id}', [ItemController::class, 'index'])->name('item.show');

// テストメール送信
Route::get('/test-email', function() {
    Mail::to('test-recipient@gmail.com')->send(new TestMail());
    return 'Test email sent';
});
