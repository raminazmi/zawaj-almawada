@extends('layouts.email')

@section('content')
<div class="email-container">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>إشعار برفض طلب الخطوبة</h1>
    </div>

    <div class="content">
        <h2>مرحبًا {{ $rejecter->name }},</h2>
        <p>نأسف لإعلامك بأن الطرف الآخر قد قام برفض طلب الخطوبة.</p>

        @if($reason)
        <div style="background-color: #f8f9fa; padding: 15px; border-radius: 8px; margin: 15px 0;">
            <h3 style="color: #dc3545; margin-top: 0;">سبب الرفض:</h3>
            <p>{{ $reason }}</p>
        </div>
        @endif

        <p>نحن في زواج المودة نقدم لك العديد من الخدمات التي تساعدك في رحلتك للعثور على الشريك المناسب:</p>

        <div style="text-align: center; margin: 2rem 0;">
            <div style="display: inline-block; text-align: right; margin-bottom: 1rem;">
                <div style="margin-bottom: 10px;">
                    <i class="fas fa-heart" style="color: #e83e8c; margin-right: 5px;"></i>
                    <span>مقياس التوافق الزواجي</span>
                </div>
                <div style="margin-bottom: 10px;">
                    <i class="fas fa-users" style="color: #17a2b8; margin-right: 5px;"></i>
                    <span>آلاف الشخصيات المتوافقة معك</span>
                </div>
                <div style="margin-bottom: 10px;">
                    <i class="fas fa-star" style="color: #ffc107; margin-right: 5px;"></i>
                    <span>نصائح وتوجيهات من خبراء العلاقات</span>
                </div>
            </div>

            <div style="margin-top: 1.5rem;">
                <a href="{{ route('marriage-requests.status') }}" style="display: inline-block; padding: 12px 24px; 
                  background: linear-gradient(to right, #6B46C1, #3B82F6);
                  color: #fff; text-decoration: none; 
                  border-radius: 5px; font-weight: bold;
                  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                  transition: all 0.3s ease;">
                    اكتشف المزيد من المزايا
                </a>
            </div>
        </div>
        <p>نشكرك لثقتك بمنصة زواج المودة ونتمنى لك التوفيق في العثور على الشريك المناسب.</p>
        <p>فريق زواج المودة</p>
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