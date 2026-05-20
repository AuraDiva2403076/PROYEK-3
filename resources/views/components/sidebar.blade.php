<aside class="w-64 min-h-screen
              bg-white dark:bg-[#1F2937]
              p-6 flex flex-col
              border-r border-gray-100 dark:border-gray-700
              transition-all duration-300">

    {{-- LOGO HARA --}}
    <div class="mb-10 px-4 flex justify-center">

        <div class="w-36 h-20 rounded-xl
                    bg-white dark:bg-[#1E293B]
                    flex items-center justify-center
                    shadow-sm border border-[#F38B93]/10
                    overflow-hidden">

            <img src="{{ asset('images/logohara2.png') }}"
                 alt="Hara Logo"
                 class="h-20 w-auto object-contain rounded-xl
                        transition-all duration-300
                        dark:brightness-0
                        dark:invert
                        dark:sepia
                        dark:saturate-[650%]
                        dark:hue-rotate-[290deg]
                        dark:brightness-[105%]
                        dark:contrast-[95%]">

        </div>

        {{-- NAVIGASI MENU --}}
        <nav class="space-y-4 flex-1">
            @php
                $menus = [
                    ['name' => 'Beranda', 'icon' => 'layout-dashboard', 'route' => 'dashboard'],
                    ['name' => 'Katalog Produk', 'icon' => 'shopping-bag', 'route' => 'katalog'],
                    ['name' => 'Penjualan', 'icon' => 'tag', 'route' => 'penjualan.index'],
                    ['name' => 'Discount', 'icon' => 'percent', 'route' => 'discount.index'],
                    ['name' => 'AI Features', 'icon' => 'sparkles', 'route' => 'dataset-ai.index', 'italic' => true],
                    ['name' => 'Pengguna', 'icon' => 'users', 'route' => 'pengguna'],
                ];
            @endphp
    </div>

    {{-- NAVIGASI MENU --}}
    <nav class="space-y-4 flex-1">

        @php
            $menus = [
                ['name' => 'Beranda', 'icon' => 'layout-dashboard', 'route' => 'dashboard'],
                ['name' => 'Katalog Produk', 'icon' => 'shopping-bag', 'route' => 'katalog'],
                ['name' => 'Penjualan', 'icon' => 'tag', 'route' => 'penjualan'],
                ['name' => 'Discount', 'icon' => 'percent', 'route' => 'discount.index'],
                ['name' => 'AI Features', 'icon' => 'sparkles', 'route' => 'dataset-ai.index', 'italic' => true],
                ['name' => 'Pengguna', 'icon' => 'users', 'route' => 'pengguna'],
            ];
        @endphp

        {{-- LOOP MENU --}}
        @foreach($menus as $menu)

        <a href="{{ Route::has($menu['route']) ? route($menu['route']) : '#' }}"
           class="flex items-center space-x-3 p-3 rounded-xl
                  transition-all duration-300 group

           {{ request()->routeIs($menu['route'])

                ? 'bg-[#F38B93] text-white shadow-[0_10px_20px_-5px_rgba(243,139,147,0.45)]'

                : 'text-gray-500 dark:text-gray-300
                   hover:bg-[#F38B93]/10
                   hover:text-[#F38B93]'
           }}">

            <i data-lucide="{{ $menu['icon'] }}"
               class="w-5 h-5 transition-transform group-hover:scale-110"></i>

            <span class="text-sm font-medium
                         {{ $menu['italic'] ?? false ? 'italic' : '' }}">

                {{ $menu['name'] }}

            </span>

        </a>

        @endforeach

        {{-- DROPDOWN LAPORAN --}}
        @php
            $laporanActive = request()->routeIs('laporan.penjualan')
                || request()->routeIs('laporan.produk')
                || request()->routeIs('laporan.pengguna');
        @endphp

        <div x-data="{ open: {{ $laporanActive ? 'true' : 'false' }} }"
             class="space-y-1">

            <button @click="open = !open"
                class="w-full flex items-center justify-between
                       p-3 rounded-xl transition-all duration-300 group

                {{ $laporanActive

                    ? 'bg-[#F38B93] text-white shadow-[0_10px_20px_-5px_rgba(243,139,147,0.45)]'

                    : 'text-gray-500 dark:text-gray-300
                       hover:bg-[#F38B93]/10
                       hover:text-[#F38B93]'
                }}">

                <div class="flex items-center space-x-3">

                    <i data-lucide="file-text" class="w-5 h-5"></i>

                    <span class="text-sm font-medium">
                        Laporan
                    </span>

                </div>

                <i data-lucide="chevron-down"
                   :class="open ? 'rotate-180' : ''"
                   class="w-4 h-4 transition-transform duration-300"></i>

            </button>

            {{-- SUBMENU --}}
            <div x-show="open"
                 x-transition
                 class="ml-6 space-y-2">

                <a href="{{ route('laporan.penjualan') }}"
                   class="block text-sm p-2 rounded-lg transition-all

                   {{ request()->routeIs('laporan.penjualan')

                        ? 'text-[#F38B93] font-semibold'

                        : 'text-gray-500 dark:text-gray-400
                           hover:text-[#F38B93]'
                   }}">

                    Laporan Penjualan

                </a>

                <a href="{{ route('laporan.produk') }}"
                   class="block text-sm p-2 rounded-lg transition-all

                   {{ request()->routeIs('laporan.produk')

                        ? 'text-[#F38B93] font-semibold'

                        : 'text-gray-500 dark:text-gray-400
                           hover:text-[#F38B93]'
                   }}">

                    Laporan Produk

                </a>

                <a href="{{ route('laporan.pengguna') }}"
                   class="block text-sm p-2 rounded-lg transition-all

                   {{ request()->routeIs('laporan.pengguna')

                        ? 'text-[#F38B93] font-semibold'

                        : 'text-gray-500 dark:text-gray-400
                           hover:text-[#F38B93]'
                   }}">

                    Laporan Pengguna

                </a>

            </div>

        </div>

    </nav>

    {{-- PENGATURAN --}}
    <div class="mt-auto pt-5 border-t
                border-gray-100 dark:border-gray-700">

        <a href="{{ route('pengaturan') }}"
           class="flex items-center space-x-3 p-3 rounded-xl
                  transition-all duration-300 group

           {{ request()->routeIs('pengaturan')

                ? 'bg-[#F38B93] text-white shadow-[0_10px_20px_-5px_rgba(243,139,147,0.45)]'

                : 'text-gray-500 dark:text-gray-300
                   hover:bg-[#F38B93]/10
                   hover:text-[#F38B93]'
           }}">

            <i data-lucide="settings"
               class="w-5 h-5 group-hover:rotate-45 transition-transform"></i>

            <span class="text-sm font-medium">
                Pengaturan
            </span>

        </a>

    </div>

</aside>

<script>
    lucide.createIcons();
</script>