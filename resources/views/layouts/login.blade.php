<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title>Atlas SNS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  <!-- 共通のヘッダー -->
  <header class="bg-primary text-white p-3">
    @include('layouts.navigation')
  </header>

  <div id="main-content" class="d-flex">
    <!-- 投稿エリア -->
    <main id="container" class="flex-grow-1">
      {{ $slot }}
    </main>

    <!-- サイドバー -->
    <aside id="side-bar" class="bg-light p-3">
      <div id="confirm">
        <div class="profile-box mb-3">
          <p><strong>{{ Auth::user()->username }}さんの</strong></p>
          <div>
            <p>フォロー数</p>
            <p>{{ $followCount ?? '0' }}名</p>
          </div>
          <p class="btn btn-primary btn-sm"><a href="{{ route('follows.list') }}" class="text-white text-decoration-none">フォローリスト</a></p>
          <div>
            <p>フォロワー数</p>
            <p>{{ $followerCount ?? '0' }}名</p>
          </div>
          <p class="btn btn-primary btn-sm"><a href="{{ route('followers.list') }}" class="text-white text-decoration-none">フォロワーリスト</a></p>
        </div>
        <p class="btn btn-secondary btn-sm"><a href="{{ route('user.search') }}" class="text-white text-decoration-none">ユーザー検索</a></p>
      </div>
    </aside>
  </div>

  <footer class="mt-3 text-center text-muted small">
    &copy; 2025 AtlasSNS
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
