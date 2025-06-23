<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شهادة إتمام الاختبار</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2A5C82;
            margin: 0;
            padding: 10px 0;
        }

        .content {
            margin-bottom: 30px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3A8BCD;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }

        .score {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>شهادة إتمام الاختبار</h1>
        </div>

        <div class="content">
            <p>مرحباً {{ $result->user->name }},</p>

            <p>نود إعلامك بأنك قد أكملت اختبار {{ $result->exam->title }} بنجاح.</p>

            <div class="score">
                <strong>الدرجة النهائية:</strong> {{ $result->score }}
            </div>

            <p>تم إرفاق شهادة إتمام الاختبار مع هذا البريد الإلكتروني.</p>

            <p>يمكنك الوصول إلى الشهادة من خلال المرفقات أدناه.</p>
        </div>

        <div class="footer">
            <p>هذا البريد الإلكتروني تم إرساله تلقائياً من نظام زواج المودة</p>
            <p>© {{ date('Y') }} زواج المودة. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</body>

</html>