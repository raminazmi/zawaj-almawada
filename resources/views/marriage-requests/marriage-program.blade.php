@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="font-bold text-4xl bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                برنامج الزواج الشرعي
            </h2>
        </div>
        @if(Auth::user()->status === 'engaged' || Auth::user()->status === 'pending')
        @if(Auth::user()->status === 'engaged' || Auth::user()->status === 'pending')
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if(Auth::user()->status === 'engaged')
            <div
                class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-2xl shadow-lg mb-8 border border-green-100">
                <div class="text-center space-y-4">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <i class="fas fa-check-circle text-green-600 text-3xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">مبروك! تمت الخطوبة بنجاح</h2>
                    <p class="text-lg text-emerald-600 font-medium">{{ $partner->name ?? 'غير محدد' }}</p>
                </div>

                @if($partner)
                <div class="mt-8 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-user-circle text-blue-500"></i>
                        بيانات الطرف الآخر
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                        <div class="space-y-2">
                            <label class="text-sm text-gray-500">الاسم الكامل</label>
                            <p class="font-medium">{{ $partner->full_name }}</p>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm text-gray-500">البلد</label>
                            <p class="font-medium">{{ $partner->country }}</p>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm text-gray-500">الولاية</label>
                            <p class="font-medium">{{ $partner->state }}</p>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm text-gray-500">القبيلة</label>
                            <p class="font-medium">{{ $partner->tribe }}</p>
                        </div>
                    </div>
                    <x-target-info-card :target="$marriageRequest->target"
                        :link="$marriageRequest->compatibility_test_link" />
                    @if($testResult)
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-chart-pie text-emerald-500 mr-2"></i>
                            نتائج اختبار التوافق
                        </h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">نسبة التوافق</span>
                                <span class="text-xl font-bold text-emerald-600">{{ $testResult }}%</span>
                            </div>
                            <div class="bg-gray-100 rounded-full h-2.5">
                                <div class="bg-emerald-500 h-2.5 rounded-full" style="width: {{ $testResult }}%"></div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <p class="text-sm text-blue-800">
                                        <i class="fas fa-male text-blue-600 mr-1"></i>
                                        النقاط الحاسمة للخاطب : {{ $maleImportantScore['score'] }}/{{
                                        $maleImportantScore['total'] }}
                                    </p>
                                </div>
                                <div class="bg-pink-50 p-4 rounded-lg">
                                    <p class="text-sm text-pink-800">
                                        <i class="fas fa-female text-pink-600 mr-1"></i>
                                        النقاط الحاسمة للمخطوبة : {{ $femaleImportantScore['score'] }}/{{
                                        $femaleImportantScore['total'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    @if($marriageRequest->compatibility_test_link)
                    <div class="mt-8 text-center bg-indigo-50 p-6 rounded-xl">
                        <div class="max-w-md mx-auto">
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">
                                <i class="fas fa-clipboard-check text-indigo-600 mr-2"></i>
                                اختبار التوافق
                            </h4>
                            <p class="text-sm text-gray-600 mb-4">هذا الاختبار ضروري لإتمام عملية الموافقة على الطلب</p>
                            <a href="{{ $marriageRequest->compatibility_test_link }}"
                                class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-all transform hover:scale-105 shadow-md">
                                <i class="fas fa-play-circle ml-2"></i>
                                بدء الاختبار الآن
                            </a>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
                @endif

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-500">
                        <i class="fas fa-envelope mr-1"></i>
                        تم إرسال التفاصيل الكاملة إلى بريدك الإلكتروني
                    </p>
                </div>
            </div>

            @elseif(Auth::user()->status !== 'available')
            <section class="py-0 px-4 sm:px-8 lg:px-16">
                <div class="container mx-auto px-4">
                    <div
                        class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-100 p-8 rounded-2xl shadow-lg">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 pt-1">
                                <i class="fas fa-hourglass-half text-[#d4b341] text-2xl"></i>
                            </div>
                            <div class="mr-3 flex items-center justify-between gap-2 w-full flex-wrap">
                                <div>
                                    <h3 class="text-xl font-bold text-purple-900">طلب قيد المراجعة</h3>
                                    <div class="mt-2 text-gray-700">
                                        <p>لديك طلب خطوبة نشط مع
                                            <span class="font-medium">
                                                @if($marriageRequest)
                                                {{ $marriageRequest->user_id === Auth::id() ?
                                                $marriageRequest->target->name
                                                :
                                                $marriageRequest->user->name ?? 'غير محدد' }}
                                                @else
                                                غير محدد
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('marriage-requests.status') }}"
                                        class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-sm font-medium rounded-lg transition-all transform hover:scale-105 shadow-md">
                                        <i class="fas fa-clock ml-2"></i>
                                        متابعة حالة الطلب
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif
        </div>
        @endif
        @else
        <div class="bg-white rounded-3xl shadow-2xl border border-purple-100 overflow-hidden mb-12">
            <div class="p-8">
                <div class="bg-pink-50 rounded-2xl p-8 mb-8 border border-pink-200">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-heart text-purple-600 text-3xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-purple-900 mb-4">
                            مرحبًا بك في برنامج الزواج الشرعي
                        </h2>
                        <p class="text-gray-700 leading-relaxed text-lg max-w-2xl">
                            منصتنا توفر بيئة آمنة وشرعية للخطوبة بهدف الزواج، مع الحفاظ الكامل على الخصوصية والأخلاق
                            الإسلامية.
                            نضمن لك تجربة موثوقة تخضع لأعلى معايير الضوابط الشرعية.
                        </p>
                    </div>
                </div>

                <div class="text-center">
                    <button id="startProcessButton" type="button"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-lg font-semibold rounded-full transition-all duration-300 hover:scale-105 shadow-lg transform hover:-translate-y-1">
                        <i class="fas fa-user-friends ml-2"></i>
                        ابدأ رحلة البحث عن شريك الحياة
                    </button>

                    <p class="mt-4 text-purple-600 text-sm">
                        <i class="fas fa-lock mr-1"></i>
                        نضمن سرية وخصوصية بياناتك الشخصية
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div id="termsModal" onclick="closeTermsModal()"
        class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-75">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div onclick="event.stopPropagation()"
                class="bg-white rounded-2xl overflow-hidden shadow-xl w-full max-w-4xl relative max-h-[90vh] flex flex-col">
                <div class="p-8 overflow-y-auto">
                    @include('marriage-requests.partials.terms-conditions')
                </div>

                <div class="mt-auto bg-gradient-to-r from-purple-50 to-pink-50 p-4 text-center border-t">
                    <button id="agreeButton" type="button"
                        class="inline-flex items-center px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white text-lg rounded-full transition-all">
                        أوافق على ضوابط الاستخدام
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="videoModal" onclick="closeVideoModal()"
        class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-75">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div onclick="event.stopPropagation()"
                class="bg-white rounded-2xl overflow-hidden shadow-xl w-full max-w-4xl relative">
                <div class="aspect-video">
                    @if($videoLink = App\Models\MarriageVideoLink::first())
                    <iframe id="tutorialVideo" class="w-full h-full" data-src="{{ $videoLink->link }}?autoplay=1" src=""
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                    @else
                    <div class="bg-gray-100 h-full flex items-center justify-center">
                        <p class="text-gray-500">لا يوجد فيديو متوفر حالياً</p>
                    </div>
                    @endif
                </div>
                <div
                    class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 text-center md:text-end md:flex md:justify-between md:items-center">
                    <h1 class="mb-3 md:mb-0">فيديو توضيحي لاستخدام برنامج الزواج الشرعي</h1>
                    <a href="{{ route('marriage-requests.show') }}" onclick="closeModal()"
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-md font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        ابدأ رحلة البحث عن شريك الحياة
                        <i class="fas fa-arrow-circle-left mr-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showTermsModal() {
        document.getElementById('termsModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeTermsModal() {
        document.getElementById('termsModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function showVideoModal() {
        const video = document.getElementById('tutorialVideo');
        document.getElementById('videoModal').classList.remove('hidden');
        video.src = video.getAttribute('data-src');
    }

    function closeVideoModal() {
        const video = document.getElementById('tutorialVideo');
        document.getElementById('videoModal').classList.add('hidden');
        video.src = '';
    }

    document.addEventListener("DOMContentLoaded", () => {
        const startButton = document.getElementById("startProcessButton");
        const agreeButton = document.getElementById("agreeButton");
        const continueButton = document.getElementById("continueButton");

        if(startButton) {
            startButton.addEventListener("click", (e) => {
                e.preventDefault();
                showTermsModal();
            });
        }

        if(agreeButton) {
            agreeButton.addEventListener("click", (e) => {
                e.preventDefault();
                closeTermsModal();
                showVideoModal();
            });
        }

        if(continueButton) {
            continueButton.addEventListener("click", (e) => {
                e.preventDefault();
                window.location.href = continueButton.getAttribute('data-href');
            });
        }
    });
</script>
@endsection