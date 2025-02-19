<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>{{ config('زواج المودة') }}</title>

    <!-- Fonts -->
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
            font-family: 'Samim', sans-serif;
            line-height: 1.6;
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
        <footer class="bg-purple-900 text-white pt-12 ">
            <div class="container mx-auto px-12">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-14 border-b border-purple-800 pb-12">
                    <div class="md:col-span-2">
                        <h4 class="text-xl font-bold mb-6">عن الموقع</h4>
                        <p class="text-gray-300">
                            هو منصة إلكترونية يديرها د.حمود النوفلي من سلطنة عمان، ويقدم فيها خدمات مجانية في كل ما
                            يحتاج له
                            الشباب
                            المقبلين على
                            الزواج والمتزوجين حديثاً، من تأهيل واستشارات وخدمات ومقاييس ودورات وكتب تمكنهم من بناء حياة
                            أسرية
                            سعيدة
                            بعيداً عن
                            المشكلات والتفكك الاسري.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-xl font-bold mb-6">روابط سريعة</h4>
                        <ul class="space-y-3">
                            <li><a href="#" class="hover:text-[#d4b341] transition-colors">الشروط والأحكام</a></li>
                            <li><a href="#" class="hover:text-[#d4b341] transition-colors">الأسئلة الشائعة</a></li>
                            <li><a href="#" class="hover:text-[#d4b341] transition-colors">المدونة</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-xl font-bold mb-6">تواصل معنا</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <i class="fas fa-phone ml-2 text-[#d4b341]"></i>
                                0096894128090
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-envelope ml-2 text-[#d4b341]"></i>
                                zawajmawadda@gmail.com
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-xl font-bold mb-6">تابعنا</h4>
                        <div class="flex space-x-2 gap-4">
                            <a href="#" class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://x.com/molhim399?s=08" class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="py-4 text-center text-white">
                    جميع الحقوق محفوظة © زواج المودة 2025
                </div>
            </div>
        </footer>
    </div>

    {{ $scripts ?? '' }}
</body>

</html>
