<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;

Route::middleware('guest')->group(function () {
    // ログイン関連
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
    // 新規登録関連
    // 新規ユーザー登録フォーム表示
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    // 新規ユーザー登録処理
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');
    // ユーザー登録完了後のページ
    Route::get('added', [RegisteredUserController::class, 'added'])->name('register.added');
    Route::post('added', [RegisteredUserController::class, 'added']);
    // ユーザー登録完了後のページ表示
    Route::get('register-success', [RegisteredUserController::class, 'registerSuccess'])->name('register.success');

});

Route::middleware('auth')->group(function () {
    Route::get('/', [PostsController::class, 'index'])->name('top');
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Route::get('/test-profile', function () {
//     return route('profile');
// });
