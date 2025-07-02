<x-guest-layout>
    <div class="w-full max-w-md space-y-8">
        <div class="bg-white rounded-2xl p-2 pt-0">
            <h2 class="text-center text-2xl font-bold text-purple-900 mb-8">
                تسجيل طلب عضوية
            </h2>

            <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-6"
                x-data="{ gender: '{{ old('gender') }}', enabled: {{ old('show_profile', true) ? 'true' : 'false' }} }">
                @csrf
                <input type="hidden" name="recaptcha_token" id="recaptchaToken">
                <div>
                    <div class="flex items-center gap-1">
                        <x-input-label for="name" :value="__('الاسم المستعار')" class="text-purple-900" />
                        <span class="text-red-500">*</span>
                    </div>
                    <x-text-input id="name" name="name" type="text"
                        class="mt-1 block w-full rounded-xl border-purple-100 focus:border-purple-500 focus:ring-purple-500"
                        :value="old('name')" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <div class="flex items-center gap-1">
                        <x-input-label :value="__('الجنس')" class="text-purple-900" />
                        <span class="text-red-500">*</span>
                    </div>
                    <div class="mt-1 flex gap-4">
                        <label class="flex items-center">
                            <input type="radio" name="gender" value="male" id="gender-male"
                                class="gender-radio text-purple-600 focus:ring-purple-500" x-model="gender">
                            <span class="mr-2 text-purple-600">أنا شاب</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="gender" value="female" id="gender-female"
                                class="gender-radio text-purple-600 focus:ring-purple-500" x-model="gender">
                            <span class="mr-2 text-purple-600">أنا فتاة</span>
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>

                <div class="p-4 border border-purple-100 rounded-lg mb-2" x-show="gender === 'female'">
                    <h3 class="text-base font-semibold text-gray-800 mb-2 flex items-center">
                        <i class="fas fa-eye ml-2"></i>
                        إعدادات الظهور
                    </h3>
                    <div class="flex items-center justify-between mb-2">
                        <label for="show_profile" class="font-medium text-gray-700">إظهار ملفي الشخصي للآخرين</label>
                        <div>
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
                    <p class="text-sm text-gray-600 mt-2">
                        يمكنك إظهار أو إخفاء ملفك الشخصي عن باقي المستخدمين في المنصة. إذا قمت بالإخفاء، لن يظهر ملفك في
                        نتائج البحث أو الاقتراحات.
                    </p>
                </div>
                <input type="hidden" name="show_profile" x-show="gender !== 'female'" value="0">

                <div>
                    <div class="flex items-center gap-1">
                        <x-input-label for="country" :value="__('الدولة')" class="text-purple-900" />
                        <span class="text-red-500">*</span>
                    </div>
                    <x-text-input id="country" name="country" type="text"
                        class="mt-1 block w-full rounded-xl border-purple-100 focus:border-purple-500 focus:ring-purple-500"
                        :value="old('country')" />
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>

                <div>
                    <div class="flex items-center gap-1">
                        <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-purple-900" />
                        <span class="text-red-500">*</span>
                    </div>
                    <x-text-input id="email" name="email" type="email"
                        class="mt-1 block w-full rounded-xl border-purple-100 focus:border-purple-500 focus:ring-purple-500"
                        :value="old('email')" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <div class="flex items-center gap-1">
                        <x-input-label for="phone" :value="__('رقم الهاتف')" class="text-purple-900" />
                        <span class="text-red-500">*</span>
                    </div>
                    <x-text-input id="phone" name="phone" type="tel"
                        class="mt-1 block w-full rounded-xl border-purple-100 focus:border-purple-500 focus:ring-purple-500"
                        :value="old('phone')" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div>
                    <div class="flex items-center gap-1">
                        <x-input-label for="password" :value="__('كلمة المرور')" class="text-purple-900" />
                        <span class="text-red-500">*</span>
                    </div>

                    <x-text-input id="password" name="password" type="password"
                        class="mt-1 block w-full rounded-xl border-purple-100 focus:border-purple-500 focus:ring-purple-500" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <div class="flex items-center gap-1">
                        <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')"
                            class="text-purple-900" />
                        <span class="text-red-500">*</span>
                    </div>

                    <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                        class="mt-1 block w-full rounded-xl border-purple-100 focus:border-purple-500 focus:ring-purple-500" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <x-primary-button id="registerButton"
                    class="w-full justify-center bg-[#d4b341] hover:bg-yellow-700 focus:ring-purple-500 rounded-xl py-3">
                    {{ __('إنشاء حساب') }}
                </x-primary-button>

                <div class="text-center text-sm text-purple-600">
                    لديك عضوية بالفعل؟
                    <a href="{{ route('login') }}" class="font-semibold hover:text-purple-800">
                        سجل الدخول
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js?render=6LcGfxorAAAAANWWrRaHrvRUM59RRXrbtl1QqHYt"></script>
    <script>
        grecaptcha.ready(function() {
                    grecaptcha.execute('6LcGfxorAAAAANWWrRaHrvRUM59RRXrbtl1QqHYt', { action: 'register' }).then(function(token) {
                        document.getElementById('recaptchaToken').value = token;
                    });
                });
    </script>
</x-guest-layout>