@props(['name', 'label' => null, 'options', 'checked', 'error' => null])

<div class="bg-purple-50 p-4 rounded-xl">
    <label class="block text-sm font-medium text-purple-600 mb-2">{{ $label }}</label>
    <div class="flex items-center space-x-4 mb-2 gap-4">
        @foreach($options as $value => $text)
        <label class="flex items-center">
            <input type="radio" name="{{ $name }}" value="{{ $value }}" {{ $checked==$value ? 'checked' : '' }}
                class="form-radio text-purple-600">
            <span class="mr-2">{{ $text }}</span>
        </label>
        @endforeach
    </div>
    {{ $slot }}
    @if($error)
    <div class="mt-1 text-red-600 text-sm flex items-center">
        <i class="fas fa-exclamation-circle ml-1"></i>{{ $error }}
    </div>
    @endif
</div>