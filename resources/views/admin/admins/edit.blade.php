@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-6 border border-purple-100">
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                @if($user->id === 1)
                تعديل الادمن الرئيسي
                @elseif($user->admin_role === 'main')
                تعديل الادمن
                @else
                تعديل المشرف
                @endif
                #{{
                $user->id }}
            </h2>
            <p class="text-gray-500 mt-2">قم بتعديل الحقول التالية حسب الحاجة</p>
        </div>

        <form action="{{ route('admin.admins.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الاسم الكامل</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-2 border rounded-lg @error('name') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                    @error('name')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-2 border rounded-lg @error('email') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                    @error('email')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور الجديدة</label>
                        <input type="password" name="password"
                            class="w-full px-4 py-2 border rounded-lg @error('password') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                            placeholder="اتركه فارغاً للحفاظ على الكلمة الحالية">
                        @error('password')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-4 py-2 border rounded-lg border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                            placeholder="أعد إدخال الكلمة الجديدة">
                    </div>
                </div>

                @if(auth()->user()->isMainAdmin() && $user->id !== 1)
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-3">نوع الصلاحية</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <label
                            class="flex items-center p-3 bg-white rounded-lg border @error('admin_role') border-red-500 @else border-gray-200 @enderror hover:border-purple-300 cursor-pointer">
                            <input type="radio" name="admin_role" value="main" {{ $user->isMainAdmin() ? 'checked' : ''
                            }}
                            class="h-4 w-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                            <span class="mr-2 text-sm text-gray-700">أدمن</span>
                        </label>
                        <label
                            class="flex items-center p-3 bg-white rounded-lg border @error('admin_role') border-red-500 @else border-gray-200 @enderror hover:border-purple-300 cursor-pointer">
                            <input type="radio" name="admin_role" value="sub" {{ $user->isSubAdmin() ? 'checked' : '' }}
                            class="h-4 w-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                            <span class="mr-2 text-sm text-gray-700">مشرف</span>
                        </label>
                    </div>
                    @error('admin_role')
                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                @endif
            </div>
            <div class="pt-6 flex justify-end gap-3">
                <a href="{{ route('admin.admins.index') }}"
                    class="px-6 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-all">
                    إلغاء
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
</div>
@endsection