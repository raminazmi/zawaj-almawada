@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="flex justify-center">
            <div class="bg-white shadow-lg rounded-xl p-4 py-3 w-fit flex justify-center">
                <h2 class="text-lg font-bold text-purple-600 flex justify-start items-center gap-2">
                    <i class="fas fa-cog"></i>
                    <p>إعدادات الملف الشخصي</p>
                </h2>
            </div>
        </div>
        @if($user->gender === 'female')
        <div class="bg-white shadow-lg rounded-xl p-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-eye ml-2"></i>
                إعدادات الظهور
            </h3>
            <div class="flex items-center justify-between">
                <label for="show_profile" class="font-medium text-gray-700">إظهار ملفي الشخصي للآخرين</label>
                <div x-data="{ enabled: {{ $user->show_profile ? 'true' : 'false' }}, success: false }">
                    <input type="hidden" name="show_profile" :value="enabled ? '1' : '0'">
                    <template x-if="success">
                        <span class="ml-3 text-green-600 text-sm">تم الحفظ بنجاح</span>
                    </template>
                    <button type="button" @click="
                                            enabled = !enabled;
                                            fetch('{{ route('profile.settings.show_profile') }}', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                    'Accept': 'application/json',
                                                },
                                                body: JSON.stringify({ show_profile: enabled ? 1 : 0 })
                                            }).then(response => {
                                                if (response.ok) {
                                                    success = true;
                                                    setTimeout(() => success = false, 2000);
                                                }
                                            });
                                        "
                        class="relative inline-flex flex-shrink-0 h-[26px] w-[48px] border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                        :class="enabled ? 'bg-purple-600' : 'bg-gray-200'">
                        <span aria-hidden="true"
                            class="pointer-events-none inline-block h-[20px] w-[20px] mt-[1.5px] rounded-full bg-white shadow-lg transform ring-0 transition ease-in-out duration-200"
                            :class="{ '-translate-x-6': enabled, 'translate-x-0': !enabled }"></span>
                    </button>
                </div>
            </div>
            <p class="text-sm text-gray-600 mt-2">
                يمكنك إظهار أو إخفاء ملفك الشخصي عن باقي المستخدمين في المنصة. إذا قمت بالإخفاء، لن يظهر ملفك في نتائج
                البحث أو الاقتراحات.
            </p>
        </div>
        @endif
        <div class="bg-white shadow-lg rounded-xl p-6">
            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-md">
                {{ session('status') }}
            </div>
            @endif

            <form method="post" action="{{ route('profile.settings.update') }}" class="space-y-8">
                @csrf

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
        <div class="bg-white shadow-lg rounded-xl p-6">
            <div class="p-6 border border-red-200 rounded-lg bg-red-50">
                <h3 class="text-lg font-semibold text-red-700 mb-4 flex items-center">
                    <i class="fas fa-trash-alt ml-2"></i>
                    حذف الحساب
                </h3>
                <p class="text-sm text-red-700 mb-4">
                    ان حذف حسابك سيؤدي الى فقدان جميع البيانات المرتبطة بالحساب ولن يمكن الرجوع اليها لاحقا.<br>
                    في حال اذا رغبتم بحذف الحساب يرجى الاستمرار عبر الرابط التالي.
                </p>
                <a href="{{ route('profile.delete.confirm') }}"
                    class="inline-flex items-center px-5 py-2 bg-gradient-to-r from-red-600 to-red-400 text-white rounded-lg hover:from-red-700 hover:to-red-500 transition-all gap-2 shadow-md hover:shadow-lg transform hover:scale-105">
                    <i class="fas fa-user-slash"></i>
                    حذف الحساب نهائياً
                </a>
            </div>
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