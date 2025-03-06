@extends('layouts.app')

@section('content')
<section class="flex justify-start items-center flex-col h-screen  md:p-14 ">
  <h2 class="text-3xl font-bold mb-4 text-center text-purple-800 border-b-[3px] pb-3 border-[#d4b341]">برنامج الزواج
    الشرعي</h2>
  <div class="flex justify-between items-center mt-8 gap-16">
    <div
      class="flex justify-center items-center flex-col bg-white w-[250px] p-4 border-2 border-[#d4b341] rounded-2xl transition duration-300 ease-in-out transform hover:scale-105 shadow-xl cursor-pointer">
      <img src="/assets/images/man.png" class="w-[240px]" alt="man-image">
      <h3 class="text-base mt-2 font-bold text-center text-[#0071BC]">نموذج طلب الزواج للشاب</h3>
    </div>
    <div
      class="flex justify-center items-center flex-col bg-white w-[250px] p-4 border-2 border-[#d4b341] rounded-2xl transition duration-300 ease-in-out transform hover:scale-105 shadow-xl cursor-pointer">
      <img src="/assets/images/girl.png" class="w-[240px]" alt="man-image">
      <h3 class="text-base mt-2 font-bold text-center text-[#0071BC]">نموذج طلب الزواج للفتاة</h3>
    </div>
  </div>
</section>

@endsection