@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <x-profile.header />

        @if (session('success'))
        <x-alert.success :message="session('success')" />
        @endif

        @if($user->profile_status === 'approved')
        <div
            class="bg-white flex flex-col items-center justify-center rounded-3xl shadow-xl border border-purple-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-4 text-center w-[100%]">
                <h2 class="text-lg font-semibold text-white">
                    <i class="fas fa-check-circle ml-2"></i>ملفك الشخصي مكتمل
                </h2>
            </div>
            <p class="text-gray-600 mb-6 mt-4 px-2 text-center">تمت الموافقة على ملفك الشخصي بنجاح ، الأن يمكنك استقبال
                طلبات زواج</p>
            <a href="{{ route('profile-approvals.show', $user->id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700
                transition-all shadow-md hover:shadow-lg transform hover:scale-105 mb-3">
                <i class="fas fa-eye ml-2"></i>
                عرض ملفي
            </a>
        </div>

        @elseif($user->profile_status === 'pending')
        <div
            class="bg-white flex flex-col items-center justify-center rounded-3xl shadow-xl border border-purple-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-4 text-center w-[100%]">
                <h2 class="text-lg font-semibold text-white">
                    <i class="fas fa-hourglass-half ml-2"></i>ملفك الشخصي بانتظار الموافقة
                </h2>
            </div>
            <p class="text-gray-600 mb-6 mt-4 px-2 text-center">تم تقديم طلبك وهو الآن قيد المراجعة. يمكنك عرض الملف
                ولكن لا يمكن تعديله
                ، لا
                يمكنك استقبال او ارسال طلبات زواج
                حاليًا.</p>
            <a href="{{ route('profile-approvals.show', $user->id) }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all shadow-md hover:shadow-lg transform hover:scale-105 mb-3">
                <i class="fas fa-eye ml-2"></i>
                عرض ملفي
            </a>
        </div>

        @elseif($user->profile_status === 'rejected')
        <div class="bg-white rounded-3xl shadow-xl border border-purple-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-4 text-center">
                <h2 class="text-lg font-semibold text-white">
                    <i class="fas fa-times-circle ml-2"></i>ملفك الشخصي مرفوض
                </h2>
            </div>
            <p class="text-gray-600 mb-6 mt-4 px-2 text-center">تم رفض ملفك الشخصي. يمكنك تعديله وإعادة تقديمه للموافقة.
            </p>
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4 p-6 pt-0">
                @csrf
                <x-profile.basic-info :user="$user" />
                <x-profile.marital-status :user="$user" />
                <x-profile.education-work :user="$user" />
                <x-profile.health-info :user="$user" />
                <x-profile.additional-info :user="$user" />
                <x-profile.submit-button />
            </form>
        </div>

        @else
        <div class="bg-white rounded-3xl shadow-xl border border-purple-100 overflow-hidden">
            <x-profile.form-header />
            <p class="text-gray-600 mb-6 mt-4 px-2 text-center">يرجى إكمال الملف الشخصي لتقديمه للموافقة.</p>
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4 p-6 pt-0">
                @csrf
                <x-profile.basic-info :user="$user" />
                <x-profile.marital-status :user="$user" />
                <x-profile.education-work :user="$user" />
                <x-profile.health-info :user="$user" />
                <x-profile.additional-info :user="$user" />
                <x-profile.submit-button />
            </form>
        </div>
        @endif
    </div>
</div>
@endsection