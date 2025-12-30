@extends('layouts.admin')

@section('content')
<div x-data="ayamDashboard()" class="flex bg-gray-50 min-h-screen overflow-x-hidden">

    @include('components.layouts.sidebar')

    <main class="flex-1 p-3 sm:p-4 lg:p-8 lg:ml-72 max-w-full overflow-x-hidden">

        <!-- Mobile Topbar -->
        <div class="flex items-center gap-3 mb-6 lg:hidden">
            <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                <img src="/assets/icons/menu.svg" class="w-6 h-6">
            </button>
            <h1 class="text-lg font-bold">Dashboard Ayam</h1>
        </div>

        <!-- Page Title -->
        <h1 class="text-2xl lg:text-3xl font-bold mb-2 hidden lg:block text-gray-900">Dashboard Ayam</h1>

        <!-- Breadcrumb & Actions -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <img src="/assets/icons/home.svg" class="w-4 h-4">
                <span>/</span>
                <span class="font-semibold text-gray-900">Dashboard Ayam</span>
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
                    Monitoring Peternakan Ayam
                </h2>
                <p class="text-emerald-100 text-sm md:text-base max-w-2xl">
                    Pantau performa kandang, produksi telur, dan kesehatan ayam secara real-time.
                </p>
                <p class="text-emerald-200 text-sm mt-3 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ now()->locale('id')->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 hidden sm:block"></div>
            <div class="absolute bottom-0 left-1/2 w-32 h-32 bg-white/5 rounded-full translate-y-1/2 hidden sm:block"></div>
        </div>

        <!-- ═══════════════════════════════════════════════════════════════ -->
        <!-- SECTION 1: CUACA & PERINGATAN -->
        <!-- ═══════════════════════════════════════════════════════════════ -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 mb-6">
            <!-- Cuaca Saat Ini (2/3) -->
            <div class="lg:col-span-2 bg-white border rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">Prakiraan Cuaca</h3>
                        <p class="text-xs text-gray-500">Data BMKG - Update terakhir {{ now()->format('H:i') }}</p>
                    </div>
                    <a href="https://www.bmkg.go.id" target="_blank" class="text-sm text-primary-4 hover:text-primary-5 font-medium flex items-center gap-1">
                        <span>BMKG</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
                
                <!-- Current Weather -->
                <div class="flex flex-col sm:flex-row gap-4 mb-4 pb-4 border-b">
                    <div class="flex items-center gap-4">
                        <img src="/assets/icons/matahari.svg" class="w-14 h-14 sm:w-16 sm:h-16" alt="cuaca">
                        <div>
                            <p class="text-sm text-gray-500">Sekarang</p>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900">28°C</p>
                            <p class="text-sm text-gray-600">Cerah Berawan</p>
                        </div>
                    </div>
                    <div class="flex-1 grid grid-cols-3 gap-2 sm:gap-3">
                        <div class="p-2 sm:p-3 bg-gray-50 rounded-lg text-center">
                            <p class="text-xs text-gray-500">Kelembaban</p>
                            <p class="text-base sm:text-lg font-bold text-gray-900">65%</p>
                        </div>
                        <div class="p-2 sm:p-3 bg-gray-50 rounded-lg text-center">
                            <p class="text-xs text-gray-500">Angin</p>
                            <p class="text-base sm:text-lg font-bold text-gray-900">12 km/h</p>
                        </div>
                        <div class="p-2 sm:p-3 bg-gray-50 rounded-lg text-center">
                            <p class="text-xs text-gray-500">Hujan</p>
                            <p class="text-base sm:text-lg font-bold text-gray-900">0 mm</p>
                        </div>
                    </div>
                </div>
                
                <!-- Forecast Next 6 Hours -->
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3">Prakiraan 6 Jam Kedepan</p>
                <div class="grid grid-cols-6 gap-2">
                    <!-- +1 Hour -->
                    <div class="p-2 bg-gray-50 rounded-xl text-center">
                        <p class="text-xs font-medium text-gray-600 mb-1">{{ now()->addHour()->format('H:i') }}</p>
                        <img src="/assets/icons/matahari.svg" class="w-7 h-7 mx-auto mb-1" alt="cerah">
                        <p class="text-sm font-bold text-gray-900">28°C</p>
                    </div>
                    <!-- +2 Hours -->
                    <div class="p-2 bg-gray-50 rounded-xl text-center">
                        <p class="text-xs font-medium text-gray-600 mb-1">{{ now()->addHours(2)->format('H:i') }}</p>
                        <svg class="w-7 h-7 mx-auto mb-1 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/></svg>
                        <p class="text-sm font-bold text-gray-900">29°C</p>
                    </div>
                    <!-- +3 Hours - Rain Warning -->
                    <div class="p-2 bg-blue-100 rounded-xl text-center border border-blue-200">
                        <p class="text-xs font-medium text-blue-700 mb-1">{{ now()->addHours(3)->format('H:i') }}</p>
                        <svg class="w-7 h-7 mx-auto mb-1 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17.92 7.02C17.45 4.18 14.97 2 12 2 9.82 2 7.83 3.18 6.78 5.06 4.09 5.41 2 7.74 2 10.5 2 13.53 4.47 16 7.5 16h10c2.48 0 4.5-2.02 4.5-4.5 0-2.34-1.79-4.27-4.08-4.48z"/><circle cx="8" cy="19" r="1.5"/><circle cx="12" cy="21" r="1.5"/><circle cx="16" cy="19" r="1.5"/></svg>
                        <p class="text-sm font-bold text-blue-700">26°C</p>
                    </div>
                    <!-- +4 Hours -->
                    <div class="p-2 bg-blue-50 rounded-xl text-center">
                        <p class="text-xs font-medium text-gray-600 mb-1">{{ now()->addHours(4)->format('H:i') }}</p>
                        <svg class="w-7 h-7 mx-auto mb-1 text-blue-400" fill="currentColor" viewBox="0 0 24 24"><path d="M17.92 7.02C17.45 4.18 14.97 2 12 2 9.82 2 7.83 3.18 6.78 5.06 4.09 5.41 2 7.74 2 10.5 2 13.53 4.47 16 7.5 16h10c2.48 0 4.5-2.02 4.5-4.5 0-2.34-1.79-4.27-4.08-4.48z"/><circle cx="10" cy="19" r="1"/><circle cx="14" cy="20" r="1"/></svg>
                        <p class="text-sm font-bold text-gray-900">27°C</p>
                    </div>
                    <!-- +5 Hours -->
                    <div class="p-2 bg-gray-50 rounded-xl text-center">
                        <p class="text-xs font-medium text-gray-600 mb-1">{{ now()->addHours(5)->format('H:i') }}</p>
                        <svg class="w-7 h-7 mx-auto mb-1 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/></svg>
                        <p class="text-sm font-bold text-gray-900">28°C</p>
                    </div>
                    <!-- +6 Hours -->
                    <div class="p-2 bg-gray-50 rounded-xl text-center">
                        <p class="text-xs font-medium text-gray-600 mb-1">{{ now()->addHours(6)->format('H:i') }}</p>
                        <img src="/assets/icons/matahari.svg" class="w-7 h-7 mx-auto mb-1" alt="cerah">
                        <p class="text-sm font-bold text-gray-900">27°C</p>
                    </div>
                </div>
            </div>

            <!-- Recent Alerts (1/3) -->
            <div class="bg-white border rounded-xl sm:rounded-2xl p-4 sm:p-5 shadow-sm">
                <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Peringatan Terkini</h3>
                <div class="space-y-3">
                    <div class="flex gap-3 items-start p-3 bg-red-50 rounded-xl">
                        <div class="w-8 h-8 rounded-lg bg-red-500 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Stok Pakan Menipis</p>
                            <p class="text-xs text-gray-500">Sisa pakan < 15%</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start p-3 bg-amber-50 rounded-xl">
                        <div class="w-8 h-8 rounded-lg bg-amber-500 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Suhu Tinggi</p>
                            <p class="text-xs text-gray-500">Kandang B: 32°C</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start p-3 bg-emerald-50 rounded-xl">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Vaksinasi Selesai</p>
                            <p class="text-xs text-gray-500">Kandang A & C</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════════════════════ -->
        <!-- SECTION 2: MENU NAVIGASI (PRIORITAS TINGGI) -->
        <!-- ═══════════════════════════════════════════════════════════════ -->
        <div class="bg-gradient-to-br from-white via-blue-50/30 to-indigo-50/30 border border-blue-100 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base sm:text-lg font-bold text-gray-800">Menu Manajemen</h2>
                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">Akses Cepat</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <x-ui.MenuButton
                    href="{{ route('admin.ayam.kandang.index') }}"
                    icon="/assets/icons/boxx.svg"
                    title="Data Kandang"
                    description="Kelola informasi setiap kandang ayam"
                    iconVariant="green"
                    variant="primary_1" />
                <x-ui.MenuButton
                    href="{{ route('admin.ayam.laporan.index') }}"
                    icon="/assets/icons/note.svg"
                    title="Laporan Harian"
                    description="Catat aktivitas harian dan kondisi ternak"
                    iconVariant="yellow"
                    variant="yellow_1" />
                <x-ui.MenuButton
                    href=""
                    icon="/assets/icons/pakan.svg"
                    title="Manajemen Pakan"
                    description="Kelola stok dan jadwal pemberian pakan"
                    iconVariant="blue"
                    variant="accent_1" />
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════════════════════ -->
        <!-- SECTION 3: INDEKS PERFORMA (PUSAT PERHATIAN) -->
        <!-- ═══════════════════════════════════════════════════════════════ -->
        <div class="bg-gradient-to-br from-white via-emerald-50/30 to-green-50/50 border border-emerald-100 rounded-xl sm:rounded-2xl p-5 sm:p-8 shadow-lg mb-6">
            <div class="flex flex-col lg:flex-row items-center gap-6 lg:gap-10">
                <!-- Left: Large Gauge -->
                <div class="flex flex-col items-center lg:items-start">
                    <div class="relative w-40 h-40 sm:w-48 sm:h-48 lg:w-56 lg:h-56 shrink-0">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                            <!-- Background circle -->
                            <circle cx="50" cy="50" r="42" fill="none" stroke="#E5E7EB" stroke-width="6"/>
                            <!-- Progress circle - 90% = 264 * 0.1 = 26.4 offset -->
                            <circle cx="50" cy="50" r="42" fill="none" stroke="url(#perfGradient)" stroke-width="6" 
                                stroke-linecap="round" stroke-dasharray="264" stroke-dashoffset="26.4"/>
                            <defs>
                                <linearGradient id="perfGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#10B981"/>
                                    <stop offset="50%" stop-color="#34D399"/>
                                    <stop offset="100%" stop-color="#6EE7B7"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900">90</span>
                            <span class="text-lg sm:text-xl font-medium text-emerald-600">Poin</span>
                        </div>
                    </div>
                    <div class="mt-3 text-center lg:text-left">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Indeks Performa</h2>
                        <div class="flex items-center justify-center lg:justify-start gap-2 mt-1">
                            <span class="px-3 py-1 text-sm font-medium bg-emerald-100 text-emerald-700 rounded-full">
                                Sangat Baik
                            </span>
                            <span class="text-xs text-gray-500">Update: {{ now()->format('H:i') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Key Metrics Grid -->
                <div class="flex-1 w-full">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3">Indikator Utama</p>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                        <!-- FCR -->
                        <div class="p-3 sm:p-4 bg-white rounded-xl border shadow-sm cursor-pointer hover:shadow-md transition" @click="document.getElementById('chartFCR').scrollIntoView({behavior:'smooth'})">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-400 to-green-500 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-gray-600">FCR</span>
                            </div>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900">1.79</p>
                            <p class="text-xs text-emerald-600 flex items-center gap-1 mt-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                Di bawah target
                            </p>
                        </div>
                        <!-- HDP -->
                        <div class="p-3 sm:p-4 bg-white rounded-xl border shadow-sm cursor-pointer hover:shadow-md transition" @click="document.getElementById('chartHDP').scrollIntoView({behavior:'smooth'})">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-gray-600">HDP</span>
                            </div>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900">93%</p>
                            <p class="text-xs text-blue-600 flex items-center gap-1 mt-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                +2% vs minggu lalu
                            </p>
                        </div>
                        <!-- HHEP -->
                        <div class="p-3 sm:p-4 bg-white rounded-xl border shadow-sm cursor-pointer hover:shadow-md transition" @click="document.getElementById('chartHHEP').scrollIntoView({behavior:'smooth'})">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-gray-600">HHEP</span>
                            </div>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900">91%</p>
                            <p class="text-xs text-purple-600 flex items-center gap-1 mt-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                +1% vs minggu lalu
                            </p>
                        </div>
                        <!-- Mortalitas -->
                        <div class="p-3 sm:p-4 bg-white rounded-xl border shadow-sm">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-400 to-rose-500 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-gray-600">Mortalitas</span>
                            </div>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900">3</p>
                            <p class="text-xs text-gray-500 mt-1">0.24% bulan ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════════════════════ -->
        <!-- SECTION 4: RINGKASAN POPULASI (COMPACT) -->
        <!-- ═══════════════════════════════════════════════════════════════ -->
        <div class="bg-white border rounded-xl sm:rounded-2xl p-4 sm:p-5 shadow-sm mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base sm:text-lg font-semibold text-gray-800">Ringkasan Populasi</h3>
                <span class="text-xs text-gray-500">Data real-time</span>
            </div>
            <div class="grid grid-cols-3 sm:grid-cols-5 lg:grid-cols-10 gap-2 sm:gap-3">
                <!-- Total -->
                <div class="p-2 sm:p-3 bg-emerald-50 rounded-lg text-center">
                    <p class="text-xs text-gray-500 mb-1">Total</p>
                    <p class="text-lg sm:text-xl font-bold text-gray-900">1,245</p>
                </div>
                <!-- Produktif -->
                <div class="p-2 sm:p-3 bg-blue-50 rounded-lg text-center">
                    <p class="text-xs text-gray-500 mb-1">Produktif</p>
                    <p class="text-lg sm:text-xl font-bold text-gray-900">1,200</p>
                </div>
                <!-- Afkir -->
                <div class="p-2 sm:p-3 bg-amber-50 rounded-lg text-center">
                    <p class="text-xs text-gray-500 mb-1">Afkir</p>
                    <p class="text-lg sm:text-xl font-bold text-gray-900">40</p>
                </div>
                <!-- Sakit -->
                <div class="p-2 sm:p-3 bg-red-50 rounded-lg text-center">
                    <p class="text-xs text-gray-500 mb-1">Sakit</p>
                    <p class="text-lg sm:text-xl font-bold text-gray-900">5</p>
                </div>
                <!-- Umur -->
                <div class="p-2 sm:p-3 bg-purple-50 rounded-lg text-center">
                    <p class="text-xs text-gray-500 mb-1">Umur</p>
                    <p class="text-lg sm:text-xl font-bold text-gray-900">28<span class="text-xs">mgg</span></p>
                </div>
                <!-- Berat -->
                <div class="p-2 sm:p-3 bg-cyan-50 rounded-lg text-center">
                    <p class="text-xs text-gray-500 mb-1">Berat</p>
                    <p class="text-lg sm:text-xl font-bold text-gray-900">1.8<span class="text-xs">kg</span></p>
                </div>
                <!-- Produksi -->
                <div class="p-2 sm:p-3 bg-indigo-50 rounded-lg text-center">
                    <p class="text-xs text-gray-500 mb-1">Telur/Hr</p>
                    <p class="text-lg sm:text-xl font-bold text-gray-900">856</p>
                </div>
                <!-- Berat Telur -->
                <div class="p-2 sm:p-3 bg-green-50 rounded-lg text-center">
                    <p class="text-xs text-gray-500 mb-1">Brt Telur</p>
                    <p class="text-lg sm:text-xl font-bold text-gray-900">62<span class="text-xs">g</span></p>
                </div>
                <!-- Pakan -->
                <div class="p-2 sm:p-3 bg-orange-50 rounded-lg text-center">
                    <p class="text-xs text-gray-500 mb-1">Pakan/Hr</p>
                    <p class="text-lg sm:text-xl font-bold text-gray-900">150<span class="text-xs">kg</span></p>
                </div>
                <!-- Mortalitas -->
                <div class="p-2 sm:p-3 bg-rose-50 rounded-lg text-center">
                    <p class="text-xs text-gray-500 mb-1">Mati/Bln</p>
                    <p class="text-lg sm:text-xl font-bold text-gray-900">16</p>
                </div>
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════════════════════ -->
        <!-- SECTION 4: AKTIVITAS HARIAN -->
        <!-- ═══════════════════════════════════════════════════════════════ -->
        <div class="bg-white border rounded-xl sm:rounded-2xl p-4 sm:p-5 shadow-sm mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base sm:text-lg font-semibold text-gray-800">Aktivitas Harian</h3>
                <span class="text-xs text-gray-500">{{ now()->locale('id')->translatedFormat('d M Y') }}</span>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <div class="p-3 sm:p-4 bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl border border-amber-100">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-amber-500 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-600">Pemberian Pakan</span>
                    </div>
                    <p class="text-xl sm:text-2xl font-bold text-gray-900">150 kg</p>
                    <p class="text-xs text-emerald-600 mt-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Selesai hari ini
                    </p>
                </div>
                <div class="p-3 sm:p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-blue-500 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-600">Notif Pakan</span>
                    </div>
                    <p class="text-xl sm:text-2xl font-bold text-gray-900">3x</p>
                    <p class="text-xs text-gray-500 mt-1">06:00, 12:00, 18:00</p>
                </div>
                <div class="p-3 sm:p-4 bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl border border-emerald-100">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-600">Pembersihan</span>
                    </div>
                    <p class="text-xl sm:text-2xl font-bold text-gray-900">2/3</p>
                    <p class="text-xs text-amber-600 mt-1">Kandang C pending</p>
                </div>
                <div class="p-3 sm:p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl border border-purple-100">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-purple-500 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-600">Panen Hari Ini</span>
                    </div>
                    <p class="text-xl sm:text-2xl font-bold text-gray-900">245</p>
                    <p class="text-xs text-emerald-600 mt-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        +12% dari kemarin
                    </p>
                </div>
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════════════════════ -->
        <!-- SECTION 5: GRAFIK PERFORMA -->
        <!-- ═══════════════════════════════════════════════════════════════ -->
        
        <!-- Charts Row 1: FCR & Mortalitas -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-6">
            <!-- FCR Chart -->
            <div class="bg-white border rounded-xl sm:rounded-2xl p-4 sm:p-5 shadow-sm">
                <div class="flex items-center justify-between gap-2 mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">FCR Ayam</h3>
                        <p class="text-xs text-gray-500">Feed Conversion Ratio</p>
                    </div>
                    <button 
                        @click="showFCRModal = true"
                        class="inline-flex items-center gap-1.5 sm:gap-2 px-2 sm:px-3 py-1.5 text-xs sm:text-sm font-medium text-primary-4 bg-primary-1 rounded-lg hover:bg-primary-2 transition shrink-0"
                    >
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        <span class="hidden sm:inline">Edit</span>
                    </button>
                </div>
                <div class="h-48 sm:h-56">
                    <canvas id="chartFCR"></canvas>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-4 mt-3 text-xs">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded bg-emerald-500"></span>
                        <span class="text-gray-600">FCR Aktual</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-6 h-0.5 bg-red-500"></span>
                        <span class="text-gray-600">Threshold (1.8)</span>
                    </div>
                </div>
            </div>
            
            <!-- Mortalitas Chart -->
            <div class="bg-white border rounded-xl sm:rounded-2xl p-4 sm:p-5 shadow-sm">
                <div class="flex items-center justify-between gap-2 mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">Histori Mortalitas</h3>
                        <p class="text-xs text-gray-500">Kematian ayam per minggu</p>
                    </div>
                    <button 
                        @click="showMortalitasModal = true"
                        class="inline-flex items-center gap-1.5 sm:gap-2 px-2 sm:px-3 py-1.5 text-xs sm:text-sm font-medium text-primary-4 bg-primary-1 rounded-lg hover:bg-primary-2 transition shrink-0"
                    >
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        <span class="hidden sm:inline">Edit</span>
                    </button>
                </div>
                <div class="h-48 sm:h-56">
                    <canvas id="chartMortalitas"></canvas>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-4 mt-3 text-xs">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded bg-red-500"></span>
                        <span class="text-gray-600">Mortalitas</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded bg-gray-300"></span>
                        <span class="text-gray-600">Target Max</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 2: HDP & HHEP -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-6">
            <!-- HDP Chart -->
            <div class="bg-white border rounded-xl sm:rounded-2xl p-4 sm:p-5 shadow-sm">
                <div class="flex items-center justify-between gap-2 mb-4">
                    <div class="min-w-0">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">HDP (Hen Day Production)</h3>
                        <p class="text-xs text-gray-500 truncate">Produksi telur harian per kandang</p>
                    </div>
                    <button 
                        @click="showHDPModal = true"
                        class="inline-flex items-center gap-1.5 sm:gap-2 px-2 sm:px-3 py-1.5 text-xs sm:text-sm font-medium text-primary-4 bg-primary-1 rounded-lg hover:bg-primary-2 transition shrink-0"
                    >
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        <span class="hidden sm:inline">Edit Grafik</span>
                        <span class="sm:hidden">Edit</span>
                    </button>
                </div>
                <div class="h-48 sm:h-56">
                    <canvas id="chartHDP"></canvas>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-3 mt-3 text-xs">
                    <template x-for="kandang in kandangList" :key="kandang.id">
                        <div x-show="kandang.hdpVisible" class="flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded" :style="'background-color:' + kandang.color"></span>
                            <span class="text-gray-600" x-text="kandang.name"></span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- HHEP Chart -->
            <div class="bg-white border rounded-xl sm:rounded-2xl p-4 sm:p-5 shadow-sm">
                <div class="flex items-center justify-between gap-2 mb-4">
                    <div class="min-w-0">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">HHEP (Hen House Egg Production)</h3>
                        <p class="text-xs text-gray-500 truncate">Produksi telur per rumah kandang</p>
                    </div>
                    <button 
                        @click="showHHEPModal = true"
                        class="inline-flex items-center gap-1.5 sm:gap-2 px-2 sm:px-3 py-1.5 text-xs sm:text-sm font-medium text-primary-4 bg-primary-1 rounded-lg hover:bg-primary-2 transition shrink-0"
                    >
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        <span class="hidden sm:inline">Edit Grafik</span>
                        <span class="sm:hidden">Edit</span>
                    </button>
                </div>
                <div class="h-48 sm:h-56">
                    <canvas id="chartHHEP"></canvas>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-3 mt-3 text-xs">
                    <template x-for="kandang in kandangList" :key="kandang.id">
                        <div x-show="kandang.hhepVisible" class="flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded" :style="'background-color:' + kandang.color"></span>
                            <span class="text-gray-600" x-text="kandang.name"></span>
                        </div>
                    </template>
                </div>
            </div>
        </div>


    </main>

    <!-- HDP Modal - Inventory Style -->
    <div 
        x-show="showHDPModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
        @click.self="showHDPModal = false"
        style="display: none;"
    >
        <div 
            x-show="showHDPModal"
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
                    <h3 class="text-lg font-semibold text-white">Pengaturan Grafik HDP</h3>
                    <p class="text-emerald-100 text-sm">Atur tampilan dan variabel diagram</p>
                </div>
                <button @click="showHDPModal = false" class="p-1 rounded-full hover:bg-white/20 transition">
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
                                @click="hdpConfig.chartType = type.id"
                                class="p-3 rounded-xl border-2 transition-all flex flex-col items-center gap-2"
                                :class="hdpConfig.chartType === type.id ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-gray-300'"
                            >
                                <div x-html="type.icon" class="w-8 h-8 text-gray-600"></div>
                                <span class="text-xs font-medium text-gray-700" x-text="type.label"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Kandang Selection -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Data Kandang</label>
                    <div class="space-y-2 max-h-40 overflow-y-auto pr-1 border rounded-xl p-2 bg-white">
                        <template x-for="kandang in kandangList" :key="kandang.id">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" x-model="kandang.hdpVisible" class="w-4 h-4 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500">
                                    <span class="text-sm font-medium text-gray-700" x-text="kandang.name"></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <label class="text-xs text-gray-500">Warna:</label>
                                    <input type="color" x-model="kandang.color" class="w-8 h-8 rounded cursor-pointer border-0">
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Pengaturan Tampilan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pengaturan Tampilan</label>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Tampilkan Grid</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="hdpConfig.showGrid" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-emerald-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Tampilkan Titik Data</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="hdpConfig.showPoints" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-emerald-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Isi Area di Bawah Garis</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="hdpConfig.fillArea" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-emerald-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Garis Halus (Curved)</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="hdpConfig.smoothLine" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-emerald-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Rentang Waktu -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Rentang Waktu</label>
                    <select x-model="hdpConfig.timeRange" class="w-full px-4 py-2.5 border rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <template x-for="range in timeRanges" :key="range.id">
                            <option :value="range.id" x-text="range.label"></option>
                        </template>
                    </select>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 p-5 border-t bg-gray-50">
                <button @click="showHDPModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded-lg hover:bg-gray-50 transition">
                    Batal
                </button>
                <button @click="updateCharts(); showHDPModal = false" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-emerald-500 to-green-500 rounded-lg hover:from-emerald-600 hover:to-green-600 transition shadow-lg">
                    Terapkan Perubahan
                </button>
            </div>
        </div>
    </div>

    <!-- HHEP Modal - Inventory Style -->
    <div 
        x-show="showHHEPModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
        @click.self="showHHEPModal = false"
        style="display: none;"
    >
        <div 
            x-show="showHHEPModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-xl max-h-[90vh] overflow-hidden"
        >
            <div class="flex items-center justify-between p-5 border-b bg-gradient-to-r from-blue-500 to-indigo-500">
                <div>
                    <h3 class="text-lg font-semibold text-white">Pengaturan Grafik HHEP</h3>
                    <p class="text-blue-100 text-sm">Atur tampilan dan variabel diagram</p>
                </div>
                <button @click="showHHEPModal = false" class="p-1 rounded-full hover:bg-white/20 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-5 max-h-[60vh] overflow-y-auto space-y-6">
                <!-- Tipe Chart -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Tipe Diagram</label>
                    <div class="grid grid-cols-3 gap-3">
                        <template x-for="type in chartTypes" :key="type.id">
                            <button 
                                @click="hhepConfig.chartType = type.id"
                                class="p-3 rounded-xl border-2 transition-all flex flex-col items-center gap-2"
                                :class="hhepConfig.chartType === type.id ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300'"
                            >
                                <div x-html="type.icon" class="w-8 h-8 text-gray-600"></div>
                                <span class="text-xs font-medium text-gray-700" x-text="type.label"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Kandang Selection -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Data Kandang</label>
                    <div class="space-y-2 max-h-40 overflow-y-auto pr-1 border rounded-xl p-2 bg-white">
                        <template x-for="kandang in kandangList" :key="kandang.id">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" x-model="kandang.hhepVisible" class="w-4 h-4 rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                                    <span class="text-sm font-medium text-gray-700" x-text="kandang.name"></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <label class="text-xs text-gray-500">Warna:</label>
                                    <input type="color" x-model="kandang.color" class="w-8 h-8 rounded cursor-pointer border-0">
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Pengaturan Tampilan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pengaturan Tampilan</label>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Tampilkan Grid</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="hhepConfig.showGrid" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Tampilkan Titik Data</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="hhepConfig.showPoints" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Isi Area di Bawah Garis</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="hhepConfig.fillArea" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Garis Halus (Curved)</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="hhepConfig.smoothLine" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Rentang Waktu -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Rentang Waktu</label>
                    <select x-model="hhepConfig.timeRange" class="w-full px-4 py-2.5 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <template x-for="range in timeRanges" :key="range.id">
                            <option :value="range.id" x-text="range.label"></option>
                        </template>
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 p-5 border-t bg-gray-50">
                <button @click="showHHEPModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded-lg hover:bg-gray-50 transition">
                    Batal
                </button>
                <button @click="updateCharts(); showHHEPModal = false" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg hover:from-blue-600 hover:to-indigo-600 transition shadow-lg">
                    Terapkan Perubahan
                </button>
            </div>
        </div>
    </div>

    <!-- Mortalitas Modal - Inventory Style -->
    <div 
        x-show="showMortalitasModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
        @click.self="showMortalitasModal = false"
        style="display: none;"
    >
        <div 
            x-show="showMortalitasModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-xl max-h-[90vh] overflow-hidden"
        >
            <div class="flex items-center justify-between p-5 border-b bg-gradient-to-r from-red-500 to-rose-500">
                <div>
                    <h3 class="text-lg font-semibold text-white">Pengaturan Grafik Mortalitas</h3>
                    <p class="text-red-100 text-sm">Atur tampilan dan variabel diagram</p>
                </div>
                <button @click="showMortalitasModal = false" class="p-1 rounded-full hover:bg-white/20 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-5 max-h-[60vh] overflow-y-auto space-y-6">
                <!-- Tipe Chart -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Tipe Diagram</label>
                    <div class="grid grid-cols-3 gap-3">
                        <template x-for="type in chartTypes" :key="type.id">
                            <button 
                                @click="mortalitasConfig.chartType = type.id; mortalitasType = type.id"
                                class="p-3 rounded-xl border-2 transition-all flex flex-col items-center gap-2"
                                :class="mortalitasConfig.chartType === type.id ? 'border-red-500 bg-red-50' : 'border-gray-200 hover:border-gray-300'"
                            >
                                <div x-html="type.icon" class="w-8 h-8 text-gray-600"></div>
                                <span class="text-xs font-medium text-gray-700" x-text="type.label"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Pengaturan Tampilan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pengaturan Tampilan</label>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Tampilkan Grid</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="mortalitasConfig.showGrid" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-red-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Tampilkan Titik Data</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="mortalitasConfig.showPoints" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-red-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Rentang Waktu -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Rentang Waktu</label>
                    <select x-model="mortalitasConfig.timeRange" class="w-full px-4 py-2.5 border rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        <template x-for="range in timeRanges" :key="range.id">
                            <option :value="range.id" x-text="range.label"></option>
                        </template>
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 p-5 border-t bg-gray-50">
                <button @click="showMortalitasModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded-lg hover:bg-gray-50 transition">
                    Batal
                </button>
                <button @click="updateCharts(); showMortalitasModal = false" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-rose-500 rounded-lg hover:from-red-600 hover:to-rose-600 transition shadow-lg">
                    Terapkan Perubahan
                </button>
            </div>
        </div>
    </div>

    <!-- FCR Modal - Inventory Style -->
    <div 
        x-show="showFCRModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
        @click.self="showFCRModal = false"
        style="display: none;"
    >
        <div 
            x-show="showFCRModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-xl max-h-[90vh] overflow-hidden"
        >
            <div class="flex items-center justify-between p-5 border-b bg-gradient-to-r from-amber-500 to-orange-500">
                <div>
                    <h3 class="text-lg font-semibold text-white">Pengaturan Grafik FCR</h3>
                    <p class="text-amber-100 text-sm">Atur tampilan dan variabel diagram</p>
                </div>
                <button @click="showFCRModal = false" class="p-1 rounded-full hover:bg-white/20 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-5 max-h-[60vh] overflow-y-auto space-y-6">
                <!-- Tipe Chart -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Tipe Diagram</label>
                    <div class="grid grid-cols-3 gap-3">
                        <template x-for="type in chartTypes" :key="type.id">
                            <button 
                                @click="fcrConfig.chartType = type.id"
                                class="p-3 rounded-xl border-2 transition-all flex flex-col items-center gap-2"
                                :class="fcrConfig.chartType === type.id ? 'border-amber-500 bg-amber-50' : 'border-gray-200 hover:border-gray-300'"
                            >
                                <div x-html="type.icon" class="w-8 h-8 text-gray-600"></div>
                                <span class="text-xs font-medium text-gray-700" x-text="type.label"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Threshold FCR -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Threshold FCR Optimal</label>
                    <div class="p-3 bg-amber-50 rounded-xl border border-amber-100 mb-3">
                        <p class="text-sm text-amber-700">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            FCR di bawah threshold = baik (zona hijau)
                        </p>
                    </div>
                    <input type="number" x-model="fcrConfig.threshold" step="0.1" min="1" max="3" class="w-full border rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                </div>

                <!-- Pengaturan Tampilan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pengaturan Tampilan</label>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Tampilkan Grid</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="fcrConfig.showGrid" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-amber-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Tampilkan Titik Data</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="fcrConfig.showPoints" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-amber-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Isi Area di Bawah Garis</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="fcrConfig.fillArea" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-amber-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-700">Tampilkan Garis Threshold</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="fcrConfig.showThreshold" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-amber-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Rentang Waktu -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Rentang Waktu</label>
                    <select x-model="fcrConfig.timeRange" class="w-full px-4 py-2.5 border rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        <template x-for="range in timeRanges" :key="range.id">
                            <option :value="range.id" x-text="range.label"></option>
                        </template>
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 p-5 border-t bg-gray-50">
                <button @click="showFCRModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded-lg hover:bg-gray-50 transition">
                    Batal
                </button>
                <button @click="fcrThreshold = fcrConfig.threshold; showFCRThreshold = fcrConfig.showThreshold; updateCharts(); showFCRModal = false" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-amber-500 to-orange-500 rounded-lg hover:from-amber-600 hover:to-orange-600 transition shadow-lg">
                    Terapkan Perubahan
                </button>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@2.0.0/dist/chartjs-plugin-annotation.min.js"></script>
<script>
function ayamDashboard() {
    return {
        open: false,
        
        // Modal states
        showHDPModal: false,
        showHHEPModal: false,
        showMortalitasModal: false,
        showFCRModal: false,
        
        // Chart configs - inventory style
        chartTypes: [
            { id: 'line', label: 'Line', icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12l6-6 4 8 8-10"/></svg>' },
            { id: 'bar', label: 'Bar', icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="4" height="10"/><rect x="10" y="6" width="4" height="14"/><rect x="17" y="2" width="4" height="18"/></svg>' },
            { id: 'area', label: 'Area', icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 20V12l6-6 4 8 8-10v16H3z" fill="currentColor" opacity="0.2"/><path d="M3 12l6-6 4 8 8-10"/></svg>' }
        ],
        
        timeRanges: [
            { id: 'daily', label: 'Harian' },
            { id: '7days', label: '7 Hari Terakhir' },
            { id: '30days', label: '30 Hari Terakhir' },
            { id: '3months', label: '3 Bulan Terakhir' },
            { id: '6months', label: '6 Bulan Terakhir' },
            { id: 'ytd', label: 'Year to Date' }
        ],
        
        // HDP Config
        hdpConfig: {
            chartType: 'line',
            timeRange: '7days',
            showGrid: true,
            showPoints: true,
            fillArea: false,
            smoothLine: true
        },
        
        // HHEP Config
        hhepConfig: {
            chartType: 'line',
            timeRange: '7days',
            showGrid: true,
            showPoints: true,
            fillArea: false,
            smoothLine: true
        },
        
        // FCR Config
        fcrConfig: {
            chartType: 'line',
            timeRange: '7days',
            showGrid: true,
            showPoints: true,
            fillArea: true,
            smoothLine: true,
            threshold: 1.8,
            showThreshold: true
        },
        
        // Mortalitas Config
        mortalitasConfig: {
            chartType: 'bar',
            timeRange: '30days',
            showGrid: true,
            showPoints: false,
            fillArea: false,
            smoothLine: false
        },
        
        // Legacy compatibility
        fcrThreshold: 1.8,
        showFCRThreshold: true,
        mortalitasRange: 'weekly',
        mortalitasType: 'bar',
        
        // Kandang list with separate visibility for each chart
        kandangList: [
            { id: 1, name: 'Kandang A', color: '#10B981', hdpVisible: true, hhepVisible: true },
            { id: 2, name: 'Kandang B', color: '#3B82F6', hdpVisible: true, hhepVisible: true },
            { id: 3, name: 'Kandang C', color: '#F59E0B', hdpVisible: true, hhepVisible: true },
        ],
        
        // Chart instances
        charts: {},
        
        // Chart data
        chartData: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            hdp: {
                1: [92, 90, 93, 91, 94, 92, 93],
                2: [88, 89, 87, 90, 88, 91, 89],
                3: [85, 86, 84, 87, 85, 86, 88]
            },
            hhep: {
                1: [90, 88, 91, 89, 92, 90, 91],
                2: [86, 87, 85, 88, 86, 89, 87],
                3: [83, 84, 82, 85, 83, 84, 86]
            },
            fcr: [1.85, 1.82, 1.78, 1.80, 1.75, 1.82, 1.79],
            mortalitas: [3, 2, 4, 1, 2, 1, 3]
        },
        
        init() {
            // Use setTimeout to ensure Chart.js is fully loaded
            const self = this;
            setTimeout(() => {
                console.log('Initializing all charts...');
                self.initAllCharts();
            }, 300);
        },
        
        initAllCharts() {
            // Initialize charts sequentially with small delays to avoid conflicts
            const self = this;
            console.log('initAllCharts called', self.chartData);
            
            self.initFCRChart();
            
            setTimeout(() => {
                console.log('Initializing HDP...');
                self.initHDPChart();
            }, 100);
            
            setTimeout(() => {
                console.log('Initializing HHEP...');
                self.initHHEPChart();
            }, 200);
            
            setTimeout(() => {
                console.log('Initializing Mortalitas...');
                self.initMortalitasChart();
            }, 300);
        },
        
        initFCRChart() {
            const canvas = document.getElementById('chartFCR');
            if (!canvas) return;
            
            // Properly destroy existing chart using Chart.getChart
            const existingChart = Chart.getChart(canvas);
            if (existingChart) {
                existingChart.destroy();
            }
            
            // Determine chart type from config
            const chartType = this.fcrConfig.chartType === 'area' ? 'line' : this.fcrConfig.chartType;
            const fillArea = this.fcrConfig.chartType === 'area' || this.fcrConfig.fillArea;
            
            // Generate labels and data based on time range
            let labels, fcrData;
            switch(this.fcrConfig.timeRange) {
                case 'daily':
                    labels = ['Hari Ini'];
                    fcrData = [1.79];
                    break;
                case '7days':
                    labels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                    fcrData = this.chartData.fcr;
                    break;
                case '30days':
                    labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
                    fcrData = [1.85, 1.82, 1.78, 1.76];
                    break;
                case '3months':
                    labels = ['Bulan 1', 'Bulan 2', 'Bulan 3'];
                    fcrData = [1.90, 1.85, 1.80];
                    break;
                case '6months':
                    labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
                    fcrData = [1.95, 1.92, 1.88, 1.85, 1.82, 1.79];
                    break;
                case 'ytd':
                    labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                    fcrData = [2.0, 1.98, 1.95, 1.92, 1.90, 1.88, 1.85, 1.83, 1.81, 1.80, 1.79, 1.78];
                    break;
                default:
                    labels = this.chartData.labels;
                    fcrData = this.chartData.fcr;
            }
            
            this.charts.fcr = new Chart(canvas, {
                type: chartType,
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'FCR',
                        data: fcrData,
                        borderColor: '#10B981',
                        backgroundColor: fillArea ? 'rgba(16, 185, 129, 0.3)' : 'rgba(16, 185, 129, 0.1)',
                        fill: fillArea,
                        tension: this.fcrConfig.smoothLine ? 0.4 : 0,
                        pointRadius: this.fcrConfig.showPoints ? 4 : 0,
                        pointBackgroundColor: '#10B981',
                        borderRadius: chartType === 'bar' ? 4 : 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        annotation: this.fcrConfig.showThreshold ? {
                            annotations: {
                                threshold: {
                                    type: 'line',
                                    yMin: this.fcrConfig.threshold,
                                    yMax: this.fcrConfig.threshold,
                                    borderColor: '#EF4444',
                                    borderWidth: 2,
                                    borderDash: [5, 5],
                                    label: {
                                        display: true,
                                        content: 'Threshold ' + this.fcrConfig.threshold,
                                        position: 'end',
                                        backgroundColor: '#EF4444',
                                        color: '#fff',
                                        font: { size: 10 }
                                    }
                                }
                            }
                        } : {}
                    },
                    scales: {
                        y: { 
                            beginAtZero: false,
                            min: 1.5,
                            max: 2.2,
                            grid: { display: this.fcrConfig.showGrid, color: 'rgba(0,0,0,0.05)' }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });
        },
        
        initHDPChart() {
            const canvas = document.getElementById('chartHDP');
            if (!canvas) {
                console.error('HDP canvas not found');
                return;
            }
            
            // Properly destroy existing chart using Chart.getChart
            const existingChart = Chart.getChart(canvas);
            if (existingChart) {
                existingChart.destroy();
            }
            
            // Determine chart type from config
            const chartType = this.hdpConfig.chartType === 'area' ? 'line' : this.hdpConfig.chartType;
            const fillArea = this.hdpConfig.chartType === 'area' || this.hdpConfig.fillArea;
            
            // Generate labels and data based on time range
            let labels, hdpData;
            switch(this.hdpConfig.timeRange) {
                case 'daily':
                    labels = ['Hari Ini'];
                    hdpData = { 1: [93], 2: [89], 3: [88] };
                    break;
                case '7days':
                    labels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                    hdpData = this.chartData.hdp;
                    break;
                case '30days':
                    labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
                    hdpData = { 1: [91, 92, 93, 94], 2: [87, 88, 89, 90], 3: [84, 85, 86, 87] };
                    break;
                case '3months':
                    labels = ['Bulan 1', 'Bulan 2', 'Bulan 3'];
                    hdpData = { 1: [90, 92, 93], 2: [86, 88, 89], 3: [83, 85, 86] };
                    break;
                case '6months':
                    labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
                    hdpData = { 1: [88, 89, 90, 91, 92, 93], 2: [84, 85, 86, 87, 88, 89], 3: [81, 82, 83, 84, 85, 86] };
                    break;
                case 'ytd':
                    labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                    hdpData = { 1: [85, 86, 87, 88, 89, 90, 91, 92, 93, 93, 94, 94], 2: [81, 82, 83, 84, 85, 86, 87, 88, 89, 89, 90, 90], 3: [78, 79, 80, 81, 82, 83, 84, 85, 86, 86, 87, 87] };
                    break;
                default:
                    labels = this.chartData.labels;
                    hdpData = this.chartData.hdp;
            }
            
            const datasets = this.kandangList
                .filter(k => k.hdpVisible)
                .map(k => ({
                    label: k.name,
                    data: hdpData[k.id],
                    borderColor: k.color,
                    backgroundColor: fillArea ? k.color + '40' : k.color + '20',
                    fill: fillArea,
                    tension: this.hdpConfig.smoothLine ? 0.4 : 0,
                    pointRadius: this.hdpConfig.showPoints ? 3 : 0,
                    borderRadius: chartType === 'bar' ? 4 : 0
                }));
            
            this.charts.hdp = new Chart(canvas, {
                    type: chartType,
                    data: { labels, datasets },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { 
                                beginAtZero: false,
                                min: 70,
                                max: 100,
                                ticks: { callback: v => v + '%' },
                                grid: { display: this.hdpConfig.showGrid, color: 'rgba(0,0,0,0.05)' }
                            },
                            x: { grid: { display: false } }
                        }
                }
            });
        },
        
        initHHEPChart() {
            const canvas = document.getElementById('chartHHEP');
            if (!canvas) {
                console.error('HHEP canvas not found');
                return;
            }
            
            // Properly destroy existing chart using Chart.getChart
            const existingChart = Chart.getChart(canvas);
            if (existingChart) {
                existingChart.destroy();
            }
            
            // Determine chart type from config
            const chartType = this.hhepConfig.chartType === 'area' ? 'line' : this.hhepConfig.chartType;
            const fillArea = this.hhepConfig.chartType === 'area' || this.hhepConfig.fillArea;
            
            // Generate labels and data based on time range
            let labels, hhepData;
            switch(this.hhepConfig.timeRange) {
                case 'daily':
                    labels = ['Hari Ini'];
                    hhepData = { 1: [91], 2: [87], 3: [86] };
                    break;
                case '7days':
                    labels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                    hhepData = this.chartData.hhep;
                    break;
                case '30days':
                    labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
                    hhepData = { 1: [89, 90, 91, 92], 2: [85, 86, 87, 88], 3: [82, 83, 84, 85] };
                    break;
                case '3months':
                    labels = ['Bulan 1', 'Bulan 2', 'Bulan 3'];
                    hhepData = { 1: [88, 90, 91], 2: [84, 86, 87], 3: [81, 83, 84] };
                    break;
                case '6months':
                    labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
                    hhepData = { 1: [86, 87, 88, 89, 90, 91], 2: [82, 83, 84, 85, 86, 87], 3: [79, 80, 81, 82, 83, 84] };
                    break;
                case 'ytd':
                    labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                    hhepData = { 1: [83, 84, 85, 86, 87, 88, 89, 90, 91, 91, 92, 92], 2: [79, 80, 81, 82, 83, 84, 85, 86, 87, 87, 88, 88], 3: [76, 77, 78, 79, 80, 81, 82, 83, 84, 84, 85, 85] };
                    break;
                default:
                    labels = this.chartData.labels;
                    hhepData = this.chartData.hhep;
            }
            
            const datasets = this.kandangList
                .filter(k => k.hhepVisible)
                .map(k => ({
                    label: k.name,
                    data: hhepData[k.id],
                    borderColor: k.color,
                    backgroundColor: fillArea ? k.color + '40' : k.color + '20',
                    fill: fillArea,
                    tension: this.hhepConfig.smoothLine ? 0.4 : 0,
                    pointRadius: this.hhepConfig.showPoints ? 3 : 0,
                    borderRadius: chartType === 'bar' ? 4 : 0
                }));
            
            this.charts.hhep = new Chart(canvas, {
                type: chartType,
                data: { labels, datasets },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { 
                            beginAtZero: false,
                            min: 70,
                            max: 100,
                            ticks: { callback: v => v + '%' },
                            grid: { display: this.hhepConfig.showGrid, color: 'rgba(0,0,0,0.05)' }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });
        },
        
        initMortalitasChart() {
            const canvas = document.getElementById('chartMortalitas');
            if (!canvas) {
                console.error('Mortalitas canvas not found');
                return;
            }
            
            // Properly destroy existing chart using Chart.getChart
            const existingChart = Chart.getChart(canvas);
            if (existingChart) {
                existingChart.destroy();
            }
            
            // Determine chart type from config
            const chartType = this.mortalitasConfig.chartType === 'area' ? 'line' : this.mortalitasConfig.chartType;
            const fillArea = this.mortalitasConfig.chartType === 'area' || this.mortalitasConfig.fillArea;
            
            // Generate labels based on time range
            let labels, data;
            switch(this.mortalitasConfig.timeRange) {
                case 'daily':
                    labels = ['Hari Ini'];
                    data = [3];
                    break;
                case '7days':
                    labels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                    data = [3, 2, 4, 1, 2, 1, 3];
                    break;
                case '30days':
                    labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
                    data = [3, 2, 4, 1];
                    break;
                case '3months':
                    labels = ['Bulan 1', 'Bulan 2', 'Bulan 3'];
                    data = [8, 6, 10];
                    break;
                case '6months':
                    labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
                    data = [8, 6, 10, 5, 7, 4];
                    break;
                case 'ytd':
                    labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                    data = [8, 6, 10, 5, 7, 4, 6, 8, 5, 9, 7, 6];
                    break;
                default:
                    labels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                    data = this.chartData.mortalitas;
            }
            
            this.charts.mortalitas = new Chart(canvas, {
                type: chartType,
                data: {
                    labels,
                    datasets: [{
                        label: 'Kematian',
                        data,
                        backgroundColor: chartType === 'bar' ? '#EF4444' : (fillArea ? 'rgba(239, 68, 68, 0.3)' : 'rgba(239, 68, 68, 0.1)'),
                        borderColor: '#EF4444',
                        borderRadius: chartType === 'bar' ? 4 : 0,
                        fill: fillArea,
                        tension: this.mortalitasConfig.smoothLine ? 0.4 : 0,
                        pointRadius: this.mortalitasConfig.showPoints ? 3 : 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { 
                            beginAtZero: true,
                            grid: { display: this.mortalitasConfig.showGrid, color: 'rgba(0,0,0,0.05)' }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });
        },
        
        updateCharts() {
            this.initFCRChart();
            this.initHDPChart();
            this.initHHEPChart();
            this.initMortalitasChart();
        }
    }
}
</script>
@endsection