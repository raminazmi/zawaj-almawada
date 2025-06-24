@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-4">
            <div
                class="inline-flex items-center bg-white px-4 py-2 gap-2 rounded-full shadow-lg border border-purple-200">
                <h1
                    class="text-lg font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    إدارة اختبارات الدورات
                </h1>
            </div>
        </div>

        <div class="mb-6 flex justify-end items-center">
            <a href="{{ route('admin.exams.create') }}"
                class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                إضافة اختبار جديد
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-purple-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-purple-500 to-pink-500 text-white">
                        <tr>
                            <th class="py-4 px-4 text-right text-sm font-semibold">العنوان</th>
                            <th class="py-4 px-4 text-right text-sm font-semibold">الوصف</th>
                            <th class="py-4 px-4 text-right text-sm font-semibold">المدة</th>
                            <th class="py-4 px-4 text-center text-sm font-semibold w-48">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($exams as $exam)
                        <tr class="hover:bg-purple-50 transition-all">
                            <td class="py-3 px-4 text-right text-sm text-gray-700">{{ $exam->title }}</td>
                            <td class="py-3 px-4 text-right text-sm text-gray-700">{{ $exam->description }}</td>
                            <td class="py-3 px-4 text-right text-sm text-gray-700">{{ $exam->duration }} دقيقة</td>
                            <td class="py-3 px-4 flex flex-wrap gap-2 justify-center">
                                <a href="{{ route('admin.exams.edit', $exam) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-600 rounded-md hover:bg-blue-200 transition-all">
                                    تعديل
                                </a>
                                <a href="{{ route('admin.exams.questions', $exam) }}"
                                    class="px-3 py-1 bg-purple-100 text-purple-600 rounded-md hover:bg-purple-200 transition-all">
                                    الأسئلة
                                </a>
                                <form action="{{ route('admin.exams.destroy', $exam) }}" method="POST"
                                    class="inline-block delete-exam">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-100 text-red-600 rounded-md hover:bg-red-200 transition-all">
                                        حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if($exams->isEmpty())
                        <tr>
                            <td colspan="4" class="py-8 text-center text-gray-500">لا توجد اختبارات حالياً.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForms = document.querySelectorAll('.delete-exam');
        
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "سيتم حذف هذا الاختبار!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'حذف',
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