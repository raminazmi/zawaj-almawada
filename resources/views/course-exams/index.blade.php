@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-[#3A8BCD]/20">
            <h2 class="text-3xl font-extrabold text-[#2A5C82] mb-8 text-center"
                style="font-family: 'Almarai', sans-serif;">
                اختبارات الدورات
            </h2>
            @if($exams->isEmpty())
            <p class="text-gray-500 text-center py-8">لا توجد اختبارات متاحة حالياً.</p>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($exams as $exam)
                <div
                    class="border border-[#3A8BCD]/20 rounded-xl p-6 bg-blue-50/30 shadow hover:shadow-lg transition transform hover:-translate-y-1">
                    <h3 class="text-xl font-bold text-[#2A5C82] mb-2" style="font-family: 'Almarai', sans-serif;">{{
                        $exam->title }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $exam->description }}</p>
                    <div class="flex flex-wrap justify-center gap-2 text-xs font-semibold mb-4">
                        <div
                            class="flex items-center gap-1 bg-blue-50 border border-blue-200 rounded-full px-3 py-1 shadow-sm">
                            <svg class="w-4 h-4 text-[#3A8BCD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>المدة:</span>
                            <span class="text-[#2A5C82]">{{ $exam->duration }}</span>
                            <span>دقيقة</span>
                        </div>
                        <div
                            class="flex items-center gap-1 bg-purple-50 border border-purple-200 rounded-full px-3 py-1 shadow-sm">
                            <svg class="w-4 h-4 text-[#553566]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>يبدأ:</span>
                            <span class="text-[#2A5C82]">{{ $exam->start_time->format('Y-m-d') }}</span>
                            <span class="text-[#3A8BCD]">{{ str_replace(['AM', 'PM'], ['ص', 'م'],
                                $exam->start_time->format('h:i A')) }}</span>
                        </div>
                        <div
                            class="flex items-center gap-1 bg-pink-50 border border-pink-200 rounded-full px-3 py-1 shadow-sm">
                            <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            <span>ينتهي:</span>
                            <span class="text-[#2A5C82]">{{ $exam->end_time->format('Y-m-d') }}</span>
                            <span class="text-pink-500">{{ str_replace(['AM', 'PM'], ['ص', 'م'],
                                $exam->end_time->format('h:i A')) }}</span>
                        </div>
                    </div>
                    @if($exam->is_active && now() >= $exam->start_time && now() <= $exam->end_time)
                        <a href="{{ route('course-exams.show', $exam) }}"
                            class="block w-full text-center bg-gradient-to-l from-[#3A8BCD] to-[#553566] text-white px-6 py-2 rounded-full font-bold hover:opacity-90 transition">
                            ابدأ الاختبار
                        </a>
                        @else
                        <p class="text-red-500 font-bold text-center">الاختبار غير متاح حالياً</p>
                        @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection