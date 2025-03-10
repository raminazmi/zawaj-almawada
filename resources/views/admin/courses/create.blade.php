@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-3xl w-full mx-auto p-6 bg-white rounded-xl shadow-lg border border-gray-200">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                إضافة دورة جديدة
            </h2>
        </div>

        <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">عنوان الدورة</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 @error('title') border-red-500 @enderror">
                @error('title')
                <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">الوصف</label>
                <textarea id="description" name="description" rows="3"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="ebook_url" class="block text-sm font-medium text-gray-700">رابط الكتاب
                        الإلكتروني</label>
                    <input type="url" id="ebook_url" name="ebook_url" value="{{ old('ebook_url') }}"
                        class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 @error('ebook_url') border-red-500 @enderror">
                    @error('ebook_url')
                    <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="youtube_playlist" class="block text-sm font-medium text-gray-700">رابط اليوتيوب</label>
                    <input type="url" id="youtube_playlist" name="youtube_playlist"
                        value="{{ old('youtube_playlist') }}"
                        class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 @error('youtube_playlist') border-red-500 @enderror">
                    @error('youtube_playlist')
                    <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="registration_link" class="block text-sm font-medium text-gray-700">رابط التسجيل</label>
                <input type="url" id="registration_link" name="registration_link" value="{{ old('registration_link') }}"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 @error('registration_link') border-red-500 @enderror">
                @error('registration_link')
                <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="supporting_companies" class="block text-sm font-medium text-gray-700">الشركات
                    الداعمة</label>
                <input type="text" id="supporting_companies" name="supporting_companies"
                    value="{{ old('supporting_companies') }}"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 @error('supporting_companies') border-red-500 @enderror"
                    placeholder="شركة 1, شركة 2, شركة 3">
                @error('supporting_companies')
                <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg shadow-md hover:opacity-90 transition-all">
                    حفظ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection