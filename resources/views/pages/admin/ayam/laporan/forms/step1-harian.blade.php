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
            description="Pilih lahan dan tentukan aktivitas yang dilakukan pada hari ini." />

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

            <!-- grid utama -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6"> <!-- list kandang -->
                <div class="lg:col-span-2"> <!-- SEARCH + FILTER -->
                    <div class="flex flex-col sm:flex-row gap-3 mb-4"> <x-ui.search placeholder="Cari Kandang..." /> <button class="flex items-center gap-2 px-4 py-2 rounded-lg border text-sm hover:bg-gray-100 transition md:ml-auto"> <img src="/assets/icons/filter.svg" class="w-4 h-4"> Filter </button> </div> <!-- scroll area (kandang) --> <x-ui.cardKandang :items="[1,2,3,4,5,6,7,8,9]" /> <!-- mobile desktop -->
                    <div class="flex sm:hidden gap-2 mt-4 justify-center"> <button class="px-3 py-1 text-sm bg-gray-200 rounded"> Prev </button> <button class="px-3 py-1 text-sm bg-primary-3 text-white rounded"> 1 </button> <button class="px-3 py-1 text-sm bg-gray-300 rounded"> Next </button> </div> <!-- desktop paginate -->
                    <div class="hidden sm:flex gap-2 mt-4 justify-center"> <button class="px-3 py-1 text-sm bg-gray-200 rounded"> Prev </button> <button class="px-3 py-1 text-sm bg-primary-3 text-white rounded"> 1 </button> <button class="px-3 py-1 text-sm bg-gray-300 rounded"> 2 </button> <button class="px-3 py-1 text-sm bg-gray-300 rounded"> 3 </button> <button class="px-3 py-1 text-sm bg-gray-300 rounded"> Next </button> </div>
                </div> <!-- kanan, form aktivitas -->
                <div class="bg-blue-50 rounded-xl p-6">
                    <h3 class="font-bold mb-4">Pilih Kandang & Aktivitas</h3>
                    <div class="space-y-4"> <x-ui.input value="Lahan A" /> <x-ui.dropdown :options="['Panen', 'Pemberian Pakan', 'Perawatan']" /> <x-ui.textarea rows="4" placeholder="Catatan..." /> </div>
                    <div class="mt-6 flex flex-col gap-3"></div>
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