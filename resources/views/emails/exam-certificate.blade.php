@extends('layouts.email')

@section('content')
@php $type = $type ?? 'success'; @endphp
<div class="email-container" dir="rtl">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>منصة زواج المودة</h1>
        <p>
            @if($type === 'attendance')
            شهادة حضور الدورة
            @else
            شهادة إتمام الاختبار
            @endif
        </p>
    </div>

    <div class="content">
        <div class="greeting">
            السلام عليكم ورحمة الله وبركاته<br>
            الأخ الفاضل / الأخت الفاضلة: <strong>{{ $result->user->full_name }}</strong>
        </div>

        <div class="message">
            @if($type === 'attendance')
            <p>نشكر لك التزامك بحضور دورة <strong>{{ $result->exam->title }}</strong> بتاريخ <strong>{{
                    $result->exam->start_time->format('Y/m/d') }}</strong>.<br>
                نأمل أن تكون الدورة قد أضافت لك الفائدة والمعرفة، ونتمنى لك التوفيق في الدورات القادمة.</p>
            <p>مرفق لك شهادة حضور الدورة، يمكنك طباعتها أو حفظها للمراجع المستقبلية.</p>
            @else
            <p>تهانينا الحارة! لقد أكملت اختبار <strong>{{ $result->exam->title }}</strong> بنجاح.</p>
            <div class="exam-info">
                <h3>تفاصيل الاختبار:</h3>
                <p><strong>اسم الاختبار:</strong> {{ $result->exam->title }}</p>
                <p><strong>تاريخ الإكمال:</strong> {{ $result->created_at->format('Y/m/d') }}</p>
                <p><strong>الوقت:</strong> {{ $result->created_at->format('h:i A') }}</p>
            </div>
            <div class="score">
                النتيجة النهائية: {{ round($result->score) }}/100
            </div>
            <p>تم إرفاق شهادة إتمام الاختبار مع هذا البريد الإلكتروني. يمكنك طباعتها أو حفظها للمراجع المستقبلية.</p>
            <p>نشكرك على مشاركتك في دورة التأهيل للحياة الزوجية، ونسأل الله أن يمن عليك بحياة أسرية سعيدة.</p>
            @endif
        </div>
        <div>
            <p><strong>مع تحيات مدير منصة زواج المودة</strong></p><br>
            <small class="text-gray-500">التوقيع</small>
            <div class="mt-5 text-center">
                <img src="https://zawaj-almawada.com/assets/images/signature.jpg" alt="توقيع المدير"
                    class="max-w-[200px] h-auto mx-auto block">
            </div>
        </div>
    </div>
</div>
@endsection