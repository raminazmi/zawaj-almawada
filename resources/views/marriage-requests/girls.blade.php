@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent">
                <i class="fas fa-female ml-2"></i>قائمة الفتيات المتاحات
            </h1>
        </div>

        <div class="mb-6 flex justify-center gap-4 flex-wrap">
            <a href="{{ route('marriage-requests.status') }}"
                class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                <i class="fas fa-tasks ml-2"></i>
                حالة طلباتي
            </a>

            @if(!$isProfileComplete || Auth::user()->profile_status !== 'approved')
            <a href="{{ route('profile.edit') }}"
                class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                <i class="fas fa-user-edit ml-2"></i>
                إكمال الملف الشخصي
            </a>
            @endif
        </div>

        <div class="mb-4 transition-all" x-data="{ isOpen: false }">
            <button type="button" class="w-full focus:outline-none" @click="isOpen = !isOpen">
                <div class="bg-gradient-to-r from-pink-600 to-rose-600 p-3 ps-3 pe-5 flex justify-between items-center"
                    :class="isOpen ? 'rounded-t-xl' : 'rounded-xl'">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center shadow-sm">
                            <i class="fas fa-search text-pink-600 text-lg"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-white text-start">البحث والفلترة</h3>
                    </div>
                    <i class="fas text-white transition-transform duration-300"
                        :class="{ 'fa-chevron-down': !isOpen, 'fa-chevron-up': isOpen }"></i>
                </div>
            </button>

            <div class="rounded-b-xl bg-white shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden"
                x-show="isOpen" x-collapse>
                <form method="GET" action="{{ route('marriage-requests.girls') }}" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">بحث</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="ابحث بالاسم أو رقم العضوية"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="age_min" class="block text-sm font-medium text-gray-700">العمر من</label>
                            <input type="number" name="age_min" id="age_min" value="{{ request('age_min') }}"
                                placeholder="الحد الأدنى"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="age_max" class="block text-sm font-medium text-gray-700">العمر إلى</label>
                            <input type="number" name="age_max" id="age_max" value="{{ request('age_max') }}"
                                placeholder="الحد الأقصى"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="marital_status" class="block text-sm font-medium text-gray-700">الحالة
                                الاجتماعية</label>
                            <select name="marital_status" id="marital_status"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="single" {{ request('marital_status')=='single' ? 'selected' : '' }}>عزباء
                                </option>
                                <option value="married" {{ request('marital_status')=='married' ? 'selected' : '' }}>
                                    متزوجة</option>
                                <option value="widowed" {{ request('marital_status')=='widowed' ? 'selected' : '' }}>
                                    أرملة</option>
                                <option value="divorced" {{ request('marital_status')=='divorced' ? 'selected' : '' }}>
                                    مطلقة</option>
                            </select>
                        </div>
                        <div>
                            <label for="education_level" class="block text-sm font-medium text-gray-700">المستوى
                                التعليمي</label>
                            <select name="education_level" id="education_level"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="illiterate" {{ request('education_level')=='illiterate' ? 'selected' : ''
                                    }}>أمية</option>
                                <option value="general" {{ request('education_level')=='general' ? 'selected' : '' }}>
                                    تعليم عام</option>
                                <option value="diploma" {{ request('education_level')=='diploma' ? 'selected' : '' }}>
                                    دبلوم</option>
                                <option value="bachelor" {{ request('education_level')=='bachelor' ? 'selected' : '' }}>
                                    بكالوريوس</option>
                                <option value="master" {{ request('education_level')=='master' ? 'selected' : '' }}>
                                    ماجستير</option>
                                <option value="phd" {{ request('education_level')=='phd' ? 'selected' : '' }}>دكتوراه
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="monthly_income_min" class="block text-sm font-medium text-gray-700">الدخل
                                من</label>
                            <input type="number" name="monthly_income_min" id="monthly_income_min"
                                value="{{ request('monthly_income_min') }}" placeholder="الحد الأدنى"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="monthly_income_max" class="block text-sm font-medium text-gray-700">الدخل
                                إلى</label>
                            <input type="number" name="monthly_income_max" id="monthly_income_max"
                                value="{{ request('monthly_income_max') }}" placeholder="الحد الأقصى"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="religion" class="block text-sm font-medium text-gray-700">الدين</label>
                            <select name="religion" id="religion"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="Islam" {{ request('religion')=='Islam' ? 'selected' : '' }}>مسلمة
                                </option>
                                <option value="Christianity" {{ request('religion')=='Christianity' ? 'selected' : ''
                                    }}>غير مسلمة</option>
                            </select>
                        </div>
                        <div>
                            <label for="housing_type" class="block text-sm font-medium text-gray-700">نوع السكن</label>
                            <select name="housing_type" id="housing_type"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="independent" {{ request('housing_type')=='independent' ? 'selected' : ''
                                    }}>مستقل</option>
                                <option value="family_annex" {{ request('housing_type')=='family_annex' ? 'selected'
                                    : '' }}>ملحق عائلي</option>
                                <option value="family_room" {{ request('housing_type')=='family_room' ? 'selected' : ''
                                    }}>غرفة مع العائلة</option>
                                <option value="no_preference" {{ request('housing_type')=='no_preference' ? 'selected'
                                    : '' }}>لا تفضيل</option>
                            </select>
                        </div>
                        <div>
                            <label for="health_status" class="block text-sm font-medium text-gray-700">الحالة
                                الصحية</label>
                            <input type="text" name="health_status" id="health_status"
                                value="{{ request('health_status') }}" placeholder="أدخل الحالة الصحية"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="religiosity_level" class="block text-sm font-medium text-gray-700">مستوى
                                التدين</label>
                            <select name="religiosity_level" id="religiosity_level"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="high" {{ request('religiosity_level')=='high' ? 'selected' : '' }}>مرتفع
                                </option>
                                <option value="medium" {{ request('religiosity_level')=='medium' ? 'selected' : '' }}>
                                    متوسط</option>
                                <option value="low" {{ request('religiosity_level')=='low' ? 'selected' : '' }}>منخفض
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="prayer_commitment" class="block text-sm font-medium text-gray-700">الالتزام
                                بالصلاة</label>
                            <select name="prayer_commitment" id="prayer_commitment"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="yes" {{ request('prayer_commitment')=='yes' ? 'selected' : '' }}>ملتزمة
                                </option>
                                <option value="sometimes" {{ request('prayer_commitment')=='sometimes' ? 'selected' : ''
                                    }}>أحيانًا</option>
                                <option value="no" {{ request('prayer_commitment')=='no' ? 'selected' : '' }}>غير ملتزمة
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="has_children" class="block text-sm font-medium text-gray-700">لديها
                                أطفال</label>
                            <select name="has_children" id="has_children"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="yes" {{ request('has_children')=='yes' ? 'selected' : '' }}>نعم</option>
                                <option value="no" {{ request('has_children')=='no' ? 'selected' : '' }}>لا</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button type="submit"
                            class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                            <i class="fas fa-search ml-2"></i>بحث وفلترة
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($girls as $index => $girl)
            @if($girl->is_admin == 1 || $girl->id == Auth::id())
            @continue
            @endif
            @if($girl->profile_status !== 'approved')
            @continue
            @endif

            @if(Auth::user()->gender === $girl->gender)
            <div class="col-span-full">
                <p class="bg-green-100 text-green-700 p-4 rounded-lg mb-8 text-center shadow-sm">
                    <i class="fas fa-exclamation-triangle ml-2"></i>
                    لا يمكن تقديم طلب لشخص من نفس الجنس
                </p>
            </div>
            @else
            <div class="transition-all" x-data="{ isOpen: {{ $index < 3 ? 'true' : 'false' }} }">
                <button type="button" class="w-full focus:outline-none" @click="isOpen = !isOpen">
                    <div class="bg-gradient-to-r from-pink-600 to-rose-600 p-2 ps-2 pe-3 flex justify-between items-center"
                        :class="isOpen ? 'rounded-t-xl' : 'rounded-xl'">
                        <div class="flex items-center gap-2">
                            <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center shadow-sm">
                                <i class="fas fa-female text-pink-600 text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white text-start mb-1">{{ $girl->name }}</h3>
                                <p class="text-sm text-rose-200 mb-2">
                                    <i class="fas fa-id-card ml-1"></i>
                                    رقم العضوية: {{ $girl->membership_number }}
                                </p>
                            </div>
                        </div>
                        <i class="fas text-white transition-transform duration-300"
                            :class="{ 'fa-chevron-down': !isOpen, 'fa-chevron-up': isOpen }"></i>
                    </div>
                </button>

                <div class="rounded-b-xl bg-white shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden"
                    x-show="isOpen" x-collapse>
                    <div class="p-6 space-y-4">
                        <h4 class="text-md font-semibold mb-3 text-pink-600">
                            معلومات مختصرة
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <i class="fas fa-ruler-vertical text-pink-600 mt-1 ml-2"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">الطول</p>
                                        <p class="text-sm text-gray-900">{{ $girl->height ?? 'غير محدد' }} سم</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <i class="fas fa-birthday-cake text-pink-600 mt-1 ml-2"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">العمر</p>
                                        <p class="text-sm text-gray-900">{{ $girl->age ?? 'غير محدد' }} سم</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <i class="fas fa-weight text-pink-600 mt-1 ml-2"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">الوزن</p>
                                        <p class="text-sm text-gray-900">{{ $girl->weight ?? 'غير محدد' }} كجم</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <i class="fas fa-heart text-pink-600 mt-1 ml-2"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">الحالة الاجتماعية</p>
                                        <p class="text-sm text-gray-900">
                                            @php
                                            $maritalStatus = [
                                            'single' => 'عزباء',
                                            'married' => 'متزوجة',
                                            'widowed' => 'أرملة',
                                            'divorced' => 'مطلقة'
                                            ];
                                            echo $maritalStatus[$girl->marital_status] ?? 'غير محدد';
                                            @endphp
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <i class="fas fa-palette text-pink-600 mt-1 ml-2"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">لون البشرة</p>
                                        <p class="text-sm text-gray-900">{{ $girl->skin_color ?? 'غير محدد' }} سم</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <i class="fas fa-pray text-pink-600 mt-1 ml-2"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">الالتزام بالصلاة</p>
                                        <p class="text-sm text-gray-900">
                                            @php
                                            $prayerCommitment = [
                                            'yes' => 'ملتزمة بالصلاة',
                                            'sometimes' => 'تصلي أحيانًا',
                                            'no' => 'غير ملتزمة'
                                            ];
                                            echo $prayerCommitment[$girl->prayer_commitment] ?? 'غير محدد';
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-t pt-4">
                            <button type="button"
                                onclick="document.getElementById('profileModal_{{ $girl->id }}').showModal()"
                                class="w-full px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-all shadow-md hover:shadow-lg transform hover:scale-105 flex items-center justify-center gap-2">
                                <i class="fas fa-user-circle"></i>
                                إظهار المزيد من البيانات
                            </button>
                            <dialog id="profileModal_{{ $girl->id }}"
                                onclick="if(event.target === this) document.getElementById('profileModal_{{ $girl->id }}').close()"
                                class="rounded-2xl min-w-[90%] md:min-w-[600px]">
                                <div class="rounded-2xl p-6 bg-white shadow-xl w-full"
                                    onclick="event.stopPropagation()">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-xl font-bold text-pink-800">
                                            <i class="fas fa-user-circle ml-2"></i>تفاصيل الملف الشخصي
                                        </h3>
                                        <button
                                            onclick="document.getElementById('profileModal_{{ $girl->id }}').close()"
                                            class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="space-y-6">
                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-pink-700 border-b border-pink-100 pb-2">
                                                <i class="fas fa-info-circle ml-2"></i>المعلومات الأساسية
                                            </h4>
                                            <div class="col-span-full mt-4">
                                                <div
                                                    class="bg-pink-50 border border-pink-200 rounded-lg p-3 flex items-start text-sm text-pink-700">
                                                    <i class="fas fa-info-circle text-pink-500 mt-1 ml-2"></i>
                                                    <div class="mr-2">
                                                        <p class="font-medium mb-1">إقرار وموافقة:</p>
                                                        <p class="text-justify">
                                                            تنويه: مشاركة بيانات الفتاة في برنامج الزواج الشرعي تمت
                                                            بموافقة وتوجيه من ولي أمرها
                                                            أو أحد أفراد أسرتها المسؤولين، وذلك وفقاً للضوابط الشرعية
                                                            والنظامية المتبعة.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">البلد</p>
                                                        <p class="text-gray-800">{{ $girl->country ?? 'غير محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الولاية</p>
                                                        <p class="text-gray-800">{{ $girl->state ?? 'غير محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">القبيلة</p>
                                                        <p class="text-gray-800">{{ $girl->tribe ?? 'غير محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الجنس</p>
                                                        <p class="text-gray-800">{{ $girl->gender == 'male' ? 'ذكر' :
                                                            'أنثى' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">العمر</p>
                                                        <p class="text-gray-800">{{ $girl->age ?? 'غير محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">النسب</p>
                                                        <p class="text-gray-800">{{ $girl->lineage ?? 'غير محدد' }}</p>
                                                    </div>
                                                </div>
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الحالة الاجتماعية
                                                        </p>
                                                        <p class="text-gray-800">
                                                            @php
                                                            $maritalStatus = [
                                                            'single' => 'عزباء',
                                                            'married' => 'متزوجة',
                                                            'widowed' => 'أرملة',
                                                            'divorced' => 'مطلقة'
                                                            ];
                                                            echo $maritalStatus[$girl->marital_status] ?? 'غير محدد';
                                                            @endphp
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الطول</p>
                                                        <p class="text-gray-800">{{ $girl->height ?? 'غير محدد' }} سم
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الوزن</p>
                                                        <p class="text-gray-800">{{ $girl->weight ?? 'غير محدد' }} كجم
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">لون البشرة</p>
                                                        <p class="text-gray-800">{{ $girl->skin_color ?? 'غير محدد' }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">لديها أطفال</p>
                                                        <p class="text-gray-800">{{ $girl->has_children ? 'نعم' : 'لا'
                                                            }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">عدد الأطفال</p>
                                                        <p class="text-gray-800">{{ $girl->children_count ?? 'غير محدد'
                                                            }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-pink-700 border-b border-pink-100 pb-2">
                                                <i class="fas fa-graduation-cap ml-2"></i>المعلومات التعليمية والعملية
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">المستوى التعليمي
                                                        </p>
                                                        <p class="text-gray-800">
                                                            @php
                                                            $educationLevel = [
                                                            'illiterate' => 'أمية',
                                                            'general' => 'تعليم عام',
                                                            'diploma' => 'دبلوم',
                                                            'bachelor' => 'بكالوريوس',
                                                            'master' => 'ماجستير',
                                                            'phd' => 'دكتوراه'
                                                            ];
                                                            echo $educationLevel[$girl->education_level] ?? 'غير محدد';
                                                            @endphp
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">قطاع العمل</p>
                                                        <p class="text-gray-800">
                                                            @php
                                                            $work_sector = [
                                                            'government' => 'قطاع حكومي',
                                                            'private' => 'قطاع خاص',
                                                            'self_employed' => 'أعمال حرة',
                                                            'unemployed' => 'باحث عن عمل'
                                                            ];
                                                            echo $work_sector[$girl->work_sector] ?? 'غير محدد';
                                                            @endphp
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">المسمى الوظيفي</p>
                                                        <p class="text-gray-800">{{ $girl->job_title ?? 'غير محدد' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الدخل الشهري</p>
                                                        <p class="text-gray-800">{{ $girl->monthly_income ?
                                                            number_format($girl->monthly_income, 2) . ' ريال' : 'غير
                                                            محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">نوع السكن</p>
                                                        <p class="text-gray-800">
                                                            @php
                                                            $housingType = [
                                                            'independent' => 'مستقل',
                                                            'family_annex' => 'ملحق عائلي',
                                                            'family_room' => 'غرفة مع العائلة',
                                                            'no_preference' => 'لا تفضيل'
                                                            ];
                                                            echo $housingType[$girl->housing_type] ?? 'غير محدد';
                                                            @endphp
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-pink-700 border-b border-pink-100 pb-2">
                                                <i class="fas fa-mosque ml-2"></i>المعلومات الدينية
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الدين</p>
                                                        <p class="text-gray-800">
                                                            @php
                                                            $religion = [
                                                            'Islam' => 'مسلمة',
                                                            'Christianity' => 'غير مسلمة'
                                                            ];
                                                            echo $religion[$girl->religion] ?? 'غير محدد';
                                                            @endphp
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الالتزام بالصلاة
                                                        </p>
                                                        <p class="text-gray-800">
                                                            @php
                                                            $prayerCommitment = [
                                                            'yes' => 'ملتزمة',
                                                            'sometimes' => 'أحياناً',
                                                            'no' => 'غير ملتزمة'
                                                            ];
                                                            echo $prayerCommitment[$girl->prayer_commitment] ?? 'غير
                                                            محدد';
                                                            @endphp
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">مستوى التدين</p>
                                                        <p class="text-gray-800">
                                                            @php
                                                            $religiosityLevel = [
                                                            'high' => 'مرتفع',
                                                            'medium' => 'متوسط',
                                                            'low' => 'منخفض'
                                                            ];
                                                            echo $religiosityLevel[$girl->religiosity_level] ?? 'غير
                                                            محدد';
                                                            @endphp
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-pink-700 border-b border-pink-100 pb-2">
                                                <i class="fas fa-heartbeat ml-2"></i>المعلومات الصحية
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الحالة الصحية</p>
                                                        <p class="text-gray-800">{{ $girl->health_status ?? 'غير محدد'
                                                            }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">أمراض وراثية</p>
                                                        <p class="text-gray-800">{{ $girl->genetic_diseases ?? 'غير
                                                            محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">أمراض معدية</p>
                                                        <p class="text-gray-800">{{ $girl->infectious_diseases ?? 'غير
                                                            محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">اضطرابات نفسية</p>
                                                        <p class="text-gray-800">{{ $girl->psychological_disorders ??
                                                            'غير محدد' }}</p>
                                                    </div>
                                                </div>
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">لديها إعاقة</p>
                                                        <p class="text-gray-800">{{ $girl->has_disability ? 'نعم' : 'لا'
                                                            }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">تفاصيل الإعاقة</p>
                                                        <p class="text-gray-800">{{ $girl->disability_details ?? 'غير
                                                            محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">لديها تشوه</p>
                                                        <p class="text-gray-800">{{ $girl->has_deformity ? 'نعم' : 'لا'
                                                            }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">تفاصيل التشوه</p>
                                                        <p class="text-gray-800">{{ $girl->deformity_details ?? 'غير
                                                            محدد' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-pink-700 border-b border-pink-100 pb-2">
                                                <i class="fas fa-info ml-2"></i>معلومات إضافية
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">تريد أطفال</p>
                                                        <p class="text-gray-800">{{ $girl->wants_children ? 'نعم' : 'لا'
                                                            }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">العقم</p>
                                                        <p class="text-gray-800">{{ $girl->infertility ? 'نعم' : 'لا' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-pink-700 border-b border-pink-100 pb-2">
                                                <i class="fas fa-align-left ml-2"></i>الوصف الشخصي
                                            </h4>
                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <p class="text-gray-800">{{ $girl->personal_description ?? 'لا يوجد وصف'
                                                    }}</p>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-pink-700 border-b border-pink-100 pb-2">
                                                <i class="fas fa-heart ml-2"></i>مواصفات الشريك
                                            </h4>
                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <p class="text-gray-800">{{ $girl->partner_expectations ?? 'لا يوجد شروط
                                                    محددة' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </dialog>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                        <span @class([ 'px-3 py-1 rounded-full text-sm' , 'bg-green-100 text-green-800'=> $girl->status
                            === 'available',
                            'bg-yellow-100 text-yellow-800' => $girl->status === 'pending',
                            'bg-red-100 text-red-800' => $girl->status === 'engaged'
                            ])>
                            <i class="fas fa-circle ml-2 text-xs"></i>
                            @php
                            $status = [
                            'available' => 'متاحة',
                            'pending' => 'معلقة',
                            'engaged' => 'مخطوبة'
                            ];
                            echo $status[$girl->status] ?? 'غير متاحة';
                            @endphp
                        </span>

                        @if($girl->status === 'available')
                        @if(!$isProfileComplete || Auth::user()->profile_status !== 'approved')
                        <span class="text-sm text-red-600">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            يجب إكمال الملف الشخصي أولاً
                        </span>
                        @else
                        <a href="{{ route('marriage-requests.create-proposal', $girl->id) }}"
                            class="px-4 py-2 bg-gradient-to-r from-pink-600 to-rose-600 text-white rounded-lg hover:from-pink-700 hover:to-rose-700 transition-all flex items-center gap-2 shadow-md hover:shadow-lg transform hover:scale-105">
                            <i class="fas fa-paper-plane"></i>
                            تقديم طلب
                        </a>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @empty
            <div class="col-span-full">
                <div class="bg-white rounded-xl p-6 text-center text-gray-600 shadow-sm">
                    <i class="fas fa-frown-open text-3xl mb-3 text-pink-600"></i>
                    <p>لا يوجد فتيات متاحات حالياً</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    dialog {
        border: none;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-radius: 1rem;
        animation: slideIn 0.3s ease-in-out;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
@endpush
@endsection