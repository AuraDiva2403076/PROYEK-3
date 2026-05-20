@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<div class="space-y-8">

    {{-- STATISTIK --}}
    <section class="bg-white dark:bg-[#1F2937]
                    p-8 rounded-3xl card-shadow
                    transition-all duration-300">

        <h3 class="text-xl font-bold mb-6
                   text-gray-800 dark:text-white">

            Statistik Umum

        </h3>

        <div class="grid grid-cols-4 gap-6">

            {{-- TOTAL PENJUALAN --}}
            <div class="bg-red-100 dark:bg-[#374151]
                        p-6 rounded-2xl relative overflow-hidden
                        transition-all duration-300">

                <div class="bg-pink-400 w-8 h-8 rounded-lg
                            flex items-center justify-center
                            text-white mb-4">

                    🏷️

                </div>

                <h4 id="totalPesanan"
                    class="text-2xl font-bold
                           text-gray-800 dark:text-white">

                    {{ $totalPesanan }}

                </h4>

                <p class="text-xs text-gray-500 dark:text-gray-300">

                    Total Penjualan

                </p>

<<<<<<< HEAD
                <a href="{{ route('penjualan.index') }}"
                   class="text-[10px] text-blue-400 absolute bottom-4 right-4 italic">
=======
                <a href="{{ route('penjualan') }}"
                   class="text-[10px] text-pink-400
                          absolute bottom-4 right-4 italic">

>>>>>>> ed7a199 (Update admin UI theme)
                    Lainnya →

                </a>

            </div>

            {{-- TOTAL PRODUK --}}
            <div class="bg-orange-100 dark:bg-[#374151]
                        p-6 rounded-2xl relative overflow-hidden
                        transition-all duration-300">

                <div class="bg-orange-400 w-8 h-8 rounded-lg
                            flex items-center justify-center
                            text-white mb-4">

                    🛒

                </div>

                <h4 id="totalProduk"
                    class="text-2xl font-bold
                           text-gray-800 dark:text-white">

                    {{ $totalProduk }}

                </h4>

                <p class="text-xs text-gray-500 dark:text-gray-300">

                    Total Produk

                </p>

                <a href="{{ route('katalog') }}"
                   class="text-[10px] text-pink-400
                          absolute bottom-4 right-4 italic">

                    Lainnya →

                </a>

            </div>

            {{-- TOTAL PENDAPATAN --}}
            <div class="bg-green-100 dark:bg-[#374151]
                        p-6 rounded-2xl relative overflow-hidden
                        transition-all duration-300">

                <div class="bg-green-400 w-8 h-8 rounded-lg
                            flex items-center justify-center
                            text-white mb-4">

                    💰

                </div>

                <h4 id="totalPendapatan"
                    class="text-2xl font-bold
                           text-gray-800 dark:text-white">

                    Rp{{ number_format($totalPendapatan,0,',','.') }}

                </h4>

                <p class="text-xs text-gray-500 dark:text-gray-300">

                    Total Pendapatan

                </p>

<<<<<<< HEAD
                <a href="{{ route('penjualan.index') }}"
                   class="text-[10px] text-blue-400 absolute bottom-4 right-4 italic">
=======
                <a href="{{ route('penjualan') }}"
                   class="text-[10px] text-pink-400
                          absolute bottom-4 right-4 italic">

