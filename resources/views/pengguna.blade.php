@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')
<div class="space-y-6">

    {{-- FILTER --}}
    <div class="bg-white p-4 rounded-2xl shadow flex items-center justify-between">
        <div class="flex items-center gap-3">
            <input type="date" class="border border-pink-200 rounded-lg px-3 py-2 text-sm">
            <input type="date" class="border border-pink-200 rounded-lg px-3 py-2 text-sm">
        </div>

        <div class="flex items-center gap-3">
            <button class="w-10 h-10 flex items-center justify-center rounded-xl border border-pink-200 text-pink-400">
                <i class="bx bx-search"></i>
            </button>

            <button class="flex items-center gap-2 px-4 py-2 rounded-xl border border-pink-200 text-gray-500 text-sm">
                Filter <i class="bx bx-chevron-down"></i>
            </button>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">No. Telepon</th>
                    <th class="p-3 text-left">Alamat</th>
                    <th class="p-3 text-left">Foto</th>
                    <th class="p-3 text-left">Tanggal Bergabung</th>
                    <th class="p-3 text-left">Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr class="border-t {{ $user->status == 'Nonaktif' ? 'bg-gray-50 opacity-60' : '' }}">
                    <td class="p-3">{{ $user->kode_pengguna }}</td>
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">{{ $user->no_telp }}</td>
                    <td class="p-3">{{ $user->alamat }}</td>

                    {{-- FOTO --}}
                    <td class="p-3">
                        <img src="{{ asset('storage/'.$user->foto) }}"
                             class="w-8 h-8 rounded-full object-cover">
                    </td>

                    <td class="p-3">{{ $user->created_at->format('Y-m-d') }}</td>

                    {{-- STATUS TOGGLE --}}
                    <td class="p-3">
                        <form action="{{ route('pengguna.updateStatus', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox"
                                       onchange="this.form.submit()"
                                       class="sr-only peer"
                                       {{ $user->status == 'Aktif' ? 'checked' : '' }}>

                                <div class="w-11 h-6 bg-gray-200 rounded-full peer
                                            peer-checked:bg-green-400
                                            after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                            after:bg-white after:border after:rounded-full after:h-5 after:w-5
                                            after:transition-all
                                            peer-checked:after:translate-x-full">
                                </div>
                            </label>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- PAGINATION --}}
        <div class="p-4">
            {{ $users->links() }}
        </div>
    </div>

</div>
@endsection
