@extends('layouts.app')

@section('content')
<div class="min-h-screen pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-4">
            <div
                class="inline-flex items-center bg-white px-4 py-2 gap-2 rounded-full shadow-lg border border-purple-200">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h1
                    class="text-lg font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    قائمة الدورات
                </h1>
            </div>
        </div>

        <div class="mb-6 flex justify-end">
            <a href="{{ route('admin.courses.create') }}"
                class="px-4 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 transition-all">
                إضافة دورة
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-purple-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-pink-400 to-purple-500 text-white">
                        <tr>
                            <th class="py-4 px-2 text-center text-md font-semibold"> م </th>
                            <th class="py-4 px-2 text-center text-md font-semibold">العنوان</th>
                            <th class="py-4 px-2 text-center text-md font-semibold">رابط اليوتيوب</th>
                            <th class="py-4 px-2 text-center text-md font-semibold">رابط الكتاب</th>
                            <th class="py-4 px-2 text-center text-md font-semibold">التحكم</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($courses as $course)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                {{ $course->title }}
                            </td>
                            <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                <a href="{{ $course->youtube_playlist }}" target="_blank" rel="noopener noreferrer"
                                    class="text-blue-600 hover:underline">
                                    {{ $course->youtube_playlist }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-normal text-sm text-gray-900 text-center">
                                @if($course->ebook_url)
                                <a href="{{ $course->ebook_url }}" target="_blank" rel="noopener noreferrer"
                                    class="text-blue-600 hover:underline">
                                    {{ $course->ebook_url }}
                                </a>
                                @else
                                لا يوجد
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center space-x-2">
                                <a href="{{ route('admin.courses.edit', $course->id) }}"
                                    class="mx-2 px-4 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-all">
                                    تعديل
                                </a>
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST"
                                    class="inline-block delete-course">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition-all">
                                        حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 p-4">
                {{ $courses->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForms = document.querySelectorAll('.delete-course');
        
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "سيتم حذف هذه الدورة!",
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