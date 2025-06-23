@extends('layouts.app')
@section('content')
<div>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-[#3A8BCD]/20">
            <h2 class="text-3xl font-extrabold text-[#2A5C82] mb-8 text-center"
                style="font-family: 'Almarai', sans-serif;">
                إنشاء اختبار جديد
            </h2>
            <form action="{{ route('admin.exams.store') }}" method="POST" id="examForm">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-[#553566] mb-1">عنوان الاختبار</label>
                        <input type="text" name="title"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#3A8BCD] focus:border-[#3A8BCD]"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#553566] mb-1">وصف الاختبار</label>
                        <textarea name="description" rows="3"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#3A8BCD] focus:border-[#3A8BCD]"
                            required></textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-[#553566] mb-1">المدة (بالدقائق)</label>
                            <input type="number" name="duration"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#3A8BCD] focus:border-[#3A8BCD]"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#553566] mb-1">وقت البدء</label>
                            <input type="datetime-local" name="start_time"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#3A8BCD] focus:border-[#3A8BCD]"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#553566] mb-1">وقت الانتهاء</label>
                            <input type="datetime-local" name="end_time"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#3A8BCD] focus:border-[#3A8BCD]"
                                required>
                        </div>
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active"
                                class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-[#3A8BCD]">
                            <span class="mr-2 text-[#2A5C82] font-semibold">تفعيل الاختبار</span>
                        </label>
                    </div>
                    <div id="questions">
                        <h3 class="text-lg font-bold text-[#2A5C82] mb-4">الأسئلة</h3>
                        <div id="questionsList"></div>
                        <button type="button" onclick="addQuestion()"
                            class="mt-4 bg-gradient-to-l from-[#3A8BCD] to-[#553566] text-white px-6 py-2 rounded-full font-bold hover:opacity-90 transition">
                            إضافة سؤال
                        </button>
                    </div>
                    <div class="mt-8 flex justify-center">
                        <button type="submit"
                            class="bg-gradient-to-l from-[#3A8BCD] to-[#553566] text-white px-10 py-3 rounded-full text-lg font-bold shadow-lg hover:opacity-90 transition">
                            حفظ الاختبار
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let questionCount = 0;

    function addQuestion() {
        const questionsList = document.getElementById('questionsList');
        const questionDiv = document.createElement('div');
        questionDiv.className = 'border border-[#3A8BCD]/20 rounded-xl p-4 mb-6 bg-blue-50/30';
        questionDiv.innerHTML = `
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#553566] mb-1">نوع السؤال</label>
                <select name="questions[${questionCount}][question_type_id]" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" required onchange="toggleOptionsFields(this, ${questionCount})">
                    <option value="1">اختيار من متعدد</option>
                    <option value="2">صح أو خطأ</option>
                    <option value="3">نص قصير</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#553566] mb-1">السؤال</label>
                <input type="text" name="questions[${questionCount}][question]" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" required>
            </div>
            <div class="mb-4 options-fields">
                <label class="block text-sm font-bold text-[#553566] mb-1">الخيارات</label>
                <div class="space-y-2">
                    <input type="text" name="questions[${questionCount}][options][]" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" required>
                    <input type="text" name="questions[${questionCount}][options][]" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" required>
                    <input type="text" name="questions[${questionCount}][options][]" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" required>
                    <input type="text" name="questions[${questionCount}][options][]" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" required>
                </div>
            </div>
            <div class="mb-4 correct-answer-field">
                <label class="block text-sm font-bold text-[#553566] mb-1">الإجابة الصحيحة</label>
                <input type="text" name="questions[${questionCount}][correct_answer]" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#553566] mb-1">الدرجة</label>
                <input type="number" name="questions[${questionCount}][points]" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" required>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800 font-bold">
                حذف السؤال
            </button>
        `;
        questionsList.appendChild(questionDiv);
        questionCount++;
    }

    function toggleOptionsFields(select, idx) {
        const parent = select.closest('div').parentElement;
        const optionsFields = parent.querySelector('.options-fields');
        const correctAnswerField = parent.querySelector('.correct-answer-field');
        if (select.value == "1") { // اختيار من متعدد
            optionsFields.style.display = '';
            correctAnswerField.querySelector('input').type = 'text';
        } else if (select.value == "2") { // صح أو خطأ
            optionsFields.innerHTML = `
                <label class="block text-sm font-bold text-[#553566] mb-1">الخيارات</label>
                <div class="space-y-2">
                    <input type="text" name="questions[${idx}][options][]" value="صح" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" readonly>
                    <input type="text" name="questions[${idx}][options][]" value="خطأ" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" readonly>
                </div>
            `;
            optionsFields.style.display = '';
            correctAnswerField.querySelector('input').type = 'text';
        } else { // نص قصير
            optionsFields.style.display = 'none';
            correctAnswerField.querySelector('input').type = 'text';
        }
    }

    document.addEventListener('DOMContentLoaded', addQuestion);
</script>
@endpush
@endsection