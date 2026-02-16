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
                ['name' => 'Laporan', 'icon' => 'file-text', 'route' => 'laporan'],
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
