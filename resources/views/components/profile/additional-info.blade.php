<div class="space-y-6">
    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
        <i class="fas fa-comment-dots text-purple-600 mr-2"></i>
        معلومات إضافية
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-profile.textarea-field name="personal_description" label="وصف شخصي"
            :value="old('personal_description', $user->personal_description)"
            placeholder="اذكر هواياتك اهتماماتك مهاراتك وصفاتك وطباعك وعاداتك والاشياء التي تضايقك، طموحك المستقبلي، أهدافك من الزواج، كيف تصف نفسك"
            icon="pen" rows="4" class="md:col-span-2" :error="$errors->first('personal_description')" />

        <x-profile.textarea-field name="partner_expectations" label="مواصفات الشريك المطلوب"
            :value="old('partner_expectations', $user->partner_expectations)"
            placeholder="(العمر، المنطقة، وضعها الاجتماعي(عزباء، مطلقة، أرملة)اللبس، مواصفات الجمال، درجة تدينها، مستواها التعليمي، تعمل أو لا، مكان عملها، الفكر والتوجه الفكري والثقافي، الصفات التي ترغب والتي لا ترغب أن تكون بها، الامور التي ستمنع أن تكون بها أو تقوم بها)"
            icon="search" rows="4" class="md:col-span-2" :error="$errors->first('partner_expectations')" />
    </div>
</div>