<x-logout-layout>
  <div class="login-container">
    <p class="welcome-username">{{ $username }}さん</p>
    <p class="welcome-username">ようこそ！AtlasSNSへ！</p>
    <p class="welcome-message">ユーザー登録が完了しました。</p>
    <p class="welcome-message">早速ログインをしてみましょう。</p>

    <p class="btn">
      <a href="{{ route('login') }}" class="login-btn">ログイン画面へ</a>
    </p>
  </div>
</x-logout-layout>
