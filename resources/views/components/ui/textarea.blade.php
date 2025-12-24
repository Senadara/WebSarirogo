@props([
    'rows' => 4,
    'placeholder' => ''
])

<textarea 
    rows="{{ $rows }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge([
        'class' => 'w-full px-4 py-2 rounded-lg border text-sm'
    ]) }}
></textarea>
