<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>طلب خطوبة جديد للمراجعة</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <h2 style="color: #553566;">طلب خطوبة جديد للمراجعة</h2>
        <p>مرحبًا {{ $admin->name }}،</p>
        <p>تم تقديم طلب خطوبة جديد يحتاج لمراجعتك:</p>
        <p><strong>رقم الطلب:</strong> {{ $marriageRequest->request_number }}</p>
        <p><strong>المرسل:</strong> {{ $marriageRequest->user->name }}</p>
        <p><strong>المستهدف:</strong> {{ $marriageRequest->target->name }}</p>
        <p><a href="{{ route('admin.marriage-requests.index') }}" style="color: #0071BC; text-decoration: none;">عرض
                الطلب</a></p>
        <p>شكرًا لاستخدامك زواج المودة!</p>
        <p>فريق زواج المودة</p>
    </div>
</body>

</html>