@props([
    'href' => '#',
    'icon' => '/assets/icons/default.svg',
    'title' => '',
    'description' => '',
    'variant' => 'primary',     
    'iconVariant' => 'default',  
])

@php
// background warna card
$cardVariants = [
    'primary'    => '#FFFFFF',
    'primary_1'  => '#E8F5E9',
    'yellow_1'   => '#FFF176',
    'accent_1'   => '#E1F5FE',
];

$iconVariants = [
    'default' => '#FFFFFF',
    'green'   => '#81C784',
    'yellow'  => '#F9A825',
    'blue'    => '#4FC3F7',
];

$cardBg  = $cardVariants[$variant] ?? '#FFFFFF';
$iconBg  = $iconVariants[$iconVariant] ?? '#E0F2FE';

$baseClass = "
    flex items-start gap-3 p-4 rounded-xl shadow-sm border cursor-pointer
    hover:shadow-md transition
    md:p-5
";

$iconWrapper = "
    p-3 rounded-lg flex items-center justify-center
";
@endphp

<a href="{{ $href }}"
   {{ $attributes->merge(['class' => $baseClass]) }}
   style="background-color: {{ $cardBg }};">
    
    {{-- Icon Wrapper --}}
    <div class="{{ $iconWrapper }}" style="background-color: {{ $iconBg }}">
        <img src="{{ $icon }}" class="w-6 h-6 md:w-7 md:h-7" alt="icon">
    </div>

    {{-- Text --}}
    <div class="flex flex-col">
        <h3 class="font-semibold text-base md:text-lg">{{ $title }}</h3>
        <p class="text-gray-600 text-sm md:text-base leading-tight">
            {{ $description }}
        </p>
    </div>
</a>
