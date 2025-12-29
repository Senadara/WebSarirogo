<div x-data="{ open: false }" class="flex bg-white min-h-screen">

    <main class="flex-1 min-h-screen">

        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-primary-3 to-primary-4 flex items-center justify-center">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg md:text-2xl font-bold text-gray-900">Review Laporan</h2>
                <p class="text-xs md:text-sm text-gray-500">Pastikan semua data sudah benar sebelum menyimpan</p>
            </div>
        </div>

        <!-- main content card -->
        <div class="bg-gradient-to-br from-primary-1/50 to-white rounded-2xl md:rounded-3xl border border-primary-2/50 p-4 md:p-8 mb-6">
            
            <!-- grid content -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 md:gap-8">

                <!-- left column -->
                <div class="lg:col-span-3 space-y-6">
                    
                    <!-- info utama -->
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
                                <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Tanggal Laporan</p>
                                <p class="text-sm md:text-base font-semibold text-gray-900">19 September 2025</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                                <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Waktu</p>
                                <p class="text-sm md:text-base font-semibold text-gray-900">14:35 WIB</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                                <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Nama Lahan</p>
                                <p class="text-sm md:text-base font-semibold text-gray-900">Kandang A</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                                <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Jenis Aktivitas</p>
                                <p class="text-sm md:text-base font-semibold text-primary-4">Pemupukan</p>
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

                    <!-- catatan card -->
                    <div class="bg-white rounded-xl md:rounded-2xl p-4 md:p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 rounded-lg bg-yellow-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <h3 class="text-base md:text-lg font-bold text-gray-900">Catatan</h3>
                        </div>
                        <p class="text-xs md:text-sm text-gray-600 bg-gray-50 rounded-lg p-3 italic">
                            "Note dari pak heri terkait aktivitas hari ini. Semua berjalan lancar dan sesuai jadwal."
                        </p>
                    </div>

                    <!-- rincian pemakaian inventaris card -->
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

                <!-- right column -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl md:rounded-2xl p-4 md:p-6 shadow-sm border border-gray-100 lg:sticky lg:top-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-base md:text-lg font-bold text-gray-900">Bukti Aktivitas</h3>
                        </div>
                        
                        <!-- image preview -->
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-br from-primary-3/20 to-primary-4/20 rounded-xl md:rounded-2xl transform rotate-1 group-hover:rotate-2 transition-transform"></div>
                            <div class="relative bg-gray-50 rounded-xl md:rounded-2xl overflow-hidden border-2 border-white shadow-md">
                                <div class="aspect-[4/3]">
                                    <img 
                                        src="/assets/icons/kandang.svg" 
                                        alt="Bukti aktivitas"
                                        class="w-full h-full object-cover"
                                    >
                                </div>
                                <!-- overlay image info -->
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3 md:p-4">
                                    <p class="text-white text-xs md:text-sm font-medium">bukti_aktivitas.jpg</p>
                                    <p class="text-white/70 text-[10px] md:text-xs">Diambil: 19 Sep 2025, 14:35</p>
                                </div>
                            </div>
                        </div>

                        <!-- image action -->
                        <div class="flex gap-2 mt-4">
                            <button class="flex-1 py-2 px-3 rounded-lg bg-gray-100 text-gray-700 text-xs md:text-sm font-medium hover:bg-gray-200 transition flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                                Perbesar
                            </button>
                            <button class="flex-1 py-2 px-3 rounded-lg bg-gray-100 text-gray-700 text-xs md:text-sm font-medium hover:bg-gray-200 transition flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Ganti
                            </button>
                        </div>

                        <!-- status indicator -->
                        <div class="mt-6 p-3 md:p-4 bg-gradient-to-r from-primary-1 to-primary-1/50 rounded-xl border border-primary-2">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-primary-3 rounded-full animate-pulse"></div>
                                <span class="text-xs md:text-sm font-medium text-primary-4">Siap untuk disimpan</span>
                            </div>
                            <p class="text-[10px] md:text-xs text-gray-600 mt-1">Semua data telah diisi dengan lengkap</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>