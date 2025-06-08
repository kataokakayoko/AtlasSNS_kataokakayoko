<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
class PostsController extends Controller
{
    public function index()
{
    $user = Auth::user();

    // followings_count, followers_count を使う準備
    $user->loadCount('followings', 'followers');

    $posts = Post::with('user')->latest()->get();

    return view('posts.index', [
        'user' => $user,
        'followCount' => $user->followings_count,
        'followerCount' => $user->followers_count,
        'posts' => $posts,
    ]);
}

    public function store(Request $request)
    {
        $request->validate([
            'post' => 'required|string|min:1|max:150',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'post' => $request->input('post'),
        ]);

        return redirect()->route('top')->with('success', '投稿しました！');
    }

    public function update(Request $request, Post $post)
{
    if ($post->user_id !== auth()->id()) {
        abort(403, '権限がありません。');
    }

    $request->validate([
        'post' => 'required|string|min:1|max:150',
    ]);

    $post->post = $request->input('post');
    $post->save();

    return redirect()->route('top')->with('success', '投稿を編集しました！');
}
    public function destroy(Post $post)
{
    if ($post->user_id !== auth()->id()) {
        return redirect()->route('posts.index')->with('error', '権限がありません');
    }

    $post->delete();

    return redirect()->route('posts.index')->with('success', '投稿を削除しました！');
}

}
