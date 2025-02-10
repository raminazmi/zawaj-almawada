<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>{{ config('app.name', 'موقع زواج المودة') }}</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/samim-font@4.0.5/dist/font-face.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
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
            font-family: 'Samim', sans-serif;
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
            background: linear-gradient(135deg, #fce7f3 0%, #fff1f2 100%);
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
    </style>
    {{ $styles ?? '' }}
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen gradient-background">
        @if (auth()->user()->is_admin)
        @include('admin.navigation')
        @else
        @include('layouts.navigation')
        @endif

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-pink-100 shadow-lg border-b border-pink-200">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main class="bg-gradient-to-b from-purple-50 to-pink-50 py-12">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-pink-100 border-t border-pink-200 py-8 px-4 sm:px-8 lg:px-24">
            <div class="container mx-auto">
                <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                    <div class="flex flex-col items-center mb-8 text-center">
                        <a href="{{ route('exam.index') }}" class="hover:opacity-90 transition-opacity">
                            <img src="/assets/images/logo.png" class="lg:w-32 lg:h-36" alt="logo">
                            <span class="text-3xl font-bold text-purple-900 font-serif ">زواج المودة</span>
                        </a>
                        <p class="text-gray-900 mt-4 max-w-2xl">
                            منصة إلكترونية متخصصة في تقديم خدمات الزواج الشرعي وفقًا للتعاليم الإسلامية، تهدف إلى تسهيل
                            عملية البحث عن شريك الحياة المناسب بطريقة آمنة ومحترمة
                        </p>
                    </div>
                    <div class="text-center lg:text-right">
                        <h3 class="text-lg font-semibold text-purple-900 mb-4">تواصل معنا</h3>
                        <div class="flex gap-4">
                            <a href="#" class="text-purple-900 hover:text-purple-700 transition-colors">
                                <i class="fab fa-facebook text-2xl"></i>
                            </a>
                            <a href="#" class="text-purple-900 hover:text-purple-700 transition-colors">
                                <i class="fab fa-twitter text-2xl"></i>
                            </a>
                            <a href="#" class="text-purple-900 hover:text-purple-700 transition-colors">
                                <i class="fab fa-instagram text-2xl"></i>
                            </a>
                            <a href="#" class="text-purple-900 hover:text-purple-700 transition-colors">
                                <i class="fab fa-youtube text-2xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="text-center bg-purple-900 text-white py-2">
            جميع الحقوق محفوظة © زواج المودة 2025
        </div>
    </div>

    {{ $scripts ?? '' }}
</body>

</html>