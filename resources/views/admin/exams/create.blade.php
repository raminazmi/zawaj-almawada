@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg p-6 border border-purple-100">
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                إنشاء اختبار جديد
            </h2>
            <p class="text-gray-500 mt-2">املأ الحقول التالية لإضافة اختبار جديد</p>
        </div>

        <form action="{{ route('admin.exams.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">العنوان</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="w-full px-4 py-2 border rounded-lg @error('title') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                            required>
                        @error('title')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">المدة (دقائق)</label>
                        <input type="number" id="duration" name="duration" value="{{ old('duration') }}"
                            class="w-full px-4 py-2 border rounded-lg @error('duration') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                            required>
                        @error('duration')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">الوصف</label>
                        <textarea id="description" name="description"
                            class="w-full px-4 py-2 border rounded-lg @error('description') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                            rows="3">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">وقت البدء</label>
                        <input type="datetime-local" id="start_time" name="start_time" value="{{ old('start_time') }}"
                            class="w-full px-4 py-2 border rounded-lg @error('start_time') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                            required>
                        @error('start_time')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">وقت الانتهاء</label>
                        <input type="datetime-local" id="end_time" name="end_time" value="{{ old('end_time') }}"
                            class="w-full px-4 py-2 border rounded-lg @error('end_time') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                            required>
                        @error('end_time')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                class="h-4 w-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500" {{
                                old('is_active') ? 'checked' : '' }}>
                            <span class="mr-2 text-sm text-gray-700">تفعيل الاختبار؟</span>
                        </label>
                        @error('is_active')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-8 border-t border-gray-200">

                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h3
                            class="text-xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                            الأسئلة
                        </h3>
                        <button type="button" id="add-question-btn"
                            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            إضافة سؤال
                        </button>
                    </div>
                    <div id="questions-container" class="space-y-4">
                        @if (old('questions'))
                        @foreach (old('questions', []) as $index => $question)
                        <div id="question-block-{{ $index }}"
                            class="question-block bg-gray-50 p-4 rounded-lg border border-purple-100">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-bold text-gray-700">سؤال {{ $index + 1 }}</h4>
                                <button type="button"
                                    class="remove-question-btn text-red-600 hover:text-red-700 font-bold"
                                    data-target="question-block-{{ $index }}">X</button>
                            </div>
                            <div class="space-y-2">
                                <input type="text" name="questions[{{ $index }}][text]" placeholder="نص السؤال"
                                    class="w-full px-4 py-2 border rounded-lg @error('questions.' . $index . '.text') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                                    value="{{ old('questions.' . $index . '.text') }}" required>
                                @error('questions.' . $index . '.text')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                                <select name="questions[{{ $index }}][type_id]"
                                    class="w-full px-4 py-2 border rounded-lg @error('questions.' . $index . '.type_id') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all question-type-select"
                                    data-index="{{ $index }}">
                                    <option value="">اختر نوع السؤال</option>
                                    @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ old('questions.' . $index . '.type_id' )==$type->
                                        id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('questions.' . $index . '.type_id')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                                <!-- خيارات الاختيار من متعدد -->
                                <div id="options-for-{{ $index }}" class="options-container space-y-2"
                                    style="display: {{ old('questions.' . $index . '.type_id') && $types->firstWhere('id', old('questions.' . $index . '.type_id'))?->name === 'اختيار من متعدد' ? 'block' : 'none' }}">
                                    <div class="options-list">
                                        @foreach (old('questions.' . $index . '.options', []) as $optionIndex =>
                                        $option)
                                        <div class="flex items-center gap-2 option-item">
                                            <input type="text"
                                                name="questions[{{ $index }}][options][{{ $optionIndex }}][text]"
                                                placeholder="خيار {{ $optionIndex + 1 }}"
                                                class="flex-1 px-4 py-2 border rounded-lg @error('questions.' . $index . '.options.' . $optionIndex . '.text') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                                                value="{{ old('questions.' . $index . '.options.' . $optionIndex . '.text') }}">
                                            @error('questions.' . $index . '.options.' . $optionIndex . '.text')
                                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                            <input type="hidden"
                                                name="questions[{{ $index }}][options][{{ $optionIndex }}][is_correct]"
                                                value="0">
                                            <input type="checkbox"
                                                name="questions[{{ $index }}][options][{{ $optionIndex }}][is_correct]"
                                                value="1"
                                                class="h-4 w-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500 @error('questions.' . $index . '.options.' . $optionIndex . '.is_correct') border-red-500 @enderror"
                                                {{ old('questions.' . $index . '.options.' . $optionIndex
                                                . '.is_correct' ) ? 'checked' : '' }}>
                                            <label class="text-sm text-gray-700">صحيح</label>
                                            <button type="button"
                                                class="remove-option-btn text-red-600 hover:text-red-700 ml-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                            @error('questions.' . $index . '.options.' . $optionIndex . '.is_correct')
                                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button"
                                        class="add-option-btn text-purple-600 hover:text-purple-700 text-sm font-medium mt-2 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        إضافة خيار جديد
                                    </button>
                                </div>
                                <!-- خيارات صح أو خطأ -->
                                <div id="true-false-for-{{ $index }}" class="true-false-container space-y-2"
                                    style="display: {{ old('questions.' . $index . '.type_id') && $types->firstWhere('id', old('questions.' . $index . '.type_id'))?->name === 'صح أو خطأ' ? 'block' : 'none' }}">
                                    <label class="block text-sm font-medium text-gray-700">الإجابة الصحيحة:</label>
                                    <div class="flex gap-4">
                                        <label class="flex items-center">
                                            <input type="radio" name="questions[{{ $index }}][correct_answer]"
                                                value="true"
                                                class="h-4 w-4 text-purple-600 border-gray-300 focus:ring-purple-500" {{
                                                old('questions.' . $index . '.correct_answer' )==='true' ? 'checked'
                                                : '' }}>
                                            <span class="mr-2 text-sm">صح</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="questions[{{ $index }}][correct_answer]"
                                                value="false"
                                                class="h-4 w-4 text-purple-600 border-gray-300 focus:ring-purple-500" {{
                                                old('questions.' . $index . '.correct_answer' )==='false' ? 'checked'
                                                : '' }}>
                                            <span class="mr-2 text-sm">خطأ</span>
                                        </label>
                                    </div>
                                    @error('questions.' . $index . '.correct_answer')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- خيارات النص القصير -->
                                <div id="short-answer-for-{{ $index }}" class="short-answer-container space-y-2"
                                    style="display: {{ old('questions.' . $index . '.type_id') && $types->firstWhere('id', old('questions.' . $index . '.type_id'))?->name === 'نص قصير' ? 'block' : 'none' }}">
                                    <label class="block text-sm font-medium text-gray-700">الإجابة الصحيحة:</label>
                                    <input type="text" name="questions[{{ $index }}][correct_answer]"
                                        placeholder="اكتب الإجابة الصحيحة"
                                        class="w-full px-4 py-2 border rounded-lg @error('questions.' . $index . '.correct_answer') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                                        value="{{ old('questions.' . $index . '.correct_answer') }}">
                                    @error('questions.' . $index . '.correct_answer')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="pt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.exams.index') }}"
                        class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all">
                        إلغاء
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        حفظ الاختبار
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    (function() {
        const addQuestionBtn = document.getElementById('add-question-btn');
        const questionsContainer = document.getElementById('questions-container');
        if (!addQuestionBtn || !questionsContainer) return;

        const typesData = @json($types->map(fn($type) => ['id' => $type->id, 'name' => $type->name]));
        let questionIndex = {{ count(old('questions', [])) }};

        function createQuestionElement() {
            const questionId = `question-block-${questionIndex}`;
            const questionDiv = document.createElement('div');
            questionDiv.id = questionId;
            questionDiv.className = 'question-block bg-gray-50 p-4 rounded-lg border border-purple-100';
            questionDiv.innerHTML = `
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-bold text-gray-700">سؤال ${questionIndex + 1}</h4>
                    <button type="button" class="remove-question-btn text-red-600 hover:text-red-700 font-bold" data-target="${questionId}">X</button>
                </div>
                <div class="space-y-2">
                    <input type="text" name="questions[${questionIndex}][text]" placeholder="نص السؤال"
                        class="w-full px-4 py-2 border rounded-lg border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all" required>
                    <select name="questions[${questionIndex}][type_id]"
                        class="w-full px-4 py-2 border rounded-lg border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all question-type-select"
                        data-index="${questionIndex}">
                        <option value="">اختر نوع السؤال</option>
                        ${typesData.map(item => `<option value="${item.id}">${item.name}</option>`).join('')}
                    </select>
                    <!-- خيارات الاختيار من متعدد -->
                    <div id="options-for-${questionIndex}" class="options-container space-y-2" style="display: none;">
                        <div class="options-list">
                            ${Array.from({length: 2}, (_, i) => `
                                <div class="flex items-center gap-2 option-item">
                                    <input type="text" name="questions[${questionIndex}][options][${i}][text]" placeholder="خيار ${i+1}"
                                        class="flex-1 px-4 py-2 border rounded-lg border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                                    <input type="hidden" name="questions[${questionIndex}][options][${i}][is_correct]" value="0">
                                    <input type="checkbox" name="questions[${questionIndex}][options][${i}][is_correct]" value="1"
                                        class="h-4 w-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                                    <label class="text-sm text-gray-700">صحيح</label>
                                    <button type="button" class="remove-option-btn text-red-600 hover:text-red-700 ml-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            `).join('')}
                        </div>
                        <button type="button" class="add-option-btn text-purple-600 hover:text-purple-700 text-sm font-medium mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            إضافة خيار جديد
                        </button>
                    </div>
                    <!-- خيارات صح أو خطأ -->
                    <div id="true-false-for-${questionIndex}" class="true-false-container space-y-2" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700">الإجابة الصحيحة:</label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" name="questions[${questionIndex}][correct_answer]" value="true"
                                    class="h-4 w-4 text-purple-600 border-gray-300 focus:ring-purple-500">
                                <span class="mr-2 text-sm">صح</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="questions[${questionIndex}][correct_answer]" value="false"
                                    class="h-4 w-4 text-purple-600 border-gray-300 focus:ring-purple-500">
                                <span class="mr-2 text-sm">خطأ</span>
                            </label>
                        </div>
                    </div>
                    <!-- خيارات النص القصير -->
                    <div id="short-answer-for-${questionIndex}" class="short-answer-container space-y-2" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700">الإجابة الصحيحة:</label>
                        <input type="text" name="questions[${questionIndex}][correct_answer]"
                            placeholder="اكتب الإجابة الصحيحة"
                            class="w-full px-4 py-2 border rounded-lg border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                    </div>
                </div>
            `;
            questionsContainer.appendChild(questionDiv);

            const newSelect = questionDiv.querySelector('.question-type-select');
            newSelect.addEventListener('change', handleTypeChange);
            handleTypeChange({ target: newSelect });

            questionDiv.querySelector('.add-option-btn').addEventListener('click', () => addOption(questionIndex));
            questionDiv.querySelectorAll('.remove-option-btn').forEach(btn => {
                btn.addEventListener('click', removeOption);
            });

            questionIndex++;
        }

        function addOption(questionIdx) {
            const optionsList = document.querySelector(`#options-for-${questionIdx} .options-list`);
            const optionIndex = optionsList.children.length;
            const optionDiv = document.createElement('div');
            optionDiv.className = 'flex items-center gap-2 option-item';
            optionDiv.innerHTML = `
                <input type="text" name="questions[${questionIdx}][options][${optionIndex}][text]" placeholder="خيار ${optionIndex + 1}"
                    class="flex-1 px-4 py-2 border rounded-lg border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                <input type="hidden" name="questions[${questionIdx}][options][${optionIndex}][is_correct]" value="0">
                <input type="checkbox" name="questions[${questionIdx}][options][${optionIndex}][is_correct]" value="1"
                    class="h-4 w-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                <label class="text-sm text-gray-700">صحيح</label>
                <button type="button" class="remove-option-btn text-red-600 hover:text-red-700 ml-2">
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
            if (optionItem.parentElement.children.length > 1) {
                optionItem.remove();
            }
        }

        function handleTypeChange(event) {
            const select = event.target;
            const index = select.dataset.index;
            const selectedType = typesData.find(t => t.id == select.value)?.name;

            const optionsDiv = document.getElementById(`options-for-${index}`);
            const trueFalseDiv = document.getElementById(`true-false-for-${index}`);
            const shortAnswerDiv = document.getElementById(`short-answer-for-${index}`);

            [optionsDiv, trueFalseDiv, shortAnswerDiv].forEach(section => {
                if (section) section.style.display = 'none';
                if (section) section.querySelectorAll('input, select').forEach(el => el.disabled = true);
            });

            if (selectedType === 'اختيار من متعدد' && optionsDiv) {
                optionsDiv.style.display = 'block';
                optionsDiv.querySelectorAll('input').forEach(el => el.disabled = false);
            } else if (selectedType === 'صح أو خطأ' && trueFalseDiv) {
                trueFalseDiv.style.display = 'block';
                trueFalseDiv.querySelectorAll('input').forEach(el => el.disabled = false);
            } else if (selectedType === 'نص قصير' && shortAnswerDiv) {
                shortAnswerDiv.style.display = 'block';
                shortAnswerDiv.querySelectorAll('input').forEach(el => el.disabled = false);
            }

            // إزالة القيم غير الضرورية من النموذج
            const form = select.closest('form');
            if (selectedType !== 'صح أو خطأ' && trueFalseDiv) {
                const trueFalseInput = trueFalseDiv.querySelector('input[name="questions[' + index + '][correct_answer]"]');
                if (trueFalseInput) trueFalseInput.removeAttribute('checked');
            }
            if (selectedType !== 'نص قصير' && shortAnswerDiv) {
                const shortAnswerInput = shortAnswerDiv.querySelector('input[name="questions[' + index + '][correct_answer]"]');
                if (shortAnswerInput) shortAnswerInput.value = '';
            }
        }

        addQuestionBtn.addEventListener('click', createQuestionElement);
        questionsContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-question-btn')) {
                document.getElementById(e.target.dataset.target)?.remove();
            } else if (e.target.closest('.add-option-btn')) {
                const questionIdx = e.target.closest('.question-block').querySelector('.question-type-select').dataset.index;
                addOption(questionIdx);
            }
        });

        document.querySelectorAll('.question-type-select').forEach(select => {
            select.addEventListener('change', handleTypeChange);
            handleTypeChange({ target: select });
        });

        document.querySelectorAll('.add-option-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const questionIdx = btn.closest('.question-block').querySelector('.question-type-select').dataset.index;
                addOption(questionIdx);
            });
        });

        document.querySelectorAll('.remove-option-btn').forEach(btn => {
            btn.addEventListener('click', removeOption);
        });

        @if(!old('questions')) createQuestionElement(); @endif
    })();
</script>
@endsection