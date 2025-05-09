<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // ログイン関連
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
    // 新規登録関連
    // 新規ユーザー登録フォーム表示
    Route::get('register', [RegisteredUserController::class, 'create'])->name('login');
    // 新規ユーザー登録処理
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');
    // ユーザー登録完了後のページ
    Route::get('added', [RegisteredUserController::class, 'added']);
    Route::post('added', [RegisteredUserController::class, 'added']);
    // ユーザー登録完了後のページ表示
    Route::get('register-success', [RegisteredUserController::class, 'registerSuccess'])->name('register.success');

});
