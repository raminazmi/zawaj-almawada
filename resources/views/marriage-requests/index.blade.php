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
    @if(Auth::user()->status === 'engaged' || Auth::user()->status === 'pending')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      @if(Auth::user()->status === 'engaged')
      <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-2xl shadow-lg mb-8 border border-green-100">
        <div class="text-center space-y-4">
          <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
            <i class="fas fa-check-circle text-green-600 text-3xl"></i>
          </div>
          <h2 class="text-2xl font-bold text-gray-800">مبروك! تمت الخطوبة بنجاح</h2>
          <p class="text-lg text-emerald-600 font-medium">{{ $partner->name ?? 'غير محدد' }}</p>
        </div>

        @if($partner)
        <div class="mt-8 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
          <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-user-circle text-blue-500"></i>
            بيانات الطرف الآخر
          </h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <div class="space-y-2">
              <label class="text-sm text-gray-500">الاسم الكامل</label>
              <p class="font-medium">{{ $partner->name }}</p>
            </div>
            <div class="space-y-2">
              <label class="text-sm text-gray-500">البلد</label>
              <p class="font-medium">{{ $partner->country }}</p>
            </div>
            <div class="space-y-2">
              <label class="text-sm text-gray-500">الولاية</label>
              <p class="font-medium">{{ $partner->state }}</p>
            </div>
            <div class="space-y-2">
              <label class="text-sm text-gray-500">القبيلة</label>
              <p class="font-medium">{{ $partner->tribe }}</p>
            </div>
          </div>

          @if($testResult)
          <div class="mt-8 pt-6 border-t border-gray-100">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">
              <i class="fas fa-chart-pie text-emerald-500 mr-2"></i>
              نتائج اختبار التوافق
            </h4>
            <div class="space-y-4">
              <div class="flex items-center justify-between">
                <span class="text-gray-600">نسبة التوافق</span>
                <span class="text-xl font-bold text-emerald-600">{{ $testResult }}%</span>
              </div>
              <div class="bg-gray-100 rounded-full h-2.5">
                <div class="bg-emerald-500 h-2.5 rounded-full" style="width: {{ $testResult }}%"></div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-blue-50 p-4 rounded-lg">
                  <p class="text-sm text-blue-800">
                    <i class="fas fa-male text-blue-600 mr-1"></i>
                    النقاط الحاسمة للخاطب : {{ $maleImportantScore['score'] }}/{{
                    $maleImportantScore['total'] }}
                  </p>
                </div>
                <div class="bg-pink-50 p-4 rounded-lg">
                  <p class="text-sm text-pink-800">
                    <i class="fas fa-female text-pink-600 mr-1"></i>
                    النقاط الحاسمة للمخطوبة : {{ $femaleImportantScore['score'] }}/{{
                    $femaleImportantScore['total'] }}
                  </p>
                </div>
              </div>
            </div>
          </div>
          @else
          @if($marriageRequest->compatibility_test_link)
          <div class="mt-8 text-center bg-indigo-50 p-6 rounded-xl">
            <div class="max-w-md mx-auto">
              <h4 class="text-lg font-semibold text-gray-800 mb-2">
                <i class="fas fa-clipboard-check text-indigo-600 mr-2"></i>
                اختبار التوافق
              </h4>
              <p class="text-sm text-gray-600 mb-4">هذا الاختبار ضروري لإتمام عملية الموافقة على الطلب</p>
              <a href="{{ $marriageRequest->compatibility_test_link }}"
                class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-all transform hover:scale-105 shadow-md">
                <i class="fas fa-play-circle ml-2"></i>
                بدء الاختبار الآن
              </a>
            </div>
          </div>
          @endif
          @endif
        </div>
        @endif

        <div class="mt-8 text-center">
          <p class="text-sm text-gray-500">
            <i class="fas fa-envelope mr-1"></i>
            تم إرسال التفاصيل الكاملة إلى بريدك الإلكتروني
          </p>
        </div>
      </div>

      @elseif(Auth::user()->status !== 'available')
      <div class="bg-orange-50 border-l-4 border-orange-400 p-6 rounded-xl shadow-sm mb-8">
        <div class="flex items-start">
          <div class="flex-shrink-0 pt-1">
            <i class="fas fa-exclamation-triangle text-orange-400 text-xl"></i>
          </div>
          <div class="ml-3 flex-1">
            <h3 class="text-lg font-medium text-gray-800">طلب قيد المراجعة</h3>
            <div class="mt-2 text-gray-600">
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
            <div class="mt-4">
              <a href="{{ route('marriage-requests.status') }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">
                <i class="fas fa-clock mr-2"></i>
                متابعة حالة الطلب
              </a>
            </div>
          </div>
        </div>
      </div>
      @endif
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