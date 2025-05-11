        <div id="head">
            <h1><a><img src="images/atlas.png"></a></h1>
            <div id="">
            @auth
                <div id="">
                    <p>{{ Auth::user()->username }}さん</p>
                </div>
                <ul>
                    <li><a href="{{ route('top') }}">ホーム</a></li>
                    @if (Route::has('profile'))
                    <li><a href="{{ route('profile') }}">プロフィール</a></li>
                    @endif
                    <li><form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none;border:none;padding:0;color:#00f;cursor:pointer;">ログアウト</button></form>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
