@extends('layouts.email')

@section('content')
<div class="email-container" dir="rtl">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>تمت الموافقة على طلب الخطوبة</h1>
    </div>
    <div class="email-container">
        <div class="content">
            <h2>مرحبًا {{ $user->name }}،</h2>
            <p>يسعدنا إعلامك بأنه تمت الموافقة على طلب الخطوبة من الطرف الأخر : {{ $partner->name }}.</p>
            <p>يجب عليك تقديم اختبار التوافق الزواجي لمعرفة مدى التوافق بينك وبين شريك حياتك : {{ $partner->name }} ،
                يرجى النقر على الرابط التالي :</p>
            <p><a href="{{ $testLink }}">{{ $testLink }}</a></p>
            <p>نتمنى لك التوفيق في الخطوات القادمة!</p>
            <p>فريق زواج المودة</p>
        </div>
    </div>
</div>

<style>
    .email-container {
        max-width: 600px;
        margin: 0 auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #333;
    }

    .header {
        text-align: center;
        padding: 20px 0;
    }

    .content {
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #6B46C1;
        margin-top: 10px;
    }

    h2 {
        color: #2D3748;
    }
</style>
@endsection