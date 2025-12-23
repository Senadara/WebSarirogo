@props([
    'icon' => null,
    'label' => '',
    'value' => '',
    'trend' => null, // 'up', 'down', or null
    'trendValue' => '',
    'variant' => 'default', // default, success, warning, danger, info
])

@php
    $variants = [
        'default' => [
            'bg' => 'bg-white',
            'iconBg' => 'bg-gray-100',
            'iconColor' => 'text-gray-600',
            'valueColor' => 'text-gray-900',
        ],
        'success' => [
            'bg' => 'bg-gradient-to-br from-emerald-50 to-green-50',
            'iconBg' => 'bg-emerald-100',
            'iconColor' => 'text-emerald-600',
            'valueColor' => 'text-emerald-700',
        ],
        'warning' => [
            'bg' => 'bg-gradient-to-br from-amber-50 to-orange-50',
            'iconBg' => 'bg-amber-100',
            'iconColor' => 'text-amber-600',
            'valueColor' => 'text-amber-700',
        ],
        'danger' => [
            'bg' => 'bg-gradient-to-br from-red-50 to-rose-50',
            'iconBg' => 'bg-red-100',
            'iconColor' => 'text-red-600',
            'valueColor' => 'text-red-700',
        ],
        'info' => [
            'bg' => 'bg-gradient-to-br from-blue-50 to-indigo-50',
            'iconBg' => 'bg-blue-100',
            'iconColor' => 'text-blue-600',
            'valueColor' => 'text-blue-700',
        ],
    ];
    
    $style = $variants[$variant] ?? $variants['default'];
    
    $trendColors = [
        'up' => 'text-emerald-600 bg-emerald-50',
        'down' => 'text-red-600 bg-red-50',
    ];
@endphp

<div {{ $attributes->merge(['class' => "p-3 sm:p-5 rounded-xl sm:rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 {$style['bg']}"]) }}>
    <div class="flex items-start justify-between">
        <!-- Icon -->
        @if($icon)
            <div class="p-2 sm:p-3 rounded-lg sm:rounded-xl {{ $style['iconBg'] }}">
                <img src="{{ $icon }}" alt="" class="w-5 h-5 sm:w-6 sm:h-6 {{ $style['iconColor'] }}">
            </div>
        @endif
        
        <!-- Trend -->
        @if($trend && $trendValue)
            <div class="flex items-center gap-1 px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full text-xs font-medium {{ $trendColors[$trend] ?? '' }}">
                @if($trend === 'up')
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                    </svg>
                @else
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                @endif
                {{ $trendValue }}
            </div>
        @endif
    </div>
    
    <!-- Content -->
    <div class="mt-3 sm:mt-4">
        <p class="text-xs sm:text-sm text-gray-500 font-medium truncate">{{ $label }}</p>
        <h3 class="text-xl sm:text-2xl font-bold mt-0.5 sm:mt-1 {{ $style['valueColor'] }}">{{ $value }}</h3>
    </div>
</div>
