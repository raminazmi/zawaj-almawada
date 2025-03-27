<div class="space-y-6">
    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
        <i class="fas fa-user-graduate text-purple-600 mr-2"></i>
        التعليم والعمل
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-profile.select-field name="education_level" label="المستوى التعليمي" :options="[
                'illiterate' => 'أمي',
                'general' => 'تعليم عام',
                'diploma' => 'دبلوم جامعي',
                'bachelor' => 'مؤهل جامعي',
                'master' => 'ماجستير',
                'phd' => 'دكتوراه'
            ]" :selected="old('education_level', $user->education_level)" icon="university"
            :error="$errors->first('education_level')" />

        <x-profile.select-field name="work_sector" label="مكان العمل" :options="[
                'government' => 'قطاع حكومي',
                'private' => 'قطاع خاص',
                'self_employed' => 'أعمال حرة',
                'unemployed' => 'باحث عن عمل'
            ]" :selected="old('work_sector', $user->work_sector)" icon="briefcase"
            :error="$errors->first('work_sector')" />

        <x-profile.input-field name="job_title" label="المسمى الوظيفي" value="{{ old('job_title', $user->job_title) }}"
            icon="id-badge" :error="$errors->first('job_title')" />

        <x-profile.input-field name="monthly_income" label="الدخل الشهري (ريال)" type="number"
            value="{{ old('monthly_income', $user->monthly_income) }}" icon="money-bill-wave"
            :error="$errors->first('monthly_income')" />

        <x-profile.select-field name="religion" label="الدين" :options="[
                'Islam' => 'الإسلام',
                'Christianity' => 'المسيحية'
            ]" :selected="old('religion', $user->religion)" icon="mosque" :error="$errors->first('religion')" />

        <x-profile.select-field name="housing_type" label="نوع السكن" :options="[
                'independent' => 'سكن مستقل',
                'family_annex' => 'ملحق عائلي',
                'family_room' => 'غرفة في منزل العائلة',
                'no_preference' => 'لا يوجد تفضيل'
            ]" :selected="old('housing_type', $user->housing_type)" icon="door-open"
            :error="$errors->first('housing_type')" />

        <x-profile.select-field name="religiosity_level" label="مستوى التدين" :options="[
                'high' => 'عالي',
                'medium' => 'متوسط',
                'low' => 'منخفض'
            ]" :selected="old('religiosity_level', $user->religiosity_level)" icon="star-and-crescent"
            :error="$errors->first('religiosity_level')" />

        <x-profile.select-field name="prayer_commitment" label="التزام الصلاة" :options="[
                'yes' => 'ملتزم',
                'sometimes' => 'أحيانًا',
                'no' => 'غير ملتزم'
            ]" :selected="old('prayer_commitment', $user->prayer_commitment)" icon="clock"
            :error="$errors->first('prayer_commitment')" />
    </div>
</div>