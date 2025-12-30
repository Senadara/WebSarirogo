<div
    x-data="{
        selectedLahan: [],
        searchQuery: '',
        faseFilter: '',
        showFilter: false,

        lahanList: [
            { id: 1, name: 'Kandang A', umur: '7 Minggu', jumlah: '1000 Ekor', fase: 'Starter' },
            { id: 2, name: 'Kandang B', umur: '7 Minggu', jumlah: '1000 Ekor', fase: 'Grower' },
            { id: 3, name: 'Kandang C', umur: '7 Minggu', jumlah: '1000 Ekor', fase: 'Production' },
            { id: 4, name: 'Kandang D', umur: '7 Minggu', jumlah: '1000 Ekor', fase: 'Afkir' },
        ],

        get filteredLahan() {
            return this.lahanList.filter(l => {
                const matchSearch = l.name.toLowerCase().includes(this.searchQuery.toLowerCase())
                const matchFase = this.faseFilter === '' || l.fase === this.faseFilter
                return matchSearch && matchFase
            })
        },

        get uniqueFase() {
            return [...new Set(this.lahanList.map(l => l.fase))]
        },

        toggleLahan(id) {
            if (this.selectedLahan.includes(id)) {
                this.selectedLahan = this.selectedLahan.filter(i => i !== id)
            } else {
                this.selectedLahan.push(id)
            }
        },

        isSelected(id) {
            return this.selectedLahan.includes(id)
        },

        get selectedLahanNames() {
            return this.lahanList
                .filter(l => this.selectedLahan.includes(l.id))
                .map(l => l.name)
                .join('\n')
        }
    }"
    @toggle-lahan.window="toggleLahan($event.detail)">

    <!-- HEADER -->
    <div class="flex items-center gap-3 mb-6 mt-6">
        <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-primary-3 to-primary-4 flex items-center justify-center">
            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                </path>
            </svg>
        </div>
        <div>
            <h2 class="text-lg md:text-2xl font-bold text-gray-900">
                Pilih Lahan  
            </h2>
            <p class="text-xs md:text-sm text-gray-500">
                Tentukan lahan yang akan dilaporkan
            </p>
        </div>
    </div>

    <!-- MAIN CARD -->
    <div class="bg-gradient-to-br from-primary-1/50 to-white rounded-2xl md:rounded-3xl border border-primary-2/50 p-4 md:p-8 mb-6">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LIST KANDANG -->
            <div class="lg:col-span-2">

                <!-- SEARCH & FILTER -->
                <div class="flex flex-col sm:flex-row gap-3 mb-4">

                    <!-- SEARCH -->
                    <div class="relative flex-1">
                        <input
                            type="text"
                            x-model="searchQuery"
                            placeholder="Cari Kandang..."
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-3 focus:border-primary-3 outline-none text-sm">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                    </div>

                    <!-- FILTER -->
                    <div class="relative">
                        <button
                            @click="showFilter = !showFilter"
                            :class="faseFilter ? 'bg-primary-1 border-primary-3 text-primary-4' : 'border-gray-200 text-gray-600'"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-xl border text-sm font-medium hover:bg-gray-50 transition">
                            <img src="/assets/icons/filter.svg" class="w-4 h-4">
                            Filter
                        </button>

                        <div
                            x-show="showFilter"
                            @click.away="showFilter = false"
                            x-transition
                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">Fase</div>

                            <button
                                @click="faseFilter = ''; showFilter = false"
                                :class="faseFilter === '' ? 'bg-primary-1 text-primary-4' : 'text-gray-700'"
                                class="w-full px-3 py-2 text-left text-sm hover:bg-gray-50 transition">
                                Semua
                            </button>

                            <template x-for="fase in uniqueFase" :key="fase">
                                <button
                                    @click="faseFilter = fase; showFilter = false"
                                    :class="faseFilter === fase ? 'bg-primary-1 text-primary-4' : 'text-gray-700'"
                                    class="w-full px-3 py-2 text-left text-sm hover:bg-gray-50 transition"
                                    x-text="fase">
                                </button>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- CARD KANDANG -->
                <template x-for="item in filteredLahan" :key="item.id">
                    <x-ui.cardKandang
                        x-bind:id="item.id"
                        x-bind:name="item.name"
                        x-bind:umur="item.umur"
                        x-bind:jumlah="item.jumlah"
                        x-bind:fase="item.fase" />
                </template>

            </div>

            <!-- FORM KANAN -->
            <form method="POST" action="#">
                @csrf

                <div class="bg-blue-50 rounded-xl p-6">
                    <h3 class="font-bold mb-4">Lahan yang Dipilih</h3>

                    <div class="space-y-4">

                        <textarea
                            rows="4"
                            class="w-full rounded-lg border px-4 py-2 bg-gray-100 font-bold text-center"
                            placeholder="Kandang Yang Dipilih..."
                            x-model="selectedLahanNames"
                            readonly></textarea>

                        <input
                            type="hidden"
                            name="lahan_ids"
                            :value="selectedLahan.join(',')">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>