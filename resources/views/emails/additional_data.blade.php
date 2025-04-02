<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بيانات إضافية</title>
</head>

<body style="font-family: Arial, sans-serif; direction: rtl; text-align: right;">
    <h1 style="color: #4a5568;">بيانات إضافية من الطرف الآخر</h1>
    <p style="color: #718096;">الاسم الكامل: {{ $full_name }}</p>
    <p style="color: #718096;">القرية: {{ $village }}</p>
    <p style="color: #718096;">رابط الاختبار: <a href="{{ $test_link }}" style="color: #0071BC;">{{ $test_link }}</a>
    </p>
</body>

</html>