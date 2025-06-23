<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700&display=swap');

        body,
        p,
        a,
        span,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        label,
        button,
        ul,
        li,
        ol,
        tr,
        td,
        th,
        label,
        select,
        input,
        option {
            font-family: 'Almarai', sans-serif;
        }

        @font-face {
            font-family: 'Samim';
            src: url('/assets/fonts/alfont_com_ArbFONTS-Samim.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        .font-samim {
            font-family: 'Samim', sans-serif;
        }

        body {
            font-family: 'Almarai', sans-serif;
            line-height: 1.6;
            direction: rtl;
        }

        .custom-underline {
            position: relative;
            text-decoration: none;
        }

        .custom-underline:hover::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: -4px;
            height: 2px;
            background-color: #4a5568;
        }

        .gradient-background {
            background-color: #f9fafb;
        }

        .form-input {
            transition: all 0.3s ease;
        }

        .form-input:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
            color: #d1d5db;
            /* gray-300 */
        }

        .sidebar-link:hover {
            background-color: #374151;
            /* gray-700 */
            color: white;
        }

        .sidebar-link.active {
            background-color: #553566;
            /* Custom purple */
            color: white;
            font-weight: bold;
        }

        .sub-link {
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
            color: #9ca3af;
            /* gray-400 */
            font-size: 0.875rem;
        }

        .sub-link:hover {
            background-color: #374151;
            /* gray-700 */
            color: white;
        }

        .sub-link.active {
            background-color: #4c2e5a;
            color: white;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    {{ $styles ?? '' }}
</head>

<body class="font-sans antialiased">
    @if(auth()->check() && auth()->user()->isAdmin())
    {{-- ==== ADMIN LAYOUT ==== --}}
    <div x-data="{ sidebarOpen: window.innerWidth >= 1024 }" @resize.window="sidebarOpen = window.innerWidth >= 1024"
        class="relative min-h-screen md:flex">
        @include('layouts.admin-sidebar')

        <main class="flex-1 min-w-0">
            {{-- Admin Top Bar --}}
            <header class="flex justify-between items-center min-h-[61px] px-6 bg-white border-b-2 shadow-sm">
                {{-- Sidebar Toggle Button --}}
                <button @click.prevent="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
                <div class="text-sm max-h-fit">
                    <!-- Page Title/Breadcrumbs can go here -->
                </div>
                @auth
                <div class="flex items-center">
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
            </header>

            {{-- Main Content --}}
            <div class="overflow-y-auto bg-gradient-to-br from-purple-50 to-blue-50"
                style="height: calc(100vh - 61px);">
                @yield('content')
            </div>
        </main>
    </div>
    @else
    {{-- ==== GUEST/USER LAYOUT ==== --}}
    <div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50">
        @include('layouts.navigation')

        <main class="bg-gradient-to-br from-purple-50 to-blue-50">
            @yield('content')
        </main>
    </div>
    @endif

    {{ $scripts ?? '' }}
</body>

</html>