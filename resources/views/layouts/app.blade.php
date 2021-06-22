<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>目標達成 - GoalAchivement -</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('image/favicon.ico') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/d60d03627c.js" crossorigin="anonymous"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow profile-header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Responsive Bottom Navigation -->
            <div class="responsive-bottom-navigation">
              <nav class="responsive-bottom-navigation-inner">
                <ul>
                  <li><a href="/goal/create"><i class="fas fa-flag"></i>目標</a></li>
                  <li><a href="/task/create"><i class="fas fa-tasks"></i>タスク</a></li>
                  <li><a href="/schedule"><i class="fas fa-calendar-alt"></i>予定</a></li>
                  <li><a href="/way"><i class="fas fa-mobile"></i>使い方</a></li>
                  <li><a href="{{ route('profile.show') }}"><i class="fas fa-user-circle"></i>プロフィール</a></li>
                </ul>
              </nav>
            </div>
        </div>

        <footer class="dashboard-footer">
          <div class="copyright">
            <span>©️Goal Achievement 2021</span>
          </div>
        </footer>

        @stack('modals')

        @livewireScripts

        <script src="{{ asset('js/mypage.js') }}"></script>
    </body>
</html>
