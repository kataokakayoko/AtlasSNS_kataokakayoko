<x-login-layout>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  {{-- フォロワーのアイコン一覧 --}}
  @if($followers->count() > 0)
    <div class="follow-icons">
      <h2>フォロワーリスト</h2>
      <div class="icon-list">
        @foreach($followers as $user)
          <a href="{{ route('user.profile', ['id' => $user->id]) }}">
            <img src="{{ asset('images/' . ($user->image ?? 'default_icon.png')) }}"
                 alt="{{ $user->username }}"
                 class="rounded-circle"
                 style="width: 40px; height: 40px; object-fit: cover;">
          </a>
        @endforeach
      </div>
    </div>
  @else
    <p class="no-posts">フォロワーはいません。</p>
  @endif

  {{-- フォロワーの投稿一覧 --}}
  @if($posts->count() > 0)
  <ul class="post-list">
    @foreach ($posts as $post)
      @if($post->user) {{-- ユーザー情報が存在するか確認 --}}
        <li class="post-item">
          <a href="{{ route('user.profile', ['id' => $post->user->id]) }}">
            <img src="{{ asset('images/' . ($post->user->image ?? 'default_icon.png')) }}"
                 alt="{{ $post->user->username }}"
                 class="rounded-circle"
                 style="width: 40px; height: 40px; object-fit: cover;">
          </a>
          <div class="post-username">
            <a href="{{ route('user.profile', ['id' => $post->user->id]) }}">
              {{ $post->user->username }}
            </a>
          </div>
          <div class="post-text">{{ $post->post }}</div>
          <div class="post-date">{{ $post->created_at->format('Y年m月d日 H:i') }}</div>
        </li>
      @endif
    @endforeach
  </ul>
@else
  <p class="no-posts">フォロワーの投稿はありません。</p>
@endif

</x-login-layout>
