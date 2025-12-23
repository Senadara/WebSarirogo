<div 
    class="relative"
>

    <!-- mobile overlay -->
    <div 
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 bg-black/40 z-40 lg:hidden"
        @click="open = false"
    ></div>

    <!-- sidebar -->
    <aside 
        class="fixed top-0 left-0 z-50 h-full w-72 bg-white border-r shadow-sm
               transform transition-all duration-300
               lg:translate-x-0"
        :class="open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    >

        <!-- header -->
        <div class="flex items-center gap-3 p-5 border-b">
            <div class="w-10 h-10 rounded-full bg-gray-200"></div>
            <div>
                <h1 class="font-semibold text-black text-lg leading-tight">Smart Farm</h1>
                <p class="text-sm text-gray-700 italic">Sarirogo</p>
            </div>

            <button 
                @click="open= false"
                class="ml-auto lg:hidden"
            >
                <img src="/assets/icons/menu.svg" class="w-5 h-5" alt="close">
            </button>
        </div>

        <nav class="px-4 mt-5 space-y-2">
            <p class="text-[11px] font-semibold tracking-wide text-black uppercase px-2">
                Menu
            </p>

            <!-- ayam -->
            <a 
                href="{{ route('admin.ayam.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition group
                    {{ request()->is('admin/ayam*') 
                        ? 'bg-primary-2 font-semibold text-black' 
                        : 'text-text-4 hover:bg-primary-2' }}"
            >
                <img src="/assets/icons/home.svg" class="w-5 h-5" alt="dashboard">
                <span class="text-sm font-semibold">Dashboard</span>
            </a>

            <!-- inventory -->
            <a 
                href="{{ route('admin.inventory.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition group
                    {{ request()->is('admin/inventory*') 
                        ? 'bg-primary-2 font-semibold text-black' 
                        : 'text-text-4 hover:bg-primary-2' }}"
            >
                <img src="/assets/icons/warehouse.svg" class="w-5 h-5" alt="inventaris">
                <span class="text-sm font-semibold">Inventaris</span>
            </a>

            <!-- admin -->
            <p class="text-[11px] font-semibold tracking-wide text-black uppercase px-2">
                Admin Panel
            </p>

            <!-- manage user -->
            <a 
                href=""
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition group
                    {{ request()->is('admin/users*') 
                        ? 'bg-primary-2 font-semibold text-black' 
                        : 'text-text-4 hover:bg-primary-2' }}"
            >
                <img src="/assets/icons/user.svg" class="w-5 h-5" alt="users">
                <span class="text-sm font-semibold">Management User</span>
            </a>

            <!-- riwayat -->
            <a 
                href=""
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition group
                    {{ request()->is('admin/riwayat*') 
                        ? 'bg-primary-2 font-semibold text-black' 
                        : 'text-text-4 hover:bg-primary-2' }}"
            >
                <img src="/assets/icons/riwayat.svg" class="w-5 h-5" alt="riwayat">
                <span class="text-sm font-semibold">Riwayat Aktivitas</span>
            </a>

        </nav>
    </aside>
</div>
