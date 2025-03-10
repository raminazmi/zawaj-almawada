<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تم رفض طلبك</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <h2 style="color: #553566;">تم رفض طلبك</h2>
        <p>مرحبًا {{ $user->name }}،</p>
        <p>نأسف لإبلاغك أن طلبك رقم <strong>{{ $marriageRequest->request_number }}</strong> قد تم رفضه من قبل الإدارة.
        </p>
        <p><a href="{{ route('marriage-requests.index') }}" style="color: #0071BC; text-decoration: none;">تقديم طلب
                جديد</a></p>
        <p>شكرًا لاستخدامك زواج المودة!</p>
        <p>فريق زواج المودة</p>
    </div>
</body>

</html>