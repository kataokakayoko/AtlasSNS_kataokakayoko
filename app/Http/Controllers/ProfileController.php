<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function profile(): View
    {
        // ユーザーがログインしているか確認
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['auth' => 'ログインしてください。']);
        }

        return view('profiles.profile');
    }

    public function update(Request $request): RedirectResponse
{
    $user = Auth::user();

    // バリデーションメッセージ
    $messages = [
        'username.required' => 'ユーザー名は必須です。',
        'username.string' => 'ユーザー名は文字列で入力してください。',
        'username.min' => 'ユーザー名は2文字以上で入力してください。',
        'username.max' => 'ユーザー名は12文字以内で入力してください。',
        'email.required' => 'メールアドレスは必須です。',
        'email.email' => '正しいメールアドレス形式で入力してください。',
        'email.min' => 'メールアドレスは5文字以上で入力してください。',
        'email.max' => 'メールアドレスは40文字以内で入力してください。',
        'email.unique' => 'このメールアドレスは既に使用されています。',
        'password.required' => 'パスワードは必須です。',
        'password.regex' => 'パスワードは英数字のみで入力してください。',
        'password.min' => 'パスワードは8文字以上で入力してください。',
        'password.max' => 'パスワードは20文字以内で入力してください。',
        'password_confirmation.required' => 'パスワード確認は必須です。',
        'password_confirmation.same' => 'パスワード確認が一致しません。',
        'profile.max' => '自己紹介は最大150文字までです。',
        'icon_image.image' => 'アイコン画像は画像ファイルでなければなりません。',
        'icon_image.mimes' => 'アイコン画像はjpg、jpeg、png、bmp、gif、svg形式である必要があります。',
        'icon_image.max' => 'アイコン画像のサイズは最大2MBまでです。',
    ];

    $validatedData = $request->validate([
        'username' => ['required', 'string', 'min:2', 'max:12'],
        'email' => ['required', 'email', 'min:5', 'max:40', 'unique:users,email,' . $user->id],
        'password' => ['nullable', 'string', 'min:8', 'max:20', 'regex:/^[a-zA-Z0-9]+$/'],
        'password_confirmation' => ['nullable', 'same:password'],
        'profile' => ['nullable', 'string', 'max:150'],
        'icon_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,bmp,gif,svg', 'max:2048'],
    ], $messages);

    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->bio = $request->input('profile');

    if ($request->hasFile('icon_image')) {
        if ($user->icon_image && file_exists(public_path('storage/' . $user->icon_image))) {
            unlink(public_path('storage/' . $user->icon_image));
        }

        $image = $request->file('icon_image');
        $fileName = $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/images', $fileName);
        $user->icon_image = 'storage/images/' . $fileName;
    }

    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    return redirect()->route('top')->with('success', 'プロフィールを更新しました！');
}
}
