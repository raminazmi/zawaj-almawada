@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-xl p-8 border border-red-200">
            <h2 class="text-2xl font-bold text-red-700 mb-6 flex items-center">
                <i class="fas fa-user-slash ml-2"></i>
                تأكيد حذف الحساب
            </h2>
            <p class="text-red-700 text-md mb-6">
                انت على وشك حذف حسابك نهائياً.<br>
                <span class="font-semibold">تحذير:</span> سيتم فقدان جميع البيانات المرتبطة بالحساب ولن يمكن الرجوع
                اليها لاحقاً.<br>
                هل أنت متأكد أنك تريد حذف حسابك؟
            </p>
            <form method="POST" action="{{ route('profile.delete') }}" class="flex flex-col sm:flex-row gap-4">
                @csrf
                <a href="{{ route('profile.settings') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all flex items-center gap-2 shadow-md hover:shadow-lg transform hover:scale-105">
                    <i class="fas fa-arrow-right"></i>
                    إلغاء
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-red-600 to-red-400 text-white rounded-lg hover:from-red-700 hover:to-red-500 transition-all flex items-center gap-2 shadow-md hover:shadow-lg transform hover:scale-105">
                    <i class="fas fa-user-slash"></i>
                    نعم، حذف الحساب نهائياً
                </button>

            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush