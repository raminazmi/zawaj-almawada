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
  <section class="relative">
    <div class="bg-cover bg-center min-h-[550px] py-12" style="background-image: url('assets/images/frame.png');">
      <div class="flex items-center justify-center flex-col min-h-screen">
        <div id="success-message" class="hidden text-green-600 text-center font-bold my-2">
          تم إرسال الرسالة بنجاح!
        </div>
        <form id="consultation-form" class="w-full max-w-md p-6 rounded-lg shadow-md mx-4">
          <h2 class="text-2xl font-bold mb-4 text-center text-gray-700 ">طلب استشارة شرعية</h2>
          <input type="hidden" name="access_key" value="f17d3654-79d0-4455-8d62-1ccd3d5e9900">
          <div class="mb-4">
            <label for="email" class="block text-gray-600 font-medium">البريد الإلكتروني</label>
            <input type="email" id="email" name="email" required placeholder="ادخل بريدك الإلكتروني ..."
              class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 placeholder:text-xs">
          </div>
          <div class="mb-4">
            <label for="message" class="block text-gray-600 font-medium mb-2">اطرح هنا مشكلتك أو سؤالك</label>
            <textarea id="message" name="message" required rows="4"
              placeholder="اكتب مشكلتك او اطرح سؤالك بشكل واضح ..."
              class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 placeholder:text-xs"></textarea>
          </div>
          <input type="checkbox" name="botcheck" class="hidden">

          <button type="submit" class="w-full bg-purple-900 text-white py-2 rounded-md hover:bg-blue-600 transition">
            إرسال
          </button>
        </form>
        <div class="p-2 mt-8 w-[440px] border-2 border-[#d4b341] rounded-xl">
          <span class="text-purple-900 flex justify-start items-center">
            <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision"
              text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd"
              clip-rule="evenodd" class="w-4 h-4 text-purple-900" viewBox="0 0 412 511.87">
              <path fill-rule="nonzero"
                d="M35.7 32.95h33.54V11.18C69.24 5.01 74.25 0 80.43 0c6.17 0 11.18 5.01 11.18 11.18v21.77h49.21V11.18c0-6.17 5.01-11.18 11.19-11.18 6.17 0 11.18 5.01 11.18 11.18v21.77h49.21V11.18C212.4 5.01 217.41 0 223.59 0c6.17 0 11.18 5.01 11.18 11.18v21.77h49.21V11.18c0-6.17 5.01-11.18 11.19-11.18 6.17 0 11.18 5.01 11.18 11.18v21.77h34.55c9.83 0 18.76 4.03 25.21 10.49 5.36 5.35 9.04 12.4 10.15 20.23h.04c9.82 0 18.76 4.03 25.21 10.48C407.98 80.62 412 89.56 412 99.37v376.8c0 9.77-4.04 18.7-10.49 25.17-6.51 6.5-15.45 10.53-25.21 10.53H67.71c-9.81 0-18.75-4.02-25.22-10.49-6.14-6.14-10.09-14.53-10.45-23.8-8.36-.86-15.9-4.66-21.55-10.31C4.03 460.82 0 451.89 0 442.06V68.65c0-9.83 4.03-18.77 10.48-25.22 6.45-6.45 15.39-10.48 25.22-10.48zm340.9 51.06v358.05c0 9.8-4.03 18.74-10.49 25.2-6.47 6.47-15.41 10.5-25.21 10.5H52.43c.39 3.59 2.01 6.82 4.44 9.25 2.79 2.79 6.64 4.53 10.84 4.53H376.3c4.22 0 8.07-1.74 10.85-4.52 2.78-2.78 4.52-6.63 4.52-10.85V99.37c0-4.2-1.74-8.05-4.54-10.84a15.334 15.334 0 0 0-10.53-4.52zm-294 302.37c-5.74 0-10.4-4.86-10.4-10.85 0-5.99 4.66-10.85 10.4-10.85h214.78c5.74 0 10.41 4.86 10.41 10.85 0 5.99-4.67 10.85-10.41 10.85H82.6zm0-71.58c-5.74 0-10.4-4.86-10.4-10.85 0-5.99 4.66-10.85 10.4-10.85h214.78c5.74 0 10.41 4.86 10.41 10.85 0 5.99-4.67 10.85-10.41 10.85H82.6zm0-71.58c-5.74 0-10.4-4.86-10.4-10.85 0-5.99 4.66-10.85 10.4-10.85h214.78c5.74 0 10.41 4.86 10.41 10.85 0 5.99-4.67 10.85-10.41 10.85H82.6zm0-71.58c-5.74 0-10.4-4.86-10.4-10.85 0-5.99 4.66-10.85 10.4-10.85h214.78c5.74 0 10.41 4.86 10.41 10.85 0 5.99-4.67 10.85-10.41 10.85H82.6zM306.35 53.28v21.77c0 6.17-5.01 11.18-11.18 11.18-6.18 0-11.19-5.01-11.19-11.18V53.28h-49.21v21.77c0 6.17-5.01 11.18-11.18 11.18-6.18 0-11.19-5.01-11.19-11.18V53.28h-49.21v21.77c0 6.17-5.01 11.18-11.18 11.18-6.18 0-11.19-5.01-11.19-11.18V53.28H91.61v21.77c0 6.17-5.01 11.18-11.18 11.18-6.18 0-11.19-5.01-11.19-11.18V53.28H35.7c-4.22 0-8.07 1.75-10.85 4.52-2.77 2.78-4.52 6.63-4.52 10.85v373.41c0 4.2 1.75 8.05 4.53 10.84 2.8 2.79 6.65 4.53 10.84 4.53h305.2c4.19 0 8.03-1.75 10.83-4.54 2.79-2.8 4.54-6.65 4.54-10.83V68.65c0-4.19-1.74-8.04-4.53-10.84-2.79-2.78-6.64-4.53-10.84-4.53h-34.55z" />
            </svg>
            ملاحظة:
          </span>
          <span class="text-sm">
            يرجى التأكد من إدخال البريد الإلكتروني بشكل صحيح حتى يتمكن المختص من التواصل معك. ✅
          </span>
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
            <a href="https://www.instagram.com/hamoodalnoofli/" class="social-icon hover:-translate-y-1"
              target="_blank">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="https://x.com/molhim399?s=08" class="social-icon hover:-translate-y-1">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.youtube.com/channel/UC6pJW3_VsKH1M1NqbkeYITQ" class="social-icon hover:-translate-y-1"
              target="_blank">
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

        document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("consultation-form");
    const successMessage = document.getElementById("success-message");

    form.addEventListener("submit", async function (event) {
      event.preventDefault(); // منع إعادة التوجيه الافتراضي
      const formData = new FormData(form);

      try {
        const response = await fetch("https://api.web3forms.com/submit", {
          method: "POST",
          body: formData
        });

        const result = await response.json(); // قراءة الاستجابة كـ JSON

        if (result.success) {
          successMessage.classList.remove("hidden"); // إظهار رسالة النجاح
          form.reset(); // إعادة تعيين النموذج بعد الإرسال الناجح
        } else {
          alert("❌ حدث خطأ أثناء الإرسال: " + result.message);
        }
      } catch (error) {
        alert("❌ حدث خطأ أثناء الاتصال بالسيرفر.");
      }
    });
  });
  </script>
</body>

</html>