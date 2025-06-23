@extends('layouts.app')

@section('content')
<div class="py-12 bg-[#f8fafc] min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('admin.exams.store') }}" method="POST">
            @csrf
            <div class="bg-white shadow-xl rounded-2xl p-8 border border-[#3A8BCD]/20">
                <h2 class="text-3xl font-extrabold text-[#2A5C82] mb-8 text-center"
                    style="font-family: 'Almarai', sans-serif;">
                    إنشاء اختبار جديد
                </h2>

                {{-- قسم عرض رسائل الخطأ --}}
                @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6" role="alert">
                    <p class="font-bold">حدثت الأخطاء التالية:</p>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- تفاصيل الاختبار --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="title" class="block mb-2 font-bold text-[#2A5C82]">العنوان</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" class="input-style"
                            required>
                    </div>
                    <div>
                        <label for="duration" class="block mb-2 font-bold text-[#2A5C82]">المدة (دقائق)</label>
                        <input type="number" id="duration" name="duration" value="{{ old('duration') }}"
                            class="input-style" required>
                    </div>
                    <div class="md:col-span-2">
                        <label for="description" class="block mb-2 font-bold text-[#2A5C82]">الوصف</label>
                        <textarea id="description" name="description" class="input-style"
                            rows="3">{{ old('description') }}</textarea>
                    </div>
                    <div>
                        <label for="start_time" class="block mb-2 font-bold text-[#2A5C82]">وقت البدء</label>
                        <input type="datetime-local" id="start_time" name="start_time" value="{{ old('start_time') }}"
                            class="input-style" required>
                    </div>
                    <div>
                        <label for="end_time" class="block mb-2 font-bold text-[#2A5C82]">وقت الانتهاء</label>
                        <input type="datetime-local" id="end_time" name="end_time" value="{{ old('end_time') }}"
                            class="input-style" required>
                    </div>
                    <div class="flex items-center mt-2">
                        <input type="checkbox" id="is_active" name="is_active" value="1" class="w-4 h-4 rounded" {{
                            old('is_active', '1' ) ? 'checked' : '' }}>
                        <label for="is_active" class="mr-2 font-bold text-[#2A5C82]">تفعيل الاختبار؟</label>
                    </div>
                </div>

                <hr class="my-8 border-t-2 border-gray-200">

                {{-- قسم الأسئلة الديناميكي --}}
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-[#2A5C82]">الأسئلة</h3>
                        <button type="button" id="add-question-btn"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition transform hover:scale-105">
                            + إضافة سؤال
                        </button>
                    </div>
                    <div id="questions-container" class="space-y-4">
                        {{-- سيتم إضافة الأسئلة هنا بواسطة JavaScript --}}
                    </div>
                </div>

                <div class="flex justify-center gap-4 mt-10">
                    <button type="submit"
                        class="bg-gradient-to-r from-[#553566] to-[#3A8BCD] text-white font-bold py-3 px-12 rounded-lg shadow-lg transition transform hover:scale-105">
                        حفظ الاختبار
                    </button>
                    <a href="{{ route('admin.exams.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-[#2A5C82] font-bold py-3 px-12 rounded-lg shadow-lg transition">
                        إلغاء
                    </a>
                </div>
            </div>
        </form>
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

{{-- تم وضع السكريبت هنا مباشرة لضمان التنفيذ --}}
<script>
    (function() {
        // ---- VARIABLES ----
        const addQuestionBtn = document.getElementById('add-question-btn');
        const questionsContainer = document.getElementById('questions-container');
        if (!addQuestionBtn || !questionsContainer) {
            console.error('Essential elements for script not found!');
            return; // Stop if crucial elements are missing
        }

        const typesData = {!! json_encode($types) !!};
        let questionIndex = 0;

        // ---- FUNCTIONS ----
        function createQuestionElement() {
            const questionId = `question-block-${questionIndex}`;

            let optionsHtml = '';
            for (let i = 0; i < 4; i++) {
                optionsHtml += `
                    <div class="flex items-center">
                        <input type="text" name="questions[${questionIndex}][options][${i}][text]" placeholder="خيار ${i + 1}" class="input-style flex-1 mr-2">
                        <input type="hidden" name="questions[${questionIndex}][options][${i}][is_correct]" value="0">
                        <input type="checkbox" name="questions[${questionIndex}][options][${i}][is_correct]" value="1" class="ml-1 w-4 h-4">
                        <label class="text-sm">صحيح</label>
                    </div>
                `;
            }

            let selectOptionsHtml = '';
            typesData.forEach(type => {
                selectOptionsHtml += `<option value="${type.id}">${type.name}</option>`;
            });

            const questionDiv = document.createElement('div');
            questionDiv.id = questionId;
            questionDiv.className = 'question-block bg-gray-50 p-4 rounded-lg border';
            questionDiv.innerHTML = `
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-bold">سؤال ${questionIndex + 1}</h4>
                    <button type="button" class="remove-question-btn text-red-500 hover:text-red-700 font-bold" data-target="${questionId}">X</button>
                </div>
                <div class="space-y-2">
                    <input type="text" name="questions[${questionIndex}][text]" placeholder="نص السؤال" class="input-style" required>
                    <select name="questions[${questionIndex}][type_id]" class="input-style question-type-select" data-index="${questionIndex}">
                        ${selectOptionsHtml}
                    </select>
                    <div id="options-for-${questionIndex}" class="options-container space-y-2" style="display: none;">
                        ${optionsHtml}
                    </div>
                </div>
            `;

            questionsContainer.appendChild(questionDiv);
            
            const newSelect = questionDiv.querySelector('.question-type-select');
            newSelect.addEventListener('change', handleTypeChange);
            handleTypeChange({ target: newSelect });

            questionIndex++;
        }

        function handleTypeChange(event) {
            const selectElement = event.target;
            const selectedOptionText = selectElement.options[selectElement.selectedIndex].text;
            const qIndex = selectElement.dataset.index;
            const optionsDiv = document.getElementById(`options-for-${qIndex}`);
            
            if (selectedOptionText === 'اختيار من متعدد') {
                optionsDiv.style.display = 'block';
            } else {
                optionsDiv.style.display = 'none';
            }
        }

        // ---- EVENT LISTENERS ----
        addQuestionBtn.addEventListener('click', createQuestionElement);

        questionsContainer.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-question-btn')) {
                const targetId = e.target.dataset.target;
                const elementToRemove = document.getElementById(targetId);
                if (elementToRemove) {
                    elementToRemove.remove();
                }
            }
        });

        // ---- INITIALIZATION ----
        createQuestionElement();
    })();
</script>

@endsection