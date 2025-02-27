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

    .gold-btn2:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(255, 255, 255, 0.4);
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

  <section class="flex justify-center items-center flex-col gap-12 p-4 md:p-14 ">
    <h2 class="font-bold text-purple-700 text-3xl border-b-4 border-[#d4b341] ">
      الكتب الإلكترونية
    </h2>
  </section>
  <section class="relative">
    <div class="bg-cover bg-center min-h-[550px] py-12" style="background-image: url('assets/images/frame.png');">
      <div class="flex justify-center flex-wrap items-center gap-8 ">
        <div class="bg-white lg:w-[320px] w-[250px] p-2 border-2 border-purple-700 rounded-xl gold-btn2 ">
          <img src="/assets/images/book1.PNG" class="lg:w-[300px] w-[250px] h-[200px] lg:h-[335px]  rounded-xl"
            alt="book1.jpg">
          <h4 class="p-2 text-lg font-bold text-purple-950 pt-4">كتاب نصائح جوهرية لغرس الحب والسعادة في الحياة الزوجية
          </h4>
          <p class="text-xs p-2">
            يحتوي الكتاب مجموعة من النصائح الموجزة والعملية، والتي تم استلهامها من الحالات والمشكلات التي تم التعامل
            معها </p>
          <a href="https://drive.google.com/file/d/16RSH1Zl1C9DxeXcPaG6NwfJELXEX9p-6/view?usp=sharing" target="_blank"
            rel="noopener noreferrer">
            <button class="bg-[#d4b341] p-4 text-white w-full rounded-xl gold-btn">تحميل الكتاب الآن</button>
          </a>
        </div>
        <div class="bg-white lg:w-[320px] w-[250px] p-2 border-2 border-purple-700 rounded-xl gold-btn2 ">
          <img src="/assets/images/ebook2.PNG" class="lg:w-[300px] w-[250px] h-[200px] lg:h-[335px] rounded-xl"
            alt="book1.jpg">
          <h4 class="p-2 text-lg font-bold text-purple-950 pt-4">كتاب مرشدك المختصر في تربية الأبناء وفق مقتضيات العصر
          </h4>
          <p class="text-xs p-2">
            هذا الكتاب دليل عملي موجّه لأولياء الأمور، يقدّم نصائح موجزة لمساعدتهم في تربية أبنائهم بأسلوب علمي وعملي
          </p>
          <a href="https://drive.google.com/file/d/13ZXHWf_Dq8kJ2K4MTOpTy_UQvaZaxrCb/view?usp=sharing" target="_blank"
            rel="noopener noreferrer">
            <button class="bg-[#d4b341] p-4 text-white w-full rounded-xl gold-btn ">تحميل الكتاب الآن</button>
          </a>
        </div>
        <div class="bg-white lg:w-[320px] w-[250px] p-2 border-2 border-purple-700 rounded-xl gold-btn2 ">
          <img src="/assets/images/ebook3.PNG" class="lg:w-[300px] w-[250px] h-[180px] lg:h-[350px]  rounded-xl"
            alt="book1.jpg">
          <h4 class="p-2 text-base font-bold text-purple-950 pt-4">كتاب فلسطين من النكبة الى التحرير</h4>
          <p class="text-xs p-2">
            هذا الكتاب يهدف إلى توعية الأجيال بالقضية الفلسطينية في ظل تغييبها من المناهج التعليمية، متناولًا الجوانب
            التاريخية والسياسية والإعلامية وغيرها
          </p>
          <a href="https://drive.google.com/file/d/1-rKzlAu0QWvAgX8dovUJXI-05CWvInoH/view?usp=sharing" target="_blank"
            rel="noopener noreferrer">
            <button class="bg-[#d4b341] p-4 text-white w-full rounded-xl gold-btn ">تحميل الكتاب الآن</button>
          </a>
        </div>
        <div class="bg-white lg:w-[320px] w-[250px] p-2 border-2 border-purple-700 rounded-xl gold-btn2 ">
          <img src="/assets/images/ebook4.PNG" class="lg:w-[300px] w-[250px] h-[180px] lg:h-[350px]  rounded-xl"
            alt="book1.jpg">
          <h4 class="p-2 text-base font-bold text-purple-950 pt-4">كتاب تحصين الأبناء</h4>
          <p class="text-xs p-2">
            يهدف هذا الكتاب إلى تحصين الأبناء من المؤثرات الثقافية والتقنية المعاصرة، عبر غرس الإيمان والقيم السليمة في
            نفوسهم. </p>
          <a href="https://drive.google.com/file/d/1ry8WFdO01FosoC2MThQ0ubJDBtiNBfY_/view?usp=sharing" target="_blank"
            rel="noopener noreferrer">
            <button class="bg-[#d4b341] p-4 text-white w-full rounded-xl gold-btn ">تحميل الكتاب الآن</button>
          </a>
        </div>
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
    });
  </script>
</body>

</html>
