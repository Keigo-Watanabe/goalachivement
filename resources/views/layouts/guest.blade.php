<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
      <!-- ヘッダー -->
      <header id="lp-header" class="lp-header">
        <div class="header-inner">
          <div class="header-logo">
            <span class="goalachivement">Goal<span class="logo-achivement">Achivement.</span></span>
          </div>

          <nav id="header-nav" class="header-nav">
            <ul>
              <li class="nav-li"><a href="/">ホーム</a></li>
              <li class="nav-li"><a href="#app-management">アプリの使い方</a></li>
              <li class="nav-li"><a href="#app-feature">機能</a></li>
              <li class="nav-li"><a href="/lp/contact">お問い合わせ</a></li>
              <li class="header-register"><a href="{{ route('register') }}">会員登録</a></li>
              <li class="header-login"><a href="{{ route('login') }}">ログイン</a></li>
            </ul>
          </nav>

          <div id="header-nav-btn" class="header-nav-btn">
            <div class="bars">
              <span class="bar bar1"></span>
              <span class="bar bar2"></span>
              <span class="bar bar3"></span>
            </div>
          </div>
        </div>
      </header>

      <main>
        <!-- コンポーネント -->
        {{ $slot }}
      </main>

      <!-- フッター -->
      <footer class="lp-footer">
        <div class="footer-logo">
          <span class="goalachivement">Goal<span class="logo-achivement">Achivement.</span></span>
        </div>

        <div class="copyright">
          <span>©️ Copyright GoalAchivement All right reserved.</span>
        </div>
      </footer>

      <script src="/js/jquery-3.5.1.min.js"></script>
      <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
