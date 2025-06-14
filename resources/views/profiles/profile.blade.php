<x-login-layout>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="profile-container">

      <div class="profile-left">
        <div class="profile-image-wrapper">
          @if(Auth::user()->image)
            <img src="{{ asset('images/' . Auth::user()->image) }}" alt="アイコン" class="icon-image">
          @else
            <div class="icon-placeholder"></div>
          @endif
        </div>
      </div>

      <div class="profile-right">
        <div class="form-row icon-username-row">
          <label for="username" class="label-text">ユーザー名</label>
          <input id="username" type="text" name="username" value="{{ old('username', Auth::user()->username) }}" class="input-field">
        </div>

        <div class="form-row">
          <label for="mail" class="label-text">メールアドレス</label>
          <input id="mail" type="email" name="mail" value="{{ old('mail', Auth::user()->mail) }}" class="input-field">
        </div>

        <div class="form-row">
          <label for="password" class="label-text">パスワード</label>
          <input id="password" type="password" name="password" class="input-field">
        </div>

        <div class="form-row">
          <label for="password_confirmation" class="label-text">パスワード確認</label>
          <input id="password_confirmation" type="password" name="password_confirmation" class="input-field">
        </div>

        <div class="form-row textarea-row">
          <label for="profile" class="label-text">自己紹介</label>
          <textarea id="profile" name="profile" rows="4" class="input-field">{{ old('profile', Auth::user()->bio) }}</textarea>
        </div>

        <div class="form-row">
          <label for="image" class="label-text">アイコン画像</label>
          <div class="icon-upload-box">
            <label for="image" class="custom-file-label">ファイルを選択</label>
            <input id="image" type="file" name="image" class="file-input">
          </div>
        </div>

        <div class="form-row button-row">
          <button type="submit" class="btn btn-danger center-button">更新</button>
        </div>
      </div>

    </div>
  </form>
</x-login-layout>
