<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>تفاصيل الطرف الآخر</title>
</head>

<body>
    <h2>مرحباً {{ $marriageRequest->target->name }}</h2>
    <p>تم تزويدك ببيانات الطرف الآخر:</p>
    <ul>
        <li><strong>الاسم الكامل:</strong> {{ $marriageRequest->partner_full_name }}</li>
        <li><strong>القرية:</strong> {{ $marriageRequest->partner_village }}</li>
        <li><strong>رابط الاختبار:</strong> <a href="{{ $marriageRequest->partner_test_link }}">{{
                $marriageRequest->partner_test_link }}</a></li>
    </ul>
    <p>شكراً لاستخدامك نظام الزواج الشرعي.</p>
</body>

</html>