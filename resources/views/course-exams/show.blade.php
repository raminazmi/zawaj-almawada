@extends('layouts.app')

@section('content')
<div>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-[#3A8BCD]/20">
            <div class="flex flex-col items-center mb-8">
                <img src="{{ asset('assets/images/logo.png') }}" alt="شعار الموقع" class="w-24 h-24 mb-2">
                <h2 class="text-3xl font-extrabold text-[#2A5C82] mb-2">
                    {{ $exam->title }}
                </h2>
                <p class="text-[#553566] font-semibold mb-2">{{ $exam->description }}</p>
                <div class="flex flex-wrap justify-center gap-4 text-xs font-semibold my-6">
                    <div
                        class="flex items-center gap-2 bg-blue-50 border border-blue-200 rounded-full px-4 py-2 shadow-sm">
                        <i class="fas fa-clock text-[#3A8BCD]"></i>
                        <span>المدة:</span>
                        <span class="text-[#2A5C82]">{{ $exam->duration }}</span>
                        <span>دقيقة</span>
                    </div>
                    <div
                        class="flex items-center gap-2 bg-purple-50 border border-purple-200 rounded-full px-4 py-2 shadow-sm">
                        <i class="fas fa-calendar-plus text-[#553566]"></i>
                        <span>يبدأ:</span>
                        <span class="text-[#2A5C82]">{{ $exam->start_time->format('Y-m-d') }}</span>
                        <span class="text-[#3A8BCD]">
                            {{ str_replace(['AM', 'PM'], ['ص', 'م'], $exam->start_time->format('h:i A')) }}
                        </span>
                    </div>
                    <div
                        class="flex items-center gap-2 bg-pink-50 border border-pink-200 rounded-full px-4 py-2 shadow-sm">
                        <i class="fas fa-calendar-check text-pink-500"></i>
                        <span>ينتهي:</span>
                        <span class="text-[#2A5C82]">{{ $exam->end_time->format('Y-m-d') }}</span>
                        <span class="text-pink-500">
                            {{ str_replace(['AM', 'PM'], ['ص', 'م'], $exam->end_time->format('h:i A')) }}
                        </span>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('course-exams.submit', $exam) }}">
                @csrf

                @foreach($exam->questions as $question)
                <div class="mb-8">
                    <div class="mb-3 flex justify-start items-center">
                        <span
                            class="inline-block bg-[#3A8BCD] text-white rounded-full px-2 py-0.5 text-xs font-bold mr-2">
                            سؤال "{{ $loop->iteration }}"
                        </span>
                        <h4 class="inline text-lg font-semibold text-[#2A5C82] mr-2"
                            style="font-family: 'Almarai', sans-serif;">
                            {{ $question->question }}
                        </h4>
                    </div>
                    <div class="grid grid-cols-1 gap-3">
                        @if($question->question_type_id == 1 || $question->question_type_id == 2)
                        @foreach($question->options as $option)
                        <label
                            class="flex items-center bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 cursor-pointer hover:bg-blue-50 transition">
                            <input class="form-radio text-[#3A8BCD] focus:ring-[#3A8BCD] ml-3" type="radio"
                                name="answers[{{ $question->id }}]" value="{{ $option }}" required>
                            <span class="text-gray-700">{{ $option }}</span>
                        </label>
                        @endforeach
                        @else
                        <input type="text" name="answers[{{ $question->id }}]"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" required
                            placeholder="اكتب إجابتك هنا">
                        @endif
                    </div>
                </div>
                @endforeach

                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="bg-gradient-to-l from-[#3A8BCD] to-[#553566] text-white px-8 py-3 rounded-full text-lg font-bold shadow-lg hover:opacity-90 transition">
                        إرسال الإجابات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection