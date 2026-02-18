<aside class="w-64 min-h-screen bg-white p-6 flex flex-col border-r border-gray-100">
    <div class="mb-10 px-4 flex justify-center">
        <img src="{{ asset('images/logohara2.jpg') }}" alt="Hara Logo" class="h-20 w-auto object-contain">
    </div>

    <nav class="space-y-4 flex-1">
        @php
            $menus = [
                ['name' => 'Beranda', 'icon' => 'layout-dashboard', 'route' => 'dashboard'],
                ['name' => 'Katalog Produk', 'icon' => 'shopping-bag', 'route' => 'katalog'],
                ['name' => 'Penjualan', 'icon' => 'tag', 'route' => 'penjualan'],
                ['name' => 'AI Features', 'icon' => 'sparkles', 'route' => 'ai', 'italic' => true],
                ['name' => 'Pengguna', 'icon' => 'users', 'route' => 'pengguna'],
            ];
        @endphp

        @foreach($menus as $menu)
        <a href="{{ Route::has($menu['route']) ? route($menu['route']) : '#' }}"
           class="flex items-center space-x-3 p-3 rounded-xl transition-all duration-300 group
           {{ request()->routeIs($menu['route'])
              ? 'bg-[#FF9B9B] text-white shadow-[0_10px_20px_-5px_rgba(255,155,155,0.5)] -translate-y-1'
              : 'text-pink-300 hover:bg-white hover:text-pink-400 hover:shadow-[0_8px_15px_rgba(0,0,0,0.05)] hover:-translate-y-1'
           }}">
            <i data-lucide="{{ $menu['icon'] }}" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
            <span class="text-sm font-medium {{ $menu['italic'] ?? false ? 'italic' : '' }}">{{ $menu['name'] }}</span>
        </a>

        @endforeach

        @php
            $laporanActive = request()->routeIs('laporan.penjualan')
                || request()->routeIs('laporan.produk')
                || request()->routeIs('laporan.pengguna');
        @endphp

        <div x-data="{ open: {{ $laporanActive ? 'true' : 'false' }} }" class="space-y-1">

            <!-- Parent Menu -->
            <button @click="open = !open"
                class="w-full flex items-center justify-between p-3 rounded-xl transition-all duration-300 group
                {{ $laporanActive
                    ? 'bg-[#FF9B9B] text-white shadow-[0_10px_20px_-5px_rgba(255,155,155,0.5)]'
                    : 'text-pink-300 hover:bg-white hover:text-pink-400 hover:shadow-[0_8px_15px_rgba(0,0,0,0.05)]'
                }}">

                <div class="flex items-center space-x-3">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    <span class="text-sm font-medium">Laporan</span>
                </div>

                <i data-lucide="chevron-down"
                :class="open ? 'rotate-180' : ''"
                class="w-4 h-4 transition-transform duration-300"></i>
            </button>

            <!-- Dropdown -->
            <div x-show="open" x-transition class="ml-6 space-y-2">
                <a href="{{ route('laporan.penjualan') }}"
                class="block text-sm p-2 rounded-lg
                {{ request()->routeIs('laporan.penjualan') ? 'text-[#FF9B9B] font-semibold' : 'text-gray-400 hover:text-pink-400' }}">
                    Laporan Penjualan
                </a>

                <a href="{{ route('laporan.produk') }}"
                class="block text-sm p-2 rounded-lg
                {{ request()->routeIs('laporan.produk') ? 'text-[#FF9B9B] font-semibold' : 'text-gray-400 hover:text-pink-400' }}">
                    Laporan Produk
                </a>

                <a href="{{ route('laporan.pengguna') }}"
                class="block text-sm p-2 rounded-lg
                {{ request()->routeIs('laporan.pengguna') ? 'text-[#FF9B9B] font-semibold' : 'text-gray-400 hover:text-pink-400' }}">
                    Laporan Pengguna
                </a>
            </div>
        </div>
    </nav>

    <div class="mt-auto pt-5 border-t border-gray-50">
        <a href="{{ route('pengaturan') }}"
   class="flex items-center space-x-3 p-3 rounded-xl transition-all duration-300 group
   {{ request()->routeIs('pengaturan')
      ? 'bg-[#FF9B9B] text-white shadow-[0_10px_20px_-5px_rgba(255,155,155,0.5)] -translate-y-1'
      : 'text-pink-300 hover:bg-white hover:text-pink-400 hover:shadow-[0_8px_15px_rgba(0,0,0,0.05)] hover:-translate-y-1'
   }}">
    <i data-lucide="settings" class="w-5 h-5 group-hover:rotate-45 transition-transform"></i>
    <span class="text-sm font-medium">Pengaturan</span>
</a>
    </div>
</aside>

<script>
  lucide.createIcons();
</script>
