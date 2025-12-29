@extends('layouts.admin')

@section('content')
<div class="flex bg-white min-h-screen" x-data="{ open: false }">

    @include('components.layouts.sidebar')

    <main class="flex-1 p-6 lg:ml-72">

    {{-- Mobile topbar --}}
        <div class="flex items-center gap-3 mb-4 md:mb-6 lg:hidden">
            <button @click="open = true" class="p-2 rounded-lg border bg-white shadow">
                <img src="/assets/icons/menu.svg" class="w-5 h-5 md:w-6 md:h-6" alt="menu">
            </button>
            <h1 class="text-xl font-bold">
                Laporan {{ ucfirst($type) }}
            </h1>
        </div>

        <h1 class="text-4xl text-center font-bold mb-4 hidden lg:block">
                Laporan {{ ucfirst($type) }}
        </h1>

        <x-form.stepper
            :currentStep="$step"
            :totalSteps="3"
            :labels="['Step 1', 'Step 2', 'Step 3']"
        />

        <!-- step -->
        @include("pages.admin.ayam.laporan.steps.$type.step$step")

        <!-- nav -->
        @include('pages.admin.ayam.laporan.partials.navigation')

    </main>
</div>
@endsection
