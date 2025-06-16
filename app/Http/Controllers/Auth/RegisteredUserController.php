<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|min:2|max:12|unique:users',
            'email' => 'required|string|email|min:5|max:40|unique:users',
            'password' => ['required','alpha_num','min:8','max:20','confirmed'],
        ], [
            'username.required' => 'ユーザー名は必須項目です。',
            'username.min' => 'ユーザー名は2文字以上で入力してください。',
            'username.max' => 'ユーザー名は12文字以内で入力してください。',
            'username.unique' => 'このユーザー名は既に使用されています。',

            'email.required' => 'メールアドレスは必須項目です。',
            'email.email' => '正しい形式のメールアドレスを入力してください。',
            'email.min' => 'メールアドレスは5文字以上で入力してください。',
            'email.max' => 'メールアドレスは40文字以内で入力してください。',
            'email.unique' => 'このメールアドレスは既に使用されています。',

            'password.required' => 'パスワードは必須項目です。',
            'password.alpha_num' => 'パスワードは半角英数字で入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは20文字以内で入力してください。',
            'password.confirmed' => '確認用パスワードが一致しません。',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $request->session()->put('registered_user', $user);

        return redirect()->route('register.added');
    }

    public function added()
    {
        $user = session('registered_user');
        $username = $user->username;

        return view('auth.added', compact('username'));
    }
}
