@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center bg-white px-6 py-3 gap-3 rounded-full shadow-lg border border-purple-200">
                <h1
                    class="text-xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    تقديم طلب خطوبة لـ {{ $target->name }}
                </h1>
            </div>
        </div>

        @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4 text-center">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4 text-center">
            {{ session('error') }}
        </div>
        @endif

        @if(Auth::user()->status === 'engaged' || Auth::user()->status === 'pending')
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            <p>أنت متزوج بالفعل من {{
                Auth::user()->activeMarriageRequest()
                ? Auth::user()->activeMarriageRequest()->target->name
                : Auth::user()->targetMarriageRequest()->user->name
                }} ولا يمكنك تقديم طلبات جديدة.</p>
        </div>
        @else
        <div class="bg-white rounded-3xl shadow-xl border border-purple-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-4 text-center">
                <h2 class="text-lg font-semibold text-white">
                    @if(Auth::user()->gender === 'female')
                    <i class="fas fa-male ml-2"></i>تأكيد طلب خطوبة شاب
                    @elseif(Auth::user()->gender === 'male')
                    <i class="fas fa-female ml-2"></i>تأكيد طلب خطوبة فتاة
                    @endif
                </h2>
            </div>

            <div class="p-6 text-center">
                <p class="mb-4">سيتم إرسال طلب خطوبة إلى {{ $target->name }} باستخدام معلوماتك الشخصية المسجلة في ملفك
                    الشخصي.</p>
                <form method="POST" action="{{ route('marriage-requests.store-proposal', $target->id) }}">
                    @csrf
                    <button type="submit"
                        class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-2 rounded-full hover:from-purple-700 hover:to-pink-700 transition-all text-lg font-semibold shadow-lg group">
                        إرسال الطلب
                        <i class="fas fa-paper-plane mr-2 transform group-hover:rotate-220 transition-transform"></i>
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection