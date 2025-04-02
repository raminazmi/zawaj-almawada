@extends('layouts.email')

@section('content')
<div class="email-container" dir="rtl">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>مقياس التوافق الزواجي</h1>
    </div>

    <div class="content">
        <h2>مرحبًا،</h2>
        <p>لقد تم قبول طلب الخطوبة من <strong>{{ $sender->name }}</strong>. يرجى تقديم مقياس مدى التوافق بينك وبين
            شريك حياتك:</p>
        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ $request->compatibility_test_link }}"
                style="display: inline-block; padding: 12px 24px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                رابط المقياس
            </a>
        </div>
        <p>شكرًا لاستخدامك زواج المودة!</p>
        <p>فريق زواج المودة</p>
    </div>
</div>
@endsection