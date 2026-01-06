@extends('layouts.admin')

@section('content')
<div x-data="usersPage()" class="flex bg-gray-50 min-h-screen overflow-x-hidden">

    @include('components.layouts.sidebar')

    <main class="flex-1 p-4 lg:p-8 lg:ml-72 max-w-full">
        
        <!-- Mobile Topbar -->
        <div class="flex items-center justify-between mb-4 lg:hidden">
            <div class="flex items-center gap-3">
                <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                    <img src="/assets/icons/menu.svg" class="w-6 h-6">
                </button>
                <div>
                    <h1 class="text-lg font-bold text-gray-900">Manajemen User</h1>
                    <div class="flex items-center gap-1 text-xs text-gray-500">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                        <span>Admin</span>
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
                <span class="font-semibold text-gray-900">Manajemen User</span>
            </div>

            <div class="hidden lg:flex items-center gap-4">
                @include('components.ui.notification-bell')
                <button class="p-2 rounded-full hover:bg-gray-100 transition">
                    <img src="/assets/icons/user.svg" class="w-5 h-5">
                </button>
            </div>
        </div>

        <!-- Page Title -->
        <div class="mb-6 lg:mb-8 hidden lg:block">
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">Manajemen User</h1>
            <p class="text-gray-600">Kelola pengguna sistem dan atur hak akses mereka.</p>
        </div>

        <!-- Hero Banner -->
        <div class="relative overflow-hidden rounded-xl sm:rounded-2xl bg-gradient-to-r from-emerald-500 via-green-500 to-teal-500 p-4 sm:p-6 md:p-8 mb-6 shadow-lg">
            <div class="relative z-10">
                <h2 class="text-xl md:text-2xl font-bold text-white mb-2">
                    Kelola Pengguna Sistem
                </h2>
                <p class="text-emerald-100 text-sm md:text-base max-w-2xl">
                    Tambah pengguna baru, atur role dan hak akses, serta pantau aktivitas pengguna di sistem.
                </p>
                <p class="text-emerald-200 text-sm mt-3 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    <span x-text="users.length + ' pengguna terdaftar'"></span>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Total User</p>
                        <p class="text-xl font-bold text-gray-900" x-text="users.length"></p>
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
                        <p class="text-xs text-gray-500">User Aktif</p>
                        <p class="text-xl font-bold text-gray-900" x-text="users.filter(u => u.status === 'Aktif').length"></p>
                    </div>
                </div>
            </div>
            <div class="bg-white border rounded-xl p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">User Baru</p>
                        <p class="text-xl font-bold text-gray-900">3</p>
                    </div>
                </div>
            </div>
            <div class="bg-white border rounded-xl p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Nonaktif</p>
                        <p class="text-xl font-bold text-gray-900" x-text="users.filter(u => u.status === 'Nonaktif').length"></p>
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
                        placeholder="Cari user..."
                        class="pl-10 pr-4 py-2 bg-white border rounded-lg shadow-sm text-sm w-48 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    >
                </div>

                <div class="h-6 w-px bg-gray-300 hidden sm:block"></div>

                <!-- Role Dropdown -->
                <div class="relative">
                    <button @click="roleOpen = !roleOpen" @click.outside="roleOpen = false" class="px-3 sm:px-4 py-2 bg-white border rounded-lg shadow-sm text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                        <span class="hidden sm:inline">Role:</span>
                        <span class="font-medium" x-text="selectedRole"></span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="roleOpen" x-transition class="absolute z-20 mt-1 w-48 bg-white rounded-lg shadow-lg border py-1" style="display: none;">
                        <template x-for="role in roles" :key="role">
                            <button 
                                @click="selectedRole = role; roleOpen = false"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 flex items-center justify-between"
                                :class="selectedRole === role ? 'text-emerald-700 bg-emerald-50' : 'text-gray-700'"
                            >
                                <span x-text="role"></span>
                                <svg x-show="selectedRole === role" class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
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
                        <template x-for="status in statuses" :key="status">
                            <button 
                                @click="selectedStatus = status; statusOpen = false"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 flex items-center justify-between"
                                :class="selectedStatus === status ? 'text-emerald-700 bg-emerald-50' : 'text-gray-700'"
                            >
                                <span x-text="status"></span>
                                <svg x-show="selectedStatus === status" class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Add Button -->
            <button class="inline-flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-full font-medium transition shadow-sm shadow-emerald-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Tambah User</span>
            </button>
        </div>

        <!-- Table Header - Desktop only -->
        <div class="hidden lg:grid grid-cols-12 gap-4 px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
            <div class="col-span-4">User</div>
            <div class="col-span-2">Role</div>
            <div class="col-span-2">Status</div>
            <div class="col-span-3">Login Terakhir</div>
            <div class="col-span-1 text-right">Aksi</div>
        </div>

        <!-- User List -->
        <div class="space-y-3 lg:space-y-4">
            <template x-for="(user, index) in filteredUsers" :key="user.id">
                <div class="bg-white rounded-xl border border-gray-200 p-3 sm:p-4 lg:p-5 shadow-sm hover:shadow-md transition-shadow group">
                    
                    <!-- Mobile Layout -->
                    <div class="lg:hidden">
                        <div class="flex items-start gap-3">
                            <!-- Avatar -->
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-400 to-green-500 flex-shrink-0 flex items-center justify-center text-white font-bold text-lg" x-text="user.name.charAt(0)"></div>
                            
                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0">
                                        <h3 class="font-bold text-gray-900 text-sm truncate" x-text="user.name"></h3>
                                        <p class="text-xs text-gray-500 truncate" x-text="user.email"></p>
                                    </div>
                                    
                                    <!-- Action Dropdown -->
                                    <div class="relative flex-shrink-0">
                                        <button 
                                            @click.stop="toggleAction(index)" 
                                            class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                        </button>
                                        <div 
                                            x-show="activeAction === index" 
                                            @click.outside="activeAction = null"
                                            x-transition
                                            class="absolute right-0 z-20 mt-1 w-44 bg-white rounded-lg shadow-lg border py-1"
                                            style="display: none;"
                                        >
                                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Lihat Profil
                                            </a>
                                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                Edit User
                                            </a>
                                            <button @click="toggleUserStatus(user)" class="flex items-center gap-2 px-4 py-2 text-sm w-full text-left" :class="user.status === 'Aktif' ? 'text-amber-600 hover:bg-amber-50' : 'text-emerald-600 hover:bg-emerald-50'">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                <span x-text="user.status === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan'"></span>
                                            </button>
                                            <hr class="my-1">
                                            <button @click="deleteUser(user)" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 w-full text-left">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Role & Status Row -->
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium" :class="getRoleBadgeClass(user.role)" x-text="user.role"></span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium" :class="user.status === 'Aktif' ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-600'">
                                        <span class="w-1.5 h-1.5 rounded-full" :class="user.status === 'Aktif' ? 'bg-emerald-500' : 'bg-gray-400'"></span>
                                        <span x-text="user.status"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Layout -->
                    <div class="hidden lg:grid grid-cols-12 gap-4 items-center">
                        
                        <!-- User Details -->
                        <div class="col-span-4 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br flex-shrink-0 flex items-center justify-center text-white font-bold text-lg" :class="getAvatarGradient(user.role)" x-text="user.name.charAt(0)"></div>
                            <div>
                                <h3 class="font-bold text-gray-900" x-text="user.name"></h3>
                                <p class="text-sm text-gray-500" x-text="user.email"></p>
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="col-span-2">
                            <span class="px-3 py-1 rounded-full text-xs font-medium" :class="getRoleBadgeClass(user.role)" x-text="user.role"></span>
                        </div>

                        <!-- Status -->
                        <div class="col-span-2">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium" :class="user.status === 'Aktif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-gray-100 text-gray-600 border border-gray-200'">
                                <span class="w-1.5 h-1.5 rounded-full" :class="user.status === 'Aktif' ? 'bg-emerald-500' : 'bg-gray-400'"></span>
                                <span x-text="user.status"></span>
                            </span>
                        </div>

                        <!-- Last Login -->
                        <div class="col-span-3 flex items-center gap-2 text-gray-500 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span x-text="user.lastLogin"></span>
                        </div>

                        <!-- Action -->
                        <div class="col-span-1 flex justify-end relative">
                            <button 
                                @click.stop="toggleAction(index)" 
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
                                    Lihat Profil
                                </a>
                                <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit User
                                </a>
                                <button @click="toggleUserStatus(user)" class="flex items-center gap-2 px-4 py-2 text-sm w-full text-left" :class="user.status === 'Aktif' ? 'text-amber-600 hover:bg-amber-50' : 'text-emerald-600 hover:bg-emerald-50'">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                    <span x-text="user.status === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan'"></span>
                                </button>
                                <hr class="my-1">
                                <button @click="deleteUser(user)" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 w-full text-left">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Empty State -->
            <div x-show="filteredUsers.length === 0" class="text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada user ditemukan</h3>
                <p class="text-gray-500">Coba ubah filter atau tambah user baru.</p>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-8">
            <p class="text-sm text-gray-500 order-2 sm:order-1">
                Menampilkan <span class="font-bold text-gray-900" x-text="filteredUsers.length > 0 ? 1 : 0"></span> sampai <span class="font-bold text-gray-900" x-text="filteredUsers.length"></span> dari <span class="font-bold text-gray-900" x-text="users.length"></span> user
            </p>
            
            <div class="flex items-center gap-2 order-1 sm:order-2">
                <button class="px-3 sm:px-4 py-2 border rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    Sebelumnya
                </button>
                <div class="flex gap-1">
                    <button class="w-9 h-9 flex items-center justify-center rounded-lg bg-emerald-500 text-white font-medium text-sm">1</button>
                </div>
                <button class="px-3 sm:px-4 py-2 border rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    Selanjutnya
                </button>
            </div>
        </div>

    </main>
