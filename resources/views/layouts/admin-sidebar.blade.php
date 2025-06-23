<!-- Mobile overlay -->
<div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak
    class="fixed inset-0 z-30 bg-black bg-opacity-50 transition-opacity lg:hidden"></div>

<!-- Sidebar -->
<aside x-show="sidebarOpen" style="height: calc(100vh - 61px);" x-cloak
    class="fixed inset-y-0 right-0 z-40 flex min-h-screen w-64 flex-col bg-gray-800 text-white transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0"
    :class="{'translate-x-0': sidebarOpen, 'translate-x-full': !sidebarOpen}">
    <div class="flex items-center justify-center border-b border-gray-700 p-4 py-2">
        <a href="{{ route('index') }}" class="flex items-center w-full">
            <header class="p-0.5 bg-white rounded-md">
                <img src="/assets/images/logo.png" class="h-10 w-10" alt="الموقع">
            </header>
            <span class="text-lg font-bold mr-3">لوحة التحكم</span>
        </a>
    </div>

    <nav class="flex-1 space-y-3 overflow-y-auto p-4 py-4 hide-scrollbar max-h-screen">
        <a href="{{ route('admin.dashboard.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt ml-3 fa-fw"></i> لوحة التحكم
        </a>

        @if(auth()->user()->isMainAdmin())
        <a href="{{ route('admin.users.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
            <i class="fas fa-users ml-3 fa-fw"></i> الأعضاء
        </a>
        <a href="{{ route('admin.admins.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.admins.index') ? 'active' : '' }}">
            <i class="fas fa-user-shield ml-3 fa-fw"></i> المشرفين
        </a>
        @endif

        <a href="{{ route('admin.profile-approvals.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.profile-approvals.index') ? 'active' : '' }}">
            <i class="fas fa-check-circle ml-3 fa-fw"></i> قبول الملفات
        </a>

        <a href="{{ route('admin.marriage-requests.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.marriage-requests.index') ? 'active' : '' }}">
            <i class="fas fa-file-signature ml-3 fa-fw"></i> طلبات الزواج
        </a>

        @if(auth()->user()->isMainAdmin())
        <a href="{{ route('admin.courses.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
            <i class="fas fa-chalkboard-teacher ml-3 fa-fw"></i> الدورات
        </a>
        <a href="{{ route('admin.exams.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.exams.*') ? 'active' : '' }}">
            <i class="fas fa-clipboard-list ml-3 fa-fw"></i> إدارة الاختبارات
        </a>
        <a href="{{ route('admin.shops') }}"
            class="sidebar-link {{ request()->routeIs('admin.shops') ? 'active' : '' }}">
            <i class="fas fa-store ml-3 fa-fw"></i> المحلات
        </a>
        <a href="{{ route('admin.questions.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.questions.index') ? 'active' : '' }}">
            <i class="fas fa-question-circle ml-3 fa-fw"></i> الأسئلة
        </a>
        @endif

        <div x-data="{ isOpen: false }">
            <button @click="isOpen = !isOpen" class="sidebar-link w-full flex justify-between items-center">
                <span><i class="fas fa-cogs ml-3 fa-fw"></i> إعدادات أخرى</span>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': isOpen }"></i>
            </button>
            <div x-show="isOpen" x-cloak class="mt-2 space-y-2 mr-6">
                <a href="{{ route('admin.marriage-requests.expired') }}"
                    class="sub-link {{ request()->routeIs('admin.marriage-requests.expired') ? 'active' : '' }}">
                    الطلبات المنتهية
                </a>
                <a href="{{ route('admin.marriage-requests.pending-overdue') }}"
                    class="sub-link {{ request()->routeIs('admin.marriage-requests.pending-overdue') ? 'active' : '' }}">
                    الطلبات المتأخرة
                </a>
                @if(auth()->user()->isMainAdmin())
                <a href="{{ route('admin.readiness_test_link.index') }}"
                    class="sub-link {{ request()->routeIs('admin.readiness_test_link.index') ? 'active' : '' }}">
                    اختبار الجاهزية
                </a>
                <a href="{{ route('admin.marriage_video_link.index') }}"
                    class="sub-link {{ request()->routeIs('admin.marriage_video_link.index') ? 'active' : '' }}">
                    فيديو الزواج
                </a>
                @endif
            </div>
        </div>
    </nav>
</aside>