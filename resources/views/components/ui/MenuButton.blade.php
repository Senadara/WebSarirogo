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
    flex items-start gap-2.5 sm:gap-3 p-3 sm:p-4 md:p-5 rounded-xl shadow-sm border cursor-pointer
    hover:shadow-md transition w-full min-w-0
";

$iconWrapper = "
    p-2 sm:p-3 rounded-lg flex items-center justify-center flex-shrink-0
";
@endphp

<a href="{{ $href }}"
   {{ $attributes->merge(['class' => $baseClass]) }}
   style="background-color: {{ $cardBg }};">
    
    <!-- icon -->
    <div class="{{ $iconWrapper }}" style="background-color: {{ $iconBg }}">
        <img src="{{ $icon }}" class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7" alt="icon">
    </div>

    <!-- text -->
    <div class="flex flex-col min-w-0 flex-1">
        <h3 class="font-semibold text-sm sm:text-base md:text-lg truncate">{{ $title }}</h3>
        <p class="text-gray-600 text-xs sm:text-sm leading-tight line-clamp-2">
            {{ $description }}
        </p>
    </div>
</a>

