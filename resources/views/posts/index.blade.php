<x-login-layout>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div id="main-post" style="display: flex;">

  <!-- 投稿エリア -->
  <div class="main-post" style="flex: 1;">
    <div class="post-form-container">
      <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="post-form">
        @csrf
        <div class="user-icon post-user-icon">
        <img src="{{ asset('images/' . Auth::user()->image) }}" alt="ユーザーアイコン" />
        </div>
        <textarea name="post" placeholder="投稿内容を入力してください。" class="post-input" required></textarea>
        <button type="submit" class="post-btn">
          <img src="{{ asset('images/post.png') }}" alt="投稿" />
        </button>
      </form>
    </div>

  <!-- リストエリア -->
    <div class="post-list">
  @forelse ($posts as $post)
    <div class="post-item">
      <div class="post-header d-flex justify-content-between align-items-start mb-2">
        <div class="d-flex align-items-start gap-2">
        <div class="user-icon list-user-icon">
          <img src="{{ asset('images/' . ($post->user->image ?? 'default_icon.png')) }}" alt="{{ $post->user->username }}のアイコン" />
          </div>
          <div class="post-info">
            <div class="post-username fw-bold">{{ $post->user->username }}</div>
          </div>
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

          <!-- 編集モーダル -->
          <div class="modal fade" id="editModal{{ $post->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $post->id }}" aria-hidden="true">
          <div class="modal-dialog" style=" position: fixed; top: 40%; left: 50%; transform: translate(-50%, -50%); width: 1000px; max-width: 95%; z-index: 1050;">
          <div class="modal-content">
          <form action="{{ route('posts.update', $post) }}" method="POST">
          @csrf
           @method('PUT')
          <div class="modal-body text-center py-4">
          <textarea name="post" required minlength="1" maxlength="150" class="form-control mb-4" style="min-height: 200px; font-size: 1.2rem;">{{ trim($post->post) }}</textarea>

          <!-- 編集ボタン画像 -->
          <button type="submit" class="border-0 bg-transparent p-0">
            <img
              src="{{ asset('images/edit.png') }}"
              alt="編集ボタン"
              style="width: 60px; height: auto;"
              onmouseover="this.src='{{ asset('images/edit_h.png') }}';"
              onmouseout="this.src='{{ asset('images/edit.png') }}';"
            />
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>


          <!-- 削除モーダル -->
          <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $post->id }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                  </div>
                  <div class="modal-body">
                    この投稿を削除します。よろしいですか？
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-fixed-size">OK</button>
                  <button type="button" class="btn btn-cancel btn-fixed-size" data-bs-dismiss="modal">キャンセル</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        @endif
      @endauth
    </div>
  @empty
    <p>投稿がありません。</p>
  @endforelse
</div>

</x-login-layout>
