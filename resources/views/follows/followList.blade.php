<x-login-layout>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  {{-- フォロー中のユーザーアイコン --}}
  <div class="follow-icons">
    <h2>フォローリスト</h2>
    <div class="icon-list">
      @foreach($followingUsers as $user)
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <img src="{{ $user->image
            ? asset('images/' . $user->image)
            : asset('images/default_icon.png') }}"
            alt="{{ $user->username }}のアイコン"
            class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
        </a>
      @endforeach
    </div>
  </div>

  {{-- 投稿一覧 --}}
  @if($posts->count() > 0)
    <ul>
      @foreach($posts as $post)
        <li class="post-item">
          <a href="{{ route('user.profile', ['id' => $post->user->id]) }}">
          <img src="{{ $post->user->image
          ? asset('images/' . $post->user->image)
          : asset('images/default_icon.png') }}"
          class="rounded-circle"
          style="width: 40px; height: 40px; object-fit: cover;">
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
    <p class="no-posts">フォロー中のユーザーの投稿はありません。</p>
  @endif
</x-login-layout>
