<form method="POST" enctype="multipart/form-data">
    @csrf

    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-primary-3 to-primary-4 flex items-center justify-center">
            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
        </div>
        <div>
            <h2 class="text-lg md:text-2xl font-bold text-gray-900">Informasi Insiden</h2>
            <p class="text-xs md:text-sm text-gray-500">Tambahkan informasi Insiden pada form dibawah ini</p>
        </div>
    </div>

    <!-- main -->
    <div class="bg-gradient-to-br from-primary-1/50 to-white rounded-2xl md:rounded-3xl border border-primary-2/50 p-4 md:p-8 mb-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <x-ui.dropdown
                required
                label="Kategori Insiden"
                name="kategori_insiden"
                :options="[
                    'kesehatan_ayam' => 'Kesehatan Ayam',
                    'lingkungan' => 'Lingkungan',
                    'peralatan' => 'Peralatan',
                    'lainnya' => 'Lainnya'
                ]"
                :selected="$kandang['kategori_insiden'] ?? null" />

            <x-ui.dropdown
                required
                label="Tingkat Keparahan"
                name="tingkat_keparahan"
                :options="[
                    'rendah' => 'Rendah',
                    'sedang' => 'Sedang',
                    'tinggi' => 'Tinggi'
                ]"
                :selected="$kandang['tingkat_keparahan'] ?? null" />

            <x-ui.input
                required
                label="Rencana Tindakan Lanjutan"
                name="rencana_tindakan_lanjutan"
                placeholder="contoh: Pengobatan, Perbaikan Ventilasi"
                value="{{old ('rencana_tindakan_lanjutan', $kandang['rencana_tindakan_lanjutan'] ?? '') }}" />

            <x-ui.input
                label="Estimasi Kerugian (Opsional)"
                name="estimasi_kerugian"
                placeholder=""
                value="{{ old('estimasi_kerugian', $kandang['estimasi_kerugian'] ?? '') }}" />

            <div
                x-data="{
                    items: @js(old('hewan_terdampak', $kandang['hewan_terdampak'] ?? [])),
                    input: '',
                    add() {
                        if (this.input.trim() === '') return
                        if (!this.items.includes(this.input.trim())) {
                            this.items.push(this.input.trim())
                        }
                        this.input = ''
                    },
                    remove(index) {
                        this.items.splice(index, 1)
                    },
                    clearAll() {
                        this.items = []
                    }
                }"
                class="md:col-span-2">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Hewan Terdampak (Ekor)
                    </label>

                    <button
                        x-show="items.length > 0"
                        type="button"
                        @click="clearAll"
                        class="text-xs font-semibold text-red-500 hover:text-red-600 transition">
                        Hapus Semua
                    </button>
                </div>
                
                <div
                    class="
                        flex flex-wrap gap-2 p-3
                        rounded-xl border border-gray-300
                        bg-white focus-within:ring-2 focus-within:ring-primary-3/40
                    ">
                    <!-- CHIP -->
                    <template x-for="(item, index) in items" :key="index">
                        <span
                            class="
                                flex items-center gap-2
                                px-3 py-1.5 rounded-lg
                                border border-primary-4 text-black
                                text-xs font-semibold
                            ">
                            <span x-text="item"></span>
                            <button
                                type="button"
                                @click="remove(index)"
                                class="text-red-1 text-xs">
                                - Hapus
                            </button>

                            <input type="hidden" name="hewan_terdampak[]" :value="item">
                        </span>
                    </template>

                    <!-- INPUT -->
                    <input
                        type="text"
                        x-model="input"
                        @keydown.enter.prevent="add"
                        placeholder="Contoh: A12 lalu tekan Enter"
                        class="flex-1 min-w-[140px] outline-none text-sm bg-transparent" />
                </div>

                <p class="text-xs text-gray-500 mt-1">
                    Masukkan kode hewan, tekan Enter untuk menambahkan
                </p>

                @error('hewan_terdampak')
                <p class="mt-2 text-xs text-red-500 font-medium">
                    {{ $message }}
                </p>
                @enderror
            </div>


            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Foto Bukti Insiden
                </label>

                <label
                    for="foto_kandang"
                    class="border-2 border-dashed border-emerald-400 rounded-xl p-6 text-center hover:bg-emerald-50 transition cursor-pointer block">
                    <svg class="w-8 h-8 mx-auto text-emerald-500 mb-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>

                    <p class="text-sm font-semibold text-emerald-600">Upload</p>
                    <p class="text-xs text-gray-500 mt-1">
                        Tambahkan foto insiden disini
                    </p>
                </label>

                <input
                    required
                    id="foto_insiden"
                    type="file"
                    name="foto_insiden"
                    accept="image/png, image/jpeg"
                    class="hidden" />
            </div>
        </div>
    </div>
</form>