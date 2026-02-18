@extends('layouts.app')

@section('title', 'Laporan Pengguna')

@section('content')
<div class="space-y-6">

    {{-- FILTER --}}
    <div class="flex justify-between items-center mt-6">

        {{-- FORM FILTER --}}
        <form method="GET" action="{{ route('laporan.pengguna') }}"
            class="flex flex-wrap items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-gray-200">

            {{-- TANGGAL --}}
            <span class="text-sm text-gray-400">Mulai:</span>
            <input type="date" name="start_date" value="{{ request('start_date') }}"
                class="bg-gray-50 text-sm px-3 py-1 rounded-lg border border-gray-200">
            <span class="text-sm text-gray-400">Akhir:</span>
            <input type="date" name="end_date" value="{{ request('end_date') }}"
                class="bg-gray-50 text-sm px-3 py-1 rounded-lg border border-gray-200">

            <button type="submit" class="px-4 py-1 rounded-lg bg-[#f37b7b] text-white text-sm">
                Filter
            </button>
        </form>

        {{-- DROPDOWN EXPORT --}}
        <div class="relative inline-block text-left">
            <button type="button"
                class="inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-[#f37b7b] font-bold hover:bg-gray-50">
                Ekspor
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div
                class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden"
                id="exportDropdown">
                <form method="GET" action="{{ route('laporan.pengguna.export') }}" class="flex flex-col p-2">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="ids" id="selectedIds">

                    <button type="submit" name="type" value="pdf"
                        class="px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">PDF</button>
                    <button type="submit" name="type" value="excel"
                        class="px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">Excel</button>
                    <button type="submit" name="type" value="csv"
                        class="px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">CSV</button>
                </form>
            </div>
        </div>

    </div>

    {{-- TABEL --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mt-4">
        <table class="w-full text-sm">
            <thead class="bg-pink-50 text-gray-600">
                <tr>
                    <th class="p-3">
                        <input type="checkbox" id="checkAll">
                    </th>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Kode Pengguna</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">No. Telepon</th>
                    <th class="p-3 text-left">Alamat</th>
                    <th class="p-3 text-left">Foto</th>
                    <th class="p-3 text-left">Tanggal Bergabung</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach($data as $item)
                <tr class="hover:bg-gray-50">
                    {{-- CHECKBOX --}}
                    <td class="p-3">
                        <input type="checkbox" class="check-item" value="{{ $item->id }}">
                    </td>

                    {{-- NOMOR URUT --}}
                    <td class="p-3 font-medium text-gray-700">{{ $loop->iteration }}</td>

                    {{-- KODE --}}
                    <td class="p-3 font-medium text-gray-700">{{ $item->kode_pengguna ?? '-' }}</td>

                    {{-- NAMA --}}
                    <td class="p-3">{{ $item->name ?? '-' }}</td>

                    {{-- EMAIL --}}
                    <td class="p-3">{{ $item->email ?? '-' }}</td>

                    {{-- NO TELEPON --}}
                    <td class="p-3">{{ $item->no_telepon ?? '-' }}</td>

                    {{-- ALAMAT --}}
                    <td class="p-3">{{ $item->alamat ?? '-' }}</td>

                    {{-- FOTO --}}
                    <td class="p-3">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->name }}" class="w-12 h-12 object-cover rounded">
                        @else
                            -
                        @endif
                    </td>

                    {{-- TANGGAL BERGABUNG --}}
                    <td class="p-3">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- PAGINATION --}}
        <div class="p-4 flex justify-center">
            {{ $data->links() }}
        </div>
    </div>
</div>

{{-- JS --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Checkbox select all
    const checkAll = document.getElementById('checkAll');
    const checkItems = document.querySelectorAll('.check-item');

    checkAll.addEventListener('change', function() {
        checkItems.forEach(el => el.checked = this.checked);
    });

    // Export dropdown toggle
    const exportBtn = document.querySelector('div.relative > button');
    const dropdown = document.getElementById('exportDropdown');

    exportBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    window.addEventListener('click', function(e) {
        if (!exportBtn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Kirim ID checkbox ke export form
    const exportForm = dropdown.querySelector('form');
    exportForm.addEventListener('submit', function(e) {
        const selectedIds = [];
        checkItems.forEach(el => {
            if(el.checked) selectedIds.push(el.value);
        });
        document.getElementById('selectedIds').value = JSON.stringify(selectedIds);
    });

});
</script>

@endsection
