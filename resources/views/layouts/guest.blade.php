<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'موقع زواج المودة') }}</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/samim-font@4.0.5/dist/font-face.min.css" rel="stylesheet">

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
        th {
            font-family: 'Samim', sans-serif;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-pink-50">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="flex flex-col justify-center items-center">
                <a href="/">
                    <img src="/assets/images/logo.png" class="w-28 h-28" alt="logo">
                </a>
            </div>
            {{ $slot }}
        </div>
    </div>
</body>

</html>