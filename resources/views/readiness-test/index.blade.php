@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
            <div class="md:flex">
                <div
                    class="md:w-2/5 bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center p-8">
                    <div class="text-center">
                        <div
                            class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-md">
                            <i class="fas fa-hand-holding-heart text-4xl text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-purple-800">استعد لرحلة زواج ناجحة</h3>
                    </div>
                </div>

                <div class="md:w-3/5 p-8">
                    <div class="flex items-center mb-6">
                        <div class="bg-purple-100 px-3 py-2 rounded-md ml-4">
                            <i class="fas fa-book-open text-purple-600 text-lg"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">اختبار الجاهزية للحياة الزوجية</h2>
                    </div>

                    <div class="space-y-4 mb-8">
                        <p class="text-gray-700 leading-relaxed text-md">
                            اختبار الجاهزية للحياة الزوجية هو اختبار مجاني يقيس استعداد الشاب أو الفتاة وفهمهما لمعاني
                            الحياة الزوجية.
                            يناسب هذا الاختبار المقبلين على الزواج أو المتزوجين، لتحديد مدى حاجتهم لدورات تأهيلية للحياة
                            الزوجية.
                        </p>
                    </div>

                    <div class="bg-blue-50 rounded-lg py-2 px-4 mb-6 border border-blue-100">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-blue-500 text-xl"></i>
                            </div>
                            <div class="mr-3">
                                <p class="text-sm text-blue-700">
                                    سيتم توجيهك إلى نموذج جوجل الخارجي لإكمال الاختبار بشكل آمن
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button id="startTestButton" type="button"
                            class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-md font-semibold rounded-xl transition-all duration-300 hover:scale-[1.02] shadow-lg transform hover:-translate-y-0.5">
                            <i class="fas fa-external-link-alt ml-2"></i>
                            الانتقال إلى نموذج الاختبار
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 grid md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="text-purple-600 mb-3">
                    <i class="fas fa-user-check text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2 text-gray-800">لمن هذا الاختبار؟</h3>
                <p class="text-gray-600">المقبلون على الزواج - المتزوجون الجدد - الراغبون في تقييم تجربتهم</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="text-purple-600 mb-3">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2 text-gray-800">فوائد الاختبار</h3>
                <p class="text-gray-600">التعرف على نقاط القوة - تحديد مجالات التحسين</p>
            </div>
        </div>
    </div>
</div>

<div id="confirmationModal"
    class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-md w-full p-6 shadow-2xl">
        <div class="text-center mb-4">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-purple-100">
                <i class="fas fa-external-link-alt text-purple-600"></i>
            </div>
        </div>
        <h3 class="text-lg font-medium text-center text-gray-900 mb-4">انتقال إلى نموذج خارجي</h3>
        <p class="text-sm text-gray-500 text-center mb-6">
            سيتم فتح نموذج جوجل في علامة تبويب جديدة. تأكد من:
            <br>
            <span class="text-purple-600">• إكمال جميع الحقول المطلوبة</span>
            <br>
            <span class="text-purple-600">• الضغط على إرسال في النهاية</span>
        </p>
        <div class="flex justify-center gap-2">
            <button type="button" onclick="closeModal()"
                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                إلغاء
            </button>
            <button type="button" onclick="startTest()"
                class="px-4 py-2 bg-purple-600 rounded-md text-sm font-medium text-white hover:bg-purple-700">
                متابعة الانتقال
            </button>
        </div>
    </div>
</div>

<script>
    function showConfirmation() {
        document.getElementById('confirmationModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    function closeModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    function startTest() {
        window.open('https://docs.google.com/forms/d/e/1FAIpQLSeFoSQleRY5Ib4spLyDhm51tZ-WXYWNcHiM50OdDRHNm2KgPg/closedform', '_blank');
        closeModal();
    }
    
    document.getElementById('startTestButton').addEventListener('click', showConfirmation);
</script>
@endsection