@extends('layouts.app')

@section('content')
<div>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-[#3A8BCD]/20">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-extrabold text-[#2A5C82]" style="font-family: 'Almarai', sans-serif;">
                    أسئلة الاختبار: {{ $exam->title }}
                </h2>
                <a href="{{ route('admin.exams.questions.create', $exam) }}"
                    class="bg-[#3A8BCD] hover:bg-[#2A5C82] text-white font-bold py-2 px-5 rounded-lg shadow transition">
                    + إضافة سؤال جديد
                </a>
            </div>
            <table class="w-full text-center border-separate border-spacing-y-2">
                <thead>
                    <tr class="bg-[#f0f4fa] text-[#2A5C82]">
                        <th class="py-3">#</th>
                        <th>السؤال</th>
                        <th>نوع السؤال</th>
                        <th>الإجابة الصحيحة</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($questions as $q)
                    <tr class="bg-white shadow rounded-lg">
                        <td class="py-2 font-bold">{{ $loop->iteration }}</td>
                        <td class="py-2">{{ $q->question }}</td>
                        <td class="py-2">
                            <span class="px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-[#3A8BCD]">
                                @if($q->question_type_id == 1)
                                اختيار من متعدد
                                @elseif($q->question_type_id == 2)
                                صح أو خطأ
                                @elseif($q->question_type_id == 3)
                                نص قصير
                                @endif
                            </span>
                        </td>
                        <td class="py-2">
                            @if($q->question_type_id == 1)
                            <ul class="list-disc pr-4 text-right">
                                @forelse($q->options as $opt)
                                <div class="{{ $opt->is_correct ? 'font-bold text-green-600' : '' }}">
                                    {{ $opt->text }}
                                    @if($opt->is_correct)
                                    <span class="text-xs text-green-600">(الإجابة الصحيحة)</span>
                                    @endif
                                </div>
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
                        <td class="">
                            <div class="flex items-center justify-center gap-x-4">
                                <a href="{{ route('admin.exams.questions.edit', [$exam, $q]) }}"
                                    class="text-blue-500 hover:text-blue-700 transition" title="تعديل">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd"
                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.exams.questions.destroy', [$exam, $q]) }}" method="POST"
                                    class="inline mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-red-500 hover:text-red-700 transition delete-btn"
                                        title="حذف">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-gray-400">لا توجد أسئلة بعد.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'نعم، قم بالحذف!',
                    cancelButtonText: 'إلغاء'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    });
</script>
@endsection