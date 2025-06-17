<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('top'));
    }

    /**
     * ログアウト処理
     */
    public function destroy(Request $request)
    {
        // ログアウト処理
        Auth::guard('web')->logout();

        // セッションを無効化し、トークンを再生成
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('top'));
    }
}
