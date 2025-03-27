<div class="space-y-6">
    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
        <i class="fas fa-user-friends text-purple-600 mr-2"></i>
        الحالة الاجتماعية
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-2">الحالة الاجتماعية</label>
            <div class="relative">
                <select name="marital_status"
                    class="w-full p-3 pl-10 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('marital_status') border-red-500 @enderror">
                    @if(Auth::user()->gender === 'male')
                    <option value="single" {{ old('marital_status', $user->marital_status) == 'single' ? 'selected' : ''
                        }}>أعزب</option>
                    <option value="married" {{ old('marital_status', $user->marital_status) == 'married' ? 'selected' :
                        '' }}>متزوج</option>
                    <option value="widowed" {{ old('marital_status', $user->marital_status) == 'widowed' ? 'selected' :
                        '' }}>أرمل</option>
                    <option value="divorced" {{ old('marital_status', $user->marital_status) == 'divorced' ? 'selected'
                        : '' }}>مطلق</option>
                    @else
                    <option value="single" {{ old('marital_status', $user->marital_status) == 'single' ? 'selected' : ''
                        }}>عزباء</option>
                    <option value="widowed" {{ old('marital_status', $user->marital_status) == 'widowed' ? 'selected' :
                        '' }}>أرملة</option>
                    <option value="divorced" {{ old('marital_status', $user->marital_status) == 'divorced' ? 'selected'
                        : '' }}>مطلقة</option>
                    @endif
                </select>
                <i class="fas fa-heart absolute left-3 top-4 text-gray-400"></i>
            </div>
            @error('marital_status')
            <div class="mt-1 text-red-600 text-sm flex items-center">
                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
            </div>
            @enderror
        </div>

        <div class="bg-purple-50 p-4 rounded-xl">
            <label class="block text-sm font-medium text-purple-600 mb-2">هل لديك أبناء؟</label>
            <div class="flex items-center space-x-4 mb-2 gap-4">
                <label class="flex items-center">
                    <input type="radio" name="has_children" value="1" {{ old('has_children', $user->has_children) == 1
                    ?
                    'checked' : '' }}
                    class="form-radio text-purple-600">
                    <span class="mr-2">نعم</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="has_children" value="0" {{ old('has_children', $user->has_children) == 0
                    ? 'checked' : '' }}
                    class="form-radio text-purple-600">
                    <span class="mr-2">لا</span>
                </label>
            </div>
            <div class="relative">
                <input type="number" name="children_count" value="{{ old('children_count', $user->children_count) }}"
                    class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('children_count') border-red-500 @enderror">
                <i class="fas fa-child absolute left-3 top-4 text-gray-400"></i>
            </div>
            @error('children_count')
            <div class="mt-1 text-red-600 text-sm flex items-center">
                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
            </div>
            @enderror
            @error('has_children')
            <div class="mt-1 text-red-600 text-sm flex items-center">
                <i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>