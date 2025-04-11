<div class="space-y-6">
    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
        <i class="fas fa-comment-dots text-purple-600 mr-2"></i>
        معلومات إضافية
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2 space-y-2">
            <div class="flex items-center gap-2 bg-purple-50 p-4 rounded-lg border border-purple-100">
                <div class="shrink-0 text-purple-600">
                    <i class="fas fa-info-circle"></i>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed">
                    اذكر في هذا القسم: هواياتك، اهتماماتك، مهاراتك، صفاتك وطباعك، العادات، الأشياء التي تضايقك، طموحك
                    المستقبلي، أهدافك من الزواج، كيف تصف نفسك
                </p>
            </div>
            <x-profile.textarea-field name="personal_description" label="الوصف الشخصي"
                :value="old('personal_description', $user->personal_description)"
                placeholder="ابدأ بكتابة وصفك الشخصي هنا..." icon="pen" rows="4"
                :error="$errors->first('personal_description')" />
        </div>

        <div class="md:col-span-2 space-y-2">
            <div class="flex items-center gap-2 bg-pink-50 p-4 rounded-lg border border-pink-100">
                <div class="shrink-0 text-pink-600">
                    <i class="fas fa-heart"></i>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed">
                    حدد المواصفات المطلوبة: (العمر، المنطقة، الوضع الاجتماعي، اللباس، الجمال، التدين، المستوى التعليمي،
                    العمل، الفكر والثقافة، الصفات المرغوبة وغير المرغوبة، الموانع)
                </p>
            </div>
            <x-profile.textarea-field name="partner_expectations" label="مواصفات الشريك"
                :value="old('partner_expectations', $user->partner_expectations)"
                placeholder="اكتب المواصفات المطلوبة هنا..." icon="search" rows="4"
                :error="$errors->first('partner_expectations')" />
        </div>
    </div>
</div>