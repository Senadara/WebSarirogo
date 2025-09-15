<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Desa Sarirogo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body class="bg-white text-gray-900">

<header class="flex justify-center mt-8">
   <nav class="fixed top-4 left-1/2 -translate-x-1/2 w-[95%] max-w-6xl rounded-xl bg-white/10 backdrop-blur-md shadow-md px-4 py-3 flex items-center justify-between lg:px-8 z-[100]" aria-label="Global">
        <!-- logo -->
        <div class="flex items-center">
            <a href="/" class="text-lg font-bold text-gray-900">Sarirogo</a>
        </div>

        <!-- hamburger -->
        <div class="lg:hidden">
            <button id="hamburgerBtn" type="button" class="inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-100 transition-colors duration-300">
                <span class="sr-only">Buka menu</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- desktop menu -->
        <div class="hidden lg:flex gap-x-10 items-center">
            <a href="#statistik" class="nav-link">Statistik</a>
        </div>

         <!-- mobile menu -->
        <div id="mobileMenu" class="hidden absolute top-20 w-[90%] rounded-xl bg-white/70 backdrop-blur-3xl shadow-md py-4 text-center z-100">
            <a href="#statistik" class="block nav-link py-5">Statistik</a>
        </div>
    </nav>
</header>

<!-- hero section -->
<section class="relative isolate px-4 md:pt-36 sm:px-6 lg:px-8">
  <!-- background -->
  <div class="absolute inset-x-0 -top-40 -z-10 blur-3xl sm:-top-80">
    <div
      class="relative left-[calc(50%-11rem)] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#34d399] to-[#10b981] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem] aspect-[1155/678]">
    </div>
  </div>

  <!-- tagline -->
  <div class="flex justify-center mb-4 sm:mb-4 mt-24">
    <div class="relative rounded-full px-3 py-1 text-sm text-gray-600 ring-1 ring-gray-900/30 ">
      Sistem pemantauan peternakan Sarirogo
    </div>
  </div>

  <!-- hero content -->
  <div class="mx-auto max-w-5xl text-center">
    <h1 class="md:text-4xl text-3xl lg:text-5xl font-bold tracking-tight text-gray-900">
      Dashboard Monitoring Peternakan Sarirogo
    </h1>
    <p class="mt-5 text-base sm:text-sm lg:text-base text-gray-600 leading-relaxed">
      Sumber informasi resmi hasil populasi peternakan desa Sarirogo.
    </p>

    <!-- button -->
    <div class="mt-8 flex justify-center">
      <a href="#statistik"
        class="group relative inline-flex w-full sm:w-auto justify-center items-center border font-sans font-medium text-center transition-all duration-300 ease-in text-xs sm:text-sm md:text-base rounded-full py-2.5 px-10 sm:px-16 md:px-20 shadow-sm hover:shadow-lg bg-slate-800 border-slate-800 text-slate-50 hover:bg-slate-700 hover:border-slate-700 overflow-hidden">

        <span
          class="relative z-10 flex items-center gap-x-2 transition-transform duration-500 ease-out translate-x-0 group-hover:-translate-x-1.5">
          Lihat Seluruh Statistik
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"
            class="w-4 h-4 sm:w-5 sm:h-5 text-slate-50 opacity-0 translate-x-2 translate-y-2 transition-all duration-500 ease-out group-hover:opacity-100 group-hover:translate-x-0 group-hover:translate-y-0">
            <path fill="currentColor"
              d="M221.65674,133.65674l-80,80A7.99981,7.99981,0,0,1,128,208V147.31348L61.65674,213.65674A7.99981,7.99981,0,0,1,48,208V48a7.99981,7.99981,0,0,1,13.65674-5.65674L128,108.68652V48a7.99981,7.99981,0,0,1,13.65674-5.65674l80,80A7.99915,7.99915,0,0,1,221.65674,133.65674Z" />
          </svg>
        </span>
      </a>
    </div>
  </div>
</section>
<!-- end section hero -->

<!-- statistik Section -->
<section id="statistik" class="md:py-44 py-10 px-4 sm:px-6 lg:px-20">
  <div class="max-w-6xl mx-auto">
