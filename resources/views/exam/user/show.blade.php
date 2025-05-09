@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-4xl mx-auto px-4 pb-2">
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center bg-white px-4 py-2 gap-2 rounded-full shadow-lg border border-purple-200">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h1
                    class="text-lg font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    اختبار التوافق رقم #{{ $exam->id }}
                </h1>
            </div>
        </div>

        @if($marriageRequest && $otherPartyName && !in_array(Auth::user()->status, ['available', 'engaged']))
        <div class="mb-6">
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-100 p-6 rounded-2xl shadow-lg">
                <div class="flex items-start">
                    <div class="flex-shrink-0 pt-1">
                        <i class="fas fa-hourglass-half text-[#d4b341] text-2xl"></i>
                    </div>
                    <div class="mr-3 flex-1">
                        <h3 class="text-lg font-semibold text-purple-900">طلب خطوبة نشط</h3>
                        <p class="mt-2 text-gray-700">
                            لديك طلب خطوبة مع
                            <span class="font-medium">{{ $otherPartyName }}</span>.
                            @if($marriageRequest->status === 'approved' && $marriageRequest->compatibility_test_link &&
                            ((auth()->user()->gender === 'male' && !$marriageRequest->exam->male_finished) ||
                            (auth()->user()->gender === 'female' && !$marriageRequest->exam->female_finished)))
                            يرجى إكمال اختبار التوافق لمتابعة الطلب.
                            @else
                            يرجى انتظار تقديم الاختبار من الطرف الاخر لمتابعة الطلب.
                            @endif
                        </p>
                    </div>

                    @if($marriageRequest->status === 'approved' && $marriageRequest->compatibility_test_link &&
                    ((auth()->user()->gender === 'male' && !$marriageRequest->exam->male_finished) ||
                    (auth()->user()->gender === 'female' && !$marriageRequest->exam->female_finished)))
                    <div style="text-align: end; margin: 5px 0;">
                        <a href="{{ $marriageRequest->compatibility_test_link }}"
                            style="display: inline-block; padding: 8px 18px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                            رابط المقياس
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white rounded-3xl shadow-xl border border-purple-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-6 py-4 text-center">
                <h3 class="text-white text-lg font-semibold mb-2">نسبة التوافق الكلية</h3>
                <div class="inline-block bg-white/20 py-2 px-4 rounded-full">
                    <div class="text-2xl font-bold text-white">
                        @if($score == 0)
                        <span class="text-yellow-300">...</span>
                        @else
                        {{ $score }}%
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-purple-50 p-4 rounded-xl">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-purple-600 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            <h4 class="font-semibold text-purple-900">أسئلة حاسمة للخاطب</h4>
                        </div>
                        <div class="text-lg font-medium text-gray-700">
                            @if($maleImportantScore['total'] == 0)
                            <span class="text-gray-400">بانتظار الإجابات</span>
                            @else
                            <span class="text-purple-600">{{ $maleImportantScore['score'] }}</span>
                            <span class="text-sm text-gray-500">/ {{ $maleImportantScore['total'] }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="bg-pink-50 p-4 rounded-xl">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-pink-600 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            <h4 class="font-semibold text-pink-900">أسئلة حاسمة للمخطوبة</h4>
                        </div>
                        <div class="text-lg font-medium text-gray-700">
                            @if($femaleImportantScore['total'] == 0)
                            <span class="text-gray-400">بانتظار الإجابات</span>
                            @else
                            <span class="text-pink-600">{{ $femaleImportantScore['score'] }}</span>
                            <span class="text-sm text-gray-500">/ {{ $femaleImportantScore['total'] }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                @php
                $maleAge = optional($exam->male)->age ?? 'لا يوجد معلومات';
                $femaleAge = optional($exam->female)->age ?? 'لا يوجد معلومات';
                $maleWeight = optional($exam->male)->weight ?? 'لا يوجد معلومات';
                $femaleWeight = optional($exam->female)->weight ?? 'لا يوجد معلومات';
                $maleHeight = optional($exam->male)->height ?? 'لا يوجد معلومات';
                $femaleHeight = optional($exam->female)->height ?? 'لا يوجد معلومات';
                $maleSkinColor = optional($exam->male)->skin_color ?? 'لا يوجد معلومات';
                $femaleSkinColor = optional($exam->female)->skin_color ?? 'لا يوجد معلومات';
                @endphp

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-center">
                    <div class="bg-white p-3 rounded-lg border border-purple-100">
                        <div class="text-sm text-purple-600 mb-1">العمر</div>
                        <div class="font-medium text-gray-700">
                            {{ $femaleAge }} / {{ $maleAge }}
                        </div>
                    </div>
                    <div class="bg-white p-3 rounded-lg border border-purple-100">
                        <div class="text-sm text-purple-600 mb-1">الوزن</div>
                        <div class="font-medium text-gray-700">
                            {{ $femaleWeight }} / {{ $maleWeight }}
                        </div>
                    </div>
                    <div class="bg-white p-3 rounded-lg border border-purple-100">
                        <div class="text-sm text-purple-600 mb-1">الطول</div>
                        <div class="font-medium text-gray-700">
                            {{ $femaleHeight }} / {{ $maleHeight }}
                        </div>
                    </div>
                    <div class="bg-white p-3 rounded-lg border border-purple-100">
                        <div class="text-sm text-purple-600 mb-1">لون البشرة</div>
                        <div class="font-medium text-gray-700">
                            {{ $femaleSkinColor }} / {{ $maleSkinColor }}
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 p-4 rounded-xl">
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 text-blue-600 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"
                                clip-rule="evenodd" />
                        </svg>
                        <h4 class="font-semibold text-blue-900">رابط المشاركة
                            @if(auth()->user()->gender === "male")
                            للمخطوبة
                            @else
                            للمخطوب
                            @endif
                        </h4>
                    </div>
                    <div class="flex items-center bg-white px-4 py-2 rounded-lg border border-blue-200">
                        <span id="exam-link" class="truncate text-blue-600">{{ route('exam.index', ['token' =>
                            $exam->token]) }}</span>
                        <button id="copy-button"
                            class="mr-auto px-3 py-1 min-w-[85px] bg-blue-100 text-blue-600 rounded-md hover:bg-blue-200 transition-colors"
                            onclick="copyLink()">
                            نسخ
                        </button>
                    </div>
                </div>

                <div class="bg-red-50 p-4 rounded-xl border border-red-200">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-600 mt-1 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <h4 class="font-semibold text-red-700 mb-1">تنبيه مهم</h4>
                            <p class="text-red-600 text-sm">1- الرقم الذي قبل الشرطة في نتيجة الاسئلة الحاسمة
                                يعني النقاط التي ليس بها توافق، والرقم بعد الشرطة يعني مجموع
                                العبارات الحاسمة التي تم تحديدها.
                            </p>
                            <p class="text-red-600 text-sm">
                                2- يرجى حفظ هذه النتائج أو تصوير الشاشة وإرسالها للطرف الآخر
                                <br>
                                <span class="text-xs opacity-75">النتائج صالحة حتى: {{
                                    now()->addDays(7)->format('Y-m-d') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyLink() {
        const link = document.getElementById('exam-link').innerText;
        const button = document.getElementById('copy-button');
        const input = document.createElement('input');
        input.value = link;
        document.body.appendChild(input);
        
        input.select();
        input.setSelectionRange(0, 99999);

        document.execCommand('copy');
        document.body.removeChild(input);

        button.textContent = 'تم النسخ';

        setTimeout(() => {
            button.textContent = 'نسخ';
        }, 2000);
    }
</script>
@endsection