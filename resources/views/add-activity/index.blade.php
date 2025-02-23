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
  @if (auth()->check())
  @if (auth()->user()->is_admin)
  @include('admin.navigation')
  @else
  @include('layouts.navigation')
  @endif
  @else
  @include('home.navigation')
  @endif

  <section class="flex justify-center items-center flex-col  md:p-14 ">

  </section>
  <section class="relative">
    <div class="bg-cover bg-center bg-white py-2 lg:-mt-[109px] flex items-center justify-center min-h-screen"
      style="background-image: url('/assets/images/frame.png');">
      <form id="contact-form" action="{{ route('business-activities.store') }}" method="POST"
        class="w-full max-w-md p-6 rounded-lg shadow-md mx-4">
        @csrf
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">اضف نشاطك</h2>

        @if(session('success'))
        <p class="text-green-600 text-center mt-4">✅ {{ session('success') }}</p>
        @endif

        @if(session('error'))
        <p class="text-red-600 text-center mt-4">❌ {{ session('error') }}</p>
        @endif

        <div class="mb-4">
          <label for="name" class="block text-gray-600 font-medium mb-2">اسم المحل</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}"
            class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 @error('name') border-red-500 @enderror">
          @error('name')
          <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-4">
          <label for="phone" class="block text-gray-600 font-medium mb-2">رقم الهاتف</label>
          <input type="number" id="phone" name="phone" value="{{ old('phone') }}"
            class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 @error('phone') border-red-500 @enderror">
          @error('phone')
          <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-4">
          <label for="activity_type" class="block text-gray-600 font-medium mb-2">نوع النشاط</label>
          <select id="activity_type" name="activity_type"
            class="w-full pr-8 min-w-[90px] pl-2 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 @error('activity_type') border-red-500 @enderror">
            <option value="" selected disabled>اختر نوع النشاط</option>
            <option value="محلات تأجير الخيام" {{ old('activity_type')==='محلات تأجير الخيام' ? 'selected' : '' }}>محلات
              تأجير
              الخيام</option>
            <option value="محلات تأجير القاعات" {{ old('activity_type')==='محلات تأجير القاعات' ? 'selected' : '' }}>
              محلات تأجير
              القاعات</option>
            <option value="محلات الأثاث" {{ old('activity_type')==='محلات الأثاث' ? 'selected' : '' }}>محلات الأثاث
            </option>
            <option value="مستلزمات الأعراس" {{ old('activity_type')==='مستلزمات الأعراس' ? 'selected' : '' }}>مستلزمات
              الأعراس
            </option>
            <option value="محلات التصميم والتصوير" {{ old('activity_type')==='محلات التصميم والتصوير' ? 'selected' : ''
              }}>محلات
              التصميم والتصوير</option>
            <option value="مطاعم تقديم الولائم" {{ old('activity_type')==='مطاعم تقديم الولائم' ? 'selected' : '' }}>
              مطاعم تقديم
              الولائم</option>
          </select>
          @error('activity_type')
          <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-4">
          <label for="state" class="block text-gray-600 font-medium mb-2">الولاية</label>
          <textarea id="state" name="state" rows="1"
            class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 @error('state') border-red-500 @enderror">{{ old('state') }}</textarea>
          @error('state')
          <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-4">
          <label class="block text-gray-600 font-medium mb-2">
            هل مستعد لتقديم جوائز للشباب مقابل الترويج للمحل في الموقع والدورات؟
          </label>
          <div class="flex items-center gap-4 mt-4">
            <label class="flex items-center">
              <input type="radio" name="rewards" value="yes" class="ml-2" {{ old('rewards')==='yes' ? 'checked' : '' }}>
              نعم
            </label>
            <label class="flex items-center">
              <input type="radio" name="rewards" value="no" class="ml-2" {{ old('rewards')==='no' ? 'checked' : '' }}>
              لا
            </label>
          </div>
          @error('rewards')
          <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <input type="checkbox" name="botcheck" class="hidden">

        <button type="submit" class="w-full bg-purple-900 text-white py-2 rounded-md hover:bg-blue-600 transition">
          إرسال
        </button>
      </form>
    </div>
  </section>

  <footer class="bg-purple-900 text-white pt-12 ">
    <div class="container mx-auto px-12">
      <div class="grid grid-cols-1 md:grid-cols-5 gap-14 border-b border-purple-800 pb-12">
        <div class="md:col-span-2">
          <h4 class="text-xl font-bold mb-6">عن الموقع</h4>
          <p class="text-gray-300">
            هو منصة إلكترونية يديرها د.حمود النوفلي من سلطنة عمان، ويقدم فيها خدمات مجانية في كل ما يحتاج له
            الشباب
            المقبلين على
            الزواج والمتزوجين حديثاً، من تأهيل واستشارات وخدمات ومقاييس ودورات وكتب تمكنهم من بناء حياة
            أسرية سعيدة
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
