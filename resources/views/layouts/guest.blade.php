<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('زواج المودة') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/samim-font@4.0.5/dist/font-face.min.css" rel="stylesheet">

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
        th {
            font-family: 'Almarai', sans-serif;
        }

        body {
            background-color: #f9fafb;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-lg border border-purple-100 overflow-hidden rounded-2xl">
            <div class="flex flex-col justify-center items-center my-3">
                <a href="/">
                    <img src="/assets/images/logo.png" class="w-28 h-28" alt="logo">
                </a>
            </div>
            {{ $slot }}
        </div>
    </div>
</body>

</html>