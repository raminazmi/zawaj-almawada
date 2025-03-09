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
    <div class="mt-4 flex justify-center gap-4">
      <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-8 text-center max-w-2xl mx-auto">
        <p>أنت متزوج بالفعل من {{
          Auth::user()->activeMarriageRequest()
          ? Auth::user()->activeMarriageRequest()->target->name
          : Auth::user()->targetMarriageRequest()->user->name
          }} ولا يمكنك تقديم طلبات جديدة.</p>
      </div>
    </div>
    @else
    <div class="mt-4 flex justify-center gap-4">
      <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-8 text-center max-w-2xl mx-auto">
        <p class="text-lg">
          لديك طلب بالفعل من {{
          Auth::user()->activeMarriageRequest()
          ? Auth::user()->activeMarriageRequest()->target->name
          : Auth::user()->targetMarriageRequest()->user->name
          }} ولا يمكنك تقديم طلبات جديدة.
        </p>
      </div>
    </div>
    @endif
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
      <a href="{{ route('marriage-requests.boys') }}"
        class="group bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
        <div class="p-6">
          <div class="flex justify-center">
            <img src="/assets/images/man.png" alt="man-image" class="w-48 h-48 object-contain">
          </div>
          <div class="mt-6 text-center">
            <h3 class="text-2xl font-bold text-[#0071BC]">نموذج طلب الزواج للشاب</h3>
            <p class="mt-2 text-gray-600">ابدأ رحلتك نحو الزواج الشرعي</p>
          </div>
        </div>
      </a>

      <a href="{{ route('marriage-requests.girls') }}"
        class="group bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
        <div class="p-6">
          <div class="flex justify-center">
            <img src="/assets/images/girl.png" alt="girl-image" class="w-48 h-48 object-contain">
          </div>
          <div class="mt-6 text-center">
            <h3 class="text-2xl font-bold text-[#0071BC]">نموذج طلب الزواج للفتاة</h3>
            <p class="mt-2 text-gray-600">ابدأ رحلتك نحو الزواج الشرعي</p>
          </div>
        </div>
      </a>
    </div>
    @endif
  </div>
</section>
@endsection