@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center mb-6">
                <a href="{{ route('admin.courses.index') }}"
                    class="flex items-center text-gray-600 hover:text-purple-600 ml-4">
                    <i class="fas fa-arrow-right"></i>
                </a>
                <h2 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-edit text-purple-600 ml-2"></i>
                    تعديل الدورة
                </h2>
            </div>

            <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    @foreach([
                    ['name' => 'title', 'label' => 'عنوان الدورة', 'icon' => 'heading', 'type' => 'text'],
                    ['name' => 'youtube_playlist', 'label' => 'رابط اليوتيوب', 'icon' => 'youtube', 'type' => 'url'],
                    ['name' => 'registration_link', 'label' => 'رابط التسجيل', 'icon' => 'link', 'type' => 'url'],
                    ['name' => 'ebook_url', 'label' => 'رابط الكتاب الإلكتروني', 'icon' => 'book', 'type' => 'url'],
                    ['name' => 'intro_video', 'label' => 'رابط الفيديو التعريفي', 'icon' => 'video', 'type' => 'url'],
                    ['name' => 'supporting_companies', 'label' => 'الشركات الداعمة (مفصولة بفواصل)', 'icon' =>
                    'building', 'type' => 'text']
                    ] as $field)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-{{ $field['icon'] }} text-purple-600 ml-2"></i>
                            {{ $field['label'] }}
                        </label>
                        <input type="{{ $field['type'] }}" name="{{ $field['name'] }}"
                            value="{{ old($field['name'], is_array($course->{$field['name']}) ? implode(',', $course->{$field['name']}) : $course->{$field['name']}) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        @error($field['name'])
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    @endforeach

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left text-purple-600 ml-2"></i>
                            الوصف
                        </label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('description', $course->description) }}</textarea>
                        @error('description')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- قسم الحلقات -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <i class="fas fa-list-ol text-purple-600 ml-2"></i>
                        حلقات الدورة
                    </h3>

                    <div id="episodes-container" class="space-y-4">
                        @foreach($course->episodes as $index => $episode)
                        <div class="episode-row bg-gray-50 p-4 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                                <div class="md:col-span-10">
                                    <div class="space-y-2">
                                        <div>
                                            <label class="text-sm text-gray-600">العنوان</label>
                                            <input type="text" name="episodes[{{ $index }}][title]"
                                                value="{{ old('episodes.' . $index . '.title', $episode->title) }}"
                                                class="w-full px-3 py-2 border rounded">
                                            @error('episodes.' . $index . '.title')
                                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="text-sm text-gray-600">الرابط</label>
                                            <input type="url" name="episodes[{{ $index }}][url]"
                                                value="{{ old('episodes.' . $index . '.url', $episode->url) }}"
                                                class="w-full px-3 py-2 border rounded">
                                            @error('episodes.' . $index . '.url')
                                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @if($index > 0)
                                <div class="md:col-span-2">
                                    <button type="button"
                                        class="remove-episode w-full px-3 py-2 bg-red-100 text-red-600 rounded hover:bg-red-200">
                                        <i class="fas fa-times ml-2"></i>
                                        حذف
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <button type="button" id="add-episode"
                        class="mt-4 px-4 py-2 bg-purple-100 text-purple-600 rounded-lg hover:bg-purple-200">
                        <i class="fas fa-plus-circle ml-2"></i>
                        إضافة حلقة
                    </button>
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg shadow-sm hover:opacity-90 transition-all">
                        <i class="fas fa-save ml-2"></i>
                        حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let episodeCount = {{ $course->episodes->count() }};

        document.getElementById('add-episode').addEventListener('click', function() {
            const container = document.getElementById('episodes-container');
            const newRow = document.createElement('div');
            newRow.className = 'episode-row bg-gray-50 p-4 rounded-lg mt-4';
            newRow.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    <div class="md:col-span-10">
                        <div class="space-y-2">
                            <div>
                                <label class="text-sm text-gray-600">العنوان</label>
                                <input type="text" name="episodes[${episodeCount}][title]" 
                                    value="{{ old('episodes.${episodeCount}.title') }}"
                                    class="w-full px-3 py-2 border rounded">
                                @error('episodes.${episodeCount}.title')
                                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm text-gray-600">الرابط</label>
                                <input type="url" name="episodes[${episodeCount}][url]" 
                                    value="{{ old('episodes.${episodeCount}.url') }}"
                                    class="w-full px-3 py-2 border rounded">
                                @error('episodes.${episodeCount}.url')
                                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <button type="button" 
                            class="remove-episode w-full px-3 py-2 bg-red-100 text-red-600 rounded hover:bg-red-200">
                            <i class="fas fa-times ml-2"></i> حذف
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(newRow);
            episodeCount++;

            newRow.querySelector('.remove-episode').addEventListener('click', function() {
                container.removeChild(newRow);
            });
        });

        document.querySelectorAll('.remove-episode').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('.episode-row');
                row.remove();
            });
        });
    });
</script>
@endsection