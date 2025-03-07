@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-50 to-white">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- العنوان الرئيسي -->
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center bg-white px-6 py-3 gap-3 rounded-full shadow-lg border border-purple-200">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    طلب زواج جديد
                </h1>
            </div>
        </div>

        <!-- بطاقة النموذج -->
        <div class="bg-white rounded-3xl shadow-xl border border-purple-100 overflow-hidden">
            <!-- العنوان الفرعي -->
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-6 text-center">
                <h2 class="text-xl font-semibold text-white">
                    @if($type === 'male')
                    نموذج طلب الزواج للشاب
                    @else
                    نموذج طلب الزواج للفتاة
                    @endif
                </h2>
            </div>

            <!-- النموذج -->
            <form method="POST" action="{{ route('marriage-requests.store') }}" class="p-6 space-y-6">
                @csrf

                <!-- القسم 1: المعلومات الأساسية -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
                        <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                        </svg>
                        المعلومات الأساسية
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- رقم الطلب -->
                        <div class="bg-purple-50 p-4 rounded-xl">
                            <label class="block text-sm font-medium text-purple-600 mb-2">رقم الطلب</label>
                            <input type="text" name="request_number" readonly value="MRQ-{{ time() }}"
                                class="w-full p-3 bg-white rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-500">
                        </div>

                        <!-- الولاية -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الولاية</label>
                            <input type="text" name="state" required
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                        </div>

                        <!-- العمر -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">العمر</label>
                            <input type="number" name="age" required
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                        </div>

                        <!-- الطول -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الطول (سم)</label>
                            <input type="number" name="height" required
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                        </div>

                        <!-- الوزن -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الوزن (كجم)</label>
                            <input type="number" name="weight" required
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                        </div>

                        <!-- القبيلة -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">القبيلة</label>
                            <input type="text" name="tribe" required
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                        </div>

                        <!-- لون البشرة -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">لون البشرة</label>
                            <select name="skin_color" required
                                class="w-full p-3 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                                <option value="white">بيضاء</option>
                                <option value="wheat">حنطية</option>
                                <option value="brown">سمراء</option>
                            </select>
                        </div>

                        <!-- النسب -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">النسب</label>
                            <select name="lineage" required
                                class="w-full p-3 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- القسم 2: الحالة الاجتماعية -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
                        <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                                clip-rule="evenodd" />
                        </svg>
                        الحالة الاجتماعية
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الحالة الاجتماعية</label>
                            <select name="marital_status" required
                                class="w-full p-3 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                                @if($type === 'male')
                                <option value="single">أعزب</option>
                                <option value="married">متزوج</option>
                                <option value="widowed">أرمل</option>
                                <option value="divorced">مطلق</option>
                                @else
                                <option value="single">عزباء</option>
                                <option value="widowed">أرملة</option>
                                <option value="divorced">مطلقة</option>
                                @endif
                            </select>
                        </div>

                        <!-- هل لديك أبناء -->
                        <div class="bg-purple-50 p-4 rounded-xl">
                            <label class="block text-sm font-medium text-purple-600 mb-2">هل لديك أبناء؟</label>
                            <div class="flex items-center space-x-4 mb-2 gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="has_children" value="1"
                                        class="form-radio text-purple-600">
                                    <span class="mr-2">نعم</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="has_children" value="0" checked
                                        class="form-radio text-purple-600">
                                    <span class="mr-2">لا</span>
                                </label>
                            </div>
                            <input type="number" name="children_count" placeholder="عدد الأبناء"
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                        </div>
                    </div>
                </div>

                <!-- القسم 3: التعليم والعمل -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
                        <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                        </svg>
                        التعليم والعمل
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- المستوى التعليمي -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">المستوى التعليمي</label>
                            <select name="education_level" required
                                class="w-full p-3 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                                <option value="illiterate">أمي</option>
                                <option value="general">تعليم عام</option>
                                <option value="diploma">دبلوم جامعي</option>
                                <option value="bachelor">مؤهل جامعي</option>
                                <option value="master">ماجستير</option>
                                <option value="phd">دكتوراه</option>
                            </select>
                        </div>

                        <!-- مكان العمل -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">مكان العمل</label>
                            <select name="work_sector" required
                                class="w-full p-3 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                                <option value="government">قطاع حكومي</option>
                                <option value="private">قطاع خاص</option>
                                <option value="self_employed">أعمال حرة</option>
                                <option value="unemployed">باحث عن عمل</option>
                            </select>
                        </div>

                        <!-- المسمى الوظيفي -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">المسمى الوظيفي</label>
                            <input type="text" name="job_title"
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                        </div>

                        <!-- الدخل الشهري -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الدخل الشهري (ريال)</label>
                            <input type="number" name="monthly_income"
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                        </div>
                    </div>
                </div>

                <!-- القسم 4: المعلومات الصحية -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
                        <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        المعلومات الصحية
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- الأمراض الوراثية -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الأمراض الوراثية</label>
                            <textarea name="genetic_diseases" rows="2"
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500"></textarea>
                        </div>

                        <!-- الأمراض المعدية -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الأمراض المعدية</label>
                            <textarea name="infectious_diseases" rows="2"
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500"></textarea>
                        </div>

                        <!-- الأمراض النفسية -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الأمراض النفسية</label>
                            <textarea name="psychological_disorders" rows="2"
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500"></textarea>
                        </div>

                        <!-- الإعاقات -->
                        <div class="bg-purple-50 p-4 rounded-xl">
                            <label class="block text-sm font-medium text-purple-600 mb-2">هل لديك إعاقة؟</label>
                            <div class="flex items-center space-x-4 mb-2 gap-4">
                                <label class="flex items-center ">
                                    <input type="radio" name="has_disability" value="1"
                                        class="form-radio text-purple-600">
                                    <span class="mr-2">نعم</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="has_disability" value="0" checked
                                        class="form-radio text-purple-600">
                                    <span class="mr-2">لا</span>
                                </label>
                            </div>
                            <input type="text" name="disability_details" placeholder="تفاصيل الإعاقة"
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500">
                        </div>
                    </div>
                </div>

                <!-- القسم 5: المعلومات الإضافية -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
                        <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                        </svg>
                        معلومات إضافية
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- وصف شخصي -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">وصف شخصي</label>
                            <textarea name="personal_description" required rows="4"
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500"></textarea>
                        </div>

                        <!-- مواصفات الشريك -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">مواصفات الشريك المطلوب</label>
                            <textarea name="partner_expectations" required rows="4"
                                class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500"></textarea>
                        </div>
                    </div>
                </div>

                <!-- زر التقديم -->
                <div class="text-center pt-8">
                    <button type="submit"
                        class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-12 py-4 rounded-full hover:from-purple-700 hover:to-pink-700 transition-all text-lg font-semibold shadow-lg">
                        تقديم الطلب
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection