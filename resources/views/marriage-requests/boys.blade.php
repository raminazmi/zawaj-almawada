@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                <i class="fas fa-male ml-2"></i>قائمة الشباب المتاحين
            </h1>
        </div>

        <div class="mb-6 flex justify-center gap-4 flex-wrap">
            <a href="{{ route('marriage-requests.status') }}"
                class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
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
                <div class="bg-gradient-to-r from-purple-600 to-blue-600 p-3 ps-3 pe-5 flex justify-between items-center"
                    :class="isOpen ? 'rounded-t-xl' : 'rounded-xl'">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center shadow-sm">
                            <i class="fas fa-search text-purple-600 text-lg"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-white">البحث والفلترة</h3>
                    </div>
                    <i class="fas text-white transition-transform duration-300"
                        :class="{ 'fa-chevron-down': !isOpen, 'fa-chevron-up': isOpen }"></i>
                </div>
            </button>

            <div class="rounded-b-xl bg-white shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden"
                x-show="isOpen" x-collapse>
                <form method="GET" action="{{ route('marriage-requests.boys') }}" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">بحث</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="ابحث بالاسم أو رقم العضوية"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="age_min" class="block text-sm font-medium text-gray-700">العمر من</label>
                            <input type="number" name="age_min" id="age_min" value="{{ request('age_min') }}"
                                placeholder="الحد الأدنى"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="age_max" class="block text-sm font-medium text-gray-700">العمر إلى</label>
                            <input type="number" name="age_max" id="age_max" value="{{ request('age_max') }}"
                                placeholder="الحد الأقصى"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="marital_status" class="block text-sm font-medium text-gray-700">الحالة
                                الاجتماعية</label>
                            <select name="marital_status" id="marital_status"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="single" {{ request('marital_status')=='single' ? 'selected' : '' }}>أعزب
                                </option>
                                <option value="married" {{ request('marital_status')=='married' ? 'selected' : '' }}>
                                    متزوج</option>
                                <option value="widowed" {{ request('marital_status')=='widowed' ? 'selected' : '' }}>
                                    أرمل</option>
                                <option value="divorced" {{ request('marital_status')=='divorced' ? 'selected' : '' }}>
                                    مطلق</option>
                            </select>
                        </div>
                        <div>
                            <label for="education_level" class="block text-sm font-medium text-gray-700">المستوى
                                التعليمي</label>
                            <select name="education_level" id="education_level"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="illiterate" {{ request('education_level')=='illiterate' ? 'selected' : ''
                                    }}>أمي
                                </option>
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
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="monthly_income_max" class="block text-sm font-medium text-gray-700">الدخل
                                إلى</label>
                            <input type="number" name="monthly_income_max" id="monthly_income_max"
                                value="{{ request('monthly_income_max') }}" placeholder="الحد الأقصى"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="religion" class="block text-sm font-medium text-gray-700">الدين</label>
                            <select name="religion" id="religion"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="Islam" {{ request('religion')=='Islam' ? 'selected' : '' }}>مسلم</option>
                                <option value="Christianity" {{ request('religion')=='Christianity' ? 'selected' : ''
                                    }}>غير
                                    مسلم</option>
                            </select>
                        </div>
                        <div>
                            <label for="housing_type" class="block text-sm font-medium text-gray-700">نوع السكن</label>
                            <select name="housing_type" id="housing_type"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="independent" {{ request('housing_type')=='independent' ? 'selected' : ''
                                    }}>مستقل
                                </option>
                                <option value="family_annex" {{ request('housing_type')=='family_annex' ? 'selected'
                                    : '' }}>
                                    ملحق عائلي</option>
                                <option value="family_room" {{ request('housing_type')=='family_room' ? 'selected' : ''
                                    }}>غرفة
                                    مع العائلة</option>
                                <option value="no_preference" {{ request('housing_type')=='no_preference' ? 'selected'
                                    : '' }}>
                                    لا تفضيل</option>
                            </select>
                        </div>
                        <div>
                            <label for="health_status" class="block text-sm font-medium text-gray-700">الحالة
                                الصحية</label>
                            <input type="text" name="health_status" id="health_status"
                                value="{{ request('health_status') }}" placeholder="أدخل الحالة الصحية"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="religiosity_level" class="block text-sm font-medium text-gray-700">مستوى
                                التدين</label>
                            <select name="religiosity_level" id="religiosity_level"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
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
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="yes" {{ request('prayer_commitment')=='yes' ? 'selected' : '' }}>ملتزم
                                </option>
                                <option value="sometimes" {{ request('prayer_commitment')=='sometimes' ? 'selected' : ''
                                    }}>
                                    أحيانًا</option>
                                <option value="no" {{ request('prayer_commitment')=='no' ? 'selected' : '' }}>غير ملتزم
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="has_children" class="block text-sm font-medium text-gray-700">لديه أطفال</label>
                            <select name="has_children" id="has_children"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="yes" {{ request('has_children')=='yes' ? 'selected' : '' }}>نعم</option>
                                <option value="no" {{ request('has_children')=='no' ? 'selected' : '' }}>لا</option>
                            </select>
                        </div>
                        <div>
                            <label for="is_smoker" class="block text-sm font-medium text-gray-700">مدخن</label>
                            <select name="is_smoker" id="is_smoker"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                                <option value="">اختر</option>
                                <option value="yes" {{ request('is_smoker')=='yes' ? 'selected' : '' }}>نعم</option>
                                <option value="no" {{ request('is_smoker')=='no' ? 'selected' : '' }}>لا</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button type="submit"
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                            <i class="fas fa-search ml-2"></i>بحث وفلترة
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($boys as $index => $boy)
            @if($boy->is_admin == 1 || $boy->id == Auth::id())
            @continue
            @endif
            @if($boy->profile_status !== 'approved')
            @continue
            @endif

            @if(Auth::user()->gender === $boy->gender)
            <div class="col-span-full">
                <p class="bg-green-100 text-green-700 p-4 rounded-lg mb-8 text-center shadow-sm">
                    <i class="fas fa-exclamation-triangle ml-2"></i>
                    لا يمكن تقديم طلب لشخص من نفس الجنس
                </p>
            </div>
            @else
            <div class="transition-all" x-data="{ isOpen: {{ $index < 3 ? 'true' : 'false' }} }">
                <button type="button" class="w-full focus:outline-none" @click="isOpen = !isOpen">
                    <div class="bg-gradient-to-r from-purple-600 to-blue-600 p-2 ps-2 pe-3  flex justify-between items-center"
                        :class="isOpen ? 'rounded-t-xl' : 'rounded-xl'">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center shadow-sm">
                                <i class="fas fa-male text-purple-600 text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white text-start mb-1">{{ $boy->name }}</h3>
                                <p class="text-sm text-purple-200 mb-2">
                                    <i class="fas fa-id-card ml-1"></i>
                                    رقم العضوية: {{ $boy->membership_number }}
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
                        <h4 class="text-md font-semibold mb-3 text-purple-600">
                            معلومات مختصرة
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <i class="fas fa-ruler-vertical text-purple-600 mt-1 ml-2"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">الطول</p>
                                        <p class="text-sm text-gray-900">{{ $boy->height ?? 'غير محدد' }} سم</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <i class="fas fa-birthday-cake text-purple-600 mt-1 ml-2"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">العمر</p>
                                        <p class="text-sm text-gray-900">{{ $boy->age ?? 'غير محدد' }} سم</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <i class="fas fa-weight text-purple-600 mt-1 ml-2"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">الوزن</p>
                                        <p class="text-sm text-gray-900">{{ $boy->weight ?? 'غير محدد' }} كجم</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <i class="fas fa-heart text-purple-600 mt-1 ml-2"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">الحالة الاجتماعية</p>
                                        <p class="text-sm text-gray-900">
                                            @php
                                            $maritalStatus = [
                                            'single' => 'أعزب',
                                            'married' => 'متزوج',
                                            'widowed' => 'أرمل',
                                            'divorced' => 'مطلق'
                                            ];
                                            echo $maritalStatus[$boy->marital_status] ?? 'غير محدد';
                                            @endphp
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <i class="fas fa-palette text-purple-600 mt-1 ml-2"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">لون البشرة</p>
                                        <p class="text-sm text-gray-900">{{ $boy->skin_color ?? 'غير محدد' }} سم</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <i class="fas fa-pray text-purple-600 mt-1 ml-2"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">الالتزام بالصلاة</p>
                                        <p class="text-sm text-gray-900">
                                            @php
                                            $prayerCommitment = [
                                            'yes' => 'ملتزم بالصلاة',
                                            'sometimes' => 'يصلي أحيانًا',
                                            'no' => 'غير ملتزم'
                                            ];
                                            echo $prayerCommitment[$boy->prayer_commitment] ?? 'غير محدد';
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-t pt-4">
                            <button type="button"
                                onclick="document.getElementById('profileModal_{{ $boy->id }}').showModal()"
                                class="w-full px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all shadow-md hover:shadow-lg transform hover:scale-105 flex items-center justify-center gap-2">
                                <i class="fas fa-user-circle"></i>
                                إظهار المزيد من البيانات
                            </button>
                            <dialog id="profileModal_{{ $boy->id }}"
                                onclick="if(event.target === this) document.getElementById('profileModal_{{ $boy->id }}').close()"
                                class="rounded-2xl min-w-[90%] md:min-w-[600px]">
                                <div class="rounded-2xl p-6 bg-white shadow-xl w-full"
                                    onclick="event.stopPropagation()">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-xl font-bold text-purple-800">
                                            <i class="fas fa-user-circle ml-2"></i>تفاصيل الملف الشخصي
                                        </h3>
                                        <button onclick="document.getElementById('profileModal_{{ $boy->id }}').close()"
                                            class="text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="space-y-6">
                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
                                                <i class="fas fa-info-circle ml-2"></i>المعلومات الأساسية
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">البلد</p>
                                                        <p class="text-gray-800">{{ $boy->country ?? 'غير محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الولاية</p>
                                                        <p class="text-gray-800">{{ $boy->state ?? 'غير محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">القبيلة</p>
                                                        <p class="text-gray-800">{{ $boy->tribe ?? 'غير محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الجنس</p>
                                                        <p class="text-gray-800">{{ $boy->gender == 'male' ? 'ذكر' :
                                                            'أنثى' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">العمر</p>
                                                        <p class="text-gray-800">{{ $boy->age ?? 'غير محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">النسب</p>
                                                        <p class="text-gray-800">{{ $boy->lineage ?? 'غير محدد' }}</p>
                                                    </div>
                                                </div>
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الحالة الاجتماعية
                                                        </p>
                                                        <p class="text-gray-800">
                                                            @php
                                                            $maritalStatus = [
                                                            'single' => 'أعزب',
                                                            'married' => 'متزوج',
                                                            'widowed' => 'أرمل',
                                                            'divorced' => 'مطلق'
                                                            ];
                                                            echo $maritalStatus[$boy->marital_status] ?? 'غير محدد';
                                                            @endphp
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الطول</p>
                                                        <p class="text-gray-800">{{ $boy->height ?? 'غير محدد' }} سم</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الوزن</p>
                                                        <p class="text-gray-800">{{ $boy->weight ?? 'غير محدد' }} كجم
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">لون البشرة</p>
                                                        <p class="text-gray-800">{{ $boy->skin_color ?? 'غير محدد' }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">لديه أطفال</p>
                                                        <p class="text-gray-800">{{ $boy->has_children ? 'نعم' : 'لا' }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">عدد الأطفال</p>
                                                        <p class="text-gray-800">{{ $boy->children_count ?? 'غير محدد'
                                                            }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
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
                                                            'illiterate' => 'أمي',
                                                            'general' => 'تعليم عام',
                                                            'diploma' => 'دبلوم',
                                                            'bachelor' => 'بكالوريوس',
                                                            'master' => 'ماجستير',
                                                            'phd' => 'دكتوراه'
                                                            ];
                                                            echo $educationLevel[$boy->education_level] ?? 'غير محدد';
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
                                                            echo $work_sector[$boy->work_sector] ?? 'غير محدد';
                                                            @endphp
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">المسمى الوظيفي</p>
                                                        <p class="text-gray-800">{{ $boy->job_title ?? 'غير محدد' }}</p>
                                                    </div>
                                                </div>
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الدخل الشهري</p>
                                                        <p class="text-gray-800">{{ $boy->monthly_income ?
                                                            number_format($boy->monthly_income, 2) . ' ريال' : 'غير
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
                                                            echo $housingType[$boy->housing_type] ?? 'غير محدد';
                                                            @endphp
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
                                                <i class="fas fa-mosque ml-2"></i>المعلومات الدينية
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الدين</p>
                                                        <p class="text-gray-800">
                                                            @php
                                                            $religion = [
                                                            'Islam' => 'مسلم',
                                                            'Christianity' => 'غير مسلم'
                                                            ];
                                                            echo $religion[$boy->religion] ?? 'غير محدد';
                                                            @endphp
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الالتزام بالصلاة
                                                        </p>
                                                        <p class="text-gray-800">
                                                            @php
                                                            $prayerCommitment = [
                                                            'yes' => 'ملتزم',
                                                            'sometimes' => 'أحياناً',
                                                            'no' => 'غير ملتزم'
                                                            ];
                                                            echo $prayerCommitment[$boy->prayer_commitment] ?? 'غير
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
                                                            echo $religiosityLevel[$boy->religiosity_level] ?? 'غير
                                                            محدد';
                                                            @endphp
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
                                                <i class="fas fa-heartbeat ml-2"></i>المعلومات الصحية
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">الحالة الصحية</p>
                                                        <p class="text-gray-800">{{ $boy->health_status ?? 'غير محدد' }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">أمراض وراثية</p>
                                                        <p class="text-gray-800">{{ $boy->genetic_diseases ?? 'غير
                                                            محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">أمراض معدية</p>
                                                        <p class="text-gray-800">{{ $boy->infectious_diseases ?? 'غير
                                                            محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">اضطرابات نفسية</p>
                                                        <p class="text-gray-800">{{ $boy->psychological_disorders ??
                                                            'غير محدد' }}</p>
                                                    </div>
                                                </div>
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">لديه إعاقة</p>
                                                        <p class="text-gray-800">{{ $boy->has_disability ? 'نعم' : 'لا'
                                                            }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">تفاصيل الإعاقة</p>
                                                        <p class="text-gray-800">{{ $boy->disability_details ?? 'غير
                                                            محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">لديه تشوه</p>
                                                        <p class="text-gray-800">{{ $boy->has_deformity ? 'نعم' : 'لا'
                                                            }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">تفاصيل التشوه</p>
                                                        <p class="text-gray-800">{{ $boy->deformity_details ?? 'غير
                                                            محدد' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
                                                <i class="fas fa-info ml-2"></i>معلومات إضافية
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">يريد أطفال</p>
                                                        <p class="text-gray-800">{{ $boy->wants_children ? 'نعم' : 'لا'
                                                            }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">العقم</p>
                                                        <p class="text-gray-800">{{ $boy->infertility ? 'نعم' : 'لا' }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">مدخن</p>
                                                        <p class="text-gray-800">{{ $boy->is_smoker ? 'نعم' : 'لا' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
                                                <i class="fas fa-align-left ml-2"></i>الوصف الشخصي
                                            </h4>
                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <p class="text-gray-800">{{ $boy->personal_description ?? 'لا يوجد
                                                    وصف' }}</p>
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <h4
                                                class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
                                                <i class="fas fa-heart ml-2"></i>مواصفات الشريك
                                            </h4>
                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <p class="text-gray-800">{{ $boy->partner_expectations ?? 'لا يوجد
                                                    شروط محددة' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </dialog>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                        <span @class([ 'px-3 py-1 rounded-full text-sm' , 'bg-green-100 text-green-800'=>
                            $boy->status === 'available',
                            'bg-yellow-100 text-yellow-800' => $boy->status === 'pending',
                            'bg-red-100 text-red-800' => $boy->status === 'engaged'
                            ])>
                            <i class="fas fa-circle ml-2 text-xs"></i>
                            @php
                            $status = [
                            'available' => 'متاح',
                            'pending' => 'معلق',
                            'engaged' => 'مخطوب'
                            ];
                            echo $status[$boy->status] ?? 'غير متاح';
                            @endphp
                        </span>

                        @if($boy->status === 'available')
                        @if(!$isProfileComplete || Auth::user()->profile_status !== 'approved')
                        <span class="text-sm text-red-600">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            يجب إكمال الملف الشخصي أولاً
                        </span>
                        @else
                        <a href="{{ route('marriage-requests.create-proposal', $boy->id) }}"
                            class="px-4 py-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all flex items-center gap-2 shadow-md hover:shadow-lg transform hover:scale-105">
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
                    <i class="fas fa-frown-open text-3xl mb-3 text-purple-600"></i>
                    <p>لا يوجد شباب متاحين حالياً</p>
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