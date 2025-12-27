@extends('layouts.admin')

@section('content')
<div x-data="{ open: false }" class="flex bg-gray-50 min-h-screen overflow-x-hidden">

    @include('components.layouts.sidebar')

    <main class="flex-1 p-4 lg:p-8 lg:ml-72 max-w-full">
        
        <!-- Mobile Topbar -->
        <div class="flex items-center justify-between mb-4 lg:hidden">
            <div class="flex items-center gap-3">
                <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                    <img src="/assets/icons/menu.svg" class="w-6 h-6">
                </button>
                <div>
                    <h1 class="text-lg font-bold text-gray-900">Detail Produk</h1>
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
                <a href="{{ route('admin.inventory.gudang.index') }}" class="hover:text-emerald-600 transition">Data Gudang</a>
                <span>/</span>
                <span class="font-semibold text-gray-900">Informasi Barang</span>
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

        <!-- Product Header -->
        <div class="bg-white rounded-2xl border shadow-sm p-6 lg:p-8 mb-6">
            <div class="flex flex-col lg:flex-row gap-6 lg:gap-10">
                
                <!-- Product Image -->
                <div class="flex-shrink-0">
                    <div class="w-full lg:w-64 h-48 lg:h-64 rounded-xl bg-gradient-to-br from-gray-100 to-gray-50 border overflow-hidden flex items-center justify-center">
                        <img src="https://images.unsplash.com/photo-1585314062340-f1a5a7c9328d?q=80&w=400&auto=format&fit=crop" 
                             class="w-full h-full object-cover" 
                             alt="Pupuk NPK Premium">
                    </div>
                </div>

                <!-- Product Title & Quick Info -->
                <div class="flex-1">
                    <div class="flex flex-wrap items-start justify-between gap-4 mb-4">
                        <div>
                            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">Pupuk NPK Premium</h1>
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="bg-gray-100 text-gray-600 text-xs px-2.5 py-1 rounded-lg border font-medium">SKU-4921</span>
                                <span class="bg-emerald-50 text-emerald-700 text-xs px-2.5 py-1 rounded-lg border border-emerald-100 font-medium">Perlengkapan</span>
                                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-xs px-2.5 py-1 rounded-lg border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Tersedia
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="bg-gradient-to-br from-emerald-50 to-white p-4 rounded-xl border border-emerald-100">
                            <p class="text-xs text-gray-500 mb-1">Stok Saat Ini</p>
                            <p class="text-xl font-bold text-gray-900">850 <span class="text-sm font-normal text-gray-500">kg</span></p>
                        </div>
                        <div class="bg-gradient-to-br from-blue-50 to-white p-4 rounded-xl border border-blue-100">
                            <p class="text-xs text-gray-500 mb-1">Total Masuk</p>
                            <p class="text-xl font-bold text-gray-900">1,200 <span class="text-sm font-normal text-gray-500">kg</span></p>
                        </div>
                        <div class="bg-gradient-to-br from-amber-50 to-white p-4 rounded-xl border border-amber-100">
                            <p class="text-xs text-gray-500 mb-1">Pemakaian/Hari</p>
                            <p class="text-xl font-bold text-gray-900">25 <span class="text-sm font-normal text-gray-500">kg</span></p>
                        </div>
                        <div class="bg-gradient-to-br from-purple-50 to-white p-4 rounded-xl border border-purple-100">
                            <p class="text-xs text-gray-500 mb-1">Nilai Persediaan</p>
                            <p class="text-xl font-bold text-gray-900">Rp 2.5 <span class="text-sm font-normal text-gray-500">jt</span></p>
                        </div>
                    </div>

                    <!-- Stock Progress -->
                    <div class="bg-gray-50 rounded-xl p-4 border">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="font-medium text-gray-700">Level Stok</span>
                            <span class="text-gray-500">850 / 1000 kg (85%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-400 to-emerald-500 h-3 rounded-full transition-all" style="width: 85%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            <svg class="w-3.5 h-3.5 inline mr-1 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Stok dalam kondisi baik. Estimasi habis dalam 34 hari.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Information Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            
            <!-- Informasi Utama -->
            <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                    <h3 class="text-white font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Informasi Utama
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Nama Barang</span>
                        <span class="font-medium text-gray-900 text-sm">Pupuk NPK Premium</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Merek Barang</span>
                        <span class="font-medium text-gray-900 text-sm">NPK Gold</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Kategori</span>
                        <span class="font-medium text-gray-900 text-sm">Penyubur Tanah</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Satuan</span>
                        <span class="font-medium text-gray-900 text-sm">Sak (50 kg)</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Total Stok Masuk</span>
                        <span class="font-medium text-gray-900 text-sm">1,200 kg</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Jumlah Stok Sekarang</span>
                        <span class="font-medium text-emerald-600 text-sm">850 kg</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-500 text-sm">Estimasi Pemakaian Harian</span>
                        <span class="font-medium text-gray-900 text-sm">25 kg</span>
                    </div>
                </div>
            </div>

            <!-- Spesifikasi -->
            <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h3 class="text-white font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        Spesifikasi
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Jenis Barang</span>
                        <span class="font-medium text-gray-900 text-sm">Habis Pakai</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Harga Beli per Satuan</span>
                        <span class="font-medium text-gray-900 text-sm">Rp 150.000</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Tanggal Kadaluarsa</span>
                        <span class="font-medium text-gray-900 text-sm">15 Desember 2026</span>
                    </div>
                    <div class="py-2">
                        <span class="text-gray-500 text-sm block mb-2">Komposisi Nutrisi</span>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-green-50 text-green-700 text-xs px-2.5 py-1 rounded-lg border border-green-100">Nitrogen 15%</span>
                            <span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-lg border border-blue-100">Fosfor 15%</span>
                            <span class="bg-orange-50 text-orange-700 text-xs px-2.5 py-1 rounded-lg border border-orange-100">Kalium 15%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Logistik -->
            <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                    <h3 class="text-white font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path></svg>
                        Informasi Logistik
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Supplier</span>
                        <span class="font-medium text-gray-900 text-sm">PT Agro Kimia Indonesia</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Tanggal Masuk Gudang</span>
                        <span class="font-medium text-gray-900 text-sm">20 Desember 2024</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Total Nilai Persediaan</span>
                        <span class="font-medium text-emerald-600 text-sm">Rp 2.550.000</span>
                    </div>
                    <div class="py-2">
                        <span class="text-gray-500 text-sm block mb-2">Catatan Tambahan</span>
                        <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-lg border">
                            Disimpan di ruang kering, jauh dari kelembaban dan sinar matahari langsung. Pastikan kemasan tertutup rapat setelah penggunaan.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Riwayat Stok -->
            <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
                    <h3 class="text-white font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Riwayat Stok Terakhir
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 p-3 bg-green-50 rounded-lg border border-green-100">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Stok Masuk</p>
                                <p class="text-xs text-gray-500">27 Des 2024, 08:30</p>
                            </div>
                            <span class="text-green-600 font-semibold text-sm">+100 kg</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-red-50 rounded-lg border border-red-100">
                            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Pemakaian - Kandang A</p>
                                <p class="text-xs text-gray-500">27 Des 2024, 14:15</p>
                            </div>
                            <span class="text-red-600 font-semibold text-sm">-25 kg</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-red-50 rounded-lg border border-red-100">
                            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Pemakaian - Kandang B</p>
                                <p class="text-xs text-gray-500">26 Des 2024, 09:00</p>
                            </div>
                            <span class="text-red-600 font-semibold text-sm">-30 kg</span>
                        </div>
                    </div>
                    <a href="#" class="mt-4 text-sm text-emerald-600 hover:text-emerald-700 font-medium flex items-center gap-1">
                        Lihat Semua Riwayat
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white rounded-2xl border shadow-sm p-4 lg:p-6">
            <a href="{{ route('admin.inventory.gudang.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <button class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-medium rounded-xl transition shadow-sm shadow-emerald-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Tambah Stok
                </button>
                <button class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-xl transition shadow-sm shadow-amber-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit
                </button>
                <button class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-medium rounded-xl transition shadow-sm shadow-red-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Delete
                </button>
            </div>
        </div>

    </main>
</div>
@endsection