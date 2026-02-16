@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="space-y-8">

    <section class="bg-white p-8 rounded-3xl card-shadow">
        <h3 class="text-xl font-bold mb-6 text-gray-800">Statistik Umum</h3>
        <div class="grid grid-cols-4 gap-6">
            <div class="bg-red-100 p-6 rounded-2xl relative overflow-hidden">
                <div class="bg-pink-400 w-8 h-8 rounded-lg flex items-center justify-center text-white mb-4">🏷️</div>
                <h4 class="text-2xl font-bold text-gray-800">10k++</h4>
                <p class="text-xs text-gray-500">Total Penjualan</p>
                <a href="#" class="text-[10px] text-blue-400 absolute bottom-4 right-4 italic">Lainnya →</a>
            </div>
            <div class="bg-orange-100 p-6 rounded-2xl relative overflow-hidden">
                <div class="bg-orange-400 w-8 h-8 rounded-lg flex items-center justify-center text-white mb-4">🛒</div>
                <h4 class="text-2xl font-bold text-gray-800">200</h4>
                <p class="text-xs text-gray-500">Total Produk</p>
                <a href="#" class="text-[10px] text-blue-400 absolute bottom-4 right-4 italic">Lainnya →</a>
            </div>
            <div class="bg-green-100 p-6 rounded-2xl relative overflow-hidden">
                <div class="bg-green-400 w-8 h-8 rounded-lg flex items-center justify-center text-white mb-4">💰</div>
                <h4 class="text-2xl font-bold text-gray-800">10jt</h4>
                <p class="text-xs text-gray-500">Total Pendapatan</p>
                <a href="#" class="text-[10px] text-blue-400 absolute bottom-4 right-4 italic">Lainnya →</a>
            </div>
            <div class="bg-purple-100 p-6 rounded-2xl relative overflow-hidden">
                <div class="bg-purple-400 w-8 h-8 rounded-lg flex items-center justify-center text-white mb-4">👤</div>
                <h4 class="text-2xl font-bold text-gray-800">100</h4>
                <p class="text-xs text-gray-500">Total Pengguna</p>
                <a href="#" class="text-[10px] text-blue-400 absolute bottom-4 right-4 italic">Lainnya →</a>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-3 gap-8">
        <div class="col-span-2 bg-white p-6 rounded-3xl card-shadow">
            <h3 class="font-bold mb-4 text-gray-800">Grafik Penjualan</h3>
            <div class="h-48 w-full border-b border-l border-gray-100 relative flex items-end px-2 space-x-2">
                <div class="flex-1 bg-pink-200 rounded-t h-24"></div>
                <div class="flex-1 bg-teal-200 rounded-t h-32"></div>
                <div class="flex-1 bg-pink-200 rounded-t h-20"></div>
                <div class="flex-1 bg-teal-200 rounded-t h-40"></div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl card-shadow">
            <h3 class="font-bold mb-6 text-gray-800">Produk Terlaris</h3>
            <div class="space-y-4">
                @foreach([90, 70, 50, 20] as $width)
                <div class="w-full bg-gray-50 h-3 rounded-full overflow-hidden">
                <div class="bg-pink-400 h-full" style="width: {{ $width . '%' }}"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
