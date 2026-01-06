@extends('layouts.admin')

@section('content')
<div x-data="editItemForm()" class="flex bg-gray-50 min-h-screen overflow-x-hidden">

    @include('components.layouts.sidebar')

    <main class="flex-1 p-4 lg:p-8 lg:ml-72 max-w-full">
        
        <!-- Mobile Topbar -->
        <div class="flex items-center justify-between mb-4 lg:hidden">
            <div class="flex items-center gap-3">
                <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                    <img src="/assets/icons/menu.svg" class="w-6 h-6">
                </button>
                <div>
                    <h1 class="text-lg font-bold text-gray-900">Edit Barang</h1>
                    <div class="flex items-center gap-1 text-xs text-gray-500">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                        <span>Inventaris</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                @include('components.ui.notification-bell')
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
                <a href="{{ route('admin.inventory.gudang.index') }}" class="hover:text-emerald-600 transition">Data Gudang</a>
                <span>/</span>
                <span class="font-semibold text-gray-900">Edit Barang</span>
            </div>

            <div class="hidden lg:flex items-center gap-4">
                @include('components.ui.notification-bell')
                <button class="p-2 rounded-full hover:bg-gray-100 transition">
                    <img src="/assets/icons/user.svg" class="w-5 h-5">
                </button>
            </div>
        </div>

        <!-- Page Title -->
        <div class="mb-6 lg:mb-8">
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">Edit Data Barang</h1>
            <p class="text-gray-600 hidden lg:block">
                Perbarui informasi barang yang sudah tersimpan di gudang.
            </p>
        </div>

        <!-- Horizontal Step Indicator -->
        <div class="bg-accent-1 rounded-2xl p-4 md:p-6 mb-6">
            <div class="flex items-center justify-center max-w-lg mx-auto">
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
                    <span class="text-xs mt-1.5 text-gray-600 font-medium whitespace-nowrap">Info Utama</span>
                </div>
                
                <!-- Connector 1-2 -->
                <div class="w-12 sm:w-16 md:w-20 h-0.5 mx-1 md:mx-2 mb-5 transition-all"
                     :class="currentStep > 1 ? 'bg-accent-3' : 'bg-gray-300'"></div>
                
                <!-- Step 2 -->
                <div class="flex flex-col items-center flex-shrink-0">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center transition-all"
                         :class="currentStep > 2 ? 'bg-accent-3' : (currentStep === 2 ? 'border-2 border-accent-3 bg-white' : 'border-2 border-gray-300 bg-white')">
                        <template x-if="currentStep > 2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </template>
                        <template x-if="currentStep === 2">
                            <div class="w-3 h-3 rounded-full bg-accent-3"></div>
                        </template>
                    </div>
                    <span class="text-xs mt-1.5 text-gray-600 font-medium whitespace-nowrap">Spesifikasi</span>
                </div>
                
                <!-- Connector 2-3 -->
                <div class="w-12 sm:w-16 md:w-20 h-0.5 mx-1 md:mx-2 mb-5 transition-all"
                     :class="currentStep > 2 ? 'bg-accent-3' : 'bg-gray-300'"></div>
                
                <!-- Step 3 -->
                <div class="flex flex-col items-center flex-shrink-0">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center transition-all"
                         :class="currentStep > 3 ? 'bg-accent-3' : (currentStep === 3 ? 'border-2 border-accent-3 bg-white' : 'border-2 border-gray-300 bg-white')">
                        <template x-if="currentStep > 3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </template>
                        <template x-if="currentStep === 3">
                            <div class="w-3 h-3 rounded-full bg-accent-3"></div>
                        </template>
                    </div>
                    <span class="text-xs mt-1.5 text-gray-600 font-medium whitespace-nowrap">Logistik</span>
                </div>
                
                <!-- Connector 3-4 -->
                <div class="w-12 sm:w-16 md:w-20 h-0.5 mx-1 md:mx-2 mb-5 transition-all"
                     :class="currentStep > 3 ? 'bg-accent-3' : 'bg-gray-300'"></div>
                
                <!-- Step 4 -->
                <div class="flex flex-col items-center flex-shrink-0">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center transition-all"
                         :class="currentStep === 4 ? 'border-2 border-accent-3 bg-white' : 'border-2 border-gray-300 bg-white'">
                        <template x-if="currentStep === 4">
                            <div class="w-3 h-3 rounded-full bg-accent-3"></div>
                        </template>
                    </div>
                    <span class="text-xs mt-1.5 text-gray-600 font-medium whitespace-nowrap">Simpan</span>
                </div>
            </div>
            
            <p class="text-center text-xs md:text-sm text-gray-600 mt-3 md:mt-4 px-2" x-text="stepDescriptions[currentStep - 1]"></p>
        </div>

        <!-- Form Container -->
        <div class="max-w-4xl mx-auto">

            <!-- Form Content -->
                <form @submit.prevent="submitForm">
                    
                    <!-- Step 1: Informasi Utama -->
                    <div x-show="currentStep === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="bg-white rounded-2xl border shadow-sm p-6 lg:p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Informasi Utama</h2>
                                    <p class="text-sm text-gray-500">Data dasar barang yang akan diperbarui</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Nama Barang -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Barang <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" x-model="form.nama" placeholder="Contoh: Pelet Pakan Ayam Petelur" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                </div>

                                <!-- Merek Barang -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Merek Barang
                                    </label>
                                    <input type="text" x-model="form.merek" placeholder="Contoh: NPK Gold" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                </div>

                                <!-- Kategori -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Kategori <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex gap-2">
                                        <select x-model="form.kategori" 
                                                class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition appearance-none bg-white">
                                            <option value="">Pilih Kategori</option>
                                            <option value="Pupuk">Pupuk</option>
                                            <option value="Pakan">Pakan</option>
                                            <option value="Bibit">Bibit</option>
                                            <option value="Peralatan">Peralatan</option>
                                            <option value="Obat">Obat & Vitamin</option>
                                            <option value="Panen">Hasil Panen</option>
                                        </select>
                                        <button type="button" class="px-4 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Satuan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Satuan <span class="text-red-500">*</span>
                                    </label>
                                    <select x-model="form.satuan" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition appearance-none bg-white">
                                        <option value="">Pilih Satuan</option>
                                        <option value="kg">Kilogram (kg)</option>
                                        <option value="gram">Gram (g)</option>
                                        <option value="liter">Liter (L)</option>
                                        <option value="sak">Sak</option>
                                        <option value="karung">Karung</option>
                                        <option value="pcs">Pieces (pcs)</option>
                                        <option value="unit">Unit</option>
                                    </select>
                                </div>

                                <!-- Total Stok Masuk -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Total Stok Masuk <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" x-model="form.stokMasuk" placeholder="0" min="0"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                </div>

                                <!-- Jumlah Stok Sekarang -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Jumlah Stok Sekarang <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" x-model="form.stokSekarang" placeholder="0" min="0"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                </div>

                                <!-- Estimasi Pemakaian Harian -->
                                <div class="lg:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Estimasi Pemakaian Harian
                                    </label>
                                    <input type="number" x-model="form.pemakaianHarian" placeholder="0" min="0"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                    <p class="text-xs text-gray-500 mt-1">Perkiraan jumlah pemakaian per hari untuk estimasi ketersediaan stok</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Spesifikasi -->
                    <div x-show="currentStep === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="bg-white rounded-2xl border shadow-sm p-6 lg:p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Spesifikasi</h2>
                                    <p class="text-sm text-gray-500">Detail teknis dan informasi harga</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Jenis Barang -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Jenis Barang <span class="text-red-500">*</span>
                                    </label>
                                    <select x-model="form.jenisBarang" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition appearance-none bg-white">
                                        <option value="">Pilih Jenis</option>
                                        <option value="Habis Pakai">Habis Pakai</option>
                                        <option value="Tidak Habis Pakai">Tidak Habis Pakai</option>
                                        <option value="Aset Tetap">Aset Tetap</option>
                                    </select>
                                </div>

                                <!-- Harga Beli per Satuan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Harga Beli per Satuan <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                                        <input type="number" x-model="form.harga" placeholder="0" min="0"
                                               class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                    </div>
                                </div>

                                <!-- Tanggal Kadaluarsa -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Kadaluarsa
                                    </label>
                                    <input type="date" x-model="form.kadaluarsa"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ada tanggal kadaluarsa</p>
                                </div>

                                <!-- Upload Gambar -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Gambar Produk
                                    </label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-emerald-500 transition cursor-pointer">
                                        <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="text-sm text-gray-500">Klik untuk upload gambar</p>
                                        <p class="text-xs text-gray-400">PNG, JPG max 2MB</p>
                                    </div>
                                </div>

                                <!-- Komposisi Nutrisi -->
                                <div class="lg:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Komposisi / Nutrisi
                                    </label>
                                    
                                    <!-- Nutrisi Items -->
                                    <div class="space-y-3 mb-3">
                                        <template x-for="(item, index) in nutrisiItems" :key="index">
                                            <div class="flex items-center gap-2 bg-gray-50 rounded-xl p-3 border">
                                                <div class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-2">
                                                    <input type="text" 
                                                           x-model="item.nama" 
                                                           placeholder="Nama (contoh: Protein)"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                                    <input type="text" 
                                                           x-model="item.nilai" 
                                                           placeholder="Nilai (contoh: 18)"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                                    <select x-model="item.satuan"
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                                                        <option value="">Satuan</option>
                                                        <option value="%">Persen (%)</option>
                                                        <option value="g">Gram (g)</option>
                                                        <option value="mg">Miligram (mg)</option>
                                                        <option value="kg">Kilogram (kg)</option>
                                                        <option value="ml">Mililiter (ml)</option>
                                                        <option value="L">Liter (L)</option>
                                                        <option value="ppm">PPM</option>
                                                        <option value="kcal">Kkal</option>
                                                        <option value="IU">IU</option>
                                                    </select>
                                                </div>
                                                <button type="button" 
                                                        @click="removeNutrisi(index)"
                                                        class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition flex-shrink-0">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                    
                                    <!-- Empty state -->
                                    <div x-show="nutrisiItems.length === 0" class="text-center py-4 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                                        <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        <p class="text-sm text-gray-500">Belum ada data komposisi</p>
                                    </div>
                                    
                                    <!-- Add Button -->
                                    <button type="button" 
                                            @click="addNutrisi()"
                                            class="w-full mt-3 flex items-center justify-center gap-2 px-4 py-2.5 border-2 border-dashed border-emerald-300 text-emerald-600 rounded-xl hover:bg-emerald-50 hover:border-emerald-400 transition font-medium text-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                        Tambah Komposisi
                                    </button>
                                    
                                    <p class="text-xs text-gray-500 mt-2">Masukkan nama dan nilai komposisi/nutrisi barang (opsional)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Informasi Logistik -->
                    <div x-show="currentStep === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="bg-white rounded-2xl border shadow-sm p-6 lg:p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path></svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Informasi Logistik</h2>
                                    <p class="text-sm text-gray-500">Data supplier dan penyimpanan</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Supplier -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Supplier
                                    </label>
                                    <input type="text" x-model="form.supplier" placeholder="Contoh: PT Agro Kimia Indonesia"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                </div>

                                <!-- Tanggal Masuk Gudang -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Masuk Gudang <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" x-model="form.tglMasuk"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                </div>

                                <!-- Lokasi Penyimpanan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Lokasi Penyimpanan
                                    </label>
                                    <select x-model="form.lokasi"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition appearance-none bg-white">
                                        <option value="">Pilih Lokasi</option>
                                        <option value="Gudang A">Gudang A</option>
                                        <option value="Gudang B">Gudang B</option>
                                        <option value="Gudang C">Gudang C</option>
                                        <option value="Rak Penyimpanan">Rak Penyimpanan</option>
                                    </select>
                                </div>

                                <!-- Stok Minimum Alert -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Batas Stok Minimum
                                    </label>
                                    <input type="number" x-model="form.stokMinimum" placeholder="0" min="0"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                    <p class="text-xs text-gray-500 mt-1">Notifikasi akan muncul jika stok di bawah batas ini</p>
                                </div>

                                <!-- Catatan Tambahan -->
                                <div class="lg:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Catatan Tambahan
                                    </label>
                                    <textarea x-model="form.catatan" rows="4" placeholder="Contoh: Disimpan di ruang kering, jauh dari kelembaban dan sinar matahari langsung."
                                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition resize-none"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Review & Simpan -->
                    <div x-show="currentStep === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="bg-white rounded-2xl border shadow-sm p-6 lg:p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Review & Simpan Perubahan</h2>
                                    <p class="text-sm text-gray-500">Periksa kembali data sebelum menyimpan</p>
                                </div>
                            </div>

                            <!-- Review Cards -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Informasi Utama Summary -->
                                <div class="bg-emerald-50 rounded-xl p-5 border border-emerald-100">
                                    <h4 class="font-semibold text-emerald-800 mb-3 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Informasi Utama
                                    </h4>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Nama Barang</span>
                                            <span class="font-medium text-gray-900" x-text="form.nama || '-'"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Merek</span>
                                            <span class="font-medium text-gray-900" x-text="form.merek || '-'"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Kategori</span>
                                            <span class="font-medium text-gray-900" x-text="form.kategori || '-'"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Stok Sekarang</span>
                                            <span class="font-medium text-gray-900" x-text="(form.stokSekarang || 0) + ' ' + (form.satuan || '')"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Spesifikasi Summary -->
                                <div class="bg-blue-50 rounded-xl p-5 border border-blue-100">
                                    <h4 class="font-semibold text-blue-800 mb-3 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                        Spesifikasi
                                    </h4>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Jenis Barang</span>
                                            <span class="font-medium text-gray-900" x-text="form.jenisBarang || '-'"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Harga</span>
                                            <span class="font-medium text-gray-900" x-text="form.harga ? 'Rp ' + parseInt(form.harga).toLocaleString('id-ID') : '-'"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Kadaluarsa</span>
                                            <span class="font-medium text-gray-900" x-text="form.kadaluarsa || '-'"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Logistik Summary -->
                                <div class="bg-purple-50 rounded-xl p-5 border border-purple-100 lg:col-span-2">
                                    <h4 class="font-semibold text-purple-800 mb-3 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path></svg>
                                        Informasi Logistik
                                    </h4>
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Supplier</span>
                                            <span class="font-medium text-gray-900" x-text="form.supplier || '-'"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Tanggal Masuk</span>
                                            <span class="font-medium text-gray-900" x-text="form.tglMasuk || '-'"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Lokasi</span>
                                            <span class="font-medium text-gray-900" x-text="form.lokasi || '-'"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Stok Minimum</span>
                                            <span class="font-medium text-gray-900" x-text="form.stokMinimum || '-'"></span>
                                        </div>
                                    </div>
                                    <template x-if="form.catatan">
                                        <div class="mt-3 pt-3 border-t border-purple-200">
                                            <span class="text-gray-600 text-sm">Catatan:</span>
                                            <p class="text-sm text-gray-900 mt-1" x-text="form.catatan"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Confirmation -->
                            <div class="mt-6 p-4 bg-amber-50 rounded-xl border border-amber-200">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    <div>
                                        <p class="text-sm font-medium text-amber-800">Pastikan semua perubahan sudah benar</p>
                                        <p class="text-xs text-amber-700 mt-1">Data akan diperbarui setelah Anda mengklik tombol Simpan Perubahan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6 bg-white rounded-2xl border shadow-sm p-4 lg:p-6">
                        <button type="button" 
                                @click="currentStep > 1 ? currentStep-- : window.location.href = '{{ route('admin.inventory.gudang.show') }}'"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            <span x-text="currentStep > 1 ? 'Sebelumnya' : 'Batal'"></span>
                        </button>
                        
                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <template x-if="currentStep < 4">
                                <button type="button" @click="currentStep++"
                                        class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-medium rounded-xl transition shadow-sm shadow-emerald-200">
                                    Selanjutnya
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </template>
                            <template x-if="currentStep === 4">
                                <button type="submit"
                                        class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-medium rounded-xl transition shadow-sm shadow-emerald-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Simpan Perubahan
                                </button>
                            </template>
                        </div>
                    </div>
                </form>
        </div>

    </main>
