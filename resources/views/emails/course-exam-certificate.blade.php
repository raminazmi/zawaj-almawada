<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <title>شهادة إتمام الاختبار</title>
</head>

<body>
    <h1>مرحباً {{ $result->user->name }}</h1>
    <p>تهانينا! لقد أكملت الاختبار بنجاح.</p>
    <p>النتيجة: {{ $result->score }}</p>
    <p>تم إرفاق شهادة إتمام الاختبار مع هذا البريد الإلكتروني.</p>
</body>

</html>