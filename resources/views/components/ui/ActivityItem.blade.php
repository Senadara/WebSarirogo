@props([
    'avatar' => null,
    'name' => '',
    'action' => '',
    'time' => '',
    'href' => '#',
])

<a 
    href="{{ $href }}"
    {{ $attributes->merge(['class' => 'flex items-center gap-3 sm:gap-4 p-3 sm:p-4 bg-white rounded-xl border border-gray-100 hover:border-primary-2 hover:shadow-md transition-all duration-300 group']) }}
>
    <!-- Avatar -->
    <div class="relative flex-shrink-0">
        @if($avatar)
            <img 
                src="{{ $avatar }}" 
                alt="{{ $name }}"
                class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover ring-2 ring-gray-100 group-hover:ring-primary-2 transition-all"
            >
        @else
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-gradient-to-br from-primary-2 to-primary-4 flex items-center justify-center text-white font-bold text-base sm:text-lg">
                {{ strtoupper(substr($name, 0, 1)) }}
            </div>
        @endif
        
        <!-- Online indicator -->
        <span class="absolute bottom-0 right-0 w-3 h-3 sm:w-3.5 sm:h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
    </div>
    
    <!-- Content -->
    <div class="flex-1 min-w-0">
        <p class="text-xs sm:text-sm font-semibold text-gray-900 truncate">
            {{ $name }} <span class="font-normal text-gray-600">{{ $action }}</span>
        </p>
        <p class="text-xs text-gray-500 mt-0.5 truncate">{{ $time }}</p>
    </div>
    
    <!-- Arrow -->
    <div class="flex-shrink-0 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-gray-100 group-hover:bg-primary-3 flex items-center justify-center transition-all">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </div>
</a>

