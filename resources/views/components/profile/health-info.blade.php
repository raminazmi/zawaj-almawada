<div class="space-y-6">
    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
        <i class="fas fa-medkit text-purple-600 mr-2"></i>
        المعلومات الصحية
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-profile.textarea-field name="health_status" label="الحالة الصحية"
            :value="old('health_status', $user->health_status)" icon="comment-medical"
            :error="$errors->first('health_status')" />

        <x-profile.textarea-field name="genetic_diseases" label="الأمراض الوراثية"
            :value="old('genetic_diseases', $user->genetic_diseases)" icon="dna"
            :error="$errors->first('genetic_diseases')" />

        <x-profile.textarea-field name="infectious_diseases" label="الأمراض المعدية"
            :value="old('infectious_diseases', $user->infectious_diseases)" icon="biohazard"
            :error="$errors->first('infectious_diseases')" />

        <x-profile.textarea-field name="psychological_disorders" label="الأمراض النفسية"
            :value="old('psychological_disorders', $user->psychological_disorders)" icon="head-side-virus"
            :error="$errors->first('psychological_disorders')" />

        <x-profile.radio-group name="has_disability" label="هل لديك إعاقة؟" :options="['1' => 'نعم', '0' => 'لا']"
            :checked="old('has_disability', $user->has_disability)" :error="$errors->first('has_disability')">
            <x-profile.input-field name="disability_details"
                :value="old('disability_details', $user->disability_details)" icon="info-circle"
                :error="$errors->first('disability_details')" />
        </x-profile.radio-group>

        <x-profile.radio-group name="has_deformity" label="هل لديك تشوهات؟" :options="['1' => 'نعم', '0' => 'لا']"
            :checked="old('has_deformity', $user->has_deformity)" :error="$errors->first('has_deformity')">
            <x-profile.input-field name="deformity_details" :value="old('deformity_details', $user->deformity_details)"
                icon="exclamation-triangle" :error="$errors->first('deformity_details')" />
        </x-profile.radio-group>

        <x-profile.radio-group name="wants_children" label="هل ترغب في الإنجاب؟" :options="['1' => 'نعم', '0' => 'لا']"
            :checked="old('wants_children', $user->wants_children)" :error="$errors->first('wants_children')" />

        <x-profile.radio-group name="infertility" label="هل تعاني من عقم؟" :options="['1' => 'نعم', '0' => 'لا']"
            :checked="old('infertility', $user->infertility)" :error="$errors->first('infertility')" />

        @if(Auth::user()->gender === 'male')
        <x-profile.radio-group name="is_smoker" label="هل تدخن؟" :options="['1' => 'نعم', '0' => 'لا']"
            :checked="old('is_smoker', $user->is_smoker)" :error="$errors->first('is_smoker')" />
        @endif
    </div>
</div>