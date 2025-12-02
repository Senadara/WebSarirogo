@props([
    'href' => '#',
    'variant' => 'primary',
    'size' => 'base',
])

@php
    $baseClass = "inline-flex items-center justify-center font-sans font-medium transition duration-300 rounded-full";

    // size
    $sizes = [
        // Kecil (HP friendly)
        'sm' => '
            text-xs py-1.5 px-4
            md:text-sm md:px-6
            lg:text-sm lg:px-7
        ',

        // Default
        'base' => '
            text-sm py-2 px-6
            md:text-base md:px-12
            lg:text-base lg:px-14
        ',

        // Lebih besar untuk CTA
        'lg' => '
            text-base py-2.5 px-8
            md:text-lg md:px-16
            lg:text-lg lg:px-20
        ',

        // Sangat besar (hero section)
        'xl' => '
            text-lg py-3 px-10
            md:text-xl md:px-20
            lg:text-xl lg:px-24
        ',

        'full' => '
            w-full text-base py-2.5
            md:w-fit md:px-16
            lg:px-20
        ',
    ];

    // variant
    $variants = [
        // solid utamanya
        'primary' => '
            bg-primary-3 text-white 
            hover:bg-secondary-3 
            shadow-sm hover:shadow-lg
        ',

        // abu soft
        'secondary' => '
            bg-gray-200 text-gray-800 
            hover:bg-gray-300 
            shadow-sm hover:shadow
        ',

        // border tipis
        'outline' => '
            border border-primary-3 
            text-primary-3 
            hover:bg-primary-3 hover:text-white
        ',

        // seperti link / transparan
        'ghost' => '
            text-primary-3 
            hover:bg-primary-1/20
        ',
    ];
@endphp


<a href="{{ $href }}" {{ $attributes->merge([
    'class' => "$baseClass {$sizes[$size]} {$variants[$variant]}"
]) }}>
    {{ $slot }}
</a>
