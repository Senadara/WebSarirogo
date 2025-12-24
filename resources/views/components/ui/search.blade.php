@props([
    'placeholder' => 'Search...',
])

<div class="relative w-full md:w-80">
    <input
        type="text"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'w-full pl-10 pr-4 py-2 rounded-full border focus:ring-2 focus:ring-primary-3 outline-none text-sm'
        ]) }}
    >
    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
        🔍
    </span>
</div>
