<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>زواج المودة</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @font-face {
            font-family: 'Samim';
            src: url('/assets/fonts/alfont_com_ArbFONTS-Samim.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Samim', sans-serif;
            background-color: #f9fafb;
        }

        .islamic-pattern {
            background-image: radial-gradient(circle, #f4e9ff 10%, transparent 20%),
                radial-gradient(circle, #f4e9ff 10%, transparent 20%);
            background-size: 50px 50px;
            background-position: 0 0, 25px 25px;
        }

        .gold-btn {
            background: linear-gradient(45deg, #CBA63D 0%, #D4AF37 100%);
            box-shadow: 0 4px 15px rgba(203, 166, 61, 0.3);
            transition: all 0.3s ease;
        }

        .section-title {
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 60px;
            height: 3px;
            background: #d4b341;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(203, 166, 61, 0.2);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .activity-card {
            background: white;
            border: 1px solid rgba(203, 166, 61, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .activity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .activity-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(229, 209, 135, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.5s;
        }

        .activity-card:hover::before {
            animation: shine 1.5s;
        }

        @keyframes shine {
            100% {
                left: 150%;
            }
        }

        .badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #d4b341;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    @if (auth()->check())
    @if (auth()->user()->is_admin)
    @include('admin.navigation')
    @else
    @include('layouts.navigation')
    @endif
    @else
    @include('home.navigation')
    @endif

    <section class="islamic-pattern px-4 py-8 md:p-14 md:pt-18 md:pb-24">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold text-purple-900 mb-8 text-center">{{ $title }}</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($activities as $activity)
                <div class="activity-card p-6 rounded-xl shadow-md relative">
                    <div class="badge">
                        <i class="fas fa-heart ml-2"></i>متوفر
                    </div>
                    @if ($activity->image)
                    <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->name }}"
                        class="w-full h-48 object-cover rounded-t-xl mb-4">
                    @endif
                    <h2 class="text-xl font-bold text-purple-900 mb-3 flex items-center">
                        <i class="fas fa-ring ml-4 text-purple-900"></i>
                        {{ $activity->name }}
                    </h2>
                    <div class="space-y-2">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-phone ml-2 text-purple-900"></i>
                            {{ $activity->phone }}
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-map-marker-alt ml-2 text-purple-900"></i>
                            {{ $activity->state }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-700 text-lg mb-4">
                        <i class="fas fa-exclamation-circle text-3xl text-[#d4b341]"></i>
                    </div>
                    <p class="text-gray-700">لا توجد محلات متاحة حاليًا.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="bg-purple-900 text-white pt-12">
        <div class="container mx-auto px-12">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-14 border-b border-purple-800 pb-12">
                <div class="md:col-span-2">
                    <h4 class="text-xl font-bold mb-6">عن الموقع</h4>
                    <p class="text-gray-300 leading-relaxed">
                        هو منصة إلكترونية يديرها د.حمود النوفلي من سلطنة عمان، ويقدم فيها خدمات مجانية في كل ما يحتاج له
                        الشباب
                        المقبلين على
                        الزواج والمتزوجين حديثاً، من تأهيل واستشارات وخدمات ومقاييس ودورات وكتب تمكنهم من بناء حياة
                        أسرية سعيدة
                        بعيداً عن
                        المشكلات والتفكك الاسري.
                    </p>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-6">روابط سريعة</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-[#d4b341] transition-colors flex items-center">
                                <i class="fas fa-angle-left ml-2"></i>
                                الشروط والأحكام
                            </a></li>
                        <li><a href="#" class="hover:text-[#d4b341] transition-colors flex items-center">
                                <i class="fas fa-angle-left ml-2"></i>
                                الأسئلة الشائعة
                            </a></li>
                        <li><a href="#" class="hover:text-[#d4b341] transition-colors flex items-center">
                                <i class="fas fa-angle-left ml-2"></i>
                                المدونة
                            </a></li>
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
                        <a href="https://www.instagram.com/hamoodalnoofli/" class="social-icon hover:-translate-y-1" target="_blank">
                            <i class="fab fa-instagram"></i>
                          </a>
                        <a href="https://x.com/molhim399?s=08" class="social-icon hover:-translate-y-1">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.youtube.com/channel/UC6pJW3_VsKH1M1NqbkeYITQ" class="social-icon hover:-translate-y-1"  target="_blank">
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

    <script>
        $(document).ready(function() {
            $('#menu-toggle').click(function() {
                $('#mobile-menu').slideToggle(300);
            });

            // Add hover effect for cards
            $('.activity-card').hover(
                function() {
                    $(this).addClass('shadow-lg');
                },
                function() {
                    $(this).removeClass('shadow-lg');
                }
            );
        });
    </script>
</body>

</html>
