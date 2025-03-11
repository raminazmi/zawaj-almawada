@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-50 to-white">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center bg-white px-6 py-3 gap-3 rounded-full shadow-lg border border-purple-200">
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    تقديم طلب خطوبة لـ {{ $target->name }}
                </h1>
            </div>
        </div>

        <!-- عرض الرسائل -->
        @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4 text-center">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4 text-center">
            {{ session('error') }}
        </div>
        @endif

        @if(Auth::user()->status === 'engaged' || Auth::user()->status === 'pending')
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            <p>أنت متزوج بالفعل من {{
                Auth::user()->activeMarriageRequest()
                ? Auth::user()->activeMarriageRequest()->target->name
                : Auth::user()->targetMarriageRequest()->user->name
                }} ولا يمكنك تقديم طلبات جديدة.</p>
        </div>
        @else
        <div class="bg-white rounded-3xl shadow-xl border border-purple-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-6 text-center">
                <h2 class="text-xl font-semibold text-white">
                    @if(Auth::user()->gender === 'male')
                    <i class="fas fa-male ml-2"></i>نموذج طلب الخطوبة للشاب
                    @else
                    <i class="fas fa-female ml-2"></i>نموذج طلب الخطوبة للفتاة
                    @endif
                </h2>
            </div>

            <form method="POST" action="{{ route('marriage-requests.store-proposal', $target->id) }}"
                class="p-6 space-y-6">
                @csrf

                <!-- المعلومات الأساسية -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
                        <i class="fas fa-id-card text-purple-600 mr-2"></i>
                        المعلومات الأساسية
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-purple-50 p-4 rounded-xl relative">
                            <label class="block text-sm font-medium text-purple-600 mb-2">
                                <i class="fas fa-hashtag ml-2"></i>رقم الطلب
                            </label>
                            <div class="relative">
                                <input type="text" name="request_number" readonly value="MRQ-{{ time() }}"
                                    class="w-full p-3 pl-10 bg-white rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-500">
                                <i class="fas fa-file-alt absolute left-3 top-4 text-purple-400"></i>
                            </div>
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                الولاية
                            </label>
                            <div class="relative">
                                <input type="text" name="state" required
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('state') border-red-500 @enderror">
                                <i class="fas fa-globe-asia absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('state')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                العمر
                            </label>
                            <div class="relative">
                                <input type="number" name="age" required
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('age') border-red-500 @enderror">
                                <i class="fas fa-calendar-alt absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('age')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                الطول (سم)
                            </label>
                            <div class="relative">
                                <input type="number" name="height" required
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('height') border-red-500 @enderror">
                                <i class="fas fa-text-height absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('height')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                الوزن (كجم)
                            </label>
                            <div class="relative">
                                <input type="number" name="weight" required
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('weight') border-red-500 @enderror">
                                <i class="fas fa-weight-hanging absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('weight')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                القبيلة
                            </label>
                            <div class="relative">
                                <input type="text" name="tribe" required
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('tribe') border-red-500 @enderror">
                                <i class="fas fa-flag absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('tribe')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                لون البشرة
                            </label>
                            <div class="relative">
                                <select name="skin_color" required
                                    class="w-full p-3 pl-10 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('skin_color') border-red-500 @enderror">
                                    <option value="white">بيضاء</option>
                                    <option value="wheat">حنطية</option>
                                    <option value="brown">سمراء</option>
                                </select>
                                <i class="fas fa-tint absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('skin_color')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                النسب
                            </label>
                            <div class="relative">
                                <select name="lineage" required
                                    class="w-full p-3 pl-10 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('lineage') border-red-500 @enderror">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                                <i class="fas fa-project-diagram absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('lineage')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- الحالة الاجتماعية -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
                        <i class="fas fa-user-friends text-purple-600 mr-2"></i>
                        الحالة الاجتماعية
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                الحالة الاجتماعية
                            </label>
                            <div class="relative">
                                <select name="marital_status" required
                                    class="w-full p-3 pl-10 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('marital_status') border-red-500 @enderror">
                                    @if(Auth::user()->gender === 'male')
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
                                <i class="fas fa-heart absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('marital_status')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="bg-purple-50 p-4 rounded-xl">
                            <label class="block text-sm font-medium text-purple-600 mb-2">
                                هل لديك أبناء؟
                            </label>
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
                            <div class="relative">
                                <input type="number" name="children_count" placeholder="عدد الأبناء"
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('children_count') border-red-500 @enderror">
                                <i class="fas fa-child absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('children_count')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- التعليم والعمل -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
                        <i class="fas fa-user-graduate text-purple-600 mr-2"></i>
                        التعليم والعمل
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                المستوى التعليمي
                            </label>
                            <div class="relative">
                                <select name="education_level" required
                                    class="w-full p-3 pl-10 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('education_level') border-red-500 @enderror">
                                    <option value="illiterate">أمي</option>
                                    <option value="general">تعليم عام</option>
                                    <option value="diploma">دبلوم جامعي</option>
                                    <option value="bachelor">مؤهل جامعي</option>
                                    <option value="master">ماجستير</option>
                                    <option value="phd">دكتوراه</option>
                                </select>
                                <i class="fas fa-university absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('education_level')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                مكان العمل
                            </label>
                            <div class="relative">
                                <select name="work_sector" required
                                    class="w-full p-3 pl-10 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('work_sector') border-red-500 @enderror">
                                    <option value="government">قطاع حكومي</option>
                                    <option value="private">قطاع خاص</option>
                                    <option value="self_employed">أعمال حرة</option>
                                    <option value="unemployed">باحث عن عمل</option>
                                </select>
                                <i class="fas fa-briefcase absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('work_sector')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                المسمى الوظيفي
                            </label>
                            <div class="relative">
                                <input type="text" name="job_title"
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('job_title') border-red-500 @enderror">
                                <i class="fas fa-id-badge absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('job_title')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                الدخل الشهري (ريال)
                            </label>
                            <div class="relative">
                                <input type="number" name="monthly_income"
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('monthly_income') border-red-500 @enderror">
                                <i class="fas fa-money-bill-wave absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('monthly_income')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                الدين
                            </label>
                            <div class="relative">
                                <select name="religion" required
                                    class="w-full p-3 pl-10 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('religion') border-red-500 @enderror">
                                    <option value="Islam">الإسلام</option>
                                    <option value="Christianity">المسيحية</option>
                                </select>
                                <i class="fas fa-mosque absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('religion')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                نوع السكن
                            </label>
                            <div class="relative">
                                <select name="housing_type" required
                                    class="w-full p-3 pl-10 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('housing_type') border-red-500 @enderror">
                                    <option value="independent">سكن مستقل</option>
                                    <option value="family_annex">ملحق عائلي</option>
                                    <option value="family_room">غرفة في منزل العائلة</option>
                                </select>
                                <i class="fas fa-door-open absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('housing_type')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                مستوى التدين
                            </label>
                            <div class="relative">
                                <select name="religiosity_level" required
                                    class="w-full p-3 pl-10 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('religiosity_level') border-red-500 @enderror">
                                    <option value="high">عالي</option>
                                    <option value="medium">متوسط</option>
                                    <option value="low">منخفض</option>
                                </select>
                                <i class="fas fa-star-and-crescent absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('religiosity_level')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                التزام الصلاة
                            </label>
                            <div class="relative">
                                <select name="prayer_commitment" required
                                    class="w-full p-3 pl-10 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('prayer_commitment') border-red-500 @enderror">
                                    <option value="yes">ملتزم</option>
                                    <option value="sometimes">أحيانًا</option>
                                    <option value="no">غير ملتزم</option>
                                </select>
                                <i class="fas fa-clock absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('prayer_commitment')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- المعلومات الصحية -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
                        <i class="fas fa-medkit text-purple-600 mr-2"></i>
                        المعلومات الصحية
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                الحالة الصحية
                            </label>
                            <div class="relative">
                                <textarea name="health_status" rows="2"
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('health_status') border-red-500 @enderror"
                                    placeholder="أدخل وصفًا عامًا لحالتك الصحية"></textarea>
                                <i class="fas fa-comment-medical absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('health_status')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                الأمراض الوراثية
                            </label>
                            <div class="relative">
                                <textarea name="genetic_diseases" rows="2"
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('genetic_diseases') border-red-500 @enderror"></textarea>
                                <i class="fas fa-dna absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('genetic_diseases')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                الأمراض المعدية
                            </label>
                            <div class="relative">
                                <textarea name="infectious_diseases" rows="2"
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('infectious_diseases') border-red-500 @enderror"></textarea>
                                <i class="fas fa-biohazard absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('infectious_diseases')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                الأمراض النفسية
                            </label>
                            <div class="relative">
                                <textarea name="psychological_disorders" rows="2"
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('psychological_disorders') border-red-500 @enderror"></textarea>
                                <i class="fas fa-head-side-virus absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('psychological_disorders')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="bg-purple-50 p-4 rounded-xl">
                            <label class="block text-sm font-medium text-purple-600 mb-2">
                                هل لديك إعاقة؟
                            </label>
                            <div class="flex items-center space-x-4 mb-2 gap-4">
                                <label class="flex items-center">
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
                            <div class="relative">
                                <input type="text" name="disability_details" placeholder="تفاصيل الإعاقة"
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('disability_details') border-red-500 @enderror">
                                <i class="fas fa-info-circle absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('disability_details')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="bg-purple-50 p-4 rounded-xl">
                            <label class="block text-sm font-medium text-purple-600 mb-2">
                                هل لديك تشوهات؟
                            </label>
                            <div class="flex items-center space-x-4 mb-2 gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="has_deformity" value="1"
                                        class="form-radio text-purple-600">
                                    <span class="mr-2">نعم</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="has_deformity" value="0" checked
                                        class="form-radio text-purple-600">
                                    <span class="mr-2">لا</span>
                                </label>
                            </div>
                            <div class="relative">
                                <input type="text" name="deformity_details" placeholder="تفاصيل التشوهات"
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('deformity_details') border-red-500 @enderror">
                                <i class="fas fa-exclamation-triangle absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('deformity_details')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="bg-purple-50 p-4 rounded-xl">
                            <label class="block text-sm font-medium text-purple-600 mb-2">
                                هل ترغب في الإنجاب؟
                            </label>
                            <div class="flex items-center space-x-4 mb-2 gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="wants_children" value="1"
                                        class="form-radio text-purple-600">
                                    <span class="mr-2">نعم</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="wants_children" value="0" checked
                                        class="form-radio text-purple-600">
                                    <span class="mr-2">لا</span>
                                </label>
                            </div>
                            @error('wants_children')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="bg-purple-50 p-4 rounded-xl">
                            <label class="block text-sm font-medium text-purple-600 mb-2">
                                هل تعاني من عقم؟
                            </label>
                            <div class="flex items-center space-x-4 mb-2 gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="infertility" value="1" class="form-radio text-purple-600">
                                    <span class="mr-2">نعم</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="infertility" value="0" checked
                                        class="form-radio text-purple-600">
                                    <span class="mr-2">لا</span>
                                </label>
                            </div>
                            @error('infertility')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        @if(Auth::user()->gender === 'male')
                        <div class="bg-purple-50 p-4 rounded-xl">
                            <label class="block text-sm font-medium text-purple-600 mb-2">
                                هل تدخن؟
                            </label>
                            <div class="flex items-center space-x-4 mb-2 gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="is_smoker" value="1" class="form-radio text-purple-600">
                                    <span class="mr-2">نعم</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="is_smoker" value="0" checked
                                        class="form-radio text-purple-600">
                                    <span class="mr-2">لا</span>
                                </label>
                            </div>
                            @error('is_smoker')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>
                        @endif
                    </div>
                </div>

                <!-- معلومات إضافية -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
                        <i class="fas fa-comment-dots text-purple-600 mr-2"></i>
                        معلومات إضافية
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2 relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                وصف شخصي
                            </label>
                            <div class="relative">
                                <textarea name="personal_description" required rows="4"
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('personal_description') border-red-500 @enderror"></textarea>
                                <i class="fas fa-pen absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('personal_description')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="md:col-span-2 relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                مواصفات الشريك المطلوب
                            </label>
                            <div class="relative">
                                <textarea name="partner_expectations" required rows="4"
                                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('partner_expectations') border-red-500 @enderror"></textarea>
                                <i class="fas fa-search absolute left-3 top-4 text-gray-400"></i>
                            </div>
                            @error('partner_expectations')
                            <div class="mt-1 text-red-600 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- زر التقديم -->
                <div class="text-center py-4">
                    <button type="submit"
                        class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-2 rounded-full hover:from-purple-700 hover:to-pink-700 transition-all text-lg font-semibold shadow-lg group">
                        تقديم الطلب
                        <i class="fas fa-paper-plane mr-2 transform group-hover:rotate-220 transition-transform"></i>
                    </button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection