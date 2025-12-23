@props([
    'value' => 0,
    'max' => 100,
    'label' => '',
    'showPercent' => true,
    'variant' => 'auto', // auto, success, warning, danger
    'size' => 'md', // sm, md, lg
])

@php
    $percent = $max > 0 ? round(($value / $max) * 100) : 0;
    
    // Auto variant based on percentage
    if ($variant === 'auto') {
        if ($percent >= 70) {
            $variant = 'success';
        } elseif ($percent >= 40) {
            $variant = 'warning';
        } else {
            $variant = 'danger';
        }
    }
    
    $gradients = [
        'success' => 'from-emerald-400 to-emerald-600',
        'warning' => 'from-amber-400 to-orange-500',
        'danger' => 'from-red-400 to-red-600',
        'info' => 'from-blue-400 to-blue-600',
        'purple' => 'from-purple-400 to-purple-600',
    ];
    
    $bgColors = [
        'success' => 'bg-emerald-100',
        'warning' => 'bg-amber-100',
        'danger' => 'bg-red-100',
        'info' => 'bg-blue-100',
        'purple' => 'bg-purple-100',
    ];
    
    $sizes = [
        'sm' => 'h-2',
        'md' => 'h-3',
        'lg' => 'h-4',
    ];
    
    $gradient = $gradients[$variant] ?? $gradients['success'];
    $bgColor = $bgColors[$variant] ?? $bgColors['success'];
    $height = $sizes[$size] ?? $sizes['md'];
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    @if($label || $showPercent)
        <div class="flex items-center justify-between mb-1.5">
            @if($label)
                <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
            @endif
            @if($showPercent)
                <span class="text-sm font-semibold text-gray-900">{{ $percent }}%</span>
            @endif
        </div>
    @endif
    
    <div class="relative w-full {{ $bgColor }} rounded-full {{ $height }} overflow-hidden">
        <div 
            class="absolute inset-y-0 left-0 bg-gradient-to-r {{ $gradient }} rounded-full transition-all duration-500 ease-out"
            style="width: {{ $percent }}%"
        ></div>
        
        <!-- Shimmer effect -->
        <div 
            class="absolute inset-y-0 left-0 bg-gradient-to-r from-transparent via-white/30 to-transparent rounded-full animate-pulse"
            style="width: {{ $percent }}%"
        ></div>
    </div>
</div>
