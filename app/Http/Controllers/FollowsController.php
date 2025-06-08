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
        $user = Auth::user();

        $followingUsers = $user->followings()->get();

        $posts = \App\Models\Post::whereIn('user_id', $followingUsers->pluck('id'))
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('follows.followList', compact('followingUsers', 'posts'));
    }

    public function followerList()
    {
        $user = Auth::user();

        $followers = $user->followers()->get();

        $posts = Post::whereIn('user_id', $followers->pluck('id'))
        ->with('user')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('follows.followerList', compact('followers', 'posts'));
    }

    public function followingsPosts()
    {
    $user = Auth::user();

    $posts = Post::whereIn('user_id', $user->following()->pluck('followed_id'))
        ->with('user')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('follows.followingsPosts', compact('posts'));
    }

    public function follow(User $user)
    {
    Auth::user()->followings()->attach($user->id);
    return back();
    }

public function unfollow(User $user)
    {
    Auth::user()->followings()->detach($user->id);
    return back();
    }
}
