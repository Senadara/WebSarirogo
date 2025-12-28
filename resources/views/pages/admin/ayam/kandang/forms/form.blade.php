@extends('layouts.admin')

@section('content')
<div x-data="{ open: false,  showSuccess: false,

        submitForm() {
            this.showSuccess = true;

            setTimeout(() => {
                window.location.href = '{{ route('admin.ayam.kandang.index') }}';
            }, 2000);
        } }" class="flex bg-white min-h-screen">

    @include('components.layouts.sidebar')

    <main class="flex-1 p-6 lg:ml-72">

        <!-- topbar -->
        <div class="flex items-center gap-3 mb-6 lg:hidden">
            <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                <img src="/assets/icons/menu.svg" class="w-6 h-6">
            </button>
            <h1 class="text-lg font-bold">Form Tambah Kandang</h1>
        </div>

        <h1 class="text-4xl font-bold mb-4 hidden lg:block">
            Form Tambah Kandang
        </h1>

        <!-- breadcrump -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <img src="/assets/icons/home.svg" class="w-4 h-4">
                <span>/</span>
                <a href="{{ route('admin.ayam.index') }}">Dashboard</a>
                <span>/</span>
                <span class="font-semibold text-gray-900">Tambah Kandang</span>
            </div>
        </div>

        <!-- step -->
        <x-form.stepper
            :currentStep="$step"
            :totalSteps="3"
            :labels="['Step 1', 'Step 2', 'Step 3']"
            description="" />

        {{-- SLOT STEP CONTENT --}}
        @include('pages.admin.ayam.kandang.forms.steps.step' . $step)

        <!-- nav -->
        <div class="bg-white rounded-xl md:rounded-2xl border border-gray-100 p-4 md:p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row items-center gap-3">

                <!-- kembali -->
                <a
                    href="{{ $step == 1
                ? route('admin.ayam.kandang.index')
                : route('admin.ayam.kandang.create', $step - 1)
            }}"
                    class="w-full sm:w-auto order-2 sm:order-1 py-2.5 md:py-3 px-6 md:px-8 rounded-full bg-gray-200 text-gray-700 font-medium text-center text-sm md:text-base hover:bg-gray-300 transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>

                <div class="flex-1 hidden sm:block"></div>

                <!-- next -->
                <a
                    href="{{ $step < 3
        ? route('admin.ayam.kandang.create', $step + 1)
        : route('admin.ayam.kandang.index')
    }}"
                    @if($step==3)
                    @click.prevent="submitForm"
                    @endif
                    class="w-full sm:w-auto order-1 sm:order-2 py-2.5 md:py-3 px-8 md:px-12 rounded-full bg-gradient-to-r from-primary-3 to-primary-4 text-white font-semibold text-sm md:text-base hover:shadow-lg hover:shadow-primary-3/30 transition-all duration-300 flex items-center justify-center gap-2">
                    {{ $step < 3 ? 'Selanjutnya' : 'Selesai' }}
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>


            </div>
        </div>

        <!-- alert -->
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

                <h2 class="text-lg font-semibold text-gray-900">
                    Data berhasil disimpan
                </h2>

                <p class="text-sm text-gray-600 mt-2">
                    kandang baru telah berhasil ditambahkan.
                </p>

                <p class="text-xs text-gray-400 mt-4">
                    Mengalihkan halaman...
                </p>
            </div>
        </div>

    </main>
</div>
@endsection