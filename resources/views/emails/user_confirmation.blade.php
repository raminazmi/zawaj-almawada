@extends('layouts.email')

@section('content')
<div class="email-container" dir="rtl">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>تمت الموافقة على طلب الخطوبة</h1>
    </div>

    <div class="content">
        <h2>مبروك! تمت الموافقة على طلب الخطوبة</h2>
        <p>عزيزي/عزيزتي {{ $user->name }}،</p>
        <p>يسعدنا إبلاغك أن كلا الطرفين قد وافقا على طلب الخطوبة بناءً على نتائج المقياس. الطلب الآن في انتظار
            الموافقة
            النهائية من الإدارة.</p>
        <p><strong>رقم الطلب:</strong> {{ $marriageRequest->request_number }}</p>
        <p>مع أطيب التمنيات،</p>
        <p>فريق برنامج زواج المودة</p>
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