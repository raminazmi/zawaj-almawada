@extends('layouts.app')

@section('content')
<section class="min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h2 class="text-xl font-bold text-purple-800 text-center mb-4">
            تفاصيل الملف الشخصي
        </h2>

        <div class="bg-white rounded-2xl shadow-xl border border-purple-100 overflow-hidden mb-8">
            <div class="p-6 border-b border-purple-50 bg-gradient-to-r from-purple-600 to-blue-600">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center shadow-md">
                            <i class="fas fa-user text-3xl text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">الاسم المستعار :{{ $user->name }}</h3>
                            <p class="text-white">الاسم الكامل :{{ $user->full_name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="px-3 py-1 rounded-full text-sm font-medium 
                            @if($user->profile_status === 'approved') bg-green-100 text-green-800
                            @elseif($user->profile_status === 'rejected') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            @if($user->profile_status === 'approved') معتمد
                            @elseif($user->profile_status === 'rejected') مرفوض
                            @else بانتظار المراجعة @endif
                        </span>
                        <span class="text-sm text-white mt-1">
                            مسجل منذ: {{ $user->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
                        <i class="fas fa-info-circle ml-2"></i>المعلومات الأساسية
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">الجنس</p>
                                <p class="text-gray-800">{{ $user->gender == 'male' ? 'ذكر' : 'أنثى' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">العمر</p>
                                <p class="text-gray-800">{{ $user->age ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">البلد</p>
                                <p class="text-gray-800">{{ $user->country ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">الولاية</p>
                                <p class="text-gray-800">{{ $user->state ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">القبيلة</p>
                                <p class="text-gray-800">{{ $user->tribe ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">القرية</p>
                                <p class="text-gray-800">{{ $user->village ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">النسب</p>
                                <p class="text-gray-800">{{ $user->lineage ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">الطول</p>
                                <p class="text-gray-800">{{ $user->height ?? 'غير محدد' }} سم</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">الوزن</p>
                                <p class="text-gray-800">{{ $user->weight ?? 'غير محدد' }} كجم</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">لون البشرة</p>
                                <p class="text-gray-800">{{ $user->skin_color ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">الحالة الاجتماعية</p>
                                <p class="text-gray-800">
                                    @php
                                    $maritalStatus = [
                                    'single' => $user->gender == 'male' ? 'أعزب' : 'عزباء',
                                    'married' => 'متزوج/ة',
                                    'widowed' => 'أرمل/ة',
                                    'divorced' => 'مطلق/ة'
                                    ];
                                    echo $maritalStatus[$user->marital_status] ?? 'غير محدد';
                                    @endphp
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">لديه/لديها أطفال</p>
                                <p class="text-gray-800">{{ $user->has_children ? 'نعم' : 'لا' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">عدد الأطفال</p>
                                <p class="text-gray-800">{{ $user->children_count ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 space-y-4">
                    <h4 class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
                        <i class="fas fa-graduation-cap ml-2"></i>المعلومات التعليمية والعملية
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">المستوى التعليمي</p>
                                <p class="text-gray-800">
                                    @php
                                    $educationLevel = [
                                    'illiterate' => 'أمي/ة',
                                    'general' => 'تعليم عام',
                                    'diploma' => 'دبلوم',
                                    'bachelor' => 'بكالوريوس',
                                    'master' => 'ماجستير',
                                    'phd' => 'دكتوراه'
                                    ];
                                    echo $educationLevel[$user->education_level] ?? 'غير محدد';
                                    @endphp
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">قطاع العمل</p>
                                <p class="text-gray-800">{{ $user->work_sector ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">المسمى الوظيفي</p>
                                <p class="text-gray-800">{{ $user->job_title ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">الدخل الشهري</p>
                                <p class="text-gray-800">{{ $user->monthly_income ? number_format($user->monthly_income,
                                    2) . ' ريال' : 'غير محدد' }}</p>
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
                                    echo $housingType[$user->housing_type] ?? 'غير محدد';
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 space-y-4">
                    <h4 class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
                        <i class="fas fa-mosque ml-2"></i>المعلومات الدينية
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">الدين</p>
                                <p class="text-gray-800">{{ $user->religion ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">الالتزام بالصلاة</p>
                                <p class="text-gray-800">
                                    @php
                                    $prayerCommitment = [
                                    'yes' => 'ملتزم/ة',
                                    'sometimes' => 'أحياناً',
                                    'no' => 'غير ملتزم/ة'
                                    ];
                                    echo $prayerCommitment[$user->prayer_commitment] ?? 'غير محدد';
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
                                    echo $religiosityLevel[$user->religiosity_level] ?? 'غير محدد';
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 space-y-4">
                    <h4 class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
                        <i class="fas fa-heartbeat ml-2"></i>المعلومات الصحية
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">الحالة الصحية</p>
                                <p class="text-gray-800">{{ $user->health_status ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">أمراض وراثية</p>
                                <p class="text-gray-800">{{ $user->genetic_diseases ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">أمراض معدية</p>
                                <p class="text-gray-800">{{ $user->infectious_diseases ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">اضطرابات نفسية</p>
                                <p class="text-gray-800">{{ $user->psychological_disorders ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">لديه/لديها إعاقة</p>
                                <p class="text-gray-800">{{ $user->has_disability ? 'نعم' : 'لا' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">تفاصيل الإعاقة</p>
                                <p class="text-gray-800">{{ $user->disability_details ?? 'غير محدد' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">لديه/لديها تشوه</p>
                                <p class="text-gray-800">{{ $user->has_deformity ? 'نعم' : 'لا' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">تفاصيل التشوه</p>
                                <p class="text-gray-800">{{ $user->deformity_details ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 space-y-4">
                    <h4 class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
                        <i class="fas fa-info ml-2"></i>معلومات إضافية
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">يريد/تريد أطفال</p>
                                <p class="text-gray-800">{{ $user->wants_children ? 'نعم' : 'لا' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">العقم</p>
                                <p class="text-gray-800">{{ $user->infertility ? 'نعم' : 'لا' }}</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">مدخن/مدخنة</p>
                                <p class="text-gray-800">{{ $user->is_smoker ? 'نعم' : 'لا' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 space-y-4">
                    <h4 class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
                        <i class="fas fa-align-left ml-2"></i>الوصف الشخصي
                    </h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-800">{{ $user->personal_description ?? 'لا يوجد وصف' }}</p>
                    </div>
                </div>

                <div class="mt-6 space-y-4">
                    <h4 class="text-lg font-semibold text-purple-700 border-b border-purple-100 pb-2">
                        <i class="fas fa-heart ml-2"></i>مواصفات الشريك
                    </h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-800">{{ $user->partner_expectations ?? 'لا يوجد شروط محددة' }}</p>
                    </div>
                </div>
            </div>

            @if($user->profile_status === 'pending' && Auth::user()->is_admin == true)
            <div class="bg-gray-50 px-6 py-4 flex justify-end gap-4">
                <form method="POST" action="{{ route('admin.profile-approvals.approve', $user->id) }}">
                    @csrf
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg 
                       hover:bg-green-700 transition-all shadow-md hover:shadow-lg gap-3
                       transform hover:scale-[1.02] flex items-center">
                        <i class="fas fa-check text-white"></i>
                        <span>الموافقة على الملف</span>
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.profile-approvals.reject', $user->id) }}">
                    @csrf
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg 
                       hover:bg-red-700 transition-all shadow-md hover:shadow-lg gap-3
                       transform hover:scale-[1.02] flex items-center">
                        <i class="fas fa-times text-white"></i>
                        <span>رفض الملف</span>
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection