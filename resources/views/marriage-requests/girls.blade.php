@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent">
                <i class="fas fa-female ml-2"></i>قائمة الفتيات المتاحات
            </h1>
        </div>

        <div class="mb-6 flex justify-center gap-4 flex-wrap">
            <a href="{{ route('marriage-requests.status') }}"
                class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                <i class="fas fa-info-circle ml-2"></i>
                حالة طلباتي
            </a>

            @if(!$isProfileComplete)
            <a href="{{ route('profile.edit') }}"
                class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                <i class="fas fa-user-edit ml-2"></i>
                إكمال الملف الشخصي
            </a>
            @endif
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
                    <div class="bg-gradient-to-r from-pink-600 to-rose-600 p-4 flex justify-between items-center"
                        :class="isOpen ? 'rounded-t-xl' : 'rounded-xl'">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center shadow-sm">
                                <i class="fas fa-female text-pink-600 text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white text-start mb-1">{{ $girl->name }}</h3>
                                <p class="text-sm text-rose-200 mb-2">
                                    <i class="fas fa-id-card ml-1"></i>
                                    رقم العضوية: {{ $girl->membership_number }}
                                </p>
                                <p class="text-sm text-rose-100">
                                    <i class="fas fa-birthday-cake ml-1"></i>
                                    {{ $girl->age }} سنة -
                                    <i class="fas fa-palette mr-1 ml-2"></i>
                                    {{ $girl->skin_color }}
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
                                اضغط لإظهار المزيد في الملف الشخصي
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
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-3">
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
                                                        <p class="text-sm font-medium text-gray-500">البلد</p>
                                                        <p class="text-gray-800">{{ $girl->country ?? 'غير محدد' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">النسب</p>
                                                        <p class="text-gray-800">{{ $girl->lineage ?? 'غير محدد' }}</p>
                                                    </div>
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
                                                </div>
                                                <div class="space-y-3">
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
                                                        <p class="text-gray-800">{{ $girl->work_sector ?? 'غير محدد' }}
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
                                                        <p class="text-gray-800">{{ $girl->religion ?? 'غير محدد' }}</p>
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
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-500">مدخنة</p>
                                                        <p class="text-gray-800">{{ $girl->is_smoker ? 'نعم' : 'لا' }}
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

                                        <!-- مواصفات الشريك -->
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
                            'pending' => 'قيد المراجعة',
                            'engaged' => 'مخطوبة'
                            ];
                            echo $status[$girl->status] ?? 'غير معروف';
                            @endphp
                        </span>

                        @if($girl->status === 'available')
                        @if($isProfileComplete)
                        <a href="{{ route('marriage-requests.create-proposal', $girl->id) }}"
                            class="px-4 py-2 bg-gradient-to-r from-pink-600 to-rose-600 text-white rounded-lg hover:from-pink-700 hover:to-rose-700 transition-all flex items-center gap-2 shadow-md hover:shadow-lg transform hover:scale-105">
                            <i class="fas fa-paper-plane"></i>
                            إرسال طلب زواج
                        </a>
                        @else
                        <span class="text-sm text-red-600">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            يرجى إكمال الملف الشخصي أولاً
                        </span>
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