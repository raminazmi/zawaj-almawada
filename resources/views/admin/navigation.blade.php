<nav x-data="{ open: false }" class="bg-pink-100 border-b border-pink-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0">
                    <a href="{{ route('index') }}" class="hover:opacity-90 transition-opacity flex items-center">
                        <img src="/assets/images/logo.png" class="w-22 h-16" alt="logo">
                        <span class="text-2xl font-bold text-purple-900 ml-4 font-serif">زواج المودة</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex gap-4">
                    <x-nav-link :href="route('admin.questions.index')"
                        :active="request()->routeIs('admin.questions.index')" class="text-lg transition-colors">
                        الأسئلة
                    </x-nav-link>
                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')"
                        class="text-lg transition-colors">
                        الأعضاء
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-full text-gray-900 bg-pink-50 hover:bg-pink-200 focus:outline-none transition-all duration-300">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-2">
                                <i class="fas fa-chevron-down text-sm"></i>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-gray-900 hover:bg-pink-50 transition-colors">
                                <i class="fas fa-sign-out-alt ml-2"></i>
                                تسجيل الخروج
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-lg text-gray-900 hover:text-purple-700 hover:bg-pink-200 focus:outline-none transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.questions.index')"
                    :active="request()->routeIs('admin.questions.index')">
                    الأسئلة
                </x-responsive-nav-link>
            </div>

            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.users.index')"
                    :active="request()->routeIs('admin.users.index')">
                    الأعضاء
                </x-responsive-nav-link>
            </div>

        </div>

        <div class="pt-4 pb-1 border-t border-pink-200">
            <div class="px-4">
                <div class="font-medium text-base text-purple-900">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-purple-600">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-gray-900 hover:bg-pink-200 transition-colors">
                        <i class="fas fa-sign-out-alt ml-2"></i>
                        تسجيل الخروج
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>