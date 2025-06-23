@extends('layouts.app')

@section('content')
<div class="flex items-start justify-center p-4 py-10">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-6 border border-purple-100">
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                إدارة رابط اختبار الجاهزية للحياة الزوجية
            </h2>
            <p class="text-gray-500 mt-2">أضف أو عدّل الرابط</p>
        </div>

        @if($link->exists)
        <div class="pt-6 flex flex-col items-center justify-center w-full">
            <div class="w-full">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">رابط اختبار الجاهزية للحياة
                            الزوجية</label>
                        <input type="url" form="updateForm" name="link" value="{{ $link->link }}"
                            class="w-full px-4 py-2 border rounded-lg @error('link') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                        @error('link')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-center gap-3 mt-4">
                    <form id="updateForm" method="POST" action="{{ route('admin.readiness_test_link.update', $link) }}"
                        class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            تحديث
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.readiness_test_link.destroy', $link) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                            حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @else
        <form action="{{ route('admin.readiness_test_link.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">رابط اختبار الجاهزية للحياة
                        الزوجية</label>
                    <input type="text" name="link"
                        class="w-full px-4 py-2 border rounded-lg @error('link') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                        placeholder="https://example.com">
                    @error('link')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="pt-6 flex justify-end gap-3">
                <button type="submit"
                    class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                    إضافة
                </button>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection