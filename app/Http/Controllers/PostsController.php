<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['auth' => 'ログインしてください。']);
        }

        $user = Auth::user();

        $followedUserIds = $user->followings->pluck('id')->merge($user->id);

        // 自分とフォローしているユーザーの投稿のみを取得
        $posts = Post::with('user')
                     ->whereIn('user_id', $followedUserIds)
                     ->latest()
                     ->get();

        return view('posts.index', [
            'user' => $user,
            'followCount' => $user->followings_count,
            'followerCount' => $user->followers_count,
            'posts' => $posts,
        ]);
    }

    public function store(Request $request)
    {
        // バリデーションメッセージ
        $messages = [
            'post.required' => '投稿内容は必須です。',
            'post.string' => '投稿内容は文字列でなければなりません。',
            'post.min' => '投稿内容は最低1文字以上でなければなりません。',
            'post.max' => '投稿内容は最大150文字までです。',
        ];

        $validator = Validator::make($request->all(), [
            'post' => 'required|string|min:1|max:150',
        ], $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('is_post_form', true);
        }

        Post::create([
            'user_id' => auth()->user()->id,
            'post' => $request->input('post'),
        ]);

        return redirect()->route('top')->with('success', '投稿しました！');
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->user()->id) {
            abort(403, '権限がありません。');
        }

        $messages = [
            'post.required' => '投稿内容は必須です。',
            'post.string' => '投稿内容は文字列でなければなりません。',
            'post.min' => '投稿内容は最低1文字以上でなければなりません。',
            'post.max' => '投稿内容は最大150文字までです。',
        ];

        $validator = Validator::make($request->all(), [
            'post' => 'required|string|min:1|max:150',
        ], $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('edit_modal_id', $post->id);
        }

        $post->post = $request->input('post');
        $post->save();

        return redirect()->route('top')->with('success', '投稿を編集しました！');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->user()->id) {
            abort(403, '権限がありません。');
        }

        $post->delete();

        return redirect()->route('top')->with('success', '投稿を削除しました！');
    }
}
