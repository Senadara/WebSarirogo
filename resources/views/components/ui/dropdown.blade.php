@props([
    'label' => null,
    'name' => null,
    'options' => [],
    'selected' => null,
    'required' => false,
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

    <!-- select option -->
    <div class="relative">
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $attributes->merge([
                'class' => '
                    w-full px-4 py-3 pr-10 rounded-xl
                    border border-gray-200
                    bg-white
                    text-sm text-gray-800
                    focus:outline-none
                    focus:ring-2 focus:ring-primary-3/40
                    focus:border-primary-3
                    transition
                    appearance-none
                '
            ]) }}
        >
            <option value="" disabled {{ old($name, $selected) ? '' : 'selected' }}>
                Pilih fase ayam
            </option>

            @foreach ($options as $value => $labelOption)
                <option
                    value="{{ $value }}"
                    {{ old($name, $selected) == $value ? 'selected' : '' }}
                >
                    {{ $labelOption }}
                </option>
            @endforeach
        </select>

        <!-- icon -->
        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div>

    <!-- error -->
    @error($name)
        <p class="mt-2 text-xs text-red-500 font-medium">
            {{ $message }}
        </p>
    @enderror
</div>