>>>>>>> ed7a199 (Update admin UI theme)
                    Lainnya →

                </a>

            </div>

            {{-- TOTAL PENGGUNA --}}
            <div class="bg-purple-100 dark:bg-[#374151]
                        p-6 rounded-2xl relative overflow-hidden
                        transition-all duration-300">

                <div class="bg-purple-400 w-8 h-8 rounded-lg
                            flex items-center justify-center
                            text-white mb-4">

                    👤

                </div>

                <h4 id="totalPengguna"
                    class="text-2xl font-bold
                           text-gray-800 dark:text-white">

                    {{ $totalPengguna }}

                </h4>

                <p class="text-xs text-gray-500 dark:text-gray-300">

                    Total Pengguna

                </p>

                <a href="{{ route('pengguna') }}"
                   class="text-[10px] text-pink-400
                          absolute bottom-4 right-4 italic">

                    Lainnya →

                </a>

            </div>

        </div>

    </section>

    {{-- GRAFIK + PRODUK TERLARIS --}}
    <div class="grid grid-cols-3 gap-8">

        {{-- GRAFIK --}}
        <div class="col-span-2
                    bg-white dark:bg-[#1F2937]
                    p-6 rounded-3xl card-shadow
                    transition-all duration-300">

            <h3 class="font-bold mb-4
                       text-gray-800 dark:text-white">

                Grafik Penjualan

            </h3>

            @php

                $bulanLabels = [
                    1 => 'Jan',
                    2 => 'Feb',
                    3 => 'Mar',
                    4 => 'Apr',
                    5 => 'Mei',
                    6 => 'Jun',
                    7 => 'Jul',
                    8 => 'Agu',
                    9 => 'Sep',
                    10 => 'Okt',
                    11 => 'Nov',
                    12 => 'Des',
                ];

                $dataBulanan = [];

                foreach ($bulanLabels as $nomorBulan => $namaBulan) {

                    $data = $grafikPenjualan->firstWhere('bulan', $nomorBulan);

                    $dataBulanan[] = [
                        'bulan' => $nomorBulan,
                        'label' => $namaBulan,
                        'total' => $data ? $data->total : 0,
                    ];
                }

                $maxGrafikPenjualan =
                    collect($dataBulanan)->max('total') ?: 1;

                $warnaGrafik = [
                    'bg-teal-300',
                    'bg-pink-300',
                ];

            @endphp

            <div id="grafikPenjualanContainer"
                 class="h-64 w-full
                        border-b border-l
                        border-gray-100 dark:border-gray-700
                        flex items-end justify-between px-2">

                @foreach($dataBulanan as $item)

                    @php

                        $tinggiGrafik = $item['total'] > 0
                            ? max(8, ($item['total'] / $maxGrafikPenjualan) * 180)
                            : 4;

                        $warnaBatang =
                            $warnaGrafik[$loop->index % count($warnaGrafik)];

                    @endphp

                    <div class="flex flex-col items-center flex-1">

                        <div class="w-6 rounded-t {{ $warnaBatang }}"
                             title="{{ $item['label'] }}"
                             style="height: {{ $tinggiGrafik }}px">

                        </div>

                        <span class="text-[10px]
                                     text-gray-500 dark:text-gray-300
                                     mt-2">

                            {{ $item['label'] }}

                        </span>

                    </div>

                @endforeach

            </div>

        </div>

        {{-- PRODUK TERLARIS --}}
<<<<<<< HEAD
        <div class="bg-white p-6 rounded-3xl card-shadow">

          
=======
        <div class="bg-white dark:bg-[#1F2937]
                    p-6 rounded-3xl card-shadow
                    transition-all duration-300">

            <h3 class="font-bold mb-6
                       text-gray-800 dark:text-white">
>>>>>>> ed7a199 (Update admin UI theme)

                Produk Terlaris

            </h3>

            @php
                $maxProdukTerjual =
                    $produkTerlaris->max('total_terjual') ?: 1;
            @endphp

            <div id="produkTerlarisContainer" class="space-y-4">

                @forelse($produkTerlaris as $produk)

                    @php

                        $persenProduk = $produk->total_terjual > 0
                            ? min(($produk->total_terjual / $maxProdukTerjual) * 100, 100)
                            : 0;

                    @endphp

                    <div>

                        <div class="flex justify-between
                                    text-xs
                                    text-gray-600 dark:text-gray-300
                                    mb-1">

                            <span>
                                {{ $produk->nama_produk }}
                            </span>

                        </div>

                        <div class="w-full
                                    bg-gray-100 dark:bg-gray-700
                                    h-3 rounded-full overflow-hidden">

                            <div class="bg-pink-400 h-full"
                                 title="Terjual {{ $produk->total_terjual }}"
                                 style="width: {{ $persenProduk }}%">

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-xs text-gray-400">

                        Belum ada produk terjual

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

<script>

    function formatRupiah(angka) {

        return 'Rp' + new Intl.NumberFormat('id-ID').format(angka);

    }

    function loadDashboardData() {

        fetch("{{ route('dashboard.data') }}")

            .then(response => response.json())

            .then(data => {

                document.getElementById('totalPesanan').innerText =
                    data.totalPesanan;

                document.getElementById('totalProduk').innerText =
                    data.totalProduk;

                document.getElementById('totalPendapatan').innerText =
                    formatRupiah(data.totalPendapatan);

                document.getElementById('totalPengguna').innerText =
                    data.totalPengguna;

            })

            .catch(error =>
                console.log('Gagal mengambil data dashboard:', error)
            );
    }

    loadDashboardData();

    setInterval(loadDashboardData, 5000);

</script>

@endsection