<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>طلب خطوبة جديد</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <h2 style="color: #553566;">طلب خطوبة جديد</h2>
        <p>مرحبًا {{ $target->name }}،</p>
        <p>لقد تقدم العضو <strong>{{ $user->name }}</strong> لطلب خطبتك. يرجى تسجيل الدخول لمراجعة الطلب والرد عليه:</p>
        <p><a href="{{ route('marriage-requests.status') }}" style="color: #0071BC; text-decoration: none;">عرض
                الطلب</a></p>
        <p>شكرًا لاستخدامك زواج المودة!</p>
        <p>فريق زواج المودة</p>
    </div>
</body>

</html>