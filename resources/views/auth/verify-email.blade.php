<x-guest-layout>
    <div class="w-full max-w-md space-y-8">
        <div class="rounded-2xl p-4 pt-2 ">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-purple-900 mb-2">تفعيل الحساب</h2>
                <p class="text-gray-600 mb-6">لقد أرسلنا كود التحقق إلى بريدك الإلكتروني</p>

                @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="text-red-600 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-600">
                    {{ session('success') }}
                </div>
                @endif

                <div class="mb-6">
                    <div class="flex justify-center gap-2 mb-6" dir="rtl">
                        @for ($i = 0; $i < 4; $i++) <input type="text" inputmode="numeric" pattern="[0-9]*"
                            name="digit-{{ $i }}" id="digit-{{ $i }}" maxlength="1"
                            class="w-16 h-16 border-2 border-purple-200 rounded-lg text-2xl font-bold text-center digit-input"
                            oninput="moveToNext(this, {{ $i }})" onkeydown="handleBackspace(this, {{ $i }})"
                            style="direction: rtl;">
                            @endfor
                    </div>

                    <form method="POST" action="{{ route('verification.verify') }}" id="verificationForm">
                        @csrf
                        <input type="hidden" name="code" id="code-input">

                        <x-primary-button type="submit" class="w-full justify-center bg-[#d4b341] hover:bg-yellow-700">
                            {{ __('تفعيل الحساب') }}
                        </x-primary-button>
                    </form>
                </div>

                <div class="text-sm text-gray-500 my-3">
                    <div class="flex items-center gap-2 bg-purple-50 p-3 rounded-lg border border-purple-200">
                        <i class="fas fa-info-circle text-purple-600"></i>
                        <span class="text-purple-800">
                            إذا لم تجد الرسالة في صندوق الوارد، رجاءً تحقق من مجلد
                            <span class="font-semibold">الرسائل غير المرغوب فيها (Spam)</span>
                        </span>
                    </div>
                </div>

                <div class="text-sm text-gray-500">
                    لم تستلم الكود؟
                    <form method="POST" action="{{ route('verification.resend') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-purple-600 hover:text-purple-800 font-medium">
                            إعادة إرسال
                            <i class="fas fa-spinner fa-spin hidden resend-spinner"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('digit-3').focus();
            document.querySelectorAll('.digit-input').forEach(input => {
                input.addEventListener('input', updateHiddenCode);
            });
        });

        function moveToNext(currentInput, index) {
            if (/^[0-9]$/.test(currentInput.value)) {
                if (index > 0) {
                    document.getElementById(`digit-${index - 1}`).focus();
                }
                updateHiddenCode();
            } else {
                currentInput.value = '';
            }
        }

        function handleBackspace(currentInput, index) {
            if (event.key === 'Backspace' && currentInput.value === '' && index < 3) {
                document.getElementById(`digit-${index + 1}`).focus();
            }
            updateHiddenCode();
        }

        function updateHiddenCode() {
            let code = '';
            for (let i = 3; i >= 0; i--) {
                code += document.getElementById(`digit-${i}`).value;
            }
            document.getElementById('code-input').value = code;
            if (code.length === 4) {
                document.getElementById('verificationForm').submit();
            }
            if (code.length === 4) {
                const btn = document.querySelector('#verificationForm button[type="submit"]');
                btn.disabled = true;
                btn.innerHTML = 'جاري التفعيل... <i class="fas fa-spinner fa-spin"></i>';
                document.getElementById('verificationForm').submit();
            }
        }

        document.querySelector('form[action="{{ route('verification.resend') }}"]').addEventListener('submit', function(e) {
            this.querySelector('.resend-spinner').classList.remove('hidden');
            this.querySelector('button').disabled = true;
        });

    </script>
</x-guest-layout>