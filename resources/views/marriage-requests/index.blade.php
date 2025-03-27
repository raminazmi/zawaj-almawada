@extends('layouts.app')

@section('content')
<section class="min-h-screen py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-4xl font-bold text-purple-800 inline-block relative">
        برنامج الزواج الشرعي
      </h2>
    </div>

    @if(Auth::user()->status === 'engaged' || Auth::user()->status === 'pending')
    @if(Auth::user()->status === 'engaged')
    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-8 text-center">
      <p>تمت خطوبتك بالفعل مع
        @if(Auth::user()->activeMarriageRequest)
        {{ Auth::user()->activeMarriageRequest->target->name ?? 'غير محدد' }}
        @elseif(Auth::user()->targetMarriageRequest)
        {{ Auth::user()->targetMarriageRequest->user->name ?? 'غير محدد' }}
        @else
        غير محدد
        @endif
        ولا يمكنك تقديم طلبات جديدة.
      </p>
    </div>
    @elseif(Auth::user()->status !== 'available')
    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-8 text-center">
      <p>لديك طلب خطوبة نشط بالفعل مع
        @if(Auth::user()->activeMarriageRequest)
        {{ Auth::user()->activeMarriageRequest->target->name ?? 'غير محدد' }}
        @elseif(Auth::user()->targetMarriageRequest)
        {{ Auth::user()->targetMarriageRequest->user->name ?? 'غير محدد' }}
        @else
        غير محدد
        @endif
        ولا يمكنك تقديم طلبات جديدة.
      </p>
      <a href="{{ route('marriage-requests.status') }}"
        class="mt-4 inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all shadow-md hover:shadow-lg">
        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        حالة طلباتي
      </a>
    </div>
    @endif
    @else

    <div class="grid grid-cols-1 md:grid-cols-1 gap-8 max-w-4xl mx-auto">
      @if(Auth::user()->gender === "male")
      <div>
      </div>
      @else
      <a href="{{ route('marriage-requests.boys') }}"
        class="group bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
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
    @endif
  </div>
</section>
@endsection