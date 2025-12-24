@props([
    'step' => 1,
    'title' => ''
])

<div class="bg-green-50 rounded-xl p-4 mb-8">
    <div class="flex justify-between items-center max-w-xl mx-auto">

        @for ($i = 1; $i <= 3; $i++)
            <div class="flex flex-col items-center text-sm">
                <div class="w-8 h-8 rounded-full flex items-center justify-center
                    {{ $step == $i 
                        ? 'bg-primary-3 text-white' 
                        : 'border text-gray-600' }}">
                    {{ $i }}
                </div>
                <span class="mt-1">Step {{ $i }}</span>
            </div>

            @if ($i < 3)
                <div class="flex-1 h-[2px] bg-gray-300 mx-2"></div>
            @endif
        @endfor

    </div>

    <p class="text-center text-sm mt-3 text-gray-700 font-semibold">
        {{ $title }}
    </p>
</div>
