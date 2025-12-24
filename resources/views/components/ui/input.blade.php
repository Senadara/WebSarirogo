@props([
    'type' => 'text',
    'placeholder' => '',
    'value' => ''
])

<input 
    type="{{ $type }}"
    value="{{ $value }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge([
        'class' => 'w-full px-4 py-2 rounded-lg border bg-blue-100 text-sm font-semibold'
    ]) }}
>
