<form method="POST" enctype="multipart/form-data">
    @csrf

    <!-- header -->
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-primary-3 to-primary-4 flex items-center justify-center">
            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
        </div>
        <div>
            <h2 class="text-lg md:text-2xl font-bold text-gray-900">Informasi Utama</h2>
            <p class="text-xs md:text-sm text-gray-500">
                Tambahkan informasi utama kandang pada form dibawah ini
            </p>
        </div>
    </div>

    <!-- main card -->
    <div class="bg-gradient-to-br from-primary-1/50 to-white rounded-2xl md:rounded-3xl border border-primary-2/50 p-4 md:p-8 mb-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Nama Kandang -->
            <x-ui.input
                required
                label="Nama Kandang"
                name="nama_kandang"
                placeholder="Kandang A"
                value="{{ old('nama_kandang', $kandang['step1']['nama_kandang'] ?? '') }}"
            />

            <!-- Tipe Kandang -->
            <x-ui.input
                required
                label="Tipe Kandang"
                name="tipe_kandang"
                placeholder="Postal"
                value="{{ old('tipe_kandang', $kandang['step1']['tipe_kandang'] ?? '') }}"
            />

            <!-- Lokasi -->
            <x-ui.input
                required
                label="Lokasi"
                name="lokasi"
                placeholder="Tanah Ngagel"
                value="{{ old('lokasi', $kandang['step1']['lokasi'] ?? '') }}"
            />

            <!-- Tanggal Pembuatan -->
            <x-ui.input
                required
                label="Tanggal Pembuatan"
                name="tanggal_pembuatan"
                type="date"
                value="{{ old('tanggal_pembuatan', $kandang['step1']['tanggal_pembuatan'] ?? '') }}"
            />

            <!-- Upload Foto -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Foto Kandang
                </label>

                <label
                    for="foto_kandang"
                    class="border-2 border-dashed border-emerald-400 rounded-xl p-6 text-center hover:bg-emerald-50 transition cursor-pointer block"
                >
                    <svg class="w-8 h-8 mx-auto text-emerald-500 mb-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>

                    <p class="text-sm font-semibold text-emerald-600">Upload</p>
                    <p class="text-xs text-gray-500 mt-1">
                        Tambahkan foto kandang disini
                    </p>
                </label>

                <input
                    required
                    id="foto_kandang"
                    type="file"
                    name="foto_kandang"
                    accept="image/png, image/jpeg"
                    class="hidden"
                />
            </div>

        </div>
    </div>
</form>