</div>

<script>
function editItemForm() {
    return {
        open: false,
        currentStep: 1,
        stepDescriptions: [
            'Periksa dan perbarui data dasar barang seperti nama, kategori, dan informasi stok.',
            'Perbarui detail spesifikasi teknis dan informasi harga barang.',
            'Perbarui informasi supplier dan lokasi penyimpanan.',
            'Periksa kembali semua perubahan sebelum menyimpan.'
        ],
        nutrisiItems: [
            // Pre-filled dummy data for editing
            { nama: 'Protein', nilai: '18', satuan: '%' },
            { nama: 'Serat', nilai: '5', satuan: '%' }
        ],
        form: {
            // Pre-filled dummy data for editing
            nama: 'Pupuk NPK Premium',
            merek: 'NPK Gold',
            kategori: 'Pupuk',
            satuan: 'sak',
            stokMasuk: '100',
            stokSekarang: '85',
            pemakaianHarian: '2',
            jenisBarang: 'Habis Pakai',
            harga: '175000',
            kadaluarsa: '2025-12-31',
            supplier: 'PT Agro Kimia Indonesia',
            tglMasuk: '2024-11-10',
            lokasi: 'Gudang A',
            stokMinimum: '20',
            catatan: 'Disimpan di ruang kering, jauh dari kelembaban dan sinar matahari langsung.'
        },
        
        addNutrisi() {
            this.nutrisiItems.push({ nama: '', nilai: '', satuan: '' });
        },
        
        removeNutrisi(index) {
            this.nutrisiItems.splice(index, 1);
        },
        
        getNutrisiFormatted() {
            return this.nutrisiItems
                .filter(item => item.nama && item.nilai)
                .map(item => `${item.nama}: ${item.nilai}${item.satuan || ''}`)
                .join(', ');
        },
        
        submitForm() {
            // Compile nutrisi data
            const nutrisiData = this.getNutrisiFormatted();
            console.log('Updated Form Data:', this.form);
            console.log('Nutrisi:', nutrisiData);
            
            // For now, just show alert and redirect
            alert('Data berhasil diperbarui!');
            window.location.href = '{{ route('admin.inventory.gudang.show') }}';
        }
    }
}
</script>
@endsection
