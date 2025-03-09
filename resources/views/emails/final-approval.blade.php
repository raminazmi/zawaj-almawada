<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>موافقة نهائية</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <h2 style="color: #553566;">موافقة نهائية</h2>
        <p>مرحبًا،</p>
        <p>لقد قدم <strong>{{ $sender->name }}</strong> موافقته النهائية وبياناته الحقيقية. يرجى مراجعة الحالة:</p>
        <p><a href="{{ route('marriage-requests.status') }}" style="color: #0071BC; text-decoration: none;">عرض
                الحالة</a></p>
        <p>شكرًا لاستخدامك زواج المودة!</p>
        <p>فريق زواج المودة</p>
    </div>
</body>

</html>