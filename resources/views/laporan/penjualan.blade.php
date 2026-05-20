@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="space-y-6 text-gray-800 dark:text-white">

    <div class="flex flex-col xl:flex-row xl:justify-between xl:items-center gap-4 mt-6">

        <form method="GET" action="{{ route('laporan.penjualan') }}"
            class="flex flex-wrap items-center gap-3 bg-white dark:bg-[#1E293B] px-5 py-3 rounded-2xl shadow-lg border border-[#F38B93]/20">

            <span class="text-sm text-gray-500 dark:text-slate-400">Mulai:</span>
            <input type="date" name="start_date" value="{{ request('start_date') }}"
                class="bg-white dark:bg-[#0F172A] text-gray-700 dark:text-white text-sm px-3 py-2 rounded-lg border border-[#F38B93]/25 focus:outline-none focus:border-[#F38B93] focus:ring-2 focus:ring-[#F38B93]/20">

            <span class="text-sm text-gray-500 dark:text-slate-400">Akhir:</span>
            <input type="date" name="end_date" value="{{ request('end_date') }}"
                class="bg-white dark:bg-[#0F172A] text-gray-700 dark:text-white text-sm px-3 py-2 rounded-lg border border-[#F38B93]/25 focus:outline-none focus:border-[#F38B93] focus:ring-2 focus:ring-[#F38B93]/20">

            <select name="produk"
                class="bg-white dark:bg-[#0F172A] text-gray-700 dark:text-white text-sm px-3 py-2 rounded-lg border border-[#F38B93]/25 focus:outline-none focus:border-[#F38B93] focus:ring-2 focus:ring-[#F38B93]/20">
                <option value="">Semua Produk</option>
                @foreach($produk as $p)
                    <option value="{{ $p->id }}" {{ request('produk') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_produk }}
                    </option>
                @endforeach
            </select>

            <select name="status"
                class="bg-white dark:bg-[#0F172A] text-gray-700 dark:text-white text-sm px-3 py-2 rounded-lg border border-[#F38B93]/25 focus:outline-none focus:border-[#F38B93] focus:ring-2 focus:ring-[#F38B93]/20">
                <option value="">Semua Status</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Batal" {{ request('status') == 'Batal' ? 'selected' : '' }}>Batal</option>
                <option value="Dalam Proses" {{ request('status') == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
            </select>

            <button type="submit"
                class="px-5 py-2 rounded-lg text-white text-sm font-semibold shadow-md transition-all duration-300"
                style="background-color:#F38B93;"
                onmouseover="this.style.backgroundColor='#ea7d86'"
                onmouseout="this.style.backgroundColor='#F38B93'">
                Filter
            </button>
        </form>

        <div class="relative inline-block text-left">
            <button type="button"
                class="inline-flex justify-center items-center rounded-full border border-[#F38B93]/25 shadow-sm px-5 py-2 bg-white dark:bg-[#1E293B] text-sm font-semibold text-[#F38B93] hover:bg-[#F38B93]/10 transition-all duration-300">
                Ekspor
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div id="exportDropdown"
                class="origin-top-right absolute right-0 mt-2 w-40 rounded-xl shadow-lg bg-white dark:bg-[#1E293B] ring-1 ring-[#F38B93]/20 hidden z-50 overflow-hidden">
                <form method="GET" action="{{ route('laporan.penjualan.export') }}" class="flex flex-col p-2">
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <input type="hidden" name="produk" value="{{ request('produk') }}">
                    <input type="hidden" name="ids" id="selectedIds">

                    <button type="submit" name="type" value="pdf"
                        class="px-4 py-2 rounded-lg text-left text-sm text-gray-600 dark:text-slate-300 hover:bg-[#F38B93]/10 hover:text-[#F38B93] transition">
                        PDF
                    </button>
                    <button type="submit" name="type" value="excel"
                        class="px-4 py-2 rounded-lg text-left text-sm text-gray-600 dark:text-slate-300 hover:bg-[#F38B93]/10 hover:text-[#F38B93] transition">
                        Excel
                    </button>
                    <button type="submit" name="type" value="csv"
                        class="px-4 py-2 rounded-lg text-left text-sm text-gray-600 dark:text-slate-300 hover:bg-[#F38B93]/10 hover:text-[#F38B93] transition">
                        CSV
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1E293B] rounded-2xl shadow-lg border border-[#F38B93]/20 overflow-hidden mt-4">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-white" style="background-color:#F38B93;">
                    <tr>
                        <th class="p-3"><input type="checkbox" id="checkAll"></th>
                        <th class="p-3 text-left font-semibold">No</th>
                        <th class="p-3 text-left font-semibold">Kode Pesanan</th>
                        <th class="p-3 text-left font-semibold">Produk</th>
                        <th class="p-3 text-left font-semibold">Nama Pelanggan</th>
                        <th class="p-3 text-left font-semibold">Jumlah</th>
                        <th class="p-3 text-left font-semibold">Harga</th>
                        <th class="p-3 text-left font-semibold">Total</th>
                        <th class="p-3 text-left font-semibold">Tanggal</th>
                        <th class="p-3 text-left font-semibold">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#F38B93]/10 bg-white dark:bg-[#1E293B]">
                    @foreach($data as $item)
                    <tr class="hover:bg-[#F38B93]/10 transition-all duration-300">
                        <td class="p-3"><input type="checkbox" class="check-item" value="{{ $item->id }}"></td>
                        <td class="p-3 font-medium text-gray-800 dark:text-white">{{ $loop->iteration }}</td>
                        <td class="p-3 font-medium text-gray-800 dark:text-white">{{ $item->kode_pesanan }}</td>
                        <td class="p-3 text-gray-600 dark:text-slate-300">{{ $item->produk->nama_produk ?? '-' }}</td>
                        <td class="p-3 text-gray-600 dark:text-slate-300">{{ $item->pelanggan->nama ?? '-' }}</td>
                        <td class="p-3 text-gray-600 dark:text-slate-300">{{ $item->jumlah }}</td>
                        <td class="p-3 text-gray-600 dark:text-slate-300">Rp{{ number_format($item->harga,0,',','.') }}</td>
                        <td class="p-3 font-semibold text-[#F38B93]">Rp{{ number_format($item->total,0,',','.') }}</td>
                        <td class="p-3 text-gray-500 dark:text-slate-400">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                        <td class="p-3">
                            @if($item->status == 'Selesai')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 dark:bg-green-500/15 text-green-600 dark:text-green-300 border border-green-200 dark:border-green-400/20">Selesai</span>
                            @elseif($item->status == 'Batal')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 dark:bg-red-500/15 text-red-600 dark:text-red-300 border border-red-200 dark:border-red-400/20">Batal</span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-[#F38B93]/15 text-[#F38B93] border border-[#F38B93]/25">Dalam Proses</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-4 flex justify-center border-t border-[#F38B93]/10 bg-white dark:bg-[#1E293B]">
            {{ $data->links() }}
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('checkAll');
    const checkItems = document.querySelectorAll('.check-item');
    const exportBtn = document.querySelector('div.relative > button');
    const dropdown = document.getElementById('exportDropdown');
    const exportForm = dropdown.querySelector('form');

    checkAll.addEventListener('change', function() {
        checkItems.forEach(el => el.checked = this.checked);
    });

    exportBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    window.addEventListener('click', function(e) {
        if (!exportBtn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    exportForm.addEventListener('submit', function() {
        const selectedIds = [];
        checkItems.forEach(el => {
            if(el.checked) selectedIds.push(el.value);
        });
        document.getElementById('selectedIds').value = JSON.stringify(selectedIds);
    });
});
</script>

@endsection