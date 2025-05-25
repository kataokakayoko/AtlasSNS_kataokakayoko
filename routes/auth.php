<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    Route::post('added', [RegisteredUserController::class, 'added'])->name('register.added');
    // ユーザー登録完了後のページ表示
    Route::get('register-success', [RegisteredUserController::class, 'registerSuccess'])->name('register.success');

});

// ミドルウェアを適用
Route::middleware('auth')->group(function () {
    // トップページ
    Route::get('/', [PostsController::class, 'index'])->name('top');

    // プロフィールページ
    Route::get('/users/profile', [ProfileController::class, 'profile'])->name('profile');

    // ユーザー検索ページ
    Route::get('/users/search', [UsersController::class, 'search'])->name('users.search');

    // フォローリストページ
    Route::get('/follows', [FollowsController::class, 'followList'])->name('follows.list');

    // フォロワーリストページ
    Route::get('/followers', [FollowsController::class, 'followerList'])->name('followers.list');

    // 相手ユーザーのプロフィールページ
    Route::get('/user/{id}', [UsersController::class, 'show'])->name('user.profile');

    // ログアウト処理
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // ユーザー検索ページ
    Route::get('/users/search', [UsersController::class, 'search'])->name('user.search');

    // 投稿
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');

    // 投稿編集
    Route::put('/posts/{post}', [PostsController::class, 'update'])->name('posts.update');

    // 投稿削除
    Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');


});
