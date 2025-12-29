<label
    @click="$dispatch('toggle-lahan', item.id)"
    class="group bg-bg-2 hover:ring-1 hover:ring-accent-2 hover:bg-blue-100 transition rounded-xl p-5 flex gap-4 items-center cursor-pointer mb-4"
>

    <img
        src="/assets/icons/kandang.svg"
        class="w-20 h-20 rounded-lg object-cover"
    >

    <div class="flex-1">
        <h4 class="font-bold" x-text="item.name"></h4>
        <p class="text-sm text-gray-600" x-text="item.umur"></p>
        <p class="text-sm text-gray-600" x-text="item.jumlah"></p>
    </div>

    <div class="text-right">
        <p class="text-xs text-black mb-1 font-bold">Produksi</p>
        <p class="text-sm text-black mb-1">0 butir/hari</p>

        <template x-if="item.fase === 'Starter'">
            <span class="px-3 py-1 text-xs rounded-full bg-accent-3 text-white font-semibold">Starter</span>
        </template>

        <template x-if="item.fase === 'Grower'">
            <span class="px-3 py-1 text-xs rounded-full bg-yellow-3 text-white font-semibold">Grower</span>
        </template>

        <template x-if="item.fase === 'Production'">
            <span class="px-3 py-1 text-xs rounded-full bg-primary-3 text-white font-semibold">Production</span>
        </template>

        <template x-if="item.fase === 'Afkir'">
            <span class="px-3 py-1 text-xs rounded-full bg-yellow-5 text-white font-semibold">Afkir</span>
        </template>
    </div>

</label>
