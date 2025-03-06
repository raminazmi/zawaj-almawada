@extends('layouts.app')

@section('content')
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
@endsection