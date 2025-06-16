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
        return view('profiles.profile');
    }

    public function update(Request $request): RedirectResponse
{
    $user = Auth::user();

    $request->validate([
        'username' => ['required', 'string', 'min:2', 'max:12'],
        'email' => ['required', 'email', 'min:5', 'max:40', 'unique:users,email,' . $user->id],
        'password' => ['nullable', 'string', 'min:8', 'max:20', 'regex:/^[a-zA-Z0-9]+$/'],
        'password_confirmation' => ['nullable', 'same:password'],
        'profile' => ['nullable', 'string', 'max:150'],
        'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,bmp,gif,svg', 'max:2048'],
    ], [
        'password.regex' => 'パスワードは英数字のみで入力してください。',
    ]);

    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->bio = $request->input('profile');

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $fileName = $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $fileName);

        $user->icon_image = $fileName;
    }

    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    return redirect()->route('profile')->with('success', 'プロフィールを更新しました！');
}

}
