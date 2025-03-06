@extends('layouts.app')

@section('content')
<section class="relative">
  <div class="bg-cover bg-center min-h-[550px] py-12" style="background-image: url('assets/images/frame.png');">
    <div class="flex items-center justify-center flex-col min-h-screen">
      <div id="success-message" class="hidden text-green-600 text-center font-bold my-2">
        تم إرسال الرسالة بنجاح!
      </div>
      <form id="consultation-form" class="w-full max-w-md p-6 rounded-lg shadow-md mx-4">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700 ">طلب استشارة قانونية</h2>
        <input type="hidden" name="access_key" value="f17d3654-79d0-4455-8d62-1ccd3d5e9900">
        <div class="mb-4">
          <label for="email" class="block text-gray-600 font-medium">البريد الإلكتروني</label>
          <input type="email" id="email" name="email" required placeholder="ادخل بريدك الإلكتروني ..."
            class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 placeholder:text-xs">
        </div>
        <div class="mb-4">
          <label for="message" class="block text-gray-600 font-medium mb-2">اطرح هنا مشكلتك أو سؤالك</label>
          <textarea id="message" name="message" required rows="4" placeholder="اكتب مشكلتك او اطرح سؤالك بشكل واضح ..."
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
@endsection