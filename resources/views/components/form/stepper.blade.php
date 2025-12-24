@props([
    'currentStep' => 1,
    'totalSteps' => 3,
    'labels' => ['Step 1', 'Step 2', 'Step 3'],
    'description' => '',
])

<div class="bg-primary-1 rounded-2xl p-4 md:p-6 mb-6">
    {{-- Stepper container with max-width to keep it comp  act --}}
    <div class="flex items-center justify-center max-w-md mx-auto">
        @for ($i = 1; $i <= $totalSteps; $i++)
            {{-- Step circle with label --}}
            <div class="flex flex-col items-center flex-shrink-0">
                @if ($i < $currentStep)
                    {{-- Completed step --}}
                    <div class="w-7 h-7 md:w-8 md:h-8 rounded-full bg-accent-3 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                @elseif ($i == $currentStep)
                    {{-- Current step --}}
                    <div class="w-7 h-7 md:w-8 md:h-8 rounded-full border-2 border-accent-3 bg-white flex items-center justify-center">
                        <div class="w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-accent-3"></div>
                    </div>
                @else
                    {{-- Future step --}}
                    <div class="w-7 h-7 md:w-8 md:h-8 rounded-full border-2 border-gray-300 bg-white"></div>
                @endif
                
                {{-- Label --}}
                <span class="text-[10px] md:text-xs mt-1.5 text-gray-600 font-medium whitespace-nowrap">{{ $labels[$i - 1] ?? "Step $i" }}</span>
            </div>

            {{-- Connector line - fixed width for consistent spacing --}}
            @if ($i < $totalSteps)
                <div class="w-12 sm:w-16 md:w-20 h-0.5 mx-1 md:mx-2 mb-5 {{ $i < $currentStep ? 'bg-accent-3' : 'bg-gray-300' }}"></div>
            @endif
        @endfor
    </div>

    @if ($description)
        <p class="text-center text-xs md:text-sm text-gray-600 mt-3 md:mt-4 px-2">{{ $description }}</p>
    @endif
</div>
