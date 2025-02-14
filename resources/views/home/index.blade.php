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

    .gold-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(203, 166, 61, 0.4);
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

    .nav-link {
      @apply text-gray-700 hover: text-purple-900 transition-colors flex items-center;
    }

    .nav-link.active {
      @apply text-[#d4b341] font-bold;
    }

    .social-icon {
      @apply w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover: bg-[#d4b341] transition-colors text-xl;
    }
  </style>
</head>

<body>
  @if(auth()->check())
  @if(auth()->user()->is_admin)
  @include('admin.navigation')
  @else
  @include('layouts.navigation')
  @endif
  @else
  @include('home.navigation')
  @endif

  <section class="relative islamic-pattern p-4 md:p-14 ">
    <div
      class="flex flex-col mt-10 py-8 px-4 sm:px-8 lg:px-16 rounded-3xl lg:flex-row items-center gap-8 lg:gap-16 bg-cover bg-center"
      style="background-image: url('assets/images/frame.png');">
      <div class="w-full lg:w-1/2 space-y-6 text-center lg:text-right bg-white bg-opacity-80 p-4 rounded-lg">
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
              class="bg-[#d4b341] hover:bg-yellow-700 text-white px-6 py-3 rounded-3xl transition-colors text-sm sm:text-base">
              اجراء اختبار
            </button>
          </a>
      </div>
      <div class="w-full lg:w-1/2 flex justify-center">
        <img src="/assets/images/2.png" class="w-64 sm:w-80 lg:w-96 h-auto" alt="marriage compatibility test">
      </div>
    </div>
  </section>

  <section class="py-12 px-4 sm:px-8 lg:px-16 space-y-8">
    <div class="container mx-auto px-4">
      <h2 class="section-title text-3xl font-bold text-purple-900 mb-12">
        لماذا اختبار التوافق الزواجي؟
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="feature-card p-6 rounded-xl">
          <div class="text-[#d4b341] text-4xl mb-4">
            <i class="fas fa-hand-holding-heart"></i>
          </div>
          <h3 class="text-xl font-bold text-purple-900 mb-3">أسس شرعية</h3>
          <p class="text-gray-700">اختبار مبني على المبادئ الإسلامية في اختيار الشريك</p>
        </div>

        <div class="feature-card p-6 rounded-xl">
          <div class="text-[#d4b341] text-4xl mb-4">
            <i class="fas fa-brain"></i>
          </div>
          <h3 class="text-xl font-bold text-purple-900 mb-3">تحليل علمي</h3>
          <p class="text-gray-700">تقييم دقيق للجوانب النفسية والاجتماعية</p>
        </div>

        <div class="feature-card p-6 rounded-xl">
          <div class="text-[#d4b341] text-4xl mb-4">
            <i class="fas fa-user-lock"></i>
          </div>
          <h3 class="text-xl font-bold text-purple-900 mb-3">خصوصية تامة</h3>
          <p class="text-gray-700">بياناتك محمية وفق أعلى معايير الأمان</p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-12 px-4 sm:px-8 lg:px-16 space-y-8">
    <h2 class="section-title text-3xl font-bold text-purple-900 mb-12">
      أهداف الإختبار
    </h2>
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
  </section>

  <section class="my-16 px-4 sm:px-8 lg:px-16">
    <div
      class="rounded-3xl p-6 border-2 flex flex-col md:flex-row items-center md:justify-center md:gap-16 justify-between bg-cover bg-center min-h-[250px]"
      style="background-image: url('assets/images/frame.png');">
      <div class="text-center md:text-right bg-white bg-opacity-80 p-4 rounded-lg">
        <h3 class="text-[#58306D] font-bold text-2xl mb-2">انضم الآن لعضوية الموقع</h3>
        <p class="text-[#58306D] text-sm sm:text-base leading-relaxed">
          احصل على كافة الخدمات مجاناً في المستقبل وحاليًا جرب مقياس التوافق الزواجي المميز.
        </p>
      </div>
      <div class="mt-8 md:mt-0">
        <a href="{{ route('register') }}"
          class="bg-[#d4b341] hover:bg-yellow-700 text-white px-6 py-3 rounded-3xl transition-colors text-sm sm:text-base">
          تسجيل عضوية
        </a>
      </div>
    </div>
  </section>

  <footer class="bg-purple-900 text-white pt-12 ">
    <div class="container mx-auto px-12">
      <div class="grid grid-cols-1 md:grid-cols-5 gap-14 border-b border-purple-800 pb-12">
        <div class="md:col-span-2">
          <h4 class="text-xl font-bold mb-6">عن الموقع</h4>
          <p class="text-gray-300">
            هو منصة إلكترونية يديرها د.حمود النوفلي من سلطنة عمان، ويقدم فيها خدمات مجانية في كل ما يحتاج له الشباب
            المقبلين على
            الزواج والمتزوجين حديثاً، من تأهيل واستشارات وخدمات ومقاييس ودورات وكتب تمكنهم من بناء حياة أسرية سعيدة
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
              +968 1234 5678
            </li>
            <li class="flex items-center">
              <i class="fas fa-envelope ml-2 text-[#d4b341]"></i>
              info@mawaddah.com
            </li>
          </ul>
        </div>

        <div>
          <h4 class="text-xl font-bold mb-6">تابعنا</h4>
          <div class="flex space-x-2 gap-4">
            <a href="#" class="social-icon">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="social-icon">
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

  <script>
    $(document).ready(function() {
      $('#menu-toggle').click(function() {
        $('#mobile-menu').slideToggle(300);
      });
    });
  </script>
</body>

</html>