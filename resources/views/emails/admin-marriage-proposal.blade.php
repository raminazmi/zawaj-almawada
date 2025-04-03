@extends('layouts.email')

@section('content')
<div class="email-container" dir="rtl">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>طلب خطوبة جديد</h1>
    </div>

    <div class="content">
        <h2>مرحبًا فريق الإدارة،</h2>
        <p>تم تقديم طلب خطوبة جديد يحتاج لمراجعتكم:</p>

        <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <p style="margin: 5px 0;"><strong>رقم الطلب:</strong> {{ $marriageRequest->request_number }}</p>
            <p style="margin: 5px 0;"><strong>التاريخ:</strong> {{ $marriageRequest->created_at->format('Y-m-d H:i') }}
            </p>
            <p style="margin: 5px 0;"><strong>الحالة:</strong>
                @php
                $statuses = [
                'pending' => 'قيد الانتظار',
                'approved' => 'مقبول',
                'rejected' => 'مرفوض'
                ];
                echo $statuses[$marriageRequest->status] ?? 'غير معروف';
                @endphp
            </p>
        </div>

        <!-- بيانات المرسل -->
        <div style="background-color: #f0f7ff; padding: 20px; border-radius: 10px; margin-bottom: 25px;">
            <h3 style="color: #2c5282; border-bottom: 2px solid #bee3f8; padding-bottom: 8px;">
                <i class="fas fa-user" style="margin-left: 8px;"></i>
                بيانات المرسل ({{ $sender->name }})
            </h3>

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top: 15px;">
                <div>
                    <p style="margin: 5px 0;"><strong>العمر:</strong> {{ $sender->age ?? 'غير متوفر' }}</p>
                    <p style="margin: 5px 0;"><strong>البلد:</strong> {{ $sender->country ?? 'غير متوفر' }}</p>
                    <p style="margin: 5px 0;"><strong>الحالة الاجتماعية:</strong>
                        @php
                        $maritalStatus = [
                        'single' => 'أعزب',
                        'married' => 'متزوج',
                        'widowed' => 'أرمل',
                        'divorced' => 'مطلق'
                        ];
                        echo $maritalStatus[$sender->marital_status] ?? 'غير محدد';
                        @endphp
                    </p>
                    <p style="margin: 5px 0;"><strong>الوظيفة:</strong> {{ $sender->job_title ?? 'غير متوفر' }}</p>
                </div>
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
                        echo $educationLevel[$sender->education_level] ?? 'غير محدد';
                        @endphp
                    </p>
                    <p style="margin: 5px 0;"><strong>الدخل الشهري:</strong>
                        {{ $sender->monthly_income ? number_format($sender->monthly_income) . ' ريال' : 'غير متوفر' }}
                    </p>
                    <p style="margin: 5px 0;"><strong>مستوى التدين:</strong>
                        @php
                        $religiosityLevel = [
                        'high' => 'مرتفع',
                        'medium' => 'متوسط',
                        'low' => 'منخفض'
                        ];
                        echo $religiosityLevel[$sender->religiosity_level] ?? 'غير محدد';
                        @endphp
                    </p>
                </div>
            </div>
        </div>

        <!-- بيانات المستهدف -->
        <div style="background-color: #fff5f0; padding: 20px; border-radius: 10px; margin-bottom: 25px;">
            <h3 style="color: #9b2c2c; border-bottom: 2px solid #fed7d7; padding-bottom: 8px;">
                <i class="fas fa-user" style="margin-left: 8px;"></i>
                بيانات المستهدف ({{ $target->name }})
            </h3>

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top: 15px;">
                <div>
                    <p style="margin: 5px 0;"><strong>العمر:</strong> {{ $target->age ?? 'غير متوفر' }}</p>
                    <p style="margin: 5px 0;"><strong>البلد:</strong> {{ $target->country ?? 'غير متوفر' }}</p>
                    <p style="margin: 5px 0;"><strong>الحالة الاجتماعية:</strong>
                        @phpظظظ
                        $maritalStatus = [
                        'single' => 'أعزب/عزباء',
                        'married' => 'متزوج/ة',
                        'widowed' => 'أرمل/ة',
                        'divorced' => 'مطلق/ة'
                        ];
                        echo $maritalStatus[$target->marital_status] ?? 'غير محدد';
                        @endphp
                    </p>
                    <p style="margin: 5px 0;"><strong>الوظيفة:</strong> {{ $target->job_title ?? 'غير متوفر' }}</p>
                </div>
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
                        echo $educationLevel[$target->education_level] ?? 'غير محدد';
                        @endphp
                    </p>
                    <p style="margin: 5px 0;"><strong>الدخل الشهري:</strong>
                        {{ $target->monthly_income ? number_format($target->monthly_income) . ' ريال' : 'غير متوفر' }}
                    </p>
                    <p style="margin: 5px 0;"><strong>مستوى التدين:</strong>
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
        </div>

        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ route('admin.marriage-requests.index', $marriageRequest->id) }}"
                style="display: inline-block; padding: 12px 24px; background-color: #3182ce; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                عرض تفاصيل الطلب
            </a>
        </div>
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