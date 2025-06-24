<x-guest-layout>
    <div class="w-full max-w-md space-y-8">
        <div class="bg-white p-2 pt-0 rounded-2xl">
            <h2 class="text-center text-2xl font-bold text-purple-900 mb-8">
                إعادة تعيين كلمة المرور
            </h2>
            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-purple-900" />
                    <x-text-input id="email"
                        class="mt-1 block w-full rounded-xl border-purple-100 focus:border-purple-500 focus:ring-purple-500"
                        type="email" name="email" :value="old('email', $request->email)" required autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('كلمة المرور الجديدة')" class="text-purple-900" />
                    <x-text-input id="password"
                        class="mt-1 block w-full rounded-xl border-purple-100 focus:border-purple-500 focus:ring-purple-500"
                        type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور الجديدة')"
                        class="text-purple-900" />
                    <x-text-input id="password_confirmation"
                        class="mt-1 block w-full rounded-xl border-purple-100 focus:border-purple-500 focus:ring-purple-500"
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <x-primary-button
                    class="w-full justify-center bg-[#d4b341] hover:bg-yellow-700 focus:ring-purple-500 rounded-xl py-3">
                    {{ __('إعادة تعيين كلمة المرور') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>