@extends('layouts.admin')

@section('content')
<div x-data="{ open: false }" class="flex bg-white min-h-screen">

    <!--  -->
    @include('components.layouts.sidebar')

    <main class="flex-1 p-6 lg:ml-72">

        <!-- topbar -->
        <div class="flex items-center gap-3 mb-6 lg:hidden">
            <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                <img src="/assets/icons/menu.svg" class="w-6 h-6">
            </button>
            <h1 class="text-lg font-bold">Dashboard</h1>
        </div>

        <!-- judul page -->
        <h1 class="text-3xl font-bold mb-6 hidden lg:block">Dashboard</h1>

        <!-- topbar -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">

            <div class="flex items-center gap-2 text-sm text-gray-600">
                <img src="/assets/icons/home.svg" class="w-4 h-4">
                <span>/</span>
                <span class="font-semibold text-gray-900">Dashboard</span>
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

        <!-- menu section -->
        <div class="border rounded-2xl p-5 bg-white shadow-sm mb-6">

            <!-- HEADER MENU -->
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-lg font-semibold text-gray-800">
                    Menu Manajemen Ayam
                </h2>
            </div>

            <!-- GRID MENU -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <x-ui.MenuButton
                    href="{{ route('admin.ayam.kandang.index') }}"
                    icon="/assets/icons/boxx.svg"
                    title="Data Kandang"
                    description="Kelola informasi setiap kandang ayam"
                    iconVariant="green"
                    variant="primary_1" />

                <x-ui.MenuButton
                    href="{{ route('admin.ayam.laporan.index') }}"
                    icon="/assets/icons/note.svg"
                    title="Laporan Peternakan"
                    description="Catat aktivitas harian secara rutin"
                    iconVariant="yellow"
                    variant="yellow_1" />

                <x-ui.MenuButton
                    href=""
                    icon="/assets/icons/add.svg"
                    title="Manajemen Pakan"
                    description="Analisis pertumbuhan & panen"
                    iconVariant="blue"
                    variant="accent_1" />
            </div>
        </div>

        <!-- grid card -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

            <!-- card cuaca -->
            <div class="bg-white p-6 rounded-xl shadow border">

                <!-- header -->
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-lg">Cuaca Saat Ini</h3>
                    <a href="#" class="text-sm text-green-600 hover:underline">
                        Lihat Laporan Cuaca
                    </a>
                </div>

                <!-- konten icon suhu -->
                <div class="flex flex-col lg:flex-row items-center lg:items-start md:gap-36 gap-6">

                    <!-- icon dan suhu -->
                    <div class="flex flex-col items-center text-center gap-1 lg:items-center md:pl-14 lg:text-left md:pt-7 pt-4">
                        <img src="/assets/icons/matahari.svg" class="w-20 h-20" alt="cuaca">

                        <h2 class="text-3xl font-bold">28°C</h2>
                        <p class="text-gray-600">Cerah</p>
                    </div>

                    <!-- detail cuaca -->
                    <div class="flex-1 grid grid-cols-1 gap-2 text-sm w-full md:pt-7">

                        <!-- kelembaban -->
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Kelembaban</span>
                            <span class="font-semibold text-lg text-right">65%</span>
                        </div>

                        <!-- angin -->
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Angin</span>
                            <span class="font-semibold text-lg text-right">12 km/h</span>
                        </div>

                        <!-- hujan -->
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Hujan</span>
                            <span class="font-semibold text-lg text-right">0 mm</span>
                        </div>

                    </div>

                </div>
            </div>

            <!-- recent alerts -->
            <div class="bg-white p-6 rounded-xl shadow border">

                <h3 class="font-semibold text-lg mb-4">Recent Alerts</h3>

                <div class="space-y-3">

                    <div class="flex gap-3 items-start bg-red-3 text-[#7F1D1D] p-3 rounded-lg">
                        <img src="/assets/icons/alert.svg" class="w-5 h-5 mt-1">
                        <div>
                            <p class="font-semibold bg-red-3">Low Feed Stock</p>
                            <p class="text-sm text-[#B91C1C]">Chicken feed below 15%</p>
                        </div>
                    </div>

                    <div class="flex gap-3 items-start bg-[#FEFCE8] text-[#713F12] p-3 rounded-lg">
                        <img src="/assets/icons/warning.svg" class="w-5 h-5 mt-1">
                        <div>
                            <p class="font-semibold">Temperature Alert</p>
                            <p class="text-sm text-[#A16207]">Catfish pond temperature high</p>
                        </div>
                    </div>

                    <div class="flex gap-3 items-start bg-green-50 text-green-700 p-3 rounded-lg">
                        <img src="/assets/icons/check.svg" class="w-5 h-5 mt-1">
                        <div>
                            <p class="font-semibold">Harvest Ready</p>
                            <p class="text-sm">Okra section A ready</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>


        <!-- section grafik -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mt-8">

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

                    <!-- ilustrasi foto     -->
                    <img src="/assets/icons/ilustrasiip.svg" class="w-40 h-40 object-contain lg:ml-5" alt="ilustrasi">
                </div>
            </div>

            <!-- fcr time -->
            <div class="bg-white p-6 rounded-xl shadow border">
                <h3 class="font-semibold text-lg mb-4">FCR Ayam</h3>

                <!-- grafik -->
                <div class="relative">
                    <canvas id="chartFCR" class="w-full h-40"></canvas>
                </div>
            </div>
        </div>

        <!-- card bawah  -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mt-6">

            <div class="p-4 bg-white rounded-xl border shadow">
                <p class="text-gray-600 text-sm">Populasi Ayam</p>
                <h2 class="text-2xl font-bold text-[#16A34A]">1,245</h2>
                <p class="text-[#22C55E] text-sm">+12% bulan ini</p>
            </div>

            <div class="p-4 bg-white rounded-xl border shadow">
                <p class="text-gray-600 text-sm">Produksi Telur</p>
                <h2 class="text-2xl font-bold text-[#2563EB]">856</h2>
                <p class="text-[#3B82F6] text-sm">+8% bulan ini</p>
            </div>

            <div class="p-4 bg-white rounded-xl border shadow">
                <p class="text-gray-600 text-sm">Ayam Produktif</p>
                <h2 class="text-2xl font-bold text-[#9333EA]">400</h2>
            </div>

            <div class="p-4 bg-white rounded-xl border shadow">
                <p class="text-gray-600 text-sm">Ayam Sakit</p>
                <h2 class="text-2xl font-bold text-[#D97706]">2</h2>
                <p class="text-[#F59E0B] text-sm">Lahan Aktif</p>
            </div>
        </div>
    </main>
</div>
@endsection