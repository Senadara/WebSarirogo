@extends('layouts.admin')

@section('content')
<div x-data="addStockForm()" class="flex bg-gray-50 min-h-screen overflow-x-hidden">

    @include('components.layouts.sidebar')

    <main class="flex-1 p-4 lg:p-8 lg:ml-72 max-w-full">
        
        <!-- Mobile Topbar -->
        <div class="flex items-center justify-between mb-4 lg:hidden">
            <div class="flex items-center gap-3">
                <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                    <img src="/assets/icons/menu.svg" class="w-6 h-6">
                </button>
                <div>
                    <h1 class="text-lg font-bold text-gray-900">Tambah Stok</h1>
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

        <!-- Breadcrumb & Actions (Desktop) -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <img src="/assets/icons/home.svg" class="w-4 h-4">
                <span>/</span>
                <a href="{{ route('admin.inventory.index') }}" class="hover:text-emerald-600 transition">Inventaris</a>
                <span>/</span>
                <span class="font-semibold text-gray-900">Tambah Stok</span>
            </div>

            <div class="hidden lg:flex items-center gap-4">
                <button class="relative p-2 rounded-full hover:bg-gray-100 transition">
                    <img src="/assets/icons/notification.svg" class="w-5 h-5">
                    <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full animate-pulse"></span>
                </button>
                <button class="p-2 rounded-full hover:bg-gray-100 transition">
                    <img src="/assets/icons/user.svg" class="w-5 h-5">
                </button>
            </div>
        </div>

        <!-- Page Title -->
        <div class="mb-6 lg:mb-8">
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">Tambah Stok Barang</h1>
            <p class="text-gray-600 hidden lg:block">
                Catat penambahan stok barang masuk ke gudang.
            </p>
        </div>

        <!-- Horizontal Step Indicator (2 Steps) -->
        <div class="bg-accent-1 rounded-2xl p-4 md:p-6 mb-6">
            <div class="flex items-center justify-center max-w-sm mx-auto">
                <!-- Step 1 -->
                <div class="flex flex-col items-center flex-shrink-0">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center transition-all"
                         :class="currentStep > 1 ? 'bg-accent-3' : (currentStep === 1 ? 'border-2 border-accent-3 bg-white' : 'border-2 border-gray-300 bg-white')">
                        <template x-if="currentStep > 1">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </template>
                        <template x-if="currentStep === 1">
                            <div class="w-3 h-3 rounded-full bg-accent-3"></div>
                        </template>
                    </div>
                    <span class="text-xs mt-1.5 text-gray-600 font-medium whitespace-nowrap">Input Data</span>
                </div>
                
                <!-- Connector -->
                <div class="w-20 sm:w-32 md:w-40 h-0.5 mx-2 md:mx-4 mb-5 transition-all"
                     :class="currentStep > 1 ? 'bg-accent-3' : 'bg-gray-300'"></div>
                
                <!-- Step 2 -->
                <div class="flex flex-col items-center flex-shrink-0">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center transition-all"
                         :class="currentStep === 2 ? 'border-2 border-accent-3 bg-white' : 'border-2 border-gray-300 bg-white'">
                        <template x-if="currentStep === 2">
                            <div class="w-3 h-3 rounded-full bg-accent-3"></div>
                        </template>
                    </div>
                    <span class="text-xs mt-1.5 text-gray-600 font-medium whitespace-nowrap">Konfirmasi</span>
                </div>
            </div>
            
            <p class="text-center text-xs md:text-sm text-gray-600 mt-3 md:mt-4 px-2" x-text="stepDescriptions[currentStep - 1]"></p>
        </div>

        <!-- Form Container -->
        <div class="max-w-3xl mx-auto">
            <form @submit.prevent="submitForm">
                
                <!-- Step 1: Input Data -->
                <div x-show="currentStep === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="bg-white rounded-2xl border shadow-sm p-6 lg:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Data Stok Masuk</h2>
                                <p class="text-sm text-gray-500">Masukkan informasi penambahan stok</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <!-- Pilih Barang -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pilih Barang <span class="text-red-500">*</span>
                                </label>
                                <select x-model="form.barangId" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition appearance-none bg-white">
                                    <option value="">-- Pilih Barang --</option>
                                    <template x-for="barang in barangList" :key="barang.id">
                                        <option :value="barang.id" x-text="barang.nama + ' (' + barang.stokSekarang + ' ' + barang.satuan + ')'"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- Info Barang Terpilih -->
                            <div x-show="selectedBarang" class="bg-emerald-50 rounded-xl p-4 border border-emerald-200">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900" x-text="selectedBarang?.nama || '-'"></h4>
                                        <p class="text-sm text-gray-600" x-text="'SKU: ' + (selectedBarang?.sku || '-')"></p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-3 text-sm">
                                    <div>
                                        <span class="text-gray-500">Stok Saat Ini:</span>
                                        <span class="font-medium text-gray-900 ml-1" x-text="(selectedBarang?.stokSekarang || 0) + ' ' + (selectedBarang?.satuan || '')"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Kategori:</span>
                                        <span class="font-medium text-gray-900 ml-1" x-text="selectedBarang?.kategori || '-'"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Jumlah Stok -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Jumlah Stok Masuk <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex gap-2">
                                        <input type="number" x-model="form.jumlah" placeholder="0" min="1"
                                               class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                        <span class="px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl text-gray-600 font-medium" x-text="selectedBarang?.satuan || 'Unit'"></span>
                                    </div>
                                </div>

                                <!-- Tanggal Masuk -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Masuk <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" x-model="form.tanggal"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Supplier -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Supplier
                                    </label>
                                    <input type="text" x-model="form.supplier" placeholder="Nama supplier (opsional)"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                </div>

                                <!-- No. Dokumen -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        No. Dokumen Referensi
                                    </label>
                                    <input type="text" x-model="form.noDokumen" placeholder="No. PO / Invoice (opsional)"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                </div>
                            </div>

                            <!-- Harga Beli -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Harga Beli Total
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                                    <input type="number" x-model="form.hargaBeli" placeholder="0" min="0"
                                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Total harga pembelian untuk stok ini (opsional)</p>
                            </div>

                            <!-- Catatan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Catatan
                                </label>
                                <textarea x-model="form.catatan" rows="3" placeholder="Catatan tambahan (opsional)"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition resize-none"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Konfirmasi -->
                <div x-show="currentStep === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="bg-white rounded-2xl border shadow-sm p-6 lg:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Konfirmasi Penambahan Stok</h2>
                                <p class="text-sm text-gray-500">Periksa kembali data sebelum menyimpan</p>
                            </div>
                        </div>

                        <!-- Summary Card -->
                        <div class="bg-gradient-to-br from-emerald-50 to-blue-50 rounded-xl p-6 border border-emerald-200 mb-6">
                            <div class="flex items-center gap-4 mb-4 pb-4 border-b border-emerald-200">
                                <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900" x-text="selectedBarang?.nama || '-'"></h3>
                                    <p class="text-sm text-gray-600" x-text="'SKU: ' + (selectedBarang?.sku || '-')"></p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white rounded-lg p-4 text-center">
                                    <p class="text-sm text-gray-500 mb-1">Stok Sebelum</p>
                                    <p class="text-2xl font-bold text-gray-900" x-text="(selectedBarang?.stokSekarang || 0) + ' ' + (selectedBarang?.satuan || '')"></p>
                                </div>
                                <div class="bg-emerald-500 rounded-lg p-4 text-center text-white">
                                    <p class="text-sm opacity-90 mb-1">Stok Setelah</p>
                                    <p class="text-2xl font-bold" x-text="(parseInt(selectedBarang?.stokSekarang || 0) + parseInt(form.jumlah || 0)) + ' ' + (selectedBarang?.satuan || '')"></p>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-t border-emerald-200">
                                <div class="flex items-center justify-center gap-2 text-emerald-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    <span class="font-semibold" x-text="'+ ' + (form.jumlah || 0) + ' ' + (selectedBarang?.satuan || 'unit')"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Info -->
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-600">Tanggal Masuk</span>
                                <span class="font-medium text-gray-900" x-text="form.tanggal || '-'"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-600">Supplier</span>
                                <span class="font-medium text-gray-900" x-text="form.supplier || '-'"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-600">No. Dokumen</span>
                                <span class="font-medium text-gray-900" x-text="form.noDokumen || '-'"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-600">Harga Beli</span>
                                <span class="font-medium text-gray-900" x-text="form.hargaBeli ? 'Rp ' + parseInt(form.hargaBeli).toLocaleString('id-ID') : '-'"></span>
                            </div>
                            <template x-if="form.catatan">
                                <div class="py-2">
                                    <span class="text-gray-600 block mb-1">Catatan:</span>
                                    <p class="text-gray-900" x-text="form.catatan"></p>
                                </div>
                            </template>
                        </div>

                        <!-- Warning -->
                        <div class="mt-6 p-4 bg-amber-50 rounded-xl border border-amber-200">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                <div>
                                    <p class="text-sm font-medium text-amber-800">Pastikan data sudah benar</p>
                                    <p class="text-xs text-amber-700 mt-1">Stok akan langsung bertambah setelah disimpan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6 bg-white rounded-2xl border shadow-sm p-4 lg:p-6">
                    <button type="button" 
                            @click="currentStep > 1 ? currentStep-- : window.location.href = '{{ route('admin.inventory.gudang.index') }}'"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <span x-text="currentStep > 1 ? 'Kembali' : 'Batal'"></span>
                    </button>
                    
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <template x-if="currentStep < 2">
                            <button type="button" @click="currentStep++"
                                    :disabled="!form.barangId || !form.jumlah || !form.tanggal"
                                    :class="(!form.barangId || !form.jumlah || !form.tanggal) ? 'opacity-50 cursor-not-allowed' : ''"
                                    class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-medium rounded-xl transition shadow-sm shadow-emerald-200">
                                Lanjutkan
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </template>
                        <template x-if="currentStep === 2">
                            <button type="submit"
                                    class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-medium rounded-xl transition shadow-sm shadow-emerald-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Stok
                            </button>
                        </template>
                    </div>
                </div>
            </form>
        </div>

    </main>
