<div class="space-y-6">
    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
        <i class="fas fa-id-card text-purple-600 mr-2"></i>
        المعلومات الأساسية
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="col-span-1 md:col-span-2">
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 flex items-center text-sm text-purple-700">
                <i class="fas fa-lock text-purple-500 ml-2"></i>
                <span>معلوماتك الخاصة (الاسم كاملا ، القرية ، الولاية ، القبيلة) آمنة ومحمية، لن تظهر لأحد إلا بعد
                    اكتمال
                    الخطوبة بنجاح. يرجى
                    كتابة
                    البيانات بطريقة صحيحة.</span>
            </div>
        </div>
        <x-profile.input-field name="full_name" label="الاسم كاملا" value="{{ old('full_name', $user->full_name) }}"
            icon="user" :error="$errors->first('full_name')" />
        <x-profile.input-field name="village" label="القرية" value="{{ old('village', $user->village) }}" icon="home"
            :error="$errors->first('village')" />
        <x-profile.input-field name="state" label="الولاية" value="{{ old('state', $user->state) }}" icon="globe-asia"
            :error="$errors->first('state')" />
        <x-profile.input-field name="tribe" label="القبيلة" value="{{ old('tribe', $user->tribe) }}" icon="flag"
            :error="$errors->first('tribe')" />
        <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-2">النسب</label>
            <div class="relative">
                <select name="lineage"
                    class="w-full p-3 pl-10 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('lineage') border-red-500 @enderror">
                    <option value="1" {{ old('lineage', $user->lineage) == '1' ? 'selected' : '' }}>1</option>
                    <option value="2" {{ old('lineage', $user->lineage) == '2' ? 'selected' : '' }}>2</option>
                    <option value="3" {{ old('lineage', $user->lineage) == '3' ? 'selected' : '' }}>3</option>
                </select>
                <i class="fas fa-project-diagram absolute left-3 top-4 text-gray-400"></i>
            </div>
            @error('lineage')
            <div class="mt-1 text-red-600 text-sm flex items-center">
                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>