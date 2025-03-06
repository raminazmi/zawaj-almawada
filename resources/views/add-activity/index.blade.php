@extends('layouts.app')

@section('content')
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
@endsection