@extends('layouts.email')

@section('content')
<div class="email-container" dir="rtl">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>موافقة نهائية</h1>
    </div>

    <div class="content">
        <h2>مرحبًا {{ $recipient->name }}،</h2>
        <p>مبارك! تمت خطبتكم وتم قبول طلب الزواج من منصة زواج المودة.</p>
        <p>إليك بيانات الطرف الآخر:</p>
        <ul>
            <li><strong>الاسم:</strong> {{ $partner->name }}</li>
            <li><strong>البلد:</strong> {{ $partner->country ?? 'غير محدد' }}</li>
            <li><strong>الولاية:</strong> {{ $partner->state ?? 'غير محدد' }}</li>
            <li><strong>القبيلة:</strong> {{ $partner->tribe ?? 'غير محدد' }}</li>
        </ul>

        @if ($testLink && !$testResult)
        <p>يرجى إكمال اختبار التوافق عبر الرابط التالي:</p>
        <p><a href="{{ $testLink }}">{{ $testLink }}</a></p>
        @elseif($testResult)
        <div style="margin-top: 20px; padding: 15px; background-color: #f9f9f9; border-radius: 8px;">
            <h4 style="color: #333; margin-bottom: 10px;">الأسئلة المهمة</h4>
            <p style="margin: 5px 0;">إجمالي الأسئلة المهمة: {{ $totalImportant }}</p>
            <p style="margin: 5px 0;">النقاط الحاسمة للخاطب: {{ $maleImportantScore['score'] }} / {{
                $maleImportantScore['total']
                }}</p>
            <p style="margin: 5px 0;">النقاط الحاسمة للمخطوبة: {{ $femaleImportantScore['score'] }} / {{
                $femaleImportantScore['total'] }}</p>
            <p style="margin-top: 10px; font-weight: bold;">نتيجة الاختبار العامة : {{ $testResult }}%</p>
        </div>
        @else
        <p>لا يوجد اختبار متاح حاليًا.</p>
        @endif

        <p>شكرًا لاستخدامك زواج المودة!</p>
        <p>فريق زواج المودة</p>
    </div>
</div>
@endsection