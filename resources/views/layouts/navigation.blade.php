<nav x-data="{ open: false }" class="bg-gray-900 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            {{-- Logo + linki --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('players.index') }}" class="flex items-center gap-2">
                    <span class="text-2xl">⚽</span>
                    <span class="text-xl font-bold tracking-wide">FutRank</span>
                </a>

                <div class="hidden sm:flex gap-6 ms-10 text-sm">
                    <a href="{{ route('players.index') }}"
                       class="{{ request()->routeIs('players.index') ? 'text-green-400 font-semibold' : 'hover:text-green-300' }} transition">
                        📋 Lista zawodników
                    </a>

                    <a href="{{ route('players.ranking') }}"
                       class="{{ request()->routeIs('players.ranking') ? 'text-green-400 font-semibold' : 'hover:text-green-300' }} transition">
                        🏆 Ranking
                    </a>

                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="{{ request()->routeIs('dashboard') ? 'text-green-400 font-semibold' : 'hover:text-green-300' }} transition">
                            📊 Dashboard
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Dropdown: użytkownik / logowanie --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md bg-gray-800 hover:bg-gray-700 transition">
                                <div>{{ Auth::user()->name }}</div>
                                <svg class="ml-2 -mr-0.5 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.354a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                👤 Profil
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    🚪 Wyloguj się
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm hover:text-green-300 font-medium me-4">🔐 Zaloguj się</a>
                    <a href="{{ route('register') }}" class="text-sm hover:text-green-300 font-medium">📝 Rejestracja</a>
                @endauth
            </div>

            {{-- Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="p-2 rounded-md text-gray-300 hover:text-white hover:bg-gray-800 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-800 text-white">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('players.index')" :active="request()->routeIs('players.index')">
                📋 Lista zawodników
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('players.ranking')" :active="request()->routeIs('players.ranking')">
                🏆 Ranking
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    📊 Dashboard
                </x-responsive-nav-link>
            @endauth
        </div>

        <div class="pt-4 pb-1 border-t border-gray-600 px-4">
            @auth
                <div class="font-medium text-base">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        👤 Profil
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            🚪 Wyloguj się
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-2 space-y-2">
                    <a href="{{ route('login') }}" class="block hover:text-green-300">🔐 Zaloguj się</a>
                    <a href="{{ route('register') }}" class="block hover:text-green-300">📝 Rejestracja</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
