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

// ミドルウェアを適用（ログインしていないユーザーをリダイレクトする）
Route::middleware('auth')->group(function () {
    // トップページ
    Route::get('/top', [PostsController::class, 'index'])->name('top');

    // プロフィールページ（ログイン必須）
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

    // フォローリストページ（ログイン必須）
    Route::get('/follows', [FollowsController::class, 'followList'])->name('follows.list');

    // フォロー中ユーザーの投稿一覧（ログイン必須）
    Route::get('/follows/posts', [FollowsController::class, 'followingPosts'])->name('follows.posts');

    // フォロワーリストページ（ログイン必須）
    Route::get('/followers', [FollowsController::class, 'followerList'])->name('followers.list');

    // 相手ユーザーのプロフィールページ（ログイン必須）
    Route::get('/user/{id}', [UsersController::class, 'show'])->name('user.profile');

    // ログアウト処理
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // ユーザー検索ページ（ログイン必須）
    Route::get('/search', [UsersController::class, 'search_result'])->name('users.search_result');

    // フォローリストページ（ログイン必須）
    Route::get('/follow-list', [UsersController::class, 'followList'])->name('follow.list');

    // フォロー / フォロー解除（ログイン必須）
    Route::post('/users/{user}/follow', [FollowsController::class, 'follow'])->name('users.follow');
    Route::post('/users/{user}/unfollow', [FollowsController::class, 'unfollow'])->name('users.unfollow');

    // 投稿
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');

    // 投稿編集
    Route::put('/posts/{post}', [PostsController::class, 'update'])->name('posts.update');

    // 投稿削除
    Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');

    // プロフィール編集関連
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
