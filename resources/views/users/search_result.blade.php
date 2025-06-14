<x-login-layout>
  <div class="container-fluid" style="background-color: #fff; padding: 20px;">
    <div class="container">

      <!-- 検索フォーム -->
      <div class="d-flex align-items-center mb-3 gap-4 flex-column" style="width: 100%; margin-left: 100px;">

        <div class="d-flex align-items-center gap-4 w-100">
          <form action="{{ route('users.search_result') }}" method="GET"
                class="d-flex align-items-center gap-2"
                style="flex-shrink: 0;">
                <input
                  type="text"
                  name="keyword"
                  placeholder="ユーザー名"
                  value="{{ isset($keyword) && $keyword !== '' ? '' : old('keyword', $keyword ?? '') }}"
                  class="form-control"
                  style="width: 300px;"
                >
            <button type="submit" style="border: none; background: none; padding: 0;">
              <img src="{{ asset('images/search.png') }}" alt="検索" style="width: 35px; height: 35px;">
            </button>
          </form>

          @if(isset($keyword) && $keyword !== '')
            <div class="search-keyword" style="white-space: nowrap; margin-left: 100px;">
              検索ワード: {{ $keyword }}
            </div>
          @endif
        </div>

        <div class="full-width-divider"></div>
      </div>

      <!-- 検索結果リスト -->
      @if(isset($users) && $users->count())
        @php $authUser = Auth::user(); @endphp
        <ul class="list-group">
          @foreach($users as $user)
          @if ($user->id !== $authUser->id)
            <li class="custom-user-item">
              <div class="d-flex justify-content-between align-items-center">
                <div class="user-info d-flex align-items-center gap-2">
                  <div class="user-icon list-user-icon">
                    <img src="{{ asset('images/' . ($user->image ?? 'default_icon.png')) }}"
                         alt="{{ $user->username }}のアイコン"
                         style="width:40px; height:40px; object-fit:cover;" />
                  </div>
                  <div class="post-info">
                    <div class="post-username">{{ $user->username }}</div>
                  </div>
                </div>

                @if ($authUser->isFollowing($user))
                  <form action="{{ route('users.unfollow', $user->id) }}" method="POST" class="follow-btn-wrapper" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-unfollow btn-sm">
                      フォロー解除
                    </button>
                  </form>
                @else
                  <form action="{{ route('users.follow', $user->id) }}" method="POST" class="follow-btn-wrapper" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-follow btn-sm">
                      フォローする
                    </button>
                  </form>
                @endif
              </div>
            </li>
            @endif
          @endforeach
        </ul>
        <div class="mt-3">
          {{ $users->appends(['keyword' => $keyword])->links() }}
        </div>
      @else
        <p>該当するユーザーが見つかりません。</p>
      @endif

    </div>
  </div>
</x-login-layout>
