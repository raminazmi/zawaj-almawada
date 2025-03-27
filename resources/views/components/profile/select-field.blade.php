@props(['name', 'label' => null, 'options', 'selected', 'icon', 'error' => null])

<div class="relative">
    <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
    <div class="relative">
        <select name="{{ $name }}"
            class="w-full p-3 pl-10 pr-8 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error($name) border-red-500 @enderror"
            {{ $attributes }}>
            @foreach($options as $value => $text)
            <option value="{{ $value }}" {{ $selected==$value ? 'selected' : '' }}>{{ $text }}</option>
            @endforeach
        </select>
        <i class="fas fa-{{ $icon }} absolute left-3 top-4 text-gray-400"></i>
    </div>
    @if($error)
    <div class="mt-1 text-red-600 text-sm flex items-center">
        <i class="fas fa-exclamation-circle ml-1"></i>{{ $error }}
    </div>
    @endif
</div>