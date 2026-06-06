@extends('layouts.app')

@section('title','Rekomendasi AI')

@section('content')

<div class="space-y-8 text-gray-800 dark:text-white">

    @php
        $colorMap = [
            'ivory' => '#fffff0',
            'taupe' => '#8b8589',
            'dark choco' => '#3b241c',
            'black' => '#000000',
            'shadow' => '#4a4a4a',
            'grey latte' => '#b8aea3',
            'walnute' => '#6b4423',
            'dark brown' => '#4a2c2a',
            'pearl' => '#f8f6f0',
            'charcoal' => '#36454f',
            'smoke' => '#848884',
            'biscuit' => '#ddb892',
            'soft yellow' => '#fff59d',
            'golden brown' => '#996515',
            'grey seal' => '#8a8d8f',
            'latte' => '#c8a27a',
            'coral' => '#ff7f50',
            'peach' => '#ffccbc',
            'navy' => '#000080',
            'sky blue' => '#87ceeb',
            'dusty pink' => '#d8a7b1',
        ];
    @endphp

    {{-- DATASET --}}
    <div class="bg-white dark:bg-[#1E293B] rounded-3xl shadow-md p-8 border border-[#F38B93]/20 transition-all duration-300">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                    Daftar Rekomendasi Hijab
                </h2>

                <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                    Dataset warna hijab berdasarkan kategori warna kulit
                </p>
            </div>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-[#F38B93]/20">

            <table class="w-full text-sm">

                <thead class="text-white" style="background-color:#F38B93;">
                    <tr>
                        <th class="px-5 py-4 text-left font-semibold">ID</th>
                        <th class="px-5 py-4 text-left font-semibold">Warna Kulit</th>
                        <th class="px-5 py-4 text-left font-semibold">Warna Hijab</th>
                        <th class="px-5 py-4 text-left font-semibold">Kesan Default AI</th>
                        <th class="px-5 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#F38B93]/10 bg-white dark:bg-[#1E293B]">

                    @forelse($rekomendasis as $data)

                        @php
                            $kesanAI = match(strtolower($data->warna_kulit)) {
                                'putih' => 'Elegant, fresh, clean, classy',
                                'kuning langsat' => 'Bright, glowing, cheerful',
                                'sawo matang' => 'Warm, natural, exotic, glam',
                                'gelap' => 'Bold, strong, powerful look',
                                default => 'Natural & balanced look'
                            };
                        @endphp

                        <tr class="hover:bg-[#F38B93]/10 transition">

                            <td class="px-5 py-4 font-semibold text-gray-800 dark:text-white whitespace-nowrap">
                                WK{{ str_pad($data->id,2,'0',STR_PAD_LEFT) }}
                            </td>

                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full bg-[#F38B93]/15 text-[#F38B93] border border-[#F38B93]/25 text-xs font-medium">
                                    {{ $data->warna_kulit }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-2 max-w-xl max-h-24 overflow-y-auto pr-2">

                                    @foreach(explode(',', $data->rekomendasi_warna) as $warna)
                                        @php
                                            $key = strtolower(trim($warna));
                                            $bg = $colorMap[$key] ?? '#cccccc';

                                            $darkTextColors = [
                                                'ivory','pearl','soft yellow','peach',
                                                'sky blue','dusty pink','biscuit',
                                                'latte','grey latte'
                                            ];

                                            $textColor = in_array($key, $darkTextColors)
                                                ? 'text-gray-700'
                                                : 'text-white';
                                        @endphp

                                        @if(trim($warna))
                                            <span class="inline-flex items-center px-3 py-1 text-xs rounded-full shadow-sm {{ $textColor }}"
                                                  style="background-color: {{ $bg }};">
                                                {{ trim($warna) }}
                                            </span>
                                        @endif
                                    @endforeach

                                </div>
                            </td>

                            <td class="px-5 py-4 text-gray-500 dark:text-slate-400">
                                {{ $kesanAI }}
                            </td>

                            <td class="px-5 py-4 text-center">
                                <div class="flex justify-center items-center gap-4 text-lg">

                                    <a href="{{ route('dataset-ai.edit',$data->id) }}"
                                       class="text-[#F38B93] hover:text-pink-600 dark:hover:text-white transition">
                                        ✏
                                    </a>

                                    <form action="{{ route('dataset-ai.destroy',$data->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-500 hover:text-red-600 transition">
                                            🗑
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-500 dark:text-slate-400">
                                Belum ada dataset
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $rekomendasis->links() }}
        </div>

    </div>

    {{-- ANALISIS --}}
    <div class="bg-white dark:bg-[#1E293B] rounded-3xl shadow-md p-8 border border-[#F38B93]/20 transition-all duration-300">

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                Hasil Analisis Pengguna
            </h2>

            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Riwayat deteksi AI pengguna
            </p>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-[#F38B93]/20">

            <table class="w-full text-sm">

                <thead class="text-white" style="background-color:#F38B93;">
                    <tr>
                        <th class="px-5 py-4 text-left">Kode</th>
                        <th class="px-5 py-4 text-left">Warna Kulit</th>
                        <th class="px-5 py-4 text-left">Rekomendasi</th>
                        <th class="px-5 py-4 text-left">Foto</th>
                        <th class="px-5 py-4 text-left">Brightness</th>
                        <th class="px-5 py-4 text-left">LAB L</th>
                        <th class="px-5 py-4 text-left">Tanggal</th>
                        <th class="px-5 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#F38B93]/10 bg-white dark:bg-[#1E293B]">

                    @forelse($analisis ?? [] as $item)

                    <tr class="hover:bg-[#F38B93]/10 transition">

                        <td class="px-5 py-4 font-semibold text-gray-800 dark:text-white">
                            {{ $item->kode }}
                        </td>

                        <td class="px-5 py-4">
                            <span class="px-3 py-1 rounded-full bg-[#F38B93]/15 text-[#F38B93] border border-[#F38B93]/25 text-xs font-medium">
                                {{ $item->warna_kulit }}
                            </span>
                        </td>

                        <td class="px-5 py-4 text-gray-600 dark:text-slate-300">
                            {{ $item->rekomendasi_warna }}
                        </td>

                        <td class="px-5 py-4">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}"
                                     class="w-10 h-10 rounded-full object-cover border border-[#F38B93]/25">
                            @else
                                <span class="text-gray-400 dark:text-slate-400 text-xs">
                                    Tidak ada foto
                                </span>
                            @endif
                        </td>

                        <td class="px-5 py-4 text-gray-600 dark:text-slate-300">
                            {{ number_format($item->brightness ?? 0, 2) }}
                        </td>

                        <td class="px-5 py-4 text-gray-600 dark:text-slate-300">
                            {{ number_format($item->lab_l ?? 0, 2) }}
                        </td>

                        <td class="px-5 py-4 text-gray-500 dark:text-slate-400">
                            {{ $item->created_at->format('d M Y') }}
                        </td>

                        <td class="px-5 py-4 text-center">
                            <form action="{{ route('analisis.destroy',$item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus hasil analisis ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-red-500 hover:text-red-600 transition">
                                    🗑
                                </button>
                            </form>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="text-center py-10 text-gray-500 dark:text-slate-400">
                            Belum ada hasil analisis
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $analisis->links() }}
        </div>

    </div>

</div>

@endsection
