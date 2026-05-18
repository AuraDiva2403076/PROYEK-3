@extends('layouts.app')

@section('title','Rekomendasi AI')

@section('content')

<div class="space-y-8"> {{-- Tambahkan ini --}}

    <div class="bg-white rounded-3xl shadow-lg p-8">


    <h2 class="text-lg font-semibold text-gray-700 mb-6">
        Daftar Rekomendasi Hijab
    </h2>

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
        ];
    @endphp

    <div class="overflow-x-auto border rounded-2xl">

        <table class="w-full text-sm border-collapse">

            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-4 border">ID</th>
                    <th class="px-4 py-4 border">Warna Kulit</th>
                    <th class="px-4 py-4 border">Undertone</th>
                    <th class="px-4 py-4 border">Warna Hijab</th>
                    <th class="px-4 py-4 border">Kesan Default AI</th>
                    <th class="px-4 py-4 border text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">

            @forelse($rekomendasis as $data)

                @php
                    // LOGIC AI SEDERHANA
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

                <tr class="hover:bg-pink-50 transition">

                    <td class="px-4 py-4 border font-medium">
                        WK{{ str_pad($data->id,2,'0',STR_PAD_LEFT) }}
                    </td>

                    <td class="px-4 py-4 border">
                        {{ $data->warna_kulit }}
                    </td>

                    <td class="px-4 py-4 border">
                        {{ $data->undertone ?? '-' }}
                    </td>

                    <td class="px-4 py-4 border">

                        <div class="flex flex-wrap gap-2 max-w-xl">

                            @foreach(explode(',', $data->rekomendasi_warna) as $warna)

                                @php
                                    $key = strtolower(trim($warna));
                                    $bg = $colorMap[$key] ?? '#cccccc';
                                @endphp

                                <span class="px-3 py-1 text-xs rounded-full text-white shadow"
                                      style="background-color: {{ $bg }};">
                                    {{ trim($warna) }}
                                </span>

                            @endforeach

                        </div>

                    </td>

                    <td class="px-4 py-4 border text-gray-600 text-sm">
                        {{ $kesanAI }}
                    </td>

                    <td class="px-4 py-6 border text-center">
    <div class="flex justify-center items-center gap-4 text-xl">

        <a href="{{ route('dataset-ai.edit',$data->id) }}"
           class="text-blue-500 hover:text-blue-600 transition duration-200">
            ✏
        </a>

        <form action="{{ route('dataset-ai.destroy',$data->id) }}"
              method="POST">
            @csrf
            @method('DELETE')
            <button class="text-red-500 hover:text-red-600 transition duration-200">
                🗑
            </button>
        </form>

    </div>
</td>

                        </form>

                    </td>

                </tr>

            @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-400">
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

        <h2 class="text-lg font-semibold text-gray-700 mb-8">
            Hasil Analisis <span class="italic">Image Processing</span> Pengguna
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead>
                    <tr class="border-b text-gray-400 uppercase text-xs tracking-wider">
                        <th class="py-4">Id Pelanggan</th>
                        <th>Warna Kulit</th>
                        <th>Rekomendasi Warna</th>
                        <th>Foto Wajah</th>
                        <th>Brightness</th>
                        <th>LAB L</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700">

                @forelse($analisis ?? [] as $item)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="py-6">
                            {{ $item->kode }}
                        </td>

                        <td class="py-6">
                            {{ $item->warna_kulit }}
                        </td>

                        <td class="py-6">
                            <div class="flex flex-wrap gap-2 max-w-xs">
                                @foreach(explode(',', $item->rekomendasi_warna ?? '') as $warna)
                                    @php
                                        $key = strtolower(trim($warna));
                                        $bg = $colorMap[$key] ?? '#cccccc';
                                    @endphp

                                    @if(trim($warna) !== '')
                                        <span class="px-3 py-1 text-xs rounded-full text-white shadow"
                                            style="background-color: {{ $bg }};">
                                            {{ trim($warna) }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        </td>

                        <td class="py-6">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}"
                                    class="w-12 h-12 rounded-full object-cover border">
                            @else
                                <span class="text-gray-400 text-xs">Tidak ada foto</span>
                            @endif
                        </td>

                        <td class="py-6">
                            {{ number_format($item->brightness ?? 0, 2) }}
                        </td>

                        <td class="py-6">
                            {{ number_format($item->lab_l ?? 0, 2) }}
                        </td>

                        <td class="py-6">
                            {{ $item->created_at->format('Y-m-d') }}
                        </td>

                        <td class="py-6 text-center">
                            <form action="{{ route('analisis.destroy',$item->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs">
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

    </div>

</div>

    </div> {{-- Tutup space-y-8 --}}
@endsection

