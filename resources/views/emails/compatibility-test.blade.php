<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>طلب إرسال رابط المقياس</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <h2 style="color: #553566;">طلب إرسال رابط المقياس</h2>
        <p>مرحبًا،</p>
        <p>لقد تم قبول طلب الخطوبة من <strong>{{ $sender->name }}</strong>. يرجى إرسال رابط المقياس الخاص بك:</p>
        <p><a href="{{ route('marriage-requests.status') }}" style="color: #0071BC; text-decoration: none;">إرسال
                الرابط</a></p>
        <p>شكرًا لاستخدامك زواج المودة!</p>
        <p>فريق زواج المودة</p>
    </div>
</body>

</html>