<x-guest-layout>
    <div class="w-full max-w-md space-y-8">
        <div class="bg-white rounded-2xl p-6 shadow-md text-center">
            <div class="mb-6">
                <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-purple-900 mb-2">تم تفعيل حسابك بنجاح!</h2>
            <p class="text-gray-600 mb-6">يمكنك الآن الاستفادة من جميع خدمات الموقع</p>

            <x-primary-button class="w-full justify-center bg-[#d4b341] hover:bg-yellow-700"
                onclick="window.location.href='{{ route('index') }}'">
                {{ __('الذهاب إلى الصفحة الرئيسية') }}
            </x-primary-button>
        </div>
    </div>
</x-guest-layout>