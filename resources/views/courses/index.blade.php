@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-center text-purple-600 mb-12">دورات التأهيل للزواج</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($courses as $course)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition hover:scale-105">
                <div class="p-6 pt-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">{{ $course->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($course->description, 100) }}</p>

                    <div class="space-y-3">
                        @if($course->ebook_url)
                        <a href="{{ $course->ebook_url }}" target="_blank"
                            class="flex items-center text-purple-600 hover:text-purple-800">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            تحميل الكتاب الإلكتروني
                        </a>
                        @endif

                        <a href="{{ $course->youtube_playlist }}" target="_blank"
                            class="flex items-center text-red-600 hover:text-red-800">
                            <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                            </svg>
                            قائمة التشغيل على يوتيوب
                        </a>
                        @if(count($course->supporting_companies) > 0)
                        <div class="mt-6 py-4 border-b border-gray-100">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">الشركات الداعمة:</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($course->supporting_companies as $company)
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                    {{ $company }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <a href="{{ $course->registration_link }}" target="_blank"
                            class="inline-block w-full text-center bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                            سجل الآن
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-medium text-gray-900">لا يوجد دورات متاحة حالياً</h3>
                    <p class="mt-2 text-gray-500">سيتم إضافة دورات جديدة قريباً، يمكنك متابعتنا للاطلاع على آخر
                        التحديثات</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection