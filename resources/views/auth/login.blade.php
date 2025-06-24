<x-guest-layout>
    <div class="w-full max-w-md space-y-8">
        {{-- Google Login --}}
        {{-- <div class="text-center">
            <a href="{{ route('auth.google') }}"
                class="inline-flex items-center justify-center gap-2 w-full px-6 py-3 border-2 border-purple-100 rounded-xl text-purple-900 bg-white hover:bg-purple-50 transition-all duration-300 shadow-sm">
                <img src="{{ asset('assets/images/google.png') }}" class="w-6 h-6 mr-3" alt="Google">
                تسجيل الدخول بواسطة جوجل
            </a>
        </div> --}}

        {{-- Separator --}}
        {{-- <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-purple-100"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-purple-500">أو</span>
            </div>
        </div> --}}

        {{-- Login Form --}}
        <div class="bg-white p-2 pt-0 rounded-2xl">
            <h2 class="text-center text-2xl font-bold text-purple-900 mb-8">
                تسجيل دخول
            </h2>
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-purple-900" />
                    <x-text-input id="email" name="email" type="email"
                        class="mt-1 block w-full rounded-xl border-purple-100 focus:border-purple-500 focus:ring-purple-500"
                        :value="old('email')" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('كلمة المرور')" class="text-purple-900" />
                    <x-text-input id="password" name="password" type="password"
                        class="mt-1 block w-full rounded-xl border-purple-100 focus:border-purple-500 focus:ring-purple-500" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="rounded border-purple-300 text-purple-600 shadow-sm focus:ring-purple-500">
                        <span class="mr-2 text-sm text-purple-600">تذكرني</span>
                    </label>

                    <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:text-purple-800">
                        هل نسيت كلمة المرور؟
                    </a>
                </div>

                <x-primary-button
                    class="w-full justify-center bg-[#d4b341] hover:bg-yellow-700 focus:ring-purple-500 rounded-xl py-3">
                    {{ __('تسجيل الدخول') }}
                </x-primary-button>

                <div class="text-center text-sm text-purple-600">
                    ليس لديك عضوية؟
                    <a href="{{ route('register') }}" class="font-semibold hover:text-purple-800">
                        سجل الآن
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>