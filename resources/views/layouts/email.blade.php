<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'زواج المودة')</title>
    <style>
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

        .footer {
            background-color: #f8fafc;
            padding: 1.5rem;
            text-align: center;
            font-size: 0.875rem;
            color: #64748b;
        }
    </style>
</head>

<body>
    @yield('content')

    <div class="footer">
        <p>© {{ date('Y') }} <a href="{{ url('/') }}">موقع زواج المودة</a>. جميع الحقوق محفوظة.</p>
    </div>
</body>

</html>