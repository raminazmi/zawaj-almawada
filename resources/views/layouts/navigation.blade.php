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
                @if((auth()->check() && !auth()->user()->is_admin) || !auth()->check())
                <a href="{{ route('index') }}" class="nav-link mx-6 {{ request()->routeIs('index') ? 'active' : '' }}">
                    الرئيسية
                </a>
                <a href="{{ route('cv') }}" class="nav-link {{ request()->routeIs('cv') ? 'active' : '' }}">
                    السيرة الذاتية
                </a>
                <div class="nav-link flex items-center gap-2">
                    <a href="{{ route('business-activities.create') }}">أضف نشاطك التجاري</a>
                </div>
                <div class="relative" x-data="{ isOpen: false }" @click.away="isOpen = false">
                    <button @click="isOpen = !isOpen" class="nav-link flex items-center gap-2">
                        المقاييس
                        <i class="fas fa-chevron-down text-xs ml-1 transition-transform"
                            :class="{ 'rotate-180': isOpen }"></i>
                    </button>
                    <div x-show="isOpen" x-cloak
                        class="absolute bg-white shadow-lg mt-2 w-52 rounded-md border border-gray-200 z-50">
                        <a href="{{ route('exam.pledge') }}"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('exam.pledge') ? 'text-purple-700' : 'text-gray-900' }}">
                            مقياس التوافق الزواجي
                        </a>
                        <a href="{{ route('readiness_test.index') }}"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('readiness_test.index') ? 'text-purple-700' : 'text-gray-900' }}">
                            اختبار الجاهزية للحياة الزوجية
                        </a>
                        <a href="{{ route('exam.user.index') }}"
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
                        <a href="{{ route('e-books') }}"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('e-books') ? 'text-purple-700' : 'text-gray-900' }}">
                            الكتب الإلكترونية
                        </a>
                        <a href="{{ route('printed-books') }}"
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
                        @if($courses->isEmpty())
                        <p class="block px-4 py-2 text-sm hover:bg-pink-50">
                            لا يوجد دورات حاليا
                        </p>
                        @else
                        @foreach($courses as $course)
                        <a href="{{ route('courses.show', $course->id) }}"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('courses.show', $course->id) ? 'text-purple-700' : 'text-gray-900' }}">
                            {{ $course->title }}
                        </a>
                        @endforeach
                        @endif
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
                                <a href="{{ route('doctor-counseling') }}"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('doctor-counseling') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة طبيب
                                </a>
                                <a href="{{ route('legal-counseling') }}"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('legal-counseling') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة قانوني
                                </a>
                                <a href="{{ route('family-counseling') }}"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('family-counseling') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة أخصائي شؤون أسرية
                                </a>
                                <a href="{{ route('psychic-counseling') }}"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('psychic-counseling') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة أخصائي نفسي
                                </a>
                                <a href="{{ route('legitimate-counseling') }}"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('legitimate-counseling') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة متخصص شرعي
                                </a>
                            </div>
                        </div>
                        <div class="relative" x-data="{ subOpen: false }" @click.away="subOpen = false">
                            <button @click="subOpen = !subOpen"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-pink-50 flex justify-between items-center gap-2">
                                برنامج الزواج الشرعي
                                <i class="fas fa-chevron-left text-xs transition-transform"
                                    :class="{ 'rotate-180': subOpen }"></i>
                            </button>
                            <div x-show="subOpen" x-cloak
                                class="absolute left-full top-0 bg-white shadow-lg mt-0 w-56 rounded-md border border-gray-200 z-50">
                                <a href="{{ route('marriage-requests.index') }}"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('marriage-requests.index') ? 'text-purple-700' : 'text-gray-900' }}">
                                    تقديم طلب زواج
                                </a>
                                @auth
                                <a href="{{ route('marriage-requests.status') }}"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('marriage-requests.status') ? 'text-purple-700' : 'text-gray-900' }}">
                                    حالة طلب الزواج
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('course-exams.index') }}"
                    class="nav-link mx-6 {{ request()->routeIs('course-exams.*') ? 'active' : '' }}">
                    اختبارات الدورات
                </a>
                @endif
            </div>

            @guest
            <div class="flex justify-center items-center gap-2">
                <a href="{{ route('login') }}"
                    class="gold-btn px-4 py-2 text-white rounded-full hidden lg:flex items-center text-sm">
                    تسجيل الدخول
                </a>
                <a href="{{ route('contact') }}"
                    class="gold-btn px-4 py-2 text-white rounded-full hidden lg:flex items-center text-sm">
                    تواصل معنا
                </a>
            </div>
            @endguest

            @auth
            <div class="hidden lg:flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-full text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none transition-all duration-300">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="mr-2"><i class="fas fa-chevron-down text-sm"></i></div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                        </form>
                        <x-dropdown-link href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="text-gray-900 hover:bg-gray-100 transition-colors">
                            <i class="fas fa-sign-out-alt ml-2"></i> تسجيل الخروج
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            <button @click="open = !open" class="lg:hidden text-gray-600">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>

    <div x-show="open" class="lg:hidden px-4 pb-4 space-y-2" x-cloak>
        @if((auth()->check() && !auth()->user()->is_admin) || !auth()->check())
        <a href="{{ route('index') }}" class="nav-link block py-2">
            <i class="fas fa-home ml-2"></i> الرئيسية
        </a>
        <a href="{{ route('cv') }}" class="nav-link block py-2">
            <i class="fas fa-info ml-2"></i> السيرة الذاتية
        </a>
        <div class="nav-link block py-2">
            <a href="{{ route('business-activities.create') }}"><i class="fas fa-plus ml-2"></i> أضف نشاطك التجاري</a>
        </div>
        <div x-data="{ isOpen: false }">
            <button @click="isOpen = !isOpen" class="nav-link block w-full text-left py-2 flex justify-between">
                <div><i class="fas fa-book-open ml-2"></i> المقاييس</div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': isOpen }"></i>
            </button>
            <div x-show="isOpen" x-cloak class="pl-4 space-y-2">
                <a href="{{ route('exam.pledge') }}" class="block text-sm hover:bg-pink-50 py-2 px-1">
                    مقياس التوافق الزواجي
                </a>
                <a href="{{ route('readiness_test.index') }}" class="block text-sm hover:bg-pink-50 py-2 px-1">
                    اختبار الجاهزية للحياة الزوجية
                </a>
                <a href="{{ route('exam.user.index') }}" class="block text-sm hover:bg-pink-50 py-2 px-1">
                    اختباراتي
                </a>
            </div>
        </div>
        <div x-data="{ isOpen: false }">
            <button @click="isOpen = !isOpen" class="nav-link block w-full text-left py-2 flex justify-between">
                <div><i class="fas fa-book ml-2"></i> الكتب</div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': isOpen }"></i>
            </button>
            <div x-show="isOpen" x-cloak class="pl-4 space-y-2">
                <a href="{{ route('e-books') }}" class="block text-sm hover:bg-pink-50 py-2 px-1">الكتب
                    الإلكترونية</a>
                <a href="{{ route('printed-books') }}" class="block text-sm hover:bg-pink-50 py-2 px-1">الكتب
                    المطبوعة</a>
            </div>
        </div>
        <div x-data="{ isOpen: false }">
            <button @click="isOpen = !isOpen" class="nav-link block w-full text-left py-2 flex justify-between">
                <div><i class="fas fa-chalkboard-teacher ml-2"></i> الدورات</div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': isOpen }"></i>
            </button>
            <div x-show="isOpen" x-cloak class="pl-4 space-y-2">
                @if($courses->isEmpty())
                <p class="block text-sm hover:bg-pink-50 py-2 px-1">
                    لا يوجد دورات حاليا
                </p>
                @else
                @foreach($courses as $course)
                <a href="{{ route('courses.show', $course->id) }}" class="block text-sm hover:bg-pink-50 py-2 px-1">
                    {{ $course->title }}
                </a>
                @endforeach
                @endif
            </div>
        </div>
        <div x-data="{ isOpen: false }">
            <button @click="isOpen = !isOpen" class="nav-link block w-full text-left py-2 flex justify-between">
                <div><i class="fas fa-ellipsis-h ml-2"></i> المزيد</div>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': isOpen }"></i>
            </button>
            <div x-show="isOpen" x-cloak class="pl-4 space-y-2">
                <div x-data="{ subOpen: false }">
                    <button @click="subOpen = !subOpen" class="w-full text-left text-sm flex justify-between py-2">
                        خدمات الأعراس
                        <i class="fas fa-chevron-down text-xs transition-transform"
                            :class="{ 'rotate-180': subOpen }"></i>
                    </button>
                    <div x-show="subOpen" x-cloak class="pl-4 space-y-2">
                        <a href="{{ route('business-activities.show', 'محلات تأجير الخيام') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1">محلات تأجير الخيام</a>
                        <a href="{{ route('business-activities.show', 'محلات تأجير القاعات') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1">محلات تأجير القاعات</a>
                        <a href="{{ route('business-activities.show', 'محلات الأثاث') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1">محلات الأثاث</a>
                        <a href="{{ route('business-activities.show', 'مستلزمات الأعراس') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1">مستلزمات الأعراس</a>
                        <a href="{{ route('business-activities.show', 'محلات التصميم والتصوير') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1">محلات التصميم والتصوير</a>
                        <a href="{{ route('business-activities.show', 'مطاعم تقديم الولائم') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1">مطاعم تقديم الولائم</a>
                    </div>
                </div>
                <div x-data="{ subOpen: false }">
                    <button @click="subOpen = !subOpen" class="w-full text-left text-sm flex justify-between py-2">
                        طلب استشارة مجانية
                        <i class="fas fa-chevron-down text-xs transition-transform"
                            :class="{ 'rotate-180': subOpen }"></i>
                    </button>
                    <div x-show="subOpen" x-cloak class="pl-4 space-y-2">
                        <a href="{{ route('doctor-counseling') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1">استشارة طبيب</a>
                        <a href="{{ route('legal-counseling') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1">استشارة قانوني</a>
                        <a href="{{ route('family-counseling') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1">استشارة أخصائي شؤون أسرية</a>
                        <a href="{{ route('psychic-counseling') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1">استشارة أخصائي نفسي</a>
                        <a href="{{ route('legitimate-counseling') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1">استشارة متخصص شرعي</a>
                    </div>
                </div>
                <div x-data="{ marriageOpen: false }" class="w-full space-y-2">
                    <button @click="marriageOpen = !marriageOpen"
                        class="w-full text-left text-sm flex justify-between py-2">
                        برنامج الزواج الشرعي
                        <i class="fas fa-chevron-down text-xs transition-transform"
                            :class="{ 'rotate-180': marriageOpen }"></i>
                    </button>
                    <div x-show="marriageOpen" x-cloak class="pl-4 space-y-2">
                        <a href="{{ route('marriage-requests.index') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1">
                            تقديم طلب زواج
                        </a>
                        @auth
                        <a href="{{ route('marriage-requests.status') }}"
                            class="block text-sm hover:bg-pink-50 py-2 px-1">
                            حالة طلب الزواج
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('course-exams.index') }}" class="block text-sm hover:bg-pink-50 py-2 px-1">
            اختبارات الدورات
        </a>
        @endif

        @guest
        <div class="space-y-2">
            <a href="{{ route('login') }}" class="gold-btn block text-center px-6 py-2 rounded-full">
                تسجيل الدخول
            </a>
            <a href="{{ route('contact') }}" class="gold-btn block text-center px-6 py-2 rounded-full">
                تواصل معنا
            </a>
        </div>
        @endguest

        @auth
        <div class="pt-4 pb-1 border-t border-pink-200">
            <div class="px-4">
                <div class="font-medium text-base text-purple-900">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-purple-600">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                @if((auth()->check() && !auth()->user()->is_admin))
                <x-dropdown-link :href="route('profile.edit')" class="text-gray-900 hover:bg-pink-50 transition-colors">
                    <i class="fas fa-user ml-2"></i> الملف الشخصي
                </x-dropdown-link>
                @endif
                <form method="POST" action="{{ route('logout') }}" id="logout-mobile-form">
                    @csrf
                </form>

                <x-responsive-nav-link href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-mobile-form').submit();"
                    class="text-gray-900 hover:bg-pink-50 transition-colors">
                    <i class="fas fa-sign-out-alt ml-2"></i> تسجيل الخروج
                </x-responsive-nav-link>
            </div>
        </div>
        @endauth
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