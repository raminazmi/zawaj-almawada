@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-[#3A8BCD]/20">
            <div class="flex flex-col items-center mb-8">
                <img src="{{ asset('assets/images/logo.png') }}" alt="شعار الموقع" class="w-24 h-24 mb-2">
                <h2 class="text-3xl font-extrabold text-[#2A5C82] mb-2" style="font-family: 'Almarai', sans-serif;">
                    {{ $exam->title }}
                </h2>
                <p class="text-[#553566] font-semibold mb-2">{{ $exam->description }}</p>
                <div class="flex flex-wrap justify-center gap-4 text-xs font-semibold my-6">
                    <div
                        class="flex items-center gap-2 bg-blue-50 border border-blue-200 rounded-full px-4 py-2 shadow-sm">
                        <svg class="w-4 h-4 text-[#3A8BCD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>المدة:</span>
                        <span class="text-[#2A5C82]">{{ $exam->duration }}</span>
                        <span>دقيقة</span>
                    </div>
                    <div
                        class="flex items-center gap-2 bg-purple-50 border border-purple-200 rounded-full px-4 py-2 shadow-sm">
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
                        class="flex items-center gap-2 bg-pink-50 border border-pink-200 rounded-full px-4 py-2 shadow-sm">
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
            </div>

            <form id="examForm" method="POST" action="{{ route('course-exams.submit', $exam) }}">
                @csrf
                @foreach($exam->questions as $question)
                <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                    <div class="mb-3 flex justify-start items-center">
                        <span
                            class="inline-block bg-[#3A8BCD] text-white rounded-full px-2 py-0.5 text-xs font-bold mr-2">
                            سؤال {{ $loop->iteration }}
                        </span>
                        <h4 class="inline text-lg font-semibold text-[#2A5C82] mr-2"
                            style="font-family: 'Almarai', sans-serif;">
                            {{ $question->question }}
                        </h4>
                    </div>
                    <div class="grid grid-cols-1 gap-3">
                        @if($question->question_type_id == 1)
                        <!-- اختيار من متعدد -->
                        @foreach($question->options as $option)
                        <label
                            class="flex items-center bg-white border border-gray-200 rounded-lg px-4 py-2 cursor-pointer hover:bg-blue-50 transition">
                            <input class="form-radio text-[#3A8BCD] focus:ring-[#3A8BCD] ml-3" type="radio"
                                name="answers[{{ $question->id }}]" value="{{ $option->text }}" required>
                            <span class="text-gray-700">{{ $option->text }}</span>
                        </label>
                        @endforeach
                        @elseif($question->question_type_id == 2)
                        <!-- صح أو خطأ -->
                        <label
                            class="flex items-center bg-white border border-gray-200 rounded-lg px-4 py-2 cursor-pointer hover:bg-blue-50 transition">
                            <input class="form-radio text-[#3A8BCD] focus:ring-[#3A8BCD] ml-3" type="radio"
                                name="answers[{{ $question->id }}]" value="true" required>
                            <span class="text-gray-700">صح</span>
                        </label>
                        <label
                            class="flex items-center bg-white border border-gray-200 rounded-lg px-4 py-2 cursor-pointer hover:bg-blue-50 transition">
                            <input class="form-radio text-[#3A8BCD] focus:ring-[#3A8BCD] ml-3" type="radio"
                                name="answers[{{ $question->id }}]" value="false" required>
                            <span class="text-gray-700">خطأ</span>
                        </label>
                        @else
                        <!-- نص قصير -->
                        <input type="text" name="answers[{{ $question->id }}]"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#3A8BCD] focus:border-[#3A8BCD]"
                            required placeholder="اكتب إجابتك هنا">
                        @endif
                    </div>
                </div>
                @endforeach
                <div class="flex justify-center mt-8">
                    <button type="submit" id="submitButton"
                        class="bg-gradient-to-l from-[#3A8BCD] to-[#553566] text-white px-6 py-2 rounded-full text-md font-bold shadow-lg hover:opacity-90 transition">
                        إرسال الإجابات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('examForm').addEventListener('submit', function() {
        var button = document.getElementById('submitButton');
        button.innerText = 'جاري إصدار الشهادة...';
        button.disabled = true;
        button.style.backgroundColor = '#F0F0F0';
        button.style.opacity = '0.5';
    });
</script>
@endsection