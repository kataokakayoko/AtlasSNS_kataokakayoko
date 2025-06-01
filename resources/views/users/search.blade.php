<x-login-layout>
<div class="container">

    <!-- 検索フォーム -->
    <form action="{{ route('users.search') }}" method="GET" class="d-flex mb-3">
    <input type="text" name="keyword" placeholder="ユーザー名"
           value="{{ old('keyword', $keyword ?? '') }}"
           class="form-control me-2">
    <button type="submit" style="border: none; background: none; padding: 0;">
        <img src="{{ asset('images/search.png') }}" alt="検索" style="width: 35px; height: 35px;">
    </button>
</form>


    <!-- 検索結果リスト -->
    @if(isset($users) && $users->count())
    <ul class="list-group">
      @foreach($users as $user)
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('images/' . ($user->avatar ?? 'default_icon.png')) }}" alt="{{ $user->username }}のアイコン" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
            <span>{{ $user->username }}</span>
          </div>

          @if(auth()->user()->following->contains($user->id))
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
