<div x-data="{ 
    open: false,
    showFilter: false,
    searchQuery: '',
    categoryFilter: '',
    inventoryList: [
        { id: 1, name: 'Pupuk Indonesia', qty: '100 Kg', category: 'Pupuk Okra', expDate: '1 Januari 2027', stock: 'Stok Banyak', image: '/assets/icons/pakan.svg' },
        { id: 2, name: 'Poly Bag', qty: '10 Pcs', category: 'Peralatan Ternak', expDate: 'Dapat di Isi Ulang', stock: 'Sedikit', image: '/assets/icons/box.svg' },
        { id: 3, name: 'Pelet Ayam Petelur', qty: '100 Kg', category: 'Pakan Ayam', expDate: '1 Januari 2027', stock: 'Stok Banyak', image: '/assets/icons/pakan.svg' },
        { id: 4, name: 'Vitamin Ternak', qty: '50 Pcs', category: 'Peralatan Ternak', expDate: '1 Juni 2026', stock: 'Sedikit', image: '/assets/icons/box.svg' },
        { id: 5, name: 'Konsentrat Ayam', qty: '200 Kg', category: 'Pakan Ayam', expDate: '1 Januari 2027', stock: 'Stok Banyak', image: '/assets/icons/pakan.svg' },
    ],
    selectedItems: [],
    get filteredInventory() {
        return this.inventoryList.filter(item => {
            const matchSearch = item.name.toLowerCase().includes(this.searchQuery.toLowerCase());
            const matchCategory = this.categoryFilter === '' || item.category === this.categoryFilter;
            return matchSearch && matchCategory;
        });
    },
    get uniqueCategories() {
        return [...new Set(this.inventoryList.map(item => item.category))];
    },
    addItem(item) {
        const existing = this.selectedItems.find(i => i.id === item.id);
        if (existing) {
            existing.amount++;
        } else {
            this.selectedItems.push({ ...item, amount: 1 });
        }
    },
    removeItem(itemId) {
        const index = this.selectedItems.findIndex(i => i.id === itemId);
        if (index > -1) {
            if (this.selectedItems[index].amount > 1) {
                this.selectedItems[index].amount--;
            } else {
                this.selectedItems.splice(index, 1);
            }
        }
    },
    isSelected(itemId) {
        return this.selectedItems.some(i => i.id === itemId);
    },
    getAmount(itemId) {
        const item = this.selectedItems.find(i => i.id === itemId);
        return item ? item.amount : 0;
    }
}" class="flex bg-white min-h-screen">

    <main class="flex-1 min-h-screen">

        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-primary-3 to-primary-4 flex items-center justify-center">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg md:text-2xl font-bold text-gray-900">Tentukan Barang</h2>
                <p class="text-xs md:text-sm text-gray-500">Pilih barang dari inventaris yang digunakan untuk aktivitas</p>
            </div>
        </div>

        <!-- main card content -->
        <div class="bg-gradient-to-br from-primary-1/50 to-white rounded-2xl md:rounded-3xl border border-primary-2/50 p-4 md:p-8 mb-6">

            <!-- grid content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">

                <!-- left column: inventory list -->
                <div class="lg:col-span-2">

                    <!-- search & filter -->
                    <div class="bg-white rounded-xl md:rounded-2xl p-4 shadow-sm border border-gray-100 mb-4">
                        <div class="flex items-center gap-2 md:gap-4">
                            <div class="relative flex-1">
                                <input
                                    type="text"
                                    x-model="searchQuery"
                                    placeholder="Cari barang..."
                                    class="w-full pl-10 md:pl-12 pr-4 py-2.5 md:py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-3 focus:border-primary-3 outline-none text-sm">
                                <span class="absolute left-3 md:left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </span>
                            </div>

                            <div class="relative">
                                <button
                                    @click="showFilter = !showFilter"
                                    :class="categoryFilter ? 'bg-primary-1 border-primary-3 text-primary-4' : 'border-gray-200 text-gray-600'"
                                    class="flex items-center gap-2 px-4 py-2.5 md:py-3 rounded-xl border text-sm font-medium hover:bg-gray-50 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                    </svg>
                                    <span class="hidden sm:inline">Filter</span>
                                </button>

                                <!-- filter dropdown -->
                                <div
                                    x-show="showFilter"
                                    @click.away="showFilter = false"
                                    x-transition
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                                    <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">Kategori</div>
                                    <button
                                        @click="categoryFilter = ''; showFilter = false"
                                        :class="categoryFilter === '' ? 'bg-primary-1 text-primary-4' : 'text-gray-700'"
                                        class="w-full px-3 py-2 text-left text-sm hover:bg-gray-50 transition">
                                        Semua
                                    </button>
                                    <template x-for="category in uniqueCategories" :key="category">
                                        <button
                                            @click="categoryFilter = category; showFilter = false"
                                            :class="categoryFilter === category ? 'bg-primary-1 text-primary-4' : 'text-gray-700'"
                                            class="w-full px-3 py-2 text-left text-sm hover:bg-gray-50 transition"
                                            x-text="category"></button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- active filter badge -->
                        <div x-show="categoryFilter" class="mt-3">
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary-1 rounded-lg text-sm text-primary-4 font-medium">
                                <span x-text="'Kategori: ' + categoryFilter"></span>
                                <button @click="categoryFilter = ''" class="hover:text-primary-5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </div>

                    <!-- inventory cards -->
                    <div class="space-y-3">
                        <template x-for="item in filteredInventory" :key="item.id">
                            <div
                                :class="isSelected(item.id) ? 'ring-2 ring-primary-3 bg-white shadow-md' : 'bg-white hover:shadow-md'"
                                class="flex items-center gap-3 md:gap-4 p-4 md:p-5 rounded-xl md:rounded-2xl border border-gray-100 transition-all duration-200">
                                <!-- thumbnail -->
                                <div class="w-14 h-14 md:w-16 md:h-16 rounded-xl bg-gradient-to-br from-primary-1 to-primary-2 overflow-hidden flex-shrink-0 flex items-center justify-center">
                                    <img :src="item.image" alt="item" class="w-8 h-8 md:w-10 md:h-10 object-contain">
                                </div>

                                <!-- info -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-sm md:text-base text-gray-900" x-text="item.name"></h3>
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-0.5 mt-1">
                                        <span class="text-xs md:text-sm text-gray-500 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                            <span x-text="item.qty"></span>
                                        </span>
                                        <span class="text-xs md:text-sm text-primary-4 font-medium" x-text="item.category"></span>
                                    </div>
                                </div>

                                <!-- expiry date & stock -->
                                <div class="text-right flex-shrink-0">
                                    <p class="text-[10px] md:text-xs text-gray-400 uppercase tracking-wide">Exp</p>
                                    <p class="text-xs md:text-sm font-medium text-gray-700" x-text="item.expDate"></p>
                                    <span
                                        :class="item.stock === 'Stok Banyak' ? 'bg-gradient-to-r from-primary-3 to-primary-4 text-white' : 'bg-gradient-to-r from-orange-400 to-orange-500 text-white'"
                                        class="inline-block mt-1.5 px-2.5 md:px-3 py-1 md:py-1.5 rounded-lg text-[10px] md:text-xs font-semibold whitespace-nowrap shadow-sm"
                                        x-text="item.stock"></span>
                                </div>

                                <!-- add/remove button -->
                                <div class="flex-shrink-0">
                                    <template x-if="!isSelected(item.id)">
                                        <button
                                            @click="addItem(item)"
                                            class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-primary-3 to-primary-4 text-white flex items-center justify-center hover:shadow-lg hover:shadow-primary-3/30 transition-all duration-200">
                                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </template>
                                    <template x-if="isSelected(item.id)">
                                        <button
                                            @click="removeItem(item.id)"
                                            class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-red-400 to-red-500 text-white flex items-center justify-center hover:shadow-lg hover:shadow-red-400/30 transition-all duration-200">
                                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <!-- empty state -->
                        <div x-show="filteredInventory.length === 0" class="text-center py-12 bg-white rounded-2xl border border-gray-100">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">Tidak ada barang ditemukan</p>
                            <p class="text-sm text-gray-400 mt-1">Coba ubah filter atau kata kunci pencarian</p>
                        </div>
                    </div>
                </div>

                <!-- right column: summary -->
                <div class="lg:col-span-1 order-1 lg:order-2">
                    <div class="bg-white border border-gray-100 rounded-xl md:rounded-2xl p-4 md:p-6 shadow-sm lg:sticky lg:top-6">

                        <!-- header -->
                        <div class="flex items-center gap-2 mb-5">
                            <div class="w-8 h-8 rounded-lg bg-primary-1 flex items-center justify-center">
                                <svg class="w-4 h-4 text-primary-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-gray-900">Ringkasan</h2>
                        </div>

                        <!-- lahan info card -->
                        <div class="bg-gradient-to-r from-primary-1 to-primary-1/50 p-3 rounded-xl border border-primary-2 mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center">
                                    <img src="/assets/icons/kandang.svg" class="w-6 h-6" alt="kandang">
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Kandang A</p>
                                    <p class="text-xs text-gray-500">Pemupukan</p>
                                </div>
                            </div>
                        </div>

                        <!-- catatan -->
                        <div class="mb-4">
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Catatan</label>
                            <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-lg italic">"Note dari pak heri"</p>
                        </div>

                        <!-- selected items -->
                        <div class="mb-5">
                            <div class="flex items-center justify-between mb-3">
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Barang Dipilih</label>
                                <span
                                    x-show="selectedItems.length > 0"
                                    class="bg-primary-1 text-primary-4 text-xs font-semibold px-2 py-0.5 rounded-full"
                                    x-text="selectedItems.length + ' Item'"></span>
                            </div>

                            <template x-if="selectedItems.length === 0">
                                <div class="text-center py-6 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                                    <svg class="w-8 h-8 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    <p class="text-sm text-gray-400">Belum ada barang dipilih</p>
                                </div>
                            </template>

                            <div class="space-y-2">
                                <template x-for="item in selectedItems" :key="item.id">
                                    <div class="flex items-center justify-between py-2.5 px-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                        <div class="flex items-center gap-2 min-w-0">
                                            <div class="w-8 h-8 rounded-lg bg-white border flex items-center justify-center flex-shrink-0">
                                                <img :src="item.image" class="w-5 h-5" alt="item">
                                            </div>
                                            <span class="text-sm text-gray-700 truncate" x-text="item.name"></span>
                                        </div>
                                        <div class="flex items-center gap-2 flex-shrink-0">
                                            <button
                                                @click="removeItem(item.id)"
                                                class="w-7 h-7 rounded-lg bg-gray-200 flex items-center justify-center hover:bg-gray-300 transition">
                                                <svg class="w-3.5 h-3.5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                </svg>
                                            </button>
                                            <span class="text-sm font-bold w-6 text-center" x-text="item.amount"></span>
                                            <button
                                                @click="addItem(item)"
                                                class="w-7 h-7 rounded-lg bg-primary-1 flex items-center justify-center hover:bg-primary-2 transition">
                                                <svg class="w-3.5 h-3.5 text-primary-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Upload Gambar -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 pt-4">
                                    Bukti Aktivitas
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-emerald-500 transition cursor-pointer">
                                    <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-sm text-gray-500">Kirim Bukti Aktivitas</p>
                                    <p class="text-xs text-gray-400">PNG, JPG max 2MB</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>