</div>

<script>
function usersPage() {
    return {
        open: false,
        searchQuery: '',
        roleOpen: false,
        statusOpen: false,
        selectedRole: 'Semua',
        selectedStatus: 'Semua',
        activeAction: null,
        
        roles: ['Semua', 'Admin', 'Petugas', 'Operator'],
        statuses: ['Semua', 'Aktif', 'Nonaktif'],
        
        users: [
            {
                id: 1,
                name: 'Ahmad Fauzi',
                email: 'ahmad.fauzi@sarirogo.com',
                role: 'Admin',
                status: 'Aktif',
                lastLogin: '2 jam yang lalu'
            },
            {
                id: 2,
                name: 'Siti Rahayu',
                email: 'siti.rahayu@sarirogo.com',
                role: 'Petugas',
                status: 'Aktif',
                lastLogin: '5 jam yang lalu'
            },
            {
                id: 3,
                name: 'Budi Santoso',
                email: 'budi.santoso@sarirogo.com',
                role: 'Operator',
                status: 'Aktif',
                lastLogin: 'Kemarin'
            },
            {
                id: 4,
                name: 'Dewi Lestari',
                email: 'dewi.lestari@sarirogo.com',
                role: 'Petugas',
                status: 'Aktif',
                lastLogin: '3 hari yang lalu'
            },
            {
                id: 5,
                name: 'Eko Prasetyo',
                email: 'eko.prasetyo@sarirogo.com',
                role: 'Operator',
                status: 'Nonaktif',
                lastLogin: '1 minggu yang lalu'
            },
            {
                id: 6,
                name: 'Fitri Handayani',
                email: 'fitri.handayani@sarirogo.com',
                role: 'Petugas',
                status: 'Aktif',
                lastLogin: '30 menit yang lalu'
            }
        ],
        
        get filteredUsers() {
            return this.users.filter(user => {
                // Search filter
                if (this.searchQuery && !user.name.toLowerCase().includes(this.searchQuery.toLowerCase()) && !user.email.toLowerCase().includes(this.searchQuery.toLowerCase())) {
                    return false;
                }
                
                // Role filter
                if (this.selectedRole !== 'Semua' && user.role !== this.selectedRole) return false;
                
                // Status filter
                if (this.selectedStatus !== 'Semua' && user.status !== this.selectedStatus) return false;
                
                return true;
            });
        },
        
        toggleAction(index) {
            this.activeAction = this.activeAction === index ? null : index;
        },
        
        getRoleBadgeClass(role) {
            const classes = {
                'Admin': 'bg-purple-100 text-purple-700 border border-purple-200',
                'Petugas': 'bg-blue-100 text-blue-700 border border-blue-200',
                'Operator': 'bg-amber-100 text-amber-700 border border-amber-200'
            };
            return classes[role] || 'bg-gray-100 text-gray-700';
        },
        
        getAvatarGradient(role) {
            const gradients = {
                'Admin': 'from-emerald-400 to-emerald-600',
                'Petugas': 'from-teal-400 to-teal-600',
                'Operator': 'from-green-400 to-green-600'
            };
            return gradients[role] || 'from-gray-400 to-gray-600';
        },
        
        toggleUserStatus(user) {
            this.activeAction = null;
            const newStatus = user.status === 'Aktif' ? 'Nonaktif' : 'Aktif';
            if (confirm(`Apakah Anda yakin ingin ${newStatus === 'Aktif' ? 'mengaktifkan' : 'menonaktifkan'} user "${user.name}"?`)) {
                user.status = newStatus;
                alert(`User "${user.name}" berhasil di${newStatus === 'Aktif' ? 'aktifkan' : 'nonaktifkan'}!`);
            }
        },
        
        deleteUser(user) {
            this.activeAction = null;
            if (confirm(`Apakah Anda yakin ingin menghapus user "${user.name}"?`)) {
                const index = this.users.findIndex(u => u.id === user.id);
                if (index > -1) {
                    this.users.splice(index, 1);
                    alert(`User "${user.name}" berhasil dihapus!`);
                }
            }
        }
    }
}
</script>
@endsection
