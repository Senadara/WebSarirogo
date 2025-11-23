<nav class="fixed top-4 left-1/2 -translate-x-1/2 w-[95%] max-w-6xl rounded-xl bg-white/10 backdrop-blur-md shadow-md px-4 py-3 flex items-center justify-between lg:px-8 z-[100]" aria-label="Global">

    <!-- Logo -->
    <div class="flex items-center">
        <a href="/" class="text-lg font-bold text-gray-900">Sarirogo</a>
    </div>

    <!-- Hamburger -->
    <div class="lg:hidden">
        <button id="hamburgerBtn" type="button"
            class="inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-100 transition-colors duration-300">
            <span class="sr-only">Buka menu</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Desktop menu -->
    <div class="hidden lg:flex gap-x-10 items-center">
        <a href="#statistik" class="nav-link">Statistik</a>
    </div>

    <!-- Mobile menu -->
    <div id="mobileMenu"
        class="hidden absolute top-20 w-[90%] rounded-xl bg-white/70 backdrop-blur-3xl shadow-md py-4 text-center">

        <a href="#statistik" class="block nav-link py-5">Statistik</a>
    </div>
</nav>
