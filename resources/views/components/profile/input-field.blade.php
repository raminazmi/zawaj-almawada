@props(['name', 'label' => null, 'value', 'icon', 'type' => 'text', 'error' => null, 'important' => false])

<div class="relative">
    @if($label)
    <label class="block text-sm font-medium text-gray-700 mb-2">
        {{ $label }}
        @if($important)
        <span class="text-red-600 ml-1">*</span>
        @endif
    </label>
    @endif
    <div class="relative">
        <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}"
            class="w-full p-3 pl-10 rounded-lg border-2 @if($important) border-purple-300 bg-purple-50 @else border-gray-200 @endif focus:ring-2 focus:ring-purple-500 @error($name) border-red-500 @enderror"
            {{ $attributes }}>
        <i
            class="fas fa-{{ $icon }} absolute left-3 top-4 @if($important) text-purple-600 @else text-gray-400 @endif"></i>
    </div>
    @if($error)
    <div class="mt-1 text-red-600 text-sm flex items-center">
        <i class="fas fa-exclamation-circle ml-1"></i>{{ $error }}
    </div>
    @endif
</div>