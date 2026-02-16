@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')

<div class="bg-white p-10 rounded-2xl card-shadow max-w-5xl">

    <h3 class="text-lg font-semibold mb-10 text-gray-800">
        Pengaturan Umum
    </h3>

    {{-- Tema Sistem --}}
    <div class="flex items-start gap-8 mb-6">
        <label class="w-44 font-semibold text-sm text-gray-700 pt-2">
            Tema Sistem
        </label>

        <select class="px-4 py-2 border-2 border-pink-200 rounded-xl text-sm">
            <option>Terang</option>
            <option>Gelap</option>
        </select>
    </div>

    {{-- Nama Toko --}}
    <div class="flex items-start gap-8 mb-6">
        <label class="w-44 font-semibold text-sm text-gray-700 pt-2">
            Nama Toko
        </label>

        <input type="text"
               value="Hara Hijab Needs"
               class="flex-1 px-4 py-2 border-2 border-pink-200 rounded-xl
                      text-sm focus:outline-none">
    </div>

    {{-- Alamat --}}
    <div class="flex items-start gap-8 mb-6">
        <label class="w-44 font-semibold text-sm text-gray-700 pt-2">
            Alamat
        </label>

        <textarea class="flex-1 px-4 py-3 border-2 border-pink-200 rounded-xl
                         text-sm h-[120px] resize-none focus:outline-none">Jend. Sudirman No.221, Indramayu...</textarea>
    </div>

    {{-- Logo --}}
    <div class="flex items-start gap-8 mb-8">
        <label class="w-44 font-semibold text-sm text-gray-700 pt-2">
            Logo
        </label>

        <div class="relative w-[150px] h-[150px] border-2 border-pink-300
                    rounded-full flex items-center justify-center overflow-hidden">

            <img src="{{ asset('logo.png') }}" class="w-[80%]">

            <div class="absolute bottom-3 right-3 bg-gray-600 text-white
                        w-8 h-8 rounded-lg flex items-center justify-center text-sm">
                <i class="fa-solid fa-camera"></i>
            </div>
        </div>
    </div>

    {{-- Notifikasi --}}
    <div class="flex items-center gap-8 mb-6">
        <label class="w-44 font-semibold text-sm text-gray-700">
            Notifikasi ke Pengguna
        </label>

        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" class="sr-only peer" checked>
            <div class="w-16 h-8 bg-gray-200 rounded-full peer
                        peer-checked:bg-pink-300
                        after:content-[''] after:absolute after:top-1 after:left-1
                        after:bg-white after:rounded-full
                        after:h-6 after:w-6 after:transition-all
                        peer-checked:after:translate-x-8">
            </div>
        </label>
    </div>

    {{-- Mode Perbaikan --}}
    <div class="flex items-center gap-8 mb-6">
        <label class="w-44 font-semibold text-sm text-gray-700">
            Mode Perbaikan
        </label>

        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" class="sr-only peer">
            <div class="w-16 h-8 bg-gray-200 rounded-full peer
                        peer-checked:bg-pink-300
                        after:content-[''] after:absolute after:top-1 after:left-1
                        after:bg-white after:rounded-full
                        after:h-6 after:w-6 after:transition-all
                        peer-checked:after:translate-x-8">
            </div>
        </label>
    </div>

    {{-- API Key --}}
    <div class="flex items-start gap-8 mb-6">
        <label class="w-44 font-semibold text-sm text-gray-700 pt-2">
            API Key
        </label>

        <input type="text"
               value="AHDU5793hytr0dkks65720103uhdyYHNJhyio;"
               class="flex-1 px-4 py-2 border-2 border-pink-200 rounded-xl
                      text-sm focus:outline-none">
    </div>

    {{-- Link Sosial Media --}}
    <div class="flex items-start gap-8">
        <label class="w-44 font-semibold text-sm text-gray-700 pt-2">
            Link Sosial Media
        </label>

        <input type="text"
               value="https://harahijabneeds.com"
               class="flex-1 px-4 py-2 border-2 border-pink-200 rounded-xl
                      text-sm focus:outline-none">
    </div>

</div>

@endsection
