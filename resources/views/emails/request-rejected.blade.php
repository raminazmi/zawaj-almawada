<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم رفض الطلب</title>
    <style>
        body {
            font-family: 'Tajawal', Arial, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .header {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            padding: 2rem;
            text-align: center;
        }

        .header img {
            height: 64px;
            width: auto;
            margin-bottom: 1rem;
        }

        .header h1 {
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .content {
            padding: 2rem;
            text-align: right;
        }

        .content h2 {
            color: #1e293b;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .content p {
            color: #475569;
            line-height: 1.6;
            margin-bottom: 1.25rem;
        }

        .user-info {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .user-info p {
            margin: 0.5rem 0;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            color: #ffffff;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .cta-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(124, 58, 237, 0.3), 0 2px 4px -1px rgba(124, 58, 237, 0.06);
        }

        .footer {
            background-color: #f8fafc;
            padding: 1.5rem;
            text-align: center;
            font-size: 0.875rem;
            color: #64748b;
        }

        .footer a {
            color: #4f46e5;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ asset('assets/images/logo.png') }}" alt="شعار الموقع">
            <h1>تم رفض طلبك</h1>
        </div>

        <div class="content">
            <h2>مرحبًا {{ $user->name }}،</h2>

            <div class="user-info">
                <p><strong>رقم الطلب:</strong> {{ $marriageRequest->request_number }}</p>
                <p><strong>تاريخ الطلب:</strong> {{ $marriageRequest->created_at->format('Y-m-d') }}</p>
            </div>

            <p>نأسف لإبلاغك بأن طلبك قد تم رفضه من قبل الإدارة.</p>
            <p>يمكنك تقديم طلب جديد بعد مراجعة الشروط والمتطلبات.</p>

            <div style="text-align: center; margin: 2rem 0;">
                <a href="{{ route('marriage-requests.create') }}" class="cta-button">
                    تقديم طلب جديد
                </a>
            </div>

            <p>للاستفسار عن أسباب الرفض، يرجى التواصل مع الدعم الفني عبر
                <a href="mailto:zawajmawadda@gmail.com">zawajmawadda@gmail.com</a>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} <a href="{{ url('/') }}">موقع زواج المودة</a>. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</body>

</html>