<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Almarai', sans-serif;
            margin: 0;
            padding: 0;
            height: fit;
            font-size: 1rem;
            letter-spacing: -1px;
            position: relative;
        }

        .certificate-container {
            max-width: 800px;
            width: 88%;
            background: #f8fafc;
            padding: 25px;
            position: absolute;
            top: 46%;
            left: 46%;
            transform: translate(-50%, -50%);
            margin: 0;
        }

        .certificate-container-inside {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 25px;
            border-radius: 10px;
            background: #fff;
            border: 4px solid #3A8BCD;
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .certificate-header img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        .certificate-title {
            font-size: 24px;
            color: #2A5C82;
            font-weight: bold;
            margin: 0;
        }

        .certificate-site {
            font-size: 16px;
            color: #553566;
            margin: 5px 0;
        }

        .certificate-content {
            text-align: center;
            font-size: 16px;
            color: #374151;
            line-height: 1.5;
        }

        .certificate-name {
            font-size: 20px;
            color: #3A8BCD;
            font-weight: bold;
            margin: 15px 0;
            text-decoration: underline;
        }

        .certificate-course {
            font-size: 18px;
            color: #2A5C82;
            font-weight: bold;
            margin: 10px 0;
        }

        .certificate-duration {
            font-size: 14px;
            color: #4B5563;
            margin: 0;
            padding: 0 5px;
        }

        .certificate-score {
            display: inline-block;
            background: #d4edda;
            color: #155724;
            font-size: 14px;
            font-weight: bold;
            padding: 5px 15px;
            border-radius: 15px;
            margin: 10px 0;
            border: 1px solid #b8dcc6;
        }

        .certificate-date {
            font-size: 12px;
            color: #6B7280;
            margin: 10px 0;
        }

        .certificate-footer {
            width: 100%;
            margin-top: 20px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }

        .certificate-signature img {
            max-width: 150px;
            height: auto;
            margin: 10px auto;
        }

        .certificate-signature p {
            font-size: 14px;
            font-weight: bold;
            color: #2A5C82;
            margin: 0;
        }

        .certificate-signature small {
            font-size: 12px;
            color: #6B7280;
        }

        .inline-table {
            width: auto;
            margin: 0 auto;
            border-collapse: collapse;
        }

        .inline-table td {
            padding: 0;
            vertical-align: middle;
            border: none;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-table td {
            vertical-align: top;
            border: none;
            padding: 0;
        }

        .footer-left {
            text-align: left;
            padding-right: 20px;
        }

        .footer-right {
            text-align: right;
        }

        @media print {
            body {
                padding: 0;
                background: white;
            }
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <div class="certificate-container-inside">
            <div class="certificate-header">
                <img src="{{ public_path('assets/images/logo.png') }}" alt="شعار منصة زواج المودة">
                <div class="certificate-title">شهادة إجتياز</div>
                <div class="certificate-site">منصة زواج المودة</div>
            </div>

            <div class="certificate-content">
                <div class="certificate-content">
                    <p>تشهد منصة زواج المودة أن الفاضل/ة</p>
                    <div class="certificate-name">{{ $result->user->name ?? 'غير متوفر' }}</div>
                    <p>قد اجتاز عن بُعد</p>
                    <div class="certificate-course">{{ $result->exam->title ?? 'دورة التأهيل للحياة الزوجية' }}</div>

                    <!-- الجمل في سطر واحد باستخدام جدول -->
                    <table class="inline-table">
                        <tr>
                            <td>
                                <div>وحصل على العلامة</div>
                            </td>
                            <td>
                                <div class="certificate-duration">ولمدة شهرين</div>
                            </td>
                        </tr>
                    </table>

                    <div class="certificate-score">{{ round($result->score) }}/100</div>
                    <div class="certificate-date">بتاريخ {{ $result->created_at->format('Y/m/d') }}</div>
                    <p>ونسأل الله أن يمن عليه بحياة أسرية سعيدة</p>
                </div>
            </div>

            <!-- تذييل الصفحة باستخدام جدول -->
            <table class="certificate-footer">
                <tr>
                    <td class="footer-left">
                        <div class="certificate-signature">
                            <p>مع تحيات مدير منصة زواج المودة</p>
                            <img src="{{ public_path('assets/images/signature.jpg') }}" alt="توقيع المدير">
                        </div>
                    </td>
                    <td class="footer-right">
                        شهادة معتمدة من منصة زواج المودة للاستشارات الزوجية والأسرية
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>