<!-- laporan detail harian -->
@extends('layouts.admin')

@section('content')
<div x-data="{ open: false }" class="flex bg-white min-h-screen">

    {{-- Sidebar --}}
    @include('components.layouts.sidebar')

    <main class="flex-1 p-4 md:p-6 lg:ml-72">

        {{-- Mobile topbar --}}
        <div class="flex items-center gap-3 mb-4 md:mb-6 lg:hidden">
            <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                <img src="/assets/icons/menu.svg" class="w-5 h-5 md:w-6 md:h-6" alt="menu">
            </button>
            <h1 class="text-base md:text-lg font-bold">Detail Laporan Harian</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="flex flex-wrap items-center justify-between gap-2 md:gap-3 mb-3 md:mb-4">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-6">

                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <span>🐔</span>
                    <span>/</span>
                    <a href="{{ route('admin.ayam.laporan.index') }}"
                        class="hover:underline hover:text-primary-2 transition">
                        Laporan
                    </a>
                    <span>/</span>
                    <span class="font-semibold text-gray-900">Detail Kandang</span>
                </div>
            </div>

            <div class="flex items-center gap-2 md:gap-4">
                <button class="relative p-1.5 md:p-2 rounded-full hover:bg-gray-100">
                    <img src="/assets/icons/notification.svg" class="w-4 h-4 md:w-5 md:h-5" alt="notifikasi">
                    <span class="absolute -top-0.5 -right-0.5 md:-top-1 md:-right-1 w-2 h-2 md:w-2.5 md:h-2.5 bg-red-500 rounded-full"></span>
                </button>
                <button class="p-1.5 md:p-2 rounded-full hover:bg-gray-100">
                    <img src="/assets/icons/user.svg" class="w-4 h-4 md:w-5 md:h-5" alt="user">
                </button>
            </div>
        </div>

        {{-- Title --}}
        <h1 class="text-2xl md:text-4xl font-bold mb-4 md:mb-6 hidden lg:block">Detail Laporan Harian</h1>

        {{-- Main Content Card --}}
        <div class="bg-gradient-to-br from-primary-1/50 to-white rounded-2xl md:rounded-3xl border border-primary-2/50 p-4 md:p-8 mb-6">
            
            {{-- Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 md:gap-8">
                {{-- Right Column: Evidence Image (2/5 width on desktop) --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl md:rounded-2xl p-4 md:p-6 shadow-sm border border-gray-100 lg:sticky lg:top-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-base md:text-lg font-bold text-gray-900">Foto Kandang</h3>
                        </div>
    
                        {{-- Image Preview with elegant frame --}}
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-br from-primary-3/20 to-primary-4/20 rounded-xl md:rounded-2xl transform rotate-1 group-hover:rotate-2 transition-transform"></div>
                            <div class="relative bg-gray-50 rounded-xl md:rounded-2xl overflow-hidden border-2 border-white shadow-md">
                                <div class="aspect-[4/3]">
                                    <img
                                        src="/assets/icons/kandang.svg"
                                        alt="Bukti aktivitas"
                                        class="w-full h-full object-cover">
                                </div>
                                {{-- Image overlay info --}}
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3 md:p-4">
                                    <p class="text-white/70 text-[10px] md:text-xs">Diambil: 19 Sep 2025, 14:35</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Left Column: Info & Inventory (3/5 width on desktop) --}}
                <div class="lg:col-span-3 space-y-6">

                    {{-- Informasi Utama Card --}}
                    <div class="bg-white rounded-xl md:rounded-2xl p-4 md:p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-primary-1 flex items-center justify-center">
                                <svg class="w-4 h-4 text-primary-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-base md:text-lg font-bold text-gray-900">Informasi Utama</h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                            <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                                <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Nama Lahan</p>
                                <p class="text-sm md:text-base font-semibold text-gray-900">Kandang A</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                                <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Jenis Aktivitas</p>
                                <p class="text-sm md:text-base font-semibold text-primary-4">Pemupukan</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                                <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Tanggal Laporan</p>
                                <p class="text-sm md:text-base font-semibold text-gray-900">19 September 2025</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                                <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Waktu</p>
                                <p class="text-sm md:text-base font-semibold text-gray-900">14:35 WIB</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 md:p-4 sm:col-span-2">
                                <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Petugas</p>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 md:w-8 md:h-8 rounded-full bg-primary-3 flex items-center justify-center text-white text-xs md:text-sm font-bold">PH</div>
                                    <p class="text-sm md:text-base font-semibold text-gray-900">Pak Heri</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Rincian Pemakaian Inventaris Card --}}
                    <div class="bg-white rounded-xl md:rounded-2xl p-4 md:p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <h3 class="text-base md:text-lg font-bold text-gray-900">Pemakaian Inventaris</h3>
                            <span class="ml-auto bg-primary-1 text-primary-4 text-xs font-semibold px-2 py-0.5 rounded-full">3 Item</span>
                        </div>

                        <div class="space-y-2">

                            {{-- Item 1 --}}
                            <div class="flex items-center justify-between py-2.5 md:py-3 px-3 md:px-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="flex items-center gap-2 md:gap-3">
                                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg bg-white border flex items-center justify-center">
                                        <img src="/assets/icons/pakan.svg" class="w-5 h-5 md:w-6 md:h-6" alt="item">
                                    </div>
                                    <div>
                                        <p class="text-xs md:text-sm font-medium text-gray-900">Pupuk Indonesia</p>
                                        <p class="text-[10px] md:text-xs text-gray-500">Pupuk Okra</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center gap-1 bg-primary-3 text-white text-xs md:text-sm font-bold px-3 py-1 rounded-full">
                                        <span>10</span>
                                        <span class="text-primary-1/80">Kg</span>
                                    </span>
                                </div>
                            </div>

                            {{-- Item 2 --}}
                            <div class="flex items-center justify-between py-2.5 md:py-3 px-3 md:px-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="flex items-center gap-2 md:gap-3">
                                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg bg-white border flex items-center justify-center">
                                        <img src="/assets/icons/pakan.svg" class="w-5 h-5 md:w-6 md:h-6" alt="item">
                                    </div>
                                    <div>
                                        <p class="text-xs md:text-sm font-medium text-gray-900">Pelet Ayam Petelur</p>
                                        <p class="text-[10px] md:text-xs text-gray-500">Pakan Ayam</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center gap-1 bg-primary-3 text-white text-xs md:text-sm font-bold px-3 py-1 rounded-full">
                                        <span>5</span>
                                        <span class="text-primary-1/80">Kg</span>
                                    </span>
                                </div>
                            </div>

                            {{-- Item 3 --}}
                            <div class="flex items-center justify-between py-2.5 md:py-3 px-3 md:px-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="flex items-center gap-2 md:gap-3">
                                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg bg-white border flex items-center justify-center">
                                        <img src="/assets/icons/box.svg" class="w-5 h-5 md:w-6 md:h-6" alt="item">
                                    </div>
                                    <div>
                                        <p class="text-xs md:text-sm font-medium text-gray-900">Vitamin Ternak</p>
                                        <p class="text-[10px] md:text-xs text-gray-500">Peralatan Ternak</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center gap-1 bg-primary-3 text-white text-xs md:text-sm font-bold px-3 py-1 rounded-full">
                                        <span>2</span>
                                        <span class="text-primary-1/80">Pcs</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        {{-- Buttons - Fixed at bottom with card styling --}}
        <div class="bg-white rounded-xl md:rounded-2xl border border-gray-100 p-4 md:p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row items-center gap-3">
                <a
                    href="{{ route('admin.ayam.laporan.index') }}"
                    class="w-full sm:w-auto order-2 sm:order-1 py-2.5 md:py-3 px-6 md:px-8 rounded-full bg-gray-200 text-gray-700 font-medium text-center text-sm md:text-base hover:bg-gray-300 transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
                <div class="flex-1 hidden sm:block"></div>
                <button
                    href="#"
                    type="submit"
                    class="w-full sm:w-auto order-1 sm:order-2 py-2.5 md:py-3 px-8 md:px-12 rounded-full bg-gradient-to-r from-primary-3 to-primary-4 text-white font-semibold text-sm md:text-base hover:shadow-lg hover:shadow-primary-3/30 transition-all duration-300 flex items-center justify-center gap-2">
                    Edit Laporan
                </button>
            </div>
        </div>

    </main>
</div>
@endsection