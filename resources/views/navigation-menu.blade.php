<nav x-data="{ open: false }" id="my-page-header" class="my-page-header">
    <!-- Primary Navigation Menu -->
    <div class="">
        <div class="my-page-header-inner">
            <div class="my-page-header-logo">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <span id="logo" class="my-page-logo">Goal<span class="logo-achivement">Achivement.</span></span>
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex my-page-user">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex">
                                    <button type="button" class="user-btn inline-flex leading-4 focus:outline-none transition">
                                        <i class="fas fa-user-circle"></i>{{ Auth::user()->name }}
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" id="hamburger-btn" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 focus:outline-none focus:text-gray-500 transition">
                    <i class="fas fa-bars hamburger-btn"></i>
                </button>
            </div>

            <!-- ホーム -->
            <div class="my-page-home my-page-pc">
              <a href="/dashboard"><i class="fas fa-home"></i>ホーム</a>
            </div>

            <!-- ナビゲーション -->
            <nav class="my-page-nav my-page-pc">
              <ul>
                <li>
                  <a href="/goal/create"><i class="fas fa-flag"></i>目標</a>
                </li>
                <li>
                  <a id="task-btn" class="task-btn"><i class="fas fa-tasks"></i>タスク</a>
                  <ul id="task-nav-menu" class="task-nav-menu">
                    <li><a href="/task">タスク一覧</a></li>
                    <li><a href="/task/create">タスク追加</a></li>
                    <li><a href="/task_category">カテゴリー設定</a></li>
                  </ul>
                </li>
                <li>
                  <a id="schedule-btn" class="schedule-btn"><i class="fas fa-calendar-alt"></i>予定</a>
                  <ul id="schedule-nav-menu" class="schedule-nav-menu">
                    <li><a href="/schedulesammary">予定一覧</a></li>
                    <li><a href="/schedule">予定追加</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden responsive-nav-menu">

      <!-- Responsive Settings Options -->
      <div class="pt-4 pb-1 border-t border-gray-200">
          <div class="flex items-center px-4">
              @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                  <div class="flex-shrink-0 mr-3">
                      <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                  </div>
              @endif

              <div>
                  <div class="font-medium text-base profile-link-btn">{{ Auth::user()->name }}</div>
              </div>
          </div>

          <div class="mt-3 space-y-1">
              <!-- Account Management -->
              <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                  {{ __('Profile') }}
              </x-jet-responsive-nav-link>

              @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                  <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                      {{ __('API Tokens') }}
                  </x-jet-responsive-nav-link>
              @endif

              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}">
                  @csrf

                  <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                  this.closest('form').submit();">
                      {{ __('Logout') }}
                  </x-jet-responsive-nav-link>
              </form>

              <!-- Team Management -->
              @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                  <div class="border-t border-gray-200"></div>

                  <div class="block px-4 py-2 text-xs text-gray-400">
                      {{ __('Manage Team') }}
                  </div>

                  <!-- Team Settings -->
                  <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                      {{ __('Team Settings') }}
                  </x-jet-responsive-nav-link>

                  @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                      <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                          {{ __('Create New Team') }}
                      </x-jet-responsive-nav-link>
                  @endcan

                  <div class="border-t border-gray-200"></div>

                  <!-- Team Switcher -->
                  <div class="block px-4 py-2 text-xs text-gray-400">
                      {{ __('Switch Teams') }}
                  </div>

                  @foreach (Auth::user()->allTeams() as $team)
                      <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                  @endforeach
              @endif
          </div>
      </div>

      <!-- ホーム -->
      <div class="my-page-home my-page-sp">
        <a href="/dashboard"><i class="fas fa-home"></i>ホーム</a>
      </div>

      <!-- ナビゲーション -->
      <nav class="my-page-nav my-page-sp">
        <ul>
          <li>
            <a href="/goal/create"><i class="fas fa-flag"></i>目標</a>
          </li>
          <li>
            <a id="task-btn" class="task-btn"><i class="fas fa-tasks"></i>タスク</a>
            <ul id="task-nav-menu" class="task-nav-menu task-nav-menu-show">
              <li><a href="/task">タスク一覧</a></li>
              <li><a href="/task/create">タスク追加</a></li>
              <li><a href="/task_category">カテゴリー設定</a></li>
            </ul>
          </li>
          <li>
            <a id="schedule-btn" class="schedule-btn"><i class="fas fa-calendar-alt"></i>予定</a>
            <ul id="schedule-nav-menu" class="schedule-nav-menu schedule-nav-menu-show">
              <li><a href="/schedulesammary">予定一覧</a></li>
              <li><a href="/schedule">予定追加</a></li>
            </ul>
          </li>
        </ul>
      </nav>

    </div>
</nav>
