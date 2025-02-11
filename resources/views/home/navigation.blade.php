<nav x-data="{ open: false }" class="bg-pink-100 border-b border-pink-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('index') }}" class="hover:opacity-90 transition-opacity flex items-center">
                    <img src="/assets/images/logo.png" class="w-22 h-16" alt="logo">
                    <span class="text-xl font-bold text-purple-900 ml-4"
                        style="font-family: 'Tajawal', sans-serif;">زواج المودة</span>
                </a>
            </div>

            <div class="hidden lg:flex space-x-4 items-center">
                <div class="flex space-x-4">
                    <a href="{{ route('index') }}"
                        class="text-base mx-6 py-1 px-3 {{ request()->routeIs('index') ? 'text-purple-700 bg-pink-50  rounded-full' : 'text-gray-900 hover:text-purple-700' }}">
                        الرئيسية
                    </a>
                    <a href="#"
                        class="text-base py-1 px-3 {{ request()->routeIs('about') ? 'text-purple-700' : 'text-gray-900 hover:text-purple-700' }}">
                        السيرة الذاتية
                    </a>

                    <!-- قائمة "المقاييس" (dropdown) -->
                    <div class="relative" x-data="{ isOpen: false, pinned: false }"
                        @click.away="isOpen = false; pinned = false">
                        <button @click="pinned = !pinned; isOpen = pinned"
                            class="text-gray-900 hover:text-purple-700 flex items-center text-base py-1 px-3">
                            المقاييس
                            <i class="fas fa-chevron-down text-xs mr-2 pt-1 transition-transform"></i>
                        </button>
                        <div x-show="isOpen" @click.away="isOpen = false; pinned = false"
                            class="absolute bg-white shadow-lg mt-2 w-52 rounded-md border border-gray-200 z-50">
                            <a href="#"
                                class="block px-4 py-2 hover:bg-pink-50 text-sm py-1 px-3 {{ request()->routeIs('compatibility') ? 'text-purple-700' : 'text-gray-900' }}">
                                مقياس التوافق الزواجي
                            </a>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-pink-50 text-sm py-1 px-3 {{ request()->routeIs('readiness') ? 'text-purple-700' : 'text-gray-900' }}">
                                اختبار الجاهزية للحياة الزوجية
                            </a>
                        </div>
                    </div>

                    <div class="relative" x-data="{ isOpen: false, pinned: false }"
                        @click.away="isOpen = false; pinned = false">
                        <button @click="pinned = !pinned; isOpen = pinned"
                            class="text-gray-900 hover:text-purple-700 flex items-center text-base py-1 px-3">
                            الكتب
                            <i class="fas fa-chevron-down text-xs mr-2 pt-1 transition-transform"></i>
                        </button>
                        <div x-show="isOpen" @click.away="isOpen = false; pinned = false"
                            class="absolute bg-white shadow-lg mt-2 w-48 rounded-md border border-gray-200 z-50">
                            <a href="#"
                                class="block px-4 py-2 hover:bg-pink-50 text-sm py-1 px-3 {{ request()->routeIs('ebooks') ? 'text-purple-700' : 'text-gray-900' }}">
                                الكتب الإلكترونية
                            </a>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-pink-50 text-sm py-1 px-3 {{ request()->routeIs('printedBooks') ? 'text-purple-700' : 'text-gray-900' }}">
                                الكتب المطبوعة
                            </a>
                        </div>
                    </div>

                    <div class="relative" x-data="{ isOpen: false, pinned: false }"
                        @click.away="isOpen = false; pinned = false">
                        <button @click="pinned = !pinned; isOpen = pinned"
                            class="text-gray-900 hover:text-purple-700 flex items-center text-base py-1 px-3">
                            الدورات
                            <i class="fas fa-chevron-down text-xs mr-2 pt-1 transition-transform"></i>
                        </button>
                        <div x-show="isOpen" @click.away="isOpen = false; pinned = false"
                            class="absolute bg-white shadow-lg mt-2 w-48 rounded-md border border-gray-200 z-50">
                            <a href="#"
                                class="block px-4 py-2 hover:bg-pink-50 text-sm py-1 px-3 {{ request()->routeIs('courses') ? 'text-purple-700' : 'text-gray-900' }}">
                                دورة التأهيل للزواج
                            </a>
                        </div>
                    </div>

                    <div class="relative" x-data="{ isOpen: false, pinned: false }"
                        @click.away="isOpen = false; pinned = false">
                        <button @click="pinned = !pinned; isOpen = pinned"
                            class="text-gray-900 hover:text-purple-700 flex items-center text-base py-1 px-3">
                            المزيد
                            <i class="fas fa-chevron-down text-xs mr-2 pt-1 transition-transform"></i>
                        </button>
                        <div x-show="isOpen" @click.away="isOpen = false; pinned = false"
                            class="absolute bg-white shadow-lg mt-2 w-56 rounded-md border border-gray-200 z-50">
                            <div class="relative" x-data="{ isOpen: false, pinned: false }"
                                @click.away="isOpen = false; pinned = false">
                                <button @click="pinned = !pinned; isOpen = pinned"
                                    class="flex justify-between items-center w-full px-4 py-2 text-sm py-1 px-3 hover:bg-pink-50">
                                    خدمات الأعراس
                                    <i class="fas fa-chevron-left text-xs mr-2 pt-2 transition-transform"></i>
                                </button>
                                <div x-show="isOpen" @click.away="isOpen = false; pinned = false"
                                    class="absolute left-full top-0 bg-white shadow-lg mt-0 w-56 rounded-md border border-gray-200 z-50">
                                    <a href="#"
                                        class="block px-4 py-2 text-sm hover:bg-pink-50 py-1 px-3 {{ request()->routeIs('weddingTents') ? 'text-purple-700' : 'text-gray-900' }}">
                                        محلات تأجير الخيام
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm hover:bg-pink-50 py-1 px-3 {{ request()->routeIs('halls') ? 'text-purple-700' : 'text-gray-900' }}">
                                        محلات تأجير القاعات
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm hover:bg-pink-50 py-1 px-3 {{ request()->routeIs('furniture') ? 'text-purple-700' : 'text-gray-900' }}">
                                        محلات الأثاث
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm hover:bg-pink-50 py-1 px-3 {{ request()->routeIs('weddingSupplies') ? 'text-purple-700' : 'text-gray-900' }}">
                                        مستلزمات الأعراس
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm hover:bg-pink-50 py-1 px-3 {{ request()->routeIs('designPhotography') ? 'text-purple-700' : 'text-gray-900' }}">
                                        محلات التصميم والتصوير
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm hover:bg-pink-50 py-1 px-3 {{ request()->routeIs('catering') ? 'text-purple-700' : 'text-gray-900' }}">
                                        مطاعم تقديم الولائم
                                    </a>
                                </div>
                            </div>
                            <div class="relative" x-data="{ isOpen: false, pinned: false }"
                                @click.away="isOpen = false; pinned = false">
                                <button @click="pinned = !pinned; isOpen = pinned"
                                    class="flex justify-between items-center w-full px-4 py-2 text-sm py-1 px-3 hover:bg-pink-50">
                                    طلب استشارة مجانية
                                    <i class="fas fa-chevron-left text-xs mr-2 pt-2 transition-transform"></i>
                                </button>
                                <div x-show="isOpen" @click.away="isOpen = false; pinned = false"
                                    class="absolute left-full top-0 bg-white shadow-lg mt-0 w-56 rounded-md border border-gray-200 z-50">
                                    <a href="#"
                                        class="block px-4 py-2 text-sm hover:bg-pink-50 py-1 px-3 {{ request()->routeIs('doctorConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                        استشارة طبيب
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm hover:bg-pink-50 py-1 px-3 {{ request()->routeIs('legalConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                        استشارة قانوني
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm hover:bg-pink-50 py-1 px-3 {{ request()->routeIs('familyConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                        استشارة أخصائي شؤون أسرية
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm hover:bg-pink-50 py-1 px-3 {{ request()->routeIs('psychologicalConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                        استشارة أخصائي نفسي
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm hover:bg-pink-50 py-1 px-3 {{ request()->routeIs('religiousConsultation') ? 'text-purple-700' : 'text-gray-900' }}">
                                        استشارة متخصص شرعي
                                    </a>
                                </div>
                            </div>
                            <a href="#"
                                class="block px-4 py-2 text-sm hover:bg-pink-50 py-1 px-3 {{ request()->routeIs('marriageRequests') ? 'text-purple-700' : 'text-gray-900' }}">
                                تقديم طلبات الزواج
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center my-2">
                <a href="{{ route('contact') }}"
                    class="bg-yellow-600 text-white py-2 px-4 rounded-full hidden lg:block">
                    تواصل معنا
                </a>
                <button @click="open = !open" class="lg:hidden p-2 text-gray-900 hover:text-purple-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" @click.away="open = false" class="lg:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <div class="px-4 space-y-2">
                <a href="{{ route('index') }}"
                    class="block px-4 py-2 text-gray-900 hover:bg-pink-50 {{ request()->routeIs('index') ? 'text-purple-700' : '' }}">
                    الرئيسية
                </a>
                <a href="#"
                    class="block px-4 py-2 text-gray-900 hover:bg-pink-50 {{ request()->routeIs('about') ? 'text-purple-700' : '' }}">
                    السيرة الذاتية
                </a>

                <div x-data="{ isOpen: false, pinned: false }" @click.away="isOpen = false; pinned = false">
                    <button @click="pinned = !pinned; isOpen = pinned"
                        class="w-full flex justify-between items-center px-4 py-2 text-gray-900 hover:bg-pink-50">
                        <span>المقاييس</span>
                        <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': isOpen }"></i>
                    </button>
                    <div x-show="isOpen" class="pl-6">
                        <a href="#"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('compatibility') ? 'text-purple-700' : '' }}">
                            مقياس التوافق الزواجي
                        </a>
                        <a href="#"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('readiness') ? 'text-purple-700' : '' }}">
                            اختبار الجاهزية للحياة الزوجية
                        </a>
                    </div>
                </div>

                <div x-data="{ isOpen: false, pinned: false }" @click.away="isOpen = false; pinned = false">
                    <button @click="pinned = !pinned; isOpen = pinned"
                        class="w-full flex justify-between items-center px-4 py-2 text-gray-900 hover:bg-pink-50">
                        <span>الكتب</span>
                        <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': isOpen }"></i>
                    </button>
                    <div x-show="isOpen" class="pl-6">
                        <a href="#"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('ebooks') ? 'text-purple-700' : '' }}">
                            الكتب الإلكترونية
                        </a>
                        <a href="#"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('printedBooks') ? 'text-purple-700' : '' }}">
                            الكتب المطبوعة
                        </a>
                    </div>
                </div>

                <div x-data="{ isOpen: false, pinned: false }" @click.away="isOpen = false; pinned = false">
                    <button @click="pinned = !pinned; isOpen = pinned"
                        class="w-full flex justify-between items-center px-4 py-2 text-gray-900 hover:bg-pink-50">
                        <span>الدورات</span>
                        <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': isOpen }"></i>
                    </button>
                    <div x-show="isOpen" class="pl-6">
                        <a href="#"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('courses') ? 'text-purple-700' : '' }}">
                            دورة التأهيل للزواج
                        </a>
                    </div>
                </div>

                <div x-data="{ isOpen: false, pinned: false }" @click.away="isOpen = false; pinned = false">
                    <button @click="pinned = !pinned; isOpen = pinned"
                        class="w-full flex justify-between items-center px-4 py-2 text-gray-900 hover:bg-pink-50">
                        <span>المزيد</span>
                        <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': isOpen }"></i>
                    </button>
                    <div x-show="isOpen" class="pl-6 space-y-2">
                        <div x-data="{ isOpen: false, pinned: false }" @click.away="isOpen = false; pinned = false">
                            <button @click="pinned = !pinned; isOpen = pinned"
                                class="w-full flex justify-between items-center px-4 py-2 text-sm hover:bg-pink-50">
                                <span>خدمات الأعراس</span>
                                <i class="fas fa-chevron-down transition-transform"
                                    :class="{ 'rotate-180': isOpen }"></i>
                            </button>
                            <div x-show="isOpen" class="pl-6">
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('weddingTents') ? 'text-purple-700' : '' }}">
                                    محلات تأجير الخيام
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('halls') ? 'text-purple-700' : '' }}">
                                    محلات تأجير القاعات
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('furniture') ? 'text-purple-700' : '' }}">
                                    محلات الأثاث
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('weddingSupplies') ? 'text-purple-700' : '' }}">
                                    مستلزمات الأعراس
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('designPhotography') ? 'text-purple-700' : '' }}">
                                    محلات التصميم والتصوير
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('catering') ? 'text-purple-700' : '' }}">
                                    مطاعم تقديم الولائم
                                </a>
                            </div>
                        </div>
                        <div x-data="{ isOpen: false, pinned: false }" @click.away="isOpen = false; pinned = false">
                            <button @click="pinned = !pinned; isOpen = pinned"
                                class="w-full flex justify-between items-center px-4 py-2 text-sm hover:bg-pink-50">
                                <span>طلب استشارة مجانية</span>
                                <i class="fas fa-chevron-down transition-transform"
                                    :class="{ 'rotate-180': isOpen }"></i>
                            </button>
                            <div x-show="isOpen" class="pl-6">
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('doctorConsultation') ? 'text-purple-700' : '' }}">
                                    استشارة طبيب
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('legalConsultation') ? 'text-purple-700' : '' }}">
                                    استشارة قانوني
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('familyConsultation') ? 'text-purple-700' : '' }}">
                                    استشارة أخصائي شؤون أسرية
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('psychologicalConsultation') ? 'text-purple-700' : '' }}">
                                    استشارة أخصائي نفسي
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('religiousConsultation') ? 'text-purple-700' : '' }}">
                                    استشارة متخصص شرعي
                                </a>
                            </div>
                        </div>
                        <a href="#"
                            class="block px-4 py-2 text-sm hover:bg-pink-50 {{ request()->routeIs('marriageRequests') ? 'text-purple-700' : '' }}">
                            تقديم طلبات الزواج
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center my-4">
                <a href="{{ route('contact') }}" class="bg-yellow-600 text-white py-2 px-4 rounded-full">
                    تواصل معنا
                </a>
            </div>
        </div>
    </div>

    <style>
        .rotate-180 {
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }
    </style>
</nav>