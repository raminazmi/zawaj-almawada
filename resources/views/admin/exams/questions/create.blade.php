@extends('layouts.app')
@section('content')
<div>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-[#3A8BCD]/20">
            <h2 class="text-2xl font-extrabold text-[#2A5C82] mb-8 text-center"
                style="font-family: 'Almarai', sans-serif;">
                إضافة سؤال جديد للاختبار: {{ $exam->title }}
            </h2>
            <form action="{{ route('admin.exams.questions.store', $exam) }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 font-bold text-[#2A5C82]">نص السؤال</label>
                    <input type="text" name="text" value="{{ old('text') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#3A8BCD]">
                </div>
                <div class="mb-6">
                    <label class="block mb-2 font-bold text-[#2A5C82]">نوع السؤال</label>
                    <select name="type_id" id="type_id" class="w-full border border-gray-300 rounded-lg px-4 py-2"
                        onchange="toggleOptions()">
                        @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id')==$type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Multiple Choice Options --}}
                <div id="options-section" class="mb-6" style="display: none;">
                    <label class="block mb-2 font-bold text-[#2A5C82]">الخيارات (اختيار من متعدد)</label>
                    <div id="options-list">
                        @for($i=0; $i<4; $i++) <div class="flex items-center mb-2">
                            <input type="text" name="options[{{ $i }}][text]" value="{{ old('options.'.$i.'.text') }}"
                                placeholder="الخيار {{ $i+1 }}"
                                class="flex-1 border border-gray-300 rounded-lg px-4 py-2 mr-2">
                            <label class="flex items-center text-sm">
                                <input type="checkbox" name="options[{{ $i }}][is_correct]" value="1" {{
                                    old('options.'.$i.'.is_correct') ? 'checked' : '' }} class="ml-1">
                                صحيح
                            </label>
                    </div>
                    @endfor
                </div>
        </div>

        {{-- True/False Answer --}}
        <div id="true-false-section" class="mb-6" style="display: none;">
            <label class="block mb-2 font-bold text-[#2A5C82]">الإجابة الصحيحة</label>
            <div class="flex gap-x-4">
                <label class="flex items-center gap-x-2">
                    <input type="radio" name="correct_answer" value="true" {{ old('correct_answer')=='true' ? 'checked'
                        : '' }}>
                    <span>صح</span>
                </label>
                <label class="flex items-center gap-x-2">
                    <input type="radio" name="correct_answer" value="false" {{ old('correct_answer')=='false'
                        ? 'checked' : '' }}>
                    <span>خطأ</span>
                </label>
            </div>
        </div>

        {{-- Short Answer --}}
        <div id="short-answer-section" class="mb-6" style="display: none;">
            <label class="block mb-2 font-bold text-[#2A5C82]">الإجابة الصحيحة</label>
            <input type="text" name="correct_answer_sa" value="{{ old('correct_answer_sa') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#3A8BCD]">
        </div>

        <div class="flex justify-center gap-4">
            <button type="submit"
                class="bg-[#3A8BCD] hover:bg-[#2A5C82] text-white font-bold py-2 px-8 rounded-lg shadow transition">
                حفظ السؤال
            </button>
            <a href="{{ route('admin.exams.questions', $exam) }}"
                class="bg-gray-200 hover:bg-gray-300 text-[#2A5C82] font-bold py-2 px-8 rounded-lg shadow transition">
                إلغاء
            </a>
        </div>
        </form>
    </div>
</div>
</div>
<script>
    function toggleOptions() {
        var typeSelect = document.getElementById('type_id');
        var selectedText = typeSelect.options[typeSelect.selectedIndex].text.trim();

        var optionsSection = document.getElementById('options-section');
        var trueFalseSection = document.getElementById('true-false-section');
        var shortAnswerSection = document.getElementById('short-answer-section');

        // Hide all sections first
        optionsSection.style.display = 'none';
        trueFalseSection.style.display = 'none';
        shortAnswerSection.style.display = 'none';

        // Disable inputs to prevent them from being submitted when hidden
        document.querySelectorAll('#options-section input').forEach(el => el.disabled = true);
        document.querySelectorAll('#true-false-section input').forEach(el => el.disabled = true);
        document.querySelectorAll('#short-answer-section input').forEach(el => el.disabled = true);


        if (selectedText === 'اختيار من متعدد') {
            optionsSection.style.display = 'block';
            document.querySelectorAll('#options-section input').forEach(el => el.disabled = false);
        } else if (selectedText === 'صح أو خطأ') {
            trueFalseSection.style.display = 'block';
            document.querySelectorAll('#true-false-section input').forEach(el => el.disabled = false);
        } else if (selectedText === 'نص قصير') {
            shortAnswerSection.style.display = 'block';
            document.querySelectorAll('#short-answer-section input').forEach(el => el.disabled = false);
        }
    }
    // Run on page load
    document.addEventListener('DOMContentLoaded', toggleOptions);
</script>
@endsection