<x-login-layout>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <div class="profile-box">
    {{-- アイコン --}}
    <div class="profile-icon">
      <img src="{{ asset('images/' . ($user->image ?? 'default_icon.png')) }}"
           alt="{{ $user->username }}" class="user-icon">
    </div>

    {{-- ユーザー情報（2列構成） --}}
    <div class="profile-info">
      <div class="profile-row">
        <div class="profile-label">ユーザー名</div>
        <div class="profile-value">{{ $user->username }}</div>
      </div>

      <div class="profile-row">
        <div class="profile-label">自己紹介</div>
        <div class="profile-value" style="display: flex; align-items: center;">
          @if (!empty($user->bio))
            <span>{{ $user->bio }}</span>
          @else
            <span>自己紹介文が未設定です。</span>
          @endif

          {{-- フォローボタン --}}
          <form method="POST" action="{{ $isFollowing ? route('users.unfollow', ['user' => $user->id]) : route('users.follow', ['user' => $user->id]) }}" style="margin-left: 10px;">
            @csrf
            <button type="submit" style="background-color: {{ $isFollowing ? 'red' : 'skyblue' }}; color: white; border: none; padding: 5px 10px;">
              {{ $isFollowing ? 'フォロー解除' : 'フォローする' }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- 投稿一覧 --}}
  @if($posts->count() > 0)
    <ul class="post-list">
      @foreach ($posts as $post)
        <li class="post-item">
          <a href="{{ route('user.profile', ['id' => $post->user->id]) }}">
            <img src="{{ asset('images/' . ($post->user->image ?? 'default_icon.png')) }}"
                 alt="{{ $post->user->username }}" class="user-icon">
          </a>
          <div class="post-content">
            <div class="post-username">
              <a href="{{ route('user.profile', ['id' => $post->user->id]) }}">
                {{ $post->user->username }}
              </a>
            </div>
            <div class="post-text">{{ $post->post }}</div>
            <div class="post-date">{{ $post->created_at->format('Y年m月d日 H:i') }}</div>
          </div>
        </li>
      @endforeach
    </ul>
  @else
    <p class="no-posts">{{ $user->username }}さんの投稿はありません。</p>
  @endif

</x-login-layout>
