@extends('layouts.landing')

@section('content')

<section class="relative isolate px-4 md:pt-36 sm:px-6 lg:px-8">

    <!-- bg-blur -->
    <div class="absolute inset-x-0 -top-40 -z-10 blur-3xl sm:-top-80">
        <div class="relative left-[calc(50%-11rem)] 
            w-[36.125rem] -translate-x-1/2 rotate-[30deg]
            bg-gradient-to-tr from-[#34d399] to-[#10b981]
            opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem] aspect-[1155/678]">
        </div>
    </div>

    <!-- tagline -->
    <div class="flex justify-center mb-4 mt-24">
        <div class="relative rounded-full px-3 py-1 text-sm text-gray-600 ring-1 ring-gray-900/30">
            Sistem pemantauan peternakan Sarirogo
        </div>
    </div>

    <!-- title -->
    <div class="mx-auto max-w-5xl text-center">
        <h1 class="md:text-4xl text-3xl lg:text-5xl font-bold tracking-tight text-gray-900">
            Dashboard Monitoring Peternakan Sarirogo
        </h1>

        <p class="mt-5 text-base text-gray-600 leading-relaxed">
            Sumber informasi resmi hasil populasi peternakan desa Sarirogo.
        </p>

        <!-- CTA button -->
        <div class="mt-8 flex justify-center">
            <a href="#statistik"
                class="group inline-flex items-center justify-center border font-sans font-medium
                text-sm md:text-base rounded-full py-2.5 px-16 shadow-sm hover:shadow-lg bg-primary-3
                text-white hover:bg-secondary-3 transition duration-300 ease-in-out">
                Hubungi Kami
            </a>
        </div>
    </div>
</section>

<!-- statistik section -->
<section id="statistik" class="md:py-44 py-10 px-4 sm:px-6 lg:px-20">
    <div class="max-w-6xl mx-auto">

        <section class="grid gap-6 md:grid-cols-3 p-4 md:p-8 max-w-5xl mx-auto w-full">

            <!-- populasi ternak -->
            <div class="p-6 bg-gray-500 shadow rounded-2xl">
                <dl class="space-y-2">
                    <dt class="text-sm font-medium text-gray-200">Populasi Ternak</dt>
                    <dd class="text-5xl font-light md:text-6xl text-white">
                        {{ $populasiAyam }}
                    </dd>
                    <dd class="text-sm font-medium text-green-400">
                        Semua kategori: Ayam
                    </dd>
                </dl>
            </div>

            <!-- hasil panen -->
            <div class="p-6 bg-gray-500 shadow rounded-2xl">
                <dl class="space-y-2">
                    <dt class="text-sm font-medium text-gray-200">Hasil Panen</dt>
                    <dd class="text-5xl font-light md:text-6xl text-white">
                        {{ $dataTanaman->sum('total_tanaman') }}
                    </dd>
                    <dd class="text-sm font-medium text-green-400">
                        Luas total: {{ $dataTanaman->sum('luas_lahan') }} m²
                    </dd>
                </dl>
            </div>

            <!-- laporan ternak -->
            <div class="p-6 bg-gray-500 shadow rounded-2xl">
                <dl class="space-y-2">
                    <dt class="text-sm font-medium text-gray-200">Laporan Ayam</dt>
                    <dd class="text-5xl font-light md:text-6xl text-white">
                        {{ $laporanStatistik['growth'] }}
                    </dd>
                    <dd class="text-sm font-medium text-red-400">
                        Mati: {{ $laporanStatistik['dead'] }}, Baru: {{ $laporanStatistik['new'] }}
                    </dd>
                </dl>
            </div>

        </section>

    </div>
</section>
@endsection
