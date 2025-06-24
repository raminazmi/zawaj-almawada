@php
$token = request('token') ?? request()->route('token');
@endphp
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="font-bold text-4xl bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                مقياس التوافق الزواجي
            </h2>
            <p class="mt-4 text-lg text-purple-700">أجب بصدق لتحصل على نتائج دقيقة</p>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl border border-purple-100 overflow-hidden">
            <div class="p-8">
                <div class="bg-pink-50 rounded-2xl p-8 mb-8 border border-pink-200">
                    <h2 class="flex flex-col items-start">
                        <span class="flex flex-col space-y-4">
                            <span class="text-xl font-bold text-purple-900 mb-4 flex items-center">
                                <i class="fas fa-exclamation-circle ml-2"></i>
                                تعهد الاستخدام:
                            </span>
                            <p class="text-gray-700 leading-relaxed text-lg">
                                أتعهد أمام الله وأمام الطرف الآخر بأن أجيب بصدق تام على كل عبارات المقياس،
                                كما أتعهد بعدم نسخ أو تصوير أو استخدام المقياس في أي موضع آخر دون إذن صاحبه.
                            </p>
                        </span>
                        <label for="swearCheckbox"
                            class="inline-flex items-center mt-6 cursor-pointer hover:opacity-90 transition-opacity">
                            <input id="swearCheckbox" type="checkbox"
                                class="form-checkbox h-6 w-6 ml-3 text-purple-600 border-2 border-purple-300 rounded-md">
                            <span class="text-xl font-bold text-purple-900">أتعهد</span>
                        </label>
                    </h2>
                </div>

                <div class="text-center">
                    <button id="startTestButton" type="button" disabled
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white text-lg font-semibold rounded-full transition-all duration-300 shadow-lg transform disabled:opacity-50 disabled:cursor-not-allowed hover:scale-105 hover:-translate-y-1">
                        <i class="fas fa-play-circle ml-2"></i>
                        ابدأ الاختبار الآن
                    </button>
                    <p class="mt-4 text-purple-600 text-sm">
                        <i class="fas fa-lock mr-1"></i>
                        جميع إجاباتك سرية ومشفرة
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="instructionsModal" onclick="closeInstructionsModal()"
        class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-75">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div onclick="event.stopPropagation()"
                class="bg-white rounded-2xl overflow-hidden shadow-xl w-full max-w-4xl relative max-h-[90vh] flex flex-col">
                <div class="p-8 overflow-y-auto">
                    <h2 class="text-3xl font-bold text-purple-900 mb-8 text-center">
                        دليل استخدام المقياس <strong class="text-red-500">(مهم جدًا)</strong>
                    </h2>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="p-6 bg-white rounded-xl shadow-sm border border-purple-50">
                            <h3 class="text-xl font-semibold text-purple-800 mb-4">أولاً:</h3>
                            <p class="text-gray-700 leading-relaxed">
                                اجب بكل صدق وأمانة على كل سؤال، فإجابتك ستبقى سرية ولن يعرفها الطرف الآخر أبداً،
                                وكذلك لن تُبلّغ أنت بإجاباته.
                            </p>
                        </div>
                        <div class="p-6 bg-white rounded-xl shadow-sm border border-purple-50">
                            <h3 class="text-xl font-semibold text-purple-800 mb-4">ثانياً:</h3>
                            <p class="text-gray-700 leading-relaxed">
                                اختر: (نعم أو لا) حسب الثابت والمستمر من الصفات والسلوك لديك، وليس الذي يحدث مرة وينتهي.
                            </p>
                        </div>
                        <div class="p-6 bg-white rounded-xl shadow-sm border border-purple-50">
                            <h3 class="text-xl font-semibold text-purple-800 mb-4">ثالثاً:</h3>
                            <p class="text-gray-700 leading-relaxed">
                                انتبه في دقة تحديد العبارة بحاسمة أو ليست حاسمة، فاختيارها كحاسمة تعني أنك لا تقبل بهذا
                                الشخص زوجاً أو زوجة إذا كان ليس بينك وبينه توافق حول تلك النقطة.
                            </p>
                        </div>
                        <div class="p-6 bg-white rounded-xl shadow-sm border border-purple-50">
                            <h3 class="text-xl font-semibold text-purple-800 mb-4">رابعاً:</h3>
                            <p class="text-gray-700 leading-relaxed">
                                لا تتوقع أن تجد توافق يصل إلى 100%، فأعلى نسبة وصلت حتى الآن هي (91%) تقريباً،
                                وحتى تأخذ قراراً سليماً عليك أن تنظر إلى نسبة التوافق.
                            </p>
                        </div>
                        <div class="p-6 bg-white rounded-xl shadow-sm border border-purple-50">
                            <h3 class="text-xl font-semibold text-purple-800 mb-4">خامساً:</h3>
                            <p class="text-gray-700 leading-relaxed">
                                أنصحك بالاستماع للفيديو التوضيحي كاملاً قبل بدء استخدام المقياس.
                            </p>
                        </div>
                        <div class="p-6 bg-white rounded-xl shadow-sm border border-purple-50">
                            <h3 class="text-xl font-semibold text-purple-800 mb-4">سادساً:</h3>
                            <p class="text-gray-700 leading-relaxed">
                                المقياس له شهادة ملكية فكرية، ولا يسمح إطلاقاً بنقله أو تصوير عباراته أو استخدامه في أي
                                دولة.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-auto bg-gradient-to-r from-purple-50 to-pink-50 p-4 text-center border-t">
                    <button id="agreeInstructionsButton" type="button"
                        class="inline-flex items-center px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white text-lg rounded-full transition-all">
                        متابعة
                        <i class="fas fa-arrow-circle-left mr-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="videoModal" onclick="closeVideoModal()"
        class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-75">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl overflow-hidden shadow-xl w-full max-w-4xl relative">
                <div class="aspect-video">
                    <iframe id="tutorialVideo" class="w-full h-full"
                        data-src="https://www.youtube.com/embed/9s8V0Q34AO0?autoplay=1" src="" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
                <div onclick="event.stopPropagation()"
                    class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 text-center md:text-end md:flex md:justify-between md:items-center">
                    <h1 class="mb-3 md:mb-0">مقطع يوضح كيفية استخدام مقياس التوافق الزواجي</h1>
                    <button id="continueTestButton" type="button"
                        data-href="{{ route('exam.index', ['token' => $token]) }}"
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-md font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        الاستمرار إلى الاختبار
                        <i class="fas fa-arrow-circle-left mr-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showInstructionsModal() {
        document.getElementById('instructionsModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeInstructionsModal() {
        document.getElementById('instructionsModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function showVideoModal() {
        const modal = document.getElementById('videoModal');
        const video = document.getElementById('tutorialVideo');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        video.src = video.getAttribute('data-src');
    }

    function closeVideoModal() {
        const modal = document.getElementById('videoModal');
        const video = document.getElementById('tutorialVideo');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        video.src = '';
    }

    document.addEventListener("DOMContentLoaded", function () {
        const startTestButton = document.getElementById("startTestButton");
        const swearCheckbox = document.getElementById('swearCheckbox');
        const agreeInstructionsButton = document.getElementById("agreeInstructionsButton");
        const continueTestButton = document.getElementById("continueTestButton");

        if (swearCheckbox && startTestButton) {
            swearCheckbox.addEventListener("change", function () {
                startTestButton.disabled = !swearCheckbox.checked;
            });
        }

        if (startTestButton) {
            startTestButton.addEventListener("click", function (e) {
                e.preventDefault();
                showInstructionsModal();
            });
        }

        if (agreeInstructionsButton) {
            agreeInstructionsButton.addEventListener("click", function (e) {
                e.preventDefault();
                closeInstructionsModal();
                showVideoModal();
            });
        }

        if (continueTestButton) {
            continueTestButton.addEventListener("click", function (e) {
                e.preventDefault();
                window.location.href = continueTestButton.getAttribute('data-href');
            });
        }
    });
</script>
@endsection