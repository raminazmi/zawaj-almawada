<head>
    <title>موقع زواج المودة</title>
</head>
<x-app-layout>
    <div class="min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-6">
                <h2
                    class="font-bold text-4xl bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    مقياس التوافق الزواجي
                </h2>
                <p class="mt-4 text-lg text-purple-700">أجب بصدق لتحصل على نتائج دقيقة</p>

                @php
                $token = request('token') ?? request()->route('token');
                @endphp

                @if ($token)
                <div id="usage_section" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-8">
                        <div class="bg-pink-50 rounded-2xl p-8 mb-8 border border-pink-200">
                            <h2 class="flex flex-col items-start">
                                <span class="flex flex-col space-y-4">
                                    <span class="text-xl font-bold text-purple-900 mb-4 flex items-center">
                                        <i class="fas fa-exclamation-circle ml-2"></i>
                                        قسم الاستخدام:
                                    </span>
                                    <p class="text-gray-700 leading-relaxed text-lg text-start">
                                        حتى أكون صادقاً أمام الله وأمام الطرف الآخر، أقسم بالله العظيم أن أجيب بصدق تام
                                        على كل عبارات المقياس، كما أقسم ألا أنسخ أو أصور أو استخدام المقياس في أي موضع
                                        آخر دون أذن صاحبه.
                                    </p>
                                </span>
                                <label for="swearCheckbox"
                                    class="inline-flex items-center mt-6 cursor-pointer hover:opacity-90 transition-opacity">
                                    <input id="swearCheckbox" type="checkbox"
                                        class="form-checkbox h-6 w-6 ml-3 text-yellow-600 border-pink-300 rounded-lg transition-all duration-300">
                                    <span class="text-xl font-bold text-purple-900">أُقسم</span>
                                </label>
                            </h2>
                        </div>

                        <div class="text-center">
                            <a id="startVideoButton"
                                class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-700 text-white text-lg font-semibold rounded-full transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                                <i class="fas fa-play-circle ml-2"></i>
                                ابدأ الاختبار الآن
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div id="questions_section">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div id="questions_container" class="bg-white overflow-hidden shadow-sm rounded-lg py-4">
                    @include('exam.question')
                </div>
            </div>
        </div>
    </div>

    <div id="videoModal" onclick="closeModal()"
        class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-75">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl overflow-hidden shadow-xl w-full max-w-4xl relative">
                <button onclick="closeModal()" class="absolute top-4 left-4 text-gray-500 hover:text-gray-700 z-50">
                    <i class="fas fa-times text-2xl"></i>
                </button>

                <div class="aspect-w-16 aspect-h-9">
                    <iframe id="tutorialVideo" class="w-full h-96"
                        data-src="https://www.youtube.com/embed/dOCXj51ytPg?autoplay=1&controls=1&modestbranding=1&rel=0"
                        src="" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>

                <div
                    class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 text-center md:text-end md:flex md:justify-between md:items-center md:flex-wrap ">
                    <h1 class="mb-3 md:mb-0"> مقطع يوضح كيفية استخدام مقياس التوافق الزواجي </h1>
                    <a id="startTestButton" href="{{ route('exam.index', ['token' => $token]) }}"
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-md font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        الاستمرار إلى الاختبار
                        <i class="fas fa-arrow-circle-left mr-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <slot name="scripts">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            function getImportant() {
                return $('#is_important').is(':checked');
            }

            $(document).on('click', '.action__btn', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let answer = $(this).data('answer');
                $.ajax({
                    url: "{{ route('exam.save-answer') }}",
                    type: "POST",
                    beforeSend: function() {
                        $('.action__btn').attr('disabled', true);
                    },
                    data: {
                        question_id: id,
                        answer: answer,
                        exam_id: "{{ $exam->id }}",
                        _token: "{{ csrf_token() }}",
                        is_important: getImportant(),
                    },
                    success: function(response) {
                        $('#questions_container').html(response.html);
                        if (response.lastQuestion) {
                            window.location.href = "{{ url('/my-exams') }}" + '/' + response.examId;
                        }
                    }
                });
            });

            document.addEventListener("DOMContentLoaded", function() {
                const startVideoButton = document.getElementById("startVideoButton");
                const startTestButton = document.getElementById("startTestButton");
                const swearCheckbox = document.getElementById("swearCheckbox");

                if (startVideoButton) {
                    startVideoButton.addEventListener("click", function(e) {
                        if (!swearCheckbox?.checked) {
                            alert('يجب عليك الضغط على "أقسم" قبل بدء الاختبار.');
                            return;
                        }
                        showVideoModal();
                    });
                } else if (startTestButton) {
                    startTestButton.addEventListener("click", function(e) {
                        e.preventDefault();
                        closeModal();
                    });
                }
            });

            document.addEventListener("DOMContentLoaded", function() {
                let usageSection = document.getElementById("usage_section");
                let questionsSection = document.getElementById("questions_section");

                if (usageSection) {
                    questionsSection.style.display = "none";
                    let startButton = document.getElementById("startTestButton");
                    startButton.addEventListener("click", function(e) {
                        e.preventDefault();
                        usageSection.style.display = "none";
                        questionsSection.style.display = "block";
                    });
                }
            });

            function showVideoModal() {
                const modal = document.getElementById('videoModal');
                const video = document.getElementById('tutorialVideo');
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                video.src = video.getAttribute('data-src');
            }

            function closeModal() {
                const modal = document.getElementById('videoModal');
                const video = document.getElementById('tutorialVideo');
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                video.src = '';
            }
        </script>
    </slot>
</x-app-layout>