<x-login-layout>
<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @csrf

    <div class="profile-container">
      <div class="profile-left">
        <div class="icon-row">
          @if(Auth::user()->image)
            <img src="{{ asset('images/' . Auth::user()->image) }}" alt="アイコン" class="icon-image">
          @else
            <div class="icon-placeholder"></div>
          @endif
          <label class="label-text" for="username">ユーザー名</label>
        </div>
        <label class="label-text" for="mail">メールアドレス</label>
        <label class="label-text" for="password">パスワード</label>
        <label class="label-text" for="password_confirmation">パスワード確認</label>
        <label class="label-text" for="profile">自己紹介</label>
        <label class="label-text" for="image">アイコン画像</label>
        <div class="empty-label"></div>
      </div>

      <div class="profile-right">
        <input id="username" type="text" name="username" value="{{ old('username', Auth::user()->username) }}" class="input-field">
        <input id="mail" type="email" name="mail" value="{{ old('mail', Auth::user()->mail) }}" class="input-field">
        <input id="password" type="password" name="password" class="input-field">
        <input id="password_confirmation" type="password" name="password_confirmation" class="input-field">
        <textarea id="profile" name="profile" rows="4" class="input-field">{{ old('profile', Auth::user()->bio) }}</textarea>
        <input id="image" type="file" name="image" class="input-field">
        <button type="submit" class="submit-button">更新</button>
      </div>
    </div>
  </form>
</x-login-layout>
