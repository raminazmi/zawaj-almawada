@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Almarai', Arial, sans-serif;
    }

    .certificate-container {
        width: 100%;
        max-width: 700px;
        margin: 0 auto;
        background: #fff;
        border-radius: 18px;
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
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-[#3A8BCD]/20">

            <div class="certificate-container">
                <div class="certificate-header">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="شعار الموقع">
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
                        الدرجة: {{ round($result->score) }}%
                    </div>
                </div>
                <div class="certificate-footer">
                    شهادة معتمدة من منصة زواج المودة<br>
                </div>
            </div>

            <div class="text-center mt-8 space-x-4">
                <a href="{{ route('course-exams.certificate.download', $result->id) }}"
                    class="inline-block bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-full text-lg font-bold shadow-lg hover:opacity-90 transition">
                    <i class="fas fa-download ml-2"></i>
                    تحميل الشهادة
                </a>
                <a href="{{ route('course-exams.index') }}"
                    class="inline-block bg-gradient-to-l from-[#3A8BCD] to-[#553566] text-white px-6 py-3 rounded-full text-lg font-bold shadow-lg hover:opacity-90 transition">
                    العودة للاختبارات
                    <i class="fas fa-arrow-left mr-2"></i>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection