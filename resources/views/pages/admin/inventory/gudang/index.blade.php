@extends('layouts.admin')

@section('content')
<div x-data="gudangPage()" class="flex bg-gray-50 min-h-screen overflow-x-hidden">

    @include('components.layouts.sidebar')

    <main class="flex-1 p-4 lg:p-8 lg:ml-72 max-w-full">
        
        <!-- Mobile Topbar -->
        <div class="flex items-center justify-between mb-4 lg:hidden">
            <div class="flex items-center gap-3">
                <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                    <img src="/assets/icons/menu.svg" class="w-6 h-6">
                </button>
                <div>
                    <h1 class="text-lg font-bold text-gray-900">Inventaris</h1>
                    <div class="flex items-center gap-1 text-xs text-gray-500">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                        <span>Inventaris</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button class="relative p-2 rounded-full hover:bg-gray-100 transition">
                    <img src="/assets/icons/notification.svg" class="w-5 h-5">
                    <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full animate-pulse"></span>
                </button>
                <button class="p-2 rounded-full hover:bg-gray-100 transition">
                    <img src="/assets/icons/user.svg" class="w-5 h-5">
                </button>
            </div>
        </div>

        <!-- Header -->
        <div class="mb-6 lg:mb-8 hidden lg:block">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Data Gudang</h1>
            <p class="text-gray-600">
                Kelola perlengkapan pertanian dan stok panen Anda dengan efisien.
            </p>
        </div>

        <!-- Toolbar -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
            
            <!-- Filters -->
            <div class="flex flex-wrap items-center gap-3">
                <!-- Tabs -->
                <div class="bg-white p-1 rounded-lg border shadow-sm inline-flex">
                    <button 
                        @click="activeTab = 'all'"
                        :class="activeTab === 'all' ? 'bg-gray-100 font-semibold text-gray-900' : 'text-gray-600 hover:bg-gray-50'"
                        class="px-3 sm:px-4 py-1.5 rounded-md text-sm transition-all"
                    >
                        Semua
                    </button>
                    <button 
                        @click="activeTab = 'supplies'"
                        :class="activeTab === 'supplies' ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-50'"
                        class="px-3 sm:px-4 py-1.5 rounded-md text-sm transition-all"
                    >
                        Perlengkapan
                    </button>
                    <button 
                        @click="activeTab = 'harvest'"
                        :class="activeTab === 'harvest' ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-50'"
                        class="px-3 sm:px-4 py-1.5 rounded-md text-sm transition-all"
                    >
                        Panen
                    </button>
                </div>

                <div class="h-6 w-px bg-gray-300 hidden sm:block"></div>

                <!-- Dropdowns -->
                <div class="flex gap-2 sm:gap-3">
                    <!-- Category Dropdown -->
                    <div class="relative">
                        <button @click="categoryOpen = !categoryOpen" @click.outside="categoryOpen = false" class="px-3 sm:px-4 py-2 bg-white border rounded-lg shadow-sm text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                            <span class="hidden sm:inline">Kategori:</span>
                            <span class="font-medium" x-text="selectedCategory"></span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="categoryOpen" x-transition class="absolute z-20 mt-1 w-48 bg-white rounded-lg shadow-lg border py-1" style="display: none;">
                            <template x-for="cat in categories" :key="cat">
                                <button 
                                    @click="selectedCategory = cat; categoryOpen = false"
                                    class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 flex items-center justify-between"
                                    :class="selectedCategory === cat ? 'text-emerald-700 bg-emerald-50' : 'text-gray-700'"
                                >
                                    <span x-text="cat"></span>
                                    <svg x-show="selectedCategory === cat" class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Status Dropdown -->
                    <div class="relative">
                        <button @click="statusOpen = !statusOpen" @click.outside="statusOpen = false" class="px-3 sm:px-4 py-2 bg-white border rounded-lg shadow-sm text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                            <span class="hidden sm:inline">Status:</span>
                            <span class="font-medium" x-text="selectedStatus"></span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="statusOpen" x-transition class="absolute z-20 mt-1 w-48 bg-white rounded-lg shadow-lg border py-1" style="display: none;">
                            <template x-for="stat in statuses" :key="stat">
                                <button 
                                    @click="selectedStatus = stat; statusOpen = false"
                                    class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 flex items-center justify-between"
                                    :class="selectedStatus === stat ? 'text-emerald-700 bg-emerald-50' : 'text-gray-700'"
                                >
                                    <span x-text="stat"></span>
                                    <svg x-show="selectedStatus === stat" class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Button -->
            <a href="{{ route('admin.inventory.create') }}" class="inline-flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-full font-medium transition shadow-sm shadow-emerald-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Tambah Item</span>
            </a>
        </div>

        <!-- Table Header - Desktop only -->
        <div class="hidden lg:grid grid-cols-12 gap-4 px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
            <div class="col-span-4">Detail Item</div>
            <div class="col-span-3">Level Stok</div>
            <div class="col-span-2">Harga / Unit</div>
            <div class="col-span-2">Update Terakhir</div>
            <div class="col-span-1 text-right">Aksi</div>
        </div>

        <!-- Inventory List -->
        <div class="space-y-3 lg:space-y-4">

            <template x-for="(item, index) in filteredItems" :key="item.sku">
                <div class="bg-white rounded-xl border border-gray-200 p-3 sm:p-4 lg:p-5 shadow-sm hover:shadow-md transition-shadow group">
                    
                    <!-- Mobile Layout (< lg) -->
                    <div class="lg:hidden">
                        <div class="flex items-start gap-3">
                            <!-- Image -->
                            <div class="w-14 h-14 rounded-lg bg-gray-100 flex-shrink-0 overflow-hidden border">
                                <img :src="item.image" class="w-full h-full object-cover" :alt="item.name">
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0">
                                        <h3 class="font-bold text-gray-900 text-sm truncate" x-text="item.name"></h3>
                                        <p class="text-xs text-gray-500 mt-0.5" x-text="item.category"></p>
                                    </div>
                                    
                                    <!-- Action Dropdown -->
                                    <div class="relative flex-shrink-0">
                                        <button 
                                            @click="toggleAction(index)" 
                                            class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                        </button>
                                        <div 
                                            x-show="activeAction === index" 
                                            @click.outside="activeAction = null"
                                            x-transition
                                            class="absolute right-0 z-20 mt-1 w-40 bg-white rounded-lg shadow-lg border py-1"
                                            style="display: none;"
                                        >
                                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Lihat Detail
                                            </a>
                                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                Edit Item
                                            </a>
                                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-50">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                                Tambah Stok
                                            </a>
                                            <hr class="my-1">
                                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Hapus
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Stock & Price Row -->
                                <div class="flex items-center justify-between mt-2 gap-3">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-900 text-sm" x-text="item.stock + ' ' + item.unit"></span>
                                        <span 
                                            class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full text-xs font-medium"
                                            :class="item.statusColor"
                                        >
                                            <span class="w-1.5 h-1.5 rounded-full" :class="item.statusDot"></span>
                                            <span x-text="item.status"></span>
                                        </span>
                                    </div>
                                    <span class="font-semibold text-emerald-600 text-sm" x-text="'Rp ' + item.price.toLocaleString('id-ID')"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Layout (lg+) -->
                    <div class="hidden lg:grid grid-cols-12 gap-4 items-center">
                        
                        <!-- Item Details -->
                        <div class="col-span-4 flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl bg-gray-100 flex-shrink-0 overflow-hidden border">
                                <img :src="item.image" class="w-full h-full object-cover" :alt="item.name">
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg" x-text="item.name"></h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded border" x-text="item.sku"></span>
                                    <span class="text-sm text-gray-500" x-text="item.category"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Stock Level -->
                        <div class="col-span-3">
                            <div class="flex justify-between text-sm mb-1.5">
                                <span class="font-bold text-gray-900" x-text="item.stock + ' ' + item.unit"></span>
                                <span class="text-gray-400 text-xs" x-text="'Target: ' + item.target + ' ' + item.unit"></span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                <div class="h-2.5 rounded-full transition-all" :class="item.barColor" :style="'width: ' + item.percent + '%'"></div>
                            </div>
                            <div class="mt-2 inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-xs font-medium" :class="item.statusColor">
                                <span class="w-1.5 h-1.5 rounded-full" :class="item.statusDot"></span>
                                <span x-text="item.status"></span>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="col-span-2">
                            <div class="font-bold text-gray-900 text-lg" x-text="'Rp ' + item.price.toLocaleString('id-ID')"></div>
                            <div class="text-sm text-emerald-600" x-text="item.priceUnit"></div>
                        </div>

                        <!-- Last Update -->
                        <div class="col-span-2 flex items-center gap-2 text-gray-500 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span x-text="item.lastUpdate"></span>
                        </div>

                        <!-- Action -->
                        <div class="col-span-1 flex justify-end relative">
                            <button 
                                @click="toggleAction(index)" 
                                class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                            </button>
                            <div 
                                x-show="activeAction === index" 
                                @click.outside="activeAction = null"
                                x-transition
                                class="absolute right-0 top-full z-20 mt-1 w-44 bg-white rounded-lg shadow-lg border py-1"
                                style="display: none;"
                            >
                                <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Lihat Detail
                                </a>
                                <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit Item
                                </a>
                                <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    Tambah Stok
                                </a>
                                <hr class="my-1">
                                <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Empty State -->
            <div x-show="filteredItems.length === 0" class="text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada item ditemukan</h3>
                <p class="text-gray-500">Coba ubah filter atau tambah item baru.</p>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-8">
            <p class="text-sm text-gray-500 order-2 sm:order-1">
                Menampilkan <span class="font-bold text-gray-900" x-text="filteredItems.length > 0 ? 1 : 0"></span> sampai <span class="font-bold text-gray-900" x-text="filteredItems.length"></span> dari <span class="font-bold text-gray-900" x-text="items.length"></span> hasil
            </p>
            
            <div class="flex items-center gap-2 order-1 sm:order-2">
                <button class="px-3 sm:px-4 py-2 border rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    Sebelumnya
                </button>
                <div class="flex gap-1">
                    <button class="w-9 h-9 flex items-center justify-center rounded-lg bg-emerald-500 text-white font-medium text-sm">1</button>
                    <button class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-gray-50 text-gray-600 font-medium text-sm">2</button>
                    <button class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-gray-50 text-gray-600 font-medium text-sm">3</button>
                    <span class="w-9 h-9 flex items-center justify-center text-gray-400">...</span>
                    <button class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-gray-50 text-gray-600 font-medium text-sm">10</button>
                </div>
                <button class="px-3 sm:px-4 py-2 border rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    Selanjutnya
                </button>
            </div>
        </div>

    </main>
