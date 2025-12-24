<!-- list seluruh laporan peternakan -->
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
            <h1 class="text-lg font-bold">Laporan Peternakan</h1>
        </div>

        <h1 class="text-4xl font-bold mb-4 hidden lg:block">Laporan Peternakan</h1>

        <!-- breadcrumps -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">

            <div class="flex items-center gap-2 text-sm text-gray-600">
                <img src="/assets/icons/home.svg" class="w-4 h-4">
                <span>/</span>
                <a href="{{ route('admin.ayam.index') }}"
                    class="hover:underline hover:text-primary-2 transition">
                    Dashboard
                </a>

                <span>/</span>
                <span class="font-semibold text-gray-900">Laporan</span>
            </div>

            <div class="flex items-center gap-4">
                <button class="relative p-2 rounded-full hover:bg-gray-100">
                    <img src="/assets/icons/notification.svg" class="w-5 h-5">
                    <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                </button>

                <button class="p-2 rounded-full hover:bg-gray-100">
                    <img src="/assets/icons/user.svg" class="w-5 h-5">
                </button>
            </div>
        </div>

        <!-- box info -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
            <h3 class="font-bold text-black mb-1">Halaman Laporan Peternakan</h3>
            <p class="md:text-sm text-gray-600 text-xs">
                Lihat informasi lengkap terkait penggunaan barang pada tanggal dan kebutuhan tertentu.
            </p>
            <p class="text-xs text-black mt-2 font-bold">
                {{ now()->translatedFormat('l, d F Y') }}
            </p>
        </div>

        <!-- menu -->
        <div class="border rounded-2xl p-5 bg-white shadow-sm mb-8">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Menu</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <x-ui.MenuButton
                    href="{{ route('admin.ayam.laporan.harian.step1') }}"
                    icon="/assets/icons/note.svg"
                    title="Laporan Harian"
                    description="Catat aktivitas rutin harian di lahan"
                    iconVariant="green"
                    variant="primary_1" />

                <x-ui.MenuButton
                    href=""
                    icon="/assets/icons/boxx.svg"
                    title="Laporan Panen"
                    description="Rekap hasil panen dan distribusinya"
                    iconVariant="yellow"
                    variant="yellow_1" />

                <x-ui.MenuButton
                    href=""
                    icon="/assets/icons/add.svg"
                    title="Laporan Insiden"
                    description="Laporkan kejadian tidak terduga"
                    iconVariant="blue"
                    variant="accent_1" />

            </div>
        </div>

        <!-- header riwayat dan filter -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-gray-800">Riwayat Laporan</h3>

            <button class="flex items-center gap-2 px-4 py-2 rounded-lg border text-sm hover:bg-gray-100 transition">
                <img src="/assets/icons/filter.svg" class="w-4 h-4">
                Filter
            </button>
        </div>

        <!-- hari ini -->
        <p class="text-sm font-semibold text-gray-700 mb-3">Hari Ini</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-8">

            @foreach ([1,2] as $item)
            <a href="{{ route('admin.ayam.laporan.harian.detail') }}"
                class="bg-bg-2 rounded-xl p-4 flex items-center justify-between hover:shadow-md hover:ring-1 hover:ring-accent-2 hover:bg-blue-100  transition">

                <div>
                    <p class="text-xs text-gray-500 mb-1">Lahan A</p>
                    <h4 class="font-bold text-sm mb-1">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </h4>
                    <p class="text-xs text-gray-500">14:35</p>
                </div>

                <div class="text-right">
                    <p class="text-xs font-bold text-green-600 mb-1">Laporan Harian</p>
                    <p class="text-xs text-gray-500 mb-1">Penyiraman & Pemupukan</p>
                    <p class="text-xs font-semibold text-gray-800">Pak Hari</p>
                </div>

            </a>
            @endforeach

        </div>

        <!-- kemarin -->
        <p class="text-sm font-semibold text-gray-700 mb-3">Kemarin</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

            @foreach ([1,2] as $item)
            <a href="{{ route('admin.ayam.laporan.panen.detail') }}" 
                    class="bg-gray-50 rounded-xl p-4 flex items-center justify-between hover:shadow-md hover:ring-1 hover:ring-accent-2 hover:bg-blue-100  transition">

                    <div>
                        <p class="text-xs text-gray-500 mb-1">Lahan A</p>
                        <h4 class="font-bold text-sm mb-1">
                            {{ now()->subDay()->translatedFormat('l, d F Y') }}
                        </h4>
                        <p class="text-xs text-gray-500">14:35</p>
                    </div>

                    <div class="text-right">
                        <p class="text-xs font-bold text-orange-500 mb-1">Laporan Panen</p>
                        <p class="text-xs text-gray-500 mb-2">1000 Kg</p>
                        <p class="text-xs font-semibold text-gray-800">Bu Sari</p>
                    </div>
            </a>
            @endforeach

             @foreach ([1,2,3,4] as $item)
            <a href="{{ route('admin.ayam.laporan.insiden.detail') }}" 
                    class="bg-gray-50 rounded-xl p-4 flex items-center justify-between hover:shadow-md hover:ring-1 hover:ring-accent-2 hover:bg-blue-100  transition">

                    <div>
                        <p class="text-xs text-gray-500 mb-1">Lahan A</p>
                        <h4 class="font-bold text-sm mb-1">
                            {{ now()->subDay()->translatedFormat('l, d F Y') }}
                        </h4>
                        <p class="text-xs text-gray-500">14:35</p>
                    </div>

                    <div class="text-right">
                        <p class="text-xs font-bold text-red-1 mb-1">Laporan Insiden</p>
                        <p class="text-xs text-gray-500 mb-2">Bencana</p>
                        <p class="text-xs font-semibold text-gray-800">Bu Sari</p>
                    </div>
            </a>
            @endforeach


        </div>

</div>

</main>
</div>
@endsection