@extends('layouts.app')

@section('title', 'Edit Penjualan')

@section('content')
<div class="space-y-6">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Status Penjualan</h2>

        <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm text-gray-500 mb-2">Kode Pesanan</label>
                <input type="text"
                       value="{{ $penjualan->kode_pesanan }}"
                       readonly
                       class="w-full bg-gray-50 text-sm px-4 py-2 rounded-lg border border-gray-200 focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-sm text-gray-500 mb-2">Status</label>
                <select name="status"
                        class="w-full bg-gray-50 text-sm px-4 py-2 rounded-lg border border-gray-200 focus:outline-none">
                    <option value="Dalam Proses" {{ $penjualan->status == 'Dalam Proses' ? 'selected' : '' }}>
                        Dalam Proses
                    </option>
                    <option value="Selesai" {{ $penjualan->status == 'Selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>
                    <option value="Batal" {{ $penjualan->status == 'Batal' ? 'selected' : '' }}>
                        Batal
                    </option>
                </select>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit"
                        class="bg-pink-500 text-white px-5 py-2 rounded-full text-sm hover:bg-pink-600">
                    Simpan
                </button>

                <a href="{{ route('penjualan.index') }}"
                   class="bg-gray-100 text-gray-600 px-5 py-2 rounded-full text-sm hover:bg-gray-200">
                    Kembali
                </a>
            </div>
        </form>
    </div>

</div>
@endsection