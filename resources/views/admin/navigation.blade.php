<nav x-data="{ open: false }" class="bg-white shadow-lg">
    <div class="container mx-auto px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center">
                <a href="{{ route('index') }}" class="flex items-center hover:opacity-90 transition-opacity">
                    <img src="/assets/images/logo.png" class="h-16 w-16" alt="logo">
                    <span class="text-2xl font-bold text-[#553566] ml-4" style="font-family: 'Tajawal', sans-serif;">
                        زواج المودة
                    </span>
                </a>
                <div class="hidden sm:-my-px sm:ms-10 sm:flex gap-6">
                    <x-nav-link :href="route('admin.questions.index')"
                        :active="request()->routeIs('admin.questions.index')" class="text-lg transition-colors">
                        الأسئلة
                    </x-nav-link>
                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')"
                        class="text-lg transition-colors">
                        الأعضاء
                    </x-nav-link>
                    <x-nav-link :href="route('admin.shops')" :active="request()->routeIs('admin.shops')"
                        class="text-lg transition-colors">
                        المحلات
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-full text-gray-900 bg-pink-50 hover:bg-pink-200 focus:outline-none transition-all duration-300">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="mr-2">
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

            <div class="lg:hidden flex items-center">
                <button @click="open = !open"
                    class="p-2 rounded-lg text-gray-900 hover:text-purple-700 hover:bg-pink-200 transition-all duration-300 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.questions.index')"
                :active="request()->routeIs('admin.questions.index')">
                الأسئلة
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                الأعضاء
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.shops')" :active="request()->routeIs('admin.shops')">
                المحلات
            </x-responsive-nav-link>
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