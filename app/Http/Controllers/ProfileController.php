<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function profile(){
        return view('profiles.profile');
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            $fileName = $user->id . '_' . time() . '.' . $avatar->getClientOriginalExtension();

            $avatar->move(public_path('images'), $fileName);

            $user->avatar = $fileName;
            $user->save();
        }

        return redirect()->route('profile')->with('success', 'プロフィール画像を更新しました！');
    }
}
