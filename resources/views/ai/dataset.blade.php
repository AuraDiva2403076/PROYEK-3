@extends('layouts.app')

@section('title','Rekomendasi AI')

@section('content')

<div class="space-y-8">

    {{-- ================= CARD DATASET REKOMENDASI ================= --}}
    <div class="bg-white rounded-3xl shadow-md p-8">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-700">
                    Daftar Rekomendasi Hijab
                </h2>
                <p class="text-sm text-gray-400 mt-1">
                    Dataset warna hijab berdasarkan kategori warna kulit
                </p>
            </div>
        </div>

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

        <div class="overflow-x-auto rounded-2xl border border-gray-100">
            <table class="w-full text-sm">

                <thead class="bg-pink-50 text-gray-500">
                    <tr>
                        <th class="px-5 py-4 text-left font-semibold">ID</th>
                        <th class="px-5 py-4 text-left font-semibold">Warna Kulit</th>
                        <th class="px-5 py-4 text-left font-semibold">Warna Hijab</th>
                        <th class="px-5 py-4 text-left font-semibold">Kesan Default AI</th>
                        <th class="px-5 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 text-gray-700">

                    @forelse($rekomendasis as $data)

                        @php
                            $kesanAI = '';

                            switch(strtolower($data->warna_kulit)) {
                                case 'putih':
                                    $kesanAI = 'Elegant, fresh, clean, classy';
                                    break;
                                case 'kuning langsat':
                                    $kesanAI = 'Bright, glowing, cheerful';
                                    break;
                                case 'sawo matang':
                                    $kesanAI = 'Warm, natural, exotic, glam';
                                    break;
                                case 'gelap':
                                    $kesanAI = 'Bold, strong, powerful look';
                                    break;
                                default:
                                    $kesanAI = 'Natural & balanced look';
                            }
                        @endphp

                        <tr class="hover:bg-pink-50/40 transition">

                            <td class="px-5 py-4 font-semibold text-gray-700 whitespace-nowrap">
                                WK{{ str_pad($data->id,2,'0',STR_PAD_LEFT) }}
                            </td>

                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium">
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
                                                'ivory', 'pearl', 'soft yellow', 'peach',
                                                'sky blue', 'dusty pink', 'biscuit', 'latte',
                                                'grey latte'
                                            ];

                                            $textColor = in_array($key, $darkTextColors) ? 'text-gray-700' : 'text-white';
                                        @endphp

                                        @if(trim($warna) !== '')
                                            <span class="inline-flex items-center px-3 py-1 text-xs rounded-full shadow-sm {{ $textColor }}"
                                                  style="background-color: {{ $bg }};">
                                                {{ trim($warna) }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </td>

                            <td class="px-5 py-4 text-gray-500 min-w-[180px]">
                                {{ $kesanAI }}
                            </td>

                            <td class="px-5 py-4 text-center">
                                <div class="flex justify-center items-center gap-4 text-lg">

                                    <a href="{{ route('dataset-ai.edit',$data->id) }}"
                                       class="text-blue-500 hover:text-blue-600 transition">
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
                            <td colspan="5" class="text-center py-10 text-gray-400">
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


    {{-- ================= CARD ANALISIS ================= --}}
    <div class="bg-white rounded-3xl shadow-md p-8">

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700">
                Hasil Analisis <span class="italic">Image Processing</span> Pengguna
            </h2>
            <p class="text-sm text-gray-400 mt-1">
                Riwayat hasil deteksi warna kulit dan rekomendasi hijab
            </p>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-gray-100">
            <table class="w-full text-sm">

                <thead class="bg-pink-50 text-gray-500">
                    <tr>
                        <th class="px-5 py-4 text-left font-semibold">Identitas</th>
                        <th class="px-5 py-4 text-left font-semibold">Warna Kulit</th>
                        <th class="px-5 py-4 text-left font-semibold">Rekomendasi Warna</th>
                        <th class="px-5 py-4 text-left font-semibold">Foto</th>
                        <th class="px-5 py-4 text-left font-semibold">Brightness</th>
                        <th class="px-5 py-4 text-left font-semibold">LAB L</th>
                        <th class="px-5 py-4 text-left font-semibold">Tanggal</th>
                        <th class="px-5 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 text-gray-700">

                    @forelse($analisis ?? [] as $item)
                        <tr class="hover:bg-pink-50/40 transition">

                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="font-semibold text-gray-700">
                                    {{ $item->kode }}
                                </div>
                                <div class="text-xs text-gray-400 mt-1">
                                    USR-{{ $item->user_id }}
                                </div>
                            </td>

                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium">
                                    {{ $item->warna_kulit }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-2 max-w-xs max-h-24 overflow-y-auto pr-2">
                                    @foreach(explode(',', $item->rekomendasi_warna ?? '') as $warna)
                                        @php
                                            $key = strtolower(trim($warna));
                                            $bg = $colorMap[$key] ?? '#cccccc';

                                            $darkTextColors = [
                                                'ivory', 'pearl', 'soft yellow', 'peach',
                                                'sky blue', 'dusty pink', 'biscuit', 'latte',
                                                'grey latte'
                                            ];

                                            $textColor = in_array($key, $darkTextColors) ? 'text-gray-700' : 'text-white';
                                        @endphp

                                        @if(trim($warna) !== '')
                                            <span class="inline-flex items-center px-3 py-1 text-xs rounded-full shadow-sm {{ $textColor }}"
                                                  style="background-color: {{ $bg }};">
                                                {{ trim($warna) }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                @if($item->foto)
                                    <img src="{{ asset('storage/'.$item->foto) }}"
                                         class="w-10 h-10 rounded-full object-cover border border-gray-200 shadow-sm">
                                @else
                                    <span class="text-gray-400 text-xs">Tidak ada foto</span>
                                @endif
                            </td>

                            <td class="px-5 py-4 whitespace-nowrap">
                                {{ number_format($item->brightness ?? 0, 2) }}
                            </td>

                            <td class="px-5 py-4 whitespace-nowrap">
                                {{ number_format($item->lab_l ?? 0, 2) }}
                            </td>

                            <td class="px-5 py-4 whitespace-nowrap text-gray-500">
                                {{ $item->created_at->format('d M Y') }}
                            </td>

                            <td class="px-5 py-4 text-center">
                                <form action="{{ route('analisis.destroy',$item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus hasil analisis ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500 hover:text-red-600 text-lg transition">
                                        🗑
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-10 text-gray-400">
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
