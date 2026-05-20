@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')

<div class="space-y-6 text-gray-800 dark:text-white">

    {{-- FILTER --}}
    <form method="GET"
          action="{{ route('pengguna') }}"
          class="bg-white dark:bg-[#1E293B]
                 rounded-3xl shadow-lg
                 border border-[#F38B93]/20
                 p-5 transition-all duration-300">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            {{-- LEFT --}}
            <div class="flex flex-wrap items-center gap-3">

                <input type="date"
                       name="start_date"
                       value="{{ request('start_date') }}"
                       class="h-11 px-4 rounded-2xl
                              border border-[#F38B93]/25
                              bg-white dark:bg-[#0F172A]
                              text-gray-700 dark:text-white
                              text-sm
                              focus:outline-none
                              focus:ring-2 focus:ring-[#F38B93]/20
                              focus:border-[#F38B93]
                              transition-all">

                <input type="date"
                       name="end_date"
                       value="{{ request('end_date') }}"
                       class="h-11 px-4 rounded-2xl
                              border border-[#F38B93]/25
                              bg-white dark:bg-[#0F172A]
                              text-gray-700 dark:text-white
                              text-sm
                              focus:outline-none
                              focus:ring-2 focus:ring-[#F38B93]/20
                              focus:border-[#F38B93]
                              transition-all">

                <button type="submit"
                        class="w-11 h-11 flex items-center justify-center
                               rounded-2xl text-white shadow-md transition-all duration-300"
                        style="background-color:#F38B93;"
                        onmouseover="this.style.backgroundColor='#ea7d86'"
                        onmouseout="this.style.backgroundColor='#F38B93'">

                    <i class="bx bx-search text-lg"></i>

                </button>

                <a href="{{ route('pengguna') }}"
                   class="h-11 px-5 flex items-center rounded-2xl
                          border border-[#F38B93]/25
                          bg-white dark:bg-[#0F172A]
                          text-[#F38B93]
                          hover:bg-[#F38B93]/10
                          text-sm transition-all duration-300">

                    Reset

                </a>

            </div>

            {{-- RIGHT --}}
            <div class="text-sm text-gray-500 dark:text-slate-400">

                Total Pengguna:
                <span class="font-semibold text-[#F38B93]">
                    {{ $users->total() }}
                </span>

            </div>

        </div>

    </form>

    {{-- TABLE --}}
    <div class="bg-white dark:bg-[#1E293B]
                rounded-3xl shadow-lg
                border border-[#F38B93]/20
                overflow-hidden transition-all duration-300">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="text-white"
                       style="background-color:#F38B93;">

                    <tr>
                        <th class="p-5 text-left font-semibold">ID</th>
                        <th class="p-5 text-left font-semibold">Pengguna</th>
                        <th class="p-5 text-left font-semibold">No. Telepon</th>
                        <th class="p-5 text-left font-semibold">Alamat</th>
                        <th class="p-5 text-left font-semibold">Tanggal Bergabung</th>
                        <th class="p-5 text-left font-semibold">Status Akun</th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-[#F38B93]/10 bg-white dark:bg-[#1E293B]">

                    @forelse($users as $user)

                    <tr class="hover:bg-[#F38B93]/10 transition-all duration-300
                        {{ ($user->status ?? 'Aktif') == 'Diblokir' ? 'opacity-70' : '' }}">

                        {{-- ID --}}
                        <td class="p-5">
                            <div class="font-semibold text-gray-800 dark:text-white">
                                {{ $user->kode_pengguna ?? 'USR-'.$user->id }}
                            </div>
                        </td>

                        {{-- USER --}}
                        <td class="p-5">

                            <div class="flex items-center gap-4">

                                @if($user->foto)

                                    <img src="data:image/*;base64,{{ $user->foto }}"
                                         class="w-12 h-12 rounded-2xl object-cover border border-[#F38B93]/20 shadow-sm">

                                @else

                                    <div class="w-12 h-12 rounded-2xl text-white flex items-center justify-center font-bold shadow-md"
                                         style="background-color:#F38B93;">

                                        {{ strtoupper(substr($user->name, 0, 1)) }}

                                    </div>

                                @endif

                                <div>
                                    <div class="font-semibold text-gray-800 dark:text-white">
                                        {{ $user->name }}
                                    </div>

                                    <div class="text-xs text-gray-500 dark:text-slate-400 mt-0.5">
                                        {{ $user->email }}
                                    </div>
                                </div>

                            </div>

                        </td>

                        {{-- PHONE --}}
                        <td class="p-5 text-gray-600 dark:text-slate-300">
                            {{ $user->no_telepon ?? '-' }}
                        </td>

                        {{-- ADDRESS --}}
                        <td class="p-5 text-gray-600 dark:text-slate-300 max-w-[220px] truncate">
                            {{ $user->alamat ?? '-' }}
                        </td>

                        {{-- DATE --}}
                        <td class="p-5 text-gray-600 dark:text-slate-300">
                            {{ $user->tanggal_bergabung ?? $user->created_at?->format('d M Y') }}
                        </td>

                        {{-- STATUS --}}
                        <td class="p-5">

                            <form action="{{ route('pengguna.updateStatus', $user->id) }}"
                                  method="POST">
                                @csrf

                                <label class="relative inline-flex items-center cursor-pointer">

                                    <input type="checkbox"
                                           onchange="this.form.submit()"
                                           class="sr-only peer"
                                           {{ ($user->status ?? 'Aktif') == 'Aktif' ? 'checked' : '' }}>

                                    <div class="w-14 h-7 bg-gray-200 dark:bg-[#0F172A]
                                                rounded-full transition-all duration-300
                                                peer-checked:bg-green-400
                                                after:content-['']
                                                after:absolute
                                                after:top-[2px]
                                                after:left-[2px]
                                                after:bg-white
                                                after:rounded-full
                                                after:h-6
                                                after:w-6
                                                after:shadow-md
                                                after:transition-all
                                                peer-checked:after:translate-x-7">
                                    </div>

                                </label>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="p-14 text-center">

                            <div class="flex flex-col items-center justify-center gap-3">

                                <div class="w-16 h-16 rounded-2xl bg-[#F38B93]/15 flex items-center justify-center">
                                    <i class="bx bx-user text-3xl text-[#F38B93]"></i>
                                </div>

                                <div class="text-gray-500 dark:text-slate-400 text-sm">
                                    Belum ada data pengguna.
                                </div>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="p-5 border-t border-[#F38B93]/10 bg-white dark:bg-[#1E293B]">
            {{ $users->links() }}
        </div>

    </div>

</div>

@endsection