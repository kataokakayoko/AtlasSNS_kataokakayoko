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
        'mail' => 'required|string|mail|min:5|max:40|unique:users',
        'password' => ['required','alpha_num','min:8','max:20','confirmed'],
    ]);

    $user = User::create([
            'username' => $request->username,
            'mail' => $request->mail,
            'password' => Hash::make($request->password),
        ]);

        $request->session()->put('registered_user', $user);

        return redirect()->route('register.added');
    }

    public function added()
    {
        $user = session('registered_user'); // セッションから登録したユーザーを取得
        $username = $user->username; // ユーザー名を取得

        return view('auth.added', compact('username')); // ビューに渡す
    }

}
