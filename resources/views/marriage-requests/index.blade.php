@extends('layouts.app')

@section('content')
<section class="min-h-screen py-4">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-purple-800 inline-block relative">
        برنامج الزواج الشرعي
      </h2>
    </div>
    <div class="mb-4 flex justify-center gap-4 flex-wrap">
      <a href="{{ route('marriage-requests.status') }}"
        class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
        <i class="fas fa-tasks ml-2"></i>
        حالة طلباتي
      </a>

      @if(!$isProfileComplete || Auth::user()->profile_status !== 'approved')
      <a href="{{ route('profile.edit') }}"
        class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
        <i class="fas fa-user-edit ml-2"></i>
        إكمال الملف الشخصي
      </a>
      @endif
    </div>
    <div class="grid grid-cols-1 md:grid-cols-1 gap-8 max-w-4xl mx-auto">
      @if(Auth::user()->gender === "male")
      <div>
      </div>
      @else
      <a href="{{ route('marriage-requests.boys') }}"
        class="mt-10 group bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
        <div class="p-6">
          <div class="flex justify-center">
            <img src="/assets/images/man.png" alt="man-image" class="w-48 h-48 object-contain">
          </div>
          <div class="mt-6 text-center">
            <h3 class="text-2xl font-bold text-[#0071BC]">نموذج طلب زواج من شاب</h3>
            <p class="mt-2 text-gray-600">ابدأ رحلتك نحو الزواج الشرعي</p>
          </div>
        </div>
      </a>
      @endif
      @if(Auth::user()->gender === "female")
      <div>
      </div>
      @else
      <a href="{{ route('marriage-requests.girls') }}"
        class="group bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
        <div class="p-6">
          <div class="flex justify-center">
            <img src="/assets/images/girl.png" alt="girl-image" class="w-48 h-48 object-contain">
          </div>
          <div class="mt-6 text-center">
            <h3 class="text-2xl font-bold text-[#0071BC]">نموذج طلب زواج من فتاة</h3>
            <p class="mt-2 text-gray-600">ابدأ رحلتك نحو الزواج الشرعي</p>
          </div>
        </div>
      </a>
      @endif
    </div>
  </div>
</section>
@endsection