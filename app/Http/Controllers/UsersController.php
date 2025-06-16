<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function search_result(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = User::where('id', '!=', Auth::id());

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('username', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        $users = $query->paginate(10);

        return view('users.search_result', compact('users', 'keyword'));
    }

    public function follow(User $user)
    {
        $authUser = Auth::user();
        if (!$authUser->followings()->where('followed_id', $user->id)->exists()) {
            $authUser->followings()->attach($user->id);
        }
        return back();
    }

    public function unfollow(User $user)
    {
        $authUser = Auth::user();
        if ($authUser->followings()->where('followed_id', $user->id)->exists()) {
            $authUser->followings()->detach($user->id);
        }
        return back();
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->with('user')->orderBy('created_at', 'desc')->get();

        $authUser = Auth::user();
        $isFollowing = false;

        if ($authUser && $authUser->id !== $user->id) {
            $isFollowing = $authUser->followings()->where('followed_id', $user->id)->exists();
        }

        return view('users.profile', compact('user', 'posts', 'isFollowing'));
    }

    public function updateIcon(Request $request)
    {
        $request->validate([
            'icon_image' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            $path = $request->file('image')->store('icons', 'public');

            $user->image = $path;
            $user->save();
        }

        return back()->with('success', 'プロフィール画像を更新しました。');
    }

    public function followList()
    {
        $authUser = Auth::user();

        // フォロー中のユーザー一覧
        $followingUsers = $authUser->followings()->get();

        // フォロー中のユーザーの投稿一覧
        $posts = Post::whereIn('user_id', $followingUsers->pluck('id'))
                     ->with('user')
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('users.follow_list', compact('followingUsers', 'posts'));
    }
}
