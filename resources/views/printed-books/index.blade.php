@extends('layouts.app')

@section('content')
<section class="flex justify-center items-center flex-col gap-12 p-4 md:p-14 ">
  <h2 class="font-bold text-purple-700 text-3xl border-b-4 border-[#d4b341] ">
    الكتب المطبوعة
  </h2>
</section>
<section class="relative">
  <div class="bg-cover bg-center min-h-[550px] py-12" style="background-image: url('assets/images/frame.png');">
    <div class="flex justify-center flex-wrap items-center gap-8 ">
      <div class="bg-white lg:w-[320px] w-[250px] p-2 border-2 border-purple-700 rounded-xl gold-btn2 ">
        <img src="/assets/images/book1.jpg" class="lg:w-[300px] w-[250px] h-[200px] lg:h-[335px]  rounded-xl"
          alt="book1.jpg">
        <h4 class="p-2 text-lg font-bold text-purple-950 pt-4">كتاب أقدام حافية</h4>
        <p class="text-xs p-2">
          أقدام حافية من القصص والروايات، لتقديم ما فيه صلاحٌ للنشء من الأدب الجميل الراقي، الخالي من أيِّ شيءٍ غير
          مناسب.
        </p>
        <a href="https://wa.me/96877156674" target="_blank" rel="noopener noreferrer">
          <button class="bg-[#d4b341] p-4 text-white w-full rounded-xl gold-btn">اطلب الكتاب الآن</button>
        </a>
      </div>
      <div class="bg-white lg:w-[320px] w-[250px] p-2 border-2 border-purple-700 rounded-xl gold-btn2 ">
        <img src="/assets/images/book3.jpg" class="lg:w-[300px] w-[250px] h-[200px] lg:h-[350px] rounded-xl"
          alt="book1.jpg">
        <h4 class="p-2 text-lg font-bold text-purple-950 pt-4">كتاب الطريق إلى السعادة</h4>
        <p class="text-xs p-2">
          يتضمن الكتاب نصائح موجزة تعبر عن كيفية التعامل مع الحياه
          في عدة مجالات الحياه وكيفية التعامل مع مشاكلها.
        </p>
        <a href="https://wa.me/96877156674" target="_blank" rel="noopener noreferrer">
          <button class="bg-[#d4b341] p-4 text-white w-full rounded-xl gold-btn ">اطلب الكتاب الآن</button>
        </a>
      </div>
      <div class="bg-white lg:w-[320px] w-[250px] p-2 border-2 border-purple-700 rounded-xl gold-btn2 ">
        <img src="/assets/images/book2.jpg" class="lg:w-[300px] w-[250px] h-[180px] lg:h-[330px]  rounded-xl"
          alt="book1.jpg">
        <h4 class="p-2 text-base font-bold text-purple-950 pt-4">كتاب 700 نصيحة ذهبية لحياتك الأسرية والزوجية</h4>
        <p class="text-xs p-2">
          نصائح مختصرة دقيقة، تركز على الجوانب الأسرية، الأخلاقية، الدينية
          نصائح متناثرة في موضوعات الحياة المختلفة </p>
        <a href="https://wa.me/96877156674" target="_blank" rel="noopener noreferrer">
          <button class="bg-[#d4b341] p-4 text-white w-full rounded-xl gold-btn ">اطلب الكتاب الآن</button>
        </a>
      </div>
    </div>
  </div>
</section>
@endsection