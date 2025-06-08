<x-logout-layout>
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

 {{-- ログインフォーム --}}
 {!! Form::open(['route' => 'login']) !!}

 <p class="login-title">AtlasSNSへようこそ</p>

 <div class="input-group">
 {{ Form::label('mail', 'メールアドレス') }}
 {{ Form::text('mail', null, ['class' => 'input']) }}
 </div>

 <div class="input-group">
 {{ Form::label('password', 'パスワード') }}
 {{ Form::password('password', ['class' => 'input']) }}
 </div>

 <div class="button-wrapper">
 {{ Form::submit('ログイン', ['class' => 'login-btn']) }}
 </div>

 <p><a href="{{ route('register') }}" class="register-link">新規ユーザーの方はこちら</a></p>

 {!! Form::close() !!}
 </div>
</x-logout-layout>
