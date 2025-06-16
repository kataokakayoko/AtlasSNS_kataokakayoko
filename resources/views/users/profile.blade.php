<x-login-layout>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="profile-header" style="background-color: #fff; width: 100vw; padding: 20px 0; border-bottom: 5px solid #ccc;">

{{-- アイコン --}}
<div class="profile-icon">
  <img src="{{ asset('images/' . ($user->icon_image ?? 'default_icon.png')) }}"
       alt="{{ $user->username }}" class="user-icon">
</div>

{{-- ユーザー情報 --}}
<div class="profile-info">
  <div class="profile-row">
    <div class="profile-label">ユーザー名</div>
    <div class="profile-value">{{ $user->username }}</div>
  </div>

  <div class="profile-row">
    <div class="profile-label">自己紹介</div>
    <div class="profile-value" style="display: flex; align-items: center; justify-content: space-between;">
   @if (!empty($user->bio))
     <span style="flex-shrink: 1; max-width: 70%;">{{ $user->bio }}</span>
   @else
      <span style="flex-shrink: 1; max-width: 70%;">自己紹介文が未設定です。</span>
    @endif

      {{-- フォローボタン --}}
      <form method="POST"
      action="{{ $isFollowing ? route('users.unfollow', ['user' => $user->id]) : route('users.follow', ['user' => $user->id]) }}">
  @csrf
  <button type="submit"
          style="background-color: {{ $isFollowing ? 'red' : 'skyblue' }};
                 color: white; border: none; padding: 5px 10px; margin-left: 700px;">
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
    @if($post->user)
      <li class="post-item">
        <div class="post-header d-flex justify-content-between align-items-start mb-2">
          <div class="d-flex align-items-start gap-2">
            <a href="{{ route('user.profile', ['id' => $post->user->id]) }}" class="user-link d-flex align-items-center gap-2" style="text-decoration: none; color: inherit;">
              <div class="user-icon list-user-icon">
                <img src="{{ asset('images/' . ($post->user->icon_image ?? 'default_icon.png')) }}"
                     alt="{{ $post->user->username }}のアイコン"
                     style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" />
              </div>
              <div class="post-info">
                <div class="post-username fw-bold">{{ $post->user->username }}</div>
              </div>
            </a>
          </div>
          <div class="post-date">
            {{ $post->created_at->format('Y-m-d H:i') }}
          </div>
        </div>
        <div class="post-post">{{ $post->post }}</div>
      </li>
    @endif
  @endforeach
</ul>
@else
<p class="no-posts">{{ $user->username ?? 'ユーザー' }}さんの投稿はありません。</p>
@endif

</x-login-layout>
