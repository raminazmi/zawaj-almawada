@php
$token = request('token') ?? request()->route('token');
@endphp
@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="font-bold text-4xl bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                مقياس التوافق الزواجي
            </h2>
            <p class="mt-4 text-lg text-purple-700">أجب بصدق لتحصل على نتائج دقيقة</p>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl border border-purple-100 overflow-hidden">
            <div class="p-8">
                <div class="max-w-3xl mx-auto">
                    <div class="bg-pink-50 rounded-2xl p-8 mb-8 border border-pink-200">
                        <h2 class="flex flex-col items-start">
                            <span class="flex flex-col space-y-4">
                                <span class="text-xl font-bold text-purple-900 mb-4 flex items-center">
                                    <i class="fas fa-exclamation-circle ml-2"></i>
                                    تعهد الاستخدام:
                                </span>
                                <p class="text-gray-700 leading-relaxed text-lg">
                                    أتعهد أمام الله وأمام الطرف الآخر بأن أجيب بصدق تام على كل عبارات المقياس،
                                    كما أتعهد بعدم نسخ أو تصوير أو استخدام المقياس في أي موضع آخر دون إذن
                                    صاحبه.
                                </p>
                            </span>
                            <label for="swearCheckbox"
                                class="inline-flex items-center mt-6 cursor-pointer hover:opacity-90 transition-opacity">
                                <input id="swearCheckbox" type="checkbox"
                                    class="form-checkbox h-6 w-6 ml-3 text-yellow-600 border-pink-300 rounded-lg transition-all duration-300">
                                <span class="text-xl font-bold text-purple-900">أتعهد</span>
                            </label>
                        </h2>
                    </div>
                    <div class="text-center">
                        <button id="startTestButton" type="button"
                            class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-700 text-white text-lg font-semibold rounded-full transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                            <i class="fas fa-play-circle ml-2"></i>
                            ابدأ الاختبار الآن
                        </button>
                    </div>
                    <section class="py-12 px-4 sm:px-8 lg:px-16 space-y-8">
                        <div class="container mx-auto px-4">
                            <h2 class="text-3xl font-bold text-purple-900 mb-12 text-start section-title">
                                دليل استخدام المقياس <strong class="text-red-500">(مهم جدا)</strong>
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                                <div
                                    class="p-4 md:p-6 bg-white w-full rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-purple-50 hover:border-purple-100">
                                    <h3 class="text-xl md:text-2xl font-semibold text-purple-800 mb-4">أولاً:</h3>
                                    <p class="text-gray-700 leading-relaxed md:leading-loose">
                                        اجب بكل صدق وأمانة على كل سؤال، فإجابتك ستبقى سرية ولن يعرفها الطرف الآخر أبداً،
                                        وكذلك لن تُبلّغ أنت بإجاباته.
                                    </p>
                                </div>
                                <div
                                    class="p-4 md:p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-purple-50 hover:border-purple-100">
                                    <h3 class="text-xl md:text-2xl font-semibold text-purple-800 mb-4">ثانياً:</h3>
                                    <p class="text-gray-700 leading-relaxed md:leading-loose">
                                        اختر: (نعم أو لا) حسب الثابت والمستمر من الصفات والسلوك لديك، وليس الذي يحدث مرة
                                        وينتهي.
                                    </p>
                                </div>
                                <div
                                    class="p-4 md:p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-purple-50 hover:border-purple-100">
                                    <h3 class="text-xl md:text-2xl font-semibold text-purple-800 mb-4">ثالثاً:</h3>
                                    <p class="text-gray-700 leading-relaxed md:leading-loose">
                                        انتبه في دقة تحديد العبارة بحاسمة أو ليست حاسمة، فاختيارها كحاسمة تعني أنك لا
                                        تقبل بهذا الشخص زوجاً أو زوجة إذا كان ليس بينك وبينه توافق حول تلك النقطة.
                                    </p>
                                </div>
                                <div
                                    class="p-4 md:p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-purple-50 hover:border-purple-100">
                                    <h3 class="text-xl md:text-2xl font-semibold text-purple-800 mb-4">رابعاً:</h3>
                                    <p class="text-gray-700 leading-relaxed md:leading-loose">
                                        لا تتوقع أن تجد توافق يصل إلى 100%، فأعلى نسبة وصلت حتى الآن هي (91%) تقريباً،
                                        وحتى تأخذ قراراً سليماً عليك أن تنظر إلى نسبة التوافق.
                                    </p>
                                </div>
                                <div
                                    class="p-4 md:p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-purple-50 hover:border-purple-100">
                                    <h3 class="text-xl md:text-2xl font-semibold text-purple-800 mb-4">خامساً:</h3>
                                    <p class="text-gray-700 leading-relaxed md:leading-loose">
                                        أنصحك بالاستماع للفيديو التوضيحي كاملاً قبل بدء استخدام المقياس.
                                    </p>
                                </div>
                                <div
                                    class="p-4 md:p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-purple-50 hover:border-purple-100">
                                    <h3 class="text-xl md:text-2xl font-semibold text-purple-800 mb-4">سادساً:</h3>
                                    <p class="text-gray-700 leading-relaxed md:leading-loose">
                                        المقياس له شهادة ملكية فكرية، ولا يسمح إطلاقاً بنقله أو تصوير عباراته أو
                                        استخدامه في أي دولة.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="videoModal" onclick="closeModal()" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-75">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl overflow-hidden shadow-xl w-full max-w-4xl relative">
            <div class="aspect-video">
                <iframe id="tutorialVideo" class="w-full h-full"
                    data-src="https://www.youtube.com/embed/9s8V0Q34AO0?autoplay=1" src="" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <div onclick="event.stopPropagation()"
                class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 text-center md:text-end md:flex md:justify-between md:items-center md:flex-wrap">
                <h1 class="mb-3 md:mb-0">مقطع يوضح كيفية استخدام مقياس التوافق الزواجي</h1>
                <button id="continueTestButton" type="button" data-href="{{ route('exam.index', ['token' => $token]) }}"
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-md font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                    الاستمرار إلى الاختبار
                    <i class="fas fa-arrow-circle-left mr-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
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

    document.addEventListener("DOMContentLoaded", function () {
        const startTestButton = document.getElementById("startTestButton");
        if (startTestButton) {
            startTestButton.addEventListener("click", function (e) {
                e.preventDefault();
                const swearCheckbox = document.getElementById('swearCheckbox');
                if (!swearCheckbox?.checked) {
                    alert('يجب عليك الضغط على "أتعهد" قبل بدء الاختبار.');
                    return;
                }
                showVideoModal();
            });
        }

        const continueTestButton = document.getElementById("continueTestButton");
        if (continueTestButton) {
            continueTestButton.addEventListener("click", function (e) {
                e.preventDefault();
                window.location.href = continueTestButton.getAttribute('data-href');
            });
        }
    });
</script>
@endsection