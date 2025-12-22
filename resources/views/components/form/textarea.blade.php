@props([
    'label' => '',
    'name' => '',
    'placeholder' => 'Ketik di sini...',
    'rows' => 3,
    'value' => '',
])

<div class="space-y-1 md:space-y-2">
    @if ($label)
        <label for="{{ $name }}" class="block text-xs md:text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'w-full px-3 md:px-4 py-2.5 md:py-3 rounded-lg md:rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-primary-3 focus:border-primary-3 outline-none text-xs md:text-sm transition resize-none'
        ]) }}
    >{{ $value }}</textarea>
</div>
