<x-logout-layout>
    <!-- 適切なURLを入力してください -->
    <link rel="stylesheet" href="{{ asset('css/logout.css') }}">

    <div class="login-container">
        {{-- エラーメッセージ --}}
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color:red;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 新規登録フォーム --}}
        {!! Form::open(['url' => 'register', 'method' => 'post']) !!}
        @csrf

        <p class="login-title">新規ユーザー登録</p>

        <div class="input-group">
            {{ Form::label('username', 'ユーザー名') }}
            {{ Form::text('username', null, ['class' => 'input']) }}
        </div>

        <div class="input-group">
            {{ Form::label('mail', 'メールアドレス') }}
            {{ Form::mail('mail', null, ['class' => 'input']) }}
        </div>

        <div class="input-group">
            {{ Form::label('password', 'パスワード') }}
            {{ Form::password('password', ['class' => 'input']) }}
        </div>

        <div class="input-group">
            {{ Form::label('password_confirmation', 'パスワード確認') }}
            {{ Form::password('password_confirmation', ['class' => 'input']) }}
        </div>

        <div class="button-wrapper">
            {{ Form::submit('新規登録', ['class' => 'login-btn']) }}
        </div>

        <p><a href="{{ route('login') }}" class="register-link">ログイン画面へ戻る</a></p>

        {!! Form::close() !!}
    </div>
</x-logout-layout>
