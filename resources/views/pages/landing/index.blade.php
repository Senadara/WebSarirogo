@extends('layouts.landing')

@section('content')
<!-- section start - hero section -->
<section class="relative isolate px-4 md:pt-36 pt-36 sm:px-6 lg:px-8 ">

    <!-- bg -->
    <div class="absolute inset-x-0 -top-40 -z-10 blur-3xl sm:-top-80">
        <div class="relative left-[calc(50%-11rem)] 
            w-[36.125rem] -translate-x-1/2 rotate-[5deg]
            bg-gradient-to-tr from-[#34d399] to-[#10b981]
            opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem] aspect-[1155/678]">
        </div>
    </div>

    <!-- tagline -->
    <div class="flex justify-center mb-4 mt-28">
        <div class="relative rounded-full px-5 md:px-10 py-1.5 text-sm text-gray-600 ring-1 ring-gray-900/30">
            Sistem pemantauan peternakan Sarirogo
        </div>
    </div>

    <!-- title -->
    <div class="mx-auto max-w-5xl text-center">
        <h1 class="md:text-4xl text-3xl lg:text-5xl font-bold tracking-tight text-gray-900">
            Dashboard Monitoring Peternakan Sarirogo
        </h1>

        <p class="mt-2 md:mt-3 text-xs md:text-base text-gray-600">
            Sumber informasi resmi hasil populasi peternakan desa Sarirogo.
        </p>

        <!-- cta button -->
        <x-ui.button href="#kontak" size="base" class="mt-5">
            Hubungi kami untuk kerja sama
        </x-ui.button>

    </div>
</section>
<!-- section end - hero section -->

<!-- section start - grafik pertumbuhan pertenakan -->
<!-- section end - grafik pertumbuhan pertenakan -->

<!-- section start - highlight -->
<section class="w-full bg-bg-2 mt-20 py-20" id="kontak">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12">

        <!-- section kiri-->
        <div class="md:pt-14">
            <p class="text-primary-3 font-semibold mb-3">
                Highlight Peternakan Sarirogo
            </p>

            <h2 class="text-3xl lg:text-4xl font-bold leading-snug mb-4">
                Dipercaya oleh Investor <br>
                untuk Hasil yang Konsisten
            </h2>

            <p class="text-text-3 md:max-w-lg">
                berkomitmen menghadirkan manajemen modern dengan data akurat
                untuk meningkatkan produktivitas dan menekan risiko.
            </p>
        </div>

        <!-- section kanan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">

            <!-- item 1 -->
            <div class="flex flex-col">
                <img src="/assets/icons/kesehatan.svg"
                    alt="Health Icon"
                    class="w-8 h-8 mb-3">

                <h3 class="text-xl font-bold mb-1 md:max-w-52">
                    Tingkat Kesehatan Ternak Tinggi
                </h3>

                <p class="text-text-3 text-sm leading-relaxed">
                    Lebih dari 95% hewan ternak bertahan sehat berkat pemantauan rutin.
                </p>
            </div>

            <!-- item 2 -->
            <div class="flex flex-col">
                <img src="/assets/icons/monitoring.svg"
                    alt="Monitoring Icon"
                    class="w-8 h-8 mb-3">

                <h3 class="text-xl font-bold mb-1 md:max-w-40">
                    Monitoring Digital Terpadu
                </h3>

                <p class="text-text-3 text-sm leading-relaxed">
                    Semua data tercatat digital & transparan.
                </p>
            </div>

            <!-- item 3 -->
            <div class="flex flex-col">
                <img src="/assets/icons/pakan.svg"
                    alt="Efficiency Icon"
                    class="w-8 h-8 mb-3">

                <h3 class="text-xl font-bold mb-1">
                    Efisiensi Pakan Optimal
                </h3>

                <p class="text-text-3 text-sm leading-relaxed">
                    Penggunaan pakan tercatat rapi, menekan biaya tanpa mengurangi pertumbuhan.
                </p>
            </div>

            <!-- item 4 -->
            <div class="flex flex-col">
                <img src="/assets/icons/box.svg"
                    alt="Stable Icon"
                    class="w-8 h-8 mb-3">

                <h3 class="text-xl font-bold mb-1">
                    Hasil Produksi Stabil
                </h3>

                <p class="text-text-3 text-sm leading-relaxed">
                    Panen ternak konsisten tiap siklus, mendukung proyeksi keuntungan jangka panjang.
                </p>
            </div>

        </div>
    </div>
</section>
<!-- section end - highlight -->

<!-- section start - kontak -->
<section class="w-full px-6 md:px-16 lg:px-24 py-16">
    <!-- heading -->
    <div class="mb-10">
        <h1 class="text-4xl font-bold text-black">Kontak</h1>
        <p class="text-text-3 text-sm mt-1">
            Kontak & Informasi Desa / Peternakan
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- gmaps -->
        <div class="w-full h-[350px] md:h-[420px] rounded-xl overflow-hidden shadow-sm">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15792.23542!2d112.718342!3d-7.379345!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x00000000!2sDesa%20Sarirogo!5e0!3m2!1sid!2sid!4v1700000000000"
                class="w-full h-full border-0"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>

        <!-- informasi utama -->
        <div class="flex flex-col gap-8">
            <!-- alamat -->
            <div>
                <h3 class="font-bold text-3xl text-black mb-1">Alamat</h3>
                <p class="text-text-3 text-sm leading-relaxed">
                    Jalan Sarirogo Raya 61234 Sidoarjo, Jawa Timur
                </p>
                <div class="w-full h-[1px] bg-gray-200 mt-4"></div>
            </div>

            <!-- jam operasional -->
            <div>
                <h3 class="font-bold text-3xl text-black mb-1">Jam</h3>
                <p class="text-text-3 text-sm">Sabtu: 10.00 – 16.00</p>
                <p class="text-text-3 text-sm">Minggu: Tutup</p>

                <div class="w-full h-[1px] bg-gray-200 mt-4"></div>
            </div>

            <!-- kontak -->
            <div>
                <h3 class="font-bold text-3xl text-black mb-1">Kontak</h3>
                <p class="text-text-3 text-sm">
                    Email: sarirogo@gmail.com <br>
                    Telepon: +6212345678
                </p>
            </div>

            <!-- cta Button -->
            <x-ui.button href="#" size="full">
                Hubungi Kami Untuk Kerja Sama
            </x-ui.button>
        </div>
    </div>
</section>
<!-- section end - kontak -->


@endsection