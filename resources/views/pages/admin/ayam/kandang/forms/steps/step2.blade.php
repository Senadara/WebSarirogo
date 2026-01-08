<form method="POST" enctype="multipart/form-data">
    @csrf

    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-primary-3 to-primary-4 flex items-center justify-center">
            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
        </div>
        <div>
            <h2 class="text-lg md:text-2xl font-bold text-gray-900">Informasi Siklus Ayam</h2>
            <p class="text-xs md:text-sm text-gray-500">Tambahkan informasi Siklus ayam pada form dibawah ini</p>
        </div>
    </div>

    <!-- main -->
    <div class="bg-gradient-to-br from-primary-1/50 to-white rounded-2xl md:rounded-3xl border border-primary-2/50 p-4 md:p-8 mb-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- nama kandang -->
            <x-ui.input
                required
                label="Umur Ayam (hari)"
                name="umur_ayam"
                placeholder="Contoh: Kandang A"
                value="{{ old('umur_ayam', $kandang['step2']['umur_ayam'] ?? '') }}" />

            <!-- tipe kandang -->
            <x-ui.input
                required
                label="Total Populasi Saat Ini (ekor)"
                name="total_populasi_saat_ini"
                placeholder="Contoh: 100 Ekor"
                value="{{ old('total_populasi_saat_ini', $kandang['step2']['total_populasi_saat_ini'] ?? '') }}" />

            <!-- lokasi -->
            <x-ui.input
                required
                label="Total Populasi Awal (ekor)"
                name="total_populasi_awal"
                placeholder="Contoh: 220 Ekor "
                value="{{old ('total_populasi_awal', $kandang['step2']['total_populasi_awal'] ?? '') }}" />

            <x-ui.dropdown
                required
                label="Fase Ayam Saat Ini"
                name="fase_ayam"
                :options="[
                    'starter' => 'Starter',
                    'grower' => 'Grower',
                    'production' => 'Production',
                    'afkir' => 'Afkir'
                ]"
                :selected="$kandang['step2']['fase_ayam'] ?? null" />

        </div>
    </div>
</form>