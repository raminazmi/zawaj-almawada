<div class="col-span-1 md:col-span-2">
    <div class="bg-white border-2 border-purple-100 rounded-lg p-4 shadow-sm">
        <div class="flex items-start">
            <input type="checkbox" id="familyConsent" name="family_consent" x-model="familyConsent"
                class="mt-1 rounded border-purple-300 text-purple-600 focus:ring-purple-500" required>
            <label for="familyConsent" class="mr-3 block text-sm text-gray-700">
                <span class="font-medium text-purple-800">موافقة الأسرة:</span>
                <span class="block mt-1 text-justify">
                    مشاركة بياناتي كفتاة في برنامج الزواج الشرعي تمت بموافقة وتوجيه من ولي أمري أو أحد أفراد أسرتي
                </span>
            </label>
        </div>
        <div x-show="!familyConsent" x-transition class="mt-2 flex items-center text-red-500 text-xs">
            <i class="fas fa-exclamation-circle ml-1"></i>
            <span>يجب الموافقة على مشاركة البيانات بموافقة الأسرة للمتابعة</span>
        </div>
    </div>
</div>