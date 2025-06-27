@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12 flex items-center justify-center p-4">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8 border border-purple-100">
        <h2 id="title"
            class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-6 text-center"
            style="font-family: 'Almarai', sans-serif;">
            إضافة سؤال جديد للاختبار: {{ $exam->title }}
        </h2>
        <form action="{{ route('admin.exams.questions.store', $exam->id) }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block mb-2 font-bold text-gray-700">نص السؤال</label>
                    <input type="text" name="text" value="{{ old('text') }}"
                        class="w-full px-4 py-2 border rounded-lg @error('text') border-red-500 @else border-gray-300 @endif focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                    @error('text')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @endif
                </div>
                <div>
                    <label class="block mb-2 font-bold text-gray-700">العلامة</label>
                    <input type="number" name="points" value="{{ old('points') }}"
                        class="w-full px-4 py-2 border rounded-lg @error('points') border-red-500 @else border-gray-300 @endif focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                        required min="1">
                    @error('points')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @endif
                </div>
                <div>
                    <label class="block mb-2 font-bold text-gray-700">نوع السؤال</label>
                    <select name="type_id" id="type_id"
                        class="w-full px-4 py-2 border rounded-lg @error('type_id') border-red-500 @else border-gray-300 @endif focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                        onchange="toggleOptions()">
                        <option value="">اختر نوع السؤال</option>
                        @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id')==$type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('type_id')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @endif
                </div>
                <div id="options-section" class="space-y-2" style="display: none;">
                    <label class="block mb-2 font-bold text-gray-700">الخيارات (اختيار من متعدد)</label>
                    <div id="options-list" class="space-y-2">
                        @for ($i = 0; $i < 2; $i++) <div class="flex items-center gap-2 option-item">
                            <input type="text" name="options[{{ $i }}][text]"
                                value="{{ old('options.' . $i . '.text') }}" placeholder="خيار {{ $i + 1 }}"
                                class="flex-1 px-4 py-2 border rounded-lg @error('options.' . $i . '.text') border-red-500 @else border-gray-300 @endif focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                            <label class="flex items-center text-sm">
                                <input type="checkbox" name="options[{{ $i }}][is_correct]" value="1"
                                    class="h-4 w-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500" {{
                                    old('options.' . $i . '.is_correct' ) ? 'checked' : '' }}>
                                <span class="mr-1">صحيح</span>
                            </label>
                            <button type="button" class="remove-option-btn text-red-600 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                            @error('options.' . $i . '.text')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @endif
                    </div>
                    @endfor
                </div>
                <button type="button" id="add-option-btn"
                    class="text-purple-600 hover:text-purple-700 text-sm font-medium mt-2 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    إضافة خيار جديد
                </button>
                @error('options')
                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @endif
            </div>
            <div id="true-false-section" class="space-y-2" style="display: none;">
                <label class="block mb-2 font-bold text-gray-700">الإجابة الصحيحة</label>
                <div class="flex gap-x-4">
                    <label class="flex items-center gap-x-2">
                        <input type="radio" name="correct_answer" value="true"
                            class="h-4 w-4 text-purple-600 border-gray-300 focus:ring-purple-500 rounded" {{
                            old('correct_answer')=='true' ? 'checked' : '' }}>
                        <span class="text-sm">صح</span>
                    </label>
                    <label class="flex items-center gap-x-2">
                        <input type="radio" name="correct_answer" value="false"
                            class="h-4 w-4 text-purple-600 border-gray-300 focus:ring-purple-500 rounded" {{
                            old('correct_answer')=='false' ? 'checked' : '' }}>
                        <span class="text-sm">خطأ</span>
                    </label>
                </div>
                @error('correct_answer')
                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @endif
            </div>
            <div id="short-answer-section" class="space-y-2" style="display: none;">
                <label class="block mb-2 font-bold text-gray-700">الإجابة الصحيحة</label>
                <input type="text" name="correct_answer_sa" value="{{ old('correct_answer_sa') }}"
                    class="w-full px-4 py-2 border rounded-lg @error('correct_answer_sa') border-red-500 @else border-gray-300 @endif focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                @error('correct_answer_sa')
                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @endif
            </div>
            <div class="pt-6 flex justify-end gap-3">
                <a href="{{ route('admin.exams.questions', $exam->id) }}"
                    class="px-6 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-all">
                    إلغاء
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    حفظ السؤال
                </button>
            </div>
    </div>
    </form>
</div>
</div>

<script>
    function toggleOptions() {
        const typeSelect = document.getElementById('type_id');
        const selectedText = typeSelect.options[typeSelect.selectedIndex].text.trim();
        const optionsSection = document.getElementById('options-section');
        const trueFalseSection = document.getElementById('true-false-section');
        const shortAnswerSection = document.getElementById('short-answer-section');

        [optionsSection, trueFalseSection, shortAnswerSection].forEach(section => {
            section.style.display = 'none';
            section.querySelectorAll('input, select').forEach(el => el.disabled = true);
        });

        if (selectedText === 'اختيار من متعدد') {
            optionsSection.style.display = 'block';
            optionsSection.querySelectorAll('input').forEach(el => el.disabled = false);
        } else if (selectedText === 'صح أو خطأ') {
            trueFalseSection.style.display = 'block';
            trueFalseSection.querySelectorAll('input').forEach(el => el.disabled = false);
        } else if (selectedText === 'نص قصير') {
            shortAnswerSection.style.display = 'block';
            shortAnswerSection.querySelectorAll('input').forEach(el => el.disabled = false);
        }
    }

    function addOption() {
        const optionsList = document.getElementById('options-list');
        const optionIndex = optionsList.children.length;
        const optionDiv = document.createElement('div');
        optionDiv.className = 'flex items-center gap-2 option-item';
        optionDiv.innerHTML = `
            <input type="text" name="options[${optionIndex}][text]" placeholder="خيار ${optionIndex + 1}"
                class="flex-1 px-4 py-2 border rounded-lg border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
            <label class="flex items-center text-sm">
                <input type="checkbox" name="options[${optionIndex}][is_correct]" value="1"
                    class="h-4 w-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                <span class="mr-1">صحيح</span>
            </label>
            <button type="button" class="remove-option-btn text-red-600 hover:text-red-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        `;
        optionsList.appendChild(optionDiv);
        optionDiv.querySelector('.remove-option-btn').addEventListener('click', removeOption);
    }

    function removeOption(e) {
        const optionItem = e.target.closest('.option-item');
        if (optionItem.parentElement.children.length > 2) {
            optionItem.remove();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        toggleOptions();
        document.getElementById('type_id').addEventListener('change', toggleOptions);
        document.getElementById('add-option-btn').addEventListener('click', addOption);
        document.querySelectorAll('.remove-option-btn').forEach(btn => {
            btn.addEventListener('click', removeOption);
        });
    });
</script>
@endsection