<div class="flex items-center gap-3 mb-6">
    <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-primary-3 to-primary-4 flex items-center justify-center">
        <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
    </div>
    <div>
        <h2 class="text-lg md:text-2xl font-bold text-gray-900">Review Data</h2>
        <p class="text-xs md:text-sm text-gray-500">Periksa kembali data yang diisi, lalu simpan data kandang dan data akan tersimpan otomatis.</p>
    </div>
</div>

<!-- main -->
<div class="bg-gradient-to-br from-primary-1/50 to-white rounded-2xl md:rounded-3xl border border-primary-2/50 p-4 md:p-8 mb-6">

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
                    <h3 class="text-base md:text-lg font-bold text-gray-900">Informasi Kandang</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                    <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                        <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Nama Kandang</p>
                        <p class="text-sm md:text-base font-semibold text-gray-900">{{$kandang['step1']['nama_kandang']}}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                        <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Lokasi</p>
                        <p class="text-sm md:text-base font-semibold text-gray-900">{{ $kandang['step1']['lokasi']}}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                        <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Tipe Kandang</p>
                        <p class="text-sm md:text-base font-semibold text-gray-900">{{ $kandang['step1']['tipe_kandang']}}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                        <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Tanggal Pembuatan</p>
                        <p class="text-sm md:text-base font-semibold text-primary-4">{{ $kandang['step1']['tanggal_pembuatan']}}</p>
                    </div>
                </div>
            </div>

            <!-- info Siklus Ayam -->
            <div class="bg-white rounded-xl md:rounded-2xl p-4 md:p-6 shadow-sm border border-gray-100">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-primary-1 flex items-center justify-center">
                        <svg class="w-4 h-4 text-primary-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg font-bold text-gray-900">Informasi Siklus Ayam</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                    <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                        <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Umur Ayam</p>
                        <p class="text-sm md:text-base font-semibold text-gray-900">{{$kandang['step2']['umur_ayam']}}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                        <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Total Populasi awal</p>
                        <p class="text-sm md:text-base font-semibold text-gray-900">{{$kandang['step2']['total_populasi_awal']}}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                        <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Total Populasi saat ini</p>
                        <p class="text-sm md:text-base font-semibold text-gray-900">{{$kandang['step2']['total_populasi_saat_ini']}}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3 md:p-4">
                        <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wide mb-1">Fase Ayam saat ini</p>
                        <p class="text-sm md:text-base font-semibold text-primary-4">{{$kandang['step2']['fase_ayam']}}</p>
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
                    <h3 class="text-base md:text-lg font-bold text-gray-900">Foto Kandang</h3>
                </div>

                <!-- image preview -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-3/20 to-primary-4/20 rounded-xl md:rounded-2xl transform rotate-1 group-hover:rotate-2 transition-transform"></div>
                    <div class="relative bg-gray-50 rounded-xl md:rounded-2xl overflow-hidden border-2 border-white shadow-md">
                        <div class="aspect-[4/3]">
                            <!-- <img
                                src="/assets/icons/kandang.svg"
                                alt="Bukti aktivitas"
                                class="w-full h-full object-cover"> -->
                            @if (!empty($kandang['step1']['foto_kandang']))
                            <img
                                src="{{ asset('storage/' . $kandang['step1']['foto_kandang']) }}"
                                alt="Foto Kandang"
                                class="w-full h-48 object-cover rounded-lg border border-gray-200">
                            @else
                            <p class="text-sm text-gray-400">Foto belum diunggah</p>
                            @endif
                        </div>
                        <!-- overlay image info -->
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3 md:p-4">
                            <p class="text-white text-xs md:text-sm font-medium">foto_kandang.jpg</p>
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