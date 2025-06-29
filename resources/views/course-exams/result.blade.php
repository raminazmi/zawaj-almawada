@extends('layouts.app')

@section('content')
<div class="bg-gray-100">
    <div class="bg-gradient-to-br from-purple-50 to-blue-50 py-4">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-3xl p-4 sm:p-6 md:p-8 border border-[#3A8BCD]/20">
                <div
                    class="relative w-full max-w-5xl mx-auto bg-white rounded-3xl border-4 border-[#3A8BCD] p-4 sm:p-6 md:p-10 shadow-[0_10px_30px_rgba(58,139,205,0.1)]">
                    <div class="absolute inset-4 border-2 border-[#553566] rounded-2xl opacity-30"></div>

                    <div class="text-center mb-2 sm:mb-4">
                        <div class="flex flex-col items-center mb-2 sm:mb-4">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="شعار منصة زواج المودة"
                                class="w-[80px] h-[80px] sm:w-[100px] sm:h-[100px] object-contain mb-1 sm:mb-2">
                            <p
                                class="text-[1.5rem] sm:text-[2rem] text-[#2A5C82] mb-1 sm:mb-2 [text-shadow:1px_1px_2px_rgba(0,0,0,0.1)]">
                                شهادة إجتياز</p>
                            <div class="text-[0.9rem] sm:text-[1rem] text-[#553566] mb-1 sm:mb-2">منصة زواج المودة</div>
                        </div>
                    </div>

                    <div class="text-center my-1 sm:my-2 leading-loose">
                        <div class="flex justify-center items-center">
                            <div class="w-1/2 text-center px-1 sm:px-2 md:px-4">
                                <p class="text-[0.9rem] sm:text-[1rem] text-gray-700 mb-1 sm:mb-2"><strong>تشهد منصة
                                        زواج المودة أن الفاضل/ة</strong></p>
                                <div
                                    class="text-xl sm:text-2xl text-[#3A8BCD] my-2 sm:my-4 underline decoration-[#553566] decoration-2 underline-offset-4 sm:underline-offset-8">
                                    {{ $result->user->full_name ?? 'غير متوفر' }}</div>
                                <p class="text-[0.9rem] sm:text-[1rem] text-gray-700 mb-1 sm:mb-3"><strong>قد اجتاز عن
                                        بُعد</strong></p>
                                <span
                                    class="text-[1rem] sm:text-[1.1rem] text-[#2A5C82] my-1 sm:my-2 font-semibold">دورة
                                    التأهيل للحياة الزوجية</span>
                            </div>
                            <div class="w-px h-3/4 bg-[#3A8BCD] mx-1 sm:mx-2 md:mx-4"></div>
                            <div class="w-1/2 text-center px-1 sm:px-2 md:px-4">
                                <div
                                    class="flex justify-center items-center gap-1 sm:gap-2 my-1 sm:my-2 text-[0.9rem] sm:text-[1rem]">
                                    <div class="text-gray-600 font-medium">ولمدة شهرين</div>
                                    <p class="text-gray-700"><strong>وحصل على العلامة</strong></p>
                                </div>
                                <div
                                    class="inline-block bg-gradient-to-br from-green-100 to-green-200 text-green-800 text-[1rem] sm:text-[1.1rem] font-semibold px-4 sm:px-6 py-1 sm:py-2 rounded-[20px] sm:rounded-[25px] my-1 sm:my-2 shadow-[0_4px_15px_rgba(42,92,130,0.1)] border-2 border-green-200">
                                    {{ round($result->score) }}/100</div>
                                <div class="text-[0.9rem] sm:text-[1rem] text-gray-500 my-1 sm:my-3">بتاريخ {{
                                    $result->created_at->format('Y/m/d') }}</div>
                                <p class="text-[0.9rem] sm:text-[1rem] text-gray-700 mt-1 sm:mt-2"><strong>ونسأل الله أن
                                        يمن عليه بحياة أسرية سعيدة</strong></p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="mt-2 sm:mt-4 text-center flex flex-col sm:flex-row justify-between items-center text-[#2A5C82] text-sm sm:text-base border-t-2 border-gray-200 pt-2 sm:pt-6">
                        <p class="text-center mt-1 sm:mt-2 text-gray-600">
                            شهادة معتمدة من منصة زواج المودة<br>
                            للاستشارات الزوجية والأسرية
                        </p>
                        <div class="mt-2 sm:mt-0">
                            <p class="text-center"><strong>مع تحيات مدير منصة زواج المودة</strong></p><br>
                            <div class="text-center">
                                <img src="{{ asset('assets/images/signature.jpg') }}" alt="توقيع المدير"
                                    class="max-w-[120px] sm:max-w-[150px] mx-auto block">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 sm:mt-8 flex flex-col sm:flex-row justify-center items-center gap-2 sm:gap-4">
                    <a href="{{ route('course-exams.index') }}"
                        class="flex justify-center items-center gap-1 bg-gradient-to-l from-[#3A8BCD] to-[#553566] text-white px-4 sm:px-6 py-1 sm:py-2 rounded-full text-sm sm:text-md font-bold shadow-lg hover:opacity-90 transition w-full sm:w-auto">
                        <i class="fas fa-arrow-right ml-1 sm:ml-2"></i>
                        العودة للاختبارات
                    </a>
                    <a href="{{ route('course-exams.certificate.download', $result->id) }}" id="downloadButton"
                        class="flex justify-center items-center gap-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 sm:px-6 py-1 sm:py-2 rounded-full text-sm sm:text-md font-bold shadow-lg hover:opacity-90 transition w-full sm:w-auto">
                        <i class="fas fa-download ml-1 sm:ml-2"></i>
                        تحميل الشهادة
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body {
                @apply bg-white;
            }

            .min-h-screen {
                min-height: auto;
            }
        }
    </style>

    <script>
        document.getElementById('downloadButton').addEventListener('click', function(event) {
            var button = this;
            if (!button.classList.contains('loading')) {
                button.innerText = 'جاري تحميل الشهادة...';
                button.classList.add('loading', 'bg-gray-600', 'text-gray-100', 'opacity-50');
                button.classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-blue-600', 'text-white', 'hover:opacity-90');

                // إعادة تعيين الزر بعد 3 ثوانٍ
                setTimeout(() => {
                    button.innerText = 'تحميل الشهادة';
                    button.classList.remove('loading', 'bg-gray-600', 'text-gray-100', 'opacity-50');
                    button.classList.add('bg-gradient-to-r', 'from-blue-500', 'to-blue-600', 'text-white', 'hover:opacity-90');
                }, 3000);
            }
        });
    </script>
</div>
@endsection