@props(['target', 'link'])

<div class="mt-3 bg-white rounded-xl shadow-md overflow-hidden" x-data="{ isOpen: false }">
    <button type="button" class="w-full focus:outline-none" @click="isOpen = !isOpen">
        <div class="bg-gradient-to-r from-green-600 to-green-500 p-4 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-user ml-2"></i>
                بيانات المستهدف
            </h3>
            <i class="fas text-white transition-transform duration-300"
                :class="{ 'fa-chevron-down': !isOpen, 'fa-chevron-up': isOpen }"></i>
        </div>
    </button>

    <div class="transition-all duration-300 overflow-hidden" x-ref="content" x-show="isOpen" x-collapse>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">الاسم المستعار</p>
                        <p class="text-sm text-gray-900">{{ $target->name ?? 'غير متوفر' }}</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">رقم العضوية</p>
                        <p class="text-sm text-gray-900">{{ $target->membership_number ?? 'غير متوفر' }}</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">البلد</p>
                        <p class="text-sm text-gray-900">{{ $target->country ?? 'غير متوفر' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-birthday-cake"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">العمر</p>
                        <p class="text-sm text-gray-900">{{ $target->age ?? 'غير متوفر' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-ruler-vertical"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">الطول</p>
                        <p class="text-sm text-gray-900">{{ $target->height ?? 'غير متوفر' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-weight"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">الوزن</p>
                        <p class="text-sm text-gray-900">{{ $target->weight ?? 'غير متوفر' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-palette"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">لون البشرة</p>
                        <p class="text-sm text-gray-900">{{ $target->skin_color ?? 'غير
                            متوفر' }}</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">الحالة الاجتماعية</p>
                        <p class="text-sm text-gray-900">
                            @php
                            $maritalStatus = [
                            'single' => 'أعزب',
                            'married' => 'متزوج',
                            'widowed' => 'أرمل',
                            'divorced' => 'مطلق'
                            ];
                            echo $maritalStatus[$target->marital_status] ?? 'غير محدد';
                            @endphp
                        </p>
                    </div>
                </div>

                @if($target->gender === 'female')
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-female"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">محجبة</p>
                        <p class="text-gray-800">{{ $target->is_hijabi ? 'نعم' : 'لا' }}</p>
                    </div>
                </div>
                @endif

                @if($target->gender === 'male')
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-male"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">يدخن</p>
                        <p class="text-gray-800">{{ $target->is_smoker ? 'نعم' : 'لا' }}</p>
                    </div>
                </div>
                @endif
            </div>

            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">الوظيفة</p>
                        <p class="text-sm text-gray-900">{{ $target->job_title ?? 'غير متوفر'
                            }}</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">الدخل الشهري</p>
                        <p class="text-sm text-gray-900">{{ $target->monthly_income ?
                            number_format($target->monthly_income, 2) . ' ريال' : 'غير متوفر'
                            }}</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-mosque"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">الدين</p>
                        <p class="text-sm text-gray-900">{{ $target->religion ?? 'غير متوفر'
                            }}</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">نوع السكن</p>
                        <p class="text-sm text-gray-900">
                            @php
                            $housingType = [
                            'independent' => 'مستقل',
                            'family_annex' => 'ملحق عائلي',
                            'family_room' => 'غرفة مع العائلة',
                            'no_preference' => 'لا تفضيل'
                            ];
                            echo $housingType[$target->housing_type] ?? 'غير محدد';
                            @endphp
                        </p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">الحالة الصحية</p>
                        <p class="text-sm text-gray-900">{{ $target->health_status ?? 'غير
                            متوفر' }}</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-star-and-crescent"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">مستوى التدين</p>
                        <p class="text-sm text-gray-900">
                            @php
                            $religiosityLevel = [
                            'high' => 'مرتفع',
                            'medium' => 'متوسط',
                            'low' => 'منخفض'
                            ];
                            echo $religiosityLevel[$target->religiosity_level] ?? 'غير محدد';
                            @endphp
                        </p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">التزام الصلاة</p>
                        <p class="text-sm text-gray-900">
                            @php
                            $prayerCommitment = [
                            'yes' => 'نعم',
                            'sometimes' => 'أحيانًا',
                            'no' => 'لا'
                            ];
                            echo $prayerCommitment[$target->prayer_commitment] ?? 'غير محدد';
                            @endphp
                        </p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 h-5 w-5 text-green-500">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-gray-500">مستوى التعليم</p>
                        <p class="text-sm text-gray-900">
                            @php
                            $educationLevel = [
                            'illiterate' => 'أمي',
                            'general' => 'تعليم عام',
                            'diploma' => 'دبلوم',
                            'bachelor' => 'بكالوريوس',
                            'master' => 'ماجستير',
                            'phd' => 'دكتوراه'
                            ];
                            echo $educationLevel[$target->education_level] ?? 'غير محدد';
                            @endphp
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
@endpush