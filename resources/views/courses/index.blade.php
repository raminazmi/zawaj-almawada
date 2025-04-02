@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-center text-purple-600 mb-12 animate-fade-in-down">دورة التأهيل للحياة
            الزوجية</h1>

        @php
        $course = $courses->first();
        @endphp
        @if($course)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $course->title }}</h2>
                        <p class="text-gray-600 leading-relaxed">{{ $course->description }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($course->intro_video)
                        <a href="{{ $course->intro_video }}" target="_blank"
                            class="card-hover p-4 bg-white rounded-lg border border-gray-200 hover:border-purple-600 transition-all">
                            <div class="flex items-center">
                                <i class="fas fa-play-circle text-red-500 text-xl ml-2"></i>
                                <span class="text-gray-700">المقطع التوضيحي</span>
                            </div>
                        </a>
                        @endif

                        @if($course->ebook_url)
                        <a href="{{ $course->ebook_url }}" target="_blank"
                            class="card-hover p-4 bg-white rounded-lg border border-gray-200 hover:border-purple-600 transition-all">
                            <div class="flex items-center">
                                <i class="fas fa-book-open text-purple-600 text-xl ml-2"></i>
                                <span class="text-gray-700">الكتاب الإلكتروني</span>
                            </div>
                        </a>
                        @endif

                        <a href="{{ $course->youtube_playlist }}" target="_blank"
                            class="card-hover p-4 bg-white rounded-lg border border-gray-200 hover:border-purple-600 transition-all">
                            <div class="flex items-center">
                                <i class="fab fa-youtube text-red-600 text-xl ml-2"></i>
                                <span class="text-gray-700">قائمة التشغيل الكاملة</span>
                            </div>
                        </a>

                        @if($course->exam_link)
                        <a href="{{ $course->exam_link }}" target="_blank"
                            class="card-hover p-4 bg-white rounded-lg border border-gray-200 hover:border-purple-600 transition-all">
                            <div class="flex items-center">
                                <i class="fas fa-clipboard-check text-green-600 text-xl ml-2"></i>
                                <span class="text-gray-700">رابط دخول الامتحان</span>
                            </div>
                        </a>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600">
                        @if($course->start_date && $course->end_date)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar-alt text-purple-600 ml-2"></i>
                                <h4 class="text-sm font-semibold text-purple-800">فترة الدورة</h4>
                            </div> <label class="block text-sm font-medium text-gray-700 mb-2">
                                تاريخ البدء : {{ $course->start_date->translatedFormat('d M Y') }}<br>
                            </label>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                تاريخ الانتهاء : {{ $course->end_date->translatedFormat('d M Y') }}
                            </label>
                        </div>
                        @endif

                        @if($course->exam_date)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <i class="fas fa-clock ml-2 text-purple-600"></i>
                            تاريخ الامتحان : {{ $course->exam_date->translatedFormat('d M Y') }}
                        </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600">
                        @if(count($course->honor_students) > 0)
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-award text-green-600 ml-2"></i>
                                <h4 class="text-sm font-semibold text-green-800">الحاصلون على امتياز</h4>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @foreach($course->honor_students as $student)
                                <span class="px-3 py-1 bg-white text-green-700 rounded-full text-sm shadow-sm">
                                    {{ $student }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if(count($course->supporting_companies) > 0)
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h4 class="text-sm font-semibold text-purple-800 mb-2">
                                <i class="fas fa-handshake ml-2"></i>
                                المؤسسات الراعية
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($course->supporting_companies as $company)
                                <span class="px-3 py-1 bg-white text-purple-700 rounded-full text-sm shadow-sm">
                                    {{ $company }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 max-h-auto flex flex-col">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-list-ol ml-2 text-purple-600"></i>
                            محتوى الدورة
                        </h3>

                        <div
                            class="flex-grow overflow-y-auto max-h-[400px] mb-4 pr-2 scrollbar-thin scrollbar-thumb-purple-300 scrollbar-track-gray-100">
                            @foreach($course->episodes as $episode)
                            <button type="button"
                                class="episode-btn w-full text-right p-3 bg-white rounded-lg shadow-sm hover:shadow-md transition-all flex items-center justify-between group mb-2"
                                data-url="{{ $episode->url }}" data-title="{{ $episode->title }}"
                                data-index="{{ $loop->index }}">
                                <div class="flex items-center">
                                    <span class="text-purple-600 text-sm font-medium">#{{ $episode->episode_number
                                        }}</span>
                                    <span class="text-gray-700 mr-2 text-sm truncate">{{ $episode->title }}</span>
                                </div>
                                <i class="fas fa-play-circle text-gray-400 group-hover:text-purple-600 ml-2"></i>
                            </button>
                            @endforeach
                        </div>

                        <div class="mt-auto">
                            <a href="{{ $course->youtube_playlist }}" target="_blank"
                                class="w-full p-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all flex items-center justify-center text-center">
                                <i class="fab fa-youtube ml-2"></i>
                                مشاهدة جميع الحلقات على يوتيوب
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 pb-6">
                <a href="{{ $course->registration_link }}" target="_blank"
                    class="block w-full text-center bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-3 rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all shadow-lg">
                    <i class="fas fa-user-plus ml-2"></i>
                    سجل الآن في الدورة
                </a>
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-4 text-xl font-medium text-gray-900">لا يوجد دورات متاحة حالياً</h3>
            <p class="mt-2 text-gray-500">سيتم إضافة دورات جديدة قريباً، يمكنك متابعتنا للاطلاع على آخر التحديثات</p>
        </div> @endif
    </div>
</div>

<div id="videoModal" class="hidden fixed inset-0 z-50">
    <div id="closeModal" class="bg-black bg-opacity-75 backdrop-blur-sm" onclick="closeModal()">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl overflow-hidden shadow-xl w-full max-w-4xl relative transform transition-all"
                onclick="event.stopPropagation()">
                <div class="aspect-w-16 aspect-h-9 bg-black">
                    <iframe id="videoFrame" class="w-full h-96" src="" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>

                <div class="p-4 bg-gray-50">
                    <h3 id="videoTitle" class="text-lg font-semibold text-gray-800 mb-2"></h3>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <button id="prevEpisode" class="video-nav-btn mx-4">
                                <i class="fas fa-chevron-right"></i>
                                السابق
                            </button>
                            <span id="currentEpisode" class="text-sm text-gray-600">1/{{ count($course->episodes ?? [])
                                }}</span>
                            <button id="nextEpisode" class="video-nav-btn">
                                التالي
                                <i class="fas fa-chevron-left"></i>
                            </button>
                        </div>
                        <div class="w-24 h-1 bg-gray-200 rounded-full overflow-hidden">
                            <div id="progressBar" class="h-full bg-purple-600 transition-all duration-300"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .date-badge {
        @apply px-3 py-1 bg-white text-purple-700 rounded-full text-sm shadow-sm border border-purple-200;
    }

    .info-card {
        @apply p-4 rounded-lg transition-all duration-300 hover: shadow-md;
    }

    .scrollbar-thin::-webkit-scrollbar {
        width: 6px;
    }

    .scrollbar-thin::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #d8b4fe;
        border-radius: 10px;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: #c084fc;
    }

    .card-hover:hover {
        transform: translateY(-2px);
    }

    .video-nav-btn {
        @apply px-4 py-2 bg-white text-gray-700 rounded-md hover: bg-purple-600 hover:text-white transition-all flex items-center gap-2 border border-gray-200;
    }

    .animate-fade-in-down {
        animation: fadeInDown 0.5s ease-out;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    function closeVideoModal() {
        document.getElementById('videoModal').classList.add('hidden');
        document.getElementById('videoFrame').src = '';
    }

    document.getElementById('closeModal').addEventListener('click', closeVideoModal);
    document.getElementById('videoModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeVideoModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('videoModal').classList.contains('hidden')) {
            closeVideoModal();
        }
    });

    let currentEpisodeIndex = 0;
    const episodes = @json($course->episodes ?? []);
    const totalEpisodes = episodes.length;

    document.querySelectorAll('.episode-btn').forEach((btn, index) => {
        btn.addEventListener('click', () => showVideo(index));
    });

    const showVideo = (index) => {
        currentEpisodeIndex = index;
        const episode = episodes[index];
        const videoUrl = episode.url.replace('watch?v=', 'embed/') + '?autoplay=1';
        
        document.getElementById('videoFrame').src = videoUrl;
        document.getElementById('videoTitle').textContent = `الحلقة ${episode.episode_number}: ${episode.title}`;
        document.getElementById('currentEpisode').textContent = `${index + 1}/${totalEpisodes}`;
        document.getElementById('progressBar').style.width = `${((index + 1)/totalEpisodes)*100}%`;
        document.getElementById('videoModal').classList.remove('hidden');
    };

    document.getElementById('prevEpisode').addEventListener('click', () => {
        if(currentEpisodeIndex > 0) showVideo(currentEpisodeIndex - 1);
    });

    document.getElementById('nextEpisode').addEventListener('click', () => {
        if(currentEpisodeIndex < totalEpisodes - 1) showVideo(currentEpisodeIndex + 1);
    });
    function closeModal() {
        document.getElementById('videoModal').classList.add('hidden');
        document.getElementById('videoFrame').src = '';
    }

    document.querySelector('#videoModal > div').addEventListener('click', function(e) {
        e.stopPropagation();
    });

    document.getElementById('closeModal').addEventListener('click', closeModal);

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endsection