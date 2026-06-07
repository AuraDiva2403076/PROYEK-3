@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')
<div class="space-y-6 text-gray-800 dark:text-white">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Data Penjualan
            </h1>

            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Kelola seluruh transaksi penjualan Hara Hijab Needs
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('laporan.penjualan') }}"
               class="px-5 py-2.5 rounded-2xl border text-white
                      shadow-lg text-sm font-semibold transition-all duration-300"
               style="background-color: #F38B93; border-color: rgba(243, 139, 147, 0.35);"
               onmouseover="this.style.backgroundColor='#ea7d86'"
               onmouseout="this.style.backgroundColor='#F38B93'">
                Export Laporan
            </a>
        </div>
    </div>

    {{-- KARTU STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        {{-- TOTAL PESANAN --}}
        <div class="bg-white dark:bg-[#1E293B] rounded-3xl p-6 border shadow-sm hover:shadow-lg transition-all duration-300"
             style="border-color: rgba(243, 139, 147, 0.20);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-slate-400 mb-2">Total Pesanan</p>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalPesanan }}</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl flex items-center justify-center"
                     style="background-color: rgba(243, 139, 147, 0.15);">
                    <i class="bx bx-cart-alt text-3xl" style="color: #F38B93;"></i>
                </div>
            </div>
        </div>

        {{-- SELESAI --}}
        <div class="bg-white dark:bg-[#1E293B] rounded-3xl p-6 border shadow-sm hover:shadow-lg transition-all duration-300"
             style="border-color: rgba(243, 139, 147, 0.20);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-slate-400 mb-2">Pesanan Selesai</p>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $selesai }}</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl flex items-center justify-center"
                     style="background-color: rgba(243, 139, 147, 0.15);">
                    <i class="bx bx-check-circle text-3xl" style="color: #F38B93;"></i>
                </div>
            </div>
        </div>

        {{-- BATAL --}}
        <div class="bg-white dark:bg-[#1E293B] rounded-3xl p-6 border shadow-sm hover:shadow-lg transition-all duration-300"
             style="border-color: rgba(243, 139, 147, 0.20);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-slate-400 mb-2">Pesanan Batal</p>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $batal }}</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl flex items-center justify-center"
                     style="background-color: rgba(243, 139, 147, 0.15);">
                    <i class="bx bx-x-circle text-3xl" style="color: #F38B93;"></i>
                </div>
            </div>
        </div>

        {{-- PROSES --}}
        <div class="bg-white dark:bg-[#1E293B] rounded-3xl p-6 border shadow-sm hover:shadow-lg transition-all duration-300"
             style="border-color: rgba(243, 139, 147, 0.20);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-slate-400 mb-2">Dalam Proses</p>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $proses }}</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl flex items-center justify-center"
                     style="background-color: rgba(243, 139, 147, 0.15);">
                    <i class="bx bx-loader-circle text-3xl" style="color: #F38B93;"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- FILTER --}}
    <div class="bg-white dark:bg-[#1E293B] rounded-3xl p-5 border shadow-sm"
         style="border-color: rgba(243, 139, 147, 0.20);">

        <form method="GET"
              action="{{ route('penjualan.index') }}"
              class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            <div class="flex flex-wrap items-center gap-3">

                <div>
                    <label class="text-xs text-gray-500 dark:text-slate-400 block mb-1">
                        Tanggal Mulai
                    </label>

                    <input type="date"
                           name="start_date"
                           value="{{ request('start_date') }}"
                           class="px-4 py-2.5 rounded-2xl border
                                  bg-white dark:bg-[#0F172A]
                                  text-gray-700 dark:text-white
                                  focus:outline-none focus:border-[#F38B93]
                                  focus:ring-2 focus:ring-[#F38B93]/20
                                  text-sm"
                           style="border-color: rgba(243, 139, 147, 0.30);">
                </div>

                <div>
                    <label class="text-xs text-gray-500 dark:text-slate-400 block mb-1">
                        Tanggal Akhir
                    </label>

                    <input type="date"
                           name="end_date"
                           value="{{ request('end_date') }}"
                           class="px-4 py-2.5 rounded-2xl border
                                  bg-white dark:bg-[#0F172A]
                                  text-gray-700 dark:text-white
                                  focus:outline-none focus:border-[#F38B93]
                                  focus:ring-2 focus:ring-[#F38B93]/20
                                  text-sm"
                           style="border-color: rgba(243, 139, 147, 0.30);">
                </div>

                <div>
                    <label class="text-xs text-gray-500 dark:text-slate-400 block mb-1">
                        Status
                    </label>

                    <select name="status"
                            class="px-4 py-2.5 rounded-2xl border
                                   bg-white dark:bg-[#0F172A]
                                   text-gray-700 dark:text-white
                                   focus:outline-none focus:border-[#F38B93]
                                   focus:ring-2 focus:ring-[#F38B93]/20
                                   text-sm"
                            style="border-color: rgba(243, 139, 147, 0.30);">

                        <option value="">Semua Status</option>

                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>

                        <option value="Batal" {{ request('status') == 'Batal' ? 'selected' : '' }}>
                            Batal
                        </option>

                        <option value="Dalam Proses" {{ request('status') == 'Dalam Proses' ? 'selected' : '' }}>
                            Dalam Proses
                        </option>

                    </select>
                </div>

            </div>

            <div class="flex items-center gap-3">

                <button type="submit"
                        class="text-white px-5 py-2.5 rounded-2xl
                               text-sm font-semibold shadow-lg transition-all duration-300"
                        style="background-color: #F38B93;"
                        onmouseover="this.style.backgroundColor='#ea7d86'"
                        onmouseout="this.style.backgroundColor='#F38B93'">
                    Terapkan Filter
                </button>

                <a href="{{ route('penjualan.index') }}"
                   class="px-5 py-2.5 rounded-2xl
                          text-sm font-semibold transition-all duration-300
                          hover:bg-[#F38B93]/10"
                   style="border: 1px solid rgba(243, 139, 147, 0.35); color: #F38B93;">
                    Reset
                </a>

            </div>

        </form>

    </div>

    {{-- TABEL --}}
    <div class="bg-white dark:bg-[#1E293B] rounded-3xl border shadow-sm overflow-hidden"
         style="border-color: rgba(243, 139, 147, 0.20);">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="text-white" style="background-color: #F38B93;">
                    <tr>
                        <th class="p-4 text-left font-semibold">ID Pesanan</th>
                        <th class="p-4 text-left font-semibold">ID Produk</th>
                        <th class="p-4 text-left font-semibold">ID Pelanggan</th>
                        <th class="p-4 text-left font-semibold">Jumlah</th>
                        <th class="p-4 text-left font-semibold">Harga</th>
                        <th class="p-4 text-left font-semibold">Total</th>
                        <th class="p-4 text-left font-semibold">Tanggal</th>
                        <th class="p-4 text-left font-semibold">Status</th>
                        <th class="p-4 text-left font-semibold">Metode</th>
                        <th class="p-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-[#1E293B] divide-y divide-[#F38B93]/10">

@forelse($data as $item)

<tr class="transition-all duration-300 hover:bg-[#F38B93]/10 dark:hover:bg-[#263247]">

    <td class="p-4 font-semibold text-gray-800 dark:text-white">
        {{ $item->kode_pesanan }}
    </td>

    <td class="p-4 text-gray-600 dark:text-slate-300">
        {{ $item->id_produk }}
    </td>

    <td class="p-4 text-gray-600 dark:text-slate-300">
        {{ $item->id_pelanggan }}
    </td>

    <td class="p-4 text-gray-600 dark:text-slate-300">
        {{ $item->jumlah }}
    </td>

    <td class="p-4 font-medium text-gray-700 dark:text-slate-200">
        Rp{{ number_format($item->harga, 0, ',', '.') }}
    </td>

    <td class="p-4 font-bold" style="color: #F38B93;">
        Rp{{ number_format($item->total, 0, ',', '.') }}
    </td>

    <td class="p-4 text-gray-500 dark:text-slate-400">
        {{ $item->tanggal }}
    </td>

    <td class="p-4">
        @if($item->status == 'Selesai')
            <span class="px-4 py-1.5 rounded-full border text-xs font-semibold"
                  style="background-color: rgba(243, 139, 147, 0.15); color: #F38B93; border-color: rgba(243, 139, 147, 0.20);">
                Selesai
            </span>
        @elseif($item->status == 'Batal')
            <span class="px-4 py-1.5 rounded-full bg-red-100 dark:bg-red-500/15 text-red-600 dark:text-red-300 border border-red-200 dark:border-red-400/20 text-xs font-semibold">
                Batal
            </span>
        @else
            <span class="px-4 py-1.5 rounded-full border text-xs font-semibold"
                  style="background-color: rgba(243, 139, 147, 0.15); color: #F38B93; border-color: rgba(243, 139, 147, 0.20);">
                Dalam Proses
            </span>
        @endif
    </td>

    <td class="p-4 text-gray-600 dark:text-slate-300">
        {{ $item->metode ?? '-' }}
    </td>

    <td class="p-3">
        <div class="flex gap-2">

            <a href="{{ route('penjualan.edit', $item->id) }}"
               class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200">
                <i class='bx bx-pencil'></i>
            </a>

            <form action="{{ route('penjualan.destroy', $item->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus data penjualan ini?')">

                @csrf
                @method('DELETE')

                <button type="submit"
                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-200">
                    <i class='bx bx-trash'></i>
                </button>

            </form>

        </div>
    </td>

</tr>

@empty

<tr>
    <td colspan="10" class="p-10 text-center text-gray-500 dark:text-slate-400">
        Belum ada data penjualan
    </td>
</tr>

@endforelse

</tbody>     

              </table>

</div>

<div class="p-5 border-t border-[#F38B93]/10 bg-white dark:bg-[#1E293B]">
    {{ $data->links() }}
</div>

</div>

@endsection

