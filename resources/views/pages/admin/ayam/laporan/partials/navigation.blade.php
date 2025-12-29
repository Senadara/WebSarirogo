<div
    x-data="{
        showSuccess: false,
        laporanType: '{{ ucfirst($type) }}',

        finishLaporan() {
            this.showSuccess = true

            setTimeout(() => {
                window.location.href = '{{ route('admin.ayam.laporan.index') }}'
            }, 2000)
        }
    }">

    <!-- button card -->
    <div class="bg-white rounded-xl md:rounded-2xl border border-gray-100 p-4 md:p-6 shadow-sm mt-6">
        <div class="flex flex-col sm:flex-row items-center gap-3">

            <!-- back button -->
            <a
                href="{{ $step > 1
                ? route('admin.ayam.laporan.create', [
                    'type' => $type,
                    'step' => $step - 1
                ])
                : route('admin.ayam.laporan.index')
            }}"
                class="w-full sm:w-auto order-2 sm:order-1 py-2.5 md:py-3 px-6 md:px-8 rounded-full bg-gray-200 text-gray-700 font-medium text-center text-sm md:text-base hover:bg-gray-300 transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>

            <div class="flex-1 hidden sm:block"></div>

            <!-- next/finish cta -->
            @if ($step < 3)
                <a
                href="{{ route('admin.ayam.laporan.create', [
            'type' => $type,
            'step' => $step + 1
        ]) }}"
                class="w-full sm:w-auto order-1 sm:order-2 py-2.5 md:py-3 px-8 md:px-12 rounded-full bg-gradient-to-r from-primary-3 to-primary-4 text-white font-semibold text-sm md:text-base hover:shadow-lg hover:shadow-primary-3/30 transition-all duration-300 flex items-center justify-center gap-2">
                Selanjutnya
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                </a>
                @else
                <button
                    type="button"
                    @click="finishLaporan()"
                    class="w-full sm:w-auto order-1 sm:order-2 py-2.5 md:py-3 px-8 md:px-12 rounded-full bg-gradient-to-r from-primary-3 to-primary-4 text-white font-semibold text-sm md:text-base hover:shadow-lg hover:shadow-primary-3/30 transition">
                    Simpan Laporan
                </button>
                @endif
        </div>

        <div
            x-show="showSuccess"
            x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
            <div class="bg-white rounded-2xl p-6 w-80 max-w-sm text-center shadow-xl">
                <div class="flex justify-center mb-4">
                    <div class="w-14 h-14 flex items-center justify-center rounded-full bg-green-100">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>

                <h2 class="text-sm font-semibold text-gray-900">
                    Laporan <span x-text="laporanType"></span> berhasil disimpan
                </h2>

                <p class="text-xs text-gray-600 mt-2">
                    Data laporan <span x-text="laporanType.toLowerCase()"></span> telah berhasil ditambahkan.
                </p>

                <p class="text-xs text-gray-400 mt-4">
                    Mengalihkan halaman...
                </p>
            </div>
        </div>

    </div>