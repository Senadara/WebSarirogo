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

        <h1 class="text-4xl font-bold mb-4 hidden lg:block">Data Kandang</h1>

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
                <span class="font-semibold text-gray-900">Kandang</span>
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

        <!-- info box -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
            <h3 class="font-bold text-black mb-1">Halaman Seluruh Kandang</h3>
            <p class="md:text-sm text-gray-600 text-xs">
                Pilih kandang untuk melihat detail informasi kandang
            </p>
            <p class="text-xs text-black mt-2 font-bold">
                {{ now()->translatedFormat('l, d F Y') }}
            </p>

        </div>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

            <x-ui.search placeholder="Cari kandang..." />

            <!-- filter -->
            <div class="flex items-center gap-3">
                <button class="flex items-center gap-2 px-4 py-2 rounded-lg border text-sm hover:bg-gray-100">
                    <img src="/assets/icons/filter.svg" class="w-4 h-4">
                    Filter
                </button>

                <!-- implement component -->
                <x-ui.Button
                    size="base"
                    variant="primary"
                    href="{{ route('admin.ayam.kandang.create', 1) }}">
                    <img src="/assets/icons/add-square.svg" class="w-4 h-4 mr-2">
                    Tambah Kandang
                </x-ui.Button>
            </div>
        </div>

        <!-- grid kandang -->
        <a href="{{ route('admin.ayam.kandang.show') }}">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                <!-- card -->
                @foreach ([1,2,3,4] as $item)
                <div class="group bg-bg-2  hover:ring-1 hover:ring-accent-2 hover:bg-blue-100 transition rounded-xl p-4 flex gap-4 items-center cursor-pointer">

                    <!-- gambar -->
                    <img src="/assets/icons/kandang.svg"
                        class="w-20 h-20 rounded-lg object-cover">

                    <!-- info -->
                    <div class="flex-1">
                        <h4 class="font-bold">Kandang A</h4>
                        <p class="text-sm text-gray-600">7 Minggu</p>
                        <p class="text-sm text-gray-600">1000 Ekor</p>
                    </div>

                    <div class="text-right">
                        <p class="text-xs text-black mb-1 font-bold">Produksi</p>

                        <p class="text-sm text-black mb-1">0 butir/hari</p>

                        @if ($loop->index == 0)
                        <span class="px-3 py-1 text-xs rounded-full bg-accent-3 text-white font-semibold">Starter</span>
                        @elseif ($loop->index == 1)
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-3 text-white font-semibold">Grower</span>
                        @elseif ($loop->index == 2)
                        <span class="px-3 py-1 text-xs rounded-full bg-primary-3 text-white font-semibold">Production</span>
                        @else
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-5 text-white font-semibold">Afkir</span>
                        @endif

                    </div>

                </div>
                @endforeach

            </div>
        </a>
    </main>
</div>
@endsection