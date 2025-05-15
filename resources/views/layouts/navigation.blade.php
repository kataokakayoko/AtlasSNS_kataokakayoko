<div id="head">
    <div id="logo">
        <a href="{{ route('top') }}">
            <img src="{{ asset('images/atlas.png') }}" alt="Atlas SNS ロゴ">
        </a>
    </div>

    @auth
        <div id="user-menu">
            <div class="user-info">
                <p class="username">{{ Auth::user()->username }}さん</p>
                <img src="{{ asset('images/icon1.png') }}" alt="User Image" class="user-image">
            </div>

            <!-- アコーディオンメニューを開くボタン -->
            <button type="button" class="menu-btn">
                <span class="inn"></span>
            </button>

            <!-- アコーディオンメニュー -->
            <nav class="menu">
                <ul>
                <li><a href="">HOME</a></li>
                <li><a href="">プロフィール編集</a></li>
                <li><a href="">ログアウト</a></li>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    @endauth
</div>
