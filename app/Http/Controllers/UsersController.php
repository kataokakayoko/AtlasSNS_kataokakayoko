<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function search(Request $request)
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

        return view('users.search', compact('users', 'keyword'));
    }

    public function follow(User $user)
    {
        $authUser = Auth::user();
        // すでにフォローしているかチェックして、なければフォローする
        if (!$authUser->following()->where('followed_id', $user->id)->exists()) {
            $authUser->following()->attach($user->id);
        }
        return back();
    }

    public function unfollow(User $user)
    {
        $authUser = Auth::user();
        // すでにフォローしているかチェックして、あればフォロー解除
        if ($authUser->following()->where('followed_id', $user->id)->exists()) {
            $authUser->following()->detach($user->id);
        }
        return back();
    }
}
