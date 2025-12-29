@extends('layouts.admin')

@section('content')
<div x-data="activitiesPage()" class="flex bg-gray-50 min-h-screen overflow-x-hidden">

    @include('components.layouts.sidebar')

    <main class="flex-1 p-4 lg:p-8 lg:ml-72 max-w-full">
        
        <!-- Mobile Topbar -->
        <div class="flex items-center justify-between mb-4 lg:hidden">
            <div class="flex items-center gap-3">
                <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                    <img src="/assets/icons/menu.svg" class="w-6 h-6">
                </button>
                <div>
                    <h1 class="text-lg font-bold text-gray-900">Riwayat Aktivitas</h1>
                    <div class="flex items-center gap-1 text-xs text-gray-500">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                        <span>Log</span>
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
                <span class="font-semibold text-gray-900">Riwayat Aktivitas</span>
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
        <div class="mb-6 lg:mb-8 hidden lg:block">
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">Riwayat Aktivitas</h1>
            <p class="text-gray-600">Pantau semua aktivitas yang terjadi di sistem.</p>
        </div>

        <!-- Hero Banner -->
        <div class="relative overflow-hidden rounded-xl sm:rounded-2xl bg-gradient-to-r from-emerald-500 via-green-500 to-teal-500 p-4 sm:p-6 md:p-8 mb-6 shadow-lg">
            <div class="relative z-10">
                <h2 class="text-xl md:text-2xl font-bold text-white mb-2">
                    Log Aktivitas Sistem
                </h2>
                <p class="text-emerald-100 text-sm md:text-base max-w-2xl">
                    Lihat semua aktivitas pengguna seperti login, perubahan data, dan operasi lainnya di sistem.
                </p>
                <p class="text-emerald-200 text-sm mt-3 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span x-text="activities.length + ' aktivitas tercatat'"></span>
                </p>
            </div>
            
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 hidden sm:block"></div>
            <div class="absolute bottom-0 left-1/2 w-32 h-32 bg-white/5 rounded-full translate-y-1/2 hidden sm:block"></div>
        </div>

        <!-- Quick Stats Row -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
            <div class="bg-white border rounded-xl p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Hari Ini</p>
                        <p class="text-xl font-bold text-gray-900">24</p>
                    </div>
                </div>
            </div>
            <div class="bg-white border rounded-xl p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Minggu Ini</p>
                        <p class="text-xl font-bold text-gray-900">156</p>
                    </div>
                </div>
            </div>
            <div class="bg-white border rounded-xl p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Bulan Ini</p>
                        <p class="text-xl font-bold text-gray-900">892</p>
                    </div>
                </div>
            </div>
            <div class="bg-white border rounded-xl p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Login Hari Ini</p>
                        <p class="text-xl font-bold text-gray-900">12</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toolbar -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
            
            <!-- Search & Filters -->
            <div class="flex flex-wrap items-center gap-3">
                <!-- Search -->
                <div class="relative">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input 
                        type="text" 
                        x-model="searchQuery"
                        placeholder="Cari aktivitas..."
                        class="pl-10 pr-4 py-2 bg-white border rounded-lg shadow-sm text-sm w-48 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    >
                </div>

                <div class="h-6 w-px bg-gray-300 hidden sm:block"></div>

                <!-- Type Dropdown -->
                <div class="relative">
                    <button @click="typeOpen = !typeOpen" @click.outside="typeOpen = false" class="px-3 sm:px-4 py-2 bg-white border rounded-lg shadow-sm text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                        <span class="hidden sm:inline">Tipe:</span>
                        <span class="font-medium" x-text="selectedType"></span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="typeOpen" x-transition class="absolute z-20 mt-1 w-48 bg-white rounded-lg shadow-lg border py-1" style="display: none;">
                        <template x-for="type in types" :key="type">
                            <button 
                                @click="selectedType = type; typeOpen = false"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 flex items-center justify-between"
                                :class="selectedType === type ? 'text-emerald-700 bg-emerald-50' : 'text-gray-700'"
                            >
                                <span x-text="type"></span>
                                <svg x-show="selectedType === type" class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Date Range Dropdown -->
                <div class="relative">
                    <button @click="dateOpen = !dateOpen" @click.outside="dateOpen = false" class="px-3 sm:px-4 py-2 bg-white border rounded-lg shadow-sm text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="font-medium" x-text="selectedDate"></span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="dateOpen" x-transition class="absolute z-20 mt-1 w-48 bg-white rounded-lg shadow-lg border py-1" style="display: none;">
                        <template x-for="date in dateRanges" :key="date">
                            <button 
                                @click="selectedDate = date; dateOpen = false"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 flex items-center justify-between"
                                :class="selectedDate === date ? 'text-emerald-700 bg-emerald-50' : 'text-gray-700'"
                            >
                                <span x-text="date"></span>
                                <svg x-show="selectedDate === date" class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Export Button -->
            <button class="inline-flex items-center justify-center gap-2 bg-white border hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-lg font-medium transition shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span>Export Log</span>
            </button>
        </div>

        <!-- Activity Timeline -->
        <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
            <div class="p-4 sm:p-5 border-b bg-gradient-to-r from-gray-50 to-white">
                <h3 class="font-semibold text-gray-800">Timeline Aktivitas</h3>
            </div>
            
            <div class="divide-y">
                <template x-for="(activity, index) in filteredActivities" :key="activity.id">
                    <div class="p-4 sm:p-5 hover:bg-gray-50 transition">
                        <div class="flex items-start gap-4">
                            <!-- Icon -->
                            <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center" :class="getActivityIconClass(activity.type)">
                                <template x-if="activity.type === 'login'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                                </template>
                                <template x-if="activity.type === 'create'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </template>
                                <template x-if="activity.type === 'update'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </template>
                                <template x-if="activity.type === 'delete'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </template>
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <p class="text-sm text-gray-900">
                                            <span class="font-semibold" x-text="activity.user"></span>
                                            <span class="text-gray-600" x-text="activity.action"></span>
                                        </p>
                                        <p class="text-sm text-gray-500 mt-0.5" x-text="activity.description"></p>
                                    </div>
                                    <span class="text-xs text-gray-400 whitespace-nowrap flex-shrink-0" x-text="activity.time"></span>
                                </div>
                                
                                <!-- Tags -->
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium" :class="getActivityBadgeClass(activity.type)" x-text="getActivityLabel(activity.type)"></span>
                                    <span class="text-xs text-gray-400" x-text="activity.module"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Empty State -->
                <div x-show="filteredActivities.length === 0" class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada aktivitas ditemukan</h3>
                    <p class="text-gray-500">Coba ubah filter untuk melihat aktivitas lainnya.</p>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-8">
            <p class="text-sm text-gray-500 order-2 sm:order-1">
                Menampilkan <span class="font-bold text-gray-900" x-text="filteredActivities.length > 0 ? 1 : 0"></span> sampai <span class="font-bold text-gray-900" x-text="filteredActivities.length"></span> dari <span class="font-bold text-gray-900" x-text="activities.length"></span> aktivitas
            </p>
            
            <div class="flex items-center gap-2 order-1 sm:order-2">
                <button class="px-3 sm:px-4 py-2 border rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    Sebelumnya
                </button>
                <div class="flex gap-1">
                    <button class="w-9 h-9 flex items-center justify-center rounded-lg bg-emerald-500 text-white font-medium text-sm">1</button>
                    <button class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-gray-50 text-gray-600 font-medium text-sm">2</button>
                    <button class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-gray-50 text-gray-600 font-medium text-sm">3</button>
                </div>
                <button class="px-3 sm:px-4 py-2 border rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    Selanjutnya
                </button>
            </div>
        </div>

    </main>
