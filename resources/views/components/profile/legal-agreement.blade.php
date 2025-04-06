<div class="col-span-1 md:col-span-2">
    <div class="bg-white border-2 border-purple-100 rounded-lg p-4 shadow-sm">
        <div class="flex items-start">
            <input type="checkbox" id="legalAgreement" name="legalAgreement" x-model="agreed"
                class="mt-1 rounded border-purple-300 text-purple-600 focus:ring-purple-500" required>
            <label for="legalAgreement" class="mr-3 block text-sm text-gray-700">
                <span class="font-medium text-purple-800">إقرار قانوني:</span>
                <span class="block mt-1 text-justify">
                    أقر أنا {{ $user->name }} المسجل في برنامج الزواج الشرعي بأن عمري أكبر من 18 سنة، وأن ما أدليت به من
                    معلومات صحيحة
                    وكاملة، وأتحمل المسؤولية القانونية كاملة عن صحة هذه البيانات. وأعفي منصة الزواج
                    الشرعي من أي مسؤولية
                    قانونية تنتج عن عدم مصداقية المعلومات المقدمة أو أي اعتراض من الأهل أو الجهات
                    المختصة.
                </span>
            </label>
        </div>
        <div x-show="!agreed" x-transition class="mt-2 flex items-center text-red-500 text-xs">
            <i class="fas fa-exclamation-circle ml-1"></i>
            <span>يجب الموافقة على الإقرار القانوني للمتابعة</span>
        </div>
    </div>
</div>