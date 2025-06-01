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
          <div class="d-flex align-items-center mb-2">
          <p class="mb-0 me-2 label-fixed-width">フォロー数</p><p class="mb-0">{{ $followCount ?? '0' }}人</p>
          </div>
          <div class="text-end">
          <a href="{{ route('follows.list') }}" class="btn btn-primary btn-sm sidebar-btn">フォローリスト</a>
          </div>

          <div>
          <div class="d-flex align-items-center mb-2">
          <p class="mb-0 me-2 label-fixed-width">フォロワー数</p><p class="mb-0">{{ $followerCount ?? '0' }}人</p>
          </div>
          <div class="text-end">
          <a href="{{ route('followers.list') }}" class="btn btn-primary btn-sm sidebar-btn">フォロワーリスト</a>
          </div>

          <div class="text-center mt-2">
          <hr>
          <a href="{{ route('users.search') }}" class="btn btn-primary btn-sm sidebar-btn">ユーザー検索</a>
          </div>

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
