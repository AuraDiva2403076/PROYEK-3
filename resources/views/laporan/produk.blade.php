    @extends('layouts.app')

    @section('title', 'Laporan Produk')

    @section('content')
    <div class="space-y-6">

        {{-- FILTER --}}
        <div class="flex justify-between items-center mt-6">

            {{-- FORM FILTER --}}
            <form method="GET" action="{{ route('laporan.produk') }}"
                class="flex flex-wrap items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-gray-200">

                {{-- PRODUK --}}
                <select name="produk" class="bg-gray-50 text-sm px-3 py-1 rounded-lg border border-gray-200">
                    <option value="">Semua Produk</option>
                    @foreach($produk as $p)
                        <option value="{{ $p->id }}" {{ request('produk') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_produk }}
                        </option>
                    @endforeach
                </select>

                {{-- UKURAN --}}
                <select name="ukuran" class="bg-gray-50 text-sm px-3 py-1 rounded-lg border border-gray-200">
                    <option value="">Semua Ukuran</option>
                    @foreach(['S','M','L','XL','XXL'] as $size)
                        <option value="{{ $size }}" {{ request('ukuran') == $size ? 'selected' : '' }}>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>

                {{-- KATEGORI --}}
                <select name="kategori" class="bg-gray-50 text-sm px-3 py-1 rounded-lg border border-gray-200">
                    <option value="">Semua Kategori</option>
                    @foreach(['Pashmina','Segi Empat'] as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                            {{ $kat }}
                        </option>
                    @endforeach
                </select>

                {{-- WARNA --}}
                <select name="warna" class="bg-gray-50 text-sm px-3 py-1 rounded-lg border border-gray-200">
                    <option value="">Semua Warna</option>
                    @foreach(['Pink','Merah','Biru','Hijau','Kuning','Hitam','Putih'] as $color)
                        <option value="{{ $color }}" {{ request('warna') == $color ? 'selected' : '' }}>
                            {{ $color }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="px-4 py-1 rounded-lg bg-[#f37b7b] text-white text-sm">
                    Filter
                </button>
            </form>

            {{-- DROPDOWN EXPORT --}}
            <div class="relative inline-block text-left">
                <button type="button"
                    class="inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-[#f37b7b] font-bold hover:bg-gray-50">
                    Ekspor
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div
                    class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden"
                    id="exportDropdown">
                    <form method="GET" action="{{ route('laporan.produk.export') }}" class="flex flex-col p-2">
                        <input type="hidden" name="produk" value="{{ request('produk') }}">
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        <input type="hidden" name="ukuran" value="{{ request('ukuran') }}">
                        <input type="hidden" name="warna" value="{{ request('warna') }}">
                        <input type="hidden" name="ids" id="selectedIds">

                        <button type="submit" name="type" value="pdf"
                            class="px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">PDF</button>
                        <button type="submit" name="type" value="excel"
                            class="px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">Excel</button>
                        <button type="submit" name="type" value="csv"
                            class="px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">CSV</button>
                    </form>
                </div>
            </div>

        </div>

        {{-- TABEL --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mt-4">
            <table class="w-full text-sm">
                <thead class="bg-pink-50 text-gray-600">
                    <tr>
                        <th class="p-3">
                            <input type="checkbox" id="checkAll">
                        </th>
                        <th class="p-3 text-left">No</th> {{-- Nomor urut --}}
                        <th class="p-3 text-left">Kode</th>
                        <th class="p-3 text-left">Gambar</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Ukuran</th>
                        <th class="p-3 text-left">Kategori</th>
                        <th class="p-3 text-left">Harga</th>
                        <th class="p-3 text-left">Warna / Stok</th>
                        <th class="p-3 text-left">Deskripsi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach($data as $item)
                    <tr class="hover:bg-gray-50">
                        {{-- CHECKBOX --}}
                        <td class="p-3">
                            <input type="checkbox" class="check-item" value="{{ $item->id }}">
                        </td>

                        {{-- NOMOR URUT --}}
                        <td class="p-3 font-medium text-gray-700">{{ $loop->iteration }}</td>

                        {{-- KODE --}}
                        <td class="p-3 font-medium text-gray-700">{{ $item->kode_produk ?? '-' }}</td>

                        {{-- GAMBAR --}}
                        <td class="p-3">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" class="w-12 h-12 object-cover rounded">
                            @else
                                -
                            @endif
                        </td>

                        {{-- NAMA --}}
                        <td class="p-3">{{ $item->nama_produk ?? '-' }}</td>

                        {{-- UKURAN --}}
                        <td class="p-3">{{ $item->ukuran ?? '-' }}</td>

                        {{-- KATEGORI --}}
                        <td class="p-3">{{ $item->kategori ?? '-' }}</td>

                        {{-- HARGA --}}
                        <td class="p-3">Rp{{ number_format($item->harga,0,',','.') }}</td>

                        {{-- WARNA / STOK --}}
                        <td class="p-3">{{ $item->warna ?? '-' }} / {{ $item->stok ?? '-' }}</td>

                        {{-- DESKRIPSI --}}
                        <td class="p-3">{{ $item->deskripsi ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- PAGINATION --}}
            <div class="p-4 flex justify-center">
                {{ $data->links() }}
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        // Checkbox select all
        const checkAll = document.getElementById('checkAll');
        const checkItems = document.querySelectorAll('.check-item');

        checkAll.addEventListener('change', function() {
            checkItems.forEach(el => el.checked = this.checked);
        });

        // Export dropdown toggle
        const exportBtn = document.querySelector('div.relative > button');
        const dropdown = document.getElementById('exportDropdown');

        exportBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
        });

        window.addEventListener('click', function(e) {
            if (!exportBtn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Kirim ID checkbox ke export form
        const exportForm = dropdown.querySelector('form');
        exportForm.addEventListener('submit', function(e) {
            const selectedIds = [];
            checkItems.forEach(el => {
                if(el.checked) selectedIds.push(el.value);
            });

            document.getElementById('selectedIds').value = JSON.stringify(selectedIds);
        });

    });
    </script>

    @endsection
