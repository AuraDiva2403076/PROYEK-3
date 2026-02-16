@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')
<div class="space-y-6">

{{-- KARTU STATISTIK --}}
<div class="grid grid-cols-4 gap-6">

    {{-- Total Pesanan --}}
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-pink-200 flex items-center gap-4">
        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-pink-50">
            <i class="bx bx-cart text-2xl text-gray-500"></i>
        </div>
        <div>
            <p class="text-sm text-gray-400">Total Pesanan</p>
            <h2 class="text-2xl font-semibold text-gray-800">{{ $totalPesanan }}</h2>
        </div>
    </div>

    {{-- Selesai --}}
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-pink-200 flex items-center gap-4">
        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-green-50">
            <i class="bx bx-check-square text-2xl text-green-500"></i>
        </div>
        <div>
            <p class="text-sm text-gray-400">Selesai</p>
            <h2 class="text-2xl font-semibold text-gray-800">{{ $selesai }}</h2>
        </div>
    </div>

    {{-- Batal --}}
<div class="bg-white p-5 rounded-2xl shadow-sm border border-pink-200 flex items-center gap-4">
    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-red-50">
        <i class="bx bx-x-circle text-2xl text-red-500"></i>
    </div>
    <div>
        <p class="text-sm text-gray-400">Batal</p>
        <h2 class="text-2xl font-semibold text-gray-800">{{ $batal }}</h2>
    </div>
</div>


    {{-- Dalam Proses --}}
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-pink-200 flex items-center gap-4">
        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-yellow-50">
            <i class="bx bx-time text-2xl text-yellow-500"></i>
        </div>
        <div>
            <p class="text-sm text-gray-400">Dalam Proses</p>
            <h2 class="text-2xl font-semibold text-gray-800">{{ $proses }}</h2>
        </div>
    </div>

</div>

{{-- FILTER --}}
<div class="flex justify-between items-center mt-6">

    <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-200">

        <span class="text-sm text-gray-400">Tanggal Mulai:</span>
        <input type="date" name="start_date"
            class="bg-gray-50 text-sm px-3 py-1 rounded-lg border border-gray-200 focus:outline-none">

        <span class="text-sm text-gray-400">Tanggal Akhir:</span>
        <input type="date" name="end_date"
            class="bg-gray-50 text-sm px-3 py-1 rounded-lg border border-gray-200 focus:outline-none">

        <button class="w-9 h-9 flex items-center justify-center rounded-full bg-pink-100 text-pink-500">
            <i class="bx bx-search"></i>
        </button>
    </div>

    <button class="bg-white px-4 py-2 rounded-full shadow-sm border border-gray-200 text-sm text-gray-500 flex items-center gap-2">
        Filter
        <i class="bx bx-chevron-down"></i>
    </button>

</div>


    {{-- TABEL --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="p-3"><input type="checkbox"></th>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Id Produk</th>
                    <th class="p-3 text-left">Id Pelanggan</th>
                    <th class="p-3 text-left">Jumlah</th>
                    <th class="p-3 text-left">Harga</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach($data as $item)
                <tr class="hover:bg-gray-50">
                    <td class="p-3"><input type="checkbox"></td>
                    <td class="p-3 font-medium text-gray-700">{{ $item->kode_pesanan }}</td>
                    <td class="p-3">{{ $item->id_produk }}</td>
                    <td class="p-3">{{ $item->id_pelanggan }}</td>
                    <td class="p-3">{{ $item->jumlah }}</td>
                    <td class="p-3">Rp{{ number_format($item->harga) }}</td>
                    <td class="p-3">Rp{{ number_format($item->total) }}</td>
                    <td class="p-3">{{ $item->tanggal }}</td>

                    {{-- STATUS BADGE --}}
                    <td class="p-3">
                        @if($item->status == 'Selesai')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">Selesai</span>
                        @elseif($item->status == 'Batal')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-600">Batal</span>
                        @else
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-600">Dalam Proses</span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td class="p-3 flex gap-2">
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200">
                            <i class='bx bx-pencil'></i>
                        </button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-200">
                            <i class='bx bx-trash'></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- PAGINATION TENGAH --}}
        <div class="p-4 flex justify-center">
            {{ $data->links() }}
        </div>
    </div>

</div>
@endsection