</div>

<script>
function addStockForm() {
    return {
        open: false,
        currentStep: 1,
        stepDescriptions: [
            'Pilih barang dan masukkan jumlah stok yang akan ditambahkan.',
            'Periksa kembali data penambahan stok sebelum menyimpan.'
        ],
        barangList: [
            { id: 1, nama: 'Pupuk NPK Premium', sku: 'PUP-001', stokSekarang: 85, satuan: 'sak', kategori: 'Pupuk' },
            { id: 2, nama: 'Pakan Ayam Petelur', sku: 'PKN-001', stokSekarang: 120, satuan: 'kg', kategori: 'Pakan' },
            { id: 3, nama: 'Vitamin Unggas', sku: 'VIT-001', stokSekarang: 45, satuan: 'botol', kategori: 'Obat' },
            { id: 4, nama: 'Benih Jagung Hibrida', sku: 'BNH-001', stokSekarang: 30, satuan: 'kg', kategori: 'Bibit' },
            { id: 5, nama: 'Pestisida Organik', sku: 'PST-001', stokSekarang: 25, satuan: 'liter', kategori: 'Obat' }
        ],
        form: {
            barangId: '',
            jumlah: '',
            tanggal: new Date().toISOString().split('T')[0],
            supplier: '',
            noDokumen: '',
            hargaBeli: '',
            catatan: ''
        },
        
        get selectedBarang() {
            return this.barangList.find(b => b.id == this.form.barangId) || null;
        },
        
        submitForm() {
            console.log('Stock Added:', {
                barang: this.selectedBarang,
                ...this.form
            });
            
            alert('Stok berhasil ditambahkan!');
            window.location.href = '{{ route('admin.inventory.gudang.index') }}';
        }
    }
}
</script>
@endsection