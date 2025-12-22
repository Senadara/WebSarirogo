@props([
    'label' => '',
    'name' => '',
    'placeholder' => 'Pilih',
    'options' => [],
    'selected' => '',
])

<div class="space-y-1 md:space-y-2">
    @if ($label)
        <label for="{{ $name }}" class="block text-xs md:text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif

    <div class="relative">
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes->merge([
                'class' => 'w-full px-3 md:px-4 py-2.5 md:py-3 rounded-lg md:rounded-xl border border-gray-200 bg-white appearance-none focus:ring-2 focus:ring-primary-3 focus:border-primary-3 outline-none text-xs md:text-sm transition cursor-pointer'
            ]) }}
        >
            <option value="" disabled {{ $selected === '' ? 'selected' : '' }}>{{ $placeholder }}</option>
            @foreach ($options as $value => $text)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $text }}</option>
            @endforeach
        </select>

        {{-- Dropdown arrow --}}
        <div class="absolute inset-y-0 right-0 flex items-center px-2 md:px-3 pointer-events-none">
            <svg class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>
</div>
