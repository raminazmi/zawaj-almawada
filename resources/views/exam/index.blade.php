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

                @if($token)
                <div id="usage_section" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-8">
                        <div class="bg-pink-50 rounded-2xl p-8 mb-8 border border-pink-200">
                            <h2 class="flex flex-col items-start">
                                <span class="flex flex-col space-y-4">
                                    <span class="text-xl font-bold text-purple-900 mb-4 flex items-center">
                                        <i class="fas fa-exclamation-circle ml-2"></i>
                                        قسم الاستخدام:
                                    </span>
                                    <p class="text-gray-700 leading-relaxed text-lg">
                                        حتى أكون صادقاً أمام الله وأمام الطرف الآخر، أقسم بالله العظيم أن أجيب بصدق تام
                                        على كل عبارات المقياس،
                                        <br>
                                        كما أقسم ألا أنسخ أو أصور أو استخدام المقياس في أي موضع آخر دون أذن صاحبه.
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
                            <a id="startTestButton" href="{{ route('exam.index', ['token' => $token]) }}"
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

        <div id="questions_section" style="{{ $token ? 'display:none;' : '' }}">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div id="questions_container" class="bg-white overflow-hidden shadow-sm rounded-lg py-4">
                    @include('exam.question')
                </div>
            </div>
        </div>
    </div>

    <slot name="scripts">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            function getImportant(){
                return $('#is_important').is(':checked');
            }

            $(document).on('click', '.action__btn', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let answer = $(this).data('answer');
                $.ajax({
                    url: "{{ route('exam.save-answer') }}",
                    type: "POST",
                    beforeSend: function(){
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

            document.addEventListener("DOMContentLoaded", function () {
                let usageSection = document.getElementById("usage_section"); 
                let questionsSection = document.getElementById("questions_section");

                if (usageSection) {
                    questionsSection.style.display = "none";
                    let startButton = document.getElementById("startTestButton");
                    startButton.addEventListener("click", function (e) {
                        e.preventDefault();
                        usageSection.style.display = "none";
                        questionsSection.style.display = "block";
                    });
                }
            });
        </script>
    </slot>
</x-app-layout>