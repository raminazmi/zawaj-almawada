@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                تأكيد الموافقة على طلب الخطوبة
            </h1>
        </div>

        @if($marriageRequest && $otherPartyName)
        <div class="mb-6">
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-100 p-6 rounded-2xl shadow-lg">
                <div class="flex items-start">
                    <div class="flex-shrink-0 pt-1">
                        <i class="fas fa-clipboard-check text-[#d4b341] text-2xl"></i>
                    </div>
                    <div class="mr-3 flex-1">
                        <h3 class="text-lg font-semibold text-purple-900">طلب خطوبة نشط</h3>
                        <p class="mt-2 text-gray-700">
                            أنت تقوم بمراجعة طلب خطوبة مع
                            <span class="font-medium">{{ $otherPartyName }}</span>.
                            يرجى تأكيد موافقتك أو رفضك بناءً على نتائج التوافق.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white rounded-3xl shadow-xl border border-purple-100 overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">نتائج اختبار التوافق</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">نسبة التوافق الكلية</span>
                        <span class="text-xl font-bold text-emerald-600">{{ $score }}%</span>
                    </div>
                    <div class="bg-gray-100 rounded-full h-2.5">
                        <div class="bg-emerald-500 h-2.5 rounded-full" style="width: {{ $score }}%"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm text-blue-800">
                                <i class="fas fa-male text-blue-600 mr-1"></i>
                                النقاط الحاسمة للخاطب: {{ $maleImportantScore['score'] }} / {{
                                $maleImportantScore['total'] }}
                            </p>
                        </div>
                        <div class="bg-pink-50 p-4 rounded-lg">
                            <p class="text-sm text-pink-800">
                                <i class="fas fa-female text-pink-600 mr-1"></i>
                                النقاط الحاسمة للمخطوبة: {{ $femaleImportantScore['score'] }} / {{
                                $femaleImportantScore['total'] }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-gray-600 mb-4">هل توافق على الاستمرار في طلب الخطوبة بناءً على النتائج أعلاه؟</p>
                    <div class="flex gap-3 w-full md:w-auto justify-center">
                        <form method="POST" action="{{ route('marriage-requests.confirm', $marriageRequest->id) }}"
                            class="flex justify-center gap-4">
                            @csrf
                            <button type="submit" name="action" value="accept"
                                class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all shadow-md hover:shadow-lg gap-2 text-sm transform hover:scale-[1.02]">
                                <i class="fas fa-check-circle"></i> موافقة
                            </button>
                            <button type="submit" name="action" value="reject"
                                class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all shadow-md hover:shadow-lg gap-2 text-sm transform hover:scale-[1.02]">
                                <i class="fas fa-times-circle"></i> رفض
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection