<!-- detail kandang -->
@extends('layouts.admin')

@section('content')
<div x-data="{ open: false }" class="flex bg-white min-h-screen">

    <!-- sidebar -->
    @include('components.layouts.sidebar')

    <main class="flex-1 p-6 lg:ml-72">

        <!-- topbar -->
        <div class="flex items-center gap-3 mb-6 lg:hidden">
            <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                <img src="/assets/icons/menu.svg" class="w-6 h-6">
            </button>
            <h1 class="text-lg font-bold">Data Kandang</h1>
        </div>

        <h1 class="text-4xl font-bold mb-4 hidden lg:block">Kandang A</h1>

        <!-- breadcrumps -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">

            <div class="flex items-center gap-2 text-sm text-gray-600">
                <img src="/assets/icons/home.svg" class="w-4 h-4">
                <span>/</span>
                <a href="{{ route('admin.ayam.kandang.index') }}"
                    class="hover:underline hover:text-primary-2 transition">
                    Kandang
                </a>
                <span>/</span>
                <span class="font-semibold text-gray-900">Detail Kandang</span>
            </div>

            <div class="flex items-center gap-4">
                @include('components.ui.notification-bell')

                <button class="p-2 rounded-full hover:bg-gray-100">
                    <img src="/assets/icons/user.svg" class="w-5 h-5">
                </button>
            </div>
        </div>

        <!-- info box -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
            <h3 class="font-bold text-black mb-1">Halaman Detail Kandang</h3>
            <p class="md:text-sm text-gray-600 text-xs">
                Detail informasi Kandang A
            </p>
            <p class="text-xs text-black mt-2 font-bold">
                {{ now()->translatedFormat('l, d F Y') }}
            </p>
        </div>

        <div class="space-y-6">

            <!-- button kembali, edit, delete -->
            <div class="flex flex-wrap justify-between items-center gap-3 mb-6">

                <div>
                    <x-ui.button size="sm" variant="secondary" class="text-white font-semibold bg-text-3"
                        href="{{ route('admin.ayam.kandang.index') }}">
                        Kembali
                    </x-ui.button>
                </div>

                <div class="flex items-center gap-3 order-2 lg:order-1 ml-auto">
                    <x-ui.button size="sm" href="#" variant="clean" class="bg-yellow-4 text-white">
                        Edit
                    </x-ui.button>

                    <x-ui.button size="sm" href="#" variant="clean" class="bg-red-1 text-white">
                        Delete
                    </x-ui.button>
                </div>

            </div>

            <!-- informasi utama, indeks performa -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- informasi utama -->
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 md:p-5">

                    <div class="w-full mb-4">
                        <img src="/assets/icons/kandang.svg"
                            class="w-full h-48 md:h-56 object-cover rounded-lg">
                    </div>

                    <h1 class="font-bold mb-3 text-lg">Informasi Utama</h1>

                    <div class="grid grid-cols-2 gap-x-4 text-sm">
                        <p class="text-gray-600">Nama kandang</p>
                        <p class="font-semibold">Kandang A</p>

                        <p class="text-gray-600">Lokasi</p>
                        <p class="font-semibold">Tanah Barat Jaya</p>

                        <p class="text-gray-600">Tipe Kandang</p>
                        <p class="font-semibold">Postal</p>

                        <p class="text-gray-600">Tanggal mulai Siklus</p>
                        <p class="font-semibold">1 Januari 2025</p>

                        <p class="text-gray-600">Umur Ayam</p>
                        <p class="font-semibold">29 Minggu</p>

                        <p class="text-gray-600">Total populasi Awal</p>
                        <p class="font-semibold">220 Ekor</p>

                        <p class="text-gray-600">Total populasi Saat Ini</p>
                        <p class="font-semibold">200 Ekor</p>

                        <p class="text-gray-600">Fase ayam Saat Ini</p>
                        <p class="font-semibold">Production</p>
                    </div>
                </div>

                <!-- indeks performa -->
                <div class="bg-white p-6 rounded-xl shadow border">

                    <h3 class="font-semibold text-lg mb-3">Indeks Performa</h3>

                    <div class="flex flex-col lg:flex-row items-center gap-10">

                        <div class="text-center lg:text-left">
                            <h1 class="text-5xl font-bold italic text-[#F57F17]">90%</h1>

                            <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-y-2 gap-x-10 text-sm text-black">
                                <p>Populasi Ayam: <span class="font-semibold">40</span></p>
                                <p>FCR: <span class="font-bold">1.82</span></p>
                                <p>HD%: <span class="font-bold">92</span></p>
                                <p>Umur Produksi: <span class="font-bold">1.82</span></p>
                                <p>Berat Telur (g): <span class="font-bold">62</span></p>
                            </div>
                        </div>

                        <img src="/assets/icons/ilustrasiip.svg" class="w-40 h-40 object-contain lg:ml-5" alt="ilustrasi">
                    </div>
                </div>

            </div>

            <!-- FCR, tren -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- tren produksi -->
                <div class="bg-white border rounded-xl p-4 md:p-5">
                    <h3 class="font-bold mb-4">Tren Produksi</h3>
                    <div class="relative">
                        <canvas id="chartProduksi" class="w-full h-44 md:h-52"></canvas>
                    </div>
                </div>

                <!-- FCR -->
                <div class="bg-white border rounded-xl p-4 md:p-5">
                    <h3 class="font-bold mb-4">FCR Ayam</h3>
                    <div class="relative">
                        <canvas id="chartFCR" class="w-full h-44 md:h-52"></canvas>
                    </div>
                </div>

            </div>

            <!-- riwayat panen & ayam sakit -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- riwayat panen -->
                <div class="bg-white border rounded-xl p-4 md:p-5">

                    <h3 class="font-bold mb-4">Riwayat Panen</h3>

                    <div class="space-y-3">
                        @foreach([1,2,3] as $item)
                        <div class="flex items-center justify-between p-3 rounded-lg bg-bg-2">

                            <div>
                                <p class="font-semibold">Lahan A</p>
                                <p class="text-xs text-gray-600">Jumat, 19 September 2025 - 14:35</p>
                            </div>

                            <div class="text-right">
                                <p class="text-sm font-bold text-accent-5">Laporan Panen</p>
                                <p class="text-xs text-black">1000 kg</p>
                                <span class="px-3 py-1 text-xs bg-accent-3 text-white rounded-full font-semibold">Pek Hari</span>
                            </div>

                        </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-4">
                        <x-ui.button 
                        size="base" 
                        href="#" 
                        variant="clean" 
                        class="bg-accent-3 !text-bg-1">
                            Lihat Laporan Terbaru
                        </x-ui.button>
                    </div>

                </div>

                <!-- ayam sakit -->
                <div class="bg-white border rounded-xl p-4 md:p-5">

                    <h3 class="font-bold mb-4">Ayam Sakit</h3>

                    <div class="space-y-3">

                        @foreach([1,2,3] as $item)
                        <div class="flex items-center justify-between p-3 rounded-lg bg-bg-2">

                            <div class="max-w-[65%]">
                                <p class="font-semibold text-sm truncate">Lahan A</p>
                                <p class="text-xs text-gray-600 truncate">
                                    Jumat, 19 September 2025 - 14:35
                                </p>
                            </div>

                            <div class="text-right flex-shrink-0">
                                <p class="text-sm font-bold text-accent-5">Laporan Sakit</p>
                                <p class="text-xs text-black">A24</p>
                                <span class="px-2 py-1 rounded-full text-[10px] md:text-xs whitespace-nowrap font-semibold
                                {{ $loop->index == 0 ? 'bg-red-1 text-white' :
                                ($loop->index==1 ? 'bg-yellow-5 text-white' : 'bg-primary-3 text-white') }}">
                                    {{ $loop->index == 0 ? 'Sakit' :
                                    ($loop->index==1 ? 'Pengobatan' : 'Sembuh') }}
                                </span>
                            </div>

                        </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-4">
                        <x-ui.button 
                        size="base" 
                        variant="clean" 
                        href="#" 
                        class="bg-red-1 !text-bg-1"
                        >
                            Lihat Riwayat Laporan
                        </x-ui.button>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>
@endsection