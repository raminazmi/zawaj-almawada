@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-4">
            <div
                class="inline-flex items-center bg-white px-4 py-2 gap-2 rounded-full shadow-lg border border-purple-200">
                <h1
                    class="text-lg font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    أسئلة الاختبار: {{ $exam->title }}
                </h1>
            </div>
        </div>

        <div class="mb-6 flex justify-end items-center">
            <a href="{{ route('admin.exams.questions.create', $exam) }}"
                class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                إضافة سؤال جديد
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-purple-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-purple-500 to-pink-500 text-white">
                        <tr>
                            <th class="py-4 px-4 text-right text-sm font-semibold">#</th>
                            <th class="py-4 px-4 text-right text-sm font-semibold">السؤال</th>
                            <th class="py-4 px-4 text-right text-sm font-semibold">نوع السؤال</th>
                            <th class="py-4 px-4 text-right text-sm font-semibold">العلامة</th>
                            <th class="py-4 px-4 text-right text-sm font-semibold">الإجابة الصحيحة</th>
                            <th class="py-4 px-4 text-center text-sm font-semibold w-48">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions as $q)
                        <tr class="bg-white shadow rounded-lg hover:bg-purple-50 transition-all">
                            <td class="py-3 px-4 text-right text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 text-right text-sm text-gray-700">{{ $q->question }}</td>
                            <td class="py-3 px-4 text-right text-sm text-gray-700">
                                <span
                                    class="px-3 py-1 rounded-full bg-purple-100 border border-purple-200 text-purple-600">
                                    @if($q->question_type_id == 1)
                                    اختيار من متعدد
                                    @elseif($q->question_type_id == 2)
                                    صح أو خطأ
                                    @elseif($q->question_type_id == 3)
                                    نص قصير
                                    @endif
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right text-sm text-gray-700">{{ $q->points }}</td>
                            <td class="py-3 px-4 text-right text-sm text-gray-700">
                                @if($q->question_type_id == 1)
                                <ul class="list-disc pr-4 text-right text-gray-700">
                                    @forelse($q->options as $opt)
                                    <li class="{{ $opt->is_correct ? 'font-bold text-green-600' : '' }}">
                                        {{ $opt->text }}
                                        @if($opt->is_correct)
                                        <span class="text-xs text-green-600">(الإجابة الصحيحة)</span>
                                        @endif
                                    </li>
                                    @empty
                                    <li><span class="text-gray-400">لا توجد خيارات</span></li>
                                    @endforelse
                                </ul>
                                @elseif($q->question_type_id == 2)
                                <span
                                    class="font-bold {{ $q->correct_answer == 'true' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $q->correct_answer == 'true' ? 'صح' : 'خطأ' }}
                                </span>
                                @elseif($q->question_type_id == 3)
                                @if($q->correct_answer)
                                <span class="text-gray-700">{{ $q->correct_answer }}</span>
                                @else
                                <span class="text-gray-400">-</span>
                                @endif
                                @else
                                <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 flex flex-wrap gap-2 justify-center">
                                <a href="{{ route('admin.exams.questions.edit', [$exam, $q]) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-600 rounded-md hover:bg-blue-200 transition-all">
                                    تعديل
                                </a>
                                <form action="{{ route('admin.exams.questions.destroy', [$exam, $q]) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-100 text-red-600 rounded-md hover:bg-red-200 transition-all delete-btn">
                                        حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 text-gray-500 text-center">لا توجد أسئلة بعد.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                const form = this.closest('form');
                event.preventDefault();
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "لن تتمكن من التراجع عن هذا الإجراء!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'نعم، قم بالحذف!',
                    cancelButtonText: 'إلغاء',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection