@props([
    'label' => null,
    'type' => 'text',
    'name' => null,
    'placeholder' => '',
    'value' => '',
    'required' => false
])

<div class="w-full">
    <!-- label -->
    @if($label)
        <label
            for="{{ $name }}"
            class="block text-sm font-semibold text-gray-700 mb-2"
        >
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <!-- input -->
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => '
                w-full px-4 py-3 rounded-xl
                border border-gray-200
                bg-white
                text-sm text-gray-800
                placeholder-gray-400
                focus:outline-none
                focus:ring-2 focus:ring-primary-3/40
                focus:border-primary-3
                transition
            '
        ]) }}
    >

    <!-- error -->
    @error($name)
        <p class="mt-2 text-xs text-red-500 font-medium">
            {{ $message }}
        </p>
    @enderror
</div>
