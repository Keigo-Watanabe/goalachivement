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
      <header class="lp-header lp-header-bg lp-header-register">
        <div class="header-logo">
          <a href="/"><span id="logo" class="logo">Goal<span class="logo-achivement">Achivement.</span></span></a>
        </div>
      </header>

        <div class="font-sans text-gray-900 antialiased">
          <div class="register-container">
            <div class="register-container-bg">
              {{ $slot }}
            </div>
          </div>
        </div>

        <!-- フッター -->
        <footer class="lp-footer">
          <div class="footer-logo">
            <a href=""><span class="logo">Goal<span class="logo-achivement">Achivement.</span></span></a>
          </div>

          <div class="copyright">
            <span>©️Goal Achievement 2021</span>
          </div>
        </footer>
    </body>
</html>
