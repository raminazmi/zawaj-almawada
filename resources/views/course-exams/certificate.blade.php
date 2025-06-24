<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <title>شهادة إتمام الاختبار</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700&display=swap');

        body {
            font-family: 'Almarai', Arial, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 0;
        }

        .certificate-container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(42, 92, 130, 0.10), 0 1.5px 8px rgba(85, 53, 102, 0.08);
            border: 3px solid #3A8BCD;
            padding: 40px 32px 32px 32px;
            position: relative;
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .certificate-header img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .certificate-title {
            font-size: 2.1rem;
            font-weight: 800;
            color: #2A5C82;
            margin-bottom: 8px;
            letter-spacing: -1px;
        }

        .certificate-site {
            font-size: 1.1rem;
            color: #553566;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .certificate-content {
            text-align: center;
            margin: 30px 0 20px 0;
        }

        .certificate-content p {
            font-size: 1.15rem;
            color: #444;
            margin: 10px 0;
        }

        .certificate-name {
            font-size: 1.7rem;
            font-weight: bold;
            color: #3A8BCD;
            margin: 18px 0 10px 0;
        }

        .certificate-exam {
            font-size: 1.1rem;
            color: #2A5C82;
            margin-bottom: 10px;
        }

        .certificate-date {
            font-size: 1rem;
            color: #888;
            margin-bottom: 18px;
        }

        .certificate-score {
            display: inline-block;
            background: #d4edda;
            color: #155724;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 12px 32px;
            border-radius: 9999px;
            margin: 18px 0;
            letter-spacing: 1px;
            box-shadow: 0 2px 8px rgba(42, 92, 130, 0.07);
        }

        .certificate-footer {
            text-align: center;
            margin-top: 40px;
            color: #666;
            font-size: 1rem;
            border-top: 1px solid #eee;
            padding-top: 18px;
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <div class="certificate-header">
            <img src="{{ public_path('assets/images/logo.png') }}" alt="شعار الموقع">
            <div class="certificate-title">شهادة إتمام <b>{{ $result->exam->title }}</b></div>
            <div class="certificate-site">زواج المودة</div>
        </div>
        <div class="certificate-content">
            <p>تمنح هذه الشهادة إلى</p>
            <div class="certificate-name">{{ $result->user->name }}</div>
            <div class="certificate-exam">
                لإتمامه <b>{{ $result->exam->title }}</b>
            </div>
            <div class="certificate-date">
                بتاريخ {{ $result->created_at->format('Y-m-d') }}
            </div>
            <div class="certificate-score">
                الدرجة: {{ $result->score }}
            </div>
        </div>
        <div class="certificate-footer">
            شهادة معتمدة من منصة زواج المودة<br>
        </div>
    </div>
</body>

</html>