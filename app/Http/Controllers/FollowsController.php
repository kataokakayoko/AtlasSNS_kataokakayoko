<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class FollowsController extends Controller
{
    public function followList()
    {
        $user = Auth::user()->fresh(); // 最新情報を取得

        $followingUsers = $user->followings()->get();

        $posts = Post::whereIn('user_id', $followingUsers->pluck('id'))
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('follows.followList', compact('followingUsers', 'posts'));
    }

    public function followerList()
    {
        $user = Auth::user()->fresh(); // 最新情報を取得

        $followers = $user->followers()->get();

        $posts = Post::whereIn('user_id', $followers->pluck('id'))
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('follows.followerList', compact('followers', 'posts'));
    }

    public function followingsPosts()
    {
        $user = Auth::user()->fresh(); // 最新情報を取得

        $posts = Post::whereIn('user_id', $user->followings()->pluck('id'))
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('follows.followingsPosts', compact('posts'));
    }

    public function follow(User $user)
    {
        $currentUser = Auth::user();

        if (!$currentUser->isFollowing($user)) {
            $currentUser->followings()->attach($user->id);
        }

        return back(); // 元のページへ戻る
    }

    public function unfollow(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->isFollowing($user)) {
            $currentUser->followings()->detach($user->id);
        }

        return back(); // 元のページへ戻る
    }
}
