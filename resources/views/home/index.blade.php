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

    @media (max-width: 768px) {
      .header-bg {
        padding-left: 1rem;
        padding-right: 1rem;
      }
    }
  </style>
</head>

<body class="bg-gray-50">
  @if(auth()->check())
  @if(auth()->user()->is_admin)
  @include('admin.navigation')
  @else
  @include('layouts.navigation')
  @endif
  @else
  @include('home.navigation')
  @endif

  <main class="container mx-auto px-4 sm:px-8 lg:px-16">
    <div
      class="flex flex-col bg-pink-100 mt-10 py-8 px-4 sm:px-8 lg:px-16 rounded-3xl lg:flex-row items-center gap-8 lg:gap-16">
      <div class="w-full lg:w-1/2 space-y-6 text-center lg:text-right">
        <h1 class="text-3xl sm:text-4xl font-bold text-purple-900 leading-tight">
          مقياس التوافق الزواجي
        </h1>
        <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
          يساعدك هذا المقياس على معرفة مدى التوافق بينك وبين خطيبتك، مما يساعد في بناء علاقة متينة وفهم أعمق
          لشخصياتكما.
        </p>
        @auth
        <a href="{{ route('dashboard') }}" class="inline-block">
          @else
          <a href="{{ route('login') }}" class="inline-block">
            @endauth
            <button
              class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-3xl transition-colors text-sm sm:text-base">
              اجراء اختبار
            </button>
          </a>
      </div>
      <div class="w-full lg:w-1/2 flex justify-center">
        <img src="/assets/images/2.png" class="w-64 sm:w-80 lg:w-96 h-auto" alt="marriage compatibility test">
      </div>
    </div>

    <div class="py-12 px-4 sm:px-8 lg:px-16 space-y-8">
      <h2 class="text-2xl sm:text-3xl font-bold text-purple-900">معلومات إضافية عن المقياس</h2>
      <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
        يهدف هذا المقياس إلى تقييم درجة التوافق بين الشريكين قبل الزواج من خلال استكشاف الجوانب النفسية
        والاجتماعية والسلوكية.
      </p>
      <div class="flex flex-col gap-4 text-purple-900">
        <div class="flex items-center gap-2">
          <i class="fas fa-clock text-lg text-purple-600"></i>
          <span class="font-semibold">مدة الاختبار:</span>
          <span>12 دقيقة</span>
        </div>
        <div class="flex items-center gap-2">
          <i class="fas fa-question-circle text-lg text-purple-600"></i>
          <span class="font-semibold">عدد الأسئلة:</span>
          <span>120 سؤالاً</span>
        </div>
      </div>
    </div>

    <div class="mb-8 px-4 sm:px-8 lg:px-16">
      <div class="bg-red-100 rounded-3xl p-6 border-2 border-red-200">
        <div class="flex items-start gap-3">
          <i class="fas fa-exclamation-triangle text-2xl text-red-600 mt-1"></i>
          <div>
            <h3 class="text-red-800 font-bold text-lg mb-2">تنويه هام</h3>
            <p class="text-red-700 text-sm leading-relaxed">
              هو منصة إلكترونية متخصصة في تقديم خدمات الزواج الشرعي وفقًا للتعاليم الإسلامية، ويهدف إلى
              تسهيل عملية البحث عن شريك
              الحياة المناسب بطريقة آمنة ومحترمة
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer class="bg-pink-100 border-t border-pink-200 py-8 px-4 sm:px-8 lg:px-24">
    <div class="container">
      <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
        <div class="flex flex-col items-center mb-8 text-center">
          <a href="{{ route('dashboard') }}" class="hover:opacity-90 transition-opacity">
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
  <script>
    $(document).ready(function() {
            $('#menu-toggle').click(function() {
                $('#mobile-menu').slideToggle(300);
            });

            $(document).click(function(event) {
                if (!$(event.target).closest('#menu-toggle, #mobile-menu').length) {
                    $('#mobile-menu').slideUp(300);
                }
            });
        });

  </script>
</body>

</html>