@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-4">
                <div
                    class="inline-flex items-center bg-white px-4 py-2 gap-2 rounded-full shadow-lg border border-purple-200">
                    <h1
                        class="text-lg font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                        قائمة الأسئلة
                    </h1>
                </div>
            </div>

            <div class="mb-6 flex justify-end">
                <a href="{{ route('admin.questions.create') }}"
                    class="px-4 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 transition-all">
                    إضافة سؤال
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-xl border border-purple-100 overflow-hidden">
                <div class="">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-pink-400 to-purple-500 text-white">
                                <tr>
                                    <th class="py-4 px-6 text-start text-md font-semibold"> #</th>
                                    <th class="py-4 px-6 text-start text-md font-semibold">سؤال الخاطب</th>
                                    <th class="py-4 px-6 text-start text-md font-semibold">سؤال المخطوبة</th>
                                    <th class="py-4 px-6 text-center text-md font-semibold">التحكم</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($questions as $question)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-900">
                                        {{ $question->male_question }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-900">
                                        {{ $question->female_question }}
                                    </td>
                                    <td class="px-4 py-4 text-center flex gap-2">
                                        <a href="{{ route('admin.questions.edit', $question->id) }}"
                                            class="px-3 py-1 bg-blue-100 text-blue-600 rounded-md hover:bg-blue-200 transition-all">
                                            تعديل
                                        </a>
                                        <form action="{{ route('admin.questions.destroy', $question->id) }}"
                                            method="POST" class="inline-block delete-question">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-100 text-red-600 rounded-md hover:bg-red-200 transition-all">
                                                حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 mb-3 px-4">
                        {{ $questions->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleteForms = document.querySelectorAll('.delete-question');
            
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'هل أنت متأكد؟',
                        text: "سيتم حذف هذا السؤال!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'حذف',
                        cancelButtonText: 'إلغاء'
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