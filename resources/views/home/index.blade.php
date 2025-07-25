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
    @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700&display=swap');

    @font-face {
      font-family: 'Samim';
      src: url('/assets/fonts/alfont_com_ArbFONTS-Samim.ttf') format('truetype');
      font-weight: normal;
      font-style: normal;
    }

    body {
      font-family: 'Almarai', sans-serif;
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
</head>

<body>
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
      <div class="overflow-y-auto bg-gray-200" style="height: calc(100vh - 61px);">
        <section class="relative islamic-pattern p-4 md:p-14">
          @auth
          @if(!in_array(Auth::user()->status, ['available', 'engaged']))
          <section class="py-0 px-4 sm:px-8 lg:px-16">
            <div class="container mx-auto px-4">
              <div
                class="bg-gradient-to-br from-purple-50 to-blue-50 border border-purple-100 p-8 rounded-2xl shadow-lg">
                <div class="flex items-start">
                  <div class="flex-shrink-0 pt-1">
                    <i class="fas fa-hourglass-half text-[#d4b341] text-2xl"></i>
                  </div>
                  <div class="mr-3 flex items-center justify-between gap-2 w-full flex-wrap">
                    <div>
                      <h3 class="text-xl font-bold text-purple-900">طلب خطوبة نشط</h3>
                      <div class="mt-2 text-gray-700">
                        <p>لديك طلب خطوبة نشط مع
                          <span class="font-medium">
                            @if($marriageRequest)
                            {{ $marriageRequest->user_id === Auth::id() ? $marriageRequest->target->name :
                            $marriageRequest->user->name ?? 'غير محدد' }}
                            @else
                            غير محدد
                            @endif
                          </span>
                        </p>
                      </div>
                    </div>
                    <div class="mt-4">
                      <a href="{{ route('marriage-requests.status') }}"
                        class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-sm font-medium rounded-lg transition-all transform hover:scale-105 shadow-md">
                        <i class="fas fa-clock ml-2"></i>
                        متابعة حالة الطلب
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          @endif
          @endauth
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
              <a href="{{ route('exam.pledge') }}" class="inline-block">
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
                <h3 class="text-xl font-bold text-purple-900 mb-3">شعار المقياس</h3>
                <p class="text-gray-700">إذا احسنت الاختيار ستنعم بالاستقرار</p>
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
          <div class="container mx-auto px-4">
            <h2 class="section-title text-3xl font-bold text-purple-900 mb-12">
              أهداف الاختبار
            </h2>
            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
              يهدف هذا المقياس إلى تقييم درجة التوافق بين الشريكين قبل الزواج من خلال استكشاف الجوانب النفسية
              والاجتماعية والسلوكية.
            </p>
          </div>
        </section>

        <section class="py-8 px-4 sm:px-8 lg:px-16 space-y-6">
          <div class="container mx-auto px-4">
            <h2 class="section-title text-3xl font-bold text-purple-900 mb-8">
              برنامج الزواج الشرعي
            </h2>
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-100 p-6 rounded-2xl shadow-lg">
              <div class="flex flex-col items-center text-center p-4 rounded-2xl bg-white">
                <div
                  class="w-16 h-16 bg-gradient-to-r from-purple-50 to-pink-50 rounded-full flex items-center justify-center mb-6">
                  <i class="fas fa-heart text-purple-900 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-purple-900 mb-4">
                  ابدأ رحلتك نحو زواج سعيد
                </h3>
                <p class="text-gray-700 leading-relaxed text-lg max-w-2xl mb-8">
                  انضم إلى برنامج الزواج الشرعي، حيث نضمن لك تجربة آمنة وموثوقة للعثور على شريك حياتك. استمتع بالخصوصية
                  الكاملة والتوجيه في كل خطوة.
                </p>
                <a href="{{ route('marriage-requests.index') }}"
                  class="bg-[#d4b341] hover:bg-yellow-700 text-white px-6 py-3 rounded-3xl transition-colors text-sm sm:text-base">
                  <i class="fas fa-user-friends ml-2"></i>
                  انضم الآن
                </a>
              </div>
            </div>
          </div>
        </section>
        <section class="my-16 px-4 sm:px-8 lg:px-16">
          <div
            class="rounded-3xl p-6 border-2 flex flex-col items-center justify-center gap-12 bg-cover bg-center min-h-[250px]"
            style="background-image: url('assets/images/frame.png');">
            <div class="text-center md:text-right bg-white bg-opacity-80 p-4 pb-0 rounded-lg">
              <h3 class="text-[#58306D] font-bold text-2xl mb-2">انضم الآن لعضوية الموقع</h3>
              <p class="text-[#58306D] text-sm sm:text-base leading-relaxed">
                احصل على كافة الخدمات مجاناً في المستقبل وحاليًا جرب مقياس التوافق الزواجي المميز.
              </p>
            </div>
            <div class="mt-2 md:mt-0">
              <a href="{{ route('register') }}"
                class="bg-[#d4b341] hover:bg-yellow-700 text-white px-6 py-3 rounded-3xl transition-colors text-sm sm:text-base">
                تسجيل عضوية
              </a>
            </div>
          </div>
        </section>

        <footer class="bg-purple-900 text-white pt-12">
          <div class="container mx-auto px-12">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-14 border-b border-purple-800 pb-12">
              <div class="md:col-span-2">
                <h4 class="text-xl font-bold mb-6">عن الموقع</h4>
                <p class="text-gray-300">
                  هو منصة إلكترونية يديرها د.حمود النوفلي من سلطنة عمان، ويقدم فيها خدمات مجانية في كل ما يحتاج له
                  الشباب
                  المقبلين على
                  الزواج والمتزوجين حديثاً، من تأهيل واستشارات وخدمات ومقاييس ودورات وكتب تمكنهم من بناء حياة أسرية
                  سعيدة
                  بعيداً عن
                  المشكلات و التفكك الأسري.
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
                    info@zawaj-almawada.com
                  </li>
                </ul>
              </div>

              <div>
                <h4 class="text-xl font-bold mb-6">تابعنا</h4>
                <div class="flex space-x-2 gap-4">
                  <a href="https://www.instagram.com/hamoodalnoofli/" class="social-icon hover:-translate-y-1"
                    target="_blank">
                    <i class="fab fa-instagram"></i>
                  </a>
                  <a href="https://x.com/molhim399?s=08" class="social-icon hover:-translate-y-1">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a href="https://www.youtube.com/channel/UC6pJW3_VsKH1M1NqbkeYITQ"
                    class="social-icon hover:-translate-y-1" target="_blank">
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
    </main>
  </div>
  @else
  {{-- ==== GUEST/USER LAYOUT ==== --}}
  <div class="min-h-screen">
    @include('layouts.navigation')

    <section class="relative islamic-pattern p-4 md:p-14">
      @auth
      @if(!in_array(Auth::user()->status, ['available', 'engaged']))
      <section class="py-0 px-4 sm:px-8 lg:px-16">
        <div class="container mx-auto px-4">
          <div class="bg-gradient-to-br from-purple-50 to-blue-50 border border-purple-100 p-8 rounded-2xl shadow-lg">
            <div class="flex items-start">
              <div class="flex-shrink-0 pt-1">
                <i class="fas fa-hourglass-half text-[#d4b341] text-2xl"></i>
              </div>
              <div class="mr-3 flex items-center justify-between gap-2 w-full flex-wrap">
                <div>
                  <h3 class="text-xl font-bold text-purple-900">طلب خطوبة نشط</h3>
                  <div class="mt-2 text-gray-700">
                    <p>لديك طلب خطوبة نشط مع
                      <span class="font-medium">
                        @if($marriageRequest)
                        {{ $marriageRequest->user_id === Auth::id() ? $marriageRequest->target->name :
                        $marriageRequest->user->name ?? 'غير محدد' }}
                        @else
                        غير محدد
                        @endif
                      </span>
                    </p>
                  </div>
                </div>
                <div class="mt-4">
                  <a href="{{ route('marriage-requests.status') }}"
                    class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-sm font-medium rounded-lg transition-all transform hover:scale-105 shadow-md">
                    <i class="fas fa-clock ml-2"></i>
                    متابعة حالة الطلب
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      @endif
      @endauth
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
          <a href="{{ route('exam.pledge') }}" class="inline-block">
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
            <h3 class="text-xl font-bold text-purple-900 mb-3">شعار المقياس</h3>
            <p class="text-gray-700">إذا احسنت الاختيار ستنعم بالاستقرار</p>
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
      <div class="container mx-auto px-4">
        <h2 class="section-title text-3xl font-bold text-purple-900 mb-12">
          أهداف الاختبار
        </h2>
        <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
          يهدف هذا المقياس إلى تقييم درجة التوافق بين الشريكين قبل الزواج من خلال استكشاف الجوانب النفسية
          والاجتماعية والسلوكية.
        </p>
      </div>
    </section>

    <section class="py-8 px-4 sm:px-8 lg:px-16 space-y-6">
      <div class="container mx-auto px-4">
        <h2 class="section-title text-3xl font-bold text-purple-900 mb-8">
          برنامج الزواج الشرعي
        </h2>
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-100 p-6 rounded-2xl shadow-lg">
          <div class="flex flex-col items-center text-center p-4 rounded-2xl bg-white">
            <div
              class="w-16 h-16 bg-gradient-to-r from-purple-50 to-pink-50 rounded-full flex items-center justify-center mb-6">
              <i class="fas fa-heart text-purple-900 text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-purple-900 mb-4">
              ابدأ رحلتك نحو زواج سعيد
            </h3>
            <p class="text-gray-700 leading-relaxed text-lg max-w-2xl mb-8">
              انضم إلى برنامج الزواج الشرعي، حيث نضمن لك تجربة آمنة وموثوقة للعثور على شريك حياتك. استمتع بالخصوصية
              الكاملة والتوجيه في كل خطوة.
            </p>
            <a href="{{ route('marriage-requests.index') }}"
              class="bg-[#d4b341] hover:bg-yellow-700 text-white px-6 py-3 rounded-3xl transition-colors text-sm sm:text-base">
              <i class="fas fa-user-friends ml-2"></i>
              انضم الآن
            </a>
          </div>
        </div>
      </div>
    </section>
    <section class="my-16 px-4 sm:px-8 lg:px-16">
      <div
        class="rounded-3xl p-6 border-2 flex flex-col items-center justify-center gap-12 bg-cover bg-center min-h-[250px]"
        style="background-image: url('assets/images/frame.png');">
        <div class="text-center md:text-right bg-white bg-opacity-80 p-4 pb-0 rounded-lg">
          <h3 class="text-[#58306D] font-bold text-2xl mb-2">انضم الآن لعضوية الموقع</h3>
          <p class="text-[#58306D] text-sm sm:text-base leading-relaxed">
            احصل على كافة الخدمات مجاناً في المستقبل وحاليًا جرب مقياس التوافق الزواجي المميز.
          </p>
        </div>
        <div class="mt-2 md:mt-0">
          <a href="{{ route('register') }}"
            class="bg-[#d4b341] hover:bg-yellow-700 text-white px-6 py-3 rounded-3xl transition-colors text-sm sm:text-base">
            تسجيل عضوية
          </a>
        </div>
      </div>
    </section>

    <footer class="bg-purple-900 text-white pt-12">
      <div class="container mx-auto px-12">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-14 border-b border-purple-800 pb-12">
          <div class="md:col-span-2">
            <h4 class="text-xl font-bold mb-6">عن الموقع</h4>
            <p class="text-gray-300">
              هو منصة إلكترونية يديرها د.حمود النوفلي من سلطنة عمان، ويقدم فيها خدمات مجانية في كل ما يحتاج له الشباب
              المقبلين على
              الزواج والمتزوجين حديثاً، من تأهيل واستشارات وخدمات ومقاييس ودورات وكتب تمكنهم من بناء حياة أسرية سعيدة
              بعيداً عن
              المشكلات و التفكك الأسري.
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
                info@zawaj-almawada.com
              </li>
            </ul>
          </div>

          <div>
            <h4 class="text-xl font-bold mb-6">تابعنا</h4>
            <div class="flex space-x-2 gap-4">
              <a href="https://www.instagram.com/hamoodalnoofli/" class="social-icon hover:-translate-y-1"
                target="_blank">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="https://x.com/molhim399?s=08" class="social-icon hover:-translate-y-1">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="https://www.youtube.com/channel/UC6pJW3_VsKH1M1NqbkeYITQ"
                class="social-icon hover:-translate-y-1" target="_blank">
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
  @endif

  <script>
    $(document).ready(function() {
      $('#menu-toggle').click(function() {
        $('#mobile-menu').slideToggle(300);
      });
    });
  </script>
</body>

</html>