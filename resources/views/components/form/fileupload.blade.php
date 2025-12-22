@props([
    'label' => '',
    'name' => '',
    'accept' => 'image/*',
    'multiple' => false,
])

<div class="space-y-1 md:space-y-2">
    @if ($label)
        <label class="block text-xs md:text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif

    <label
        for="{{ $name }}"
        class="flex flex-col items-center justify-center w-full min-h-[120px] md:min-h-[140px] p-4 md:p-6 border-2 border-dashed border-primary-3 rounded-lg md:rounded-xl cursor-pointer bg-white hover:bg-primary-1/30 transition"
    >
        <div class="flex flex-col items-center justify-center">
            {{-- Upload icon --}}
            <svg class="w-8 h-8 md:w-10 md:h-10 text-primary-3 mb-1.5 md:mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
            </svg>
            
            <p class="text-xs md:text-sm font-semibold text-primary-3 mb-0.5 md:mb-1">Upload</p>
            <p class="text-[10px] md:text-xs text-gray-500 text-center px-2">Drag a file here or click to browse<br class="hidden sm:block"> in your folder explorer</p>
        </div>
        
        <input
            type="file"
            name="{{ $name }}"
            id="{{ $name }}"
            accept="{{ $accept }}"
            {{ $multiple ? 'multiple' : '' }}
            class="hidden"
            {{ $attributes }}
        >
    </label>
</div>
