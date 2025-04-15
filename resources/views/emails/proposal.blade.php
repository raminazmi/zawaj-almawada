@extends('layouts.email')

@section('content')
<div class="email-container" dir="rtl">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>طلب خطوبة جديد</h1>
    </div>

    <div class="content">
        <h2>مرحبًا {{ $target->name }}،</h2>
        <p>لقد تلقيت طلب خطوبة جديد على منصة الزواج الشرعي.</p>

        <div style="background-color: #f9f9f9; padding: 20px; border-radius: 10px; margin-bottom: 25px;">
            <div style="margin-bottom: 25px;">
                <h3 style="color: #6B46C1; border-bottom: 2px solid #EEE; padding-bottom: 8px;">
                    <i class="fas fa-user" style="margin-left: 8px;"></i>
                    المعلومات الأساسية
                </h3>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top: 15px;">
                    <div>
                        <p style="margin: 5px 0;"><strong>الاسم المستعار:</strong> {{ $user->name ?? 'غير متوفر' }}</p>
                        <p style="margin: 5px 0;"><strong>رقم العضوية:</strong> {{ $user->membership_number ?? 'غير
                            متوفر' }}</p>
                        <p style="margin: 5px 0;"><strong>الجنس:</strong>
                            {{ $user->gender === 'male' ? 'ذكر' : ($user->gender === 'female' ? 'أنثى' : 'غير محدد') }}
                        </p>
                        <p style="margin: 5px 0;"><strong>العمر:</strong> {{ $user->age ?? 'غير متوفر' }}</p>
                        <p style="margin: 5px 0;"><strong>الطول:</strong> {{ $user->height ?? 'غير متوفر' }} سم</p>
                        <p style="margin: 5px 0;"><strong>الوزن:</strong> {{ $user->weight ?? 'غير متوفر' }} كجم</p>
                        <p style="margin: 5px 0;"><strong>لون البشرة:</strong> {{ $user->skin_color ?? 'غير متوفر' }}
                        </p>
                        <p style="margin: 5px 0;"><strong>لديه أطفال:</strong> {{ $user->has_children ? 'نعم' : 'لا' }}
                        </p>
                        @if($user->has_children)
                        <p style="margin: 5px 0;"><strong>عدد الأطفال:</strong> {{ $user->children_count ?? 'غير متوفر'
                            }}</p>
                        @endif
                    </div>
                    <div>
                        <p style="margin: 5px 0;"><strong>البلد:</strong> {{ $user->country ?? 'غير متوفر' }}</p>
                        <p style="margin: 5px 0;"><strong>الولاية/المحافظة:</strong> {{ $user->state ?? 'غير متوفر' }}
                        </p>
                        <p style="margin: 5px 0;"><strong>القبيلة:</strong> {{ $user->tribe ?? 'غير متوفر' }}</p>
                        <p style="margin: 5px 0;"><strong>النسب:</strong> {{ $user->lineage ?? 'غير متوفر' }}</p>
                        <p style="margin: 5px 0;"><strong>الحالة الاجتماعية:</strong>
                            @php
                            $maritalStatus = [
                            'single' => 'أعزب',
                            'married' => 'متزوج',
                            'widowed' => 'أرمل',
                            'divorced' => 'مطلق'
                            ];
                            echo $maritalStatus[$user->marital_status] ?? 'غير محدد';
                            @endphp
                        </p>
                        @if($user->gender === 'female')
                        <p style="margin: 5px 0;"><strong>محجبة:</strong> {{ $user->is_hijabi ? 'نعم' : 'لا' }}</p>
                        <p style="margin: 5px 0;"><strong>القبول بشخص متزوج:</strong> {{ $user->accepts_married ? 'نعم'
                            : 'لا' }}</p>
                        @endif
                        @if($user->gender === 'male')
                        <p style="margin: 5px 0;"><strong>يدخن:</strong> {{ $user->is_smoker ? 'نعم' : 'لا' }}</p>
                        @endif
                        <p style="margin: 5px 0;"><strong>يرغب في إنجاب أطفال:</strong> {{ $user->wants_children ? 'نعم'
                            : 'لا' }}</p>
                        <p style="margin: 5px 0;"><strong>يعاني من عقم:</strong> {{ $user->infertility ? 'نعم' : 'لا' }}
                        </p>
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 25px;">
                <h3 style="color: #6B46C1; border-bottom: 2px solid #EEE; padding-bottom: 8px;">
                    <i class="fas fa-graduation-cap" style="margin-left: 8px;"></i>
                    التعليم والمهنة
                </h3>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top: 15px;">
                    <div>
                        <p style="margin: 5px 0;"><strong>المستوى التعليمي:</strong>
                            @php
                            $educationLevel = [
                            'illiterate' => 'أمي',
                            'general' => 'تعليم عام',
                            'diploma' => 'دبلوم',
                            'bachelor' => 'بكالوريوس',
                            'master' => 'ماجستير',
                            'phd' => 'دكتوراه'
                            ];
                            echo $educationLevel[$user->education_level] ?? 'غير محدد';
                            @endphp
                        </p>
                        <p style="margin: 5px 0;"><strong>القطاع الوظيفي:</strong>
                            @php
                            $work_sector = [
                            'government' => 'قطاع حكومي',
                            'private' => 'قطاع خاص',
                            'self_employed' => 'أعمال حرة',
                            'unemployed' => 'باحث عن عمل'
                            ];
                            echo $work_sector[$user->work_sector] ?? 'غير محدد';
                            @endphp
                        </p>
                        <p style="margin: 5px 0;"><strong>الوظيفة:</strong> {{ $user->job_title ?? 'غير متوفر' }}</p>
                    </div>
                    <div>
                        <p style="margin: 5px 0;"><strong>الدخل الشهري:</strong>
                            {{ $user->monthly_income ? number_format($user->monthly_income, 2) . ' ريال' : 'غير متوفر'
                            }}
                        </p>
                        <p style="margin: 5px 0;"><strong>نوع السكن:</strong>
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

            <div style="margin-bottom: 25px;">
                <h3 style="color: #6B46C1; border-bottom: 2px solid #EEE; padding-bottom: 8px;">
                    <i class="fas fa-star-and-crescent" style="margin-left: 8px;"></i>
                    المعلومات الدينية
                </h3>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top: 15px;">
                    <div>
                        <p style="margin: 5px 0;"><strong>الدين:</strong>
                            @php
                            $religion = [
                            'Islam' => 'مسلم',
                            'Christianity' => 'غير مسلم'
                            ];
                            echo $religion[$user->religion] ?? 'غير محدد';
                            @endphp
                        </p>
                        <p style="margin: 5px 0;"><strong>الالتزام بالصلاة:</strong>
                            @php
                            $prayerCommitment = [
                            'yes' => 'نعم',
                            'sometimes' => 'أحيانًا',
                            'no' => 'لا'
                            ];
                            echo $prayerCommitment[$user->prayer_commitment] ?? 'غير محدد';
                            @endphp
                        </p>
                    </div>
                    <div>
                        <p style="margin: 5px 0;"><strong>مستوى التدين:</strong>
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

            <div style="margin-bottom: 25px;">
                <h3 style="color: #6B46C1; border-bottom: 2px solid #EEE; padding-bottom: 8px;">
                    <i class="fas fa-heartbeat" style="margin-left: 8px;"></i>
                    المعلومات الصحية
                </h3>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top: 15px;">
                    <div>
                        <p style="margin: 5px 0;"><strong>الحالة الصحية:</strong> {{ $user->health_status ?? 'غير متوفر'
                            }}</p>
                        <p style="margin: 5px 0;"><strong>الأمراض الوراثية:</strong> {{ $user->genetic_diseases ?? 'غير
                            متوفر' }}</p>
                        <p style="margin: 5px 0;"><strong>الأمراض المعدية:</strong> {{ $user->infectious_diseases ??
                            'غير متوفر' }}</p>
                    </div>
                    <div>
                        <p style="margin: 5px 0;"><strong>الاضطرابات النفسية:</strong> {{ $user->psychological_disorders
                            ?? 'غير متوفر' }}</p>
                        <p style="margin: 5px 0;"><strong>يعاني من إعاقة:</strong> {{ $user->has_disability ? 'نعم' :
                            'لا' }}</p>
                        @if($user->has_disability)
                        <p style="margin: 5px 0;"><strong>تفاصيل الإعاقة:</strong> {{ $user->disability_details ?? 'غير
                            متوفر' }}</p>
                        @endif
                        <p style="margin: 5px 0;"><strong>يعاني من تشوه:</strong> {{ $user->has_deformity ? 'نعم' : 'لا'
                            }}</p>
                        @if($user->has_deformity)
                        <p style="margin: 5px 0;"><strong>تفاصيل التشوه:</strong> {{ $user->deformity_details ?? 'غير
                            متوفر' }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 25px;">
                <h3 style="color: #6B46C1; border-bottom: 2px solid #EEE; padding-bottom: 8px;">
                    <i class="fas fa-comment-dots" style="margin-left: 8px;"></i>
                    الوصف الشخصي
                </h3>
                <p style="margin: 15px 0; line-height: 1.6;">
                    {{ $user->personal_description ?? 'لا يوجد وصف شخصي' }}
                </p>
            </div>

            <div>
                <h3 style="color: #6B46C1; border-bottom: 2px solid #EEE; padding-bottom: 8px;">
                    <i class="fas fa-heart" style="margin-left: 8px;"></i>
                    توقعات الشريك
                </h3>
                <p style="margin: 15px 0; line-height: 1.6;">
                    {{ $user->partner_expectations ?? 'لا يوجد توقعات محددة' }}
                </p>
            </div>
        </div>

        <p>يمكنك الآن تسجيل الدخول إلى حسابك للاطلاع على تفاصيل الطلب والرد عليه:</p>
        <div style="text-align: center; margin: 2rem 0;">
            <a href="https://zawaj-almawada.com/login"
                style="display: inline-block; padding: 12px 24px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                تسجيل الدخول والرد على الطلب
            </a>
        </div>
        <p>إذا واجهتك أي صعوبة، يمكنك التواصل مع فريق الدعم عبر <a href="mailto:info@zawaj-almawada.com"
                style="color: #0071BC; text-decoration: none;">info@zawaj-almawada.com</a></p>
    </div>
</div>

<style>
    .email-container {
        max-width: 800px;
        margin: 0 auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #333;
    }

    .header {
        text-align: center;
        padding: 20px 0;
        border-bottom: 2px solid #EEE;
    }

    .content {
        padding: 20px;
    }

    h2 {
        color: #2D3748;
    }

    h3 {
        font-size: 1.1em;
        margin: 25px 0 15px;
    }
</style>
@endsection