<x-login-layout>
<div id="main-content" style="display: flex;">
<div class="main-content" style="flex: 1;">

  <div class="post-form-container">
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="post-form">
      @csrf
      <div class="user-icon">
      <img src="{{ asset('images/' . Auth::user()->avatar) }}" alt="ユーザーアイコン" />

      </div>
      <textarea name="content" placeholder="投稿内容を入力してください。" class="post-input" required></textarea>
      <button type="submit" class="post-btn">
        <img src="{{ asset('images/post.png') }}" alt="投稿" />
      </button>
    </form>
  </div>

  <div class="post-list">
  @forelse ($posts as $post)
  <div class="post-item">
  <div class="post-header d-flex align-items-center mb-2">
    <div class="user-icon">
    <img src="{{ asset('images/' . ($post->user->avatar ?? 'default_icon.png')) }}" alt="{{ $post->user->username }}のアイコン" class="w-8 h-8 rounded-full" />
    </div>
    <div class="post-username">{{ $post->user->username }}</div>
    <div class="post-date ms-auto text-muted" style="font-size: 0.8em;">{{ $post->created_at->format('Y-m-d H:i') }}</div>
  </div>
  <div class="post-content">{{ $post->content }}</div>

  @if ($post->user_id === auth()->id())
    <div class="post-action-buttons d-flex align-items-center gap-2 mt-2">
      <button type="button" class="edit-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $post->id }}">
        <img src="{{ asset('images/edit.png') }}" alt="編集" />
      </button>
      <button type="button" class="delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">
        <img src="{{ asset('images/trash.png') }}" alt="削除" />
      </button>
    </div>
</div>


  <!-- 編集モーダル -->
  @if ($post->user_id === auth()->id())
      <div class="modal fade" id="editModal{{ $post->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $post->id }}" aria-hidden="true">
        <div class="modal-dialog">
          <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $post->id }}">投稿を編集</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
              </div>
              <div class="modal-body">
                <textarea name="content" required minlength="1" maxlength="150">{{ $post->content }}</textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                <button type="submit" class="btn btn-primary">保存
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
  @endforelse
</div>

  <!-- 削除確認モーダル -->
  <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel{{ $post->id }}">投稿の削除確認</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
        </div>
        <div class="modal-body">
          この投稿を削除します。よろしいですか？
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
          <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">OK</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endif
  @empty
    <p>投稿がありません。</p>
  @endforelse
</div>
</x-login-layout>
