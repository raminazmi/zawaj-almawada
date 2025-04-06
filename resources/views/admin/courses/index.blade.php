@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 space-y-4 sm:space-y-0">
            <div class="flex items-center bg-white px-6 py-3 rounded-full shadow-sm border border-purple-200">
                <h1
                    class="text-lg font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    دورة التأهيل للزواج
                </h1>
            </div>

            @if($courses->isEmpty())
            <a href="{{ route('admin.courses.create') }}"
                class="flex items-center px-6 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-md hover:opacity-90 transition-all">
                <i class="fas fa-plus-circle ml-2"></i>
                إضافة دورة
            </a>
            @endif
        </div>

        @if($courses->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center">
            <i class="fas fa-book-open text-4xl text-gray-400 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">لا يوجد دورة حالياً</h3>
            <p class="text-gray-600 max-w-md mx-auto">يمكنك بدء دورة جديدة لتقديم محتوى تأهيلي للمستخدمين</p>
        </div>
        @else
        @foreach($courses as $course)
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 mb-6">
            <div class="p-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2 md:mb-0">
                        <i class="fas fa-graduation-cap text-purple-600 ml-2"></i>
                        {{ $course->title }}
                    </h2>
                    <div class="flex space-x-3 gap-2 mt-2 md:mt-0">
                        <a href="{{ route('admin.courses.edit', $course->id) }}"
                            class="flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-sm hover:opacity-90">
                            <i class="fas fa-edit ml-2"></i>
                            تعديل
                        </a>
                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST"
                            class="delete-course">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg shadow-sm hover:opacity-90">
                                <i class="fas fa-trash ml-2"></i>
                                حذف
                            </button>
                        </form>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-3 text-purple-600">
                                <i class="fas fa-info-circle ml-2"></i>
                                المعلومات الأساسية
                            </h3>
                            <div class="space-y-2">
                                <p>
                                    <i class="fas fa-calendar-day text-blue-500 ml-2"></i>
                                    <span class="font-medium">تاريخ بدء الدورة :</span>
                                    {{ $course->start_date->translatedFormat('d M Y') }}
                                </p>
                                <p>
                                    <i class="fas fa-calendar-times text-red-500 ml-2"></i>
                                    <span class="font-medium">تاريخ انتهاء الدورة :</span>
                                    {{ $course->end_date->translatedFormat('d M Y') }}
                                </p>
                                <p>
                                    <i class="fas fa-link text-green-500 ml-2"></i>
                                    <span class="font-medium">رابط التسجيل:</span>
                                    <a href="{{ $course->registration_link }}" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        {{ Str::limit($course->registration_link, 30) }}
                                    </a>
                                </p>
                            </div>
                        </div>

                        @if($course->exam_date)
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-3 text-blue-600">
                                <i class="fas fa-file-alt ml-2"></i>
                                معلومات الامتحان
                            </h3>
                            <div class="space-y-2">
                                <p>
                                    <i class="fas fa-calendar-check ml-2"></i>
                                    <span class="font-medium">تاريخ الامتحان:</span>
                                    {{ $course->exam_date->translatedFormat('d M Y') }}
                                </p>
                                <p>
                                    <i class="fas fa-external-link-alt ml-2"></i>
                                    <span class="font-medium">رابط الامتحان:</span>
                                    <a href="{{ $course->exam_link }}" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        {{ Str::limit($course->exam_link, 30) }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-3 text-purple-600">
                                <i class="fas fa-photo-video ml-2"></i>
                                المحتوى التفاعلي
                            </h3>
                            <div class="space-y-2">
                                <p>
                                    <i class="fab fa-youtube text-red-500 ml-2"></i>
                                    <span class="font-medium">قائمة التشغيل:</span>
                                    <a href="{{ $course->youtube_playlist }}" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        {{ Str::limit($course->youtube_playlist, 30) }}
                                    </a>
                                </p>
                                @if($course->intro_video)
                                <p>
                                    <i class="fas fa-video ml-2 text-purple-500"></i>
                                    <span class="font-medium">الفيديو التعريفي:</span>
                                    <a href="{{ $course->intro_video }}" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        {{ Str::limit($course->intro_video, 30) }}
                                    </a>
                                </p>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($course->supporting_companies)
                            <div class="bg-purple-50 p-4 rounded-lg border border-purple-100">
                                <h3 class="text-lg font-semibold mb-3 text-purple-600 flex items-center">
                                    <i class="fas fa-handshake ml-2"></i>
                                    الشركات الداعمة
                                </h3>
                                <ul class="space-y-2">
                                    @foreach(is_array($course->supporting_companies) ? $course->supporting_companies :
                                    explode(',', $course->supporting_companies ?? '') as $company)
                                    @if(trim($company))
                                    <li
                                        class="flex items-center text-gray-700 bg-white p-3 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                        <i class="fas fa-building text-purple-500 ml-2"></i>
                                        {{ trim($company) }}
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if($course->honor_students)
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                <h3 class="text-lg font-semibold mb-3 text-blue-600 flex items-center">
                                    <i class="fas fa-award ml-2"></i>
                                    الحاصلون على امتياز
                                </h3>
                                <ul class="space-y-2">
                                    @foreach(is_array($course->honor_students) ? $course->honor_students :
                                    explode(',', $course->honor_students ?? '') as $student)
                                    @if(trim($student))
                                    <li
                                        class="flex items-center text-gray-700 bg-white p-3 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                        <i class="fas fa-user-graduate text-blue-500 ml-2"></i>
                                        {{ trim($student) }}
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <h3 class="text-lg font-semibold mb-3 text-gray-700">
                        <i class="fas fa-align-left text-purple-600 ml-2"></i>
                        وصف الدورة
                    </h3>
                    <p class="text-gray-700 leading-relaxed">{{ $course->description }}</p>
                </div>

                @if($course->episodes->count() > 0)
                <div class="border-t pt-6">
                    <h3 class="text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-list-ol text-purple-600 ml-2"></i>
                        حلقات الدورة
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($course->episodes as $episode)
                        <div
                            class="bg-white p-4 rounded-lg border border-gray-200 hover:border-purple-300 transition-colors">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-medium text-gray-800">
                                    <i class="fas fa-play-circle text-purple-600 ml-2"></i>
                                    {{ $episode->title }}
                                </h4>
                            </div>
                            <a href="{{ $episode->url }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                                {{ Str::limit($episode->url, 40) }}
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

@if($courses->isNotEmpty())
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForms = document.querySelectorAll('.delete-course');
        
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "سيتم حذف هذه الدورة بشكل دائم!",
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
@endpush
@endif
@endsection