</div>

<script>
function gudangPage() {
    return {
        open: false,
        activeTab: 'all',
        categoryOpen: false,
        statusOpen: false,
        selectedCategory: 'Semua',
        selectedStatus: 'Semua',
        activeAction: null,
        
        categories: ['Semua', 'Pupuk', 'Bibit', 'Pakan', 'Peralatan', 'Panen'],
        statuses: ['Semua', 'Tersedia', 'Stok Rendah', 'Kritis'],
        
        items: [
            {
                name: 'Pupuk NPK Premium',
                sku: 'SKU-4921',
                category: 'Pupuk',
                type: 'supplies',
                image: 'https://images.unsplash.com/photo-1585314062340-f1a5a7c9328d?q=80&w=200&auto=format&fit=crop',
                stock: 850,
                target: 1000,
                unit: 'kg',
                percent: 85,
                status: 'Tersedia',
                statusColor: 'bg-emerald-50 text-emerald-700 border border-emerald-100',
                statusDot: 'bg-emerald-500',
                barColor: 'bg-emerald-500',
                price: 150000,
                priceUnit: 'per sak (50kg)',
                lastUpdate: '2 jam yang lalu'
            },
            {
                name: 'Set Sekop Tangan Pro',
                sku: 'SKU-8821',
                category: 'Peralatan',
                type: 'supplies',
                image: 'https://images.unsplash.com/photo-1592419044706-39796d40f98c?q=80&w=200&auto=format&fit=crop',
                stock: 15,
                target: 50,
                unit: 'set',
                percent: 30,
                status: 'Stok Rendah',
                statusColor: 'bg-amber-50 text-amber-700 border border-amber-100',
                statusDot: 'bg-amber-500',
                barColor: 'bg-amber-500',
                price: 225000,
                priceUnit: 'per set',
                lastUpdate: 'Kemarin'
            },
            {
                name: 'Benih Jagung Hibrida',
                sku: 'SKU-3320',
                category: 'Bibit',
                type: 'supplies',
                image: 'https://images.unsplash.com/photo-1574943320219-553eb213f72d?q=80&w=200&auto=format&fit=crop',
                stock: 480,
                target: 500,
                unit: 'kg',
                percent: 96,
                status: 'Tersedia',
                statusColor: 'bg-emerald-50 text-emerald-700 border border-emerald-100',
                statusDot: 'bg-emerald-500',
                barColor: 'bg-emerald-500',
                price: 80000,
                priceUnit: 'per kg',
                lastUpdate: '3 hari yang lalu'
            },
            {
                name: 'Pakan Ternak Organik',
                sku: 'SKU-7721',
                category: 'Pakan',
                type: 'supplies',
                image: 'https://images.unsplash.com/photo-1548685959-1c9441113554?q=80&w=200&auto=format&fit=crop',
                stock: 50,
                target: 500,
                unit: 'kg',
                percent: 10,
                status: 'Kritis',
                statusColor: 'bg-red-50 text-red-700 border border-red-100',
                statusDot: 'bg-red-500',
                barColor: 'bg-red-500',
                price: 300000,
                priceUnit: 'per sak (40kg)',
                lastUpdate: '1 minggu yang lalu'
            },
            {
                name: 'Jagung Hasil Panen',
                sku: 'SKU-9901',
                category: 'Panen',
                type: 'harvest',
                image: 'https://images.unsplash.com/photo-1551754655-cd27e38d2076?q=80&w=200&auto=format&fit=crop',
                stock: 2500,
                target: 3000,
                unit: 'kg',
                percent: 83,
                status: 'Tersedia',
                statusColor: 'bg-emerald-50 text-emerald-700 border border-emerald-100',
                statusDot: 'bg-emerald-500',
                barColor: 'bg-emerald-500',
                price: 5000,
                priceUnit: 'per kg',
                lastUpdate: '5 jam yang lalu'
            }
        ],
        
        get filteredItems() {
            return this.items.filter(item => {
                // Tab filter
                if (this.activeTab === 'supplies' && item.type !== 'supplies') return false;
                if (this.activeTab === 'harvest' && item.type !== 'harvest') return false;
                
                // Category filter
                if (this.selectedCategory !== 'Semua' && item.category !== this.selectedCategory) return false;
                
                // Status filter
                if (this.selectedStatus !== 'Semua' && item.status !== this.selectedStatus) return false;
                
                return true;
            });
        },
        
        toggleAction(index) {
            this.activeAction = this.activeAction === index ? null : index;
        }
    }
}
</script>
@endsection