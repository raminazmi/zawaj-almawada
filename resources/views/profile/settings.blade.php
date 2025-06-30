@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white shadow-lg rounded-xl p-6">
            <h2 class="text-2xl font-bold text-purple-600 mb-6">
                <i class="fas fa-cog ml-2"></i>إعدادات الملف الشخصي
            </h2>

            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-md">
                {{ session('status') }}
            </div>
            @endif

            <form method="post" action="{{ route('profile.settings.update') }}" class="space-y-8">
                @csrf

                <!-- Show Profile Section -->
                <div class="p-6 border border-purple-100 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">إعدادات الظهور</h3>
                    <div class="flex items-center justify-between">
                        <label for="show_profile" class="font-medium text-gray-700">إظهار ملفي الشخصي للآخرين</label>
                        <div x-data="{ enabled: {{ old('show_profile', $user->show_profile) ? 'true' : 'false' }} }">
                            <input type="hidden" name="show_profile" :value="enabled ? '1' : '0'">
                            <button @click="enabled = !enabled" type="button"
                                class="relative inline-flex flex-shrink-0 h-[26px] w-[48px] border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                                :class="enabled ? 'bg-purple-600' : 'bg-gray-200'">
                                <span aria-hidden="true"
                                    class="pointer-events-none inline-block h-[20px] w-[20px] mt-[1.5px] rounded-full bg-white shadow-lg transform ring-0 transition ease-in-out duration-200"
                                    :class="{ '-translate-x-6': enabled, 'translate-x-0': !enabled }"></span>
                            </button>
                        </div>
                    </div>
                    @error('show_profile')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Update Password Section -->
                <div class="p-6 border border-purple-100 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">تغيير كلمة المرور</h3>
                    @include('profile.partials.update-password-fields')
                </div>

                <div class="flex items-center justify-start mt-6">
                    <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all flex items-center gap-2 shadow-md hover:shadow-lg transform hover:scale-105">
                        <i class="fas fa-save"></i>
                        حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection