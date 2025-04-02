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
                        <p style="margin: 5px 0;"><strong>الاسم:</strong> {{ $user->name }}</p>
                        <p style="margin: 5px 0;"><strong>العمر:</strong> {{ $user->age ?? 'غير متوفر' }}</p>
                        <p style="margin: 5px 0;"><strong>الطول:</strong> {{ $user->height ?? 'غير متوفر' }} سم</p>
                        <p style="margin: 5px 0;"><strong>الوزن:</strong> {{ $user->weight ?? 'غير متوفر' }} كجم</p>
                    </div>
                    <div>
                        <p style="margin: 5px 0;"><strong>المدينة:</strong> {{ $user->city }}</p>
                        <p style="margin: 5px 0;"><strong>القبيلة:</strong> {{ $user->tribe ?? 'غير متوفر' }}</p>
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
                    </div>
                </div>
            </div>

            <!-- المعلومات التعليمية والمهنية -->
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
                        <p style="margin: 5px 0;"><strong>الوظيفة:</strong> {{ $user->job_title ?? 'غير متوفر' }}</p>
                    </div>
                    <div>
                        <p style="margin: 5px 0;"><strong>الدخل الشهري:</strong>
                            {{ $user->monthly_income ? number_format($user->monthly_income) . ' ريال' : 'غير متوفر' }}
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

            <!-- المعلومات الدينية -->
            <div style="margin-bottom: 25px;">
                <h3 style="color: #6B46C1; border-bottom: 2px solid #EEE; padding-bottom: 8px;">
                    <i class="fas fa-star-and-crescent" style="margin-left: 8px;"></i>
                    المعلومات الدينية
                </h3>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top: 15px;">
                    <div>
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

            <!-- الوصف الشخصي -->
            <div style="margin-bottom: 25px;">
                <h3 style="color: #6B46C1; border-bottom: 2px solid #EEE; padding-bottom: 8px;">
                    <i class="fas fa-comment-dots" style="margin-left: 8px;"></i>
                    الوصف الشخصي
                </h3>
                <p style="margin: 15px 0; line-height: 1.6;">
                    {{ $user->personal_description ?? 'لا يوجد وصف شخصي' }}
                </p>
            </div>

            <!-- توقعات الشريك -->
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
            <a href="{{ route('login') }}"
                style="display: inline-block; padding: 12px 24px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                تسجيل الدخول والرد على الطلب
            </a>
        </div>
        <p>إذا واجهتك أي صعوبة، يمكنك التواصل مع فريق الدعم عبر <a href="mailto:zawajmawadda@gmail.com"
                style="color: #0071BC; text-decoration: none;">zawajmawadda@gmail.com</a></p>
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