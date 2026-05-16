@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')
<div class="space-y-8">

    <div class="bg-white p-6 rounded-3xl card-shadow">
        <h2 class="text-xl font-bold text-[#f37b7b]">
            Hasil pencarian untuk "{{ $keyword }}"
        </h2>
    </div>

    {{-- PRODUK --}}
    <div class="bg-white p-6 rounded-3xl card-shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Produk
        </h3>

        @forelse($produk as $item)
            <div class="border-b py-3">
                <div class="font-semibold text-gray-800">
                    {{ $item->nama_produk }}
                </div>

                <div class="text-sm text-gray-500">
                    {{ $item->kategori }} •
                    Rp{{ number_format($item->harga, 0, ',', '.') }}
                </div>
            </div>
        @empty
            <p class="text-gray-400 text-sm">
                Tidak ada produk ditemukan.
            </p>
        @endforelse
    </div>

    {{-- PENJUALAN --}}
    <div class="bg-white p-6 rounded-3xl card-shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Penjualan
        </h3>

        @forelse($penjualan as $item)
            <div class="border-b py-3">
                <div class="font-semibold text-gray-800">
                    {{ $item->nama_produk }}
                </div>

                <div class="text-sm text-gray-500">
                    {{ $item->tanggal }} •
                    {{ $item->status }} •
                    Rp{{ number_format($item->total, 0, ',', '.') }}
                </div>
            </div>
        @empty
            <p class="text-gray-400 text-sm">
                Tidak ada data penjualan ditemukan.
            </p>
        @endforelse
    </div>

    {{-- PENGGUNA --}}
    <div class="bg-white p-6 rounded-3xl card-shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Pengguna
        </h3>

        @forelse($pengguna as $item)
            <div class="border-b py-3">
                <div class="font-semibold text-gray-800">
                    {{ $item->name }}
                </div>

                <div class="text-sm text-gray-500">
                    {{ $item->email }}
                </div>
            </div>
        @empty
            <p class="text-gray-400 text-sm">
                Tidak ada pengguna ditemukan.
            </p>
        @endforelse
    </div>

</div>
@endsection