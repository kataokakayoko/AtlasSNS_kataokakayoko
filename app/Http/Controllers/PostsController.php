<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post; // 追加

class PostsController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ログイン中のユーザーを取得
        $user->loadCount('following', 'followers'); // フォローとフォロワー

        // 投稿一覧も表示する場合はここで取得
        $posts = Post::with('user')->latest()->get();

        return view('posts.index', [
            'user' => $user,
            'followCount' => $user->follows_count, // フォロー数
            'followerCount' => $user->followers_count, // フォロワー数
            'posts' => $posts, // 投稿一覧
        ]);
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|string|min:1|max:150',
        ]);

        // 投稿を保存
        Post::create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('top')->with('success', '投稿しました！');
    }

    public function update(Request $request, Post $post)
{
    // 自分の投稿のみ編集できるようにする
    if ($post->user_id !== auth()->id()) {
        abort(403, '権限がありません。');
    }

    // バリデーション
    $request->validate([
        'content' => 'required|string|min:1|max:150',
    ]);

    // 更新
    $post->content = $request->input('content');
    $post->save();

    return redirect()->route('top')->with('success', '投稿を編集しました！');
}
    // 削除
    public function destroy(Post $post)
{
    // 自分の投稿だけ削除可能にする
    if ($post->user_id !== auth()->id()) {
        return redirect()->route('posts.index')->with('error', '権限がありません');
    }

    $post->delete();

    return redirect()->route('posts.index')->with('success', '投稿を削除しました！');
}

}
