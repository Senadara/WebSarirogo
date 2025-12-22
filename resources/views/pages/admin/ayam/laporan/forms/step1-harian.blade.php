{{-- Form Step 1 - Laporan Harian: Pilih Lahan & Aktivitas --}}

@extends('layouts.admin')

@section('content')
<div x-data="{ 
    open: false,
    showFilter: false,
    selectedLahan: null,
    searchQuery: '',
    statusFilter: '',
    lahanList: [
        { id: 1, name: 'Kandang A', size: '10 Hektar', count: '1000 Ekor', tanggalPanen: '23 September 2025', status: 'Siap Panen' },
        { id: 2, name: 'Kandang B', size: '10 Hektar', count: '1000 Ekor', tanggalPanen: '23 September 2025', status: 'Pembibitan' },
        { id: 3, name: 'Kandang C', size: '10 Hektar', count: '1000 Ekor', tanggalPanen: '23 September 2025', status: 'Berbunga' },
        { id: 4, name: 'Kandang D', size: '10 Hektar', count: '1000 Ekor', tanggalPanen: '23 September 2025', status: 'Vegetatif' },
    ],
    get filteredLahan() {
        return this.lahanList.filter(lahan => {
            const matchSearch = lahan.name.toLowerCase().includes(this.searchQuery.toLowerCase());
            const matchStatus = this.statusFilter === '' || lahan.status === this.statusFilter;
            return matchSearch && matchStatus;
        });
    }
}" class="flex bg-white min-h-screen">

    {{-- Sidebar --}}
    @include('components.layouts.sidebar')

    <main class="flex-1 p-4 md:p-6 lg:ml-72">

        {{-- Mobile topbar --}}
        <div class="flex items-center gap-3 mb-4 md:mb-6 lg:hidden">
            <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                <img src="/assets/icons/menu.svg" class="w-5 h-5 md:w-6 md:h-6" alt="menu">
            </button>
            <h1 class="text-base md:text-lg font-bold">Laporan Harian</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="flex flex-wrap items-center justify-between gap-2 md:gap-3 mb-3 md:mb-4">
            <div class="flex items-center gap-1.5 md:gap-2 text-xs md:text-sm text-gray-600 overflow-x-auto">
                <span>🐔</span>
                <span class="hidden sm:inline">Peternakan</span>
                <span>&gt;</span>
                <span>Ayam</span>
                <span>&gt;</span>
                <span class="font-semibold text-gray-900 whitespace-nowrap">Laporan Peternakan</span>
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
        <h1 class="text-2xl md:text-4xl font-bold mb-4 md:mb-6 hidden lg:block">Laporan Harian</h1>

        {{-- Stepper --}}
        <x-form.stepper 
            :currentStep="1" 
            :totalSteps="3" 
            :labels="['Step 1', 'Step 2', 'Step 3']"
            description="Pilih lahan dan tentukan aktivitas yang dilakukan pada hari ini."
        />

        {{-- Section Header --}}
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-primary-3 to-primary-4 flex items-center justify-center">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg md:text-2xl font-bold text-gray-900">Pilih Lahan & Aktivitas</h2>
                <p class="text-xs md:text-sm text-gray-500">Tentukan lahan dan jenis aktivitas yang akan dilaporkan</p>
            </div>
        </div>

        {{-- Main Content Card --}}
        <div class="bg-gradient-to-br from-primary-1/50 to-white rounded-2xl md:rounded-3xl border border-primary-2/50 p-4 md:p-8 mb-6">
            
            {{-- Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">

                {{-- Left Column: Lahan List --}}
                <div class="lg:col-span-2 order-2 lg:order-1">
                    
                    {{-- Search & Filter Card --}}
                    <div class="bg-white rounded-xl md:rounded-2xl p-4 shadow-sm border border-gray-100 mb-4">
                        <div class="flex items-center gap-2 md:gap-4">
                            <div class="relative flex-1">
                                <input
                                    type="text"
                                    x-model="searchQuery"
                                    placeholder="Cari lahan..."
                                    class="w-full pl-10 md:pl-12 pr-4 py-2.5 md:py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-3 focus:border-primary-3 outline-none text-sm"
                                >
                                <span class="absolute left-3 md:left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </span>
                            </div>

                            <div class="relative">
                                <button 
                                    @click="showFilter = !showFilter"
                                    :class="statusFilter ? 'bg-primary-1 border-primary-3 text-primary-4' : 'border-gray-200 text-gray-600'"
                                    class="flex items-center gap-2 px-4 py-2.5 md:py-3 rounded-xl border text-sm font-medium hover:bg-gray-50 transition"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                    </svg>
                                    <span class="hidden sm:inline">Filter</span>
                                </button>

                                {{-- Filter Dropdown --}}
                                <div 
                                    x-show="showFilter" 
                                    @click.away="showFilter = false"
                                    x-transition
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50"
                                >
                                    <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">Status</div>
                                    <button 
                                        @click="statusFilter = ''; showFilter = false"
                                        :class="statusFilter === '' ? 'bg-primary-1 text-primary-4' : 'text-gray-700'"
                                        class="w-full px-3 py-2 text-left text-sm hover:bg-gray-50 transition"
                                    >
                                        Semua
                                    </button>
                                    <button 
                                        @click="statusFilter = 'Siap Panen'; showFilter = false"
                                        :class="statusFilter === 'Siap Panen' ? 'bg-primary-1 text-primary-4' : 'text-gray-700'"
                                        class="w-full px-3 py-2 text-left text-sm hover:bg-gray-50 transition"
                                    >
                                        Siap Panen
                                    </button>
                                    <button 
                                        @click="statusFilter = 'Pembibitan'; showFilter = false"
                                        :class="statusFilter === 'Pembibitan' ? 'bg-primary-1 text-primary-4' : 'text-gray-700'"
                                        class="w-full px-3 py-2 text-left text-sm hover:bg-gray-50 transition"
                                    >
                                        Pembibitan
                                    </button>
                                    <button 
                                        @click="statusFilter = 'Berbunga'; showFilter = false"
                                        :class="statusFilter === 'Berbunga' ? 'bg-primary-1 text-primary-4' : 'text-gray-700'"
                                        class="w-full px-3 py-2 text-left text-sm hover:bg-gray-50 transition"
                                    >
                                        Berbunga
                                    </button>
                                    <button 
                                        @click="statusFilter = 'Vegetatif'; showFilter = false"
                                        :class="statusFilter === 'Vegetatif' ? 'bg-primary-1 text-primary-4' : 'text-gray-700'"
                                        class="w-full px-3 py-2 text-left text-sm hover:bg-gray-50 transition"
                                    >
                                        Vegetatif
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Active Filter Badge --}}
                        <div x-show="statusFilter" class="mt-3">
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary-1 rounded-lg text-sm text-primary-4 font-medium">
                                <span x-text="'Status: ' + statusFilter"></span>
                                <button @click="statusFilter = ''" class="hover:text-primary-5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </div>

                    {{-- Lahan Cards --}}
                    <div class="space-y-3">
                        <template x-for="lahan in filteredLahan" :key="lahan.id">
                            <div 
                                @click="selectedLahan = lahan"
                                :class="selectedLahan?.id === lahan.id ? 'ring-2 ring-primary-3 bg-white shadow-md' : 'bg-white hover:shadow-md'"
                                class="flex items-center gap-3 md:gap-4 p-4 md:p-5 rounded-xl md:rounded-2xl border border-gray-100 cursor-pointer transition-all duration-200"
                            >
                                {{-- Thumbnail --}}
                                <div class="w-14 h-14 md:w-16 md:h-16 rounded-xl bg-gradient-to-br from-primary-1 to-primary-2 overflow-hidden flex-shrink-0 flex items-center justify-center">
                                    <img src="/assets/icons/kandang.svg" alt="kandang" class="w-10 h-10 md:w-12 md:h-12 object-cover">
                                </div>

                                {{-- Info --}}
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-sm md:text-base text-gray-900" x-text="lahan.name"></h3>
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-0.5 mt-1">
                                        <span class="text-xs md:text-sm text-gray-500 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                            </svg>
                                            <span x-text="lahan.size"></span>
                                        </span>
                                        <span class="text-xs md:text-sm text-gray-500 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <span x-text="lahan.count"></span>
                                        </span>
                                    </div>
                                </div>

                                {{-- Tanggal Panen & Status --}}
                                <div class="text-right flex-shrink-0">
                                    <p class="text-[10px] md:text-xs text-gray-400 uppercase tracking-wide">Panen</p>
                                    <p class="text-xs md:text-sm font-medium text-gray-700" x-text="lahan.tanggalPanen"></p>
                                    <span 
                                        :class="{
                                            'bg-gradient-to-r from-primary-3 to-primary-4 text-white': lahan.status === 'Siap Panen',
                                            'bg-gradient-to-r from-yellow-400 to-yellow-500 text-white': lahan.status === 'Pembibitan',
                                            'bg-gradient-to-r from-pink-400 to-pink-500 text-white': lahan.status === 'Berbunga',
                                            'bg-gradient-to-r from-orange-400 to-orange-500 text-white': lahan.status === 'Vegetatif'
                                        }"
                                        class="inline-block mt-1.5 px-2.5 md:px-3 py-1 md:py-1.5 rounded-lg text-[10px] md:text-xs font-semibold whitespace-nowrap shadow-sm"
                                        x-text="lahan.status"
                                    ></span>
                                </div>

                                {{-- Checkbox --}}
                                <div class="flex-shrink-0">
                                    <div 
                                        :class="selectedLahan?.id === lahan.id ? 'bg-gradient-to-br from-primary-3 to-primary-4 border-primary-3' : 'border-gray-300 bg-white'"
                                        class="w-6 h-6 md:w-7 md:h-7 rounded-lg border-2 flex items-center justify-center transition shadow-sm"
                                    >
                                        <svg x-show="selectedLahan?.id === lahan.id" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </template>

                        {{-- Empty State --}}
                        <div x-show="filteredLahan.length === 0" class="text-center py-12 bg-white rounded-2xl border border-gray-100">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">Tidak ada lahan ditemukan</p>
                            <p class="text-sm text-gray-400 mt-1">Coba ubah filter atau kata kunci pencarian</p>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Form --}}
                <div class="lg:col-span-1 order-1 lg:order-2">
                    <div class="bg-white border border-gray-100 rounded-xl md:rounded-2xl p-4 md:p-6 shadow-sm lg:sticky lg:top-6">
                        
                        {{-- Form Header --}}
                        <div class="flex items-center gap-2 mb-5">
                            <div class="w-8 h-8 rounded-lg bg-primary-1 flex items-center justify-center">
                                <svg class="w-4 h-4 text-primary-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-gray-900">Detail Aktivitas</h2>
                        </div>

                        {{-- Selected Lahan Display --}}
                        <div class="mb-4">
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Lahan Terpilih</label>
                            <div 
                                :class="selectedLahan ? 'bg-primary-1 border-primary-2' : 'bg-gray-50 border-gray-200'"
                                class="p-3 rounded-xl border"
                            >
                                <template x-if="selectedLahan">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center">
                                            <img src="/assets/icons/kandang.svg" class="w-6 h-6" alt="kandang">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900" x-text="selectedLahan.name"></p>
                                            <p class="text-xs text-gray-500" x-text="selectedLahan.size + ' • ' + selectedLahan.count"></p>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="!selectedLahan">
                                    <p class="text-sm text-gray-400 italic">Pilih lahan dari daftar</p>
                                </template>
                            </div>
                        </div>

                        {{-- Jenis Aktivitas --}}
                        <x-form.dropdown 
                            label="Jenis Aktivitas"
                            name="jenis_aktivitas"
                            placeholder="Pilih aktivitas"
                            :options="[
                                'pemberian_pakan' => 'Pemberian Pakan',
                                'pembersihan' => 'Pembersihan Kandang',
                                'vaksinasi' => 'Vaksinasi',
                                'pengecekan' => 'Pengecekan Kesehatan',
                            ]"
                        />

                        {{-- Catatan --}}
                        <div class="mt-4">
                            <x-form.textarea 
                                label="Catatan"
                                name="catatan"
                                placeholder="Tambahkan catatan..."
                                :rows="3"
                            />
                        </div>

                        {{-- Upload Bukti --}}
                        <div class="mt-4">
                            <x-form.fileupload 
                                label="Unggah Bukti Aktivitas"
                                name="bukti_aktivitas"
                                accept="image/*"
                            />
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Buttons Card --}}
        <div class="bg-white rounded-xl md:rounded-2xl border border-gray-100 p-4 md:p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row items-center gap-3">
                <a 
                    href="{{ route('admin.ayam.laporan.index') }}"
                    class="w-full sm:w-auto order-2 sm:order-1 py-2.5 md:py-3 px-6 md:px-8 rounded-full bg-gray-200 text-gray-700 font-medium text-center text-sm md:text-base hover:bg-gray-300 transition flex items-center justify-center gap-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
                <div class="flex-1 hidden sm:block"></div>
                <a 
                    href="{{ route('admin.ayam.laporan.harian.step2') }}"
                    class="w-full sm:w-auto order-1 sm:order-2 py-2.5 md:py-3 px-8 md:px-12 rounded-full bg-gradient-to-r from-primary-3 to-primary-4 text-white font-semibold text-sm md:text-base hover:shadow-lg hover:shadow-primary-3/30 transition-all duration-300 flex items-center justify-center gap-2"
                >
                    Selanjutnya
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

    </main>
</div>
@endsection