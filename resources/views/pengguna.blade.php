@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')
<div class="space-y-6">

    {{-- FILTER --}}
    <form method="GET" action="{{ route('pengguna') }}"
        class="bg-white p-4 rounded-2xl shadow-sm border border-pink-100 flex flex-col md:flex-row gap-4 md:items-center md:justify-between">

        <div class="flex flex-wrap items-center gap-3">
            <input type="date"
                name="start_date"
                value="{{ request('start_date') }}"
                class="border border-pink-200 rounded-lg px-3 py-2 text-sm">

            <input type="date"
                name="end_date"
                value="{{ request('end_date') }}"
                class="border border-pink-200 rounded-lg px-3 py-2 text-sm">

            <button type="submit"
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-pink-100 text-pink-500 hover:bg-pink-200">
                <i class="bx bx-search"></i>
            </button>

            <a href="{{ route('pengguna') }}"
            class="px-4 py-2 rounded-xl border border-pink-200 text-gray-500 text-sm">
                Reset
            </a>
        </div>
    </form>

    {{-- TABEL --}}
    <div class="bg-white rounded-2xl shadow-sm border border-pink-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-pink-50 text-gray-600">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Pengguna</th>
                        <th class="p-4 text-left">No. Telepon</th>
                        <th class="p-4 text-left">Alamat</th>
                        <th class="p-4 text-left">Tanggal Bergabung</th>
                        <th class="p-4 text-left">Status Akun</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-pink-50/40 transition {{ ($user->status ?? 'Aktif') == 'Diblokir' ? 'bg-gray-50 opacity-60' : '' }}">
                        <td class="p-4 font-semibold text-gray-600">
                            {{ $user->kode_pengguna ?? 'USR-'.$user->id }}
                        </td>

                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                @if($user->foto)
                                    <img src="data:image/*;base64,{{ $user->foto }}"
                                         class="w-10 h-10 rounded-full object-cover border border-pink-200">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-500 font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif

                                <div>
                                    <div class="font-semibold text-gray-700">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="p-4 text-gray-600">
                            {{ $user->no_telepon ?? '-' }}
                        </td>

                        <td class="p-4 text-gray-600 max-w-xs truncate">
                            {{ $user->alamat ?? '-' }}
                        </td>

                        <td class="p-4 text-gray-600">
                            {{ $user->tanggal_bergabung ?? $user->created_at?->format('Y-m-d') }}
                        </td>

                        <td class="p-4">
                            <form action="{{ route('pengguna.updateStatus', $user->id) }}" method="POST">
                                @csrf

                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox"
                                           onchange="this.form.submit()"
                                           class="sr-only peer"
                                           {{ ($user->status ?? 'Aktif') == 'Aktif' ? 'checked' : '' }}>

                                    <div class="w-11 h-6 rounded-full bg-pink-200 transition-all duration-300
                                        peer-hover:bg-pink-300
                                        peer-focus:ring-4 peer-focus:ring-pink-100
                                        peer-checked:bg-green-400
                                        after:content-['']
                                        after:absolute
                                        after:top-[2px]
                                        after:left-[2px]
                                        after:h-5
                                        after:w-5
                                        after:rounded-full
                                        after:bg-white
                                        after:shadow-sm
                                        after:transition-all
                                        peer-checked:after:translate-x-full">
                            </div>
                                </label>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-400">
                            Belum ada data pengguna.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="p-4 border-t border-gray-100">
            {{ $users->links() }}
        </div>
    </div>

</div>
@endsection