</div>

<script>
function activitiesPage() {
    return {
        open: false,
        searchQuery: '',
        typeOpen: false,
        dateOpen: false,
        selectedType: 'Semua',
        selectedDate: 'Hari Ini',
        
        types: ['Semua', 'Login', 'Create', 'Update', 'Delete'],
        dateRanges: ['Hari Ini', 'Kemarin', '7 Hari Terakhir', '30 Hari Terakhir', 'Bulan Ini'],
        
        activities: [
            {
                id: 1,
                user: 'Ahmad Fauzi',
                action: 'menambahkan item baru',
                description: 'Pupuk NPK Premium - 100 kg',
                type: 'create',
                module: 'Inventaris',
                time: '10 menit yang lalu'
            },
            {
                id: 2,
                user: 'Siti Rahayu',
                action: 'masuk ke sistem',
                description: 'Login dari perangkat Android',
                type: 'login',
                module: 'Autentikasi',
                time: '25 menit yang lalu'
            },
            {
                id: 3,
                user: 'Budi Santoso',
                action: 'memperbarui data',
                description: 'Mengubah stok Pakan Ternak dari 50 menjadi 100',
                type: 'update',
                module: 'Inventaris',
                time: '1 jam yang lalu'
            },
            {
                id: 4,
                user: 'Dewi Lestari',
                action: 'menghapus laporan',
                description: 'Laporan Harian - 25 Desember 2024',
                type: 'delete',
                module: 'Laporan',
                time: '2 jam yang lalu'
            },
            {
                id: 5,
                user: 'Ahmad Fauzi',
                action: 'masuk ke sistem',
                description: 'Login dari perangkat Desktop',
                type: 'login',
                module: 'Autentikasi',
                time: '3 jam yang lalu'
            },
            {
                id: 6,
                user: 'Eko Prasetyo',
                action: 'menambahkan kandang baru',
                description: 'Kandang C - Kapasitas 500 ekor',
                type: 'create',
                module: 'Kandang',
                time: '4 jam yang lalu'
            },
            {
                id: 7,
                user: 'Fitri Handayani',
                action: 'memperbarui profil',
                description: 'Mengubah nomor telepon',
                type: 'update',
                module: 'User',
                time: '5 jam yang lalu'
            },
            {
                id: 8,
                user: 'Budi Santoso',
                action: 'membuat laporan panen',
                description: 'Panen Jagung - 2500 kg',
                type: 'create',
                module: 'Laporan',
                time: '6 jam yang lalu'
            }
        ],
        
        get filteredActivities() {
            return this.activities.filter(activity => {
                // Search filter
                if (this.searchQuery) {
                    const query = this.searchQuery.toLowerCase();
                    if (!activity.user.toLowerCase().includes(query) && 
                        !activity.action.toLowerCase().includes(query) && 
                        !activity.description.toLowerCase().includes(query)) {
                        return false;
                    }
                }
                
                // Type filter
                if (this.selectedType !== 'Semua' && activity.type.toLowerCase() !== this.selectedType.toLowerCase()) {
                    return false;
                }
                
                return true;
            });
        },
        
        getActivityIconClass(type) {
            const classes = {
                'login': 'bg-blue-100 text-blue-600',
                'create': 'bg-emerald-100 text-emerald-600',
                'update': 'bg-amber-100 text-amber-600',
                'delete': 'bg-red-100 text-red-600'
            };
            return classes[type] || 'bg-gray-100 text-gray-600';
        },
        
        getActivityBadgeClass(type) {
            const classes = {
                'login': 'bg-blue-50 text-blue-700 border border-blue-100',
                'create': 'bg-emerald-50 text-emerald-700 border border-emerald-100',
                'update': 'bg-amber-50 text-amber-700 border border-amber-100',
                'delete': 'bg-red-50 text-red-700 border border-red-100'
            };
            return classes[type] || 'bg-gray-50 text-gray-700';
        },
        
        getActivityLabel(type) {
            const labels = {
                'login': 'Login',
                'create': 'Tambah',
                'update': 'Update',
                'delete': 'Hapus'
            };
            return labels[type] || type;
        }
    }
}
</script>
@endsection
