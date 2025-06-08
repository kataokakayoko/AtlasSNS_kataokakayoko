<x-login-layout>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="profile-container">
  <div class="profile-left">
    <div class="icon-row">
      @if(Auth::user()->image)
        <img src="{{ asset('images/' . Auth::user()->image) }}" alt="アイコン" class="icon-image">
      @else
        <div class="icon-placeholder"></div>
      @endif
      <label class="label-text">ユーザー名</label>
    </div>
    <label class="label-text">メールアドレス</label>
    <label class="label-text">パスワード</label>
    <label class="label-text">パスワード確認</label>
    <label class="label-text">自己紹介</label>
    <label class="label-text">アイコン画像</label>
    <div class="empty-label"></div>
  </div>

  <div class="profile-right">
    <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}" class="input-field">
    <input type="email" name="mail" value="{{ old('mail', Auth::user()->mail) }}" class="input-field">
    <input type="password" name="password" class="input-field">
    <input type="password" name="password_confirmation" class="input-field">
    <textarea name="profile" rows="4" class="input-field">{{ old('profile', Auth::user()->bio) }}</textarea>
    <input type="file" name="image" class="input-field">
    <button type="submit" class="submit-button">更新</button>
  </div>
</div>

</x-login-layout>
