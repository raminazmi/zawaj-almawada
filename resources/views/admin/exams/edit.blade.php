@extends('layouts.app')
@section('content')
<div>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-[#3A8BCD]/20">
            <h2 class="text-3xl font-extrabold text-[#2A5C82] mb-8 text-center"
                style="font-family: 'Almarai', sans-serif;">
                {{ isset($exam) ? 'تعديل اختبار' : 'إضافة اختبار جديد' }}
            </h2>
            <form method="POST"
                action="{{ isset($exam) ? route('admin.exams.update', $exam) : route('admin.exams.store') }}">
                @csrf
                @if(isset($exam)) @method('PUT') @endif
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-[#553566] mb-1">العنوان</label>
                        <input type="text" name="title"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#3A8BCD] focus:border-[#3A8BCD]"
                            value="{{ $exam->title ?? '' }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#553566] mb-1">الوصف</label>
                        <textarea name="description"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#3A8BCD] focus:border-[#3A8BCD]"
                            required>{{ $exam->description ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#553566] mb-1">المدة (دقيقة)</label>
                        <input type="number" name="duration"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#3A8BCD] focus:border-[#3A8BCD]"
                            value="{{ $exam->duration ?? '' }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#553566] mb-1">وقت البدء</label>
                        <input type="datetime-local" name="start_time"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#3A8BCD] focus:border-[#3A8BCD]"
                            value="{{ isset($exam) ? $exam->start_time->format('Y-m-d\TH:i') : '' }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#553566] mb-1">وقت الانتهاء</label>
                        <input type="datetime-local" name="end_time"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#3A8BCD] focus:border-[#3A8BCD]"
                            value="{{ isset($exam) ? $exam->end_time->format('Y-m-d\TH:i') : '' }}" required>
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active"
                                class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-[#3A8BCD]" {{
                                isset($exam) && $exam->is_active ? 'checked' : '' }}>
                            <span class="mr-2 text-[#2A5C82] font-semibold">تفعيل الاختبار</span>
                        </label>
                    </div>
                    <div id="questions">
                        <h3 class="text-lg font-bold text-[#2A5C82] mb-4">الأسئلة</h3>
                        <div class="flex justify-between items-center mb-4">
                            <button type="button" id="add-question-btn"
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition transform hover:scale-105">
                                + إضافة سؤال
                            </button>
                        </div>
                        <div id="questionsList">
                            @if(isset($exam) && $exam->questions)
                            @foreach($exam->questions as $qIndex => $question)
                            <div class="question-block bg-gray-50 p-4 rounded-lg border mb-4"
                                data-index="{{ $qIndex }}">
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="font-bold">سؤال {{ $qIndex + 1 }}</h4>
                                    <button type="button"
                                        class="remove-question-btn text-red-500 hover:text-red-700 font-bold"
                                        data-target="{{ $qIndex }}">X</button>
                                </div>
                                <div class="space-y-2">
                                    <input type="text" name="questions[{{ $qIndex }}][question]"
                                        value="{{ $question->question }}" placeholder="نص السؤال" class="input-style"
                                        required>
                                    <select name="questions[{{ $qIndex }}][question_type_id]"
                                        class="input-style question-type-select" data-index="{{ $qIndex }}">
                                        <option value="1" @if($question->question_type_id == 1) selected @endif>اختيار
                                            من متعدد</option>
                                        <option value="2" @if($question->question_type_id == 2) selected @endif>صح أو
                                            خطأ</option>
                                        <option value="3" @if($question->question_type_id == 3) selected @endif>نص قصير
                                        </option>
                                    </select>
                                    <div id="options-for-{{ $qIndex }}" class="options-container space-y-2"
                                        @if($question->question_type_id != 1) style="display:none" @endif>
                                        @for($i = 0; $i < 4; $i++) <div class="flex items-center">
                                            <input type="text" name="questions[{{ $qIndex }}][options][{{ $i }}][text]"
                                                value="{{ $question->options[$i]->text ?? '' }}"
                                                placeholder="خيار {{ $i + 1 }}" class="input-style flex-1 mr-2">
                                            <input type="hidden"
                                                name="questions[{{ $qIndex }}][options][{{ $i }}][is_correct]"
                                                value="0">
                                            <input type="checkbox"
                                                name="questions[{{ $qIndex }}][options][{{ $i }}][is_correct]" value="1"
                                                class="ml-1 w-4 h-4" @if(isset($question->options[$i]) &&
                                            $question->options[$i]->is_correct) checked @endif>
                                            <label class="text-sm">صحيح</label>
                                    </div>
                                    @endfor
                                </div>
                                <input type="text" name="questions[{{ $qIndex }}][correct_answer]"
                                    value="{{ $question->correct_answer }}" placeholder="الإجابة الصحيحة"
                                    class="input-style" required>
                                <input type="number" name="questions[{{ $qIndex }}][points]"
                                    value="{{ $question->points ?? '' }}" placeholder="الدرجة" class="input-style"
                                    required>
                                <input type="hidden" name="questions[{{ $qIndex }}][id]" value="{{ $question->id }}">
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="mt-8 flex justify-center">
                    <button type="submit"
                        class="bg-gradient-to-l from-[#3A8BCD] to-[#553566] text-white px-10 py-3 rounded-full text-lg font-bold shadow-lg hover:opacity-90 transition">
                        حفظ
                    </button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<style>
    .input-style {
        width: 100%;
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
        padding: 0.5rem 1rem;
    }
</style>

<script>
    (function() {
    const addQuestionBtn = document.getElementById('add-question-btn');
    const questionsList = document.getElementById('questionsList');
    let questionIndex = {{ isset($exam) ? $exam->questions->count() : 0 }};

    function createQuestionElement(idx = null) {
        if(idx === null) idx = questionIndex;
        const questionId = `question-block-${idx}`;
        let optionsHtml = '';
        for (let i = 0; i < 4; i++) {
            optionsHtml += `
                <div class="flex items-center">
                    <input type="text" name="questions[${idx}][options][${i}][text]" placeholder="خيار ${i + 1}" class="input-style flex-1 mr-2">
                    <input type="hidden" name="questions[${idx}][options][${i}][is_correct]" value="0">
                    <input type="checkbox" name="questions[${idx}][options][${i}][is_correct]" value="1" class="ml-1 w-4 h-4">
                    <label class="text-sm">صحيح</label>
                </div>
            `;
        }
        const questionDiv = document.createElement('div');
        questionDiv.className = 'question-block bg-gray-50 p-4 rounded-lg border mb-4';
        questionDiv.setAttribute('data-index', idx);
        questionDiv.innerHTML = `
            <div class="flex justify-between items-center mb-2">
                <h4 class="font-bold">سؤال ${idx + 1}</h4>
                <button type="button" class="remove-question-btn text-red-500 hover:text-red-700 font-bold" data-target="${idx}">X</button>
            </div>
            <div class="space-y-2">
                <input type="text" name="questions[${idx}][question]" placeholder="نص السؤال" class="input-style" required>
                <select name="questions[${idx}][question_type_id]" class="input-style question-type-select" data-index="${idx}">
                    <option value="1">اختيار من متعدد</option>
                    <option value="2">صح أو خطأ</option>
                    <option value="3">نص قصير</option>
                </select>
                <div id="options-for-${idx}" class="options-container space-y-2" style="display:none;">
                    ${optionsHtml}
                </div>
                <input type="text" name="questions[${idx}][correct_answer]" placeholder="الإجابة الصحيحة" class="input-style" required>
                <input type="number" name="questions[${idx}][points]" placeholder="الدرجة" class="input-style" required>
            </div>
        `;
        questionsList.appendChild(questionDiv);

        // ربط الحدث لتغيير نوع السؤال
        const select = questionDiv.querySelector('.question-type-select');
        select.addEventListener('change', handleTypeChange);
        handleTypeChange({ target: select });

        questionIndex++;
    }

    function handleTypeChange(event) {
        const selectElement = event.target;
        const qIndex = selectElement.dataset.index;
        const optionsDiv = document.getElementById(`options-for-${qIndex}`);
        if (selectElement.value == "1") {
            optionsDiv.style.display = 'block';
        } else {
            optionsDiv.style.display = 'none';
        }
    }

    addQuestionBtn.addEventListener('click', function() {
        createQuestionElement();
    });

    questionsList.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-question-btn')) {
            const block = e.target.closest('.question-block');
            if (block) block.remove();
        }
    });

    // ربط الأحداث للأسئلة الموجودة مسبقاً
    document.querySelectorAll('.question-type-select').forEach(function(select) {
        select.addEventListener('change', handleTypeChange);
    });
})();
</script>
@endsection