<!--     
    <h2 class="text-3xl sm:text-2xl lg:text-4xl font-bold text-gray-800 text-left mb-12">
      Statistik Peternakan & Pertanian
    </h2>  -->

    <!-- statistik -->
    <section class="grid gap-6 md:grid-cols-3 p-4 md:p-8 max-w-5xl mx-auto w-full">
      
      <!-- populasi Ternak -->
      <div class="p-6 bg-gray-500 shadow rounded-2xl">
        <dl class="space-y-2">
          <dt class="text-sm font-medium text-gray-200">Populasi Ternak</dt>
          <dd class="text-5xl font-light md:text-6xl dark:text-white">
            {{ $populasiAyam + $populasiKambing + $populasiIkan }}
          </dd>
          <dd class="flex items-center space-x-1 text-sm font-medium text-green-500 dark:text-green-400">
            <span>Ayam: {{ $populasiAyam }}, Kambing: {{ $populasiKambing }}, Ikan: {{ $populasiIkan }}</span>
            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M17.25 15.25V6.75H8.75"/>
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M17 7L6.75 17.25"/>
            </svg>
          </dd>
        </dl>
      </div>

      <!-- hasil panen -->
      <div class="p-6 bg-gray-500 shadow rounded-2xl">
        <dl class="space-y-2">
          <dt class="text-sm font-medium text-gray-200">Hasil Panen</dt>
          <dd class="text-5xl font-light md:text-6xl dark:text-white">
            {{ $dataTanaman->sum('total_tanaman') }}
          </dd>
          <dd class="flex items-center space-x-1 text-sm font-medium text-green-500 dark:text-green-400">
            <span>Luas lahan total: {{ $dataTanaman->sum('luas_lahan') }} m²</span>
            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M17.25 15.25V6.75H8.75"/>
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M17 7L6.75 17.25"/>
            </svg>
          </dd>
        </dl>
      </div>

      <!-- laporan ternak -->
      <div class="p-6 bg-gray-500 shadow rounded-2xl">
        <dl class="space-y-2">
          <dt class="text-sm font-medium text-gray-200">Laporan Ternak</dt>
          <dd class="text-5xl font-light md:text-6xl dark:text-white">
            {{ $laporanStatistik['growth'] }}
          </dd>
          <dd class="flex items-center space-x-1 text-sm font-medium text-red-500 dark:text-red-400">
            <span>Mati: {{ $laporanStatistik['dead'] }}, Baru lahir: {{ $laporanStatistik['new'] }}</span>
            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M17.25 8.75V17.25H8.75"/>
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M17 17L6.75 6.75"/>
            </svg>
          </dd>
        </dl>
      </div>

      <!-- inventory -->
      <div class="p-6 bg-gray-500 shadow rounded-2xl">
        <dl class="space-y-2">
          <dt class="text-sm font-medium text-gray-200">Stok Inventory</dt>
          <dd class="text-5xl font-light md:text-6xl dark:text-white">
            {{ $stokInventory->sum('total') }}
          </dd>
          <dd class="flex items-center space-x-1 text-sm font-medium text-green-500 dark:text-green-400">
            <span>{{ $stokInventory->count() }} jenis barang</span>
          </dd>
        </dl>
      </div>

      <!-- transaksi -->
      <div class="p-6 bg-gray-500 shadow rounded-2xl md:col-span-2">
        <dl class="space-y-2">
          <dt class="text-sm font-medium text-gray-200">Rekap Transaksi</dt>
          <dd class="text-5xl font-light md:text-6xl dark:text-white">
            Rp {{ number_format($totalIncome - $totalOutcome, 0, ',', '.') }}
          </dd>
          <dd class="flex items-center space-x-1 text-sm font-medium text-green-500 dark:text-green-400">
            <span>Pemasukan: Rp {{ number_format($totalIncome, 0, ',', '.') }}</span>
            <span class="ml-2">Pengeluaran: Rp {{ number_format($totalOutcome, 0, ',', '.') }}</span>
          </dd>
        </dl>
      </div>

      <!-- kandang -->
      <div class="p-6 bg-gray-500 shadow rounded-2xl md:col-span-3">
        <dl class="space-y-2">
          <dt class="text-sm font-medium text-gray-200">Kandang & Ternak</dt>
          <dd class="text-5xl font-light md:text-6xl dark:text-white">
            {{ $totalKandang }}
          </dd>
          <dd class="flex items-center space-x-1 text-sm font-medium text-green-500 dark:text-green-400">
            <span>Hidup: {{ $totalHidup }}, Mati: {{ $totalMati }}</span>
          </dd>
        </dl>
      </div>
    </section>
  </div>
</section>
<!-- end section statistik -->

</body>
</html>
