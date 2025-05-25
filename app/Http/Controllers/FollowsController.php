<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    /**
     * フォローしているユーザーのリストを表示
     */
    public function followList()
    {
        // ログイン中のユーザー
        $user = Auth::user();

        // ログイン中のユーザーがフォローしているユーザーを取得
        $followingUsers = $user->follows()->with('followed')->get();

        // ビューにフォローしているユーザーを渡す
        return view('follows.followList', compact('followingUsers'));
    }

    /**
     * 自分をフォローしているユーザーのリストを表示
     */
    public function followerList()
    {
        // ログイン中のユーザー
        $user = Auth::user();

        // ログイン中のユーザーをフォローしているユーザーを取得
        $followers = $user->followers()->with('following')->get();

        // ビューにフォロワーを渡す
        return view('follows.followerList', compact('followers'));
    }
}
