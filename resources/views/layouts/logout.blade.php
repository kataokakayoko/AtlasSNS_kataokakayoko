<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!--IEブラウザ対策-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="ページの内容を表す文章" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title></title>

        <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/logout.css') }} ">
        <!--スマホ,タブレット対応-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
    <div class="wrapper">
    <header class="login-header">
      <a href="{{ route('top') }}">
        <img src="{{ asset('images/atlas.png') }}" alt="Atlasロゴ" class="logo-img" />
      </a>
      <p class="logo-subtitle">Social Network Service</p>
    </header>
        <div id="container">
            {{ $slot }}
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>
