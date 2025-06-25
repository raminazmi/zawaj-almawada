<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شهادة إتمام الاختبار</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700&display=swap');

        body {
            font-family: 'Almarai', Arial, sans-serif;
            direction: rtl;
            text-align: right;
            background-color: #f8fafc;
            margin: 0;
            padding: 20px;
        }

        .certificate-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            border-radius: 20px;
            border: 4px solid #3A8BCD;
            padding: 40px;
            position: relative;
            box-shadow: 0 10px 30px rgba(58, 139, 205, 0.1);
        }

        .decorative-border {
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border: 2px solid #553566;
            border-radius: 15px;
            opacity: 0.3;
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 16px;
        }

        .certificate-header .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 16px;
        }

        .certificate-header img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 8px;
        }

        .certificate-title {
            font-size: 2.5rem;
            color: #2A5C82;
            margin-bottom: 8px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .certificate-site {
            font-size: 1.3rem;
            color: #553566;
            margin-bottom: 8px;
        }

        .certificate-content {
            text-align: center;
            margin: 4px 0;
            line-height: 1.625;
        }

        .certificate-content p {
            font-size: 1.2rem;
            color: #374151;
            margin-bottom: 8px;
        }

        .certificate-name {
            font-size: 1.5rem;
            color: #3A8BCD;
            margin: 16px 0;
            text-decoration: underline;
            text-decoration-color: #553566;
            text-underline-offset: 8px;
        }

        .certificate-course {
            font-size: 1.3rem;
            color: #2A5C82;
            margin: 8px 0;
            font-weight: 600;
        }

        .certificate-duration {
            font-size: 1.1rem;
            color: #4B5563;
            margin: 8px 0;
            font-weight: 500;
        }

        .certificate-score {
            display: inline-block;
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            font-size: 1.1rem;
            font-weight: 600;
            padding: 8px 24px;
            border-radius: 25px;
            margin: 8px 0;
            box-shadow: 0 4px 15px rgba(42, 92, 130, 0.1);
            border: 2px solid #b8dcc6;
        }

        .certificate-date {
            font-size: 1rem;
            color: #6B7280;
            margin: 12px 0;
        }

        .certificate-footer {
            margin-top: 24px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            color: #2A5C82;
            font-size: 1rem;
            border-top: 2px solid #e5e7eb;
            padding-top: 24px;
        }

        .certificate-footer p {
            text-align: center;
            margin-top: 32px;
            color: #4B5563;
        }

        .certificate-signature {
            text-align: center;
        }

        .certificate-signature p {
            font-weight: 600;
            margin-bottom: 0;
        }

        .certificate-signature small {
            color: #6B7280;
        }

        .certificate-signature img {
            max-width: 200px;
            height: auto;
            margin: 20px auto;
            display: block;
        }

        .button-container {
            margin-top: 32px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
        }

        .download-button {
            display: inline-block;
            background: linear-gradient(to right, #3b82f6, #2563eb);
            color: #fff;
            padding: 8px 24px;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 700;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: opacity 0.2s ease-in-out;
            text-decoration: none;
        }

        .download-button:hover {
            opacity: 0.9;
        }

        .download-button.loading {
            background: #e5e7eb;
            color: #e5e7eb;
            opacity: 0.5;
        }

        .back-button {
            display: inline-block;
            background: linear-gradient(to left, #3A8BCD, #553566);
            color: #fff;
            padding: 8px 24px;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 700;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: opacity 0.2s ease-in-out;
            text-decoration: none;
        }

        .back-button:hover {
            opacity: 0.9;
        }

        @media print {
            body {
                background: white;
            }

            .min-h-screen {
                min-height: auto;
            }
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <div class="decorative-border"></div>

        <div class="certificate-header">
            <div class="logo-container">
                <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="توقيع المدير"
                    class="max-width: 100px; margin-bottom: 10px;">
                <p class="certificate-title">شهادة إجتياز</p>
                <div class="certificate-site">منصة زواج المودة</div>
            </div>
        </div>

        <div class="certificate-content">
            <p><strong>تشهد منصة زواج المودة أن الفاضل/ة</strong></p>
            <div class="certificate-name">{{ $result->user->name }}</div>
            <div><strong>قد اجتاز عن بُعد</strong>
                <span class="certificate-course">دورة التأهيل للحياة الزوجية</span>
                <div>
                    <span class="certificate-duration">ولمدة شهرين</span>
                    <span><strong>وحصل على العلامة</strong></span>
                </div>
            </div>
            <div class="certificate-score">({{ round($result->score) }}/100)</div>
            <div class="certificate-date">بتاريخ {{ $result->created_at->format('Y/m/d') }}</div>
            <p><strong>ونسأل الله أن يمن عليه بحياة أسرية سعيدة</strong></p>
        </div>

        <div class="certificate-footer">
            <p>
                شهادة معتمدة من منصة زواج المودة<br>
                للاستشارات الزوجية والأسرية
            </p>
            <div class="certificate-signature">
                <p><strong>مع تحيات مدير منصة زواج المودة</strong></p>
                <small>التوقيع</small>
                <div>
                    <img src="https://zawaj-almawada.com/assets/images/signature.jpg" alt="توقيع المدير"
                        class="max-w-[200px] h-auto mx-auto block">
                </div>
            </div>
        </div>
    </div>

    <div class="button-container">
        <a href="{{ route('course-exams.certificate.download', $result->id) }}" id="downloadButton"
            class="download-button">
            <i class="fas fa-download" style="margin-left: 8px;"></i>
            تحميل الشهادة
        </a>
        <a href="{{ route('course-exams.index') }}" class="back-button">
            العودة للاختبارات
            <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>
        </a>
    </div>

    <script>
        document.getElementById('downloadButton').addEventListener('click', function() {
            var button = this;
            button.innerText = 'جاري تحميل الشهادة...';
            button.classList.remove('download-button');
            button.classList.add('loading');
        });
    </script>
</body>

</html>