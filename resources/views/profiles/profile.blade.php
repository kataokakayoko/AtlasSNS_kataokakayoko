<x-login-layout>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="profile-container">

      <div class="profile-left">
        <div class="profile-image-wrapper">
          @if(Auth::user()->icon_image)
          <img src="{{ asset('storage/images/' . basename(Auth::user()->icon_image)) }}" alt="ユーザーアイコン" style="width: 40px; height: 40px;  margin-left: 300px;" />
          @else
            <div class="icon-placeholder"></div>
          @endif
        </div>
      </div>

      <div class="profile-right">
        <!-- ユーザー名 -->
        <div class="form-row icon-username-row">
          <label for="username" class="label-text">ユーザー名</label>
          <input id="username" type="text" name="username" value="{{ old('username', Auth::user()->username) }}" class="input-field">
          @error('username')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- メールアドレス -->
        <div class="form-row">
          <label for="email" class="label-text">メールアドレス</label>
          <input id="email" type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="input-field">
          @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- パスワード -->
        <div class="form-row">
        <label for="password" class="label-text">パスワード</label>
        <input id="password" type="password" name="password" class="input-field" required>
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </div>

        <!-- パスワード確認 -->
        <div class="form-row">
        <label for="password_confirmation" class="label-text">パスワード確認</label>
        <input id="password_confirmation" type="password" name="password_confirmation" class="input-field" required>
        @error('password_confirmation')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </div>



        <!-- 自己紹介 -->
        <div class="form-row textarea-row">
          <label for="profile" class="label-text">自己紹介</label>
          <textarea id="profile" name="profile" rows="4" class="input-field">{{ old('profile', Auth::user()->bio) }}</textarea>
          @error('profile')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- アイコン画像 -->
        <div class="form-row">
          <label for="icon_image" class="label-text">アイコン画像</label>
          <div class="icon-upload-box">
            <label for="icon_image" class="custom-file-label">ファイルを選択</label>
            <input id="icon_image" type="file" name="icon_image" class="file-input">
          </div>
          @error('icon_image')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- 更新ボタン -->
        <div class="form-row button-row">
          <button type="submit" class="btn btn-danger center-button">更新</button>
        </div>
      </div>

    </div>
  </form>
</x-login-layout>
