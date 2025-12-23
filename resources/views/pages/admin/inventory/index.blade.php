@extends('layouts.admin')

@section('content')
<div x-data="inventoryDashboard()" class="flex bg-gray-50 min-h-screen overflow-x-hidden">

    @include('components.layouts.sidebar')

    <main class="flex-1 p-3 sm:p-4 lg:p-8 lg:ml-72 max-w-full overflow-x-hidden">

        <!-- Mobile Topbar -->
        <div class="flex items-center gap-3 mb-6 lg:hidden">
            <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                <img src="/assets/icons/menu.svg" class="w-6 h-6">
            </button>
            <h1 class="text-lg font-bold">Inventaris</h1>
        </div>

        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-2 hidden lg:block text-gray-900">Inventaris</h1>

        <!-- Breadcrumb & Actions -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <img src="/assets/icons/home.svg" class="w-4 h-4">
                <span>/</span>
                <span class="font-semibold text-gray-900">Inventaris</span>
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

        <!-- Hero Banner -->
        <div class="relative overflow-hidden rounded-xl sm:rounded-2xl bg-gradient-to-r from-emerald-500 via-green-500 to-teal-500 p-4 sm:p-6 md:p-8 mb-6 shadow-lg">
            <div class="relative z-10">
                <h2 class="text-xl md:text-2xl font-bold text-white mb-2">
                    Kelola Stok Gudang dengan Fitur Inventaris
                </h2>
                <p class="text-emerald-100 text-sm md:text-base max-w-2xl">
                    Tambah barang baru, perbarui stok, catat pemakaian, dan pantau kebutuhan kandang agar selalu tercatat dengan rapi.
                </p>
                <p class="text-emerald-200 text-sm mt-3 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ now()->locale('id')->translatedFormat('l, d F Y') }}
                </p>
            </div>
            
            <!-- Decorative Elements - Hidden on mobile -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 hidden sm:block"></div>
            <div class="absolute bottom-0 left-1/2 w-32 h-32 bg-white/5 rounded-full translate-y-1/2 hidden sm:block"></div>
        </div>

        <!-- Quick Stats Row -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
            <x-ui.StatsCard 
                icon="/assets/icons/box.svg"
                label="Total Item"
                value="156"
                trend="up"
                trendValue="+12%"
                variant="success"
            />
            <x-ui.StatsCard 
                icon="/assets/icons/kesehatan.svg"
                label="Stok Kritis"
                value="8"
                trend="down"
                trendValue="-3"
                variant="danger"
            />
            <x-ui.StatsCard 
                icon="/assets/icons/note.svg"
                label="Pemakaian Bulan Ini"
                value="234"
                variant="info"
            />
            <x-ui.StatsCard 
                icon="/assets/icons/pakan.svg"
                label="Item Kedaluwarsa"
                value="2"
                variant="warning"
            />
        </div>

        <!-- Menu Inventaris -->
        <div class="bg-white border rounded-xl sm:rounded-2xl p-4 sm:p-5 shadow-sm mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base sm:text-lg font-semibold text-gray-800">Menu Inventaris</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <x-ui.MenuButton
                    href="{{ route('admin.inventory.gudang.index') }}"
                    icon="/assets/icons/box.svg"
                    title="Data Gudang"
                    description="Lihat daftar barang di gudang, status, dan stok terkini."
                    iconVariant="green"
                    variant="primary_1" />

                <x-ui.MenuButton
                    href="{{ route('admin.inventory.pemakaian.index') }}"
                    icon="/assets/icons/note.svg"
                    title="Riwayat Pemakaian"
                    description="Catat penggunaan stok item."
                    iconVariant="yellow"
                    variant="yellow_1" />

                <x-ui.MenuButton
                    href="{{ route('admin.inventory.create') }}"
                    icon="/assets/icons/add.svg"
                    title="Barang Baru"
                    description="Tambahkan item baru ke gudang."
                    iconVariant="blue"
                    variant="accent_1" />

                <x-ui.MenuButton
                    href="{{ route('admin.inventory.stok.create') }}"
                    icon="/assets/icons/add-square.svg"
                    title="Tambah Stok"
                    description="Catat penambahan stok dari pembelian atau panen."
                    iconVariant="yellow"
                    variant="yellow_1" />
            </div>
        </div>

        <!-- Ringkasan Inventaris -->
        <div class="bg-white border rounded-xl sm:rounded-2xl p-4 sm:p-5 shadow-sm mb-6">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-3">Ringkasan Inventaris</h3>
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 p-3 sm:p-4 bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl border border-emerald-100">
                <div class="p-2 bg-emerald-500 rounded-lg shrink-0 w-fit">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500 text-white mr-2">
                        Aman
                    </span>
                    <span class="text-sm sm:text-base text-gray-700">Semua kebutuhan pakan/obat cukup untuk ≥10 hari ke depan.</span>
                </div>
            </div>
        </div>

        <!-- Analytics Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-6">
            
            <!-- Grafik Konsumsi -->
            <div class="bg-white border rounded-xl sm:rounded-2xl p-4 sm:p-5 shadow-sm">
                <div class="flex items-center justify-between mb-4 gap-2">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800">Grafik Konsumsi</h3>
                    <button 
                        @click="showKonsumsiModal = true"
                        class="inline-flex items-center gap-1.5 sm:gap-2 px-2 sm:px-3 py-1.5 text-xs sm:text-sm font-medium text-primary-4 bg-primary-1 rounded-lg hover:bg-primary-2 transition shrink-0"
                    >
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        <span class="hidden sm:inline">Edit Grafik</span>
                        <span class="sm:hidden">Edit</span>
                    </button>
                </div>
                
                <div class="h-64">
                    <canvas id="chartKonsumsi"></canvas>
                </div>
                
                <!-- Legend -->
                <div class="flex flex-wrap items-center justify-center gap-4 mt-4 text-sm">
                    <template x-for="variable in konsumsiConfig.variables.filter(v => v.enabled)" :key="variable.id">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full" :style="'background-color: ' + variable.color"></span>
                            <span class="text-gray-600" x-text="variable.label"></span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Ringkasan Stok -->
            <div class="bg-white border rounded-xl sm:rounded-2xl p-4 sm:p-5 shadow-sm">
                <div class="flex items-center justify-between mb-4 gap-2">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800">Ringkasan Stok</h3>
                    <button 
                        @click="showStokModal = true"
                        class="inline-flex items-center gap-1.5 sm:gap-2 px-2 sm:px-3 py-1.5 text-xs sm:text-sm font-medium text-primary-4 bg-primary-1 rounded-lg hover:bg-primary-2 transition shrink-0"
                    >
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        <span class="hidden sm:inline">Edit Grafik</span>
                        <span class="sm:hidden">Edit</span>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <template x-for="variable in stokConfig.variables.filter(v => v.enabled)" :key="variable.id">
                        <div class="w-full">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-sm font-medium text-gray-700" x-text="variable.label"></span>
                                <span class="text-sm font-semibold text-gray-900" x-text="variable.value + '%'"></span>
                            </div>
                            <div class="relative w-full rounded-full overflow-hidden"
                                 :class="[
                                     variable.value >= 70 ? 'bg-emerald-100' : (variable.value >= 40 ? 'bg-amber-100' : 'bg-red-100'),
                                     stokConfig.barSize === 'sm' ? 'h-2' : (stokConfig.barSize === 'lg' ? 'h-5' : 'h-3')
                                 ]">
                                <div class="absolute inset-y-0 left-0 rounded-full transition-all duration-500"
                                     :style="'width: ' + Math.min(variable.value, 100) + '%; background-color: ' + variable.color">
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="bg-white border rounded-xl sm:rounded-2xl p-4 sm:p-5 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base sm:text-lg font-semibold text-gray-800">Aktivitas Terbaru</h3>
                <a href="#" class="text-xs sm:text-sm text-primary-4 hover:text-primary-5 font-medium transition">
                    Lihat semua
                </a>
            </div>
            
            <div class="space-y-3">
                <x-ui.ActivityItem 
                    name="Pak Heri"
                    action="telah menambahkan stok Protein"
                    time="Jumat, 19 September 2025 | 16.00"
                    href="#"
                />
                <x-ui.ActivityItem 
                    name="Pak Heri"
                    action="telah menambahkan stok Konsentrat"
                    time="Jumat, 19 September 2025 | 16.00"
                    href="#"
                />
                <x-ui.ActivityItem 
                    name="Bu Sari"
                    action="telah mencatat pemakaian Vitamin"
                    time="Kamis, 18 September 2025 | 14.30"
                    href="#"
                />
            </div>
        </div>
    </main>

    <!-- Modal Edit Grafik Konsumsi -->
    <div 
        x-show="showKonsumsiModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
        @click.self="showKonsumsiModal = false"
        style="display: none;"
    >
        <div 
            x-show="showKonsumsiModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-xl max-h-[90vh] overflow-hidden"
        >
            <!-- Header -->
            <div class="flex items-center justify-between p-5 border-b bg-gradient-to-r from-emerald-500 to-green-500">
                <div>
                    <h3 class="text-lg font-semibold text-white">Pengaturan Grafik Konsumsi</h3>
                    <p class="text-emerald-100 text-sm">Atur tampilan dan variabel diagram</p>
                </div>
                <button @click="showKonsumsiModal = false" class="p-1 rounded-full hover:bg-white/20 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Body -->
            <div class="p-5 max-h-[60vh] overflow-y-auto space-y-6">
                
                <!-- Tipe Chart -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Tipe Diagram</label>
                    <div class="grid grid-cols-3 gap-3">
                        <template x-for="type in chartTypes" :key="type.id">
                            <button 
                                @click="konsumsiConfig.chartType = type.id"
                                class="p-3 rounded-xl border-2 transition-all flex flex-col items-center gap-2"
                                :class="konsumsiConfig.chartType === type.id ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-gray-300'"
                            >
                                <div x-html="type.icon" class="w-8 h-8 text-gray-600"></div>
                                <span class="text-xs font-medium text-gray-700" x-text="type.label"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Info -->
                <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-100 mb-4">
                    <p class="text-sm text-emerald-700">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Pilih kategori inventaris dari database untuk ditampilkan di grafik.
                    </p>
                </div>

                <!-- Variabel dari Database -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Kategori Inventaris</label>
                    <div class="space-y-2 max-h-48 overflow-y-auto pr-1 border rounded-xl p-2 bg-white">
                        <template x-for="(variable, index) in konsumsiConfig.variables" :key="variable.id">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex items-center gap-3">
                                    <input 
                                        type="checkbox" 
                                        x-model="variable.enabled"
                                        class="w-4 h-4 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500"
                                    >
                                    <span class="text-sm font-medium text-gray-700" x-text="variable.label"></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <label class="text-xs text-gray-500">Warna:</label>
                                    <input 
                                        type="color" 
                                        x-model="variable.color"
                                        class="w-8 h-8 rounded cursor-pointer border-0"
                                    >
                                </div>
                            </div>
                        </template>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Scroll untuk melihat lebih banyak kategori</p>
                </div>

                <!-- Pengaturan Tampilan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pengaturan Tampilan</label>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Tampilkan Grid</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="konsumsiConfig.showGrid" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-emerald-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Tampilkan Titik Data</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="konsumsiConfig.showPoints" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-emerald-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Isi Area di Bawah Garis</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="konsumsiConfig.fillArea" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-emerald-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Garis Halus (Curved)</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="konsumsiConfig.smoothLine" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-emerald-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Rentang Waktu -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Rentang Waktu</label>
                    <select 
                        x-model="konsumsiConfig.timeRange"
                        class="w-full px-4 py-2.5 border rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    >
                        <option value="7days">7 Hari Terakhir</option>
                        <option value="30days">30 Hari Terakhir</option>
                        <option value="3months">3 Bulan Terakhir</option>
                        <option value="6months">6 Bulan Terakhir</option>
                        <option value="1year">1 Tahun Terakhir</option>
                    </select>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 p-5 border-t bg-gray-50">
                <button 
                    @click="showKonsumsiModal = false"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded-lg hover:bg-gray-50 transition"
                >
                    Batal
                </button>
                <button 
                    @click="applyKonsumsiConfig(); showKonsumsiModal = false"
                    class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-emerald-500 to-green-500 rounded-lg hover:from-emerald-600 hover:to-green-600 transition shadow-lg"
                >
                    Terapkan Perubahan
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Edit Ringkasan Stok -->
    <div 
        x-show="showStokModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
        @click.self="showStokModal = false"
        style="display: none;"
    >
        <div 
            x-show="showStokModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-xl max-h-[90vh] overflow-hidden"
        >
            <!-- Header -->
            <div class="flex items-center justify-between p-5 border-b bg-gradient-to-r from-blue-500 to-indigo-500">
                <div>
                    <h3 class="text-lg font-semibold text-white">Pengaturan Ringkasan Stok</h3>
                    <p class="text-blue-100 text-sm">Pilih item inventaris yang ingin ditampilkan</p>
                </div>
                <button @click="showStokModal = false" class="p-1 rounded-full hover:bg-white/20 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Body -->
            <div class="p-5 max-h-[60vh] overflow-y-auto space-y-6">
                
                <!-- Info -->
                <div class="p-3 bg-blue-50 rounded-xl border border-blue-100 mb-4">
                    <p class="text-sm text-blue-700">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Variabel berikut diambil dari data inventaris di database.
                    </p>
                </div>
                
                <!-- Variabel dari Database -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Item Inventaris</label>
                    <div class="space-y-2 max-h-48 overflow-y-auto pr-1 border rounded-xl p-2 bg-white">
                        <template x-for="(variable, index) in stokConfig.variables" :key="variable.id">
                            <div class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <input 
                                            type="checkbox" 
                                            x-model="variable.enabled"
                                            class="w-4 h-4 rounded border-gray-300 text-blue-500 focus:ring-blue-500"
                                        >
                                        <div>
                                            <span class="text-sm font-medium text-gray-700" x-text="variable.label"></span>
                                            <span class="text-xs text-gray-400 ml-2" x-text="'(' + variable.value + '%)'">
                                            </span>
                                        </div>
                                    </div>
                                    <input 
                                        type="color" 
                                        x-model="variable.color"
                                        class="w-7 h-7 rounded cursor-pointer border-0"
                                    >
                                </div>
                            </div>
                        </template>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Scroll untuk melihat lebih banyak item</p>
                </div>



                <!-- Pengaturan Tampilan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pengaturan Tampilan</label>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Tampilkan Persentase</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="stokConfig.showPercentage" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Warna Otomatis (berdasarkan level)</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="stokConfig.autoColor" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-700">Ukuran Bar</span>
                            </div>
                            <select 
                                x-model="stokConfig.barSize"
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                            >
                                <option value="sm">Kecil</option>
                                <option value="md">Sedang</option>
                                <option value="lg">Besar</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 p-5 border-t bg-gray-50">
                <button 
                    @click="showStokModal = false"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded-lg hover:bg-gray-50 transition"
                >
                    Batal
                </button>
                <button 
                    @click="showStokModal = false"
                    class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg hover:from-blue-600 hover:to-indigo-600 transition shadow-lg"
                >
                    Terapkan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function inventoryDashboard() {
    return {
        open: false,
        showKonsumsiModal: false,
        showStokModal: false,
        chartInstance: null,
        
        chartTypes: [
            { 
                id: 'line', 
                label: 'Line', 
                icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>' 
            },
            { 
                id: 'bar', 
                label: 'Bar', 
                icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="12" width="4" height="8"/><rect x="10" y="8" width="4" height="12"/><rect x="17" y="4" width="4" height="16"/></svg>' 
            },
            { 
                id: 'area', 
                label: 'Area', 
                icon: '<svg viewBox="0 0 24 24" fill="currentColor" opacity="0.3"><path d="M2 20 L2 12 L6 12 L9 3 L15 21 L18 12 L22 12 L22 20 Z"/></svg>' 
            },
        ],
        
        konsumsiConfig: {
            chartType: 'line',
            timeRange: '6months',
            showGrid: true,
            showPoints: true,
            fillArea: true,
            smoothLine: true,
            variables: [
                { id: 'konsentrat', label: 'Konsentrat', color: '#10B981', enabled: true, dataSource: 'inventory_usage' },
                { id: 'protein', label: 'Protein', color: '#3B82F6', enabled: true, dataSource: 'inventory_usage' },
                { id: 'pelet', label: 'Pelet', color: '#8B5CF6', enabled: true, dataSource: 'inventory_usage' },
            ]
        },
        
        stokConfig: {
            showPercentage: true,
            autoColor: true,
            barSize: 'md',
            variables: [
                { id: 'konsentrat', label: 'Konsentrat', color: '#10B981', enabled: true, value: 70, dataSource: 'inventory_stock' },
                { id: 'protein', label: 'Protein', color: '#3B82F6', enabled: true, value: 110, dataSource: 'inventory_stock' },
                { id: 'pelet', label: 'Pelet', color: '#F59E0B', enabled: true, value: 60, dataSource: 'inventory_stock' },
                { id: 'vitamin', label: 'Vitamin', color: '#EF4444', enabled: true, value: 30, dataSource: 'inventory_stock' },
            ]
        },
        
        // Sample data - in production this would come from database based on config
        chartData: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            konsentrat: [1200, 1150, 1300, 1250, 1400, 1450],
            protein: [800, 850, 900, 920, 980, 1000],
            pelet: [400, 420, 450, 440, 480, 500]
        },
        
        init() {
            this.$nextTick(() => {
                this.initChart();
            });
        },
        
        initChart() {
            const ctx = document.getElementById('chartKonsumsi');
            if (ctx) {
                this.chartInstance = new Chart(ctx, this.getChartConfig());
            }
        },
        
        getChartConfig() {
            const enabledVars = this.konsumsiConfig.variables.filter(v => v.enabled);
            const isArea = this.konsumsiConfig.chartType === 'area';
            
            const datasets = enabledVars.map(variable => ({
                label: variable.label,
                data: this.chartData[variable.id] || [],
                borderColor: variable.color,
                // Area chart uses 60% opacity, Line chart uses 12% opacity
                backgroundColor: isArea ? variable.color + '99' : variable.color + '20',
                borderWidth: isArea ? 1 : 2,
                tension: this.konsumsiConfig.smoothLine ? 0.4 : 0,
                // Area chart always fills, Line chart uses fillArea setting
                fill: isArea ? true : this.konsumsiConfig.fillArea,
                pointRadius: this.konsumsiConfig.showPoints ? 4 : 0,
                pointBackgroundColor: variable.color,
            }));

            return {
                type: this.konsumsiConfig.chartType === 'area' ? 'line' : this.konsumsiConfig.chartType,
                data: {
                    labels: this.chartData.labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            padding: 12,
                            cornerRadius: 8,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            grid: { 
                                display: this.konsumsiConfig.showGrid,
                                color: 'rgba(0, 0, 0, 0.05)' 
                            },
                            ticks: { color: '#6B7280' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#6B7280' }
                        }
                    },
                    interaction: { intersect: false, mode: 'index' },
                }
            };
        },
        
        applyKonsumsiConfig() {
            if (this.chartInstance) {
                this.chartInstance.destroy();
            }
            this.initChart();
        }
    }
}
</script>

@endsection