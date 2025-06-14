<header id="head">
  <div id="logo">
    <a href="{{ route('top') }}">
      <img src="{{ asset('images/atlas.png') }}" style="height: 40px;">
    </a>
  </div>

  @auth
  <div id="user-menu">
    <div class="user-info" id="menuToggle">
      <span class="username">{{ Auth::user()->username }} さん</span>
      <span class="arrow"></span>
      <img src="{{ asset('images/' . Auth::user()->image) }}" alt="アイコン" class="user-icon">
    </div>

    <!-- アコーディオンメニュー -->
  <nav class="menu">
    <ul>
      <li><a href="{{ route('top') }}">HOME</a></li>
      <li><a href="{{ route('profile') }}">プロフィール編集</a></li>
      <li>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit">ログアウト</button>
        </form>
      </li>
    </ul>
  </nav>
</div>

  @endauth
</header>
