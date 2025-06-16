<x-login-layout>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  {{-- フォロワーのアイコン一覧 --}}
  @if($followers->count() > 0)
    <div class="follow-icons">
      <h2>フォロワーリスト</h2>
      <div class="icon-list">
        @foreach($followers as $user)
          <a href="{{ route('user.profile', ['id' => $user->id]) }}">
            <img src="{{ asset('images/' . ($user->icon_image ?? 'default_icon.png')) }}"
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
    <p class="no-posts">フォロワーの投稿はありません。</p>
  @endif

</x-login-layout>
