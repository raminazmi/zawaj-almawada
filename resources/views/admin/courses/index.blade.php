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
        @php $course = $courses->first(); @endphp
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
            <div class="p-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2 md:mb-0">
                        {{ $course->title }}
                    </h2>
                    <div class="flex space-x-3 gap-2">
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

                <div class="space-y-4 text-gray-600">
                    <div class="flex items-start">
                        <i class="fas fa-align-left text-purple-600 mt-1 ml-3"></i>
                        <p class="flex-1">{{ $course->description }}</p>
                    </div>

                    <div class="flex items-center">
                        <i class="fas fa-link text-purple-600 ml-3"></i>
                        <a href="{{ $course->youtube_playlist }}" target="_blank"
                            class="text-blue-600 hover:underline break-all">
                            {{ $course->youtube_playlist }}
                        </a>
                    </div>

                    @if($course->ebook_url)
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-purple-600 ml-3"></i>
                        <a href="{{ $course->ebook_url }}" target="_blank"
                            class="text-blue-600 hover:underline break-all">
                            رابط الكتاب الإلكتروني
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection