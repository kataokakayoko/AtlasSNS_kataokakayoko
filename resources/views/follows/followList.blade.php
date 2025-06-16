<x-login-layout>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  {{-- フォロー中のユーザーアイコン --}}
  <div class="follow-icons">
    <h2>フォローリスト</h2>
    <div class="icon-list">
      @foreach($followingUsers as $user)
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <img src="{{ $user->icon_image
            ? asset('images/' . $user->icon_image)
            : asset('images/default_icon.png') }}"
            alt="{{ $user->username }}のアイコン"
            class="rounded-circle"
            style="width: 40px; height: 40px; object-fit: cover;">
        </a>
      @endforeach
    </div>
  </div>

  {{-- 投稿一覧 --}}
  @if($posts->count() > 0)
    <ul class="post-list">
      @foreach($posts as $post)
        @if($post->user)
          <li class="post-item">
            <div class="post-header d-flex justify-content-between align-items-start mb-2">
              <div class="d-flex align-items-start gap-2">
                <a href="{{ route('user.profile', ['id' => $post->user->id]) }}" class="user-link d-flex align-items-center gap-2" style="text-decoration: none; color: inherit;">
                  <div class="user-icon list-user-icon">
                    <img src="{{ asset('images/' . ($post->user->icon_image ?? 'default_icon.png')) }}" alt="{{ $post->user->username }}のアイコン" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" />
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

            @auth
              @if ($post->user_id == auth()->user()->id)
                <div class="post-action-buttons">
                  <button type="button" class="edit-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $post->id }}">
                    <img src="{{ asset('images/edit.png') }}" alt="編集" />
                  </button>
                  <button type="button" class="delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">
                    <img src="{{ asset('images/trash.png') }}" alt="削除" />
                  </button>
                </div>
              @endif
            @endauth
          </li>
        @endif
      @endforeach
    </ul>
  @else
    <p class="no-posts">フォロー中のユーザーの投稿はありません。</p>
  @endif

</x-login-layout>
