@extends('layouts.app')

@section('content')
<div>
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-[#3A8BCD]/20 text-center">
            <img src="{{ asset('assets/images/logo.png') }}" alt="شعار الموقع" class="w-20 h-20 mx-auto mb-4">
            <h2 class="text-3xl font-extrabold text-[#2A5C82] mb-2" style="font-family: 'Almarai', sans-serif;">
                نتيجة الاختبار
            </h2>
            <div class="mb-6">
                <h4 class="text-xl font-bold text-[#553566] mb-2">{{ $result->exam->title }}</h4>
                <div class="flex flex-col items-center gap-2 text-gray-600 text-base mb-4">
                    <span><strong>اسم المستخدم:</strong> {{ $result->user->name }}</span>
                    <span><strong>تاريخ التقديم:</strong> {{ $result->created_at->format('Y-m-d H:i') }}</span>
                </div>
                <div class="my-6">
                    <span
                        class="inline-block bg-[#d4edda] text-[#155724] text-lg font-bold px-8 py-3 rounded-full shadow">
                        الدرجة النهائية: {{ $result->score }}
                    </span>
                </div>
            </div>
            <a href="{{ route('course-exams.index') }}"
                class="inline-block bg-gradient-to-l from-[#3A8BCD] to-[#553566] text-white px-8 py-3 rounded-full text-lg font-bold shadow-lg hover:opacity-90 transition">
                العودة للاختبارات
            </a>
        </div>
    </div>
</div>
@endsection