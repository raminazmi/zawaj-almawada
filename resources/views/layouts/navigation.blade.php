<nav x-data="{ open: false }" class="bg-white shadow-lg">
    <div class="container mx-auto px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center">
                <a href="{{ route('index') }}" class="flex items-center hover:opacity-90 transition-opacity">
                    <img src="/assets/images/logo.png" class="h-16 w-16" alt="الموقع">
                    <span class="text-2xl font-bold text-[#553566] ml-4" style="font-family: 'Tajawal', sans-serif;">
                        زواج المودة
                    </span>
                </a>
            </div>

            <div class="hidden lg:flex items-center space-x-6">
                <a href="{{ route('index') }}" class="nav-link mx-6 {{ request()->routeIs('index') ? 'active' : '' }}">
                    الرئيسية
                </a>
                <a href={{ route('cv') }} class="nav-link {{ request()->routeIs('cv') ? 'active' : '' }}">
                    السيرة الذاتية
                </a>
                <div class="nav-link flex items-center gap-2">
                    <a href={{ route('business-activities.create') }}>
                        أضف نشاطك التجاري </a>
                </div>
                <div class="relative" x-data="{ isOpen: false }" @click.away="isOpen = false">
                    <button @click="isOpen = !isOpen" class="nav-link flex items-center gap-2">
                        المقاييس
                        <i class="fas fa-chevron-down text-xs ml-1 transition-transform"
                            :class="{ 'rotate-180': isOpen }"></i>
                    </button>
                    <div x-show="isOpen" x-cloak
                        class="absolute bg-white shadow-lg mt-2 w-52 rounded-md border border-gray-200 z-50">
                        <a href={{ route('dashboard') }}
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('dashboard') ? 'text-purple-700' : 'text-gray-900' }}">
                            مقياس التوافق الزواجي
                        </a>
                        <a href="#"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('readiness') ? 'text-purple-700' : 'text-gray-900' }}">
                            اختبار الجاهزية للحياة الزوجية
                        </a>
                        <a href={{ route('exam.user.index') }}
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('exam.user.index') ? 'text-purple-700' : 'text-gray-900' }}">
                            اختباراتي
                        </a>
                    </div>
                </div>
                <div class="relative" x-data="{ isOpen: false }" @click.away="isOpen = false">
                    <button @click="isOpen = !isOpen" class="nav-link flex items-center gap-2">
                        الكتب
                        <i class="fas fa-chevron-down text-xs ml-1 transition-transform"
                            :class="{ 'rotate-180': isOpen }"></i>
                    </button>
                    <div x-show="isOpen" x-cloak
                        class="absolute bg-white shadow-lg mt-2 w-48 rounded-md border border-gray-200 z-50">
                        <a href={{ route('e-books') }}
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('e-books') ? 'text-purple-700' : 'text-gray-900' }}">
                            الكتب الإلكترونية
                        </a>
                        <a href={{ route('printed-books') }}
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('printed-books') ? 'text-purple-700' : 'text-gray-900' }}">
                            الكتب المطبوعة
                        </a>
                    </div>
                </div>
                <div class="relative" x-data="{ isOpen: false }" @click.away="isOpen = false">
                    <button @click="isOpen = !isOpen" class="nav-link flex items-center gap-2">
                        الدورات
                        <i class="fas fa-chevron-down text-xs ml-1 transition-transform"
                            :class="{ 'rotate-180': isOpen }"></i>
                    </button>
                    <div x-show="isOpen" x-cloak
                        class="absolute bg-white shadow-lg mt-2 w-48 rounded-md border border-gray-200 z-50">
                        <a href="#"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('courses') ? 'text-purple-700' : 'text-gray-900' }}">
                            دورة التأهيل للزواج
                        </a>
                    </div>
                </div>
                <div class="relative" x-data="{ isOpen: false }" @click.away="isOpen = false">
                    <button @click="isOpen = !isOpen" class="nav-link flex items-center gap-2">
                        المزيد
                        <i class="fas fa-chevron-down text-xs ml-1 transition-transform"
                            :class="{ 'rotate-180': isOpen }"></i>
                    </button>
                    <div x-show="isOpen" x-cloak
                        class="absolute bg-white shadow-lg mt-2 w-56 rounded-md border border-gray-200 z-50">
                        <div class="relative" x-data="{ subOpen: false }" @click.away="subOpen = false">
                            <button @click="subOpen = !subOpen"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-pink-50 flex justify-between items-center gap-2">
                                خدمات الأعراس
                                <i class="fas fa-chevron-left text-xs transition-transform"
                                    :class="{ 'rotate-180': subOpen }"></i>
                            </button>
                            <div x-show="subOpen" x-cloak
                                class="absolute left-full top-0 bg-white shadow-lg mt-0 w-56 rounded-md border border-gray-200 z-50">
                                <a href="{{ route('business-activities.show', 'محلات تأجير الخيام') }}"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('business-activities.show') && request()->segment(2) == 'محلات تأجير الخيام' ? 'text-purple-700' : 'text-gray-900' }}">
                                    محلات تأجير الخيام
                                </a>
                                <a href="{{ route('business-activities.show', 'محلات تأجير القاعات') }}"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('business-activities.show') && request()->segment(2) == 'محلات تأجير القاعات' ? 'text-purple-700' : 'text-gray-900' }}">
                                    محلات تأجير القاعات
                                </a>
                                <a href="{{ route('business-activities.show', 'محلات الأثاث') }}"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('business-activities.show') && request()->segment(2) == 'محلات الأثاث' ? 'text-purple-700' : 'text-gray-900' }}">
                                    محلات الأثاث
                                </a>
                                <a href="{{ route('business-activities.show', 'مستلزمات الأعراس') }}"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('business-activities.show') && request()->segment(2) == 'مستلزمات الأعراس' ? 'text-purple-700' : 'text-gray-900' }}">
                                    مستلزمات الأعراس
                                </a>
                                <a href="{{ route('business-activities.show', 'محلات التصميم والتصوير') }}"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('business-activities.show') && request()->segment(2) == 'محلات التصميم والتصوير' ? 'text-purple-700' : 'text-gray-900' }}">
                                    محلات التصميم والتصوير
                                </a>
                                <a href="{{ route('business-activities.show', 'مطاعم تقديم الولائم') }}"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('business-activities.show') && request()->segment(2) == 'مطاعم تقديم الولائم' ? 'text-purple-700' : 'text-gray-900' }}">
                                    مطاعم تقديم الولائم
                                </a>
                            </div>
                        </div>
                        <div class="relative" x-data="{ subOpen: false }" @click.away="subOpen = false">
                            <button @click="subOpen = !subOpen"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-pink-50 flex justify-between items-center gap-2">
                                طلب استشارة مجانية
                                <i class="fas fa-chevron-left text-xs transition-transform"
                                    :class="{ 'rotate-180': subOpen }"></i>
                            </button>
                            <div x-show="subOpen" x-cloak
                                class="absolute left-full top-0 bg-white shadow-lg mt-0 w-56 rounded-md border border-gray-200 z-50">
                                <a href={{ route('doctor-counseling') }}
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('doctorConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة طبيب
                                </a>
                                <a href={{ route('legal-counseling')}}
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('legalConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة قانوني
                                </a>
                                <a href={{ route('family-counseling') }}
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('familyConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة أخصائي شؤون أسرية
                                </a>
                                <a href={{ route('psychic-counseling')}}
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('psychologicalConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة أخصائي نفسي
                                </a>
                                <a href={{ route('legitimate-counseling')}}
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('religiousConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة متخصص شرعي
                                </a>
                            </div>
                        </div>
                        <a href="#"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('marriageRequests') ? 'text-purple-700' : 'text-gray-900' }}">
                            تقديم طلبات الزواج
                        </a>
                    </div>
                </div>
            </div>

            <div class="hidden lg:flex items-center">
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

            <button @click="open = !open" class="lg:hidden text-gray-600">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>

    <div x-show="open" class="lg:hidden px-4 pb-4 space-y-2" x-cloak>
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
            class="nav-link block py-2">
            <i class="fas fa-home ml-2"></i> موقع زواج المودة
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('exam.user.index')" :active="request()->routeIs('exam.user.index')"
            class="nav-link block py-2">
            <i class="fas fa-clipboard-list ml-2"></i> اختباراتي
        </x-responsive-nav-link>

        <a href="{{ route('index') }}" class="nav-link block py-2">
            <i class="fas fa-home ml-2"></i> الرئيسية
        </a>
        <a href="#" class="nav-link block py-2">
            <i class="fas fa-info ml-2"></i> السيرة الذاتية
        </a>
        <div class="nav-link flex items-center gap-2">
            <a href={{ route('business-activities.create') }}>
                أضف نشاطك التجاري </a>
        </div>
        <div x-data="{ isOpen: false }">
            <button @click="isOpen = !isOpen" class="nav-link block w-full text-left py-2 flex justify-between">
                <div>
                    <i class="fas fa-book-open ml-2"></i> المقاييس
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': isOpen }"></i>
            </button>
            <div x-show="isOpen" x-cloak class="pl-4 space-y-2">
                <a href={{ route('dashboard') }} class="block text-sm hover:bg-pink-50 py-2 px-1">
                    مقياس التوافق الزواجي
                </a>
                <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">
                    اختبار الجاهزية للحياة الزوجية
                </a>
                <a href={{ route('exam.user.index') }} class="block text-sm hover:bg-pink-50 py-2 px-1">
                    اختباراتي
                </a>
            </div>
        </div>

        <div x-data="{ isOpen: false }">
            <button @click="isOpen = !isOpen" class="nav-link block w-full text-left py-2 flex justify-between">
                <div><i class="fas fa-book ml-2"></i> الكتب </div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': isOpen }"></i>
            </button>
            <div x-show="isOpen" x-cloak class="pl-4 space-y-2">
                <a href="{{ route('e-books') }}" class="block text-sm hover:bg-pink-50 py-2 px-1">الكتب الإلكترونية</a>
                <a href="{{ route('printed-books') }}" class="block text-sm hover:bg-pink-50 py-2 px-1">الكتب
                    المطبوعة</a>
            </div>
        </div>

        <div x-data="{ isOpen: false }">
            <button @click="isOpen = !isOpen" class="nav-link block w-full text-left py-2 flex justify-between">
                <div> <i class="fas fa-chalkboard-teacher ml-2"></i> الدورات </div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': isOpen }"></i>
            </button>
            <div x-show="isOpen" x-cloak class="pl-4 space-y-2">
                <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">دورة التأهيل للزواج</a>
            </div>
        </div>

        <div x-data="{ isOpen: false }">
            <button @click="isOpen = !isOpen" class="nav-link block w-full text-left py-2 flex justify-between">
                <div><i class="fas fa-ellipsis-h ml-2"></i> المزيد </div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': isOpen }"></i>
            </button>
            <div x-show="isOpen" x-cloak class="pl-4 space-y-2">
                <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">تقديم طلبات الزواج</a>

                <div x-data="{ subOpen: false }">
                    <button @click="subOpen = !subOpen" class="w-full text-left text-sm flex justify-between py-2">
                        خدمات الأعراس
                        <i class="fas fa-chevron-down text-xs transition-transform"
                            :class="{ 'rotate-180': subOpen }"></i>
                    </button>
                    <div x-show="subOpen" x-cloak class="pl-4 space-y-2">
                        <a href="{{ route('business-activities.show', 'محلات تأجير الخيام') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1 {{ request()->routeIs('business-activities.show') && request()->segment(2) == 'محلات تأجير الخيام' ? 'text-purple-700' : 'text-gray-900' }}">
                            محلات تأجير الخيام
                        </a>
                        <a href="{{ route('business-activities.show', 'محلات تأجير القاعات') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1 {{ request()->routeIs('business-activities.show') && request()->segment(2) == 'محلات تأجير القاعات' ? 'text-purple-700' : 'text-gray-900' }}">
                            محلات تأجير القاعات
                        </a>
                        <a href="{{ route('business-activities.show', 'محلات الأثاث') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1 {{ request()->routeIs('business-activities.show') && request()->segment(2) == 'محلات الأثاث' ? 'text-purple-700' : 'text-gray-900' }}">
                            محلات الأثاث
                        </a>
                        <a href="{{ route('business-activities.show', 'مستلزمات الأعراس') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1 {{ request()->routeIs('business-activities.show') && request()->segment(2) == 'مستلزمات الأعراس' ? 'text-purple-700' : 'text-gray-900' }}">
                            مستلزمات الأعراس
                        </a>
                        <a href="{{ route('business-activities.show', 'محلات التصميم والتصوير') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1 {{ request()->routeIs('business-activities.show') && request()->segment(2) == 'محلات التصميم والتصوير' ? 'text-purple-700' : 'text-gray-900' }}">
                            محلات التصميم والتصوير
                        </a>
                        <a href="{{ route('business-activities.show', 'مطاعم تقديم الولائم') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1 {{ request()->routeIs('business-activities.show') && request()->segment(2) == 'مطاعم تقديم الولائم' ? 'text-purple-700' : 'text-gray-900' }}">
                            مطاعم تقديم الولائم
                        </a>
                    </div>
                </div>

                <div x-data="{ subOpen: false }">
                    <button @click="subOpen = !subOpen" class="w-full text-left text-sm flex justify-between py-2">
                        طلب استشارة مجانية
                        <i class="fas fa-chevron-down text-xs transition-transform"
                            :class="{ 'rotate-180': subOpen }"></i>
                    </button>
                    <div x-show="subOpen" x-cloak class="pl-4 space-y-2">
                        <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">استشارة طبيب</a>
                        <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">استشارة قانوني</a>
                        <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">استشارة أخصائي شؤون أسرية</a>
                        <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">استشارة أخصائي نفسي</a>
                        <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">استشارة متخصص شرعي</a>
                    </div>
                </div>
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

    <style>
        .rotate-180 {
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }

        .nav-link {
            @apply text-gray-900 hover: text-purple-700 transition-colors duration-200;
        }

        .nav-link.active {
            @apply text-purple-700 font-semibold;
        }

        .gold-btn {
            background: linear-gradient(45deg, #D4AF37, #CFB53B);
            @apply text-white font-medium hover: opacity-90 transition-opacity;
        }
    </style>
</nav>