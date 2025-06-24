<x-guest-layout>
    <div class="w-full max-w-md space-y-8">
        <div class="bg-white p-2 pt-0 rounded-2xl">
            <h2 class="text-center text-2xl font-bold text-purple-900 mb-8">
                استعادة كلمة المرور
            </h2>
            <p class="mb-6 text-sm text-gray-600 text-center">
                {{ __('نسيت كلمة المرور؟ لا مشكلة. فقط أدخل بريدك الإلكتروني وسنرسل لك رابط إعادة تعيين كلمة المرور
                لتتمكن من اختيار كلمة مرور جديدة.') }}
            </p>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf
                <div>
                    <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-purple-900" />
                    <x-text-input id="email"
                        class="mt-1 block w-full rounded-xl border-purple-100 focus:border-purple-500 focus:ring-purple-500"
                        type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <x-primary-button
                    class="w-full justify-center bg-[#d4b341] hover:bg-yellow-700 focus:ring-purple-500 rounded-xl py-3">
                    {{ __('إرسال رابط إعادة تعيين كلمة المرور') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>