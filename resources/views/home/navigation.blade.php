<nav x-data="{ open: false }" class="bg-white shadow-lg">
    <div class="container mx-auto px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center">
                <a href="{{ route('index') }}" class="flex items-center hover:opacity-90 transition-opacity">
                    <img src="/assets/images/logo.png" class="h-16 w-16" alt="الموقع">
                    <span class="text-2xl font-bold text-purple-800 ml-4" style="font-family: 'Tajawal', sans-serif;">
                        زواج المودة
                    </span>
                </a>
            </div>

            <div class="hidden lg:flex items-center space-x-6 ">
                <a href="{{ route('index') }}" class="nav-link mx-6 {{ request()->routeIs('index') ? 'active' : '' }}">
                    الرئيسية
                </a>
                <a href="#" class="nav-link">
                    السيرة الذاتية
                </a>
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
                        <a href="#"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('ebooks') ? 'text-purple-700' : 'text-gray-900' }}">
                            الكتب الإلكترونية
                        </a>
                        <a href="#"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('printedBooks') ? 'text-purple-700' : 'text-gray-900' }}">
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
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('weddingTents') ? 'text-purple-700' : 'text-gray-900' }}">
                                    محلات تأجير الخيام
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('halls') ? 'text-purple-700' : 'text-gray-900' }}">
                                    محلات تأجير القاعات
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('furniture') ? 'text-purple-700' : 'text-gray-900' }}">
                                    محلات الأثاث
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('weddingSupplies') ? 'text-purple-700' : 'text-gray-900' }}">
                                    مستلزمات الأعراس
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('designPhotography') ? 'text-purple-700' : 'text-gray-900' }}">
                                    محلات التصميم والتصوير
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('catering') ? 'text-purple-700' : 'text-gray-900' }}">
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
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('doctorConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة طبيب
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('legalConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة قانوني
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('familyConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة أخصائي شؤون أسرية
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('psychologicalConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                    استشارة أخصائي نفسي
                                </a>
                                <a href="#"
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
            <a href="{{ route('contact') }}" class="gold-btn px-6 py-2 rounded-full hidden lg:flex items-center">
                تواصل معنا
            </a>
            <button @click="open = !open" class="lg:hidden text-gray-600">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>

    <div x-show="open" class="lg:hidden px-4 pb-4 space-y-2" x-cloak>
        <a href="{{ route('index') }}" class="nav-link block py-2">
            <i class="fas fa-home ml-2"></i> الرئيسية
        </a>
        <a href="#" class="nav-link block py-2">
            <i class="fas fa-info ml-2"></i> السيرة الذاتية
        </a>

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
                <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">الكتب الإلكترونية</a>
                <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">الكتب المطبوعة</a>
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
                        <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">محلات تأجير الخيام</a>
                        <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">محلات تأجير القاعات</a>
                        <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">محلات الأثاث</a>
                        <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">مستلزمات الأعراس</a>
                        <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">محلات التصميم والتصوير</a>
                        <a href="#" class="block text-sm hover:bg-pink-50 py-2 px-1">مطاعم تقديم الولائم</a>
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

        <a href="{{ route('contact') }}" class="gold-btn block text-center px-6 py-2 rounded-full">
            تواصل معنا
        </a>
    </div>
    <style>
        .rotate-180 {
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }
    </style>
</nav>