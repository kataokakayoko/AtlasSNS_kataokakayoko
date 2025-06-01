<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    // フォローしているユーザーのリストを表示
    public function followList()
    {
        $user = Auth::user();

    // ログイン中のユーザーがフォローしているユーザーを取得
        $followingUsers = $user->following()->get();

        return view('follows.followList', compact('followingUsers'));
    }

    // 自分をフォローしているユーザーのリストを表示
    public function followerList()
    {
        $user = Auth::user();

        // ログイン中のユーザーをフォローしているユーザーを取得
        $followers = $user->followers()->get();

        return view('follows.followerList', compact('followers'));
    }
}
