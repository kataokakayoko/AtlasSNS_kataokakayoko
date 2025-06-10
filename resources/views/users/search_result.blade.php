<x-login-layout>
  <div class="container">

    <div class="d-flex align-items-center mb-3 gap-2">
      <!-- 検索フォーム -->
      <form action="{{ route('users.search_result') }}" method="GET" class="d-flex align-items-center gap-2" style="flex-shrink: 0;">
        <input type="text" name="keyword" placeholder="ユーザー名"
               value="{{ old('keyword', $keyword ?? '') }}"
               class="form-control" style="width: 200px;">
        <button type="submit" style="border: none; background: none; padding: 0;">
          <img src="{{ asset('images/search.png') }}" alt="検索" style="width: 35px; height: 35px;">
        </button>
      </form>

      <!-- 検索ワード表示 -->
      @if(isset($keyword) && $keyword !== '')
        <div class="search-keyword" style="white-space: nowrap;">
          検索ワード: <strong>{{ $keyword }}</strong>
        </div>
      @endif
    </div>

    <!-- 検索結果リスト -->
    @if(isset($users) && $users->count())
      <ul class="list-group">
        @foreach($users as $user)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
              <img src="{{ asset('images/' . ($user->image ?? 'default_icon.png')) }}" alt="{{ $user->username }}のアイコン" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
              <span>{{ $user->username }}</span>
            </div>

            @if(auth()->user()->followings->contains($user->id))
               <!-- フォロー解除ボタン（赤） -->
               <form action="{{ route('users.unfollow', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="background-color:red; color:white; border:none; padding:5px 10px;">
                                フォロー解除
                            </button>
                        </form>
                    @else
                        <!-- フォローボタン（水色） -->
                        <form action="{{ route('users.follow', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="background-color:skyblue; color:white; border:none; padding:5px 10px;">
                                フォローする
                            </button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
        <div class="mt-3">
            {{ $users->appends(['keyword' => $keyword])->links() }}
        </div>
    @else
        <p>該当するユーザーが見つかりません。</p>
    @endif
</div>
</x-login-layout>
