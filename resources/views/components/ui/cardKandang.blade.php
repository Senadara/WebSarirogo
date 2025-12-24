@props([
    'items' => []
])

<div class="space-y-4 max-h-[520px] overflow-y-auto pr-1">

    @foreach ($items as $item)
    <label class="group bg-bg-2 hover:ring-1 hover:ring-accent-2 hover:bg-blue-100 transition rounded-xl p-5 flex gap-4 items-center cursor-pointer">

        <!-- checkbox -->
        <input type="checkbox"
            class="mt-1 accent-green-600">

        <img src="/assets/icons/kandang.svg"
            class="w-20 h-20 rounded-lg object-cover">

        <div class="flex-1">
            <h4 class="font-bold">Kandang {{ $item }}</h4>
            <p class="text-sm text-gray-600">7 Minggu</p>
            <p class="text-sm text-gray-600">1000 Ekor</p>
        </div>

        <div class="text-right">
            <p class="text-xs text-black mb-1 font-bold">Produksi</p>
            <p class="text-sm text-black mb-1">0 butir/hari</p>

            @if ($loop->index % 4 == 0)
                <span class="px-3 py-1 text-xs rounded-full bg-accent-3 text-white font-semibold">Starter</span>
            @elseif ($loop->index % 4 == 1)
                <span class="px-3 py-1 text-xs rounded-full bg-yellow-3 text-white font-semibold">Grower</span>
            @elseif ($loop->index % 4 == 2)
                <span class="px-3 py-1 text-xs rounded-full bg-primary-3 text-white font-semibold">Production</span>
            @else
                <span class="px-3 py-1 text-xs rounded-full bg-yellow-5 text-white font-semibold">Afkir</span>
            @endif

        </div>

    </label>
    @endforeach

</div>
