@extends('layouts.app')

@section('content')
<div class="bg-gray-100">
    <div class="bg-gradient-to-br from-purple-50 to-blue-50 py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-3xl p-8 border border-[#3A8BCD]/20">
                <div
                    class="relative w-full max-w-[800px] mx-auto bg-white rounded-3xl border-4 border-[#3A8BCD] p-10 shadow-[0_10px_30px_rgba(58,139,205,0.1)]">
                    <div class="absolute inset-4 border-2 border-[#553566] rounded-2xl opacity-30"></div>

                    <div class="text-center mb-4">
                        <div class="flex flex-col items-center mb-4">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="شعار منصة زواج المودة"
                                class="w-[100px] h-[100px] object-contain mb-2">
                            <p class="text-[2.5rem] text-[#2A5C82] mb-2 [text-shadow:1px_1px_2px_rgba(0,0,0,0.1)]">شهادة
                                إجتياز</p>
                            <div class="text-[1.3rem] text-[#553566] mb-2">منصة زواج المودة</div>
                        </div>
                    </div>

                    <div class="text-center my-1 leading-loose">
                        <p class="text-[1.2rem] text-gray-700 mb-2"><strong>تشهد منصة زواج المودة أن الفاضل/ة</strong>
                        </p>
                        <div
                            class="text-2xl text-[#3A8BCD] my-4 underline decoration-[#553566] decoration-2 underline-offset-8">
                            {{ $result->user->name }}</div>
                        <div class="text-[1.2rem] text-gray-700 mb-3"><strong>قد اجتاز عن بُعد</strong>
                            <span class="text-[1.3rem] text-[#2A5C82] my-2 font-semibold">دورة التأهيل للحياة
                                الزوجية</span>
                            <div>
                                <span class="text-[1.1rem] text-gray-600 my-2 font-medium">ولمدة شهرين</span>
                                <span class="text-[1.2rem] text-gray-700 mb-2"><strong>وحصل على العلامة</strong></span>
                            </div>
                        </div>
                        <div
                            class="inline-block bg-gradient-to-br from-green-100 to-green-200 text-green-800 text-[1.1rem] font-semibold px-6 py-2 rounded-[25px] my-2 shadow-[0_4px_15px_rgba(42,92,130,0.1)] border-2 border-green-200">
                            ({{ round($result->score) }}/100)
                        </div>
                        <div class="text-base text-gray-500 my-3">بتاريخ {{ $result->created_at->format('Y/m/d') }}
                        </div>
                        <p class="text-[1rem] text-gray-700 mt-2"><strong>ونسأل الله أن يمن عليه بحياة أسرية
                                سعيدة</strong></p>
                    </div>
                    <div
                        class="mt-6 text-center flex justify-between items-start text-[#2A5C82] text-base border-t-2 border-gray-200 pt-6">
                        <p class="text-center mt-8 text-gray-600">
                            شهادة معتمدة من منصة زواج المودة<br>
                            للاستشارات الزوجية والأسرية
                        </p>
                        <div>
                            <p><strong>مع تحيات مدير منصة زواج المودة</strong></p><br>
                            <small class="text-gray-500">التوقيع</small>
                            <div class="mt-5 text-center">
                                <img src="{{ asset('assets/images/signature.jpg') }}" alt="توقيع المدير"
                                    class="max-w-[200px] h-auto mx-auto block">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-center items-center gap-4">
                    <a href="{{ route('course-exams.certificate.download', $result->id) }}" id="downloadButton"
                        class="inline-block bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-2 rounded-full text-md font-bold shadow-lg hover:opacity-90 transition">
                        <i class="fas fa-download ml-2"></i>
                        تحميل الشهادة
                    </a>
                    <a href="{{ route('course-exams.index') }}"
                        class="inline-block bg-gradient-to-l from-[#3A8BCD] to-[#553566] text-white px-6 py-2 rounded-full text-md font-bold shadow-lg hover:opacity-90 transition">
                        العودة للاختبارات
                        <i class="fas fa-arrow-left mr-2"></i>
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
        document.getElementById('downloadButton').addEventListener('click', function() {
            var button = this;
            button.innerText = 'جاري تحميل الشهادة...';
            button.classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-blue-600', 'text-white', 'hover:opacity-90');
            button.classList.add('bg-gray-600', 'text-gray-100', 'opacity-50');
        });
    </script>
</div>
@endsection